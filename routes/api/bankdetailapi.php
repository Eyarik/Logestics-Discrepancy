<?php

use App\Http\Controllers\BankDetailController;
use Illuminate\Support\Facades\Route;


//  Supplier Route

Route::get('scm/discrepancy/bankdetails', [BankDetailController::class, 'index']);
Route::post('scm/discrepancy/bankdetails', [BankDetailController::class, 'store']);
Route::get('scm/discrepancy/bankdetails/{id}', [BankDetailController::class, 'show']);
Route::post('scm/discrepancy/bankdetails/{id}', [BankDetailController::class, 'update']);
Route::put('scm/discrepancy/bankdetails/delete/{id}', [BankDetailController::class, 'deactivate']);
