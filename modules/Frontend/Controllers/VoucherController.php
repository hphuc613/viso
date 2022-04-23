<?php

namespace Modules\Frontend\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Member\Models\Member;
use Modules\Voucher\Models\Voucher;
use Modules\Voucher\Models\VoucherMember;


class VoucherController extends Controller {

    public function registerEmail(Request $request) {

        $data   = $request->all();
        $member = Member::query()->where('email', $data['email'])->first();

        if ($member) {
            $voucher = Voucher::query()->where('type_id', Voucher::TYPE_REGISTER)->first();
            VoucherMember::query()->create(['member_id' => $member->id, 'voucher_id' => $voucher->id ?? null]);

            $request->session()->flash('success', trans('Registration successfully'));
            return redirect()->back();
        }
        $request->session()->flash('danger', trans('This email is not registered'));
        return redirect()->back();
    }

    public function redeemVoucher(Request $request, $key_slug) {
        $voucher = Voucher::query()->where('key_slug', $key_slug)->first();
        if (!$voucher) {
            $request->session()->flash('danger', trans('Whoops! The gift voucher does not exist'));
            return redirect()->back();
        }
        if (isset($voucher->quantity)) {
            if ($voucher->quantity < 1) {
                $request->session()->flash('danger', trans('Unlucky! The gift voucher has expired'));
                return redirect()->back();
            } else {
                $voucher->quantity -= 1;
                $voucher->save();
            }
        }
        $member = Auth::guard('web')->user();
        $voucher_member = VoucherMember::query()->create(['member_id' => $member->id, 'voucher_id' => $voucher->id ?? null]);
        if(!$voucher_member){
            $voucher->quantity += 1;
            $voucher->save();
            $request->session()->flash('danger', trans('Whoops! Looks like something went wrong'));
            return redirect()->back();
        }
        $member->point -= $voucher->point_redeem;
        $member->save();
        $request->session()->flash('success', trans('Successfully redeem'));
        return redirect()->back();
    }
}
