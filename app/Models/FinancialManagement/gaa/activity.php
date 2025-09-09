<?php

namespace App\Models\FinancialManagement\gaa;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\FinancialManagement\gaa\pap as GaaPap;
use Illuminate\Database\Eloquent\Model;

class activity extends Model
{
    protected $table = "fm_activity";    
    
    use HasFactory;

    protected $guarded = [];

    public function scopeSearch($query, $term) {
        $term = "%$term%";
        $query->where(function($query) use($term) {
    
                $query->where('activity', 'like', $term);
            })
            ->orwhereHas('pap', function($query) use ($term) {
                $query->where('pap','like', $term);     
            })
            ;

    }

    public function PAP() {
    
        return $this->belongsTo(GaaPap::class, 'papid', 'id');

    }


}
