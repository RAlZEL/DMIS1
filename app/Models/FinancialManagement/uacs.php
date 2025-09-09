<?php

namespace App\Models\FinancialManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class uacs extends Model
{
    protected $table = "fm_a_uacs";    
    
    use HasFactory;

    protected $guarded = [];

    public function scopeSearch($query, $term) {
        $term = "%$term%";
        $query->where(function($query) use($term) {
            $query->where('uacs','like',$term);
        });

    }

  

    public function Activity() {
        return $this->belongsTo(AccountTitle::class, 'a_activity_id');
    }
}
