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
            'pi'=>'required',
            'air_discharge_id'=>'required',
            'sea_discharge_id'=>'required',
            'air_loading_id'=>'required',
            'sea_loading_id'=>'required',
            'bank_detail_id'=>'required',
            'shipment_mode_id'=>'required',
            'consagnee_bank_name' => 'required',
            'consagnee_address' => 'required',
            'consagnee_tf_number' => 'required',
            'consagnee_permit_number' => 'required',
            'consagnee_phoneNumber' => 'required',
            'consagnee_postalCode' => 'required',
            'partial_shipment' => 'required',
            'trans_shipment' => 'required',
            'lc_type' => 'required',
            'frieght_payment' => 'required',
            'payment_mode' => 'required',
            'client_name' => 'required',
            'owner_address' => 'required',
            'tin_number' => 'required',
            'attn_name' => 'required',
            'attn_phone_number' => 'required',
            'attn_email' => 'required',
            'comertial_invoice_original' => 'required',
            'comertial_invoice_copy' => 'required',
            'packing_list_original' => 'required',
            'packing_list_copy' => 'required',
            'cirtificate_of_origin_original' => 'required',
            'cirtificate_of_origin_copy' => 'required',
            'bill_of_loading_original' => 'required',
            'bill_of_loading_copy' => 'required',
            'project_name' => 'required',
            'item_type' => 'required'
        ];
    }
}
