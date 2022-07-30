<?php

namespace App\Utilities;

use Illuminate\Support\Facades\Validator;

trait ApiResponser
{

    //For success response
    protected function successResponse($data = null, $message = null, $code = 200)
    {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data,
            'code' => $code,
        ], $code);
    }

    //For error response
    protected function errorResponse($message = null, $code = 404)
    {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            'data' => null,
            'code' => $code,
        ], $code);
    }

}
