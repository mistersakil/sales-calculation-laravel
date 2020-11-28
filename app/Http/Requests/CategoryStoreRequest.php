<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'              => 'required | string | max:50 | min: 2 | unique:categories',
            'body'              => 'nullable | string | max:250',
            'image'             => 'nullable | max: 500 | dimensions:min_width=1920,min_height=320',
            'image.*'           => 'mimes:jpeg,png',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => __('common.NAME_REQUIRED_LENGTH_5_50'),
            'name.unique'       => __('common.NAME_UNIQUE'),
            'name.max'          => __('common.NAME_MAX_50'),
            'name.min'          => __('common.NAME_MIN_5'),
            'image.*.mimes'     => __('common.IMAGE_MIMES_JPG_PNG'),
            'image.max'         => __('common.IMAGE_MAX_SIZE_500'),
            'image.dimensions'  => __('common.IMAGE_DIMENSION_1920_320'),
            'body.max'          => __('common.BODY_MAX_LENGTH_250'),
            'body.string'       => __('common.BODY_STRING'),

        ];
    }
}
