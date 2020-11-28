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
            'name'              => 'required | string  | min:2  | unique:categories',
            'image'             => 'nullable | max: 50 | dimensions:width=150,height=150',
            'image.*'           => 'mimes:jpeg,png,gif,bmp',
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
            'image.dimensions'  => __('common.IMAGE_DIMENSION_150_150'),

        ];
    }
}
