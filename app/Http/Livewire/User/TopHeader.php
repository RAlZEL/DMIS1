<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use App\Models\Admin\EMS\Employee;
use App\Models\DocumentTracking\Document;
use App\Models\FinancialManagement\voucher;

class TopHeader extends Component
{


    // public $employee;
    // public $User;
    // public $incomingCount;

    protected $listeners = [
        'updateEmployeeTopHeader' => '$refresh',
        'updateIncomingMail' => '$refresh',
        'updateIncoming' => '$refresh',
        

    ];

    // public function mount() {
    //     $this->User = User::find(auth('web')->id());
    //     $this->employee = Employee::where('email', $this->User->email)->get()->first();

    //     $this->incomingCount =  Document::orderby('created_at','desc')->get()->where('is_forwarded',true)->where('officeid',   $this->employee->officeid)->where('divisionid',   $this->employee->divisionid)->where('unitid',   $this->employee->unitid)->count();

    // }


    public function render()
    {
        return view('livewire.user.top-header', [
            $employee = Employee:: where('email', auth('web')->user()->email )->get()->first(),
            'incomingCount' => Document::orderby('created_at','desc')->get()->where('is_forwarded',true)->where('officeid', $employee->officeid)->where('divisionid', $employee->divisionid)->where('unitid', $employee->unitid)->count(),
            'incomingCountFM' => voucher::orderby('created_at','desc')->get()->where('is_forwarded',true)->where('officeid', $employee->officeid)->where('divisionid', $employee->divisionid)->where('unitid', $employee->unitid)->count(),
            'User' => User::find(auth('web')->id()),
            'employee' => Employee:: where('email', auth('web')->user()->email )->get()->first(),
        ]);

    }
}
