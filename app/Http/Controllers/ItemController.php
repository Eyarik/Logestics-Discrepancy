<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Validators\ItemValidator;
use App\Imports\Piimport;
use App\Models\Consagnee;
use App\Models\Mandatory_Document;
use App\Models\Owner;
use App\Models\Term;
use App\Utilities\ApiResponser;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use ApiResponser;

    public function index()
    {
        $Items = Item::with('Consignee','AirDischarge','SeaDischarge','AirLoading','SeaLoading',
        'BankDetail','Owner','ShipmentMode','Term')->where('isDeleted', false)->get();
        return $this->successResponse($Items, 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemValidator $request)
    {
        $validator = $request->validated();

        $consagnee = Consagnee::create([
            'bank_name' => $validator['consagnee_bank_name'],
            'address' => $validator['consagnee_address'],
            'tf_number' => $validator['consagnee_tf_number'],
            'permit_number' => $validator['consagnee_permit_number'],
            'postalCode' => $validator['consagnee_postalCode'],
            'phoneNumber' => $validator['consagnee_phoneNumber'],
        ]);

        $term = Term::create([
            'partial_shipment' => $validator['partial_shipment'],
            'trans_shipment' => $validator['trans_shipment'],
            'lc_type' => $validator['lc_type'],
            'frieght_payment' => $validator['frieght_payment'],
            'payment_mode' => $validator['payment_mode']
        ]);

        $owner = Owner::create([
            'client_name' => $validator['client_name'],
            'address' => $validator['owner_address'],
            'tin_number' => $validator['tin_number'],
            'attn_name' => $validator['attn_name'],
            'attn_phone_number' => $validator['attn_phone_number'],
            'attn_email' => $validator['attn_email'],
        ]);

        $mandatory_doc = Mandatory_Document::create([
            'comertial_invoice_original' => $validator['comertial_invoice_original'],
            'comertial_invoice_copy' => $validator['comertial_invoice_copy'],
            'packing_list_original' => $validator['packing_list_original'],
            'packing_list_copy' => $validator['packing_list_copy'],
            'cirtificate_of_origin_original' => $validator['cirtificate_of_origin_original'],
            'cirtificate_of_origin_copy' => $validator['cirtificate_of_origin_copy'],
            'bill_of_loading_original' => $validator['bill_of_loading_original'],
            'bill_of_loading_copy' => $validator['bill_of_loading_copy'],
        ]);

        $request->validate([
            'pi' => 'required',
        ]);
        $import = new Piimport();

        $datass = Excel::toArray($import,$request->file('pi'));
        $pi_data = [];
        foreach ($datass as $key => $datas) {
            foreach ($datas as $key => $data) {
                if ($data['part_number'] != null) {
                    $pi_dataa = (object) [
                        "part_number" => $data['part_number'],
                        "item_description" => $data['item_description'],
                        "hs_code" => $data['hs_code'],
                        "uom" => $data["uom"],
                        "qty" => $data['qty'],
                        "usd_unit_price" => $data['usd_unit_price'],
                        "total_line_price" => $data['total_line_price'],
                        "batch_id" => null
                    ];
                }
                array_push($pi_data,$pi_dataa);
            }
        }

        $item = new Item();
        $item->item_description = $request->item_description;
        $item->consignee_id = $consagnee->id;
        $item->air_discharge_id =  $validator['air_discharge_id'];
        $item->sea_discharge_id = $validator['sea_discharge_id'];
        $item->air_loading_id = $validator['air_loading_id'];
        $item->sea_loading_id = $validator['sea_loading_id'];
        $item->bank_detail_id = $validator['bank_detail_id'];
        $item->owner_id = $owner->id;
        $item->shipment_mode_id = $validator['shipment_mode_id'];
        $item->term_id = $term->id;
        $item->project_name = $validator['project_name'];
        $item->item_type = $validator['item_type'];
        $item->mandatory_doc_id = $mandatory_doc->id;
        $item->PI = $pi_data;
        $item->save();

        Log::info("Item Id= " . $item->id . " created succesfully");

        return $this->successResponse($item, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Item =Item::with('Consignee','AirDischarge','SeaDischarge','AirLoading','SeaLoading',
        'BankDetail','Owner','ShipmentMode','Term')->where('id', $id)->first();
        if ($Item==null) {

            Log::info("Item id=" . $id . " not found");
            return $this->errorResponse(' Id Not found');

        } elseif ($Item->isDeleted == true) {

            log::info("Item id=" . $Item->id . " is a deactivated Item");
            return $this->successResponse(null, 'Diactivated Id');

        }

        foreach ($Item->PI as $key => $pi) {
            return $pi['part_number'];
        }

        return $this->successResponse($Item->PI, 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemValidator $request, $id)
    {
        $validator = $request->validated();
        $Item = Item::find($id);

        if ($Item == null) {
            log::info(" Item id=" . $id . " not found");
            return $this->errorResponse('Id Not found');
        } elseif ($Item->isDeleted == true) {
            log::info(" Item id=" . $Item->id . " is a deactivated");
            return $this->errorResponse('Diactivated Id');
        }

        $Item->update([
            'item_description' => $validator['item_description'],
            'PI' => $request->PI,
            'consignee_id' => $request->consignee_id,
            'air_discharge_id' => $request->air_discharge_id,
            'sea_discharge_id' => $request->sea_discharge_id,
            'air_loading_id' => $request->air_loading_id,
            'sea_loading_id' => $request->sea_loading_id,
            'bank_detail_id' => $request->bank_detail_id,
            'owner_id' => $request->owner_id,
            'shipment_mode_id' => $request->shipment_mode_id,
            'term_id' => $request->term_id,

        ]);

        $Item->save();
        log::info(" Item id=" . $Item->id . " successfully updated");

        return $this->successResponse($Item);

    }

    public function deactivate($id)
    {
        $Item = Item::find($id);

        if ($Item == null) {
            Log::info(" Item id=" . $id . "not found");
            return $this->errorResponse('Id Not found');
        } elseif ($Item->isDeleted == true) {
            Log::info(" Item id=" . $Item->id . " is a deactivated Item");
            return $this->successResponse(null, 'this Item id is deleted already');
        }

        $Item->update([

            'isDeleted' => true,

        ]);
        Log::info(" Item id=" . $Item->id . " deactivated successfully");
        return $this->successResponse(null, 'Deactivated successfully');

    }
}
