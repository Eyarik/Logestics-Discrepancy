<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Air_discharge_port;
use App\Models\Air_loading_port;
use App\Models\Sea_discharge_port;
use App\Models\Sea_loading_port;

class Origin extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','code'
    ];
    public function OriginAirDischarge()
    {
        return $this->hasMany(Air_discharge_port::class, 'origin_id', 'id');
    }
    public function OriginAirLoading()
    {
        return $this->hasMany(Air_loading_port::class, 'origin_id', 'id');
    }
    public function OriginSeaLoading()
    {
        return $this->hasMany(Sea_loading_port::class, 'origin_id', 'id');
    }
    public function OriginSeaDischarge()
    {
        return $this->hasMany(Sea_discharge_port::class, 'origin_id', 'id');
    }
}
