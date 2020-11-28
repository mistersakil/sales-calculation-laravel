<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeStoreRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        return [
            'name'              => 'required | string | max:50 | min: 2 | unique:attributes',
            'attribute_values'  => 'required | string | min:2',
        ];
    }

    public function messages()
    {
        return [
            'name.required'             => __('common.NAME_REQUIRED_LENGTH_2_50'),
            'name.unique'               => __('common.NAME_UNIQUE'),
            'name.max'                  => __('common.NAME_MAX_50'),
            'name.min'                  => __('common.NAME_MIN_2'),
            'attribute_values.required' => __('common.ATTRIBUTE_REQUIRED_VAL_MIN_2'),
            'attribute_values.min'      => __('common.ATTRIBUTE_REQUIRED_VAL_MIN_2'),

        ];
    }
}
