<?php

namespace App\Http\Livewire\User\FinancialManagement\Allocation\UACS\Realignment;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\FinancialManagement\gaa\allocation\realignment;

class Index extends Component
{

    use WithPagination;
    public $perPage;
    public $Search;

    public function mount() {
        $this->resetPage();
        $this->perPage = 10;
    }

    public function updateperPage() {
        $this->perPage = $this->perPage;
    }

    public function updatingSearch() {
        $this->resetPage();
    }
    
    
    public function render()
    {
        return view('livewire.user.financial-management.allocation.u-a-c-s.realignment.index',[
            'Realignments' => realignment::orderby('created_at', 'asc')->search(trim($this->Search))->paginate($this->perPage),
        ]);
    }
}
