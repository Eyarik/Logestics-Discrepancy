<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sea_discharge_port extends Model
{
    use HasFactory;
    protected $fillable=['country','port_name','code','origin_id','isDeleted'];
}
