<?php

namespace Modules\Store\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest{
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
        $method = segmentUrl(2);
        if($method == "update"){
            return [
                'name'   => 'required|validate_unique:stores,' . $this->id,
                'status' => 'required',
            ];
        }

        return [
            'name'   => 'required|validate_unique:stores',
            'status' => 'required'
        ];
    }

    public function messages() {
        return [
            'required'        => ':attribute' . trans(' can not be empty.'),
            'validate_unique' => ':attribute' . trans(' was exist.')
        ];
    }

    public function attributes() {
        return [
            'name'        => trans('Name'),
            'status'      => trans('Status')
        ];
    }
}
