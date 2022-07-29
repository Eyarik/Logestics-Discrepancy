<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable=['item_description','PI','consignee_id',
'air_discharge_id','sea_discharge_id','air_loading_id','sea_loading_id',
'bank_detail_id','owner_id','shipment_mode_id','term_id','isDeleted'];
}
