<?php

namespace Modules\Setting\Controllers;

use App\AppHelpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Setting\Models\MailConfig;
use Modules\Setting\Models\PaymentConfig;
use Modules\Setting\Models\Setting;
use Modules\Setting\Models\Website;

class SettingController extends Controller{

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
     * @return Factory|View
     */
    public function index(Request $request){
        return view("Setting::index");
    }

    /**
     * @param Request $request
     * @return Factory|View|RedirectResponse
     */
    public function emailConfig(Request $request){
        $post        = $request->post();
        $mail_config = MailConfig::getMailConfig();
        if($post){
            unset($post['_token']);
            foreach($post as $key => $value){
                $mail_config = MailConfig::query()->where('key', $key)->first();
                if(!empty($mail_config)){
                    $mail_config->update(['value' => $value]);
                }else{
                    $mail_config        = new MailConfig();
                    $mail_config->key   = $key;
                    $mail_config->value = $value;
                    $mail_config->save();
                }
            }

            $request->session()->flash('success', 'Updated successfully.');

            return redirect()->back();
        }

        return view("Setting::setting.email", compact('mail_config'));
    }

    /**
     * @return RedirectResponse
     */
    public function testSendMail(Request $request){
        $mail_to = MailConfig::getValueByKey(MailConfig::MAIL_ADDRESS);
        $subject = 'Test email';
        $title   = 'Test email function';
        $body    = 'We are testing email!';
        $send    = Helper::sendMail($mail_to, $subject, $title, $body);
        if($send){
            $request->session()->flash('success', 'Mail send successfully');
        }else{
            $request->session()->flash('danger', trans('Can not send email. Please check your Email config.'));
        }
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function websiteConfig(Request $request){
        $post           = $request->post();
        $website_config = Website::getWebsiteConfig();
        if($post){
            unset($post['_token']);
            foreach($post as $key => $value){
                $website_config = Website::query()->where('key', $key)->first();
                if(!empty($website_config)){
                    $website_config->update(['value' => $value]);
                }else{
                    $website_config        = new Website();
                    $website_config->key   = $key;
                    $website_config->value = $value;
                    $website_config->save();
                }
            }

            $request->session()->flash('success', 'Updated successfully.');

            return redirect()->back();
        }

        return view("Setting::setting.website", compact('website_config'));
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function pointExchange(Request $request){
        $post = $request->post();
        $data = Setting::query()->where('key', Setting::POINT)->first();
        if($post){
            if(!is_numeric($request->point)){
                $request->session()->flash('danger', 'Please enter the number.');

                return redirect()->back();
            }
            if(empty($data)){
                Setting::query()->create(['key' => Setting::POINT, 'value' => (int)$request->point]);
                $request->session()->flash('success', 'Created successfully.');
            }else{
                $data->update(['value' => (int)$request->point]);
                $request->session()->flash('success', 'Updated successfully.');
            }

            return redirect()->back();
        }

        return view("Setting::setting.point_exchange", compact('data'));
    }

    /**
     * @return Factory|View
     */
    public function getPaymentConfig(){
        $config = PaymentConfig::getStripeConfig();

        return view("Setting::setting.payment", compact('config'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function postStripeConfig(Request $request){
        $post = $request->post();
        unset($post['_token']);
        foreach($post as $key => $value){
            $stripe_config = PaymentConfig::query()->where('key', $key)->first();
            if(!empty($stripe_config)){
                $stripe_config->update(['value' => $value]);
            }else{
                $stripe_config        = new PaymentConfig();
                $stripe_config->key   = $key;
                $stripe_config->value = $value;
                $stripe_config->save();
            }
        }

        $request->session()->flash('success', 'Updated successfully.');
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function postPaypalConfig(Request $request){
        $post = $request->post();
        unset($post['_token']);
        foreach($post as $key => $value){
            $config = PaymentConfig::query()->where('key', $key)->first();
            if(!empty($config)){
                $config->update(['value' => $value]);
            }else{
                $config        = new PaymentConfig();
                $config->key   = $key;
                $config->value = $value;
                $config->save();
            }
        }

        $request->session()->flash('success', 'Updated successfully.');
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return false|RedirectResponse|string
     */
    public function getPaypalConfigAjax(Request $request){
        if(!$request->ajax()){
            return abort('404');
        }
        $config      = PaymentConfig::getStripeConfig();
        $paypal_keys = [
            'env'       => $config[PaymentConfig::PAYPAL_ENVIRONMENT] ?? "sandbox",
            'client_id' => $config[PaymentConfig::PAYPAL_CLIENT_ID] ?? "",
        ];

        return json_encode($paypal_keys);
    }
}
