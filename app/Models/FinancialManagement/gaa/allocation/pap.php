<?php

namespace App\Models\FinancialManagement\gaa\allocation;

use App\Models\Admin\AdminPanel\ExpenseClass\ExpenseClass;
use App\Models\Admin\AdminPanel\FinancialManagement\Office;
use App\Models\FinancialManagement\gaa\pap as GaaPap;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FinancialManagement\Charging\GaaChargingPAP;

class pap extends Model
{
    protected $table = "fm_allocation_pap";    
    
    use HasFactory;

    protected $guarded = [];


     /*public function scopeSearch($query, $term) { 
         $term = "%$term%";
         $query->where(function($query) use($term) {
             $query->where('pap','like',$term);
        });
        }
*/

public function Office() {
    return $this->belongsTo(Office::class,'office','id');
}

public function PAP() {
    return $this->belongsTo(GaaPap::class,'papid','id');
}

public function ExpenseClass() {
    return $this->belongsTo(ExpenseClass::class,'expense_class','id');
}


public function Chargings() {
    return $this->hasMany(GaaChargingPAP::class,'charging_id','id');

}

   public function scopeSearch($query, $term) {
       $term = "%$term%";
     $query->where(function($query) use($term) {  
            $query->whereHas('Office', function($query) use ($term) {
                $query->where('office','like', $term);
            })
            ->orwhereHas('ExpenseClass', function($query) use ($term) {
                $query->where('expense_class','like', $term);     
            })
            ->orwhereHas('pap', function($query) use ($term) {
                $query->where('pap','like', $term);     
            })
            ->orwhere(function($query) use ($term) {
                $query->where('year', 'like', $term);
           });
        });
    }
   
   /*public function Year() {
     return $this->belongsTo(Year::class,'year','id');
    }*/


}
