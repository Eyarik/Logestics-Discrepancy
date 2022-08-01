<?php

use App\Http\Controllers\TermController;
use Illuminate\Support\Facades\Route;




Route::get('scm/discrepancy/terms', [TermController::class, 'index']);
Route::post('scm/discrepancy/terms', [TermController::class, 'store']);
Route::get('scm/discrepancy/terms/{id}', [TermController::class, 'show']);
Route::post('scm/discrepancy/terms/{id}', [TermController::class, 'update']);
Route::put('scm/discrepancy/terms/delete/{id}', [TermController::class, 'deactivate']);
