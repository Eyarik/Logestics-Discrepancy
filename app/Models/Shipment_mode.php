<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shipment_mode extends Model
{
    use HasFactory;

    protected $fillable=['shipment_mode','isDeleted'];

    public function ShipmentModeItem()
    {
        return $this->hasMany(Item::class, 'shipment_mode_id', 'id');
    }
}
