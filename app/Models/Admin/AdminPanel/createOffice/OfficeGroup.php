<?php

namespace App\Models\Admin\AdminPanel\createOffice;

use App\Models\Admin\AdminPanel\Category\Division;
use App\Models\Admin\AdminPanel\Category\Office;
use App\Models\Admin\AdminPanel\Category\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeGroup extends Model
{
    protected $table = "office_group";    
    
    use HasFactory;

    protected $guarded = [];


    public function Office() {
        return $this->belongsTo(Office::class,'office_id','id');
    }

    public function Division() {
        return $this->belongsTo(Division::class,'division_id','id');
    }

    public function Unit() {
        return $this->belongsTo(Unit::class,'unit_id','id');
    }

    public function scopeSearch($query, $term) {
        $term = "%$term%";
        $query->where(function($query) use($term) {
            $query->whereHas('unit', function($query) use ($term) {
                $query->where('unit','like', $term);
            })
            ->orwhereHas('division', function($query) use ($term) {
                $query->where('division','like', $term);     
            })
            ->orwhereHas('office', function($query) use ($term) {
                $query->where('office','like', $term);     
            });
        });
    }
}
