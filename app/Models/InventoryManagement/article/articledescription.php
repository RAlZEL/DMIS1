<?php

namespace App\Models\InventoryManagement\article;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleDescription extends Model
{
    protected $table = "im_article_description";    
    
    use HasFactory;

    protected $guarded = [];

    public function ArticleName() {
        return $this->belongsTo(ArticleName::class, 'article_id', 'id');
    }

    static public function get_single($id)
    {
        return self::find($id);
    }

    public function scopeSearch($query, $term) {
        $term = "%$term%";
        $query->where(function($query) use($term) {
        
            $query->whereHas('articlename', function($query) use ($term) {
                $query->where('article_name','like', $term);
            });
         });
    }

}