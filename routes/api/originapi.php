<?php

use App\Http\Controllers\OriginController;
use Illuminate\Support\Facades\Route;


//  Supplier Route

Route::get('scm/discrepancy/origins', [OriginController::class, 'index']);
Route::post('scm/discrepancy/origins', [OriginController::class, 'store']);
Route::get('scm/discrepancy/origins/{id}', [OriginController::class, 'show']);
Route::post('scm/discrepancy/origins/{id}', [OriginController::class, 'update']);
Route::put('scm/discrepancy/origins/delete/{id}', [OriginController::class, 'deactivate']);
