<?php

namespace Modules\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeOptionRequest extends FormRequest{
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
        $method = segmentUrl(3);
        switch($method){
            default:
                return [
                    'name'         => 'required|validate_unique:attribute_options',
                    'attribute_id' => 'required'
                ];
                break;
            case "update":
                return [
                    'name'         => 'required|validate_unique:attribute_options,' . $this->id,
                    'attribute_id' => 'required'
                ];
                break;
        }
    }

    public function messages(){
        return [
            'required'        => ':attribute' . trans(' can not be empty.'),
            'validate_unique' => ':attribute' . trans(' was exist.'),
        ];
    }

    public function attributes(){
        return [
            'name'         => trans('Name'),
            'attribute_id' => trans('Attribute'),
        ];
    }
}
