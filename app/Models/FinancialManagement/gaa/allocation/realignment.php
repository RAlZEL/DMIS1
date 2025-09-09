<?php

namespace App\Models\FinancialManagement\gaa\allocation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FinancialManagement\gaa\allocation\uacs;
use App\Models\FinancialManagement\gaa\uacs as GaaUACS;
use App\Models\FinancialManagement\Charging\GaaChargingUACS;
class realignment extends Model
{
    protected $table = "fm_realign";    
    
    use HasFactory;

    protected $guarded = [];


    public function UACSAllocation() {
        return $this->belongsTo(uacs::class,'uacs_allocation','id');
    
    }
       public function UACS() {
        return $this->belongsTo(GaaUACS::class,'to_uacs','id');
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
