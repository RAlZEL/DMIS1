<?php

namespace App\Http\Livewire\Admin\AdminPanel\Category;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use App\Models\Admin\AdminPanel\Category\Office;
use App\Models\Admin\AdminPanel\Category\Division;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Divisions extends Component
{

    use AuthorizesRequests;
    use WithPagination;
    public $division;
    public $selected_division_id;
    public $perPage;
    public $Search;

    public $updateDivision = false;

    protected $listeners = [
        'resetModalForm',
        'deleteDivisionAction',
    ];

    public function mount() {
        $this->resetPage();
        $this->perPage = 10;
    //    = $this->search;
    }

    public function updatingSearch() {
        $this->resetPage();
    }
    
    public function resetModalForm() {
        $this->resetErrorBag();
        $this->division = null;
    }   

    public function addDivision() {
        $this->authorize('viewany', App\Models\User::class);
        $this->validate([
            'division' => 'required|unique:division,division',
        ],[
            'division.required' => 'Division field must not be empty.',
        ]);

        $Division = new Division();
        $Division->division = $this->division;
        $success = $Division->save();

        if ($success)
        {
            $this->dispatchBrowserEvent('hideDivisionModal');
            $this->division = null;
            $this->showToastr('New Division added Successfully.','success');
        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }

    }

    
    public function editDivision($id) {
        $this->authorize('viewany', App\Models\User::class);
        $Division = Division::findOrFail($id);
        $this->selected_division_id = $Division->id;
        $this->division = $Division->division;
        $this->updateDivision = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showUpdateModal');
    }


    public function updateDivision() {
        $this->authorize('viewany', App\Models\User::class);
        if ($this->selected_division_id) {
            $this->validate([
                'division' => 'required|unique:division,division',
            ]);

            $Division = Division::findOrFail($this->selected_division_id);
            $Division->division = $this->division;
            $Success = $Division->save();

            if ($Success)
            {
                $this->dispatchBrowserEvent('hideDivisionModal');
                $this->division = null;
                $this->selected_division_id = null;
                $this->updateDivision = false;
                $this->showToastr('Division has been successfully Updated.','success');
            }
            else{
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        }
    }

    public function deleteDivision($id) {
        $this->authorize('viewany', App\Models\User::class);
        $Division = Division::findOrFail($id);
        $this->selected_division_id = $Division->id;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showDeleteModal');
    }

    public function destroyDivision() {
        $this->authorize('viewany', App\Models\User::class);
        if ($this->selected_division_id) {
            $Division = Division::findOrFail($this->selected_division_id);
            
            $Success = $Division->delete();

            if ($Success) {
                $this->dispatchBrowserEvent('hideDeleteDivisionModal');
                $this->selected_division_id = null;
                $this->showToastr('Division has been successfully Deleted.','success');
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
        return view('livewire.admin.admin-panel.category.divisions',[
            'Divisions' => Division::orderBy('division','asc')->search(trim($this->Search))->paginate($this->perPage),
        ]);
    }
}
