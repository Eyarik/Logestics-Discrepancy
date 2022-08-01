<?php

namespace App\Http\Controllers;

use App\Models\Consagnee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Validators\ConsagneeValidator;
use App\Utilities\ApiResponser;
use Illuminate\Support\Facades\DB;

class ConsagneeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use ApiResponser;

    public function index()
    {
        $Consagnees = Consagnee::with('isDeleted',false)->get();
        return $this->successResponse($Consagnees, 200);

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
    public function store(ConsagneeValidator $request)
    {
        $validator = $request->validated();

        $Consagnee = Consagnee::create([
            'bank_name' => $validator['bank_name'],
            'address' => $validator['address'],
            'tf_number' => $validator['tf_number'],
            'permit_number' => $validator['permit_number'],

        ]);

        Log::info("Consagnee Id= " . $Consagnee->id . " created succesfully");

        return $this->successResponse($Consagnee, 'Consagnee created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Consagnee = Consagnee::find($id);
        if ($Consagnee==null) {

            Log::info("Consagnee id=" . $id . " not found");
            return $this->errorResponse(' Id Not found');

        } elseif ($Consagnee->isDeleted == true) {

            log::info("Consagnee id=" . $Consagnee->id . " is a deactivated Consagnee");
            return $this->successResponse(null, 'Diactivated Id');

        }

        return $this->successResponse($Consagnee, 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConsagneeValidator $request, $id)
    {
        $validator = $request->validated();
        $Consagnee = Consagnee::find($id);

        if ($Consagnee == null) {
            log::info(" Consagnee id=" . $id . " not found");
            return $this->errorResponse('Id Not found');
        } elseif ($Consagnee->isDeleted == true) {
            log::info(" Consagnee id=" . $Consagnee->id . " is a deactivated");
            return $this->errorResponse('Diactivated Id');
        }

        $Consagnee->update([
            'bank_name' => $validator['bank_name'],
            'address' => $validator['address'],
            'tf_number' => $validator['tf_number'],
            'permit_number' => $validator['permit_number'],

        ]);

        $Consagnee->save();
        log::info(" Consagnee id=" . $Consagnee->id . " successfully updated");

        return $this->successResponse($Consagnee);

    }

    public function deactivate($id)
    {
        $Consagnee = Consagnee::find($id);

        if ($Consagnee == null) {
            Log::info(" Consagnee id=" . $id . "not found");
            return $this->errorResponse('Id Not found');
        } elseif ($Consagnee->isDeleted == true) {
            Log::info(" Consagnee id=" . $Consagnee->id . " is a deactivated Consagnee");
            return $this->successResponse(null, 'this Consagnee id is deleted already');
        }

        $Consagnee->update([

            'isDeleted' => true,

        ]);
        log::info(" Consagnee id=" . $Consagnee->id . " deactivated successfully");
        return $this->successResponse(null, 'Deactivated successfully');

    }

}
