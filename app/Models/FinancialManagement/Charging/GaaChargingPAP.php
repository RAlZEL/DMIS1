<?php

namespace App\Models\FinancialManagement\Charging;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FinancialManagement\gaa\allocation\pap;

class GaaChargingPAP extends Model
{
    protected $table = "fm_charging_gaa_pap";    
    
    use HasFactory;

    protected $guarded = [];

    public function Allocation() {
        return $this->belongsTo( pap::class, 'charging_id');
    }
}
