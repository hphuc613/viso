<?php

namespace Modules\Frontend\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Base\Models\Status;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCapacity;
use Modules\Voucher\Models\Voucher;
use Modules\Voucher\Models\VoucherMember;

class CartController extends Controller{

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        # parent::__construct();
    }

    /**
     * @param Request $request
     * @return string
     */
    public function cartBox(Request $request){
        $cart = [];
        if($request->session()->has('cart')){
            $cart = $request->session()->get('cart');
        }

        $products = Product::query()
                           ->where('status', Status::STATUS_ACTIVE)
                           ->orderBy('created_at', 'desc')
                           ->limit(4)
                           ->get();

        return view("Frontend::cart.cart_box", compact('cart', 'products'))->render();
    }


    /**
     * @param Request $request
     * @return array
     */
    public function addToCart(Request $request){
        //        $request->session()->put('cart', []);

        if(isset($request->data)){
            $data = Product::query()->where('key_slug', $request->data)->first();
            if((int)$data->stock_in <= 0){
                return [
                    'status'  => 300,
                    'message' => trans('The product is sold out')
                ];
            }
            if(!empty($data)){
                $cart_item['id']       = $data->id;
                $cart_item['product']  = $data;
                $cart_item['quantity'] = 1;
                $cart_item['price']    = !empty($data->discount) ? $data->discount : $data->price;
                if(isset($request->capacity) && !empty($request->capacity)){
                    $capacity                 = ProductCapacity::query()->find($request->capacity);
                    $cart_item['capacity_id'] = $capacity->id;
                    $cart_item['capacity']    = $capacity->capacity . $capacity->unit;
                    $cart_item['price']       = !empty($capacity->discount) ? $capacity->discount : $capacity->price;

                    if((int)$capacity->stock_in <= 0){
                        return [
                            'status'  => 300,
                            'message' => trans('The product is sold out')
                        ];
                    }
                }
                $cart_item['final_price'] = $cart_item['price'];

                $cart = [];
                if($request->session()->has('cart')){
                    $cart = $request->session()->get('cart');
                    if(isset($cart['items'])){
                        $get_ids = array_keys($cart['items']);
                        if(isset($request->capacity)){
                            $key = $data->id . '-' . $cart_item['capacity'];
                        }else{
                            $key = $data->id;
                        }
                        if(in_array($key, $get_ids)){
                            $cart_item['quantity']    = $cart['items'][$key]['quantity'] + 1;
                            $cart_item['final_price'] = $cart_item['price'] * $cart_item['quantity'];
                        }
                    }
                }
                if(isset($request->capacity)){
                    $cart['items'][$data->id . '-' . $cart_item['capacity']] = $cart_item;
                }else{
                    $cart['items'][$data->id] = $cart_item;
                }
                if(!isset($cart['code']) || empty($cart['code'])){
                    $cart['code'] = Str::random('6') . formatDate(time(), 'dmYHis');
                }
                $cart['voucher']       = null;
                $cart['voucher_id']    = null;
                $cart['voucher_price'] = 0;
                $cart['total_price']   = array_sum(array_column($cart['items'], 'final_price'));
                $cart['amount']        = $cart['total_price'];
                $cart['quantity']      = array_sum(array_column($cart['items'], 'quantity'));
                $request->session()->put('cart', $cart);
            }
        }

        return [
            'status' => 200
        ];
    }

    /**
     * @param Request $request
     * @return Factory|View|RedirectResponse
     */
    public function shoppingCart(Request $request){
        $cart = [];
        if($request->session()->has('cart')){
            $cart = $request->session()->get('cart');
        }
        if(empty($cart) || empty($cart['items'])){
            $request->session()->flash('danger', trans('Please add some product to cart!'));

            return redirect()->route('get.product.productListing');
        }

        $products = Product::query()
                           ->where('status', Status::STATUS_ACTIVE)
                           ->orderBy('created_at', 'desc')
                           ->limit(8)
                           ->get();

        return view('Frontend::cart.shopping_cart', compact('cart', 'products'));
    }

    /**
     * @param Request $request
     * @return array|RedirectResponse
     */
    public function updateCart(Request $request){
        $cart = $request->session()->get('cart');
        $ids  = array_column($cart['items'], 'id');
        if(isset($request->voucher_id)){
            if(!empty($request->voucher_id)){
                $voucher = VoucherMember::query()->find($request->voucher_id)->voucher;
                if(!empty($voucher)){
                    $product_ids = json_decode(!empty($voucher->product_ids) ? $voucher->product_ids : '[]');
                    if(empty($product_ids) || !empty(array_intersect($ids, $product_ids))){
                        $cart['voucher_id']    = $request->voucher_id;
                        $cart['voucher']       = $voucher;
                        $cal_amount            = $this->calAmount($voucher, $cart['total_price']);
                        $cart['amount']        = $cal_amount['amount'];
                        $cart['voucher_price'] = $cal_amount['voucher_price'];

                        $request->session()->flash('success', trans('Successfully applied!'));
                    }else{
                        $request->session()->flash('danger', trans('Not eligible to apply this voucher!'));
                    }
                }
            }else{
                $cart['voucher']       = null;
                $cart['voucher_price'] = 0;
                $cart['voucher_id']    = null;
                $cart['amount']        = $cart['total_price'];
            }
            $request->session()->put('cart', $cart);

            return redirect()->back();
        }else{
            if(isset($request->cart_item)){
                $cart_item_key = $request->cart_item;
                $cart_item     = $cart['items'][$cart_item_key];
                if(isset($request->quantity)){
                    $cart_item['quantity']         = $request->quantity;
                    $cart_item['final_price']      = $request->quantity * (int)$cart_item['price'];
                    $cart['items'][$cart_item_key] = $cart_item;
                }else{
                    if(isset($request->remove) && $request->remove){
                        unset($cart['items'][$cart_item_key]);
                    }
                }
            }

            $cart['total_price'] = array_sum(array_column($cart['items'], 'final_price'));
            $cart['amount']      = $cart['total_price'];
            if(!empty($cart['voucher'])){
                $voucher               = $cart['voucher'];
                $cart['voucher_price'] = (float)($voucher->value ?? 0);
                $cal_amount            = $this->calAmount($voucher, $cart['total_price']);
                $cart['amount']        = $cal_amount['amount'];
                $cart['voucher_price'] = $cal_amount['voucher_price'];
            }

            $cart['quantity'] = array_sum(array_column($cart['items'], 'quantity'));
        }

        $request->session()->put('cart', $cart);

        return [
            "voucher_name" => $voucher->name ?? NULL,
            "quantity"     => $cart['quantity'],
            "price"        => "$" . moneyFormat($cart['amount'] ?? 0, false)
        ];
    }

    /**
     * @param $voucher
     * @param $amount
     * @return float|int|mixed
     */
    public function calAmount($voucher, $amount){
        if($voucher->type == Voucher::TYPE_DOLLAR){
            $voucher_price = (float)$voucher->value;
        }else{
            $voucher_price = ($amount * (float)$voucher->value / 100);
        }
        $data = $amount - $voucher_price;
        if($data < 0){
            $data = (float)0;
        }

        return [
            'amount'        => $data,
            'voucher_price' => $voucher_price
        ];
    }
}
