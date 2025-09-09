<?php

namespace App\Models\FinancialManagement\gaa\allocation;

use Illuminate\Database\Eloquent\Model;

use App\Models\FinancialManagement\gaa\allocation\pap;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Admin\AdminPanel\ExpenseClass\ExpenseClass;
use App\Models\Admin\AdminPanel\FinancialManagement\Office;
use App\Models\FinancialManagement\Charging\GaaCharging;
use App\Models\FinancialManagement\gaa\activity as GaaActivity;

class activity extends Model
{
  
    protected $table = "fm_allocation_activity";    
    
    use HasFactory;

    protected $guarded = [];

    public function Activity() {
        return $this->belongsTo(GaaActivity::class,'activity_id','id');

        
    }

    public function PAPAllocation() {
        return $this->belongsTo(pap::class,'pap_allocation','id');
    
    }

    public function Chargings() {
        return $this->hasMany(GaaCharging::class,'charging_id','id');
    
    }

    
    public function scopeSearch($query, $term) {
        $term = "%$term%";
        $query->where(function($query) use($term) {
        
            $query->whereHas('activity', function($query) use ($term) {
                $query->where('activity','like', $term);
            });
         });
    }

    
    
}
