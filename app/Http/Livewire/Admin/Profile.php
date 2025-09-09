<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Profile extends Component
{
    use AuthorizesRequests;


    public $employee;
    public $username,$email;

    public function mount() {
        $this->employee = User::find(auth('web')->id());
        $this->username = $this->employee->username;
        $this->email = $this->employee->email;
    }

    public function UpdateDetails() {
        $this->authorize('viewany', App\Models\User::class);
        $this->validate([
            'username' => 'required|unique:users,username,'.auth('web')->id()
        ]);

        $success = User::where('id', auth('web')->id())->update([
                'username' => $this->username,
            ]);
        
        if ($success)
        {
            $this->emit('updateEmployeeProfileHeader');
            $this->emit('updateEmployeeTopHeader');
            $this->showToastr('Your Profile info have been successfully updated.','success');
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
        $this->authorize('viewany', App\Models\User::class);
        return view('livewire.admin.profile');
    }
}
