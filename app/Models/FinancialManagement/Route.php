<?php

namespace App\Models\FinancialManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Admin\AdminPanel\Category\Division;
use App\Models\Admin\AdminPanel\Category\Office;
use App\Models\Admin\AdminPanel\Category\Unit;
use App\Models\User;
use App\Models\DocumentTracking\document;

class Route extends Model
{
    protected $table = "fm_route";    
    
    use HasFactory;

    protected $guarded = [];

    public function Office() {
    
        return $this->belongsTo(Office::class, 'officeid', 'id');

    }
    public function Division() {
    
        return $this->belongsTo(Division::class, 'divisionid', 'id');

    }
    public function Unit() {
    
        return $this->belongsTo(Unit::class, 'unitid', 'id');

    }


    public function fromOffice() {
    
        return $this->belongsTo(Office::class, 'from_office', 'id');

    }
    public function fromDivision() {
    
        return $this->belongsTo(Division::class, 'from_division', 'id');

    }
    public function fromUnit() {
    
        return $this->belongsTo(Unit::class, 'from_unit', 'id');

    }


    public function User() {
    
        return $this->belongsTo(User::class, 'userid', 'id');
            
    }

    public function Document() {
        return $this->belongsTo(document::class, 'documentid', 'PDN');
    }
 
}
