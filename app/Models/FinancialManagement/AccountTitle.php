<?php

namespace App\Models\FinancialManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountTitle extends Model
{
    protected $table = "fm_a_activity";    
    
    use HasFactory;

    protected $guarded = [];

    public function scopeSearch($query, $term) {
        $term = "%$term%";
        $query->where(function($query) use($term) {
            $query->where('activity','like',$term);
        });

    }


}
