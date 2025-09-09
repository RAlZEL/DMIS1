<?php

namespace App\Models\FinancialManagement\Charging;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FinancialManagement\gaa\allocation\realignment;

class GaaChargingRealignmentUACS extends Model
{
    protected $table = "fm_charging_gaa_realignment";    
    
    use HasFactory;

    protected $guarded = [];

    public function Allocation() {
        return $this->belongsTo( realignment::class, 'charging_id');
    }
}