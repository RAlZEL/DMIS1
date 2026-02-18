<?php

namespace App\Models\InventoryManagement;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Admin\EMS\Employee;
use App\Models\Admin\AdminPanel\Category\Unit;
use App\Models\Admin\AdminPanel\Category\Division;
use App\Models\Admin\AdminPanel\Category\Office as OfficeCategory;
use App\Models\InventoryManagement\article\ArticleName;
use App\Models\InventoryManagement\article\ArticleDescription;

class Property extends Model
{
    protected $table = "im_property"; 

    use HasFactory;

    protected $guarded = [];

    public function Employee(){
        return $this->belongsTo(Employee::class, 'accountable_officer');

    }


    public function Office() {
    
        return $this->belongsTo(OfficeCategory::class, 'office', 'id');

    }
    public function Division() {
    
        return $this->belongsTo(Division::class, 'divisionid', 'id');

    }
    public function Unit() {
    
        return $this->belongsTo(Unit::class, 'unitid', 'id');

    }

    public function ArticleDescription() {
        return $this->belongsTo(ArticleDescription::class, 'article_description', 'id');
    }

    public function ArticleName() {
        return $this->belongsTo(ArticleName::class, 'article_id', 'id');
    }

    public function scopeSearch($query, $term) {
        $term = "%$term%";
        $query->where(function($query) use($term) {
            $query->where('property_no','like',$term)
                    ->orwhere('specification','like',$term)
                    ->orwhere('unit_value','like',$term)
                    ->orwhere('date_acquired','like',$term);

        });

    }

}