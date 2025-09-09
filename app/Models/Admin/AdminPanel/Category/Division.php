<?php

namespace App\Models\Admin\AdminPanel\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $table = "division";    
    
    use HasFactory;

    protected $guarded = [];


    public function scopeSearch($query, $term) {
        $term = "%$term%";
        $query->where(function($query) use($term) {
            $query->where('division','like',$term);
        });

    }
}