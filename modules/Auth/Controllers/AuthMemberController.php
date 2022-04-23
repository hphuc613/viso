<?php

namespace Modules\Auth\Controllers;

use App\AppHelpers\Helper;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Modules\Auth\Requests\AuthMemberRequest;
use Modules\Auth\Requests\MemberResetPasswordRequest;
use Modules\Base\Models\Status;
use Modules\Member\Models\Member;
use never;

class AuthMemberController extends Controller{

    protected $auth;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->auth = Auth::guard('web');
    }

    /**
     * @return string
     */
    public function loginPage(){
        if($this->auth->check()){
            return redirect()->route('get.home.index');
        }
        return view('Auth::frontend.login');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|string
     */
    public function login(Request $request){
        if($this->auth->check()){
            return redirect()->route('get.home.index');
        }
        if($request->post()){
            $credentials               = $request->only('email', 'password');
            $credentials['deleted_at'] = null;
            session()->put('login', ['email' => $credentials['email']]);

            if($this->auth->attempt($credentials, $request->has('remember_me'))){
                if($this->auth->user()->status != Status::STATUS_ACTIVE || empty($this->auth->user()->email_verified_at)){
                    $request->session()->flash('danger',
                        trans('Your account is not verified or inactive. Please contact with admin page to get more information.'));
                    $this->auth->logout();
                }else{
                    $request->session()->flash('success', trans('Logged In Successfully!'));

                    return redirect()->route('get.home.index');
                }
            }else{
                $request->session()->flash('danger', trans('Incorrect username or password'));
            }

            return redirect()->back();
        }

        return view('Auth::frontend._form_login')->render();
    }

    /**
     * @return RedirectResponse|string
     */
    public function getRegister(Request $request){
        if($this->auth->check() || !$request->ajax()){
            return redirect()->route('get.home.index');
        }

        return view('Auth::frontend._form_register')->render();
    }

    /**
     * @param AuthMemberRequest $request
     * @return array
     */
    public function postRegister(AuthMemberRequest $request){
        $data = $request->all();
        unset($data['agree']);
        $data               = new Member($data);
        $data->username     = Str::random(8);
        $data->contact_info = Str::random(21);

        try{
            $data->save();
            $mail_to = $request->email;
            $subject = 'Verify account';
            $title   = 'Verify account';
            $body    = '<p>' . trans('Please click the button below to verify') . '</p>';
            $body    .= '<a href="' . route('get.home.email_verify', ['verify_code' => $data->contact_info]) . '" style="border: none; text-decoration: none; padding: 10px 32px; color: white; background-color: #008CBA;">' . trans('Verify') . '</a>';
            Helper::sendMail($mail_to, $subject, $title, $body);

        }catch(Exception $exception){
            return ['status' => 400, 'msg' => trans('Something went wrong!')];
        }

        return ['status' => 200];
    }

    /**
     * @param Request $request
     * @return RedirectResponse|never
     */
    public function getEmailVerify(Request $request){
        $data = Member::query()->where('contact_info', $request->verify_code)->first();
        if(empty($request->verify_code) || empty($data) || !empty($data->email_verified_at)){
            return abort(404);
        }
        $data->contact_info      = NULL;
        $data->email_verified_at = time();
        $data->update();
        $this->auth->loginUsingId($data->id);

        $request->session()->flash('success', 'Verified and Logged in Successfully');

        return redirect()->route('get.home.index');
    }


    /**
     * @param Request $request
     * @return RedirectResponse|string
     */
    public function forgotPassword(Request $request){
        if($this->auth->check() || !$request->ajax()){
            return redirect()->route('get.home.index');
        }

        if($request->post()){
            $member = Member::query()->where('email', $request->email)->first();

            if(!empty($member)){
                if(empty($member->email_verified_at)){
                    $request->session()->flash('danger', trans('Your account is not verified.'));
                }else{
                    $member->contact_info = Str::random(6);
                    $member->save();
                    $body = '';
                    $body .= '<div><a href="' . route('get.home.resetPassword', ['reset_code' => $member->contact_info]) . '" style="border: none; text-decoration: none; padding: 10px 32px; color: white; background-color: #008CBA;">' . trans('Reset Password') . '</a></div>';
                    $send = Helper::sendMail($member->email, trans('Reset password'), trans('Reset password'), $body);
                    if($send){
                        $request->session()
                                ->flash('success', trans('Send email successfully. Please check your email'));
                    }else{
                        $request->session()->flash('danger', trans('Can not send email. Please contact with admin.'));
                    }
                }
            }else{
                $request->session()->flash('danger', trans('Your email not exist.'));
            }

            return redirect()->back();
        }

        return view('Auth::frontend.forgot_password');
    }

    /**
     * @param Request $request
     * @return Factory|View|never
     */
    public function getResetPassword(Request $request){
        $data = Member::query()->where('contact_info', $request->reset_code)->first();
        if(empty($request->reset_code) || empty($data)){
            return abort(404);
        }

        return view('Auth::frontend.reset_password');
    }

    /**
     * @param MemberResetPasswordRequest $request
     * @return array
     */
    public function postResetPassword(MemberResetPasswordRequest $request){
        $member               = Member::query()->where('contact_info', $request->reset_code)->first();
        $data                 = $request->all();
        $data['contact_info'] = NULL;
        unset($data['reset_code']);
        unset($data['password_re_enter']);
        if(empty($request->reset_code) || empty($member)){
            return ['status' => 400];
        }
        $member->update($data);

        return ['status' => 200];
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request){
        $this->auth->logout();
        $request->session()->flash('success', trans('Logged Out Successfully!'));

        return redirect()->route('get.home.index');
    }
}
