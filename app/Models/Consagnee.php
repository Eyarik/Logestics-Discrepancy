<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Consagnee extends Model
{
    use HasFactory;

    protected $fillable=['bank_name','address','tf_number','permit_number','isDeleted'];
    public function ConsigneeItem()
    {
        return $this->hasMany(Item::class, 'consignee_id', 'id');
    }

}
