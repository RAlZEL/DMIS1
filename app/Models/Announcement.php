<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\AdminPanel\Category\Office;

class Announcement extends Model
{
    protected $table = "announcement";    
    
    use HasFactory;

    protected $guarded = [];

    public function User() {
        return $this->belongsTo(User::class, 'user_id','id');
    }

   public function Office() {
        return $this->belongsTo(Office::class, 'office_id','id');
    }


    public function scopeSearch($query, $term) {

        $term = "%$term%";
        $query->where(function($query) use($term) {
            $query->where('subject','like',$term)
                    ->orwhere('announce_to','like',$term)
                    ->orwhere('end_date','like',$term)
                    ->orwhere('start_date','like',$term)
                    ->orwhereHas('user', function($query) use ($term) {
                        $query->where('username','like', $term);     
                    });
        });
    }
}
