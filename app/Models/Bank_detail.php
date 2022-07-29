<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank_detail extends Model
{
    use HasFactory;
    
    protected $fillable=['account_holder','iban_number','swift_code','account_number','beneficiary_bank_name','isDeleted'];
}
