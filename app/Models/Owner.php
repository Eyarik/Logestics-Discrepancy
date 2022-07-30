<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Owner extends Model
{
    use HasFactory;

    protected $fillable=['client_name','address','tin_number','attn_name','attn_phone_number',
'attn_email','isDeleted'];

public function OwnerItem()
    {
        return $this->hasMany(Item::class, 'owner_id', 'id');
    }
}

