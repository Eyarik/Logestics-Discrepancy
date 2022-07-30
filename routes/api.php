<?php

use App\Http\Controllers\AirDischargePortController;
use App\Imports\AirDischargeImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

require __DIR__ . '/api/originapi.php';

Route::post('scm/discrepancy/airdischarge', [AirDischargePortController::class, 'store']);


