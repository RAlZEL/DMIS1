<?php

namespace App\Models\FinancialManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ORS extends Model
{
    protected $table = "fm_ors";    
    
    use HasFactory;

    protected $guarded = [];
}
