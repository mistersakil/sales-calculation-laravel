<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'                  => 'bail|required|unique:products,name,'.$this->id,
            'code'                  => 'bail|required|unique:products,code,'.$this->id
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => __('common.Product').' '.__('common.Name')   .' '.__('common.required'),
            'name.unique'           => __('common.Product').' '.__('common.Already').' '.__('common.Exist'),
            'code.required'         => __('common.Product').' '.__('common.Code')   .' '.__('common.required'),
            'code.unique'           => __('common.Product')   .' '.__('common.Code')   .' '.__('common.Already').' '.__('common.Exist'),
        ];
    }
}
