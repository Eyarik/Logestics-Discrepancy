<?php

namespace App\Http\Requests\Validators;

use Illuminate\Foundation\Http\FormRequest;

class OwnerValidator extends FormRequest
{
   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'client_name'=>'required',
            'address'=>'required',
            'tin_number'=>'required',
            'attn_name'=>'required',
            'attn_phone_number'=>'required',
            'attn_email'=>'required',
        ];
    }
}
