<?php

namespace App\Http\Livewire\Admin\AdminPanel\Category;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Admin\AdminPanel\Category\Office;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Offices extends Component
{
    use AuthorizesRequests;

    use WithPagination;
    public $office;
    public $address;
    public $selected_office_id;
    public $updateOffice = false;
    public $perPage;
    public $Search;

    protected $listeners = [
        'resetModalForm',
        'deleteOfficeAction',
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
        $this->office = null;
        $this->address = null;
    }   

    public function addOffice() {
        $this->authorize('viewany', App\Models\User::class);
        $this->validate([
            'office' => 'required|unique:office,office',
        ]);

        $office = new Office();
        $office->office = $this->office;
        $office->address = $this->address;
        $success = $office->save();

        if ($success)
        {
            $this->dispatchBrowserEvent('hideOfficeModal');
            $this->office = null;
            $this->address = null;
            $this->showToastr('New Office added Successfully.','success');

        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }

    }

    public function deleteOffice($id) {
        $this->authorize('viewany', App\Models\User::class);
        $Office = Office::findOrFail($id);
        $this->selected_office_id = $Office->id;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showDeleteModal');
    }

    public function destroyOffice() {
        $this->authorize('viewany', App\Models\User::class);
        if ($this->selected_office_id) {
            $Office = Office::findOrFail($this->selected_office_id);
            
            $Success = $Office->delete();

            if ($Success) {
                $this->dispatchBrowserEvent('hideDeleteOfficeModal');
                $this->selected_office_id = null;
                $this->showToastr('Office has been successfully Deleted.','success');
            }
            else
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');  
            }
        
        }

    }
 

    public function editOffice($id) {
        $this->authorize('viewany', App\Models\User::class);
        $Office = Office::findOrFail($id);
        $this->selected_office_id = $Office->id;
        $this->office = $Office->office;
        $this->address = $Office->address;
        $this->updateOffice = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showUpdateModal');
    }


    public function updateOffice() {
        $this->authorize('viewany', App\Models\User::class);
        if ($this->selected_office_id) {
            $this->validate([
                'office' => 'required|unique:office,office,'.$this->selected_office_id,
            ]);

            $Office = Office::findOrFail($this->selected_office_id);
            $Office->office = $this->office;
            $Office->address = $this->address;
            $Success = $Office->save();

            if ($Success)
            {
                $this->dispatchBrowserEvent('hideOfficeModal');
                $this->office = null;
                $this->address = null;
                $this->updateOffice = false;
                $this->showToastr('Office has been successfully Updated.','success');
            }
            else{
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
        return view('livewire.admin.admin-panel.category.offices',[
            'Offices' => Office::orderby('office','asc')->search(trim($this->Search))
                            ->paginate($this->perPage),
        ]); 
    }
}
