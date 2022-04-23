<?php

namespace Modules\Frontend\Controllers;

use App\AppHelpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Base\Models\Status;
use Modules\Feedback\Models\Feedback;
use Modules\Frontend\Models\Frontend;
use Modules\Order\Models\OrderDetail;
use Modules\Page\Models\Home;
use Modules\Product\Models\Product;
use Modules\Voucher\Models\Voucher;
use Modules\Voucher\Models\VoucherMember;

class HomeController extends Controller{

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->auth = auth('web');
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request){
        $popular_products = Product::query();
        $ids              = OrderDetail::query()
                                       ->select('product_id', DB::raw('SUM(quantity)  AS sum_qty'))
                                       ->groupBy('product_id')
                                       ->orderBy('sum_qty', 'desc')
                                       ->limit(8)
                                       ->pluck('product_id')->toArray();

        $popular_products  = $popular_products->whereIn('id', $ids)->get()->take(3);
        $product_query     = Product::query();
        $discover_products = clone $product_query;
        $discover_products = $discover_products->get()->take(6);
        if(empty($popular_products)){
            $popular_products = clone $product_query;
            $popular_products = $popular_products->get()->take(3);
        }

        $data      = Home::getWebsiteConfig();
        return view("Frontend::home", compact('popular_products', 'discover_products', 'data'));
    }


    /**
     * @return string
     */
    public function pointReward() {
        $member  = Auth::guard('web')->user();
        $voucher = [];
        if (Auth::guard('web')->check()) {
            $voucher = VoucherMember::with('voucher')
                                    ->where('member_id', $member->id)
                                    ->where('voucher_id', '!=', null)
                                    ->limit(5)->get();
        }

        $hot_voucher = Voucher::query()->where('type_id', '=', Voucher::TYPE_OTHER)
                              ->where('status', Status::STATUS_ACTIVE)
                              ->orderBy('point_redeem')
                              ->limit(5)->get();

        return view('Frontend::modal.point', compact('member', 'voucher', 'hot_voucher'))->render();
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getApplyVoucher(Request $request){
        $logo       = Helper::getSetting('LOGO');
        $cart       = $request->session()->get('cart');
        $data       = VoucherMember::with('voucher')
                                   ->where('member_id', $this->auth->id())
                                   ->where('voucher_id', '!=', null);
        if(isset($cart['voucher_id'])){
            $data = $data->where('id', '!=', $cart['voucher_id']);
        }
        $data = $data->paginate(15);

        return view('Frontend::modal.apply_voucher', compact('logo', 'data'))->render();
    }
}
