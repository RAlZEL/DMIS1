<?php

namespace App\Models\InventoryManagement\article;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
    protected $table = "im_remarks";
    
    use HasFactory;

    protected $guarded = [];
}
