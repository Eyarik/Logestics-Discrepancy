<?php

namespace App\Http\Controllers;

use App\Imports\AirDischargeImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AirDischargePortController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'airdischarge' => 'required',
        ]);
        $import = new AirDischargeImport();

        $data = Excel::import($import,$request->file('airdischarge'));

        return $data;
    }
}
