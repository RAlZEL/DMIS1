<?php

namespace App\Http\Livewire\Admin\AdminPanel\Category;

use App\Models\Admin\AdminPanel\Category\Unit;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Units extends Component
{
    use AuthorizesRequests;

    use WithPagination;
    public $unit;
    public $selected_unit_id;
    public $perPage;
    public $Search;

    public $updateUnit = false;

    protected $listeners = [
        'resetModalForm',
        'deleteUnitAction',
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
        $this->unit = null;
    }   

    public function addUnit() {
        $this->authorize('viewany', App\Models\User::class);
        $this->validate([
            'unit' => 'required|unique:unit,unit',
        ],[
            'unit.required' => 'Unit field must not be empty.',
        ]);

        $Unit = new Unit();
        $Unit->unit = $this->unit;
        $success = $Unit->save();

        if ($success)
        {
            $this->dispatchBrowserEvent('hideUnitModal');
            $this->unit = null;
            $this->showToastr('New Unit added Successfully.','success');
        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }

    }

    
    public function editUnit($id) {
        $this->authorize('viewany', App\Models\User::class);
        $Unit = Unit::findOrFail($id);
        $this->selected_unit_id = $Unit->id;
        $this->unit = $Unit->unit;
        $this->updateUnit = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showUpdateModal');
    }


    public function updateUnit() {
        $this->authorize('viewany', App\Models\User::class);
        if ($this->selected_unit_id) {
            $this->validate([
                'unit' => 'required|unique:unit,unit',
            ]);

            $Unit = Unit::findOrFail($this->selected_unit_id);
            $Unit->unit = $this->unit;
            $Success = $Unit->save();

            if ($Success)
            {
                $this->dispatchBrowserEvent('hideUnitModal');
                $this->unit = null;
                $this->selected_unit_id = null;
                $this->updateUnit = false;
                $this->showToastr('Unit has been successfully Updated.','success');
            }
            else{
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        }
    }

    public function deleteUnit($id) {
        $this->authorize('viewany', App\Models\User::class);
        $Unit = Unit::findOrFail($id);
        $this->selected_unit_id = $Unit->id;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showDeleteModal');
    }

    public function destroyUnit() {
        $this->authorize('viewany', App\Models\User::class);
        if ($this->selected_unit_id) {
            $Unit = Unit::findOrFail($this->selected_unit_id);
            
            $Success = $Unit->delete();

            if ($Success) {
                $this->dispatchBrowserEvent('hideDeleteUnitModal');
                $this->selected_unit_id = null;
                $this->showToastr('Unit has been successfully Deleted.','success');
            }
            else
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');  
            }
        
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
        $this->authorize('viewany', App\Models\User::class);
        return view('livewire.admin.admin-panel.category.units',[
            'Units' => Unit::orderby('Unit','asc')->search(trim($this->Search))->paginate($this->perPage),
        ]);
    }
}
