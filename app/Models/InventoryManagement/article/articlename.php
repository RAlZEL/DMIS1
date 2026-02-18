<?php

namespace App\Models\InventoryManagement\article;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleName extends Model
{
    protected $table = "im_article_name";    
    
    use HasFactory;

    protected $guarded = [];


    public function scopeSearch($query, $term) {
        $term = "%$term%";
        $query->where(function($query) use($term) {
            $query->where('article_name','like',$term);
        });

    }

}