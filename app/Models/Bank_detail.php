<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bank_detail extends Model
{
    use HasFactory;
    
    protected $fillable=['account_holder','iban_number','swift_code','account_number','beneficiary_bank_name','isDeleted'];

    public function BankDetailItem()
    {
        return $this->hasMany(Item::class, 'bank_detail_id', 'id');
    }
}
