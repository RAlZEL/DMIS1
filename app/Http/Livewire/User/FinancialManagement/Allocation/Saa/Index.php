<?php

namespace App\Http\Livewire\User\FinancialManagement\Allocation\Saa;


use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use App\Models\FinancialManagement\gaa\pap;
use App\Models\FinancialManagement\gaa\uacs;
use App\Models\FinancialManagement\gaa\activity;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Admin\AdminPanel\ExpenseClass\ExpenseClass;
use App\Models\Admin\AdminPanel\FinancialManagement\Office;
use App\Models\FinancialManagement\gaa\allocation\pap as AllocationPap;
use App\Models\FinancialManagement\gaa\allocation\activity as AllocationActivity;
use App\Models\FinancialManagement\saa\allocation\saa;

class Index extends Component
{
    use AuthorizesRequests;

    use WithPagination;
    
    public $updateAllocation = false;
    public $selected_allocation_id;
    public $perPage;
    public $Search;
    public $year;

    public $saa_no;
  
  
    public $selectedOffice = NULL;
    public $selectedPAP = NULL;
    public $selectedYear = NULL;
    public $selectedExpenseClass = NULL;
    public $selectedUACS = NULL;
    public $amount = null;
    public $purpose = null;
    public $expense_class_ids; 
    public $pap_ids;
    public $uacs_ids; 
    public $Office_ids;
    public $rem_bal;

    protected $listeners = [
        'resetModalForm',
        'deleteAllocationAction',
    ];

    public function mount() {
        $this->resetPage();
        $this->perPage = 10;
        $this->Office_ids = Office::orderby('office','asc')->get(); 
        $this->expense_class_ids = ExpenseClass::orderby('expense_class','asc')->get();
        $this->selectedYear = Carbon::now()->format('Y');
        $this->pap_ids = PAP::orderby('pap','asc')->get();
        $this->uacs_ids = uacs::orderby('uacs','asc')->get();

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
        $this->purpose = null;
        $this->expense_class_ids = null; 
        $this->pap_ids = null;
        $this->amount = null;
        $this->rem_bal = null;
        $this->updateAllocation = false;
        $this->saa_no = null;
        $this->resetErrorBag(); 

    }   

  

    public function addAllocation() {
      
        // $this->authorize('createAllocation', App\Models\FinancialManagement\voucher::class);
        $this->validate([
            'selectedOffice' => 'required',
            'selectedPAP' => 'required',
            'selectedYear' => 'required',
            'selectedExpenseClass' => 'required',
            'selectedUACS' => 'required',
            'amount' => 'required',
            'saa_no' => 'required',
           
            'purpose' => ['required', Rule::unique('fm_allocation_saa')
            ->where('papid', $this->selectedPAP)
            ->where('expense_class', $this->selectedExpenseClass)
            ->where('uacs', $this->selectedUACS)
            ->where('office', $this->selectedOffice)
            ->where('year', $this->selectedYear)
            ->where('purpose', $this->purpose) 
            ->where('saa_no', $this->saa_no)   ],

        ],[
            'selectedOffice.required' => 'Office field is required.',
            'selectedPAP.required' => 'PAP field is required.',
            'selectedYear.required' => 'Year field is required.',
            'selectedExpenseClass.required' => 'Expense Class field is required.',
            'selectedUACS.required' => 'Activity field is required.',
      
        ] 
        );


            $Allocation = new saa();
            $Allocation->papid = $this->selectedPAP;
            $Allocation->year = $this->selectedYear;
            $Allocation->expense_class = $this->selectedExpenseClass;
            $Allocation->uacs = $this->selectedUACS;
            $Allocation->office = $this->selectedOffice;
            $Allocation->amount = $this->amount;
            $Allocation->purpose = $this->purpose;
            $Allocation->saa_no = $this->saa_no;
            $Allocation->rem_bal = $this->amount;

            $success = $Allocation->save();

            if ($success)
            {
                
                $this->dispatchBrowserEvent('hideAddModal');
                $this->resetModalForm();
    
                $this->showToastr('New SAA Allocation added Successfully.','success');

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



    public function render()
    {
        return view('livewire.user.financial-management.allocation.saa.index', [
            'Allocations' => saa::orderby('created_at', 'asc')->search(trim($this->Search))
                                       ->paginate($this->perPage),
        ]);
    }
}
