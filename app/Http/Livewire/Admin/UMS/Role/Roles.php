<?php

namespace App\Http\Livewire\Admin\UMS\Role;

use App\Models\User;
use Livewire\Component;
use App\Models\UserRole;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use App\Models\Admin\AdminPanel\Role\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Roles extends Component
{
    
 

    use AuthorizesRequests;

    use WithPagination;
    public $userid,$roleid;
    public $updateRole = false;
    public $selected_role_id;
    public $perPage;
    public $Search;
    public $can_delete = false;
    public $can_add = true;
    public $can_view = true;
    public $can_edit = false;
    public $can_accept = false;
    public $can_process = false;
    public $can_route = false;


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
        $this->roleid = null;
        $this->userid = null;
        $this->can_delete = false;
        $this->can_add = true;
        $this->can_view = true;
        $this->can_edit = false;
        $this->can_accept = false;
        $this->can_process = false;
        $this->can_route = false;
        $this->updateRole = false;
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
            'roleid' => ['required', Rule::unique('user_roles')
            ->where('userid', $this->userid)
            ->where('roleid', $this->roleid)],
            'userid' => ['required', Rule::unique('user_roles')
            ->where('userid', $this->userid)
            ->where('roleid', $this->roleid)],
        ]);

        $UserRole = new UserRole();
        $UserRole->userid = $this->userid;
        $UserRole->roleid = $this->roleid;
        if($this->can_view == true)
        {
            $UserRole->can_view = true;
        }
        else {
            $UserRole->can_view = false;
        }
        if($this->can_add == true)
        {
            $UserRole->can_add = true;
        }
        else {
            $UserRole->can_add = false;
        }
        if($this->can_edit == true)
        {
            $UserRole->can_edit = true;
        }
        else {
            $UserRole->can_edit = false;
        }
        if($this->can_delete == true)
        {
            $UserRole->can_delete = true;
        }
        else {
            $UserRole->can_delete = false;
        }
        if($this->can_accept == true)
        {
            $UserRole->can_accept = true;
        }
        else {
            $UserRole->can_accept = false;
        }
        if($this->can_process == true)
        {
            $UserRole->can_process = true;
        }
        else {
            $UserRole->can_process = false;
        }
        if($this->can_route == true)
        {
            $UserRole->can_route = true;
        }
        else {
            $UserRole->can_route = false;
        }

        $success = $UserRole->save();

        if ($success)
        {
            $this->dispatchBrowserEvent('hideAddModal');
            $this->resetModalForm();
            $this->showToastr('New User Role added Successfully.','success');
        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }

        
    }



    public function editRole($id) {
        $this->authorize('viewany', App\Models\User::class);
        $UserRole = UserRole::findOrFail($id);
        $this->selected_role_id = $UserRole->id;



        $this->userid = $UserRole->userid;
        $this->roleid = $UserRole->roleid;
        $this->can_view = $UserRole->can_view;
        $this->can_add = $UserRole->can_add;
        $this->can_edit = $UserRole->can_edit;
        $this->can_delete = $UserRole->can_delete;
        $this->can_accept = $UserRole->can_accept;
        $this->can_process = $UserRole->can_process;
        $this->can_route = $UserRole->can_route;
        $this->updateRole = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showUpdateModal');
    }


    public function updateRole() {
        $this->authorize('viewany', App\Models\User::class);
        if ($this->selected_role_id) {
            $this->validate([

                'roleid' => 'required',
                'userid' => 'required',
            ]);

            $UserRole = UserRole::findOrFail($this->selected_role_id);

            if($this->can_view == true)
            {
                $UserRole->can_view = true;
            }
            else {
                $UserRole->can_view = false;
            }
            if($this->can_add == true)
            {
                $UserRole->can_add = true;
            }
            else {
                $UserRole->can_add = false;
            }
            if($this->can_edit == true)
            {
                $UserRole->can_edit = true;
            }
            else {
                $UserRole->can_edit = false;
            }
            if($this->can_delete == true)
            {
                $UserRole->can_delete = true;
            }
            else {
                $UserRole->can_delete = false;
            }
            if($this->can_accept == true)
            {
                $UserRole->can_accept = true;
            }
            else {
                $UserRole->can_accept = false;
            }
            if($this->can_process == true)
            {
                $UserRole->can_process = true;
            }
            else {
                $UserRole->can_process = false;
            }
            if($this->can_route == true)
            {
                $UserRole->can_route = true;
            }
            else {
                $UserRole->can_route = false;
            }

            

            $Success = $UserRole->save();

            if ($Success)
            {
                $this->dispatchBrowserEvent('hideAddModal');
                $this->resetModalForm();
                $this->showToastr('User Role has been successfully Updated.','success');
            }
            else{
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        }
    }

    public function deleteRole($id) {
        $this->authorize('viewany', App\Models\User::class);
        $UserRole = UserRole::findOrFail($id);
        $this->selected_role_id = $UserRole->id;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showDeleteModal');
    }

    public function destroyRole() {
        $this->authorize('viewany', App\Models\User::class);
        if ($this->selected_role_id) {
            $UserRole = UserRole::findOrFail($this->selected_role_id);
            
            $Success = $UserRole->delete();

            if ($Success) {
                $this->dispatchBrowserEvent('hideDeleteModal');
                $this->selected_role_id = null;
                $this->showToastr('User Role has been successfully Deleted.','success');
            }
            else
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');  
            }
        
        }

    }


    public function render()
    {
        return view('livewire.admin.u-m-s.role.roles',[
            'UserRoles' => UserRole::orderby('id', 'asc')->where('id','!=',1)->search(trim($this->Search))->paginate($this->perPage),
            'Roles' => Role::orderby('rolename','asc')->get(),
            'Users' => User::where('id','!=',1)->orderby('email','asc')->get(),
        ]);
    }
}
