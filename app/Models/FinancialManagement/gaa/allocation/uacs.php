<?php

namespace App\Models\FinancialManagement\gaa\allocation;

use App\Models\FinancialManagement\gaa\uacs as GaaUacs;
// use App\Models\FinancialManagement\gaa\allocation\pap as AllocationPAP;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FinancialManagement\Charging\GaaChargingUACS;

class uacs extends Model
{
    protected $table = "fm_allocation_uacs";    
    
    use HasFactory;

    protected $guarded = [];


    public function PAPAllocation() {
        return $this->belongsTo(pap::class,'pap_allocation','id');
    
    }


       public function UACS() {
        return $this->belongsTo(GaaUacs::class,'uacs_id','id');

        
    }

    public function Chargings() {
        return $this->hasMany(GaaChargingUACS::class,'charging_id','id');
    
    }
    
    public function scopeSearch($query, $term) {
        $term = "%$term%";
        $query->where(function($query) use($term) {
        
            $query->whereHas('uacs', function($query) use ($term) {
                $query->where('uacs','like', $term);
            });
         });
    }
}
