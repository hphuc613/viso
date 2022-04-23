<?php

namespace Modules\Frontend\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Modules\Order\Models\Order;
use Modules\Setting\Models\PaymentConfig;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Throwable;

class PaymentPayPalController extends Controller {

    /**
     * @return RedirectResponse|Redirector
     * @throws Throwable
     */
    public function index(Request $request) {
        $payment_data = session()->get('payment_data');
        $data         = $request->all();
        $payment_data = $payment_data + $data;
        $request->session()->put('payment_data', $payment_data);

        $provider = $this->getInitPayPal();
        $response = $provider->createOrder([
            'intent'              => 'CAPTURE',
            'locale'              => 'zh_CN',
            'purchase_units'      => [
                [
                    'amount' => [
                        'currency_code' => 'HKD',
                        'value'         => $payment_data['amount'] ?? 0
                    ]
                ]
            ],
            'application_context' => [
                'cancel_url' => route('paypal.cancel'),
                'return_url' => route('paypal.success')
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('get.payment.getPaymentNow', ['code' => $payment_data['code'], 'shipping' => $payment_data['shipping']])
                ->with('error', trans('Transaction cannot complete.'));
        }

        return redirect()
            ->route('get.payment.getPaymentNow', ['code' => $payment_data['code'], 'shipping' => $payment_data['shipping']])
            ->with('error', $response['message'] ?? trans('Transaction cannot complete.'));
    }

    /**
     * @return RedirectResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function cancel() {
        $payment_data = session()->get('payment_data');
        return redirect()
            ->route('get.payment.getPaymentNow', ['code' => $payment_data['code'], 'shipping' => $payment_data['shipping']])
            ->with('error', $response['message'] ?? trans('Transaction cannot complete.'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function success(Request $request) {
        $payment_data       = session()->get('payment_data');
        $payment_controller = new PaymentController();
        $create_order       = $payment_controller->postPayment($request);
        if ($create_order) {
            $provider = $this->getInitPayPal();
            $response = $provider->capturePaymentOrder($request->token);

            if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                $create_order->status = Order::STATUS_PAID;
                $create_order->save();

                $request->session()->put('payment_data', []);
                return redirect()
                    ->route('get.home.index')
                    ->with('success', trans('Transaction complete.'));
            }
        }

        return redirect()
            ->route('get.payment.getPaymentNow', ['code' => $payment_data['code'], 'shipping' => $payment_data['shipping']])
            ->with('error', $response['message'] ?? trans('Transaction cannot complete.'));
    }

    /**
     * @return PayPalClient
     * @throws Throwable
     */
    public function getInitPayPal() {
        $config   = PaymentConfig::getStripeConfig();
        $provider = new PayPalClient;
        $config   = [
            'mode'    => $config[PaymentConfig::PAYPAL_ENVIRONMENT] ?? "sandbox",
            'sandbox' => [
                'client_id'     => $config[PaymentConfig::PAYPAL_CLIENT_ID],
                'client_secret' => $config[PaymentConfig::PAYPAL_SECRET_KEY],
                'app_id'        => 'APP-80W284485P519543T',
            ],
            'live'    => [
                'client_id'     => $config[PaymentConfig::PAYPAL_CLIENT_ID],
                'client_secret' => $config[PaymentConfig::PAYPAL_SECRET_KEY],
                'app_id'        => 'APP-80W284485P519543T',
            ],

            'payment_action' => 'Sale',
            'currency'       => 'USD',
            'notify_url'     => '',
            'locale'         => 'es_US',
            'validate_ssl'   => true,
        ];

        $provider->setApiCredentials($config);
        $provider->setAccessToken($provider->getAccessToken());

        return $provider;
    }
}
