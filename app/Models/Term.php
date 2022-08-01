<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Term extends Model
{
    use HasFactory;

    protected $fillable=['payment_mode','partial_shipment','trans_shipment','lc_type','frieght_payment'];

    public function TermItem()
    {
        return $this->hasMany(Item::class, 'term_id', 'id');
    }
}
