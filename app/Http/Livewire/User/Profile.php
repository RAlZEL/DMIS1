<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Profile extends Component
{

    public $employee;
    public $username,$email;

    public function mount() {
        $this->employee = User::find(auth('web')->id());
        $this->username = $this->employee->username;
        $this->email = $this->employee->email;
    }

    public function UpdateDetails() {

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
        return view('livewire.user.profile');
    }
}
