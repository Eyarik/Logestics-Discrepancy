<?php

use App\Http\Controllers\ShipmentModeController;
use Illuminate\Support\Facades\Route;



Route::get('scm/discrepancy/shipmentmodes', [ShipmentModeController::class, 'index']);
Route::post('scm/discrepancy/shipmentmodes', [ShipmentModeController::class, 'store']);
Route::get('scm/discrepancy/shipmentmodes/{id}', [ShipmentModeController::class, 'show']);
Route::post('scm/discrepancy/shipmentmodes/{id}', [ShipmentModeController::class, 'update']);
Route::put('scm/discrepancy/shipmentmodes/delete/{id}', [ShipmentModeController::class, 'deactivate']);
