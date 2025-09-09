<?php

namespace App\Models\FinancialManagement\gaa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class uacs extends Model
{
    protected $table = "fm_uacs";    
    
    use HasFactory;

    protected $guarded = [];

    public function scopeSearch($query, $term) {
        $term = "%$term%";
        $query->where(function($query) use($term) {
            $query->where('uacs','like',$term);
        });

    }
}
