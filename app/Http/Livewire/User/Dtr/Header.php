<?php

namespace App\Http\Livewire\User\Dtr;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Admin\EMS\Employee;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Header extends Component
{

    use AuthorizesRequests;
    
    public $selectedEmployee, $startdate, $enddate;

    public function mount() {
        $this->enddate = Carbon::now()->format('Y-m-d');
        $this->startdate = Carbon::now()->format('Y-m-d');
    }

    public function PrintDTR() {
        $this->authorize('print',App\Models\DTR::class);
        $this->validate([
            'selectedEmployee' => 'required',
            'enddate' => 'required',            
            'startdate' => 'required',  
    
        ], [
            'selectedEmployee.required' => 'Employee Name field is required.',
            'startdate.required' => 'Start Date field is required.',
            'enddate.required' => 'End Date field is required.',
        ]);   

        
    }


    public function render()
    {
        return view('livewire.user.dtr.header',[
            'Employees' => Employee::orderby('firstname', 'asc')->get(),
        ]);
    }
}
