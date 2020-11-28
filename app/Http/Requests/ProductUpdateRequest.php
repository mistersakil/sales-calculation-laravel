<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'category_id'               => 'bail | required | numeric',
            'brand_id'                  => 'bail | required | numeric',
            'quantity'                  => 'bail | required | numeric',
            'quantity'                  => 'bail | required | numeric',
            'price'                     => 'bail | required | numeric',
            'sale_price'                => 'bail | nullable | numeric',
            'name'                      => 'bail | required | string | max:200 | min: 5',
            'body'                      => 'bail | required | string | min: 10',            
            'image'                     => 'nullable |  max:4 ',            
            'image.*'                   => 'mimes:jpeg, png, gif | max: 200 | dimensions:width=440,height=590',
        ];
    }

    public function messages()
    {
        return [
            'name.required'             => __('common.NAME_REQUIRED'),
            'name.max'                  => __('common.NAME_MAX'),
            'name.min'                  => __('common.NAME_MIN'),
            'name.string'               => __('common.NAME_STRING'),
            'body.required'             => __('common.BODY_REQUIRED'),
            'body.max'                  => __('common.BODY_MAX'),
            'body.min'                  => __('common.BODY_MIN'),
            'body.string'               => __('common.BODY_STRING'),
            'image.max'                 => __('common.PRODUCT_IMAGE_MAX_FILE_COUNT_4'),
            'image.*.mimes'             => __('common.PRODUCT_IMAGE_MIMES'),            
            'image.*.max'               => __('common.PRODUCT_IMAGE_MAX_SIZE'),            
            'image.*.dimensions'        => __('common.PRODUCT_IMAGE_DIMENSIONS'),          
            'category_id.required'      => __('common.CATEGORY_ID_REQUIRED'),          
            'brand_id.required'         => __('common.BRAND_ID_REQUIRED'),          
            'quantity.required'         => __('common.QUANTITY_REQUIRED'),          
            'quantity.numeric'          => __('common.QUANTITY_NUMERIC'),           
            'price.required'            => __('common.PRICE_REQUIRED'),          
            'price.numeric'             => __('common.PRICE_NUMERIC'),                
            'sale_price.numeric'        => __('common.SALE_PRICE_NUMERIC'),          
        ];
    }
}
