<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $fillable=['client_name','address','tin_number','attn_name','attn_phone_number',
'attn_email','isDeleted'];
}
