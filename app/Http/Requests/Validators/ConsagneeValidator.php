<?php

namespace App\Http\Requests\Validators;

use Illuminate\Foundation\Http\FormRequest;

class ConsagneeValidator extends FormRequest
{
   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'bank_name'=>'required',
            'address'=>'required',
            'tf_number'=>'required',
            'permit_number'=>'required',
        ];
    }
}
