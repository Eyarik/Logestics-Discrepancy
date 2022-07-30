<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $Items = DB::table('Items')->where('isDeleted', false)->get();
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

        $Item = Item::create([
            'item_description' => $validator['item_description'],
            'PI' => $validator['PI'],
            'consignee_id' => $validator['consignee_id'],
            'air_discharge_id' => $validator['air_discharge_id'],
            'sea_discharge_id' => $validator['sea_discharge_id'],
            'air_loading_id' => $validator['air_loading_id'],
            'sea_loading_id' => $validator['sea_loading_id'],
            'bank_detail_id' => $validator['bank_detail_id'],
            'owner_id' => $validator['owner_id'],
            'shipment_mode_id' => $validator['shipment_mode_id'],
            'term_id' => $validator['term_id'],
         
           
        ]);

        Log::info("Item Id= " . $Item->id . " created succesfully");

        return $this->successResponse($Item, 'Item created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Item = Item::find($id);
        if ($Item==null) {

            Log::info("Item id=" . $id . " not found");
            return $this->errorResponse(' Id Not found');

        } elseif ($Item->isDeleted == true) {

            log::info("Item id=" . $Item->id . " is a deactivated Item");
            return $this->successResponse(null, 'Diactivated Id');

        }

        return $this->successResponse($Item, 200);

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
            'PI' => $validator['PI'],
            'consignee_id' => $validator['consignee_id'],
            'air_discharge_id' => $validator['air_discharge_id'],
            'sea_discharge_id' => $validator['sea_discharge_id'],
            'air_loading_id' => $validator['air_loading_id'],
            'sea_loading_id' => $validator['sea_loading_id'],
            'bank_detail_id' => $validator['bank_detail_id'],
            'owner_id' => $validator['owner_id'],
            'shipment_mode_id' => $validator['shipment_mode_id'],
            'term_id' => $validator['term_id'],

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
