<?php

namespace App\Models\Memorandum;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memorandum extends Model
{
    protected $table = "memorandum";    
    
    use HasFactory;

    protected $guarded = [];
}
