<?php

namespace App\Models;

use App\Models\Admin\EMS\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpBio extends Model
{
    protected $table = "bio_emp";    
    
    use HasFactory;

    protected $guarded = [];

    public function Employee() {
        return $this->belongsTo(Employee::class, 'emp_id','id');
    }

    public function Device() {
        return $this->belongsTo(DeviceBio::class, 'device_id','id');
    }

    public function scopeSearch($query, $term) {

        $term = "%$term%";
        $query->where(function($query) use($term) {
            $query
                   ->orwhereHas('employee', function($query) use ($term) {
                        $query->where('firstname','like', $term)
                        ->orwhere('lastname','like',$term);
                   });
         
        });
    }

}
