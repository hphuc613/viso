<?php

namespace Modules\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest{
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
        $segment = segmentUrl(2);
        if($segment == 'update'){
            return [
                'sku'         => 'required|validate_unique:products,' . $this->id,
                'name'        => 'required',
                'capacity'    => 'required',
                'description' => 'required',
                'price'       => 'required',
                'status'      => 'required',
                'cate_id'     => 'required',
                'brand_id'    => 'required',
                'stock_in'    => 'required',
                'image'       => 'image|mimes:jpeg,png,jpg,gif,svg',
            ];
        }

        return [
            'name'        => 'required',
            'sku'         => 'required|validate_unique:products',
            'capacity'    => 'required',
            'description' => 'required',
            'price'       => 'required',
            'status'      => 'required',
            'cate_id'     => 'required',
            'brand_id'    => 'required',
            'stock_in'    => 'required',
            'image'       => 'image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }

    /**
     * @return array
     */
    public function messages(){
        return [
            'required'         => ':attribute' . trans(' can not be empty.'),
            'validate_unique'  => ':attribute' . trans(' was exist.'),
            'cate_id.required' => trans('Please select ') . ':attribute',
            'status.required'  => trans('Please select ') . ':attribute',
            'image'            => ':attribute' . trans(' must be an image.'),
            'mimes'            => ':attribute' .
                trans(' extention must be one of the following: jpeg, png, jpg, gif, svg.'),
        ];
    }

    /**
     * @return array
     */
    public function attributes(){
        return [
            'name'        => trans('Name'),
            'price'       => trans('Price'),
            'status'      => trans('Status'),
            'cate_id'     => trans('Category'),
            'brand_id'    => trans('Brand'),
            'image'       => trans('Image'),
            'sku'         => trans('SKU'),
            'stock_in'    => trans('Stock In'),
            'capacity'    => trans('Capacity'),
            'description' => trans('Description'),
        ];
    }
}
