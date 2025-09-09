<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use App\Models\Admin\EMS\Employee;

class ProfileHeader extends Component
{
    public $employee;
    public $User;

    protected $listeners = [
        'updateEmployeeProfileHeader' => '$refresh'
    ];
    
    public function mount() {
        $this->User = User::find(auth('web')->id());
        $this->employee = Employee::where('email', $this->User->email)->get()->first();

    }


    
    public function render()
    {
        return view('livewire.user.profile-header');
    }
}
