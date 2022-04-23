<?php

namespace Modules\Frontend\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PaymentInfoRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name'      => 'required',
            'last_name' => 'required',
            'address'   => 'required',
            'apartment' => 'required',
            'district'  => 'required',
            'phone'     => 'required|size:8',
            'email'     => 'required|email',
        ];
    }

    public function messages() {
        return [
            'required' => ':attribute' . trans(' can not be empty.'),
            'size'     => ':attribute' . trans(' must be 8 characters.'),
            'email'    => ':attribute' . trans(' must be the email.'),
        ];
    }

    public function attributes() {
        return [
            'name'      => trans('First Name'),
            'last_name' => trans('Last Name'),
            'address'   => trans('Address'),
            'apartment' => trans('Apartment'),
            'district'  => trans('District'),
            'phone'     => trans('Phone'),
            'email'     => trans('Email'),
        ];
    }
}
