<?php

namespace App\Models\FinancialManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckADA extends Model
{
    protected $table = "fm_cash";    
    
    use HasFactory;

    protected $guarded = [];


    public function Voucher() {
        return $this->hasMany(Voucher::class, 'voucher_id', 'id');
    }



}
