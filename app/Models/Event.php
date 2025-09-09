<?php

namespace App\Models;

use App\Models\Admin\AdminPanel\Category\Office;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  
    protected $table = "event";    
    
    use HasFactory;

    protected $guarded = [];

    public function Office() {
        return $this->belongsTo(Office::class, 'office','id');
    }

    public function scopeSearch($query, $term) {

        $term = "%$term%";
        $query->where(function($query) use($term) {
            $query->where('date','like',$term)
                    ->orwhere('remarks','like',$term)
                    ->orwhere('schedule','like',$term)
                    ->orwhere('event','like',$term)
                    ->orwhereHas('office', function($query) use ($term) {
                        $query->where('office','like', $term);     
                    });
        });
    }

}
