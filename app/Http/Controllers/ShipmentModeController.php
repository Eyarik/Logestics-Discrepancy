<?php

namespace App\Http\Controllers;

use App\Http\Requests\Validators\ShipmentModeValidator;
use App\Models\Shipment_mode;
use App\Utilities\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ShipmentModeController extends Controller
{
    use ApiResponser;

    public function index()
    {
        $shipmentMode = Shipment_mode::all();
        return $this->successResponse($shipmentMode, 200);
    }
    public function store(ShipmentModeValidator $request)
    {
        $validator = $request->validated();
        $shipmentMode = Shipment_mode::create([
            'shipment_mode' => $validator['shipment_mode'],
        ]);

        return $this->successResponse($shipmentMode, 'Shipment Mode Created');

    }
    public function show($id)
    {
        $shipmentMode = Shipment_mode::where('id', $id)->first();
        if (!$shipmentMode) {

            Log::info("Shipment Mode id=" . $id . " not found");
            return $this->errorResponse(' Id Not found');

        } elseif ($shipmentMode->isDeleted == true) {

            log::info("Owner id=" . $shipmentMode->id . " is a deactivated Supplier");
            return $this->successResponse(null, 'Diactivated Id');

        }

        return $this->successResponse($shipmentMode, 200);

    }

    public function update(Request $request, $id)
    {
        $shipmentMode = Shipment_mode::find($id);
        $input = $request->all();
        if ($shipmentMode == null) {
            log::info("owner id=" . $id . " not found");
            return $this->errorResponse('Id Not found');
        }

        $shipmentMode->update([
            'shipment_mode' => $input['shipment_mode'],
        ]);

        log::info(" owner id=" . $shipmentMode->id . " successfully updated");

        return $this->successResponse($shipmentMode,200);

    }

    public function deactivate($id)
    {
        $shipmentMode = Shipment_mode::find($id);

        if ($shipmentMode == null) {
            Log::info(" shipmentMode id=" . $id . "not found");
            return $this->errorResponse('Id Not found');
        } elseif ($shipmentMode->isDeleted == true) {
            Log::info("shipmentMode id=" . $shipmentMode->id . " is a deactivated Supplier");
            return $this->successResponse(null, 'this owner id is deleted already');
        }

        $shipmentMode->update([

            'isDeleted' => true,

        ]);
        Log::info(" owner id=" . $shipmentMode->id . " deactivated successfully");
        return $this->successResponse(null, 'Deactivated successfully');

    }
}
