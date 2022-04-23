<?php

namespace Modules\Frontend\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Modules\Order\Models\Order;
use Modules\Setting\Models\PaymentConfig;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Stripe\StripeClient;
use Throwable;

class PaymentStripeController extends Controller {
    /**
     * @var HigherOrderBuilderProxy|mixed
     */
    private $secret_key;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->secret_key = PaymentConfig::query()->where('key', PaymentConfig::STRIPE_SECRET_KEY)->first()->value;
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     * @throws ApiErrorException
     */
    public function index(Request $request) {
        $payment_data = session()->get('payment_data');
        $data         = $request->all();
        $payment_data = $payment_data + $data;
        $request->session()->put('payment_data', $payment_data);

        Stripe::setApiKey($this->secret_key);
        $checkout_session = Session::create([
            'line_items'           => [
                [
                    'price_data' => [
                        'currency'     => 'HKD',
                        'product_data' => [
                            'name' => trans('Checkout Payment'),
                        ],
                        'unit_amount'  => (int)$payment_data['amount'] * 100,
                    ],
                    'quantity'   => 1,
                ]
            ],
            'mode'                 => 'payment',
            "payment_method_types" => [
                "card"
            ],
            'success_url'          => route('stripe.success'),
            'cancel_url'           => route('stripe.cancel'),
        ]);
        session()->put('stripe_id', $checkout_session->id);

        return redirect($checkout_session->url);
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

        $stripe_id        = session()->get('stripe_id') ?? NULL;
        $stripe           = new StripeClient($this->secret_key);
        $checkout_session = $stripe->checkout->sessions->retrieve($stripe_id);

        if ($checkout_session->payment_status == 'paid') {
            $create_order->status = Order::STATUS_PAID;
            $create_order->save();

            $request->session()->put('payment_data', []);
            return redirect()
                ->route('get.home.index')
                ->with('success', trans('Transaction complete.'));
        }

        return redirect()
            ->route('get.payment.getPaymentNow', ['code' => $payment_data['code'], 'shipping' => $payment_data['shipping']])
            ->with('error', $response['message'] ?? trans('Transaction cannot complete.'));
    }
}
