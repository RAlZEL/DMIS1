<?php

namespace App\Http\Livewire\User\FinancialManagement\Allocation\Pap\Create;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Admin\AdminPanel\Category\Office;
use App\Models\FinancialManagement\gaa\allocation\pap as AllocationPap;
use App\Models\FinancialManagement\gaa\pap as PAP;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    use WithPagination;
    
    public $updatePAP = false;
    public $selected_pap_id;
    public $perPage;
    public $Search;
    public $pap;





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
        $this->pap = null;
    }   

    public function addPAP() {
        $this->authorize('createAllocation', App\Models\FinancialManagement\voucher::class);
        $this->validate([
            'pap' => 'required|max:50|unique:fm_pap,pap',
        ]);
        $PAP = new PAP();
        $PAP->pap = $this->pap;
        $success = $PAP->save();

        if ($success)
        {
            
            $this->dispatchBrowserEvent('hideAddModal');
            $this->pap = null;

            $this->showToastr('New PAP added Successfully.','success');

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
     
        $PAP = PAP::findOrFail($id);
        $this->authorize('updateAllocation', App\Models\FinancialManagement\voucher::class);
        $this->selected_pap_id = $PAP->id;
        $this->updatePAP = true;
        $this->pap = $PAP->pap;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showUpdateModal');
    }


    public function updatePAP() {
        if ($this->selected_pap_id) {
            $this->validate([
                'pap' => 'required|unique:fm_pap,pap,'.$this->selected_pap_id,
            ]);

            $PAP = PAP::findOrFail($this->selected_pap_id);
            $PAP->pap = $this->pap;
         
            $Success = $PAP->save();

            if ($Success)
            {
                $this->dispatchBrowserEvent('hideUpdateModal');
                $this->pap = NULL;
                $this->selected_pap_id = NULL;
                $this->updatePAP = false;
                $this->showToastr('PAP has been successfully Updated.','success');
            }
            else{
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        }
    }



    public function deletePAP($id) {
        $this->authorize('updateAllocation', App\Models\FinancialManagement\voucher::class);
        $PAP = PAP::findOrFail($id);
        $this->selected_pap_id = $PAP->id;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showDeleteModal');
    }

    public function destroyPAP() {
        $this->authorize('updateAllocation', App\Models\FinancialManagement\voucher::class);
        if ($this->selected_pap_id) {
            $PAP = PAP::findOrFail($this->selected_pap_id);
            
            $withAllocation = AllocationPap::where('papid', $PAP->id )->count();
            
            if ($withAllocation) 
            {
                $this->dispatchBrowserEvent('hideDeleteModal');
                $this->showToastr('Unable to Delete. PAP has allocation.','error');  

            }
            else {
                $Success = $PAP->delete();

                if ($Success) {
                    $this->dispatchBrowserEvent('hideDeleteModal');
                    $this->selected_pap_id = null;
                    $this->showToastr('PAP has been successfully Deleted.','success');
                }
                else
                {
                    $this->showToastr('Something went wrong. Please contact System Administrator','error');  
                }
            
            }
           
        }

    }

    
    public function render()
    {

        $this->authorize('viewAllocations', App\Models\FinancialManagement\voucher::class);
        return view('livewire.user.financial-management.allocation.pap.create.index',[
            'PAPs' => PAP::orderby('pap','asc')->search(trim($this->Search))
                            ->paginate($this->perPage),
        ]); 
    }
}
