<?php

namespace App\Models\DocumentTracking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $table = "attachment";    
    
    use HasFactory;

    protected $guarded = [];
}
