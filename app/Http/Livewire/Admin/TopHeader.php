<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class TopHeader extends Component
{
    use AuthorizesRequests;

    public $employee;

    protected $listeners = [
        'updateEmployeeTopHeader' => '$refresh'
    ];


    public function mount() {
        $this->employee = User::find(auth('web')->id());
        
    }

    public function render()
    {
        $this->authorize('viewany', App\Models\User::class);
        return view('livewire.admin.top-header');
    }
}
