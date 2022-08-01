<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;

class DocumentPreparationController extends Controller
{
Public function PackingList($id){
$template = new TemplateProcessor('pltemplate.docx');
$items=DB::table('items')->where('items.id',$id)->first();
$consignees=DB::table('items')->where('items.id',$id)
->join('consagnees','items.consignee_id','=','consagnees.id')
->first();

$owners=DB::table('items')->where('items.id',$id)
->join('owners','items.owner_id','=','owners.id')
->first();

//consignee details
$template->setValue('ConsigneeBank', $consignees->bank_name);
$template->setValue('ConsigneeAddress', $consignees->address);
$template->setValue('ConsigneePostalCode', $consignees->postalCode);
$template->setValue('ConsigneePhone', $consignees->phoneNumber);
$template->setValue('ConsigneePermitCode', $consignees->permit_number);
$template->setValue('ConsigneeTfNumber', $consignees->tf_number);
$template->setValue('ConsigneeLcRef', $consignees->lc_ref);

//clinetDetail
$template->setValue('ClientName', $owners->client_name);
$template->setValue('ClientAdress', $owners->address);
$template->setValue('TinNumber', $owners->tin_number);
$template->setValue('AttnName', $owners->attn_name);
$template->setValue('AttnPhone', $owners->attn_phone_number);
$template->setValue('AttnEmail', $owners->attn_email);

//ItemDescription
$template->setValue('ItemDescription', $items->item_description);

$template->saveAs('PL.docx');
return response()->download(public_path('PL.docx'));



    
}
Public function CommercialInvoice($id){
$template = new TemplateProcessor('comercialInvoicetemplate.docx');
$consignees=DB::table('items')->where('id',$id)
->join('consagnees','items.consignee_id','=','consagnees.id')
->get();

$banks=DB::table('items')->where('id',$id)
->join('bank_details','items.bank_detail_id','=','bank_details.id')
->get();
$owners=DB::table('items')->where('id',$id)
->join('ownwers','items.owner_id','=','owners.id')
->get();
$shipmentModes=DB::table('items')->where('id',$id)
->join('shipment_modes','items.shipment_mode_id','=','shipment_modes.id')
->get();
$terms=DB::table('items')->where('id',$id)
->join('terms','items.term_id','=','terms.id')
->get();
if ($shipmentModes->shipment_mode=='Air'){
    $dischargePorts=DB::table('items')->where('id',$id)
    ->join('air_discharge_ports','items.air_discharge_id','=','air_discharge_ports.id')
    ->get();
    $loadingPorts=DB::table('items')->where('id',$id)
    ->join('air_loading_ports','items.air_loading_id','=','air_loading_ports.id')
    ->get();
}
else{
    $dischargePorts=DB::table('items')->where('id',$id)
    ->join('sea_discharge_ports','items.sea_discharge_id','=','sea_discharge_ports.id')
    ->get();
    $loadingPorts=DB::table('items')->where('id',$id)
    ->join('sea_loading_ports','items.sea_loading_id','=','sea_loading_ports.id')
    ->get();
}


//consignee details
$template->setValue('ConsigneeBank', $consignees->bank_name);
$template->setValue('ConsigneeAddress', $consignees->address);
$template->setValue('ConsigneePostalCode', $consignees->postalCode);
$template->setValue('ConsigneePhone', $consignees->phoneNumber);
$template->setValue('ConsigneePermitCode', $consignees->permit_number);
$template->setValue('ConsigneeTfNumber', $consignees->tf_number);
$template->setValue('ConsigneeLcRef', $consignees->lc_ref);

//clinetDetail
$template->setValue('ClientName', $owners->client_name);
$template->setValue('ClientAdress', $owners->address);
$template->setValue('TinNumber', $owners->tin_number);
$template->setValue('AttnName', $owners->attn_name);
$template->setValue('AttnPhone', $owners->attn_phone_number);
$template->setValue('AttnEmail', $owners->attn_email);


//term and conditions
$template->setValue('PaymentMode', $owners->attn_email);
$template->setValue('ShipmentMode', $owners->attn_email);
$template->setValue('LoadingPort', $owners->attn_email);
$template->setValue('DischargePort', $owners->attn_email);


$template->saveAs('CI.docx');
return response()->download(public_path('CI.docx'));
}



}
