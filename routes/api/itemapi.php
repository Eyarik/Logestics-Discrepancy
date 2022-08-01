<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;


//  Supplier Route

Route::get('scm/discrepancy/items', [ItemController::class, 'index']);
Route::post('scm/discrepancy/items', [ItemController::class, 'store']);
Route::get('scm/discrepancy/items/{id}', [ItemController::class, 'show']);
Route::post('scm/discrepancy/items/{id}', [ItemController::class, 'update']);
Route::put('scm/discrepancy/items/delete/{id}', [ItemController::class, 'deactivate']);
