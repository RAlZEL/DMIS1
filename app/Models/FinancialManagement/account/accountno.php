<?php

namespace App\Models\FinancialManagement\account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class accountno extends Model
{
    protected $table = "fm_account_number";    
    
    use HasFactory;

    protected $guarded = [];

    public function AccountName() {
        return $this->belongsTo(accountname::class, 'acct_id', 'id');
    }

    public function scopeSearch($query, $term) {
        $term = "%$term%";
        $query->where(function($query) use($term) {
        
            $query->whereHas('accountname', function($query) use ($term) {
                $query->where('acct_name','like', $term);
            });
         });
    }
}
