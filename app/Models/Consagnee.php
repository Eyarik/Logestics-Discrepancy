<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consagnee extends Model
{
    use HasFactory;

    protected $fillable=['bank_name','address','tf_number','permit_number','isDeleted'];
}
