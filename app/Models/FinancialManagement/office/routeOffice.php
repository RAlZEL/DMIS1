<?php

namespace App\Models\FinancialManagement\office;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\AdminPanel\Category\Division;
use App\Models\Admin\AdminPanel\Category\Office;
use App\Models\Admin\AdminPanel\Category\Unit;


class routeOffice extends Model
{
    protected $table = "fm_office_group";    
    
    use HasFactory;

    protected $guarded = [];


    public function scopeSearch($query, $term) {
        $term = "%$term%";
        $query->where(function($query) use($term) {
            // $query->where('certified_by','like',$term);
        });

    }

 
    public function Office() {
        return $this->belongsTo(Office::class,'office_id','id');
    }

    public function Division() {
        return $this->belongsTo(Division::class,'division_id','id');
    }

    public function Unit() {
        return $this->belongsTo(Unit::class,'unit_id','id');
    }



}
