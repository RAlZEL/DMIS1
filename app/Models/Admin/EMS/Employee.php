<?php

namespace App\Models\Admin\EMS;

use App\Models\Admin\AdminPanel\Category\Division;
use App\Models\Admin\AdminPanel\Category\Office;
use App\Models\Admin\AdminPanel\Category\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = "employees";    
    
    use HasFactory;

    protected $guarded = [];

    public function Office() {
        return $this->belongsTo(Office::class,'officeid','id');
    }

    public function Division() {
        return $this->belongsTo(Division::class,'divisionid','id');
    }

    public function Unit() {
        return $this->belongsTo(Unit::class,'unitid','id');
    }

    public function scopeSearch($query, $term) {

        $term = "%$term%";
        $query->where(function($query) use($term) {
            $query->where('firstname','like',$term)
                    ->orwhere('lastname','like',$term)
                    ->orwhere('middlename','like',$term)
                    ->orwhere('birthdate','like',$term)
                    ->orwhere('position','like',$term)
                    ->orwhere('empstatus','like',$term)
                    ->orwhere('employeeid','like',$term)
                    ;
        });
    }
}
