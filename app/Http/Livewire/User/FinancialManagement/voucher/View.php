<?php

namespace App\Http\Livewire\User\FinancialManagement\Voucher;

use App\Models\FinancialManagement\Uacs as AccountingUACS;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Admin\EMS\Employee;
use App\Models\FinancialManagement\Route;
use App\Models\FinancialManagement\voucher;
use App\Models\Admin\AdminPanel\Category\Office;
use App\Models\FinancialManagement\gaa\activity;
use App\Models\Admin\AdminPanel\Category\Division;
use App\Models\FinancialManagement\office\routeOffice;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\FinancialManagement\gaa\pap;
use App\Models\Admin\AdminPanel\ExpenseClass\ExpenseClass;
use App\Models\Admin\AdminPanel\FinancialManagement\Office as FMOffice;
use App\Models\FinancialManagement\AccountingEntry;
use App\Models\FinancialManagement\AccountTitle;
use App\Models\FinancialManagement\boxa;
use App\Models\FinancialManagement\BoxD;
use App\Models\FinancialManagement\Charging\GaaCharging;
use App\Models\FinancialManagement\Charging\GaaChargingUACS;
use App\Models\FinancialManagement\Charging\GaaChargingPAP;
use App\Models\FinancialManagement\Charging\SaaCharging;
use App\Models\FinancialManagement\CheckADA;
use App\Models\FinancialManagement\DVNumber;
use App\Models\FinancialManagement\gaa\allocation\pap as AllocationPap;
use App\Models\FinancialManagement\gaa\allocation\activity as AllocationActivity;
use App\Models\FinancialManagement\gaa\allocation\uacs as AllocationUACS;
use App\Models\FinancialManagement\ORS;
use App\Models\FinancialManagement\ReviewofDocuments;
use App\Models\FinancialManagement\saa\allocation\saa;
use App\Models\FinancialManagement\saa\allocation\saa as SaaAllocation;


class View extends Component
{

    use AuthorizesRequests;
    public $sequenceid,$office, $address, $acct_id, $acct_no, $particulars, $date_created, $remarks, $Routes, $selected_voucher, $amount;

    public $divisionids;
    public $unitids;
    public $officeids;

    public $selectedOffice;
    public $selectedDivision = NULL;
    public $selectedUnit= NULL;
    public $route_remarks;
    public $routeaction = "FORWARD TO";

    public $rem_bal_activity_voucher = null;
    public $rem_bal_uacs_voucher = null;
    public $rem_bal_saa_voucher = null;
    public $selected_pap_allocation = null;

    public $selectedOfficeFM = NULL;
    public $selectedPAP = NULL;
    public $selectedYear = NULL;
    public $selectedExpenseClass = NULL;
    public $selectedActivity = NULL;
    public $selectedUACS = NULL;
   
    public $expense_class_ids; 
    public $year_ids;
    public $pap_ids;
    public $activity_ids; 
    public $Office_ids;
    public $Uacs_ids;
    
    public $selectedSAA;
    public $Saa_ids;
    public $saa_rem_bal;
    public $saa_charging;
    public $saa_temp_bal;

    public $delete_selected_activity;
    public $delete_selected_uacs;
    public $delete_selected_saa;
    public $delete_selected_ors;

    public $activity_rem_bal, $activity_charging, $activity_temp_bal;
    public $uacs_rem_bal, $uacs_charging, $uacs_temp_bal;

    public $ChargingActivities;
    public $ChargingUACS;
    public $ChargingSAA;


    public $ors_number,$ors_fund_cluster, $ors_particulars, $ors_obligation, $ors_payable, $ors_payment, $ors_dd, $ors_nyd;

    public $dv_number, $jev_number;
    public $update_dv = false;
    public $selected_dv_number;

    public $update_accounting_entry, $a_uacs, $a_activity, $a_debit, $a_credit,$delete_selected_accounting_entry;
    public $selectedAccountTitle;
    public $selectedAccountUACS;
    public $AccountTitles;
    public $AUACSLists;

    public $update_review, $is_available, $is_subject, $is_supporting, $selected_review, $delete_selected_review;
            
    public $update_boxd, $BoxDSignatories, $selected_box_d, $box_d;

    public $update_checkada, $mop, $check_ada;
    public $delete_selected_ada;
    
    protected $listeners = [
        'updateRouteList',
        'updateORSDetails' => '$refresh',
        'updateVoucher' => '$refresh',
  
    ];

    public function updateRouteList() {
        
        $Voucher = voucher::where('sequenceid',$this->sequenceid)->get()->first();
        $this->Routes = $Voucher->Route;
    } 

    
    public function updateActivityList() {
        
        $Voucher = voucher::where('sequenceid',$this->sequenceid)->get()->first();
        $this->ChargingActivities = $Voucher->chargingActivities;
    } 

       
    public function updateUACSList() {
        
        $Voucher = voucher::where('sequenceid',$this->sequenceid)->get()->first();
        $this->ChargingUACS = $Voucher->chargingUACS;
    } 

    public function updateSAAList() {
        
        $Voucher = voucher::where('sequenceid',$this->sequenceid)->get()->first();
        $this->ChargingSAA = $Voucher->chargingSAA;
    } 


    public function mount($id) {
          
        $Voucher = voucher::findorfail($id);
        $this->sequenceid = $Voucher->sequenceid;
        $this->office = $Voucher->fm_office->office;
        $this->address = $Voucher->fm_office->address;
        $this->acct_id = $Voucher->AccountName->acct_name;
        $this->acct_no = $Voucher->AccountNumber->acct_no;
        $this->particulars = $Voucher->particulars;
        $this->date_created = $Voucher->date_created;
        $this->remarks = $Voucher->remarks;
        $this->amount = $Voucher->amount;
        $this->Routes = $Voucher->Route;
        $this->selected_voucher  = $Voucher;
        $this->officeids = Office::orderby('office','asc')->get();
        $this->divisionids = collect();
        $this->unitids = collect();
        $this->delete_selected_activity = null;
        $this->delete_selected_uacs = null;
        $this->delete_selected_saa = null;
        $this->ChargingActivities = $Voucher->chargingActivities;
        $this->ChargingUACS = $Voucher->chargingUACS;
        $this->ChargingSAA = $Voucher->ChargingSAA;
        $this->Office_ids = FMOffice::orderby('office','asc')->get(); 
        $this->expense_class_ids = collect();
        $this->year_ids = collect();
        $this->pap_ids = collect();
        $this->activity_ids = collect();
        $this->Uacs_ids = collect();

        $this->activity_rem_bal = NULL;
        $this->activity_charging = NULL;
        $this->activity_temp_bal = NULL;

        $this->uacs_rem_bal = NULL;
        $this->uacs_charging = NULL;
        $this->uacs_temp_bal = NULL;
        $this->selectedUACS = NULL;
        $this->saa_temp_bal = null;
        $this->rem_bal_saa_voucher = number_format($Voucher->rem_bal_saa,2,'.',','); 
        $this->rem_bal_activity_voucher = number_format($Voucher->rem_bal_charging,2,'.',','); 
        $this->rem_bal_uacs_voucher =number_format($Voucher->rem_bal_uacs,2,'.',',');

        $this->selected_pap_allocation = null;

        $this->selectedSAA = null;
        $this->saa_charging = null;

        $this->saa_rem_bal = null;
        $this->Saa_ids = saa::orderby('saa_no', 'asc')->where('rem_bal', '!=', 0)->get();

        $this->selected_voucher = $Voucher;

        $this->ors_number = null;
        $this->ors_fund_cluster = null;
        $this->ors_particulars = null;
        $this->ors_obligation = null;
        $this->ors_payable = null;
        $this->ors_payment = null;
        $this->ors_dd = null;
        $this->ors_nyd = null;

        if($this->selected_voucher->ORSDetails) {
            $this->ors_fund_cluster = $this->selected_voucher->ORSDetails->fund_cluster;
            $this->ors_particulars =  $this->selected_voucher->ORSDetails->particulars;
            $this->ors_number =  $this->selected_voucher->ORSDetails->ors_no;
            $this->ors_obligation =  $this->selected_voucher->ORSDetails->obligation;
            $this->ors_payable =  $this->selected_voucher->ORSDetails->payable;;
            $this->ors_payment =  $this->selected_voucher->ORSDetails->apyment;
            $this->ors_dd = $this->selected_voucher->ORSDetails->ors_dd;
            $this->ors_nyd =  $this->selected_voucher->ORSDetails->ors_nyd;
        }

        $this->delete_selected_ors = null;

        
        $this->dv_number = null;
        $this->jev_number = null;
        $this->selected_dv_number = null;



        $this->update_accounting_entry = false;
        $this->a_uacs = null;
        $this->a_activity = null;
        $this->a_debit = null;
        $this->a_credit = null;

        $this->selectedAccountTitle = null;
        $this->selectedAccountUACS = null;
        $this->delete_selected_accounting_entry = null;
        $this->AccountTitles = AccountTitle::orderby('activity','asc')->get();
        $this->AUACSLists = collect();

        $this->update_review = null;
        $this->is_available = null;
        $this->is_subject = null;
        $this->is_supporting = null;
        $this->selected_review = null;

        $this->delete_selected_review = null;

        $this->update_boxd = false;
        $this->box_d = null;
        $this->BoxDSignatories = boxa::orderby('certified_by','asc')->get();
        $this->delete_selected_ada = null;
        
    }

    public function updatedselectedAccountTitle($id) {

        if (!is_null($this->selectedAccountTitle)) {
        
        $this->AUACSLists = AccountingUACS::where('a_activity_id', $id)->get();
        }
    }

    public function updatedselectedSAA($saa_id) {
     
        $SaaAllocation = saa::where('id', $saa_id)->get()->first();
        if ($SaaAllocation)
        {
            $this->saa_rem_bal = number_format($SaaAllocation->rem_bal,2,'.',',');
            $this->saa_temp_bal =$SaaAllocation->rem_bal;
        }
        else 
        {
            $this->saa_temp_bal = null;
            $this->saa_rem_bal = null;
            $this->saa_rem_bal = null;
            $this->selectedSAA = null;
        }
     
    }

    public function updatedselectedOfficeFM($officeid) {
        
        if(!is_null($this->selectedOfficeFM))
        {
     
            $ids = AllocationPap::where('office', $this->selectedOfficeFM)->distinct()->select('expense_class')->get();
            
            if (!is_null($ids))
            {
                $Lists = [];
                foreach ($ids as $id)
                {

                    $expenseClass = ExpenseClass::where('id', $id->expense_class)->get()->first();

                    $Lists[] = array($expenseClass->id,$expenseClass->expense_class);
                }

                $this->expense_class_ids =  $Lists;
                $this->selectedActivity = NULL;
                $this->selectedExpenseClass = NULL;
                $this->selectedYear = NULL;
                $this->selectedPAP = NULL;


                $this->selected_pap_allocation = null;
                $this->activity_rem_bal = NULL;
                $this->activity_charging = NULL;
                $this->activity_temp_bal = NULL;
                $this->uacs_rem_bal = NULL;
                $this->uacs_charging = NULL;
                $this->uacs_temp_bal = NULL;
                $this->selectedUACS = NULL;
            }
        }   
    }

    public function updatedselectedExpenseClass($expenseclassid) {


        if(!is_null($this->selectedExpenseClass))
        {

            $ids = AllocationPap::where('office', $this->selectedOfficeFM)->where('expense_class', $this->selectedExpenseClass)->distinct()->select('papid')->get();
            
            if ($ids)
            {
                $Lists = [];
                foreach ($ids as $id)
                {

                    $Pap = PAP::where('id', $id->papid)->get()->first();

                    $Lists[] = array($Pap->id,$Pap->pap);
                }

                $this->pap_ids =  $Lists;
                $this->selectedPAP = NULL;
                $this->selectedYear = NULL;
                $this->selected_pap_allocation = null;
                $this->selectedActivity = NULL;
                $this->activity_rem_bal = NULL;
                $this->activity_charging = NULL;
                $this->activity_temp_bal = NULL;
                $this->uacs_rem_bal = NULL;
                $this->uacs_charging = NULL;
                $this->uacs_temp_bal = NULL;
                $this->selectedUACS = NULL;
            }
        }   
    }


    
    public function updatedselectedPAP($papid) {
    

        if(!is_null($this->selectedPAP))
        {
       
            $this->year_ids = AllocationPap::where('office', $this->selectedOfficeFM)->where('expense_class', $this->selectedExpenseClass)->where('papid', $this->selectedPAP)->get();
            $this->selectedYear = null;

            $this->selected_pap_allocation = null;
            $this->selectedActivity = NULL;
            $this->activity_rem_bal = NULL;
            $this->activity_charging = NULL;
            $this->activity_temp_bal = NULL;
            $this->uacs_rem_bal = NULL;
            $this->uacs_charging = NULL;
            $this->uacs_temp_bal = NULL;
            $this->selectedUACS = NULL;
        }   
    }


      
    public function updatedselectedYear($year) {
    

        if(!is_null($this->selectedYear))

        
        {

         
       
            $Allocation = AllocationPap::where('office', $this->selectedOfficeFM)->where('expense_class', $this->selectedExpenseClass)->where('papid', $this->selectedPAP)->where('year', $this->selectedYear)->get()->first();
            $this->selected_pap_allocation = $Allocation->id;
            
            if ($Allocation) 
            {
                $this->activity_ids = AllocationActivity::where('pap_allocation',$Allocation->id)->get();
                $this->Uacs_ids = AllocationUACS::where('pap_allocation',$Allocation->id)->get();
                $this->selectedActivity = NULL;
                $this->activity_rem_bal = NULL;
                $this->activity_charging = NULL;
                $this->activity_temp_bal = NULL;
                $this->uacs_rem_bal = NULL;
                $this->uacs_charging = NULL;
                $this->uacs_temp_bal = NULL;
                $this->selectedUACS = NULL;
              
            }
        }

    }


    public function updatedselectedActivity($activity) {
    

        if(!is_null($this->selectedActivity))
        {
            $Allocation = AllocationActivity::where('id', $this->selectedActivity)->get()->first();

            
            if ($Allocation) 
            {
                $activity_rem_bal = AllocationActivity::where('id',$Allocation->id)->get()->pluck('rem_bal')->first();
                $this->activity_temp_bal = $activity_rem_bal;
                $this->activity_rem_bal =   number_format($activity_rem_bal,2,'.',',');
                $this->activity_charging = NULL;
            }
            else
            {  
                $this->activity_temp_bal = NULL;
                $this->activity_rem_bal =   NULL;
                $this->activity_charging = NULL;
            }
    
        }

    }


    public function updatedselectedUACS($uacs) {
    

        if(!is_null($this->selectedUACS))
        {
            $Allocation = AllocationUACS::where('id', $this->selectedUACS)->get()->first();

            
            if ($Allocation) 
            {
                $uacs_rem_bal = AllocationUACS::where('id',$Allocation->id)->get()->pluck('rem_bal')->first();
                $this->uacs_temp_bal = $uacs_rem_bal;
                $this->uacs_rem_bal =   number_format($uacs_rem_bal,2,'.',',');
                $this->uacs_charging = NULL;
            }
            else
            {
                $this->uacs_temp_bal = NULL;
                $this->uacs_rem_bal =  NULL;
                $this->uacs_charging = NULL; 
            }
    
        }

    }


   



    public function updatedSelectedOffice($officeid) {
    


        $this->divisionids = Division::get();
        $this->selectedDivision = NULL;
        $this->selectedUnit = NULL;


}

public function updatedSelectedDivision($divisionid) {
    if(!is_null($divisionid))
    {     
            $this->unitids = routeOffice::where('office_id', $this->selectedOffice)->where('division_id', $divisionid)->get();
            
            $this->selectedUnit = NULL;

    }    
}


public function rejectVoucher() {

    if ($this->authorize('AcceptIncoming', $this->selected_voucher))
        {            
            $Route = new Route();
            $Route->actiondate = Carbon::now()->format('Y-m-d');
            $Route->sequenceid = $this->selected_voucher->sequenceid;
            $User = Employee::where('email', auth('web')->user()->email)->get()->first();
            $Route->officeid = $User->officeid;
            $Route->divisionid = $User->divisionid;
            $Route->unitid = $User->unitid;
            $Route->action = 'REJECTED';
            $Route->is_active = true;
            $Route->is_accepted = false;
            $Route->is_rejected = true;
            $Route->is_forwarded = false;
            $Route->remarks = NULL;
            $Route->userid = auth('web')->user()->id;
            $Route->from_office = $User->officeid;
            $Route->from_division = $User->divisionid;
            $Route->from_unit = $User->unitid;

            $Success = $Route->save();

            if ($Success)
            {
            
            $Document = voucher::where('sequenceid',$this->selected_voucher->sequenceid)->get()->first();

            $Document->is_forwarded = false;
            $Document->is_accepted = false;
            $Document->is_rejected = true;
            $Document->is_active = true;
            $Document->is_created = false;
            $Document->officeid = $User->officeid;
            $Document->divisionid = $User->divisionid;
            $Document->unitid = $User->unitid;
            $Document->from_userid = auth('web')->user()->id;
            $Document->from_officeid = $User->officeid;
            $Document->from_divisionid = $User->divisionid;
            $Document->from_unitid = $User->unitid;

            $SuccessDocument = $Document->save();

            if ($SuccessDocument)
            {
                $this->dispatchBrowserEvent('hideReject');
                $this->dispatchBrowserEvent('updateVoucher');
                $this->updateRouteList();
                $this->showToastr('Document ' . $this->selected_voucher->sequenceid . ' rejected Successfully.','success');
    
            }
            else
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
    
            }
            else
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        }
        else{
            $this->showToastr('You are not authorized to reject document ' . $this->selected_voucher->sequenceid . '.Please contact System Administrator','error');
        }
    }

public function approveVoucher() {

    if ($this->authorize('approveVoucher', $this->selected_voucher))
    {            
        $Route = new Route();
        $Route->actiondate = Carbon::now()->format('Y-m-d');
        $Route->sequenceid =  $this->selected_voucher->sequenceid;
        $User = Employee::where('email', auth('web')->user()->email)->get()->first();
        $Route->officeid = $User->officeid;
        $Route->divisionid = $User->divisionid;
        $Route->unitid = $User->unitid;
        $Route->action = 'VOUCHER APPROVED';
        $Route->is_active = true;
        $Route->is_accepted = true;
        $Route->is_rejected = false;
        $Route->is_forwarded = false;
        $Route->remarks = NULL;
        $Route->userid = auth('web')->user()->id;
        $Route->from_office = $User->officeid;
        $Route->from_division = $User->divisionid;
        $Route->from_unit = $User->unitid;

        $Success = $Route->save();

        if ($Success)
        {
        
            $this->dispatchBrowserEvent('hideApproveModal');
            $this->dispatchBrowserEvent('updateVoucher');
            $this->updateRouteList();
            $this->showToastr('Voucher ' . $this->selected_voucher->sequenceid . ' approved Successfully.','success');

        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }
    }
    else{
        $this->showToastr('You are not authorized to approve voucher ' .$this->selected_voucher->sequenceid . '.Please contact System Administrator','error');
    }


}



public function acceptVoucher() {
 
        if ($this->authorize('AcceptIncoming', $this->selected_voucher))
        {            
            $Route = new Route();
            $Route->actiondate = Carbon::now()->format('Y-m-d');
            $Route->sequenceid =  $this->selected_voucher->sequenceid;
            $User = Employee::where('email', auth('web')->user()->email)->get()->first();
            $Route->officeid = $User->officeid;
            $Route->divisionid = $User->divisionid;
            $Route->unitid = $User->unitid;
            $Route->action = 'ACCEPTED';
            $Route->is_active = true;
            $Route->is_accepted = true;
            $Route->is_rejected = false;
            $Route->is_forwarded = false;
            $Route->remarks = NULL;
            $Route->userid = auth('web')->user()->id;
            $Route->from_office = $User->officeid;
            $Route->from_division = $User->divisionid;
            $Route->from_unit = $User->unitid;

            $Success = $Route->save();

            if ($Success)
            {
            
            $Document = voucher::where('sequenceid', $this->selected_voucher->sequenceid)->get()->first();

            $Document->is_forwarded = false;
            $Document->is_accepted = true;
            $Document->is_rejected = false;
            $Document->is_active = true;
            $Document->is_created = false;
            $Document->officeid = $User->officeid;
            $Document->divisionid = $User->divisionid;
            $Document->unitid = $User->unitid;
            $Document->from_userid = auth('web')->user()->id;
            $Document->from_officeid = $User->officeid;
            $Document->from_divisionid = $User->divisionid;
            $Document->from_unitid = $User->unitid;

            $SuccessDocument = $Document->save();

            if ($SuccessDocument)
            {
            
                $this->dispatchBrowserEvent('hideAccept');
                $this->dispatchBrowserEvent('updateVoucher');
                $this->updateRouteList();
                $this->showToastr('Voucher ' . $this->selected_voucher->sequenceid . ' accepted Successfully.','success');

    
            }
            else
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
    
            }
            else
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        }
        else{
            $this->showToastr('You are not authorized to accept voucher ' .$this->selected_voucher->sequenceid . '.Please contact System Administrator','error');
        }
  
}

public function addGAACharging() {


    $Voucher = voucher::where('sequenceid',$this->sequenceid )->get()->first();

    $this->authorize('addRoute', $Voucher);
    $this->validate([
        'selectedOfficeFM' => 'required',
        'selectedPAP' => 'required',
        'selectedYear' => 'required',
        'selectedExpenseClass' => 'required',
        'selectedActivity' => 'required',
        'selectedUACS' => 'required',
        'activity_rem_bal' => 'required',
        'activity_charging' => 'required',
        'uacs_charging' => 'required',
        'uacs_rem_bal' => 'required',
 
    ], [
        'selectedOfficeFM.required' => 'Office field is required.',
        'selectedPAP.required' => 'PAP field is required.',
        'selectedYear.required' => 'Year field is required.',
        'selectedExpenseClass.required' => 'Expense Class field is required.',
        'selectedActivity.required' => 'Activity field is required.',
        'selectedUACS.required' => 'UACS field is required.',
        'activity_rem_bal.required' => 'Activity Remaining Balance field is required.',
        'activity_charging.required' => 'Activity Charging Amount field is required.',
        'uacs_charging.required' => 'UACS Charging Amount field is required.',
        'uacs_rem_bal.required' => 'UACS Remaining Balance field is required.',

    ]);

    if ($this->activity_temp_bal < $this->activity_charging)
    {
        $this->showToastr('Unable to Process. Activity Charging Amount is larger than the Remaining Balance.','error');
    }

    if ($this->uacs_temp_bal < $this->uacs_charging)
    {
        $this->showToastr('Unable to Process. UACS Charging Amount is larger than the Remaining Balance.','error');    
    }

    if ($this->uacs_temp_bal >= $this->uacs_charging && $this->activity_temp_bal >= $this->activity_charging)
    {
      
    }
  
}

public function deleteDVNumber($id) {
    $this->authorize('destroyAccountingEntry', $this->selected_voucher);
    $DVNumber = DVNumber::findOrFail($id);
    $this->selected_dv_number = $DVNumber->id;
    $this->resetErrorBag();
    $this->dispatchBrowserEvent('showDeleteDVModal');

}
public function destroyDVNUmber() {
    $this->authorize('destroyAccountingEntry', $this->selected_voucher);
    if ($this->selected_dv_number) {
        $DVNumber = DVNumber::findOrFail($this->selected_dv_number);
        
        $Success = $DVNumber->delete();

        if ($Success) {

            $Route = new Route();
            $Route->actiondate = Carbon::now()->format('Y-m-d');
            $Route->sequenceid =  $this->sequenceid;
            $User = Employee::where('email', auth('web')->user()->email)->get()->first();
        
            $Route->officeid = $User->officeid;
            $Route->divisionid = $User->divisionid;
            $Route->unitid = $User->unitid;
            $Route->action = 'DV DELETED';
            $Route->is_active = true;
            $Route->is_accepted = true;
            $Route->is_rejected = false;
            $Route->is_forwarded = false;
            $Route->remarks = 'DV Number : ' . $this->dv_number . ' JEV Number : ' . $this->jev_number;
            $Route->userid = auth('web')->user()->id;
            $Route->from_office = $User->officeid;
            $Route->from_division = $User->divisionid;
            $Route->from_unit = $User->unitid;
            $Success = $Route->save();
            
            if ($Success) {
                $this->dispatchBrowserEvent('hideDeleteDVModal');
                $this->dispatchBrowserEvent('updateVoucher');
                $this->updateRouteList();
                $this->selected_dv_number = null;
                $this->dv_number = null;
                $this->jev_number = null;
                $this->showToastr('Office has been successfully Deleted.','success');
            }
            else
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');  
            }
 
        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');  
        }
    
    }
}

public function BoxD() {
    $this->authorize('addAccountingEntry', $this->selected_voucher);

    if ($this->selected_voucher->BoxD) {
        
        
         $this->update_boxd = true;

   
        $this->selected_box_d = null;
        $this->box_d = $this->selected_voucher->BoxD->id;

         $this->dispatchBrowserEvent('showBoxDSignatory');
    }
    else {
        $this->update_boxd = false;
        $this->dispatchBrowserEvent('showBoxDSignatory');
    }
}


public function addBoxD() {

    $this->authorize('addAccountingEntry', $this->selected_voucher);

    $this->validate([
        'selected_box_d' => 'required',
    ],[
        'selected_box_d.required' => 'Box D Signatory field is required.',
    ]);

    $Signatory = new BoxD();

    $Signatory->signatoryid = $this->selected_box_d;
    $Signatory->voucher_id = $this->selected_voucher->id;

    $Success = $Signatory->save();

    if ($Success) {
        $Route = new Route();
        $Route->actiondate = Carbon::now()->format('Y-m-d');
        $Route->sequenceid =  $this->sequenceid;
        $User = Employee::where('email', auth('web')->user()->email)->get()->first();
    
        $Route->officeid = $User->officeid;
        $Route->divisionid = $User->divisionid;
        $Route->unitid = $User->unitid;
        $Route->action = 'BOX D SIGNATORY CREATED';
        $Route->is_active = true;
        $Route->is_accepted = true;
        $Route->is_rejected = false;
        $Route->is_forwarded = false;

        $Route->remarks = NULL;
        $Route->userid = auth('web')->user()->id;
        $Route->from_office = $User->officeid;
        $Route->from_division = $User->divisionid;
        $Route->from_unit = $User->unitid;
        $Success = $Route->save();

        if ($Success) {
            $this->selected_box_d = null;
     
            $this->dispatchBrowserEvent('updateVoucher');
            $this->dispatchBrowserEvent('hideBoxDSignatory');
            $this->updateRouteList();
            $this->showToastr('BOX D Signatory Added Successfully','success');
        }
        else {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }


    }
    else {
        $this->showToastr('Something went wrong. Please contact System Administrator','error');
    }

    
}

public function updateBoxD() {

    $this->authorize('addAccountingEntry', $this->selected_voucher);

    $this->validate([
        'selected_box_d' => 'required',
    ],[
        'selected_box_d.required' => 'Box D Signatory field is required.',
    ]);
 
    $Signatory = BoxD::where('id', $this->selected_voucher->BoxD->id)->get()->first();

    if ($Signatory) {
        $Signatory->signatoryid = $this->selected_box_d;

        $Success = $Signatory->save();

        if ($Success) {
            $Route = new Route();
            $Route->actiondate = Carbon::now()->format('Y-m-d');
            $Route->sequenceid =  $this->sequenceid;
            $User = Employee::where('email', auth('web')->user()->email)->get()->first();
        
            $Route->officeid = $User->officeid;
            $Route->divisionid = $User->divisionid;
            $Route->unitid = $User->unitid;
            $Route->action = 'BOX D SIGNATORY UPDATED';
            $Route->is_active = true;
            $Route->is_accepted = true;
            $Route->is_rejected = false;
            $Route->is_forwarded = false;
            $Route->remarks = null;
            $Route->userid = auth('web')->user()->id;
            $Route->from_office = $User->officeid;
            $Route->from_division = $User->divisionid;
            $Route->from_unit = $User->unitid;
            $Success = $Route->save();

            if ($Success) {
                $this->selected_box_d = null;
            
                $this->dispatchBrowserEvent('updateVoucher');
                $this->dispatchBrowserEvent('hideBoxDSignatory');
                $this->updateRouteList();
                $this->showToastr('BOX D Signatory Added Successfully','success');
            }
            else {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }


        }
        else {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }
    }
}

public function AccountingEntry() {
    $this->authorize('addAccountingEntry', $this->selected_voucher);

    if ($this->selected_voucher->AccountingEntry) {
        
        
         $this->update_accounting_entry = true;
        $this->selectedAccountTitle = $this->selected_voucher->AccountingEntry->activity_id;
        $this->selectedAccountUACS = $this->selected_voucher->AccountingEntry->uacs_id;
        $this->a_debit =  $this->selected_voucher->AccountingEntry->debit;
        $this->a_credit =  $this->selected_voucher->AccountingEntry->credit;

         $this->dispatchBrowserEvent('showAccountingEntryModal');
    }
    else {
        $this->update_accounting_entry = false;
        $this->dispatchBrowserEvent('showAccountingEntryModal');
    }
}



public function addAccountingEntry() {

    $this->authorize('addAccountingEntry', $this->selected_voucher);

    $this->validate([
        'selectedAccountTitle' => 'required',
        'selectedAccountUACS' => 'required',
    ],[
        'selectedAccountUACS.required' => 'UACS field is required.',
        'selectedAccountTitle.required' => 'Account Title field is required.',
    ]);

    $AccountingEntry = new AccountingEntry();

    $AccountingEntry->activity_id = $this->selectedAccountTitle;
    $AccountingEntry->uacs_id = $this->selectedAccountUACS;
    $AccountingEntry->voucher_id = $this->selected_voucher->id;
    $AccountingEntry->userid = auth('web')->user()->id;

    if($this->a_debit) {
        $AccountingEntry->debit = $this->a_debit;
    }
    if($this->a_credit) {
        $AccountingEntry->credit = $this->a_credit;
    }
    $Success = $AccountingEntry->save();

    if ($Success) {
        $Route = new Route();
        $Route->actiondate = Carbon::now()->format('Y-m-d');
        $Route->sequenceid =  $this->sequenceid;
        $User = Employee::where('email', auth('web')->user()->email)->get()->first();
    
        $Route->officeid = $User->officeid;
        $Route->divisionid = $User->divisionid;
        $Route->unitid = $User->unitid;
        $Route->action = 'ACCOUNTING ENTRY CREATED';
        $Route->is_active = true;
        $Route->is_accepted = true;
        $Route->is_rejected = false;
        $Route->is_forwarded = false;
        $Route->remarks = null;
        $Route->userid = auth('web')->user()->id;
        $Route->from_office = $User->officeid;
        $Route->from_division = $User->divisionid;
        $Route->from_unit = $User->unitid;
        $Success = $Route->save();

        if ($Success) {
            $this->selectedAccountTitle = null;
            $this->selectedAccountUACS = null;
            $this->dispatchBrowserEvent('updateVoucher');
            $this->dispatchBrowserEvent('hideAccountingEntryModal');
            $this->updateRouteList();
            $this->showToastr('Accounting Entry Added Successfully','success');
        }
        else {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }


    }
    else {
        $this->showToastr('Something went wrong. Please contact System Administrator','error');
    }



}

public function updateAccountingEntry() {

    $this->authorize('addAccountingEntry', $this->selected_voucher);

    $this->validate([
        'selectedAccountTitle' => 'required',
        'selectedAccountUACS' => 'required',
    ],[
        'selectedAccountUACS.required' => 'UACS field is required.',
        'selectedAccountTitle.required' => 'Account Title field is required.',
    ]);

    $AccountingEntry = AccountingEntry::where('id', $this->selected_voucher->AccountingEntry->id)->get()->first();
    $AccountingEntry->activity_id = $this->selectedAccountTitle;
    $AccountingEntry->uacs_id = $this->selectedAccountUACS;
    $AccountingEntry->voucher_id = $this->selected_voucher->id;
    $AccountingEntry->userid = auth('web')->user()->id;

    if($this->a_debit) {
        $AccountingEntry->debit = $this->a_debit;
    }
    if($this->a_credit) {
        $AccountingEntry->credit = $this->a_credit;
    }
    $Success = $AccountingEntry->save();

    if ($Success) {
        $Route = new Route();
        $Route->actiondate = Carbon::now()->format('Y-m-d');
        $Route->sequenceid =  $this->sequenceid;
        $User = Employee::where('email', auth('web')->user()->email)->get()->first();
    
        $Route->officeid = $User->officeid;
        $Route->divisionid = $User->divisionid;
        $Route->unitid = $User->unitid;
        $Route->action = 'ACCOUNTING ENTRY UPDATED';
        $Route->is_active = true;
        $Route->is_accepted = true;
        $Route->is_rejected = false;
        $Route->is_forwarded = false;
        $Route->remarks = null;
        $Route->userid = auth('web')->user()->id;
        $Route->from_office = $User->officeid;
        $Route->from_division = $User->divisionid;
        $Route->from_unit = $User->unitid;
        $Success = $Route->save();
        if ($Success) {
            $this->selectedAccountTitle = null;
            $this->selectedAccountUACS = null;
            $this->dispatchBrowserEvent('updateVoucher');
            $this->dispatchBrowserEvent('hideAccountingEntryModal');
            $this->updateRouteList();
            $this->showToastr('Accounting Entry Added Successfully','success');;
        }
        else {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }
    }
    else {
        $this->showToastr('Something went wrong. Please contact System Administrator','error');
    }

}

public function ReviewDocuments() {
    $this->authorize('addAccountingEntry', $this->selected_voucher);

    if ($this->selected_voucher->ReviewOfDocuments) {
        
        
         $this->update_review = true;
         
         $this->is_available = $this->selected_voucher->ReviewOfDocuments->is_available;
         $this->is_subject = $this->selected_voucher->ReviewOfDocuments->is_subject;
         $this->is_supporting = $this->selected_voucher->ReviewOfDocuments->is_supporting;
        

         $this->dispatchBrowserEvent('showReviewModal');
    }
    else {
        $this->update_review = false;
        $this->dispatchBrowserEvent('showReviewModal');
    }
}

public function addReview() {
    $this->authorize('addAccountingEntry', $this->selected_voucher);

    $Review = new ReviewofDocuments();

    if($this->is_available == true)
    {
        $Review->is_available = true;
    }

    if($this->is_subject == true)
    {
        $Review->is_subject = true;
    }

    if($this->is_supporting == true)
    {
        $Review->is_supporting = true;
    }

    $Review->voucher_id =  $this->selected_voucher->id;
    $Review->userid =  auth('web')->user()->id;

    $Success = $Review->save();

    if ($Success) {

        $Route = new Route();
        $Route->actiondate = Carbon::now()->format('Y-m-d');
        $Route->sequenceid =  $this->sequenceid;
        $User = Employee::where('email', auth('web')->user()->email)->get()->first();
    
        $Route->officeid = $User->officeid;
        $Route->divisionid = $User->divisionid;
        $Route->unitid = $User->unitid;
        $Route->action = 'REVIEW OF DOCUMENT CREATED';
        $Route->is_active = true;
        $Route->is_accepted = true;
        $Route->is_rejected = false;
        $Route->is_forwarded = false;
        $Route->remarks = null;
        $Route->userid = auth('web')->user()->id;
        $Route->from_office = $User->officeid;
        $Route->from_division = $User->divisionid;
        $Route->from_unit = $User->unitid;
        $Success = $Route->save();
        if ($Success) {

            $this->update_review = true;
            $this->dispatchBrowserEvent('updateVoucher');
            $this->dispatchBrowserEvent('hideReviewModal');
            $this->updateRouteList();
            $this->showToastr('Review of Documents Added Successfully','success');
        }
        else {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }

    }
    else {
        $this->showToastr('Something went wrong. Please contact System Administrator','error');
    }

}

public function updateReview() {
    $this->authorize('addAccountingEntry', $this->selected_voucher);
    $Review = ReviewofDocuments::where('id', $this->selected_voucher->ReviewOfDocuments->id)->get()->first();
    if($Review) 
    {
        if($this->is_available == true)
        {
            $Review->is_available = true;
        }
        else {
            $Review->is_available = false;
        }

        if($this->is_subject == true)
        {
            $Review->is_subject = true;
        }
        else {
            $Review->is_subject = false;
        }

        if($this->is_supporting == true)
        {
            $Review->is_supporting = true;
        }
        else {
            $Review->is_supporting = false;
        }

        $Success = $Review->save();

        if ($Success) {

            $Route = new Route();
            $Route->actiondate = Carbon::now()->format('Y-m-d');
            $Route->sequenceid =  $this->sequenceid;
            $User = Employee::where('email', auth('web')->user()->email)->get()->first();
        
            $Route->officeid = $User->officeid;
            $Route->divisionid = $User->divisionid;
            $Route->unitid = $User->unitid;
            $Route->action = 'REVIEW OF DOCUMENT UPDATED';
            $Route->is_active = true;
            $Route->is_accepted = true;
            $Route->is_rejected = false;
            $Route->is_forwarded = false;
            $Route->remarks = null;
            $Route->userid = auth('web')->user()->id;
            $Route->from_office = $User->officeid;
            $Route->from_division = $User->divisionid;
            $Route->from_unit = $User->unitid;
            $Success = $Route->save();
            if ($Success) {

                $this->update_review = true;
                $this->dispatchBrowserEvent('updateVoucher');
                $this->dispatchBrowserEvent('hideReviewModal');
                $this->updateRouteList();
                $this->showToastr('Review of Documents Updated Successfully','success');
            }
            else {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }

        }
        else {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }
    }
}

public function deleteReviewOfDocuments($id) {
    $this->authorize('destroyAccountingEntry',$this->selected_voucher );
    $ReviewOfDocument = ReviewofDocuments::findOrFail($id);
    $this->delete_selected_review = $ReviewOfDocument->id;
    $this->resetErrorBag();
    $this->dispatchBrowserEvent('showdeleteReviewModal');

}

public function destroyReview() {

    $this->authorize('destroyAccountingEntry',$this->selected_voucher );
    if ($this->delete_selected_review) {
        $Review = ReviewofDocuments::findOrFail($this->delete_selected_review);
        
        $Success = $Review->delete();

        if ($Success) {

            $Route = new Route();
            $Route->actiondate = Carbon::now()->format('Y-m-d');
            $Route->sequenceid =  $this->sequenceid;
            $User = Employee::where('email', auth('web')->user()->email)->get()->first();
        
            $Route->officeid = $User->officeid;
            $Route->divisionid = $User->divisionid;
            $Route->unitid = $User->unitid;
            $Route->action = 'REVIEW DELETED';
            $Route->is_active = true;
            $Route->is_accepted = true;
            $Route->is_rejected = false;
            $Route->is_forwarded = false;
            $Route->remarks = null;
            $Route->userid = auth('web')->user()->id;
            $Route->from_office = $User->officeid;
            $Route->from_division = $User->divisionid;
            $Route->from_unit = $User->unitid;
            $Success = $Route->save();
            
            if ($Success) {
                $this->dispatchBrowserEvent('hidedeleteReviewModal');
                $this->dispatchBrowserEvent('updateVoucher');
                $this->updateRouteList();
                $this->delete_selected_review = null;
                $this->is_subject = false;
                $this->is_supporting = false;
                $this->is_available = false;
                $this->showToastr('Office has been successfully Deleted.','success');
            }
            else
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');  
            }
 
        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');  
        }
    
    }



}

public function disburse() {
    $this->authorize('addADA', $this->selected_voucher); 
    $this->dispatchBrowserEvent('showDisburse');
    
}

public function disburseVoucher() {
    $this->authorize('addADA', $this->selected_voucher);

    if($this->ChargingActivities->count() == 0 && $this->ChargingUACS->count() > 0 && $this->ChargingSAA->count() > 0)
    {
        $this->showToastr('No charging to disburse','error');  
    }
    else 
    {

    
        if($this->ChargingActivities->count() > 0)
        {   
            $Chargings = GaaCharging::where('voucher_id', $this->selected_voucher->id)->get();
            if ($Chargings)
            {
                foreach ($Chargings as $Charging)
                {
                    $Charging->is_disbursed = true;
                    $Charging->save();
                }
           }
        }   
      
        if($this->ChargingPAP->count() > 0)
        {   
            $Chargings = GaaChargingPAP::where('voucher_id', $this->selected_voucher->id)->get();
            if ($Chargings)
            {
                foreach ($Chargings as $Charging)
                {
                    $Charging->is_disbursed = true;
                    $Charging->save();
                }
            }
          
        }   

        if($this->ChargingUACS->count() > 0)
        {   
            $Chargings = GaaChargingUACS::where('voucher_id', $this->selected_voucher->id)->get();
            if ($Chargings)
            {
                foreach ($Chargings as $Charging)
                {
                    $Charging->is_disbursed = true;
                    $Charging->save();
                }
            }
          
        }  

            
        if($this->ChargingSAA->count() > 0)
        {   
            $Chargings = SaaCharging::where('voucher_id', $this->selected_voucher->id)->get();
            if ($Chargings)
            {
                foreach ($Chargings as $Charging)
                {
                    $Charging->is_disbursed = true;
                    $Charging->save();
                
                }
            }
        } 
        
        $Route = new Route();
        $Route->actiondate = Carbon::now()->format('Y-m-d');
        $Route->sequenceid =  $this->sequenceid;
        $User = Employee::where('email', auth('web')->user()->email)->get()->first();
    
        $Route->officeid = $User->officeid;
        $Route->divisionid = $User->divisionid;
        $Route->unitid = $User->unitid;
        $Route->action = 'VOUCHER DISBURSED';
        $Route->is_active = true;
        $Route->is_accepted = true;
        $Route->is_rejected = false;
        $Route->is_forwarded = false;
        $Route->remarks = '';
        $Route->userid = auth('web')->user()->id;
        $Route->from_office = $User->officeid;
        $Route->from_division = $User->divisionid;
        $Route->from_unit = $User->unitid;
        $Success = $Route->save();

        if ($Success)
        {

         $this->dispatchBrowserEvent('hideDisubrse');
         $this->updateRouteList();
        

        $this->showToastr('Voucher disbursed Successfully','success');
        }
        else {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');  
        }
  
    }
}




public function CheckAda() {
    $this->authorize('addADA', $this->selected_voucher);

    if ($this->selected_voucher->CheckAda) {
        $this->mop = $this->selected_voucher->CheckAda->mop;
        $this->check_ada = $this->selected_voucher->CheckAda->adano;
        $this->update_checkada = true;
        $this->dispatchBrowserEvent('showCheckAdaModal');
    }
    else {

        $this->update_checkada = false;
        $this->dispatchBrowserEvent('showCheckAdaModal');
    }

}

public function deleteCheckAda($id) {
    $this->authorize('destroyADA', $this->selected_voucher);
    $ADA = CheckADA::findOrFail($id);
    $this->delete_selected_ada = $ADA->id;
    $this->resetErrorBag();
    $this->dispatchBrowserEvent('showdeleteADAModal');

}


public function destroyADA() {
    $this->authorize('destroyADA', $this->selected_voucher);

    if ($this->delete_selected_ada) {
        $ADA = CheckADA::findOrFail($this->delete_selected_ada);
        
        $Success = $ADA->delete();

        if ($Success) {

            $Route = new Route();
            $Route->actiondate = Carbon::now()->format('Y-m-d');
            $Route->sequenceid =  $this->sequenceid;
            $User = Employee::where('email', auth('web')->user()->email)->get()->first();
        
            $Route->officeid = $User->officeid;
            $Route->divisionid = $User->divisionid;
            $Route->unitid = $User->unitid;
            $Route->action = 'CHECK / ADA DELETED';
            $Route->is_active = true;
            $Route->is_accepted = true;
            $Route->is_rejected = false;
            $Route->is_forwarded = false;
            $Route->remarks = null;
            $Route->userid = auth('web')->user()->id;
            $Route->from_office = $User->officeid;
            $Route->from_division = $User->divisionid;
            $Route->from_unit = $User->unitid;
            $Success = $Route->save();
            
            if ($Success) {
                $this->dispatchBrowserEvent('hidedeleteADAModal');
                $this->dispatchBrowserEvent('updateVoucher');
                $this->updateRouteList();
                $this->delete_selected_ada = null;
                $this->check_ada = null;
                $this->mop = null;
                $this->showToastr('Check / ADA has been successfully Deleted.','success');
            }
            else
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');  
            }
 
        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');  
        }
    
    }
}

public function addCheckAda() {
    $this->authorize('addADA', $this->selected_voucher);
    $this->validate([
        'check_ada' => 'required',
        'mop' => 'required',
    ],[
        'check_ada.required' => 'Check / ADA  field is required.',
        'mop.required' => 'Mode of Payment field is required.',
       
    ]);

    $Cashier = new CheckADA();
    $Cashier->voucher_id = $this->selected_voucher->id;
    $Cashier->adano = $this->check_ada;
    $Cashier->mop = $this->mop;
    $Cashier->userid =  auth('web')->user()->id;

    $Success = $Cashier->save();
    
    if ($Success) {

        $Route = new Route();
        $Route->actiondate = Carbon::now()->format('Y-m-d');
        $Route->sequenceid =  $this->sequenceid;
        $User = Employee::where('email', auth('web')->user()->email)->get()->first();
    
        $Route->officeid = $User->officeid;
        $Route->divisionid = $User->divisionid;
        $Route->unitid = $User->unitid;
        $Route->action = 'CHECK / ADA CREATED';
        $Route->is_active = true;
        $Route->is_accepted = true;
        $Route->is_rejected = false;
        $Route->is_forwarded = false;
        $Route->remarks = 'CHECK / ADA Number :' . $this->check_ada;
        $Route->userid = auth('web')->user()->id;
        $Route->from_office = $User->officeid;
        $Route->from_division = $User->divisionid;
        $Route->from_unit = $User->unitid;
        $Success = $Route->save();
        
        if ($Success) {
            $this->dispatchBrowserEvent('hideCheckAdaMOdal');
            $this->dispatchBrowserEvent('updateVoucher');
            $this->updateRouteList();
            $this->showToastr('Check Ada added Successfully.','success');
        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');  
        }

    }
    else {
        $this->showToastr('Something went wrong. Please contact System Administrator','error');  
    }

}

public function DVNumber() {
    $this->authorize('addAccountingEntry', $this->selected_voucher);

    if ($this->selected_voucher->DVNumber) {
        
        
         $this->update_dv = true;
         
         $this->jev_number = $this->selected_voucher->DVNumber->jev_no;
         $this->dv_number = $this->selected_voucher->DVNumber->dv_no;
         $this->dispatchBrowserEvent('showDVModal');
    }
    else {
        $this->update_dv = false;
        $this->dispatchBrowserEvent('showDVModal');
    }
}

public function updateDVNumber() {
    $this->authorize('addAccountingEntry', $this->selected_voucher);

    $DVNumber = DVNumber::where('id', $this->selected_voucher->DVNumber->id)->get()->first();
    $this->validate([
        'dv_number' => 'required|unique:fm_a_dv,dv_no,'.$DVNumber->id,
        'jev_number' => 'required|unique:fm_a_dv,jev_no,'.$DVNumber->id,
    ],[
        'dv_number.required' => 'DV Number field is required.',
        'dv_number.unique' => 'Duplicate DV Number.',
        'jev_number.required' => 'JEV Number field is required.',
        'jev_number.unique' => 'Duplicate JEV Number.',
    ]);


    $DVNumber->dv_no = $this->dv_number;
    $DVNumber->jev_no = $this->jev_number;

    $Success = $DVNumber->save();

    if ($Success) {
        $Route = new Route();
        $Route->actiondate = Carbon::now()->format('Y-m-d');
        $Route->sequenceid =  $this->sequenceid;
        $User = Employee::where('email', auth('web')->user()->email)->get()->first();
    
        $Route->officeid = $User->officeid;
        $Route->divisionid = $User->divisionid;
        $Route->unitid = $User->unitid;
        $Route->action = 'DV UPDATED';
        $Route->is_active = true;
        $Route->is_accepted = true;
        $Route->is_rejected = false;
        $Route->is_forwarded = false;
        $Route->remarks = 'DV Number : ' . $this->dv_number . ' JEV Number : ' . $this->jev_number;
        $Route->userid = auth('web')->user()->id;
        $Route->from_office = $User->officeid;
        $Route->from_division = $User->divisionid;
        $Route->from_unit = $User->unitid;
        $Success = $Route->save();
        if ($Success) {
            $this->update_dv = true;
            $this->dispatchBrowserEvent('updateVoucher');
            $this->dispatchBrowserEvent('hideDVModal');
            $this->updateRouteList();
            $this->showToastr('DV/JEV Number updated Successfully','success');
        }
        else {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }
    }
    else {
        $this->showToastr('Something went wrong. Please contact System Administrator','error');
    }
}

public function addDVNumber() {

    $this->authorize('addAccountingEntry', $this->selected_voucher);
    $this->validate([
        'dv_number' => 'required|unique:fm_a_dv,dv_no',
        'jev_number' => 'required|unique:fm_a_dv,jev_no',
    ],[
        'dv_number.required' => 'DV Number field is required.',
        'dv_number.unique' => 'Duplicate DV Number.',
        'jev_number.required' => 'JEV Number field is required.',
        'jev_number.unique' => 'Duplicate JEV Number.',
    ]);


    $DVNumber = new DVNumber();
    $DVNumber->voucher_id = $this->selected_voucher->id;
    $DVNumber->dv_no = $this->dv_number;
    $DVNumber->jev_no = $this->jev_number;
    $DVNumber->userid =  auth('web')->user()->id;

    $Success = $DVNumber->save();

    if ($Success) {

        $Route = new Route();
        $Route->actiondate = Carbon::now()->format('Y-m-d');
        $Route->sequenceid =  $this->sequenceid;
        $User = Employee::where('email', auth('web')->user()->email)->get()->first();
    
        $Route->officeid = $User->officeid;
        $Route->divisionid = $User->divisionid;
        $Route->unitid = $User->unitid;
        $Route->action = 'DV CREATED';
        $Route->is_active = true;
        $Route->is_accepted = true;
        $Route->is_rejected = false;
        $Route->is_forwarded = false;
        $Route->remarks = 'DV Number : ' . $this->dv_number . ' JEV Number : ' . $this->jev_number;
        $Route->userid = auth('web')->user()->id;
        $Route->from_office = $User->officeid;
        $Route->from_division = $User->divisionid;
        $Route->from_unit = $User->unitid;
        $Success = $Route->save();
        if ($Success) {

            $this->update_dv = true;
            $this->dispatchBrowserEvent('updateVoucher');
            $this->dispatchBrowserEvent('hideDVModal');
            $this->updateRouteList();
            $this->showToastr('DV/JEV Number Added Successfully','success');
        }
        else {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }

    }
    else {
        $this->showToastr('Something went wrong. Please contact System Administrator','error');
    }



}


public function addRoute() {
    $Voucher = voucher::where('sequenceid',$this->sequenceid )->get()->first();
    $this->authorize('addRoute', $Voucher);
    $this->validate([
        'selectedOffice' => 'required',
        'selectedDivision' => 'required',
        'selectedUnit' => 'required',

    ]);

    $Route = new Route();
    $Route->actiondate = Carbon::now()->format('Y-m-d');
    $Route->sequenceid =  $this->sequenceid;
    $User = Employee::where('email', auth('web')->user()->email)->get()->first();

    $Route->officeid = $this->selectedOffice;
    $Route->divisionid = $this->selectedDivision;
    $Route->unitid = $this->selectedUnit;
    $Route->action = 'FORWARD TO';
    $Route->is_active = true;
    $Route->is_accepted = false;
    $Route->is_rejected = false;
    $Route->is_forwarded = true;
    $Route->remarks = $this->route_remarks;
    $Route->userid = auth('web')->user()->id;
    $Route->from_office = $User->officeid;
    $Route->from_division = $User->divisionid;
    $Route->from_unit = $User->unitid;

    $Success = $Route->save();

    if ($Success)
    {
        
        $Voucher = voucher::where('sequenceid', $this->sequenceid)->get()->first();

        $Voucher->is_forwarded = true;
        $Voucher->is_accepted = false;
        $Voucher->is_rejected = false;
        $Voucher->is_active = true;
        $Voucher->is_created = false;
        $Voucher->officeid = $this->selectedOffice;
        $Voucher->divisionid = $this->selectedDivision;
        $Voucher->unitid = $this->selectedUnit;
        $Voucher->from_userid = auth('web')->user()->id;
    
        $Voucher->from_officeid = $User->officeid;
        $Voucher->from_divisionid = $User->divisionid;
        $Voucher->from_unitid = $User->unitid;

        $SuccessDocument = $Voucher->save();

        if ($SuccessDocument)
        {

            $this->dispatchBrowserEvent('hideAddRouteModal');
            $this->dispatchBrowserEvent('updateVoucher');
            $this->updateRouteList();
            // $this->dispatchBrowserEvent('updateIncomingCount');
            $this->route_remarks = null;
            $this->selectedDivision= null;
            $this->selectedOffice= null;
            $this->selectedUnit= null;
            $this->showToastr('Route added Successfully.','success');

        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }

    }
    else
    {
        $this->showToastr('Something went wrong. Please contact System Administrator','error');
    }

}

public function addGAAChargingActivity() {
   

    $this->authorize('AddCharging',$this->selected_voucher);

    $this->validate([
        'selectedOfficeFM' => 'required',
        'selectedPAP' => 'required',
        'selectedYear' => 'required',
        'selectedExpenseClass' => 'required',
        'selectedActivity' => 'required',
        'activity_rem_bal' => 'required',
        'activity_charging' => 'required',
        'rem_bal_activity_voucher' => 'required',
 
    ], [
        'selectedOfficeFM.required' => 'Office field is required.',
        'selectedPAP.required' => 'PAP field is required.',
        'selectedYear.required' => 'Year field is required.',
        'selectedExpenseClass.required' => 'Expense Class field is required.',
        'selectedActivity.required' => 'Activity field is required.',
        'activity_rem_bal.required' => 'Activity Remaining Balance field is required.',
        'activity_charging.required' => 'Activity Charging Amount field is required.',
        'rem_bal_activity_voucher.required' => 'Activity Charging Amount field is required.',
    ]);

    $Explode = str_replace( ',', '', $this->rem_bal_activity_voucher );
    $Explode = (float)$Explode;
    $this->activity_charging = (float)$this->activity_charging;
    $this->activity_temp_bal = (float)$this->activity_temp_bal;


    if ($this->activity_temp_bal < $this->activity_charging)
    {
        $this->showToastr('Unable to Process. Activity Charging Amount is larger than the Activity Remaining Balance.','error');
    }

    if ($Explode < $this->activity_charging)
    {
        $this->showToastr('Unable to Process. Activity Charging Amount is larger than the Voucher Remaining Balance.','error');
    }

    if ( $this->activity_temp_bal >= $this->activity_charging && $Explode >= $this->activity_charging)
    {
        $GaaChargingActivity = new GaaCharging();
        $ChargingID = AllocationActivity::where('pap_allocation',$this->selected_pap_allocation)->where('id', $this->selectedActivity)->get()->first();

        $GaaChargingActivity->charging_id = $ChargingID->id;
        $GaaChargingActivity->voucher_id = $this->selected_voucher->id;
        $GaaChargingActivity->amount = $this->activity_charging;

        $Success = $GaaChargingActivity->save();

        if ($Success) {

            
            $Voucher = voucher::where('sequenceid', $this->sequenceid)->get()->first();
            
            $Voucher->rem_bal_charging = $Voucher->rem_bal_charging - $this->activity_charging;;
            $success = $Voucher->save();

            if ($success)
            
            {
                $Charging = AllocationActivity::where('id', $this->selectedActivity)->get()->first();

                $Charging->rem_bal = $Charging->rem_bal - $this->activity_charging;;

                $Success1 = $Charging->save();

                if($Success1)
                {

                    $Route = new Route();
                    $Route->actiondate = Carbon::now()->format('Y-m-d');
                    $Route->sequenceid =  $this->sequenceid;
                    $User = Employee::where('email', auth('web')->user()->email)->get()->first();
                
                    $Route->officeid = $User->officeid;
                    $Route->divisionid = $User->divisionid;
                    $Route->unitid = $User->unitid;
                    $Route->action = 'CHARGING CREATED';
                    $Route->is_active = true;
                    $Route->is_accepted = true;
                    $Route->is_rejected = false;
                    $Route->is_forwarded = false;
                    $Route->remarks = 'Activity Charging Amount : ' .  number_format($this-> activity_charging,2,'.',',');
                    $Route->userid = auth('web')->user()->id;
                    $Route->from_office = $User->officeid;
                    $Route->from_division = $User->divisionid;
                    $Route->from_unit = $User->unitid;
                    $Success = $Route->save();
                    
                   if ($Success)
                   {

                    $newVoucher = voucher::where('sequenceid', $this->sequenceid)->get()->first();
                    $this->rem_bal_activity_voucher = number_format($newVoucher->rem_bal_charging,2,'.',',');
                    $NewCharging = AllocationActivity::where('id', $this->selectedActivity)->get()->first();
                    $this->activity_rem_bal =   number_format($NewCharging->rem_bal,2,'.',',');
                   
                    $this-> activity_charging = null;
                    $this->dispatchBrowserEvent('updateVoucher');
                    $this->updateRouteList();
                    $this->updateActivityList();
                    $this->showToastr('Activity Charging Added Successfully','success');
                   }
                   else 
                   {
                       $this->showToastr('Something went wrong. Please contact System Administrator','error');
                   }
                }
                else 
                {
                    $this->showToastr('Something went wrong. Please contact System Administrator','error');
                }
            }
            else 
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }

        }
        else 
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }
    }


}

public function chargingSAA() {
    $this->authorize('AddCharging',$this->selected_voucher);

    $this->validate([
        'selectedSAA' => 'required',
        'saa_rem_bal' => 'required',
        'saa_charging' => 'required',
 
    ], [
        'selectedSAA.required' => 'SAA Number field is required.',
        'saa_rem_bal.required' => 'Reamaining Balance is required.',
        'saa_charging.required' => 'Charging field is required.',
    ]);


    $Explode = str_replace( ',', '', $this->rem_bal_saa_voucher);
    $Explode = (float)$Explode;
    $this->saa_temp_bal = (float)$this->saa_temp_bal;
    $this->saa_charging = (float)$this->saa_charging;

    if ($this->saa_temp_bal < $this->saa_charging)
    {
        $this->showToastr('Unable to Process. SAA Charging Amount is larger than the SAA Remaining Balance.','error');
    }

    if ($Explode < $this->saa_charging)
    {
        $this->showToastr('Unable to Process. UACS Charging Amount is larger than the Voucher Remaining Balance.','error');
    }

    if ( $this->saa_temp_bal >= $this->saa_charging && $Explode >= $this->saa_charging)
    {
        $SAACharging = new SaaCharging();
        $ChargingID = SaaAllocation::where('id',$this->selectedSAA)->get()->first();

        $SAACharging->charging_id = $ChargingID->id;
        $SAACharging->voucher_id = $this->selected_voucher->id;
        $SAACharging->amount = $this->saa_charging;

        $Success = $SAACharging->save();

        if ($Success) {

            
            $Voucher = voucher::where('sequenceid', $this->sequenceid)->get()->first();
            
            $Voucher->rem_bal_saa = $Voucher->rem_bal_saa - $this->saa_charging;
            $success = $Voucher->save();

            if ($success)
            
            {
                $Charging = SaaAllocation::where('id', $this->selectedSAA)->get()->first();

                $Charging->rem_bal = $Charging->rem_bal - $this->saa_charging;

                $Success1 = $Charging->save();

                if($Success1)
                {

                    $Route = new Route();
                    $Route->actiondate = Carbon::now()->format('Y-m-d');
                    $Route->sequenceid =  $this->sequenceid;
                    $User = Employee::where('email', auth('web')->user()->email)->get()->first();
                
                    $Route->officeid = $User->officeid;
                    $Route->divisionid = $User->divisionid;
                    $Route->unitid = $User->unitid;
                    $Route->action = 'CHARGING CREATED';
                    $Route->is_active = true;
                    $Route->is_accepted = true;
                    $Route->is_rejected = false;
                    $Route->is_forwarded = false;
                    $Route->remarks = 'SAA Charging Amount : ' .  number_format($this-> saa_charging,2,'.',',');
                    $Route->userid = auth('web')->user()->id;
                    $Route->from_office = $User->officeid;
                    $Route->from_division = $User->divisionid;
                    $Route->from_unit = $User->unitid;
                    $Success = $Route->save();
                    
                   if ($Success)
                   {

                    $newVoucher = voucher::where('sequenceid', $this->sequenceid)->get()->first();
                    $this->rem_bal_saa_voucher = number_format($newVoucher->rem_bal_saa,2,'.',',');
                    $NewCharging = SaaAllocation::where('id', $this->selectedSAA)->get()->first();
                    $this->saa_rem_bal =   number_format($NewCharging->rem_bal,2,'.',',');
                   
                    $this-> saa_charging = null;
                    $this->dispatchBrowserEvent('updateVoucher');
                    $this->updateRouteList();
                    $this->updateSAAList();
                    
                    $this->showToastr('SAA Charging Added Successfully','success');
                   }
                   else 
                   {
                       $this->showToastr('Something went wrong. Please contact System Administrator','error');
                   }
                }
                else 
                {
                    $this->showToastr('Something went wrong. Please contact System Administrator','error');
                }
            }
            else 
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }

        }
        else 
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }
    }




}


public function addGAAChargingUACS() {


    $this->authorize('AddCharging',$this->selected_voucher);

    $this->validate([
        'selectedOfficeFM' => 'required',
        'selectedPAP' => 'required',
        'selectedYear' => 'required',
        'selectedExpenseClass' => 'required',
        'selectedUACS' => 'required',
        'uacs_rem_bal' => 'required',
        'uacs_charging' => 'required',
        'rem_bal_uacs_voucher' => 'required',
 
    ], [
        'selectedOfficeFM.required' => 'Office field is required.',
        'selectedPAP.required' => 'PAP field is required.',
        'selectedYear.required' => 'Year field is required.',
        'selectedExpenseClass.required' => 'Expense Class field is required.',
        'selectedUACS.required' => 'Activity field is required.',
        'uacs_rem_bal.required' => 'Activity Remaining Balance field is required.',
        'uacs_charging.required' => 'Activity Charging Amount field is required.',
        'rem_bal_uacs_voucher.required' => 'Activity Charging Amount field is required.',
    ]);

    $Explode = str_replace( ',', '', $this->rem_bal_uacs_voucher);
    $Explode = (float)$Explode;
    $this->uacs_temp_bal = (float)$this->uacs_temp_bal;
    $this->uacs_charging = (float)$this->uacs_charging;

    if ($this->uacs_temp_bal < $this->uacs_charging)
    {
        $this->showToastr('Unable to Process. UACS Charging Amount is larger than the Activity Remaining Balance.','error');
    }

    if ($Explode < $this->uacs_charging)
    {
        $this->showToastr('Unable to Process. UACS Charging Amount is larger than the Voucher Remaining Balance.','error');
    }

    if ( $this->uacs_temp_bal >= $this->uacs_charging && $Explode >= $this->uacs_charging)
    {
        $GaaCharging = new GaaChargingUACS();
        $ChargingID = AllocationUACS::where('pap_allocation',$this->selected_pap_allocation)->where('id', $this->selectedUACS)->get()->first();

        $GaaCharging->charging_id = $ChargingID->id;
        $GaaCharging->voucher_id = $this->selected_voucher->id;
        $GaaCharging->amount = $this->uacs_charging;

        $Success = $GaaCharging->save();

        if ($Success) {

            
            $Voucher = voucher::where('sequenceid', $this->sequenceid)->get()->first();
            
            $Voucher->rem_bal_uacs = $Voucher->rem_bal_uacs - $this->uacs_charging;
            $success = $Voucher->save();

            if ($success)
            
            {
                $Charging = AllocationUACS::where('id', $this->selectedUACS)->get()->first();

                $Charging->rem_bal = $Charging->rem_bal - $this->uacs_charging;

                $Success1 = $Charging->save();

                if($Success1)
                {

                    $Route = new Route();
                    $Route->actiondate = Carbon::now()->format('Y-m-d');
                    $Route->sequenceid =  $this->sequenceid;
                    $User = Employee::where('email', auth('web')->user()->email)->get()->first();
                
                    $Route->officeid = $User->officeid;
                    $Route->divisionid = $User->divisionid;
                    $Route->unitid = $User->unitid;
                    $Route->action = 'CHARGING CREATED';
                    $Route->is_active = true;
                    $Route->is_accepted = true;
                    $Route->is_rejected = false;
                    $Route->is_forwarded = false;
                    $Route->remarks = 'UACS Charging Amount : ' .  number_format($this-> uacs_charging,2,'.',',');
                    $Route->userid = auth('web')->user()->id;
                    $Route->from_office = $User->officeid;
                    $Route->from_division = $User->divisionid;
                    $Route->from_unit = $User->unitid;
                    $Success = $Route->save();
                    
                   if ($Success)
                   {

                    $newVoucher = voucher::where('sequenceid', $this->sequenceid)->get()->first();
                    $this->rem_bal_uacs_voucher = number_format($newVoucher->rem_bal_uacs,2,'.',',');
                    $NewCharging = AllocationUACS::where('id', $this->selectedUACS)->get()->first();
                    $this->uacs_rem_bal =   number_format($NewCharging->rem_bal,2,'.',',');
                   
                    $this-> uacs_charging = null;
                    $this->dispatchBrowserEvent('updateVoucher');
                    $this->updateRouteList();
                    $this->updateUACSList();
                    $this->showToastr('UACS Charging Added Successfully','success');
                   }
                   else 
                   {
                       $this->showToastr('Something went wrong. Please contact System Administrator','error');
                   }
                }
                else 
                {
                    $this->showToastr('Something went wrong. Please contact System Administrator','error');
                }
            }
            else 
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }

        }
        else 
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }
    }


}


public function deleteAccountingEntry($id) {
    $this->authorize('destroyAccountingEntry',$this->selected_voucher );
    $AccountingEntry = AccountingEntry::findOrFail($id);
    $this->delete_selected_accounting_entry = $AccountingEntry->id;
    $this->resetErrorBag();
    $this->dispatchBrowserEvent('showdeleteAccountingEntryModal');
}

public function destroyAccountingEntry() {
    $this->authorize('destroyAccountingEntry', $this->selected_voucher);

    if ($this->delete_selected_accounting_entry) {
        $AccountingEntry = AccountingEntry::findOrFail($this->delete_selected_accounting_entry);
        
        $Success = $AccountingEntry->delete();

        if ($Success) {

            $Route = new Route();
            $Route->actiondate = Carbon::now()->format('Y-m-d');
            $Route->sequenceid =  $this->sequenceid;
            $User = Employee::where('email', auth('web')->user()->email)->get()->first();
        
            $Route->officeid = $User->officeid;
            $Route->divisionid = $User->divisionid;
            $Route->unitid = $User->unitid;
            $Route->action = 'ACCOUNTING ENTRY DELETED';
            $Route->is_active = true;
            $Route->is_accepted = true;
            $Route->is_rejected = false;
            $Route->is_forwarded = false;
            $Route->remarks = null;
            $Route->userid = auth('web')->user()->id;
            $Route->from_office = $User->officeid;
            $Route->from_division = $User->divisionid;
            $Route->from_unit = $User->unitid;
            $Success = $Route->save();
            
            if ($Success) {
                $this->dispatchBrowserEvent('hidedeleteAccountingEntryModal');
                $this->dispatchBrowserEvent('updateVoucher');
                $this->updateRouteList();
                $this->delete_selected_accounting_entry = null;
                $this->a_credit = null;
                $this->a_debit = null;
                $this->showToastr('Office has been successfully Deleted.','success');
            }
            else
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');  
            }
 
        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');  
        }
    
    }
}

public function deleteSAACharging($id) {
    $this->authorize('destroyCharging',$this->selected_voucher );
    $SaaCharging = SaaCharging::findOrFail($id);
    $this->delete_selected_saa = $SaaCharging->id;
    $this->resetErrorBag();
    $this->dispatchBrowserEvent('showDeleteSAAChargingModal');
}

public function destroyChargingSAA() {
    $this->authorize('destroyCharging',$this->selected_voucher );
    if ($this->delete_selected_saa) {

        $GaaCharging = SaaCharging::findOrFail($this->delete_selected_saa);
        $Amount = $GaaCharging->amount;
        $Voucherid = $GaaCharging->voucher_id;
        $Chargingid = $GaaCharging->charging_id;
        $Success = $GaaCharging->delete();

        if ($Success)
        {

            $Voucher = voucher::where('id', $Voucherid)->get()->first();
            if ($Voucher) {
                $Voucher->rem_bal_saa = $Voucher->rem_bal_saa + $Amount;
                $Success1 = $Voucher->save();
                
                if($Success1) {
                    $this->dispatchBrowserEvent('hideDeleteSAAChargingModal');
          
                    $this->delete_selected_saa = null;
                    $this->showToastr('Voucher Remaining Balance returned Successfully','success');
                }   
                else {
                    $this->showToastr('Something went wrong. Please contact System Administrator','error');  
                }
            }
            else {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');  
            }

            $Allocation = SaaAllocation::where('id', $Chargingid)->get()->first();
            if ($Allocation) {
                $Allocation->rem_bal = $Allocation->rem_bal + $Amount;
                $Success1 = $Allocation->save();
                if ($Success1) 
                {
                    $this->dispatchBrowserEvent('hideDeleteSAAChargingModal');
                
                    $this->delete_selected_saa = null;
                    $this->showToastr('SAA Allocation Remaining Balance returned Successfully','success');
                }
                else {
                    $this->showToastr('Something went wrong. Please contact System Administrator','error');  
                }

            }
            else {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');  
            }
      
        }
        else {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');  
        }


        $Route = new Route();
        $Route->actiondate = Carbon::now()->format('Y-m-d');
        $Route->sequenceid =  $this->sequenceid;
        $User = Employee::where('email', auth('web')->user()->email)->get()->first();
    
        $Route->officeid = $User->officeid;
        $Route->divisionid = $User->divisionid;
        $Route->unitid = $User->unitid;
        $Route->action = 'CHARGING DELETED';
        $Route->is_active = true;
        $Route->is_accepted = true;
        $Route->is_rejected = false;
        $Route->is_forwarded = false;
        $Route->remarks = 'Deleted SAA Charging Amount : ' .  number_format($Amount,2,'.',',');
        $Route->userid = auth('web')->user()->id;
        $Route->from_office = $User->officeid;
        $Route->from_division = $User->divisionid;
        $Route->from_unit = $User->unitid;
        $Success = $Route->save();

        if ($Success)
        {

         $this->dispatchBrowserEvent('updateVoucher');
         $this->updateRouteList();
         $this->updateSAAList();
         $newVoucher = voucher::where('sequenceid', $this->sequenceid)->get()->first();
         $this->rem_bal_saa_voucher = number_format($newVoucher->rem_bal_saa,2,'.',',');
         if($this->selectedSAA)
         {
            $NewCharging = SaaAllocation::where('id', $this->selectedSAA)->get()->first();
            $this->saa_rem_bal =   number_format($NewCharging->rem_bal,2,'.',',');
           
            $this->showToastr('Charging Deleted Successfully','success');
           }
         }
        

    }

}




public function deleteUACSCharging($id) {
    $this->authorize('destroyCharging',$this->selected_voucher );
    $GaaCharging = GaaChargingUACS::findOrFail($id);
    $this->delete_selected_uacs = $GaaCharging->id;
    $this->resetErrorBag();
    $this->dispatchBrowserEvent('showDeleteUACSChargingModal');
}

public function destroyChargingUACS() {
    $this->authorize('destroyCharging',$this->selected_voucher );
    if ($this->delete_selected_uacs) {

        $GaaCharging = GaaChargingUACS::findOrFail($this->delete_selected_uacs);
        $Amount = $GaaCharging->amount;
        $Voucherid = $GaaCharging->voucher_id;
        $Chargingid = $GaaCharging->charging_id;
        $Success = $GaaCharging->delete();

        if ($Success)
        {

            $Voucher = voucher::where('id', $Voucherid)->get()->first();
            if ($Voucher) {
                $Voucher->rem_bal_uacs = $Voucher->rem_bal_uacs + $Amount;
                $Success1 = $Voucher->save();
                
                if($Success1) {
                    $this->dispatchBrowserEvent('hideDeleteUACSChargingModal');
                    $this->updateUACSList();
                    $this->delete_selected_uacs = null;
                    $this->showToastr('Voucher Remaining Balance returned Successfully','success');
                }   
                else {
                    $this->showToastr('Something went wrong. Please contact System Administrator','error');  
                }
            }
            else {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');  
            }

            $Allocation = AllocationUACS::where('id', $Chargingid)->get()->first();
            if ($Allocation) {
                $Allocation->rem_bal = $Allocation->rem_bal + $Amount;
                $Success1 = $Allocation->save();
                if ($Success1) 
                {
                    $this->dispatchBrowserEvent('hideDeleteUACSChargingModal');
                    $this->updateUACSList();
                    $this->delete_selected_uacs = null;
                    $this->showToastr('Allocation Remaining Balance returned Successfully','success');
                }
                else {
                    $this->showToastr('Something went wrong. Please contact System Administrator','error');  
                }

            }
            else {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');  
            }
      
        }
        else {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');  
        }


        $Route = new Route();
        $Route->actiondate = Carbon::now()->format('Y-m-d');
        $Route->sequenceid =  $this->sequenceid;
        $User = Employee::where('email', auth('web')->user()->email)->get()->first();
    
        $Route->officeid = $User->officeid;
        $Route->divisionid = $User->divisionid;
        $Route->unitid = $User->unitid;
        $Route->action = 'CHARGING DELETED';
        $Route->is_active = true;
        $Route->is_accepted = true;
        $Route->is_rejected = false;
        $Route->is_forwarded = false;
        $Route->remarks = 'Deleted UACS Charging Amount : ' .  number_format($Amount,2,'.',',');
        $Route->userid = auth('web')->user()->id;
        $Route->from_office = $User->officeid;
        $Route->from_division = $User->divisionid;
        $Route->from_unit = $User->unitid;
        $Success = $Route->save();

        if ($Success)
        {

         $this->dispatchBrowserEvent('updateVoucher');
         $this->updateRouteList();
         $this->updateUACSList();
         $newVoucher = voucher::where('sequenceid', $this->sequenceid)->get()->first();
         $this->rem_bal_uacs_voucher = number_format($newVoucher->rem_bal_uacs,2,'.',',');
         if($this->selectedUACS)
         {
            $NewCharging = AllocationUACS::where('id', $this->selectedUACS)->get()->first();
            $this->uacs_rem_bal =   number_format($NewCharging->rem_bal,2,'.',',');
           
            $this->showToastr('Charging Deleted Successfully','success');
           }
         }
        

    }

}


public function deleteActivityCharging($id) {
    $this->authorize('destroyCharging',$this->selected_voucher );
    $GaaCharging = GaaCharging::findOrFail($id);
    $this->delete_selected_activity = $GaaCharging->id;
    $this->resetErrorBag();
    $this->dispatchBrowserEvent('showDeleteActivityChargingModal');
}

public function destroyChargingActivity() {
    $this->authorize('destroyCharging',$this->selected_voucher );
    if ($this->delete_selected_activity) {

        $GaaCharging = GaaCharging::findOrFail($this->delete_selected_activity);
        $Amount = $GaaCharging->amount;
        $Voucherid = $GaaCharging->voucher_id;
        $Charginid = $GaaCharging->charging_id;
        $Success = $GaaCharging->delete();

        if ($Success)
        {

            $Voucher = voucher::where('id', $Voucherid)->get()->first();
            if ($Voucher) {
                $Voucher->rem_bal_charging = $Voucher->rem_bal_charging + $Amount;
                $Success1 = $Voucher->save();
                
                if($Success1) {
                    $this->dispatchBrowserEvent('hideDeleteActivityChargingModal');
                    $this->updateActivityList();
                    $this->delete_selected_activity = null;
                    $this->showToastr('Voucher Remaining Balance returned Successfully','success');
                }   
                else {
                    $this->showToastr('Something went wrong. Please contact System Administrator','error');  
                }
            }
            else {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');  
            }

            $Allocation = AllocationActivity::where('id', $Charginid)->get()->first();
            if ($Allocation) {
                $Allocation->rem_bal = $Allocation->rem_bal + $Amount;
                $Success1 = $Allocation->save();
                if ($Success1) 
                {
                    $this->dispatchBrowserEvent('hideDeleteActivityChargingModal');
                    $this->updateActivityList();
                    $this->delete_selected_activity = null;
                    $this->showToastr('Allocation Remaining Balance returned Successfully','success');
                }
                else {
                    $this->showToastr('Something went wrong. Please contact System Administrator','error');  
                }

            }
            else {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');  
            }
      
        }
        else {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');  
        }


        $Route = new Route();
        $Route->actiondate = Carbon::now()->format('Y-m-d');
        $Route->sequenceid =  $this->sequenceid;
        $User = Employee::where('email', auth('web')->user()->email)->get()->first();
    
        $Route->officeid = $User->officeid;
        $Route->divisionid = $User->divisionid;
        $Route->unitid = $User->unitid;
        $Route->action = 'CHARGING DELETED';
        $Route->is_active = true;
        $Route->is_accepted = true;
        $Route->is_rejected = false;
        $Route->is_forwarded = false;
        $Route->remarks = 'Deleted Activity Charging Amount : ' .  number_format($Amount,2,'.',',');
        $Route->userid = auth('web')->user()->id;
        $Route->from_office = $User->officeid;
        $Route->from_division = $User->divisionid;
        $Route->from_unit = $User->unitid;
        $Success = $Route->save();

        if ($Success)
        {

         $this->dispatchBrowserEvent('updateVoucher');
         $this->updateRouteList();
         $this->updateActivityList();
         $newVoucher = voucher::where('sequenceid', $this->sequenceid)->get()->first();
         $this->rem_bal_activity_voucher = number_format($newVoucher->rem_bal_charging,2,'.',',');
         if($this->selectedActivity)
         {

            $NewCharging = AllocationActivity::where('id', $this->selectedActivity)->get()->first();
            $this->activity_rem_bal =   number_format($NewCharging->rem_bal,2,'.',',');
            
            $this->showToastr('Charging Deleted Successfully','success');
            }
        }

    }

}


public function deleteORSDetails($id) {
        $this->authorize('deleteORS',$this->selected_voucher );
        $seleceted_ors = ORS::findOrFail($id);
        $this->delete_selected_ors = $seleceted_ors->id;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showDeleteORSModal');

}

public function destroyORSDetails() {
    $this->authorize('deleteORS',$this->selected_voucher );
    if ($this->delete_selected_ors) {

        $ORSDetails = ORS::findOrFail($this->delete_selected_ors);
        $ORSNumber = $ORSDetails->ors_no;
        $Success = $ORSDetails->delete();

        if ($Success)
        {

            if($this->ChargingActivities->count() > 0)
            {   
                $Chargings = GaaCharging::where('voucher_id', $this->selected_voucher->id)->get();
                if ($Chargings)
                {
                    foreach ($Chargings as $Charging)
                    {
                        $Charging->is_obligated = false;
                        $Charging->save();
                    }
               }
            }  
            
            if($this->ChargingPAP->count() > 0)
            {   
                $Chargings = GaaChargingPAP::where('voucher_id', $this->selected_voucher->id)->get();
                if ($Chargings)
                {
                    foreach ($Chargings as $Charging)
                    {
                        $Charging->is_obligated = false;
                        $Charging->save();
                    }
               }
            }  
          
            if($this->ChargingUACS->count() > 0)
            {   
                $Chargings = GaaChargingUACS::where('voucher_id', $this->selected_voucher->id)->get();
                if ($Chargings)
                {
                    foreach ($Chargings as $Charging)
                    {
                        $Charging->is_obligated = false;
                        $Charging->save();
                    }
                }
              
            }   

                
            if($this->ChargingSAA->count() > 0)
            {   
                $Chargings = SaaCharging::where('voucher_id', $this->selected_voucher->id)->get();
                if ($Chargings)
                {
                    foreach ($Chargings as $Charging)
                    {
                        $Charging->is_obligated = false;
                        $Charging->save();
                    
                    }
                }
            } 
            
            $Route = new Route();
            $Route->actiondate = Carbon::now()->format('Y-m-d');
            $Route->sequenceid =  $this->sequenceid;
            $User = Employee::where('email', auth('web')->user()->email)->get()->first();
        
            $Route->officeid = $User->officeid;
            $Route->divisionid = $User->divisionid;
            $Route->unitid = $User->unitid;
            $Route->action = 'ORS DELETED';
            $Route->is_active = true;
            $Route->is_accepted = true;
            $Route->is_rejected = false;
            $Route->is_forwarded = false;
            $Route->remarks = 'Deleted ORS Number : ' . $ORSNumber ;
            $Route->userid = auth('web')->user()->id;
            $Route->from_office = $User->officeid;
            $Route->from_division = $User->divisionid;
            $Route->from_unit = $User->unitid;
            $Success = $Route->save();
    
            if ($Success)
            {
    
             $this->dispatchBrowserEvent('hideDeleteORSModal');
             $this->updateRouteList();
             $this->dispatchBrowserEvent('updateORSDetails');
             
            //  $this->updateSAAList();

            $this->showToastr('ORS Details Deleted Successfully','success');
            }
            else {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');  
            }
      
        }
        else {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');  
        }


     
        

    }

}


public function addORS() {


    $this->authorize('addORS',$this->selected_voucher);

    $this->validate([
        'ors_number' => 'required|unique:fm_ors,ors_no',
        'ors_fund_cluster' => 'required',
        'ors_particulars' => 'required',
        'ors_obligation' => 'required',
        'ors_payable' => 'required',
 
    ], [
        'ors_number.required' => 'ORS Number field is required.',
        'ors_fund_cluster.required' => 'Fund Cluster field is required.',
        'ors_particulars.required' => 'Particulars field is required.',
        'ors_obligation.required' => 'Obligation Amount field is required.',
        'ors_payable.required' => 'Payable Amount field is required.',
    
    ]);
    $User = Employee::where('email', auth('web')->user()->email)->get()->first();
    $addORS = new ORS();
    $addORS->fund_cluster = $this->ors_fund_cluster;
    $addORS->voucher_id = $this->selected_voucher->id;
    $addORS->particulars = $this->ors_particulars;
    $addORS->ors_no = $this->ors_number;
    $addORS->obligation = $this->ors_obligation;
    $addORS->payable = $this->ors_payable;
    $addORS->payment = $this->ors_payment;
    $addORS->dd = $this->ors_dd;
    $addORS->nyd = $this->ors_nyd;
    $addORS->userid = $User->id;

    $Success = $addORS->save();

    if ($Success) {
        $Route = new Route();
            $Route->actiondate = Carbon::now()->format('Y-m-d');
            $Route->sequenceid =  $this->sequenceid;
         
                    
            $Route->officeid = $User->officeid;
            $Route->divisionid = $User->divisionid;
            $Route->unitid = $User->unitid;
            $Route->action = 'ORS CREATED';
            $Route->is_active = true;
            $Route->is_accepted = true;
            $Route->is_rejected = false;
            $Route->is_forwarded = false;
            $Route->remarks = 'ORS Number : ' .  $this->ors_number;
            $Route->userid = auth('web')->user()->id;
            $Route->from_office = $User->officeid;
            $Route->from_division = $User->divisionid;
            $Route->from_unit = $User->unitid;
            $Success = $Route->save();

           if($this->ChargingActivities->count() > 0)
            {   
                $Chargings = GaaCharging::where('voucher_id', $this->selected_voucher->id)->get();
                if ($Chargings)
                {
                    foreach ($Chargings as $Charging)
                    {
                        $Charging->is_obligated = true;
                        $Charging->save();
                    }
               }
            }   
          
            if($this->ChargingPAP->count() > 0)
            {   
                $Chargings = GaaChargingPAP::where('voucher_id', $this->selected_voucher->id)->get();
                if ($Chargings)
                {
                    foreach ($Chargings as $Charging)
                    {
                        $Charging->is_obligated = true;
                        $Charging->save();
                    }
               }
            }

            if($this->ChargingUACS->count() > 0)
            {   
                $Chargings = GaaChargingUACS::where('voucher_id', $this->selected_voucher->id)->get();
                if ($Chargings)
                {
                    foreach ($Chargings as $Charging)
                    {
                        $Charging->is_obligated = true;
                        $Charging->save();
                    }
                }
              
            }   

                
            if($this->ChargingSAA->count() > 0)
            {   
                $Chargings = SaaCharging::where('voucher_id', $this->selected_voucher->id)->get();
                if ($Chargings)
                {
                    foreach ($Chargings as $Charging)
                    {
                        $Charging->is_obligated = true;
                        $Charging->save();
                    
                    }
                }
            }   
            $this->dispatchBrowserEvent('hideAddORSModal');
            $this->updateRouteList();
            $this->dispatchBrowserEvent('updateORSDetails');
            // $this->updateUACSList();
            $this->showToastr('ORS Created Added Successfully','success');
        }

            else {
            
               $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        
}


    // $formfield = $request->validate([
    //     'actiondate' => 'required',
    // ]);

    // $formfield['action'] = 'ORS CREATED';
    // $voucher = FinancialManagement::where('id', '=', $request->fmid)->get()->first();
    // $formfield['sequenceid'] = $voucher->sequenceid;
    // $formfield['userid'] = auth()->user()->id;
    // $formfield['remarks'] = 'ORS Number : ' . $request->orsno;
    // $formfield['is_active'] = true;
    
    // $data = Employee::where('email','=',auth()->user()->email)->get()->first(); 
    // $formfield['officeid'] = $data->officeid;
    // $formfield['sectionid'] = $data->sectionid;
    // $formfield['unitid'] =  $data->unitid;
    // $formfield['userunitid'] = $data->unitid;
    // $formfield['is_accepted'] = true;

    // FinancialManagementRoute::updateorCreate($formfield);

    // $Chargings = FMCharging::where('fmid','=', $request->fmid)->get();
    // $Update['is_obligated'] = true;
    // foreach ($Chargings as $Charging)
    // {
    //     $Charging->update($Update);
    // }

    // return back()->with('message', "ORS Saved and Obligate Successfully!");






    // if ($this->uacs_temp_bal < $this->uacs_charging)
    // {
    //     $this->showToastr('Unable to Process. UACS Charging Amount is larger than the Activity Remaining Balance.','error');
    // }

    // if ($this->rem_bal_uacs_voucher < $this->uacs_charging)
    // {
    //     $this->showToastr('Unable to Process. UACS Charging Amount is larger than the Voucher Remaining Balance.','error');
    // }

    // if ( $this->uacs_temp_bal >= $this->uacs_charging && $this->rem_bal_uacs_voucher >= $this->uacs_charging)
    // {
    //     $GaaCharging = new GaaChargingUACS();
    //     $ChargingID = AllocationUACS::where('pap_allocation',$this->selected_pap_allocation)->where('id', $this->selectedUACS)->get()->first();

    //     $GaaCharging->charging_id = $ChargingID->id;
    //     $GaaCharging->voucher_id = $this->selected_voucher->id;
    //     $GaaCharging->amount = $this->uacs_charging;

    //     $Success = $GaaCharging->save();

    //     if ($Success) {

            
    //         $Voucher = voucher::where('sequenceid', $this->sequenceid)->get()->first();
            
    //         $Voucher->rem_bal_uacs = $Voucher->rem_bal_uacs - $this->uacs_charging;
    //         $success = $Voucher->save();

    //         if ($success)
            
    //         {
    //             $Charging = AllocationUACS::where('id', $this->selectedUACS)->get()->first();

    //             $Charging->rem_bal = $Charging->rem_bal - $this->uacs_charging;

    //             $Success1 = $Charging->save();

    //             if($Success1)
    //             {

    //                 $Route = new Route();
    //                 $Route->actiondate = Carbon::now()->format('Y-m-d');
    //                 $Route->sequenceid =  $this->sequenceid;
    //                 $User = Employee::where('email', auth('web')->user()->email)->get()->first();
                
    //                 $Route->officeid = $User->officeid;
    //                 $Route->divisionid = $User->divisionid;
    //                 $Route->unitid = $User->unitid;
    //                 $Route->action = 'CHARGING CREATED';
    //                 $Route->is_active = true;
    //                 $Route->is_accepted = true;
    //                 $Route->is_rejected = false;
    //                 $Route->is_forwarded = false;
    //                 $Route->remarks = 'UACS Charging Amount : ' .  number_format($this-> uacs_charging,2,'.',',');
    //                 $Route->userid = auth('web')->user()->id;
    //                 $Route->from_office = $User->officeid;
    //                 $Route->from_division = $User->divisionid;
    //                 $Route->from_unit = $User->unitid;
    //                 $Success = $Route->save();
                    
    //                if ($Success)
    //                {

    //                 $newVoucher = voucher::where('sequenceid', $this->sequenceid)->get()->first();
    //                 $this->rem_bal_uacs_voucher = number_format($newVoucher->rem_bal_uacs,2,'.',',');
    //                 $NewCharging = AllocationUACS::where('id', $this->selectedUACS)->get()->first();
    //                 $this->uacs_rem_bal =   number_format($NewCharging->rem_bal,2,'.',',');
                   
    //                 $this-> uacs_charging = null;
    //                 $this->dispatchBrowserEvent('updateVoucher');
    //                 $this->updateRouteList();
    //                 $this->updateUACSList();
    //                 $this->showToastr('UACS Charging Added Successfully','success');
    //                }
    //                else 
    //                {
    //                    $this->showToastr('Something went wrong. Please contact System Administrator','error');
    //                }
    //             }
    //             else 
    //             {
    //                 $this->showToastr('Something went wrong. Please contact System Administrator','error');
    //             }
    //         }
    //         else 
    //         {
    //             $this->showToastr('Something went wrong. Please contact System Administrator','error');
    //         }

    //     }
    //     else 
    //     {
    //         $this->showToastr('Something went wrong. Please contact System Administrator','error');
    //     }
    // }




// public function  budgetORS(Request $request) 
// {
    

//     $this->authorize('FMBudget', \App\Models\FinancialManagement::class);

//     $Check = FMORS::where('fmid','=', $request->fmid)->count();

//     if ($Check > 0)
//     {
//         return back()->with('failed', 'Voucher already have ORS!.' );
//     }

//     $formfields = $request->validate([
//         'fmid' => 'required',
//         'orsno' => 'required',
//         'particulars' => 'required',
//         'obligation' => 'required',
//         'fc' => 'required',
//         'payable' => 'required',
//     ]);


//     $check = FMORS::where('orsno','=',$request->orsno)->get()->first();

//     if ($check)
//     {
//         return back()->with('failed', "Duplicate ORS Number!");
//     }

  
//     if(!empty($request->payment))
//         $formfields['payment'] = $request->payment;

//     if(!empty($request->nyd))
//         $formfields['nyd'] = $request->nyd;
        
//     if(!empty($request->dd))
//         $formfields['dd'] = $request->dd;

//     $formfields['userid'] = auth()->user()->id;
    
//     FMORS::updateorcreate($formfields);

//     $formfield = $request->validate([
//         'actiondate' => 'required',
//     ]);

//     $formfield['action'] = 'ORS CREATED';
//     $voucher = FinancialManagement::where('id', '=', $request->fmid)->get()->first();
//     $formfield['sequenceid'] = $voucher->sequenceid;
//     $formfield['userid'] = auth()->user()->id;
//     $formfield['remarks'] = 'ORS Number : ' . $request->orsno;
//     $formfield['is_active'] = true;
    
//     $data = Employee::where('email','=',auth()->user()->email)->get()->first(); 
//     $formfield['officeid'] = $data->officeid;
//     $formfield['sectionid'] = $data->sectionid;
//     $formfield['unitid'] =  $data->unitid;
//     $formfield['userunitid'] = $data->unitid;
//     $formfield['is_accepted'] = true;

//     FinancialManagementRoute::updateorCreate($formfield);

//     $Chargings = FMCharging::where('fmid','=', $request->fmid)->get();
//     $Update['is_obligated'] = true;
//     foreach ($Chargings as $Charging)
//     {
//         $Charging->update($Update);
//     }

//     return back()->with('message', "ORS Saved and Obligate Successfully!");

// }


public function showToastr($message, $type) {
    return $this->dispatchBrowserEvent('showToastr',[
        'type'=>$type,
        'message'=>$message
    ]);
}

public function render()
    {
        return view('livewire.user.financial-management.voucher.view');
    }

}