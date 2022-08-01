<?php

use App\Http\Controllers\SeaLoadingPortController;
use Illuminate\Support\Facades\Route;

//  Supplier Route

Route::get('scm/discrepancy/sealoadings', [SeaLoadingPortController::class, 'index']);
Route::post('scm/discrepancy/sealoadings', [SeaLoadingPortController::class, 'store']);
Route::get('scm/discrepancy/sealoadings/{id}', [SeaLoadingPortController::class, 'show']);
Route::post('scm/discrepancy/sealoadings/{id}', [SeaLoadingPortController::class, 'update']);
Route::put('scm/discrepancy/sealoadings/delete/{id}', [SeaLoadingPortController::class, 'deactivate']);
