<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Air_loading_port;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Validators\AirLoadingPortValidator;

class AirLoadingPortPortController extends Controller
{
    
    use ApiResponser;

    public function index()
    {
        $Air_loading_port = Air_loading_port::with('')->where('isDeleted', false)->get();
        return $this->successResponse($Air_loading_port, 200);
    }


    public function store(AirLoadingPortValidator $request)
    {
        $validator = $request->validated();

        $Air_loading_port = Air_loading_port::create([
            'country' => $validator['country'],
            'port_name' => $validator['port_name'],
            'origin_id' => $validator['origin_id'],
          
        ]);
      

        Log::info("Air Loading Id= " . $Air_loading_port->id . " created succesfully");

        return $this->successResponse($Air_loading_port, 'Air Loading created');
    }

    public function show($id)
    {
        $Air_loading_port = Air_loading_port::find($id);
        if (!$Air_loading_port) {

            Log::info("Air Loading id=" . $Air_loading_port->id . " not found");
            return $this->errorResponse(' Id Not found');
        } elseif ($Air_loading_port->isDeleted == true) {

            log::info("Air Loading id=" . $Air_loading_port->id . " is a deactivated ");
            return $this->successResponse(null, 'Diactivated Id');
        }

        return $this->successResponse($Air_loading_port, 200);
    }


    public function update(AirLoadingPortValidator $request, $id)
    {
        $validator = $request->validated();
        $Air_loading_port = Air_loading_port::find($id);

        if ($Air_loading_port == null) {
            log::info(" Air Loading id=" . $id . " not found");
            return $this->errorResponse('Id Not found');
        } elseif ($Air_loading_port->isDeleted == true) {
            log::info(" Air Loading id=" . $Air_loading_port->id . " is a deactivated");
            return $this->errorResponse('Diactivated Id');
        }

        $Air_loading_port->update([
            'country' => $validator['country'],
            'port_name' => $validator['port_name'],
            'origin_id' => $validator['origin_id'],
        ]);
       
        $Air_loading_port->save();
        log::info(" Air Loading id=" . $Air_loading_port->id . " successfully updated");

        return $this->successResponse($Air_loading_port);
    }


    public function deactivate($id)
    {
        $Air_loading_port = Air_loading_port::find($id);

        if ($Air_loading_port == null) {
            Log::info(" $Air_loading_port id=" . $id . "not found");
            return $this->errorResponse('Id Not found');
        } elseif ($Air_loading_port->isDeleted == true) {
            Log::info("  Air Loading id=" . $Air_loading_port->id . " is a deactivated ");
            return $this->successResponse(null, 'this $Air_loading_port id is deleted already');
        }

        $Air_loading_port->update([

            'isDeleted' => true,

        ]);
        Log::info("  Air Loading id=" . $Air_loading_port->id . " deactivated successfully");
        return $this->successResponse(null, 'Deactivated successfully');
    }
}
