<?php

namespace App\Imports;

use App\Models\Air_discharge_port;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithGroupedHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AirDischargeImport implements ToModel,WithGroupedHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Air_discharge_port([
            'name' => $row['airport_name'],
            'country' => $row['country'],
        ]);
    }
    public function headingRow(): int
    {
        return 1;
    }
}
