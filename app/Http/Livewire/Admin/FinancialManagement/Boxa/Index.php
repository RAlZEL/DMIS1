<?php

namespace App\Http\Livewire\Admin\FinancialManagement\Boxa;

use App\Models\FinancialManagement\boxa;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use App\Models\Admin\AdminPanel\createOffice\OfficeGroup;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{

    use AuthorizesRequests;

    use WithPagination;
    public $certified_by, $position, $is_active;
    public $selected_signatory_id;
    public $updateSignatory = false;
    public $perPage;
    public $Search;

    protected $listeners = [
        'resetModalForm',
        'deleteSignatoryAction',
    ];

    public function mount() {
        $this->resetPage();
        $this->perPage = 10;
    }

    public function updatingSearch() {
        $this->resetPage();
    }
    
    public function resetModalForm() {
        $this->resetErrorBag();
        $this->certified_by = null;
        $this->position = null;
        $this->is_active = null;
        $this->selected_signatory_id = null;
        $this->updateSignatory = false;
     
    }   


    public function addSignatory() {
        $this->authorize('viewany', App\Models\User::class);
        $this->validate([
            'certified_by' => 'required|unique:fm_box_a,certified_by',
            'position' => 'required',
        ]);

        $Signatory = new boxa();
        $Signatory->certified_by = $this->certified_by;
        $Signatory->position = $this->position;
        if($this->is_active == true)
        {
            $Signatory->is_active = true;
        }
        else{
            $Signatory->is_active = false;
        }

        $success = $Signatory->save();

        if ($success)
        {
            $this->dispatchBrowserEvent('hideSignatoryModal');
            $this->certified_by = null;
            $this->position = null;
            $this->is_active = true;
            $this->showToastr('New Signatory added Successfully.','success');

        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }

    }

    public function editSignatory($id) {
        $Signatory = boxa::findOrFail($id);
        $this->selected_signatory_id = $Signatory->id;
        $this->certified_by = $Signatory->certified_by;
        $this->position = $Signatory->position;
        if ($Signatory->is_active == true)
        {
            $this->is_active = true;
        }
        else
        {
            $this->is_active = false;
        }
        $this->updateSignatory = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showUpdateModal');
    }


    public function updateSignatory() {

        if ($this->selected_signatory_id) {
            $this->validate([
                'certified_by' => 'required|unique:fm_box_a,certified_by,'.$this->selected_signatory_id,
                'position' => 'required',
            ]);

            $Signatory = boxa::findOrFail($this->selected_signatory_id);
            $Signatory->certified_by = $this->certified_by;
            $Signatory->position = $this->position;

          if ($this->is_active == true)
            {
                $Signatory->is_active = true;
            }
            else
            {
                $Signatory->is_active = false;
            }
            $Success = $Signatory->save();

            if ($Success)
            {
                $this->dispatchBrowserEvent('hideSignatoryModal');
                $this->certified_by = null;
                $this->position = null;
                $this->updateSignatory = false;
                $this->showToastr('Office has been successfully Updated.','success');
            }
            else{
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        }
    }

    // public function deleteOffice($id) {
    //     $this->authorize('viewany', App\Models\User::class);
    //     $Office = OfficeGroup::findOrFail($id);
    //     $this->selected_office_id = $Office->id;
    //     $this->resetErrorBag();
    //     $this->dispatchBrowserEvent('showDeleteModal');
    // }

    // public function destroyOffice() {
    //     $this->authorize('viewany', App\Models\User::class);
    //     if ($this->selected_office_id) {
    //         $Office = OfficeGroup::findOrFail($this->selected_office_id);
            
    //         $Success = $Office->delete();

    //         if ($Success) {
    //             $this->dispatchBrowserEvent('hideDeleteOfficeModal');
    //             $this->selected_office_id = null;
    //             $this->showToastr('Office has been successfully Deleted.','success');
    //         }
    //         else
    //         {
    //             $this->showToastr('Something went wrong. Please contact System Administrator','error');  
    //         }
        
    //     }

    // }

    public function showToastr($message, $type) {
        return $this->dispatchBrowserEvent('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }

    // public function render()
    // {
    //     $this->authorize('viewany', App\Models\User::class);
    //     return view('livewire.admin.admin-panel.office.offices',[
    //         'OfficeGroups' => OfficeGroup::orderby('office_id','asc')->search(trim($this->Search))
    //         ->paginate($this->perPage),
    //         'Offices' => Office::orderby('office','asc')->get(),
    //         'Divisions' => Division::orderby('division', 'asc')->get(),
    //         'Units' => Unit::orderby('unit','asc')->get(),
    //     ]);

    // }

    public function render()
    {
       
        return view('livewire.admin.financial-management.boxa.index',[
            'Signatories' => boxa::orderby('certified_by', 'asc')->get(),
        ]);
    }
}
