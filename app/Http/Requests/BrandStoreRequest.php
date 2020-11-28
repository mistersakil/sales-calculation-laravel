<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'              => 'bail | required | string  | min:2  | unique:brands',
            'image'             => 'bail | nullable | image |  max: 50 | dimensions:min_width=150,min_height=150,ratio=0/0',
            'image.*'           => 'mimes:jpeg,png,jpg',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => __('common.BRAND_NAME_REQUIRED'),
            'name.unique'       => __('common.BRAND_NAME_EXIST'),
            'name.min'          => __('common.NAME_MIN_2'),
            'image.*.mimes'     => __('common.IMAGE_MIMES_JPG_PNG_GIF_BMP'),
            'image.max'         => __('common.IMAGE_MAX_SIZE_50'),
            'image.dimensions'  => __('common.IMAGE_DIMENSION_EQUAL'),
            'image.image'       => __('common.IMAGE_IMAGE'),

        ];
    }
}
