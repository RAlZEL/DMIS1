<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceBio extends Model
{
    protected $table = "bio_list";    
    
    use HasFactory;

    protected $guarded = [];
}
