<?php

namespace App\Http\Requests\Validators;

use Illuminate\Foundation\Http\FormRequest;

class ItemValidator extends FormRequest
{
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
'item_description'=>'required',
'PI'=>'required',
'consignee_id'=>'required',
'air_discharge_id'=>'required',
'sea_discharge_id'=>'required',
'air_loading_id'=>'required',
'sea_loading_id'=>'required',
'bank_detail_id'=>'required',
'owner_id'=>'required',
'shipment_mode_id'=>'required',
'term_id'=>'required',
        ];
    }
}
