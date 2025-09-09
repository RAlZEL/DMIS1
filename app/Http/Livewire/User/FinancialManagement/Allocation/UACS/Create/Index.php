<?php

namespace App\Http\Livewire\User\FinancialManagement\Allocation\UACS\Create;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Admin\AdminPanel\Category\Office;
use App\Models\FinancialManagement\gaa\allocation\pap as AllocationPap;
use App\Models\FinancialManagement\gaa\pap as PAP;
use App\Models\FinancialManagement\gaa\uacs;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Index extends Component
{

    
    use AuthorizesRequests;

    use WithPagination;
    
    public $updateUACS = false;
    public $selected_uacs_id;
    public $perPage;
    public $Search;
    public $uacs;


    protected $listeners = [
        'resetModalForm',
        'deletePAPAction',
    ];

    public function mount() {
        $this->resetPage();
        $this->perPage = 10;
    }

    public function updateperPage() {
        $this->perPage = $this->perPage;
    }

    public function updatingSearch() {
        $this->resetPage();
    }
    
    public function resetModalForm() {
        $this->resetErrorBag();
        $this->uacs = null;
    }   

    public function addUACS() {
        $this->authorize('createAllocation', App\Models\FinancialManagement\voucher::class);
        $this->validate([
            'uacs' => 'required|max:50|unique:fm_uacs,uacs',
        ]);
        $UACS = new uacs();
        $UACS->uacs = $this->uacs;
        $success = $UACS->save();

        if ($success)
        {
            
            $this->dispatchBrowserEvent('hideAddModal');
            $this->uacs = null;

            $this->showToastr('New UACS Code added Successfully.','success');

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


    public function editUACS($id) {
     
        $UACS = uacs::findOrFail($id);
        $this->authorize('updateAllocation', App\Models\FinancialManagement\voucher::class);
        $this->selected_uacs_id = $UACS->id;
        $this->updateUACS = true;
        $this->uacs = $UACS->uacs;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showUpdateModal');
    }


    public function updateUACS() {
        if ($this->selected_uacs_id) {
            $this->validate([
                'uacs' => 'required|unique:fm_uacs,uacs,'.$this->selected_uacs_id,
            ]);

            $UACS = uacs::findOrFail($this->selected_uacs_id);
            $UACS->uacs = $this->uacs;
         
            $Success = $UACS->save();

            if ($Success)
            {
                $this->dispatchBrowserEvent('hideUpdateModal');
                $this->uacs = NULL;
                $this->selected_uacs_id = NULL;
                $this->updateUACS = false;
                $this->showToastr('UACS Code has been successfully Updated.','success');
            }
            else{
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        }
    }



    // public function deletePAP($id) {
    //     $this->authorize('updateAllocation', App\Models\FinancialManagement\voucher::class);
    //     $PAP = PAP::findOrFail($id);
    //     $this->selected_pap_id = $PAP->id;
    //     $this->resetErrorBag();
    //     $this->dispatchBrowserEvent('showDeleteModal');
    // }

    // public function destroyPAP() {
    //     $this->authorize('updateAllocation', App\Models\FinancialManagement\voucher::class);
    //     if ($this->selected_pap_id) {
    //         $PAP = PAP::findOrFail($this->selected_pap_id);
            
    //         $withAllocation = AllocationPap::where('papid', $PAP->id )->count();
            
    //         if ($withAllocation) 
    //         {
    //             $this->dispatchBrowserEvent('hideDeleteModal');
    //             $this->showToastr('Unable to Delete. PAP has allocation.','error');  

    //         }
    //         else {
    //             $Success = $PAP->delete();

    //             if ($Success) {
    //                 $this->dispatchBrowserEvent('hideDeleteModal');
    //                 $this->selected_pap_id = null;
    //                 $this->showToastr('PAP has been successfully Deleted.','success');
    //             }
    //             else
    //             {
    //                 $this->showToastr('Something went wrong. Please contact System Administrator','error');  
    //             }
            
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




    public function render()
    {
        return view('livewire.user.financial-management.allocation.u-a-c-s.create.index',[
            'UACSs' => uacs::orderby('id', 'asc')->search(trim($this->Search))->paginate($this->perPage),
        ]);
    }
}
