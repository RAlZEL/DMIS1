<?php

namespace App\Models\FinancialManagement\Charging;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FinancialManagement\gaa\allocation\activity;

class GaaCharging extends Model
{
    protected $table = "fm_charging_gaa_activity";    
    
    use HasFactory;

    protected $guarded = [];


    public function Allocation() {
        return $this->belongsTo( activity::class, 'charging_id');
    }
    

    // public function scopeSearch($query, $term) {
    //     $term = "%$term%";
    //     $query->where(function($query) use($term) {
    //         $query->where('certified_by','like',$term);
    //     });

    // }
}
