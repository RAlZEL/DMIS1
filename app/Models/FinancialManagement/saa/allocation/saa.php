<?php

namespace App\Models\FinancialManagement\saa\allocation;

use App\Models\Admin\AdminPanel\ExpenseClass\ExpenseClass;
use App\Models\Admin\AdminPanel\FinancialManagement\Office;
use App\Models\FinancialManagement\gaa\pap as GaaPap;
use App\Models\FinancialManagement\gaa\uacs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class saa extends Model
{
  
    protected $table = "fm_allocation_saa";    
    
    use HasFactory;

    protected $guarded = [];

    public function scopeSearch($query, $term) {
        $term = "%$term%";
        $query->where(function($query) use($term) {
        
            // $query->whereHas('Office', function($query) use ($term) {
            //     $query->where('office','like', $term);
            // })
            // ->orwhereHas('ExpenseClass', function($query) use ($term) {
            //     $query->where('expense_class','like', $term);     
            // })
            // ->orwhereHas('pap', function($query) use ($term) {
            //     $query->where('pap','like', $term);     
            // })
            // ->orwhere(function($query) use ($term) {
            //     $query->where('year', 'like', $term);
            // });
        });
    }

    public function PAP() {
        return $this->belongsTo(GaaPap::class, 'papid','id');
    }

    public function Office() {
        return $this->belongsTo(Office::class, 'office','id');
    }

    public function UACS() {
        return $this->belongsTo(uacs::class, 'uacs','id');
    }
    
    public function ExpenseClass() {
        return $this->belongsTo(ExpenseClass::class, 'expense_class','id');
    }


}
