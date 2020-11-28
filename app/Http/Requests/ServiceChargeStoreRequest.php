<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceChargeStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'project_id'                      => 'required | numeric | unique:service_charges,project_id,'.$this->id,
            'amount'                          => 'required | numeric',
            'pay_schedule'                    => 'required | numeric',
            'status'                          => 'required | numeric',
        ];
    }

    public function messages()
    {
        return [
            'project_id.required'             => __('common.Select').' '.__('common.Client'),          
            'project_id.numeric'              => __('common.Select').' '.__('common.Client'),          
            'project_id.unique'               => __('common.Client').' '.__('common.Already').' '.__('common.Exist'),          
            'pay_schedule.required'           => __('common.Pay').' '.__('common.Schedule').' '.__('common.required'),          
            'status.required'                 => __('common.Status').' '.__('common.required'),          
            'amount.required'                 => __('common.Amount').' '.__('common.required'),          
            'amount.numeric'                  => __('common.Amount').' '.__('common.Must').' '.__('common.Be').' '.__('common.Numeric'),          
        ];
    }
}
