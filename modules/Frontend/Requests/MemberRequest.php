<?php

namespace Modules\Frontend\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest{

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
            'email'             => 'required|email|validate_unique:members,' . auth('web')->id(),
            'phone'             => 'required|digits:8|validate_unique:members,' . auth('web')->id(),
            'password'          => 'min:8|nullable|regex:/^.*(?=.{2,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x]).*$/',
            'password_re_enter' => 're_enter_password|required_with:password',
        ];
    }

    public function messages(){
        return [
            'required'           => ':attribute' . trans(' can not be empty.'),
            'email'              => ':attribute' . trans(' must be the email.'),
            'min'                => ':attribute' . trans('  at least 8 characters.'),
            're_enter_password'  => trans('Wrong password'),
            'required_with'      => ':attribute' . trans(' can not be empty.'),
            'validate_unique'    => ':attribute' . trans(' was exist.'),
            'regex'              => ':attribute' . trans(' must contain English letters and numbers.'),
            'image'              => ':attribute' . trans(' must be an image.'),
            'digits'             => ':attribute' . trans(' must be 8 digits.'),
            'mimes'              => ':attribute' .
                trans(' extention must be one of the following: jpeg, png, jpg, gif, svg.'),
            'check_exist'        => ':attribute' . trans(' does not exist.'),
            'date_format_custom' => ':attribute' . trans(' must be in the format dd-mm-yyyy.'),
        ];
    }

    public function attributes(){
        return [
            'email'             => trans('Email'),
            'password'          => trans('Password'),
            'password_re_enter' => trans('Re-enter Password'),
            'name'              => trans('Name'),
            'last_name'         => trans('Last name'),
            'username'          => trans('Username'),
            'phone'             => trans('Phone'),
            'avatar'            => trans('Avatar'),
            'birthday'          => trans('Birthday')
        ];
    }
}
