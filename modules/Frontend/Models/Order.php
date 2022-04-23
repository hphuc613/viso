<?php

namespace Modules\Frontend\Models;

use Illuminate\Support\Str;
use Modules\Order\Models\Order as OrderBase;
use Modules\Order\Models\OrderDetail;
use Modules\Product\Models\ProductCapacity;
use Modules\Voucher\Models\VoucherMember;

class Order extends OrderBase{

    /**
     * @param $data
     * @param $shipping
     * @param $payment
     * @param $cart
     * @return Order
     */
    public static function createOrder($data, $shipping, $payment, $cart, $member_id){
        $order                   = new Order();
        $order->code             = Str::random(8);
        $order->member_id        = $member_id;
        $order->member_name      = $data['name'];
        $order->member_last_name = $data['last_name'];
        $order->address          = $data['address'];
        $order->email            = $data['email'];
        $order->phone            = $data['phone'];
        $order->shipping_id      = $shipping->id;
        $order->shipping_name    = $shipping->name;
        $order->shipping_price   = $shipping->value;
        if(!empty($cart['voucher'])){
            $voucher              = $cart['voucher'];
            $order->voucher_id    = $voucher->id;
            $order->voucher_name  = $voucher->name;
            $order->voucher_value = $cart['voucher_price'];
            $voucher_member       = VoucherMember::query()->find($cart['voucher_id']);
            if(!empty($voucher_member)){
                $voucher_member->delete();
            }
        }

        $order->total_price       = array_sum(array_column($cart['items'], 'final_price'));
        $order->amount            = $cart['amount'] + $shipping->value;
        $order->payment_method_id = $payment->id;

        return $order;
    }


    /**
     * @param $cart
     * @param $order
     */
    public static function createOrderDetail($cart, $order){
        $order_detail_data = [];
        $product_base      = Product::query();
        $capacity_base     = ProductCapacity::query();

        foreach($cart['items'] as $key => $item){
            $product_item = $item['product'];
            if(!isset($item['capacity']) && empty($item['capacity'])){
                $product           = clone $product_base;
                $product           = $product->find($product_item->id);
                $product->stock_in = (int)$product->stock_in - $item['quantity'];
                $product->save();
            }else{
                $capacity           = clone $capacity_base;
                $capacity           = $capacity->find($item['capacity_id']);
                $capacity->stock_in = (int)$capacity->stock_in - $item['quantity'];
                $capacity->save();
            }
            $order_detail_data[$key]['product_id']    = $product_item->id;
            $order_detail_data[$key]['product_name']  = $product_item->name;
            $order_detail_data[$key]['product_price'] = $item['price'];
            $order_detail_data[$key]['price']         = $item['price'];
            $order_detail_data[$key]['quantity']      = $item['quantity'];
            $order_detail_data[$key]['capacity']      = $item['capacity'] ?? NULL;
            $order_detail_data[$key]['amount']        = $item['final_price'];
            $order_detail_data[$key]['order_id']      = $order->id;

        }

        OrderDetail::query()->insert($order_detail_data);
    }
}
