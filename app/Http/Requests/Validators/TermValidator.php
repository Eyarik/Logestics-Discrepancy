<?php

namespace App\Http\Requests\Validators;

use Illuminate\Foundation\Http\FormRequest;

class TermValidator extends FormRequest
{
   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'partial_shipment'=>'required',
            'trans_shipment'=>'required',
            'lc_type'=>'required',
            'frieght_payment'=>'required'
        ];
    }
}
