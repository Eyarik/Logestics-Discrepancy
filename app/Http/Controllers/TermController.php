<?php

namespace App\Http\Controllers;

use App\Http\Requests\Validators\TermValidator;
use App\Models\Term;
use App\Utilities\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TermController extends Controller
{
    use ApiResponser;

    public function index()
    {
        $term = Term::all();
        return $this->successResponse($term, 200);
    }
    public function store(TermValidator $request)
    {
        $validator = $request->validated();
        $term = Term::create([
            'partial_shipment' => $validator['partial_shipment'],
            'trans_shipment' => $validator['trans_shipment'],
            'lc_type' => $validator['lc_type'],
            'frieght_payment' => $validator['frieght_payment'],
            'time_of_arrival' => $validator['time_of_arrival'],
            'incoterm' => $validator['incoterm'],
            'total_price' => $validator['total_price'],
            'frieght_cost' => $validator['frieght_cost'],
            'cost_and_fright' => $validator['cost_and_fright'],
        ]);

        return $this->successResponse($term, 'term Mode Created');

    }
    public function show($id)
    {
        $term = Term::where('id', $id)->first();
        if ($term==null) {

            Log::info("Term id=" . $id . " not found");
            return $this->errorResponse(' Id Not found');

        } elseif ($term->isDeleted == true) {

            log::info("term id=" . $term->id . " is a deactivated Supplier");
            return $this->successResponse(null, 'Diactivated Id');

        }

        return $this->successResponse($term, 200);

    }

    public function update(Request $request, $id)
    {
        $term = Term::find($id);
        $input = $request->all();
        if ($term == null) {
            log::info("term id=" . $id . " not found");
            return $this->errorResponse('Id Not found');
        }

        $term->update([
            'shipment_mode' => $input['shipment_mode'],
        ]);

        log::info(" term id=" . $term->id . " successfully updated");

        return $this->successResponse($term,200);

    }

    public function deactivate($id)
    {
        $term = Term::find($id);

        if ($term == null) {
            Log::info(" term id=" . $id . "not found");
            return $this->errorResponse('Id Not found');
        } elseif ($term->isDeleted == true) {
            Log::info("term id=" . $term->id . " is a deactivated term");
            return $this->successResponse(null, 'this term id is deleted already');
        }

        $term->update([

            'isDeleted' => true,

        ]);
        Log::info(" term id=" . $term->id . " deactivated successfully");
        return $this->successResponse(null, 'Deactivated successfully');

    }
}
