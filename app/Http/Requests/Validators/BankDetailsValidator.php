<?php

namespace App\Http\Requests\Validators;

use Illuminate\Foundation\Http\FormRequest;

class BankDetailsValidator extends FormRequest
{
   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'account_holder'=>'required',
            'iban_number'=>'required',
            'swift_code'=>'required',
            'account_number'=>'required',
            'beneficiary_bank_name'=>'required',
        ];
    }
}
