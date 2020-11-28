<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollectionStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'project_id'                      => 'required | numeric',
            'amount'                          => 'required | numeric',
        ];
    }

    public function messages()
    {
        return [
            'project_id.required'             => __('common.Select').' '.__('common.Client'),          
            'project_id.numeric'              => __('common.Select').' '.__('common.Client'),          
            'amount.required'                 => __('common.Amount').' ('.__('common.required').')',          
            'amount.numeric'                  => __('common.Amount').' '.__('common.Must').' '.__('common.Be').' '.__('common.Numeric'),          
        ];
    }
}
