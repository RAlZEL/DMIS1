<?php

namespace App\Http\Livewire\User\FinancialManagement\Allocation\UACS\Allocation;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\FinancialManagement\gaa\pap;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Admin\AdminPanel\ExpenseClass\ExpenseClass;
use Illuminate\Validation\Rule;
use App\Models\Admin\AdminPanel\FinancialManagement\Office;
use App\Models\Admin\AdminPanel\FinancialManagement\gaa\allocation\pap as Allocation;
use App\Models\FinancialManagement\gaa\allocation\pap as AllocationPap;
use App\Models\FinancialManagement\gaa\allocation\realignment;
use App\Models\FinancialManagement\gaa\allocation\uacs as AllocationUacs;
use App\Models\FinancialManagement\gaa\uacs;
use Carbon\Carbon;

class Index extends Component
{

    use AuthorizesRequests;

    use WithPagination;
    
    public $updateAllocation = false;
    public $realignUACS = false;
    public $selected_allocation_id;
    public $perPage;
    public $Search;
    public $year;
    public $expense_class, $office, $papid, $rem_bal_uacs;

    public $selectedOffice = NULL;
    public $selectedPAP = NULL;
    public $selectedYear = NULL;
    public $selectedExpenseClass = NULL;
    public $selectedUACS = NULL;
    public $rem_bal = null;
    public $amount = null;
    public $expense_class_ids; 
    public $year_ids;
    public $pap_ids;
    public $uacs_ids; 
    public $Office_ids;
    public $temp_bal;
    public $allocation_record;

    public $from_expense_class, $from_office, $from_papid, $from_rem_bal_uacs, $from_id, $from_year, $from_uacs,$realign_amount;

    public $selected_pap_allocation_id;
    public $selected_uacs_id;

    public $has_allocation = null;

  
    //fm_realign

    public $to_old_balance,$to_new_balance, $from_old_balance, $from_new_balance, $to_uacs, $uacs_allocation;



    protected $listeners = [
        'resetModalForm',
        'deleteAllocationAction',
    ];

    public function mount() {
        $this->resetPage();
        $this->perPage = 10;
        $this->Office_ids = Office::orderby('office','asc')->get(); 
        $this->expense_class_ids = collect();
        $this->year_ids = collect();
        $this->pap_ids = collect();
        $this->uacs_ids = collect();
    }

    public function updateperPage() {
        $this->perPage = $this->perPage;
    }

    public function updatingSearch() {
        $this->resetPage();
    }
    
    public function resetModalForm() {

        
        $this->selectedUACS = NULL;
        $this->selectedOffice = NULL;
        $this->selectedPAP = NULL;
        $this->selectedYear = NULL;
        $this->selectedExpenseClass = NULL;
        $this->rem_bal = null;
        $this->expense_class_ids = null; 
        $this->year_ids = null; ;
        $this->pap_ids = null;
        $this->amount = null;
        $this->temp_bal = null;
        $this->from_expense_class = null;
        $this->from_office = null;
        $this->from_papid = null;
        $this->from_rem_bal_uacs = null;
        $this->from_id = null;
        $this->from_year = null;
        $this->from_uacs = null;
        $this->realign_amount = null;
        $this->realignUACS = false;
        $this->selected_pap_allocation_id = null;
        $this->selected_uacs_id = null;
        $this->has_allocation = null;
        $this->to_old_balance = null;
        $this->to_new_balance = null;
        $this->from_old_balance = null;
        $this->from_new_balance = null;
        $this->to_uacs = null;
        $this->uacs_allocation = null;
    
        $this->resetErrorBag(); 

    }   


    public function updatedselectedOffice($officeid) {
        
        
        if(!is_null($this->selectedOffice))
        {
     
            $ids = AllocationPap::where('office', $this->selectedOffice)->distinct()->select('expense_class')->get();
            
            if (!is_null($ids))
            {
                $Lists = [];
                foreach ($ids as $id)
                {

                    $expenseClass = ExpenseClass::where('id', $id->expense_class)->get()->first();

                    $Lists[] = array($expenseClass->id,$expenseClass->expense_class);
                }

                $this->expense_class_ids =  $Lists;
                $this->selectedUACS = NULL;
                $this->selectedExpenseClass = NULL;
                $this->selectedYear = NULL;
                $this->selectedPAP = NULL;
                $this->rem_bal = null;
                $this->amount = null;
                $this->temp_bal = null;
            }
        }   
    }

    public function updatedselectedExpenseClass($expenseclassid) {


        if(!is_null($this->selectedOffice))
        {

            $ids = AllocationPap::where('office', $this->selectedOffice)->where('expense_class', $this->selectedExpenseClass)->distinct()->select('papid')->get();
            
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
                $this->rem_bal = null;
                $this->amount = null;
                $this->temp_bal = null;
                $this->selectedUACS = NULL;
            }
        }   
    }


    
    public function updatedselectedPAP($papid) {
    

        if(!is_null($this->selectedExpenseClass))
        {
       
            $this->year_ids = AllocationPap::where('office', $this->selectedOffice)->where('expense_class', $this->selectedExpenseClass)->where('papid', $this->selectedPAP)->get();
            $this->selectedYear = null;
            $this->rem_bal = null;
            $this->amount = null;
            $this->temp_bal = null;

            $this->uacs_ids = uacs::orderby('uacs','asc')->get();
        }   
    }


      
    public function updatedselectedYear($year) {
    

        if(!is_null($this->selectedPAP))
        {
       
         $amount = AllocationPap::where('office', $this->selectedOffice)->where('expense_class', $this->selectedExpenseClass)->where('papid', $this->selectedPAP)->where('year', $this->selectedYear)->get()->pluck('rem_bal_uacs')->first();
         $this->temp_bal = $amount;
         $this->rem_bal = number_format($amount,2,'.',',');
         $this->amount = null;

        }   
    }

    

    public function addAllocation() {
        $this->authorize('createAllocation', App\Models\FinancialManagement\voucher::class);
        $this->validate([

            'selectedOffice' => 'required',
            'selectedPAP' => 'required',
            'selectedYear' => 'required',
            'selectedExpenseClass' => 'required',
            'selectedUACS' => 'required',
            'rem_bal' => 'required',
            'amount' => 'required',
            
        ],[
            'selectedOffice.required' => 'Office field is required.',
            'selectedPAP.required' => 'PAP field is required.',
            'selectedYear.required' => 'Year field is required.',
            'selectedExpenseClass.required' => 'Expense Class field is required.',
            'selectedUACS.required' => 'Activity field is required.',
            'rem_bal.required' => 'Remaining Balance field is required.',
            
        ] 
        );
        if($this->amount > $this->temp_bal)
        {
         
            $this->showToastr('Unable to Save. Allocation Amount is larger than the Remaining Balance.','warning');
           
        }
        else
        {

            $CheckPAP =  AllocationPap::where('office', $this->selectedOffice)->where('expense_class', $this->selectedExpenseClass)->where('papid', $this->selectedPAP)->where('year', $this->selectedYear)->get()->pluck('id')->first();
    

            if($CheckPAP)
            {
                $CheckUACS = AllocationUacs::where('pap_allocation', $CheckPAP)->where('uacs_id', $this->selectedUACS)->get()->first();

                if ($CheckUACS)
                {
                    $this->has_allocation = $CheckUACS->id;
                    $this->dispatchBrowserEvent('showConfirmModal');
                }
                else {
        
                  $Allocation = new AllocationUacs();
                    $Allocation->pap_allocation = AllocationPap::where('office', $this->selectedOffice)->where('expense_class', $this->selectedExpenseClass)->where('papid', $this->selectedPAP)->where('year', $this->selectedYear)->get()->pluck('id')->first();
                    $Allocation->uacs_id = $this->selectedUACS;
                    $Allocation->amount = $this->amount;
                    $Allocation->rem_bal = $this->amount;

                    $success = $Allocation->save();

                    if ($success)
                    {

                    $PAPAllocation = AllocationPap::where('office', $this->selectedOffice)->where('expense_class', $this->selectedExpenseClass)->where('papid', $this->selectedPAP)->where('year', $this->selectedYear)->get()->first();
                    
                    $PAPAllocation->rem_bal_uacs = $this->temp_bal - $this->amount;
                    $Success = $PAPAllocation->save();

                    if ($Success) 
                    {
                    $this->dispatchBrowserEvent('hideAddModal');
                    $this->resetModalForm();
                    $this->showToastr('New Activity Allocation added Successfully.','success');
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
          


        }

    }

    public function addConfirmAllocation() {
        $this->authorize('updateAllocation', App\Models\FinancialManagement\voucher::class);
        $Allocation = AllocationUacs::findOrFail($this->has_allocation);

        $Allocation->amount = $Allocation->amount + $this->amount;
        $Allocation->rem_bal =      $Allocation->rem_bal + $this->amount;

        $Success = $Allocation->save();
        if ($Success)
        {

            $PAPAllocation = AllocationPap::where('office', $this->selectedOffice)->where('expense_class', $this->selectedExpenseClass)->where('papid', $this->selectedPAP)->where('year', $this->selectedYear)->get()->first();
                
                $PAPAllocation->rem_bal_uacs = $this->temp_bal - $this->amount;
                $Success = $PAPAllocation->save();

                if ($Success) 
                {
                $this->dispatchBrowserEvent('hideAddModal');
                $this->dispatchBrowserEvent('hideConfirmModal');
                $this->resetModalForm();
                $this->showToastr('UACS Allocation updated Successfully.','success');
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

    public function showToastr($message, $type) {
        return $this->dispatchBrowserEvent('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }


    public function realignUACS($id) {
     
        $UACS = AllocationUacs::findOrFail($id);
        $this->authorize('updateAllocation', App\Models\FinancialManagement\voucher::class);
        $this->selected_allocation_id = $UACS->id;
        $this->selected_uacs_id = $UACS->uacs_id;
        $this->selected_pap_allocation_id = $UACS->pap_allocation;
        $this->realignUACS = true;
        $this->from_office = $UACS->PAPAllocation->Office->office;
        $this->from_year = $UACS->PAPAllocation->year;
        $this->from_expense_class = $UACS->PAPAllocation->ExpenseClass->expense_class;
        $this->from_papid = $UACS->PAPAllocation->pap->pap;
        $this->from_uacs = $UACS->UACS->uacs;
        $this->temp_bal = $UACS->rem_bal;
        $this->from_rem_bal_uacs = number_format($this->temp_bal,2,'.',',');
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showRealignModal');
    }



    public function updaterealignUACS() {
        if ($this->realignUACS = true) {
            $this->validate([
                'from_office' => 'required',
                'from_year' => 'required',
                'from_expense_class' => 'required',
                'from_papid' => 'required',
                'from_uacs' => 'required',
                'temp_bal' => 'required',
                'from_rem_bal_uacs' => 'required',
                'realign_amount' => 'required',
                'selectedUACS' => 'required',

            ]);

            if($this->temp_bal < $this->realign_amount)
            {
             
                $this->showToastr('Unable to Save. Allocation Amount is larger than the Remaining Balance.','warning');
               
            }
            else{
               

                $Check = AllocationUacs::where('pap_allocation', $this->selected_pap_allocation_id)->where('uacs_id', $this->selectedUACS)->get()->first();

                if ($Check) 
                {
                    $this->to_old_balance = $Check->amount;
                    $this->to_uacs = $Check->uacs_id;
                    $Check->rem_bal = $this->realign_amount + $Check->rem_bal;
                    $Check->amount = $this->realign_amount + $Check->amount;
                    $this->to_new_balance = $this->realign_amount + $Check->amount;
                    $success = $Check->save();
                    if ($success)
                    {



                        $FromUACS = AllocationUacs::where('id', $this->selected_allocation_id)->get()->first();
                        $this->from_old_balance = $FromUACS->rem_bal;
                        $this->uacs_allocation = $FromUACS->id;
                      
                        $FromUACS->rem_bal = $FromUACS->rem_bal - $this->realign_amount;
                        $FromUACS->amount  = $FromUACS->amount - $this->realign_amount;
                        $this->from_new_balance = $FromUACS->amount - $this->realign_amount;
                        $Success = $FromUACS->save();
                        if ($Success)
                        {
                            $Realign = new realignment();
                            $Realign->uacs_allocation = $this->uacs_allocation;
                            $Realign->to_uacs = $this->to_uacs;
                            $Realign->from_old_balance = $this->from_old_balance;
                            $Realign->to_old_balance = $this->to_old_balance;
                            $Realign->from_new_balance = $this->from_new_balance;
                            $Realign->to_new_balance = $this->to_new_balance;
                            $success = $Realign->save();
                            if ($success) 
                            {
                                $this->dispatchBrowserEvent('hideRealignModal');
                                $this->resetModalForm();
                                $this->showToastr('Realignment added Successfully.','success');
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

                    else
                    {
                        $this->showToastr('Something went wrong. Please contact System Administrator','error');
                    }
                }
                else
                {
                    $Allocation = new AllocationUacs();
                    $Allocation->pap_allocation = $this->selected_pap_allocation_id;
                    $Allocation->uacs_id = $this->selectedUACS;
                    $Allocation->amount = $this->realign_amount;
                    $Allocation->rem_bal = $this->realign_amount;
                    

                    $FromUACS = AllocationUacs::where('id', $this->selected_allocation_id)->get()->first();
                    $this->from_old_balance = $FromUACS->amount;
                    $FromUACS->rem_bal = $FromUACS->rem_bal - $this->realign_amount;
                    $FromUACS->amount  = $FromUACS->amount - $this->realign_amount;
                    $this->from_new_balance = $FromUACS->amount - $this->realign_amount;
                    $this->from_old_balance = 0;
                    $this->to_new_balance =  $this->realign_amount;
                    $this->to_uacs = $this->selectedUACS;
                    $this->uacs_allocation = $FromUACS->id;
                  

                    $Success = $Allocation->save();

                    if ($Success) 
                    {

                        $Realign = new realignment();
                        $Realign->uacs_allocation = $this->uacs_allocation;
                        $Realign->to_uacs = $this->to_uacs;
                        $Realign->from_old_balance = $this->from_old_balance;
                        $Realign->to_old_balance = $this->to_old_balance;
                        $Realign->from_new_balance = $this->from_new_balance;
                        $Realign->to_new_balance = $this->to_new_balance;
                        $success = $Realign->save();
                        if ($success) 
                        {
                            $this->dispatchBrowserEvent('hideRealignModal');
                            $this->resetModalForm();
                            $this->showToastr('Realignment added Successfully.','success');
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
            }

            
        }
    }



    public function render()
    {
        return view('livewire.user.financial-management.allocation.u-a-c-s.allocation.index',[
            'Allocations' => AllocationUacs::orderby('created_at', 'asc')->search(trim($this->Search))
                                            ->paginate($this->perPage), 
            'UACSids' => uacs::orderby('uacs','asc')->get(),
        ]);
    }
}
