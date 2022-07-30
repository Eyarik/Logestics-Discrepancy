<?php

namespace App\Http\Controllers;

use App\Http\Requests\Validators\OwnerValidator;
use App\Models\Owner;
use App\Utilities\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OwnerController extends Controller
{
    use ApiResponser;

    public function index()
    {

        $owner = Owner::all();
        return $this->successResponse($owner, 200);
    }
    public function store(OwnerValidator $request)
    {
        $validator = $request->validated();
        $owner = Owner::create([
            'client_name' => $validator['client_name'],
            'address' => $validator['address'],
            'tin_number' => $validator['tin_number'],
            'attn_name' => $validator['attn_name'],
            'attn_phone_number' => $validator['attn_phone_number'],
            'attn_email' => $validator['attn_email'],
        ]);

        return $this->successResponse($owner, 'Owner Created');

    }
    public function show($id)
    {
        $owner = Owner::where('id', $id)->first();
        if (!$owner) {

            Log::info("Owner id=" . $id . " not found");
            return $this->errorResponse(' Id Not found');

        } elseif ($owner->isDeleted == true) {

            log::info("Owner id=" . $owner->id . " is a deactivated Supplier");
            return $this->successResponse(null, 'Diactivated Id');

        }

        return $this->successResponse($owner, 200);

    }

    public function update(Request $request, $id)
    {
        $owner = Owner::find($id);
        $input = $request->all();
        if ($owner == null) {
            log::info("owner id=" . $id . " not found");
            return $this->errorResponse('Id Not found');
        }

        $owner->update([
            'client_name' => $input['client_name'],
            'address' => $input['address'],
            'tin_number' => $input['tin_number'],
            'attn_name' => $input['attn_name'],
            'attn_phone_number' => $input['attn_phone_number'],
            'attn_email' => $input['attn_email'],
        ]);

        log::info(" owner id=" . $owner->id . " successfully updated");

        return $this->successResponse($owner,200);

    }

    public function deactivate($id)
    {
        $owner = Owner::find($id);

        if ($owner == null) {
            Log::info(" owner id=" . $id . "not found");
            return $this->errorResponse('Id Not found');
        } elseif ($owner->isDeleted == true) {
            Log::info("owner id=" . $owner->id . " is a deactivated Supplier");
            return $this->successResponse(null, 'this owner id is deleted already');
        }

        $owner->update([

            'isDeleted' => true,

        ]);
        Log::info(" owner id=" . $owner->id . " deactivated successfully");
        return $this->successResponse(null, 'Deactivated successfully');

    }
}
