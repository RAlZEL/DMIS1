<?php

namespace App\Models\FinancialManagement;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\FinancialManagement\Route;
use App\Models\FinancialManagement\DVNumber;
use App\Models\Admin\AdminPanel\Category\Unit;
use App\Models\Admin\AdminPanel\Category\Division;
use App\Models\FinancialManagement\account\accountno;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\FinancialManagement\account\accountname;
use App\Models\FinancialManagement\Charging\GaaCharging;
use App\Models\FinancialManagement\Charging\SaaCharging;
use App\Models\Admin\AdminPanel\FinancialManagement\Office;
use App\Models\FinancialManagement\Charging\GaaChargingUACS;
use App\Models\FinancialManagement\Charging\GaaChargingPAP;
use App\Models\FinancialManagement\Charging\GaaChargingRealignmentUACS;
use App\Models\Admin\AdminPanel\Category\Office as OfficeCategory;

class voucher extends Model
{
    protected $table = "fm_voucher";    
    
    use HasFactory;

    protected $guarded = [];

    public function FM_Office() {
        return $this->belongsTo(Office::class, 'office', 'id');
    }

    public function AccountName() {
        return $this->belongsTo(accountname::class, 'acct_id', 'id');
    }

   public function AccountNumber() {
        return $this->belongsTo(accountno::class, 'acct_no', 'id');
    }

 
    public function Route() {
        return $this->hasMany(Route::class, 'sequenceid', 'sequenceid');
    }

    public function chargingActivities() {
        return $this->hasMany(GaaCharging::class, 'voucher_id');
    }

    public function chargingUACS() {
        return $this->hasMany(GaaChargingUACS::class, 'voucher_id');
    }
    

   /* public function chargingPAP() {
        return $this->hasMany(GaaChargingPAP::class, 'voucher_id');
    }*/

  /*  public function chargingRealignmentUACS() {
        return $this->hasMany(GaaChargingRealignmentUACS::class, 'voucher_id');
    }*/

    public function chargingSAA() {
        return $this->hasMany(SaaCharging::class, 'voucher_id');
    }


    public function Office() {
    
        return $this->belongsTo(OfficeCategory::class, 'officeid', 'id');

    }
    public function Division() {
    
        return $this->belongsTo(Division::class, 'divisionid', 'id');

    }
    public function Unit() {
    
        return $this->belongsTo(Unit::class, 'unitid', 'id');

    }


    public function fromOffice() {
    
        return $this->belongsTo(OfficeCategory::class, 'from_officeid', 'id');

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

    public function DVNumber() {
        return $this->hasOne(DVNumber::class, 'voucher_id', 'id');
    }

    
    public function AccountingEntry() {
        return $this->hasOne(AccountingEntry::class, 'voucher_id', 'id');
    }

    public function ReviewOfDocuments() {
        return $this->hasOne(ReviewofDocuments::class, 'voucher_id', 'id');
    }

    public function BoxD() {
        return $this->hasOne(BoxD::class, 'voucher_id', 'id');
    }

    public function CheckAda() {
        return $this->hasOne(CheckADA::class, 'voucher_id', 'id');
    }


    public function ORSDetails() {
    
        return $this->hasOne(ORS::class, 'voucher_id','id');


    }


    public function scopeSearch($query, $term) {

        $term = "%$term%";
        $query->where(function($query) use($term) {
            $query->where('particulars','like',$term)
                    ->orwhere('sequenceid','like',$term)
                    ->orwhere('amount','like',$term)
                    ->orwhere('date_created','like',$term);

        });
    }
}
