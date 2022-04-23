<?php

namespace Modules\Frontend\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Modules\Frontend\Requests\MemberRequest;
use Modules\Member\Models\Member;

class AccountController extends Controller{
    /**
     * @var \Illuminate\Contracts\Auth\Factory|Guard|StatefulGuard
     */
    private $auth;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->auth = auth('web');
    }

    /**
     * @return Application|Factory|View|RedirectResponse
     */
    public function getProfile() {
        if (!$this->auth->check()) {
            return redirect()->back();
        }

        return view('Frontend::account.profile');
    }

    /**
     * @param MemberRequest $request
     * @return RedirectResponse
     */
    public function postProfile(MemberRequest $request) {
        if ($request->post()) {
            $data   = $request->all();
            $member = Member::query()->find($this->auth->id());
            if (empty($data['password'])) {
                unset($data['password']);
            }
            $member->update($data);
            $request->session()->flash('success', trans('Updated successfully.'));
        }

        return redirect()->back();
    }

    /**
     * @return Factory|View|RedirectResponse
     */
    public function getDeliveryAddress(){
        if (!$this->auth->check()) {
            return redirect()->back();
        }

        return view('Frontend::account.delivery_address');
    }
}
