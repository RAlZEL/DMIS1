<?php

namespace App\Models\DocumentTracking;

use App\Models\User;
use App\Models\DocumentTracking\Route;
use Illuminate\Database\Eloquent\Model;
use App\Models\DocumentTracking\Attachment;
use App\Models\Admin\AdminPanel\Category\Unit;
use App\Models\Admin\AdminPanel\Category\Office;
use App\Models\Admin\AdminPanel\Category\Division;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    protected $table = "document";    
    
    use HasFactory;

    protected $guarded = [];

    public function Attachment() {
        return $this->hasMany(Attachment::class, 'documentid', 'PDN');
    }

    public function Route() {
        return $this->hasMany(Route::class, 'documentid', 'PDN');
    }

    public function scopeSearch($query, $term) {

        $term = "%$term%";
        $query->where(function($query) use($term) {
            $query->where('subject','like',$term)
                    ->orwhere('doc_type','like',$term)
                    ->orwhere('pdn','like',$term)
                    ->orwhere('sendername','like',$term)
                    ->orwhere('originatingoffice','like',$term)
                    ->orwhere('datereceived','like',$term);
        });
    }

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
    
        return $this->belongsTo(Office::class, 'from_officeid', 'id');

    }
    public function fromDivision() {
    
        return $this->belongsTo(Division::class, 'from_divisionid', 'id');

    }
    public function fromUnit() {
    
        return $this->belongsTo(Unit::class, 'from_unitid', 'id');


    }

    public function fromUser() {
    
        return $this->belongsTo(User::class, 'from_userid', 'id');


    }

    // public function getDocumentAttributes($value) {
        


    // }
}
