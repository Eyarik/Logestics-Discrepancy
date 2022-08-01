<?php

use App\Http\Controllers\ConsagneeController;
use Illuminate\Support\Facades\Route;


//  Supplier Route

Route::get('scm/discrepancy/consignees', [ConsagneeController::class, 'index']);
Route::post('scm/discrepancy/consignees', [ConsagneeController::class, 'store']);
Route::get('scm/discrepancy/consignees/{id}', [ConsagneeController::class, 'show']);
Route::post('scm/discrepancy/consignees/{id}', [ConsagneeController::class, 'update']);
Route::put('scm/discrepancy/consignees/delete/{id}', [ConsagneeController::class, 'deactivate']);
