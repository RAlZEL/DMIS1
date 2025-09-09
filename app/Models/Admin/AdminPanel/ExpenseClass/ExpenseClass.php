<?php

namespace App\Models\Admin\AdminPanel\ExpenseClass;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseClass extends Model
{
    protected $table = "fm_expense_class";    
    
    use HasFactory;

    protected $guarded = [];

    public function scopeSearch($query, $term) {
        $term = "%$term%";
        $query->where(function($query) use($term) {
            $query->where('expense_class','like',$term);
        });

    }
}
