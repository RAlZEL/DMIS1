<?php

namespace App\Models\FinancialManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class boxa extends Model
{
    protected $table = "fm_box_a";    
    
    use HasFactory;

    protected $guarded = [];


    public function scopeSearch($query, $term) {
        $term = "%$term%";
        $query->where(function($query) use($term) {
            $query->where('certified_by','like',$term);
        });

    }
}
