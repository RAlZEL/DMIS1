<?php

namespace App\Models\InventoryManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imremark extends Model
{
    protected $table = "im_remarks";
    
    use HasFactory;

    protected $guarded = [];
}
