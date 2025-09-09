<?php

namespace App\Http\Livewire\Admin\AdminPanel\Role;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Admin\AdminPanel\Role\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Roles extends Component
{
    use AuthorizesRequests;

    use WithPagination;
    public $rolename;
    public $selected_role_id;
    public $perPage;
    public $Search;
    public $updateRole = false;

    protected $listeners = [
        'resetModalForm',
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
        $this->rolename = null;
    }   

    public function showToastr($message, $type) {
        return $this->dispatchBrowserEvent('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }


    public function addRole() {
        $this->authorize('viewany', App\Models\User::class);
        $this->validate([
            'rolename' => 'required|unique:role,rolename',
        ],[
            'rolename.required' => 'Rolename field must not be empty.',
        ]);

        $Role = new Role();
        $Role->rolename = $this->rolename;
        $success = $Role->save();

        if ($success)
        {
            $this->dispatchBrowserEvent('hideAddModal');
            $this->rolename = null;
            $this->showToastr('New Role added Successfully.','success');
        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }

    }

    public function editRole($id) {
        $this->authorize('viewany', App\Models\User::class);
        $Role = Role::findOrFail($id);
        $this->selected_role_id = $Role->id;
        $this->rolename = $Role->rolename;
        $this->updateRole = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showUpdateModal');
    }


    public function updateRole() {
        $this->authorize('viewany', App\Models\User::class);
        if ($this->selected_role_id) {
            $this->validate([
                'rolename' => 'required|unique:role,rolename',
            ]);

            $Role = Role::findOrFail($this->selected_role_id);
            $Role->rolename = $this->rolename;
            $Success = $Role->save();

            if ($Success)
            {
                $this->dispatchBrowserEvent('hideAddModal');
                $this->rolename = null;
                $this->selected_role_id = null;
                $this->updateRole = false;
                $this->showToastr('Role has been successfully Updated.','success');
            }
            else{
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        }
    }

    public function render()
    {
        $this->authorize('viewany', App\Models\User::class);
        return view('livewire.admin.admin-panel.role.roles',[
            'Roles' => Role::orderby('id','asc')->search(trim($this->Search))->paginate($this->perPage),
           
        ]);
    }
}
