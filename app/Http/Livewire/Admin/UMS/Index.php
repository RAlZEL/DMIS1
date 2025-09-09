<?php

namespace App\Http\Livewire\Admin\UMS;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use App\Models\Admin\EMS\Employee;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;

class Index extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $email,$username,$password,$confirm_password;
    public $Employees;
    public $selected_user_id;
    public $is_verified;
    public $is_enable;

    public $perPage;
    public $Search;

    protected $listeners = [
        'resetModalForm',
        'deleteOfficeAction',
        'mount'
    ];


    public function updatingSearch() {
        $this->resetPage();
    }
    
    public function resetModalForm() {
        $this->resetErrorBag();
        $this->username = null;
        $this->email = null;
        $this->password = null;
        $this->confirm_password = null;
        $this->selected_user_id = null;

    }   

    // public function loadEmployee() {
    //     $this->Employees = Employee::where('has_account', false)->orderby('email','asc')->get();
    // }

    public function mount() {
        $this->resetPage();
        $this->perPage = 10;
        $this->Employees = Employee::where('has_account', false)->orderby('email','asc')->get();
    }


    public function addUser() {
        $this->authorize('viewany', App\Models\User::class);
        $this->validate([
            'username' => ['required','max:50', Rule::unique('users')->where('username', $this->username)],
            'password' => 'required|min:5|max:25',
            'confirm_password' => 'same:password'
        ],[
            'password.required' => 'Enter User password',
            'confirm_password.required' => 'Confirm User password',
            'confirm_password.same' => 'The confirm password must be the same to the password',
        ]);       
    
        $User = new User();
        $User->username = $this->username;
        $User->password =  Hash::make($this->password);
        $User->email = $this->email;
        $User->is_verified = true;
        $User->is_enable = true;
        $success = $User->save();

        if ($success)
        {
            $Employee = Employee::where('email',$this->email)->get()->first();
            $Employee->has_account = true;
            $SuccessEmployee = $Employee->save();  
            if ($SuccessEmployee) {
                $this->dispatchBrowserEvent('hideUserModal');
                $this->resetModalForm();
                $this->mount();
                $this->showToastr('New User added Successfully.','success');
            }
            else
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }

        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }


    }

    public function editUsername($id) {
        $this->authorize('viewany', App\Models\User::class);
        $User = User::findOrFail($id);
        $this->selected_user_id = $User->id;
        $this->username = $User->username;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showEditUsernameModal');
    }


    public function updateUsername() {
        $this->authorize('viewany', App\Models\User::class);
        if ($this->selected_user_id) {
            $this->validate([
                'username' => ['required','max:50', Rule::unique('users')->where('username', $this->username)],
            ]);

            $User = User::findOrFail($this->selected_user_id);
            $User->username = $this->username;
            $Success = $User->save();

            if ($Success)
            {
                $this->dispatchBrowserEvent('hideEditUserModal');
                $this->username = null;
                $this->showToastr('Username has been successfully Updated.','success');
            }
            else{
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        }
    }

    public function changePassword($id) {
        $this->authorize('viewany', App\Models\User::class);
        $User = User::findOrFail($id);
        $this->selected_user_id = $User->id;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showChangePasswordModal');
    }


    public function updatePassword() {
        $this->authorize('viewany', App\Models\User::class);
        if ($this->selected_user_id) {
            $this->validate([
                'password' => 'required|min:5|max:25',
                'confirm_password' => 'same:password'
            ],[
                'password.required' => 'Enter User password',
                'confirm_password.required' => 'Confirm User password',
                'confirm_password.same' => 'The confirm password must be the same to the password',
            ]);   

            $User = User::findOrFail($this->selected_user_id);
            $User->password =  Hash::make($this->password);
            $Success = $User->save();

            if ($Success)
            {
                $this->dispatchBrowserEvent('hideChangePasswordModal');
                $this->password = $this->confirm_password = null;
                $this->showToastr('Password has been successfully Updated.','success');
            }
            else{
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        }
    }

    public function editStatus($id) {
        $this->authorize('viewany', App\Models\User::class);
        $User = User::findOrFail($id);
        $this->selected_user_id = $User->id;
        $this->is_verified = $User->is_verified;
        $this->is_enable = $User->is_enable;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showUpdateStatusModal');
    }

    public function updateStatus() {
        $this->authorize('viewany', App\Models\User::class);
        if ($this->selected_user_id) {
            $this->validate([
                'is_verified' => 'required',
                'is_enable' => 'required'
            ]);   

            $User = User::findOrFail($this->selected_user_id);
            if($this->is_verified == true)
            {
                $User->is_verified = true;
            }
            else {
                $User->is_verified = false;
            }
            if($this->is_enable == true)
            {
                $User->is_enable = true;
            }
            else {
                $User->is_enable = false;
            }
            $Success = $User->save();

            if ($Success)
            {
                $this->dispatchBrowserEvent('hideUpdateStatusModal');
                $this->showToastr('Status has been successfully Updated.','success');
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
        return view('livewire.admin.u-m-s.index', [
            'Users' => User::orderby('id','asc')->search(trim($this->Search))->paginate($this->perPage),
            
        ]);

        // 'Employees' => Employee::orderby('employeeid','asc')->search(trim($this->Search))->paginate($this->perPage)
    }

}
