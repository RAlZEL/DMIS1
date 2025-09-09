<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class ProfileHeader extends Component
{
    use AuthorizesRequests;

    public $employee;

    protected $listeners = [
        'updateEmployeeProfileHeader' => '$refresh'
    ];
    
    public function mount() {
        $this->employee = User::find(auth('web')->id());
    }

    
    public function render()
    {
        $this->authorize('viewany', App\Models\User::class);
        return view('livewire.admin.profile-header');
    }
}
