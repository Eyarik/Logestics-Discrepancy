<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentPreparationController;


//  Supplier Route

Route::get('scm/discrepancy/commercialinvoice/{id}', [DocumentPreparationController::class, 'CommercialInvoice']);

