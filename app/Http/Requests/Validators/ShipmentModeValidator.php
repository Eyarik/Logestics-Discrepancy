<?php

namespace App\Http\Requests\Validators;

use Illuminate\Foundation\Http\FormRequest;

class ShipmentModeValidator extends FormRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'shipment_mode'=>'required'
        ];
    }
}
