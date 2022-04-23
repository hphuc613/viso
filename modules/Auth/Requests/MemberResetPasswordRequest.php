<?php

namespace Modules\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MemberResetPasswordRequest extends FormRequest{

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
            'password'          => 'required|min:8',
            'password_re_enter' => 're_enter_password|required_with:password',
        ];
    }

    public function messages(){
        return [
            'required'          => ':attribute' . trans(' can not be empty.'),
            'min'               => ':attribute' . trans('  too short.'),
            're_enter_password' => trans('Wrong password'),
            'required_with'     => ':attribute' . trans(' can not be empty.'),
        ];
    }

    public function attributes(){
        return [
            'password'          => trans('Password'),
            'password_re_enter' => trans('Confirm Password'),
        ];
    }
}
