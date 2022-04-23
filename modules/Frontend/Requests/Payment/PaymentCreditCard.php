<?php

namespace Modules\Frontend\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PaymentCreditCard extends FormRequest{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'number'        => 'required',
            'exp_month'     => 'required',
            'security_code' => 'required',
        ];
    }

    public function messages(){
        return [
            'required' => ':attribute' . trans(' can not be empty.'),
        ];
    }

    public function attributes(){
        return [
            'number'        => trans('Card number'),
            'exp_month'     => trans('Expiration date'),
            'security_code' => trans('Security code'),
        ];
    }
}
