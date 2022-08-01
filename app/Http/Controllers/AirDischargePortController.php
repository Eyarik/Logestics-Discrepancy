<?php

namespace App\Http\Controllers;

use App\Imports\AirDischargeImport;
use Illuminate\Http\Request;
use App\Models\Air_discharge_port;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Validators\AirDischargePortValidator;
use App\Models\Air_loading_port;
use App\Models\Origin;
use App\Models\Sea_loading_port;
use App\Utilities\ApiResponser;
use Maatwebsite\Excel\Facades\Excel;

use function PHPSTORM_META\map;

class AirDischargePortController extends Controller
{

    use ApiResponser;

    public function index()
    {
        $Air_discharge_port =Air_discharge_port::with('AirDischargeOrigin')->get();
        return $this->successResponse($Air_discharge_port, 200);
    }


    public function store(Request $request)
    {
        $validator = $request->validated();

        $Air_discharge_port = Air_discharge_port::create([
            'country' => $validator['country'],
            'port_name' => $validator['port_name'],
            'origin_id' => $validator['origin_id'],
            'code' => $validator['code'],

        ]);


        Log::info("Air Discharge Id= " . $Air_discharge_port->id . " created succesfully");

        return $this->successResponse($Air_discharge_port, 'Air Discharge created');



    }

    public function show($id)
    {
        $Air_discharge_port =Air_discharge_port::with('AirDischargeOrigin')->where('id',$id)->get();
        if ($Air_discharge_port==null) {

            Log::info("Air Discharge id=" . $id . " not found");
            return $this->errorResponse(' Id Not found');
        } elseif ($Air_discharge_port->isDeleted == true) {

            log::info("Air Discharge id=" . $Air_discharge_port->id . " is a deactivated ");
            return $this->successResponse(null, 'Diactivated Id');
        }

        return $this->successResponse($Air_discharge_port, 200);
    }


    public function update(AirDischargePortValidator $request, $id)
    {
        $validator = $request->validated();
        $Air_discharge_port = Air_discharge_port::find($id);

        if ($Air_discharge_port == null) {
            log::info(" Air Discharge id=" . $id . " not found");
            return $this->errorResponse('Id Not found');
        } elseif ($Air_discharge_port->isDeleted == true) {
            log::info(" Air Discharge id=" . $Air_discharge_port->id . " is a deactivated");
            return $this->errorResponse('Diactivated Id');
        }

        $Air_discharge_port->update([
            'country' => $validator['country'],
            'port_name' => $validator['port_name'],
            'origin_id' => $validator['origin_id'],
            'code' => $validator['code'],
        ]);

        $Air_discharge_port->save();
        Log::info(" Air Discharge id=" . $Air_discharge_port->id . " successfully updated");

        return $this->successResponse($Air_discharge_port);
    }


    public function deactivate($id)
    {
        $Air_discharge_port = Air_discharge_port::find($id);

        if ($Air_discharge_port == null) {
            Log::info(" $Air_discharge_port id=" . $id . "not found");
            return $this->errorResponse('Id Not found');
        } elseif ($Air_discharge_port->isDeleted == true) {
            Log::info("  Air Discharge id=" . $Air_discharge_port->id . " is a deactivated ");
            return $this->successResponse(null, 'this $Air_discharge_port id is deleted already');
        }

        $Air_discharge_port->update([

            'isDeleted' => true,

        ]);
        Log::info("  Air Discharge id=" . $Air_discharge_port->id . " deactivated successfully");
        return $this->successResponse(null, 'Deactivated successfully');
    }
}
