<?php

namespace App\Models\FinancialManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewofDocuments extends Model
{
    protected $table = "fm_a_review";    
    
    use HasFactory;

    protected $guarded = [];
}
