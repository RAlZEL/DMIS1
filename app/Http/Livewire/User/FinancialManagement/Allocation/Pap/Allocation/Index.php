<?php

namespace App\Http\Livewire\User\FinancialManagement\Allocation\Pap\Allocation;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\FinancialManagement\gaa\pap;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Admin\AdminPanel\ExpenseClass\ExpenseClass;
use Illuminate\Validation\Rule;
use App\Models\Admin\AdminPanel\FinancialManagement\Office;
use App\Models\Admin\AdminPanel\FinancialManagement\gaa\allocation\pap as Allocation;
use App\Models\FinancialManagement\gaa\allocation\pap as AllocationPap;
use App\Models\FinancialManagement\gaa\allocation\uacs as AllocationUacs;
use App\Models\FinancialManagement\gaa\allocation\activity as Allocationactivity;
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
    public $expense_class, $office, $papid, $amount, $rem_bal_uacs, $rem_bal_activity;
    public $updatePAP;
  




    protected $listeners = [
        'resetModalForm',
        'deleteAllocationAction',
    ];

    public function mount() {
        $this->resetPage();
        $this->perPage = 10;
        $this->year = Carbon::now()->format('Y');
    }

    public function updateperPage() {
        $this->perPage = $this->perPage;
    }

    public function updatingSearch() {
        $this->resetPage();
    }
    
    public function resetModalForm() {
        $this->resetErrorBag();

    }   

    public function addAllocation() {
        $this->authorize('createAllocation', App\Models\FinancialManagement\voucher::class);
        $this->validate([
            'papid' => 'required',
            'expense_class' => 'required',
            'office' => 'required',
            'year' => ['required', Rule::unique('fm_allocation_pap')
            ->where('papid', $this->papid)
            ->where('expense_class', $this->expense_class)
            ->where('office', $this->office)
            ->where('year', $this->year) ],
            'amount' => 'required',
        ],[
            'papid.required' => 'PAP field is required.',
        ] 
        );
            $Allocation = new AllocationPap();
            $Allocation->papid = $this->papid;
            $Allocation->year = $this->year;
            $Allocation->expense_class = $this->expense_class;
            $Allocation->office = $this->office;
            $Allocation->amount = $this->amount;
            $Allocation->rem_bal_uacs = $this->amount;
            $Allocation->rem_bal_activity = $this->amount;
            // $PAP->pap = $this->pap;
            $success = $Allocation->save();

            if ($success)
            {
                
                $this->dispatchBrowserEvent('hideAddModal');
                $this->papid = null;
                $this->year = null;
                $this->expense_class = null;
                $this->office = null;
                $this->amount = null;
    
                $this->showToastr('New PAP Allocation added Successfully.','success');

            }
            else
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }

    }


    public function showToastr($message, $type) {
        return $this->dispatchBrowserEvent('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }


    public function editPAP($id) {
        $this->authorize('updateAllocation', App\Models\FinancialManagement\voucher::class);
        $Allocation = AllocationPap::findOrFail($id);
        $this->selected_allocation_id = $Allocation->id;
        $this->updatePAP = true;
        $this->office = $Allocation->Office->office;
        $this->expense_class = $Allocation->ExpenseClass->expense_class;
        $this->year = $Allocation->year;
        $this->papid = $Allocation->PAP->pap;
        $this->amount = $Allocation->amount;
        
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showUpdateAllocationModal');
    }


    public function updateAllocation() {
        if ($this->selected_allocation_id) {

            $this->validate([
            'papid' => 'required',
            'expense_class' => 'required',
            'office' => 'required',
            'year' => 'required',
            'amount' => 'required',
            ]);

            $Allocation = AllocationPap::where('id', $this->selected_allocation_id)->get()->first();

            if ($Allocation) 
            {
                if (( $Allocation->amount - $Allocation->rem_bal_uacs) > $this->amount) 
                {
                    $this->showToastr('Unable to Save. Allocation Amount is smaller than the UACS Allocation(s).','warning');
                }

                if (($Allocation->amount - $Allocation->rem_bal_activity) > $this->amount) 
                {
                  
                    $this->showToastr('Unable to Save. Allocation Amount is smaller than the Activity Allocation(s).','warning');
                }

                if (($Allocation->amount - $Allocation->rem_bal_activity) <= $this->amount && ( $Allocation->amount - $Allocation->rem_bal_uacs) <= $this->amount ) 
                {

       
                    $Allocation->rem_bal_uacs = $this->amount - ( $Allocation->amount - $Allocation->rem_bal_uacs);
                    $Allocation->rem_bal_activity =  $this->amount - ( $Allocation->amount - $Allocation->rem_bal_activity);  
                    $Allocation->amount = $this->amount;
     
                    $Success = $Allocation->save();

                    if ($Success) 
                    {
                        $this->dispatchBrowserEvent('hideUpdateAllocationModal');
                            $this->papid = NULL;
                            $this->expense_class = NULL;
                            $this->year = NULL;
                            $this->office = NULL;
                            $this->amount = NULL;
                            $this->selected_allocation_id = NULL;
                            $this->updatePAP = false;
                            $this->showToastr('PAP Allocation has been successfully Updated.','success');
                    }
                    else {
                        $this->showToastr('Something went wrong. Please contact System Administrator','error');
                    }

                    
                }

            }
        }
    }


    public function deletePAP($id) {
        $this->authorize('updateAllocation', App\Models\FinancialManagement\voucher::class);
        $Allocation = AllocationPap::findorfail($id);
        $CheckUACS = AllocationUacs::where('pap_allocation', $Allocation->id)->count();
        $CheckActivity = Allocationactivity::where('pap_allocation', $Allocation->id)->count();

        if($CheckActivity != 0 && $CheckUACS != 0)

        {
            $this->showToastr('Unable to Delete. Allocation has Sub Allocation.','error');  
        }   
        else {

            $this->selected_allocation_id = $Allocation->id;
            $this->resetErrorBag();
            $this->dispatchBrowserEvent('showDeleteAllocationModal');
        }

       
    }



    public function destroyAllocation() {
        $this->authorize('updateAllocation', App\Models\FinancialManagement\voucher::class);
        if ($this->selected_allocation_id) {
            $Allocation = AllocationPap::findOrFail($this->selected_allocation_id);
        
            $Success = $Allocation->delete();

                if ($Success) {
                    $this->dispatchBrowserEvent('hideDeleteAllocationModal');
                    $this->selected_allocation_id = null;
                    $this->showToastr('PAP Allocation has been successfully Deleted.','success');
                }
                else
                {
                    $this->showToastr('Something went wrong. Please contact System Administrator','error');  
                }
           
        }

    }



    public function render()
    {
      
        return view('livewire.user.financial-management.allocation.pap.allocation.index', [
            'ExpenseClasses' => ExpenseClass::orderby('expense_class','asc')->get(),
            'Offices' => Office::orderby('office', 'asc')->get(),
            'PAPs' => pap::orderby('pap', 'asc')->get(),
            'Allocations' => AllocationPap::orderby('created_at', 'asc')->search(trim($this->Search))
                                    ->paginate($this->perPage), 
        ]);

        
    }
}
