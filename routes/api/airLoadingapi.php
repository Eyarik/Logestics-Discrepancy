<?php

use App\Http\Controllers\SeaDischargePortController;
use Illuminate\Support\Facades\Route;


Route::get('scm/discrepancy/airloadings', [SeaDischargePortController::class, 'index']);
Route::post('scm/discrepancy/airloadings', [SeaDischargePortController::class, 'store']);
Route::get('scm/discrepancy/airloadings/{id}', [SeaDischargePortController::class, 'show']);
Route::post('scm/discrepancy/airloadings/{id}', [SeaDischargePortController::class, 'update']);
Route::put('scm/discrepancy/airloadings/delete/{id}', [SeaDischargePortController::class, 'deactivate']);
