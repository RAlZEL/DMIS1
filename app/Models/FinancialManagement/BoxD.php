<?php

namespace App\Models\FinancialManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoxD extends Model
{
    protected $table = "fm_a_boxd";    
    
    use HasFactory;

    protected $guarded = [];

    public function Signatory() {
        return $this->belongsTo(boxa::class,'signatoryid','id');
    }
}
