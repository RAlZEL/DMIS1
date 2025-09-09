<?php

namespace App\Models\FinancialManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DVNumber extends Model
{
    protected $table = "fm_a_dv";    
    
    use HasFactory;

    protected $guarded = [];

}
