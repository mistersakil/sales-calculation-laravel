<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectStoreRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'advance_amount'                => 'nullable | numeric',
            'advance_receive_date'          => 'nullable',
            'agreement_date'                => 'required',
            'client_id'                     => 'required',
            'end_date'                      => 'nullable',
            'unit'                          => 'required',
            'product_id'                    => 'required',
            'progress'                      => 'required',
            'status'                        => 'required',
            'start_date'                    => 'nullable',
            'total_amount'                  => 'required | numeric',
            'vat_amount'                    => 'nullable',
            'vat_type'                      => 'required',
        ];
    }

    public function messages()
    {
        return [
            'advance_amount.numeric'         => __('common.advance amount numeric'),        
            'agreement_date.required'        => __('common.po date required'),        
            'client_id.required'             => __('common.please select client'),        
            'product_id.required'            => __('common.please select product'),        
            'progress.required'              => __('common.progress').' '.__('common.status').' ('.__('common.required').')',        
            'status.required'                => __('common.status').' ('.__('common.required').')',       
            'total_amount.required'          => __('common.total amount required'),        
            'total_amount.numeric'           => __('common.total amount numeric'),        
            'vat_type.required'              => __('common.please select vat type'),        
        ];
    }
}
