<?php

namespace Modules\Frontend\Models;

use Exception;
use Modules\Order\Models\Order;
use Modules\Setting\Models\PaymentConfig;
use Stripe\AlipayAccount;
use Stripe\BankAccount;
use Stripe\BitcoinReceiver;
use Stripe\Card;
use Stripe\Exception\ApiErrorException;
use Stripe\Source;
use Stripe\StripeClient;
use Stripe\Token;

class PaymentStripe{

    public $stripe;
    public $user;

    const STATUS_REQUIRES_ACTION = 'requires_action';
    const STATUS_REQUIRES_METHOD = 'requires_payment_method';
    const STATUS_SUCCEEDED       = 'succeeded';

    /**
     * PaymentStripe constructor.
     */
    public function __construct(){
        $secret_key   = PaymentConfig::query()->where('key', PaymentConfig::STRIPE_SECRET_KEY)->first();
        $this->stripe = new StripeClient($secret_key->value ?? '');
        $this->user   = auth('web')->user();
    }

    /**
     * @return array|null
     */
    public function getCard(){
        try{
            if(!empty($this->user->card_ref)){
                $cardId = $this->stripe->customers->retrieve($this->user->card_ref ?? null)->default_source;
            }
            if(empty($cardId)){
                return [
                    'number' => null,
                ];
            }
            $card = $this->stripe->customers->retrieveSource($this->user->card_ref ?? null, $cardId);

            return [
                'number'    => 'xxxxxxxxxxxx' . $card->last4 ?? null,
                'exp_month' => $card->exp_month ?? null,
                'exp_year'  => $card->exp_year ?? null,
                'exp_date'  => formatDate(strtotime($card->exp_month . '/1/' . $card->exp_year), 'm/y')
            ];
        }catch(Exception $exception){
        }
        return null;
    }

    /**
     * @param $post
     * @return array|null
     */
    public function addCard($post){
        try{
            if(empty($this->user->card_ref)){
                $stripeCus            = $this->stripe->customers->create([
                    'email' => $this->user->email,
                    'name'  => $this->user->name,
                ]);
                $this->user->card_ref = $stripeCus->id;
            }
            if($this->user->save()){
                return $this->addCardIntoCustomer($post);
            }
        }catch(Exception $exception){
        }
        return null;
    }

    /**
     * @param $post
     * @return array|null
     */
    public function updateCard($post){
        try{
            $cardId = $this->stripe->customers->retrieve($this->user->card_ref ?? null)->default_source;
            if(empty($cardId)){
                return $this->addCardIntoCustomer($post);
            }
            $source = $this->createTokenSource($post);

            $card = $this->stripe->customers->update(
                $this->user->card_ref,
                ['default_source' => $source->id]
            );

            return [
                'number'    => $source->last4 ?? null,
                'exp_month' => $source->exp_month ?? null,
                'exp_year'  => $source->exp_year ?? null,
                'cvc'       => '***',
            ];
        }catch(Exception $exception){
        }
        return null;
    }

    /**
     * @param $post
     * @return array|bool|null
     */
    public function addCardIntoCustomer($post){
        try{
            $card = $this->createTokenSource($post);

            if(empty($card)){
                return false;
            }

            return [
                'number'    => $card->last4 ?? null,
                'exp_month' => $card->exp_month ?? null,
                'exp_year'  => $card->exp_year ?? null,
                'cvc'       => '***',
            ];
        }catch(Exception $exception){
            return null;
        }
    }

    /**
     * @param $post
     * @return Token
     * @throws ApiErrorException
     */
    public function createToken($post){
        try{
            return $this->stripe->tokens->create([
                'card' => [
                    'number'    => $post['number'] ?? null,
                    'exp_month' => $post['exp_month'] ?? null,
                    'exp_year'  => $post['exp_year'] ?? null,
                    'cvc'       => $post['cvc'] ?? null,
                ],
            ]);
        }catch(Exception $exception){
            return null;
        }
    }

    /**
     * @param $post
     * @return AlipayAccount|BankAccount|BitcoinReceiver|Card|Source
     * @throws ApiErrorException
     */
    public function createTokenSource($post){
        try{
            $token = $this->createToken($post);
            return $this->stripe->customers->createSource($this->user->card_ref ?? null, [
                'source' => $token->id,
            ]);
        }catch(Exception $exception){
            return null;
        }
    }

    /**
     * @return bool|null
     */
    public function removeCard(){
        try{
            $cardId = $this->stripe->customers->retrieve($this->user->card_ref ?? null)->default_source;
            if(!empty($cardId)){
                $response = $this->stripe->customers->deleteSource($this->user->card_ref ?? null, $cardId);
                return $response->isDeleted();
            }
        }catch(Exception $exception){
        }
        return null;
    }

    /**
     * @param Order $order
     * @param null $token
     * @param string $currency
     * @return bool|mixed|null
     */
    public function stripeCharge(Order $order, $token = null, $currency = 'HKD'){
        try{
            if(empty($token)){

                $payment = $this->stripe->paymentIntents->create([
                    'amount'        => $order->amount * 100,
                    'currency'      => $currency,
                    'customer'      => $this->user->card_ref,
                    'receipt_email' => $this->user->email,
                    'description'   => "Charge for order: {$order->code}",
                    'confirm'       => true,
                    'metadata'      => [
                        'order_number' => $order->code ?? '',
                        'order_id'     => $order->id,
                    ]
                ]);
            }else{
                $payment = $this->stripe->charges->create([
                    'amount'      => $order->amount * 100,
                    'currency'    => $currency,
                    'source'      => $token,
                    'description' => "Charge for order: {$order->code}",
                    'metadata'    => [
                        'order_number' => $order->code ?? '',
                        'order_id'     => $order->id,
                    ]
                ]);
            }
//            return $payment->next_action->jsonSerialize()['redirect_to_url']['url'] ?? null;
            return ($payment->status != self::STATUS_SUCCEEDED) ? true : false;

        }catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
        }

        return null;
    }
}
