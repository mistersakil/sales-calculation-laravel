<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeUpdateRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'name'              => 'required | string | max:50 | min: 2 | unique:categories',
            'attribute_values'  => 'required | string | min:2',
        ];
    }

    public function messages()
    {
        return [
            'name.required'             => __('common.NAME_REQUIRED_LENGTH_5_50'),
            'name.unique'               => __('common.NAME_UNIQUE'),
            'name.max'                  => __('common.NAME_MAX_50'),
            'name.min'                  => __('common.NAME_MIN_2'),
            'attribute_values.required' => __('common.ATTRIBUTE_VAL_MIN_5'),
            'attribute_values.min'      => __('common.NAME_MIN_2'),

        ];
    }
}
