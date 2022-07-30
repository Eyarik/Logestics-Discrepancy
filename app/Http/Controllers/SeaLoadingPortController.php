<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sea_loading_port;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Validators\SeaLoadingPortValidator;
use App\Utilities\ApiResponser;

class SeaLoadingPortController extends Controller
{
    use ApiResponser;

    public function index()
    {
        $Sea_loading_port = Sea_loading_port::with('SeaLoadingOrigin')->where('isDeleted', false)->get();
        return $this->successResponse($Sea_loading_port, 200);
    }


    public function store(SeaLoadingPortValidator $request)
    {
        $validator = $request->validated();

        $Sea_loading_port = Sea_loading_port::create([
            'country' => $validator['country'],
            'port_name' => $validator['port_name'],
            'origin_id' => $validator['origin_id'],
            'code' => $validator['code'],
          
        ]);
      

        Log::info("Sea Loading Id= " . $Sea_loading_port->id . " created succesfully");

        return $this->successResponse($Sea_loading_port, 'Sea Loading created');
    }

    public function show($id)
    {
        $Sea_loading_port = Sea_loading_port::with('SeaLoadingOrigin')->where('id', $id)->get();
        if ($Sea_loading_port==null) {

            Log::info("Sea Loading id=" . $id . " not found");
            return $this->errorResponse(' Id Not found');
        } elseif ($Sea_loading_port->isDeleted == true) {

            log::info("Sea Loading id=" . $Sea_loading_port->id . " is a deactivated ");
            return $this->successResponse(null, 'Diactivated Id');
        }

        return $this->successResponse($Sea_loading_port, 200);
    }


    public function update(SeaLoadingPortValidator $request, $id)
    {
        $validator = $request->validated();
        $Sea_loading_port = Sea_loading_port::find($id);

        if ($Sea_loading_port == null) {
            Log::info(" Sea Loading id=" . $id . " not found");
            return $this->errorResponse('Id Not found');
        } elseif ($Sea_loading_port->isDeleted == true) {
            log::info(" Sea Loading id=" . $Sea_loading_port->id . " is a deactivated");
            return $this->errorResponse('Diactivated Id');
        }

        $Sea_loading_port->update([
            'country' => $validator['country'],
            'port_name' => $validator['port_name'],
            'origin_id' => $validator['origin_id'],
            'code' => $validator['code'],
        ]);
       
        $Sea_loading_port->save();
        Log::info(" Sea Loading id=" . $Sea_loading_port->id . " successfully updated");

        return $this->successResponse($Sea_loading_port);
    }


    public function deactivate($id)
    {
        $Sea_loading_port = Sea_loading_port::find($id);

        if ($Sea_loading_port == null) {
            Log::info(" $Sea_loading_port id=" . $id . "not found");
            return $this->errorResponse('Id Not found');
        } elseif ($Sea_loading_port->isDeleted == true) {
            Log::info("  Sea Loading id=" . $Sea_loading_port->id . " is a deactivated ");
            return $this->successResponse(null, 'this $Sea_loading_port id is deleted already');
        }

        $Sea_loading_port->update([

            'isDeleted' => true,

        ]);
        Log::info(" Sea Loading id=" . $Sea_loading_port->id . " deactivated successfully");
        return $this->successResponse(null, 'Deactivated successfully');
    }
}
