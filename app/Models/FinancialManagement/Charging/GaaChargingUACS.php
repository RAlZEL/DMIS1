<?php

namespace App\Models\FinancialManagement\Charging;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FinancialManagement\gaa\allocation\uacs;

class GaaChargingUACS extends Model
{
    protected $table = "fm_charging_gaa_uacs";    
    
    use HasFactory;

    protected $guarded = [];

    public function Allocation() {
        return $this->belongsTo( uacs::class, 'charging_id');
    }
}
