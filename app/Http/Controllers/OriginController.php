<?php

namespace App\Http\Controllers;

use App\Http\Requests\Validators\OriginValidator;
use App\Models\Origin;
use App\Utilities\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OriginController extends Controller
{
    use ApiResponser;

    public function index()
    {

        $origin = Origin::all();
        return $this->successResponse($origin, 200);
    }
    public function store(OriginValidator $request)
    {
        $validator = $request->validated();
        $origin = Origin::create([
            'name' => $validator['name'],
            'code' => $validator['code'],
        ]);

        return $this->successResponse($origin, 'Origin Created');

    }
    public function show($id)
    {
        $origin = Origin::where('id', $id)->first();
        if (!$origin) {

            Log::info("Origin id=" . $id . " not found");
            return $this->errorResponse(' Id Not found');

        } elseif ($origin->isDeleted == true) {

            log::info("Origin id=" . $origin->id . " is a deactivated Supplier");
            return $this->successResponse(null, 'Diactivated Id');

        }

        return $this->successResponse($origin, 200);

    }

    public function update(Request $request, $id)
    {
        $origin = Origin::find($id);
        $input = $request->all();
        if ($origin == null) {
            log::info("Origin id=" . $id . " not found");
            return $this->errorResponse('Id Not found');
        }

        $origin->update([
            'name' => $input['name'],
            'code' => $input['code']
        ]);

        log::info(" Origin id=" . $origin->id . " successfully updated");

        return $this->successResponse($origin,200);

    }

}
