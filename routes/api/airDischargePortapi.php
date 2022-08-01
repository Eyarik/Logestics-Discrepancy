<?php

use App\Http\Controllers\AirDischargePortController;
use Illuminate\Support\Facades\Route;


//  Supplier Route

Route::get('scm/discrepancy/airdischarges', [AirDischargePortController::class, 'index']);
Route::post('scm/discrepancy/airdischarges', [AirDischargePortController::class, 'store']);
Route::get('scm/discrepancy/airdischarges/{id}', [AirDischargePortController::class, 'show']);
Route::post('scm/discrepancy/airdischarges/{id}', [AirDischargePortController::class, 'update']);
Route::put('scm/discrepancy/airdischarges/delete/{id}', [AirDischargePortController::class, 'deactivate']);
