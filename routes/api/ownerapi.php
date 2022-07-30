<?php

use App\Http\Controllers\OwnerController;
use Illuminate\Support\Facades\Route;


//  Supplier Route

Route::get('scm/discrepancy/owners', [OwnerController::class, 'index']);
Route::post('scm/discrepancy/owners', [OwnerController::class, 'store']);
Route::get('scm/discrepancy/owners/{id}', [OwnerController::class, 'show']);
Route::post('scm/discrepancy/owners/{id}', [OwnerController::class, 'update']);
Route::put('scm/discrepancy/owners/delete/{id}', [OwnerController::class, 'deactivate']);
