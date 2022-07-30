<?php

use App\Http\Controllers\SeaDischargePortController;
use Illuminate\Support\Facades\Route;

//  Supplier Route

Route::get('scm/discrepancy/seadischarges', [SeaDischargePortController::class, 'index']);
Route::post('scm/discrepancy/seadischarges', [SeaDischargePortController::class, 'store']);
Route::get('scm/discrepancy/seadischarges/{id}', [SeaDischargePortController::class, 'show']);
Route::post('scm/discrepancy/seadischarges/{id}', [SeaDischargePortController::class, 'update']);
Route::put('scm/discrepancy/seadischarges/delete/{id}', [SeaDischargePortController::class, 'deactivate']);
