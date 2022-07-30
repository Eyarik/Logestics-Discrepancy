<?php

namespace App\Models;

use App\Models\Term;
use App\Models\Owner;
use App\Models\Consagnee;
use App\Models\Bank_detail;
use App\Models\Shipment_mode;
use App\Models\Air_loading_port;
use App\Models\Sea_loading_port;
use App\Models\Air_discharge_port;
use App\Models\Sea_discharge_port;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $fillable=['item_description','PI','consignee_id',
'air_discharge_id','sea_discharge_id','air_loading_id','sea_loading_id',
'bank_detail_id','owner_id','shipment_mode_id','term_id','isDeleted'];

public function Consignee()
{
    return $this->belongsTo(Consagnee::class, 'consignee_id', 'id');
}
public function AirDischarge()
{
    return $this->belongsTo(Air_discharge_port::class, 'air_discharge_id', 'id');
}
public function SeaDischarge()
{
    return $this->belongsTo(Sea_discharge_port::class, 'sea_discharge_id', 'id');
}
public function AirLoading()
{
    return $this->belongsTo(Air_loading_port::class, 'air_loading_id', 'id');
}
public function SeaLoading()
{
    return $this->belongsTo(Sea_loading_port::class, 'sea_loading_id', 'id');
}
public function BankDetail()
{
    return $this->belongsTo(Bank_detail::class, 'bank_detail_id', 'id');
}
public function Owner()
{
    return $this->belongsTo(Owner::class, 'owner_id', 'id');
}
public function ShipmentMode()
{
    return $this->belongsTo(Shipment_mode::class, 'shipment_mode_id', 'id');
}
public function Term()
{
    return $this->belongsTo(Term::class, 'term_id', 'id');
}


}
