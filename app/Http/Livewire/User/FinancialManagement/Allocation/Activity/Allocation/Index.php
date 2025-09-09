<?php

namespace App\Http\Livewire\User\FinancialManagement\Allocation\Activity\Allocation;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\FinancialManagement\gaa\pap;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Admin\AdminPanel\ExpenseClass\ExpenseClass;
use App\Models\Admin\AdminPanel\FinancialManagement\Office;
use App\Models\FinancialManagement\gaa\activity;
use App\Models\FinancialManagement\gaa\allocation\pap as AllocationPap;
use App\Models\FinancialManagement\gaa\allocation\activity as AllocationActivity;

use Carbon\Carbon;

class Index extends Component
{

    use AuthorizesRequests;

    use WithPagination;
    
    public $updateAllocation = false;
    public $selected_allocation_id;
    public $perPage;
    public $Search;
    public $year;
    public $expense_class, $office, $papid, $rem_bal_uacs, $rem_bal_activity;
  
    public $selectedOffice = NULL;
    public $selectedPAP = NULL;
    public $selectedYear = NULL;
    public $selectedExpenseClass = NULL;
    public $selectedActivity = NULL;
    public $rem_bal = null;
    public $amount = null;
    public $expense_class_ids; 
    public $year_ids;
    public $pap_ids;
    public $activity_ids; 
    public $Office_ids;

    public $temp_bal = 0;
    public $has_allocation;

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
        $this->activity_ids = collect();

    }

    public function updateperPage() {
        $this->perPage = $this->perPage;
    }

    public function updatingSearch() {
        $this->resetPage();
    }
    
    public function resetModalForm() {

        
        $this->selectedActivity = NULL;
        $this->selectedOffice = NULL;
        $this->selectedPAP = NULL;
        $this->selectedYear = NULL;
        $this->selectedExpenseClass = NULL;
        $this->rem_bal = null;
        $this->expense_class_ids = null; 
        $this->year_ids = null; 
        $this->pap_ids = null;
        $this->amount = null;
        $this->temp_bal = null;
        $this->has_allocation = null;
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
                $this->selectedActivity = NULL;
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


        if(!is_null($this->selectedExpenseClass))
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
                $this->selectedActivity = NULL;
            }
        }   
    }


    
    public function updatedselectedPAP($papid) {
    

        if(!is_null($this->selectedPAP))
        {
       
            $this->year_ids = AllocationPap::where('office', $this->selectedOffice)->where('expense_class', $this->selectedExpenseClass)->where('papid', $this->selectedPAP)->get();
            $this->selectedYear = null;
            $this->rem_bal = null;
            $this->amount = null;
            $this->temp_bal = null;

            $this->activity_ids = activity::where('papid',$this->selectedPAP)->get();
        }   
    }


      
    public function updatedselectedYear($year) {
    

        if(!is_null($this->selectedYear))
        {
       
         $amount = AllocationPap::where('office', $this->selectedOffice)->where('expense_class', $this->selectedExpenseClass)->where('papid', $this->selectedPAP)->where('year', $this->selectedYear)->get()->pluck('rem_bal_activity')->first();
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
            'selectedActivity' => 'required',
            'rem_bal' => 'required',
            'amount' => 'required',
            
        ],[
            'selectedOffice.required' => 'Office field is required.',
            'selectedPAP.required' => 'PAP field is required.',
            'selectedYear.required' => 'Year field is required.',
            'selectedExpenseClass.required' => 'Expense Class field is required.',
            'selectedActivity.required' => 'Activity field is required.',
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
                $CheckActivity = AllocationActivity::where('pap_allocation', $CheckPAP)->where('activity_id', $this->selectedActivity)->get()->first();
                if ($CheckActivity)
                {
                    $this->has_allocation = $CheckActivity->id;
                    $this->dispatchBrowserEvent('showConfirmModal');
                }
                else {



                    $Allocation = new AllocationActivity();
                    $Allocation->pap_allocation = AllocationPap::where('office', $this->selectedOffice)->where('expense_class', $this->selectedExpenseClass)->where('papid', $this->selectedPAP)->where('year', $this->selectedYear)->get()->pluck('id')->first();
                    $Allocation->activity_id = $this->selectedActivity;
                    $Allocation->amount = $this->amount;
                    $Allocation->rem_bal = $this->amount;

                    $success = $Allocation->save();

                    if ($success)
                    {

                        $PAPAllocation = AllocationPap::where('office', $this->selectedOffice)->where('expense_class', $this->selectedExpenseClass)->where('papid', $this->selectedPAP)->where('year', $this->selectedYear)->get()->first();
                        
                        $PAPAllocation->rem_bal_activity = $this->temp_bal - $this->amount;
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
        $Allocation = AllocationActivity::findOrFail($this->has_allocation);

        $Allocation->amount = $Allocation->amount + $this->amount;
        $Allocation->rem_bal =      $Allocation->rem_bal + $this->amount;

        $Success = $Allocation->save();
        if ($Success)
        {

            $PAPAllocation = AllocationPap::where('office', $this->selectedOffice)->where('expense_class', $this->selectedExpenseClass)->where('papid', $this->selectedPAP)->where('year', $this->selectedYear)->get()->first();
                
                $PAPAllocation->rem_bal_activity = $this->temp_bal - $this->amount;
                $Success = $PAPAllocation->save();

                if ($Success) 
                {
                $this->dispatchBrowserEvent('hideAddModal');
                $this->dispatchBrowserEvent('hideConfirmModal');
                $this->resetModalForm();
                $this->showToastr('Activity Allocation updated Successfully.','success');
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


    // public function editPAP($id) {
     
    //     $PAP = PAP::findOrFail($id);
    //     $this->authorize('updateAllocation', App\Models\FinancialManagement\voucher::class);
    //     $this->selected_pap_id = $PAP->id;
    //     $this->updatePAP = true;
    //     $this->pap = $PAP->pap;
    //     $this->resetErrorBag();
    //     $this->dispatchBrowserEvent('showUpdateModal');
    // }


    // public function updatePAP() {
    //     if ($this->selected_pap_id) {
    //         $this->validate([
    //             'pap' => 'required|unique:fm_pap,pap,'.$this->selected_pap_id,
    //         ]);

    //         $PAP = PAP::findOrFail($this->selected_pap_id);
    //         $PAP->pap = $this->pap;
         
    //         $Success = $PAP->save();

    //         if ($Success)
    //         {
    //             $this->dispatchBrowserEvent('hideUpdateModal');
    //             $this->pap = NULL;
    //             $this->selected_pap_id = NULL;
    //             $this->updatePAP = false;
    //             $this->showToastr('PAP has been successfully Updated.','success');
    //         }
    //         else{
    //             $this->showToastr('Something went wrong. Please contact System Administrator','error');
    //         }
    //     }
    // }



    // public function render()
    // {

    //     $this->authorize('viewAllocations', App\Models\FinancialManagement\voucher::class);
    //     return view('livewire.user.financial-management.allocation.pap.create.index',[
    //         'PAPs' => PAP::orderby('pap','asc')->search(trim($this->Search))
    //                         ->paginate($this->perPage),
    //     ]); 
    // }



    // public function render()
    // {
      
    //     return view('livewire.user.financial-management.allocation.pap.allocation.index', [
    //         'ExpenseClasses' => ExpenseClass::orderby('expense_class','asc')->get(),
    //         'Offices' => Office::orderby('office', 'asc')->get(),
    //         'PAPs' => pap::orderby('pap', 'asc')->get(),
    //         'Allocations' => AllocationPap::orderby('created_at', 'asc')->search(trim($this->Search))
    //                                 ->paginate($this->perPage), 
    //     ]);

        
    // }


    public function render()
    {
        return view('livewire.user.financial-management.allocation.activity.allocation.index', [
            'Allocations' => AllocationActivity::orderby('created_at', 'asc')->search(trim($this->Search))
                                       ->paginate($this->perPage), 
        ]);
    }
}
