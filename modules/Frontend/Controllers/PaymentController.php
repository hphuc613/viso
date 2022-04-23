<?php

namespace Modules\Frontend\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Base\Models\Status;
use Modules\Frontend\Models\Order;
use Modules\Frontend\Models\PaymentStripe;
use Modules\Frontend\Requests\Payment\PaymentInfoRequest;
use Modules\Member\Models\Member;
use Modules\PaymentMethod\Models\PaymentMethod;
use Modules\Setting\Models\Setting;
use Modules\Shipping\Models\Shipping;
use Throwable;

class PaymentController extends Controller {
    /**
     * @var Guard|StatefulGuard
     */
    private $auth;

    private $cart;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        # parent::__construct();
        $this->auth = Auth::guard('web');
        $this->cart = session()->get('cart') ?? [];
    }

    /**
     * @param $request
     * @return array|mixed
     */
    public function checkCart($request) {
        $cart = $this->cart;

        if (empty($cart['items']) || !isset($cart['code']) || $cart['code'] !== ($request->code ?? $request['code'] ?? null)) {
            session()->flash('danger', trans('Please add some product to cart!'));

            return [];
        }

        return $cart;
    }

    /**
     * @param Request $request
     * @return Factory|View|RedirectResponse
     */
    public function getPaymentInfo(Request $request) {
        // Check empty cart
        $cart = $this->checkCart($request);
        if (empty($cart)) {
            return redirect()->route('get.home.index');
        }

        return view('Frontend::payment.payment_info', compact('cart'));
    }

    /**
     * @param PaymentInfoRequest $request
     * @return Factory|View|RedirectResponse
     */
    public function getPaymentShipping(PaymentInfoRequest $request) {
        // Check empty cart
        $cart = $this->checkCart($request);
        if (empty($cart)) {
            return redirect()->route('get.home.index');
        }

        $shipping_list = Shipping::query()->where('status', Status::STATUS_ACTIVE)->get();
        $data          = $request->all();
        session()->put('payment_data', $data);

        return view('Frontend::payment.payment_shipping', compact('cart', 'data', 'shipping_list'));
    }

    /**
     * @param Request $request
     * @return Factory|View|RedirectResponse
     */
    public function getPaymentNow(Request $request) {
        // Check empty cart
        $cart = $this->checkCart($request);
        if (empty($cart)) {
            return redirect()->route('get.home.index');
        }

        $card_info = [];
        if ($this->auth->check() && !empty($this->auth->user()->card_ref)) {
            $card_info = (new PaymentStripe())->getCard();
        }

        $shipping = Shipping::query()->where('key_slug', $request->shipping)->first();
        if (empty($shipping)) {
            $request->session()->flash('danger', trans("Cannot find this shipping type."));

            return redirect()->back();
        }

        $data             = session()->get('payment_data');
        $data['shipping'] = $shipping->key_slug;
        session()->put('payment_data', $data);

        $payment_methods = PaymentMethod::query()
                                        ->where('status', Status::STATUS_ACTIVE)
                                        ->pluck('name', 'type_id')
                                        ->toArray();

        return view('Frontend::payment.payment_now', compact('cart', 'data', 'shipping', 'card_info', 'payment_methods'));
    }


    /**
     * @param Request $request
     * @return bool|RedirectResponse|Order|null
     */
    public function postPayment(Request $request) {
        $data            = session()->get('payment_data');
        $data['address'] = $data['address'] . ', ' . $data['apartment'] . ', ' . $data['district'] . ', ' . $data['region'] . ' ' . $data['country'];
        $cart            = $this->checkCart($data);
        if (empty($cart)) {
            return redirect()->route('get.home.index');
        }

        // Check shipping
        $shipping = Shipping::query()->where('key_slug', $data['shipping'])->first();
        if (empty($shipping)) {
            $request->session()->flash('danger', trans("Cannot find this shipping type."));

            return redirect()->back();
        }

        // Check shipping
        $payment = PaymentMethod::query()->where('type_id', $data['payment_method'])->first();
        if (empty($payment)) {
            $payment = PaymentMethod::query()->where('type_id', 'COD')->first();
        }

        DB::beginTransaction();
        try {
            // Create Order
            $order = Order::createOrder($data, $shipping, $payment, $cart, $this->auth->id() ?? NULL);
            $order->save();

            // Add exchange
            $user = $this->auth->check() ? Member::query()->find($this->auth->id()) : NULL;
            if (!empty($user)) {
                $exchange_point = Setting::query()->where('key', Setting::POINT)->first();
                $exchange_point = !empty($exchange_point) ? $exchange_point->value : 1;
                $user->point    += ((int)$order->total_price * (int)$exchange_point);
                $user->save();
            }

            // Create Order Detail
            Order::createOrderDetail($cart, $order);

            $request->session()->put('cart', []);
            DB::commit();

            return $order;
        } catch (Throwable $th) {
            DB::rollBack();

            return false;
        }
    }

    public function postCheckoutStripe() {

    }
}
