<?php

namespace App\Models;

use App\Models\Admin\EMS\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DTR extends Model
{
    protected $table = "emp_dtr";    
    
    use HasFactory;

    protected $guarded = [];

    public function Employee() {
        return $this->belongsTo(Employee::class, 'emp_id');
    }

    public function scopeSearch($query, $term) {

        $term = "%$term%";
        $query->where(function($query) use($term) {
            $query->where('date','like',$term)
                    ->orwhere('schedule','like',$term)
                    ->orwhere('time','like',$term)
                    ->orwhere('remarks','like',$term)
                   ->orwhereHas('employee', function($query) use ($term) {
                        $query->where('firstname','like', $term)
                        ->orwhere('lastname','like',$term);
                   });
         
        });
    }

    // public function scopeSearch($query, $term) {
    //     $term = "%$term%";
    //     $query->where(function($query) use($term) {
        
    //         $query->whereHas('Office', function($query) use ($term) {
    //             $query->where('office','like', $term);
    //         })
    //         ->orwhereHas('ExpenseClass', function($query) use ($term) {
    //             $query->where('expense_class','like', $term);     
    //         })
    //         ->orwhereHas('pap', function($query) use ($term) {
    //             $query->where('pap','like', $term);     
    //         })
    //         ->orwhere(function($query) use ($term) {
    //             $query->where('year', 'like', $term);
    //         });
    //     });
    // }




}
