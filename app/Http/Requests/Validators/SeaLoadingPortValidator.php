<?php

namespace App\Http\Requests\Validators;

use Illuminate\Foundation\Http\FormRequest;

class SeaLoadingPortValidator extends FormRequest
{
   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'country'=>'required',
            'port_name'=>'required',
            'code'=>'required',
            'origin_id'=>'required',
        ];
    }
}
