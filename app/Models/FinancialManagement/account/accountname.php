<?php

namespace App\Models\FinancialManagement\account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class accountname extends Model
{
    protected $table = "fm_account_name";    
    
    use HasFactory;

    protected $guarded = [];


    public function scopeSearch($query, $term) {
        $term = "%$term%";
        $query->where(function($query) use($term) {
            $query->where('acct_name','like',$term);
        });

    }

}
