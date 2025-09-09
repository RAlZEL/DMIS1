<?php

namespace App\Models\FinancialManagement\Charging;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FinancialManagement\saa\allocation\saa;

class SaaCharging extends Model
{
    protected $table = "fm_charging_saa";    
    
    use HasFactory;

    protected $guarded = [];

    public function Allocation() {
        return $this->belongsTo( saa::class, 'charging_id');
    }
    public function ExpenseClass() {
        return $this->belongsTo( saa::class, 'charging_id');
    }
}
