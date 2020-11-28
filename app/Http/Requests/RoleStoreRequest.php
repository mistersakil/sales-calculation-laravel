<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'                          => 'required|unique:roles,name,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required'                 => __('common.Role').' '.__('common.Name').' ('.__('common.required').')',          
            'name.unique'                   => __('common.Name').' '.__('common.Already').' '.__('common.Exist'),          
        ];
    }
}
