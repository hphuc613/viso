<?php

namespace Modules\Frontend\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Modules\Base\Models\Status;
use Modules\Frontend\Requests\MemberRequest;
use Modules\Member\Models\Member;
use Modules\Order\Models\Order;
use Modules\Voucher\Models\Voucher;
use Modules\Voucher\Models\VoucherMember;


class MemberController extends Controller {
    protected $auth;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->auth = Auth::guard('web');
    }

    /**
     * @return Application|Factory|View|RedirectResponse
     */
    public function getVoucher() {
        if (!$this->auth->check()) {
            return redirect()->back();
        }
        $member = $this->auth->user();
        $data   = VoucherMember::with('voucher')
                               ->where('member_id', $member->id)
                               ->where('voucher_id', '!=', null)
                               ->paginate(15);

        $hot_voucher = Voucher::query()->where('type_id', '=', Voucher::TYPE_OTHER)
                              ->where('status', Status::STATUS_ACTIVE)
                              ->orderBy('point_redeem')
                              ->paginate(15);
        return view('Frontend::member.voucher', compact('data', 'hot_voucher', 'member'));
    }

    /**
     * @return Application|Factory|View|RedirectResponse
     */
    public function getOrder() {
        if (!$this->auth->check()) {
            return redirect()->back();
        }
        $data = Order::with('orderDetails')
                     ->orderBy('created_at', 'desc')
                     ->paginate(5);

        return view('Frontend::member.order', compact('data'));
    }

    /**
     * @param $key_slug
     * @return Factory|View|RedirectResponse
     */
    public function getVoucherDetail($key_slug) {
        if (!$this->auth->check()) {
            return redirect()->back();
        }
        $data = Voucher::query()->where('key_slug', $key_slug)->first();
        if (!$data)
            return redirect()->route('get.home.index');
        $data->product_ids = Voucher::getProductList($data->product_ids);
        $member            = $this->auth->user();

        return view('Frontend::member.voucher_detail', compact('data', 'member'));
    }

    /**
     * @param $id
     * @return string
     */
    public function getOrderDetail($id) {
        $data = Order::query()
                     ->with(['orderDetails' => function ($od) {
                             $od->with('product');
                         }])
                     ->find($id);

        return view("Frontend::member.order_detail", compact("data"))->render();
    }
}
