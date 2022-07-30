<?php

use App\Http\Controllers\ConsigneeController;
use Illuminate\Support\Facades\Route;


//  Supplier Route

Route::get('scm/discrepancy/consignees', [ConsigneeController::class, 'index']);
Route::post('scm/discrepancy/consignees', [ConsigneeController::class, 'store']);
Route::get('scm/discrepancy/consignees/{id}', [ConsigneeController::class, 'show']);
Route::post('scm/discrepancy/consignees/{id}', [ConsigneeController::class, 'update']);
Route::put('scm/discrepancy/consignees/delete/{id}', [ConsigneeController::class, 'deactivate']);
