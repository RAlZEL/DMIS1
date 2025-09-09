<?php

namespace App\Models\Admin\AdminPanel\OIC;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OIC extends Model
{
    protected $table = "oic_employee";    
    
    use HasFactory;

    protected $guarded = [];

}
