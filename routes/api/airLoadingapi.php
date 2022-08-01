<?php

use App\Http\Controllers\AirDischargePortController;
use App\Http\Controllers\AirLoadingPortController;
use App\Http\Controllers\SeaDischargePortController;
use Illuminate\Support\Facades\Route;


Route::get('scm/discrepancy/airloadings', [AirLoadingPortController::class, 'index']);
Route::post('scm/discrepancy/airloadings', [AirLoadingPortController::class, 'store']);
Route::get('scm/discrepancy/airloadings/{id}', [AirLoadingPortController::class, 'show']);
Route::post('scm/discrepancy/airloadings/{id}', [AirLoadingPortController::class, 'update']);
Route::put('scm/discrepancy/airloadings/delete/{id}', [AirLoadingPortController::class, 'deactivate']);
