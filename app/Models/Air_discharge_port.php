<?php

namespace App\Models;

use App\Models\Origin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Air_discharge_port extends Model
{
    use HasFactory;
    protected $fillable=['country','port_name','code','origin_id','isDeleted'];

    public function AirDischargeOrigin()
    {
        return $this->belongsTo(Origin::class, 'origin_id', 'id');
    }
}
