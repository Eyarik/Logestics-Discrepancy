<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Air_loading_port extends Model
{
    use HasFactory;
    protected $fillable=['country','port_name','origin_id','isDeleted'];
}
