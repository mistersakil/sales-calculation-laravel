<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'contact_person'                => 'required',
            'country_id'                    => 'required | numeric',
            'name'                          => 'required',
            'status'                        => 'required | numeric',
        ];
    }

    public function messages()
    {
        return [
            'contact_person.required'       => __('common.contact person').' '.__('common.required'),        
            'country_id.required'           => __('common.country').' '.__('common.required'),        
            'name.required'                 => __('common.Client').' '.__('common.name').' '.__('common.required'),        
            'status.required'               => __('common.publish type').' '.__('common.required'),        
        ];
    }
}
