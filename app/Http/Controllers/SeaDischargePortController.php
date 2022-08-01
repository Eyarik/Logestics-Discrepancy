<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Validators\SeaDischargePortValidator;
use App\Models\Sea_discharge_port;
use Illuminate\Support\Facades\Log;
use App\Utilities\ApiResponser;

class SeaDischargePortController extends Controller
{
    use ApiResponser;

    public function index()
    {
        $Sea_discharge_port = Sea_discharge_port::with('SeaDischargeOrigin')->where('isDeleted', false)->get();
        return $this->successResponse($Sea_discharge_port, 200);
    }


    public function store(SeaDischargePortValidator $request)
    {
        $validator = $request->validated();

        $Sea_discharge_port = Sea_discharge_port::create([
            'country' => $validator['country'],
            'port_name' => $validator['port_name'],
            'origin_id' => $validator['origin_id'],
            'code' => $validator['code'],
          
        ]);
      

        Log::info("Sea Discharge Id= " . $Sea_discharge_port->id . " created succesfully");

        return $this->successResponse($Sea_discharge_port, 'Sea Discharge created');
    }

    public function show($id)
    {
        $Sea_discharge_port =Sea_discharge_port::with('SeaDischargeOrigin')->where('id', $id)->get();
        if ($Sea_discharge_port==null) {

            Log::info("Sea Discharge id=" . $id . " not found");
            return $this->errorResponse(' Id Not found');
        } elseif ($Sea_discharge_port->isDeleted == true) {

            log::info("Sea Discharge id=" . $Sea_discharge_port->id . " is a deactivated ");
            return $this->successResponse(null, 'Diactivated Id');
        }

        return $this->successResponse($Sea_discharge_port, 200);
    }


    public function update(SeaDischargePortValidator $request, $id)
    {
        $validator = $request->validated();
        $Sea_discharge_port = Sea_discharge_port::find($id);

        if ($Sea_discharge_port == null) {
            Log::info(" Sea Discharge id=" . $id . " not found");
            return $this->errorResponse('Id Not found');
        } elseif ($Sea_discharge_port->isDeleted == true) {
            log::info(" Sea Discharge id=" . $Sea_discharge_port->id . " is a deactivated");
            return $this->errorResponse('Diactivated Id');
        }

        $Sea_discharge_port->update([
            'country' => $validator['country'],
            'port_name' => $validator['port_name'],
            'origin_id' => $validator['origin_id'],
            'code' => $validator['code'],
        ]);
       
        $Sea_discharge_port->save();
        Log::info(" Sea Discharge id=" . $Sea_discharge_port->id . " successfully updated");

        return $this->successResponse($Sea_discharge_port);
    }


    public function deactivate($id)
    {
        $Sea_discharge_port = Sea_discharge_port::find($id);

        if ($Sea_discharge_port == null) {
            Log::info(" $Sea_discharge_port id=" . $id . "not found");
            return $this->errorResponse('Id Not found');
        } elseif ($Sea_discharge_port->isDeleted == true) {
            Log::info("  Sea Discharge id=" . $Sea_discharge_port->id . " is a deactivated ");
            return $this->successResponse(null, 'this $Sea_discharge_port id is deleted already');
        }

        $Sea_discharge_port->update([

            'isDeleted' => true,

        ]);
        Log::info(" Sea Discharge id=" . $Sea_discharge_port->id . " deactivated successfully");
        return $this->successResponse(null, 'Deactivated successfully');
    }
}
