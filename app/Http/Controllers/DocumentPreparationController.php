<?php

namespace App\Http\Controllers;

use App\Models\Item;
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
$items =Item::with('Consignee','AirDischarge','SeaDischarge','AirLoading','SeaLoading',
        'BankDetail','Owner','ShipmentMode','Term')->where('id', $id)->first();
$consignees=DB::table('items')->where('items.id',$id)
->join('consagnees','items.consignee_id','=','consagnees.id')
->first();

$banks=DB::table('items')->where('items.id',$id)
->join('bank_details','items.bank_detail_id','=','bank_details.id')
->first();

$owners=DB::table('items')->where('items.id',$id)
->join('owners','items.owner_id','=','owners.id')
->first();

$shipmentModes=DB::table('items')->where('items.id',$id)
->join('shipment_modes','items.shipment_mode_id','=','shipment_modes.id')
->first();

$terms=DB::table('items')->where('items.id',$id)
->join('terms','items.term_id','=','terms.id')
->first();

if ($shipmentModes->shipment_mode=='Air'){
    $dischargePorts=DB::table('items')->where('items.id',$id)
    ->join('air_discharge_ports','items.air_discharge_id','=','air_discharge_ports.id')
    ->first();
    $loadingPorts=DB::table('items')->where('items.id',$id)
    ->join('air_loading_ports','items.air_loading_id','=','air_loading_ports.id')
    ->first();
    $origins=DB::table('items')->where('items.id',$id)
    ->join('air_discharge_ports','items.air_discharge_id','=','air_discharge_ports.id')
    ->join('origins','air_discharge_ports.origin_id','=','origins.id')
    ->first();
}
else{
    $dischargePorts=DB::table('items')->where('items.id',$id)
    ->join('sea_discharge_ports','items.sea_discharge_id','=','sea_discharge_ports.id')
    ->first();
    $loadingPorts=DB::table('items')->where('itemsid',$id)
    ->join('sea_loading_ports','items.sea_loading_id','=','sea_loading_ports.id')
    ->first();
    $origins=DB::table('items')->where('items.id',$id)
    ->join('sea_loading_ports','items.sea_discharge_id','=','sea_loading_ports.id')
    ->join('origins','sea_loading_ports.origin_id','=','origins.id')
    ->first();
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

//ItemDescription
$template->setValue('ItemDescription', $items->item_description);

//term and conditions
$template->setValue('PaymentMode', $terms->payment_mode);
$template->setValue('PartialShipment', $shipmentModes->shipment_mode);
$template->setValue('TransShipment', $shipmentModes->shipment_mode);
$template->setValue('ShipmentMode', $shipmentModes->shipment_mode);
$template->setValue('LoadingPort', $loadingPorts->port_name);
$template->setValue('Origin', $origins->name);
$template->setValue('DischargePort', $dischargePorts->port_name);
$template->setValue('Frieght', $terms->frieght_payment);

//Bank details
$template->setValue('AccountName', $banks->account_holder);
$template->setValue('Iban', $banks->iban_number);
$template->setValue('SwiftCode', $banks->swift_code);
$template->setValue('AccountNumber', $banks->account_number);
$template->setValue('BankName', $banks->bank_name);

$pi = [];
foreach ($items->PI as $key => $item) {
    $val = [
        'ItemPartNumber' => $item['part_number'],
        'Description' => $item['item_description'],
        'HsCode' => $item['hs_code'],
        'UOM' => $item['uom'],
        'QTY' => $item['qty'],
    ];

    $pi[] = $val;

}

return $pi;
$template->cloneRowAndSetValues('ItemPartNumber', $pi);





$template->saveAs('CI.docx');
return response()->download(public_path('CI.docx'));
}

}
