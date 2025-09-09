<?php

namespace App\Models\FinancialManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingEntry extends Model
{
    protected $table = "fm_a_entry";    
    
    use HasFactory;

    protected $guarded = [];

    public function UACS() {
        return $this->belongsTo(uacs::class, 'uacs_id', 'id');
    }

    public function Activity() {
        return $this->belongsTo(AccountTitle::class, 'activity_id', 'id');
    }
}
