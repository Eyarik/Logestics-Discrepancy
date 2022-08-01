<?php

namespace App\Models;

use App\Models\Origin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sea_discharge_port extends Model
{
    use HasFactory;
    protected $fillable=['country','port_name','code','origin_id','isDeleted'];

    public function SeaDischargeOrigin()
    {
        return $this->belongsTo(Origin::class, 'origin_id', 'id');
    }
}
