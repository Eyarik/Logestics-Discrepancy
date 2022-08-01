<?php

use App\Http\Controllers\AirDischargePortController;
use App\Http\Controllers\SeaLoadingPortController;
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
require __DIR__ . '/api/airDischargePortapi.php';
require __DIR__ . '/api/airLoadingapi.php';
require __DIR__ . '/api/bankdetailapi.php';
require __DIR__ . '/api/consigneeapi.php';
require __DIR__ . '/api/itemapi.php';
require __DIR__ . '/api/ownerapi.php';
require __DIR__ . '/api/seaDischargeapi.php';
require __DIR__ . '/api/seaLoadingapi.php';
require __DIR__ . '/api/shipmentmodeapi.php';
require __DIR__ . '/api/termapi.php';
require __DIR__ . '/api/packinglistapi.php';
require __DIR__ . '/api/commercialinvoiceapi.php';

Route::post('scm/discrepancy/airdischarge', [SeaLoadingPortController::class, 'import']);


