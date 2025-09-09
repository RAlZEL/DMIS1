<?php

namespace App\Http\Livewire\User\Mail\FinancialManagement;

use Livewire\Component;
use App\Models\Admin\EMS\Employee;
use App\Models\FinancialManagement\voucher;

class Index extends Component
{

    protected $listeners = [
        'updateIncomingMail' => '$refresh',
        'updateIncoming' => '$refresh',
    ];


    public function render()
    {
        return view('livewire.user.mail.financial-management.index',[
            $Employee = Employee:: where('email', auth('web')->user()->email )->get()->first(),
            'incomingCount' => voucher::orderby('created_at','desc')->get()->where('is_forwarded',true)->where('officeid', $Employee->officeid)->where('divisionid', $Employee->divisionid)->where('unitid', $Employee->unitid)->count(),
            'processingCount' => voucher::orderby('created_at','desc')->get()->where('is_accepted',true)->where('officeid', $Employee->officeid)->where('divisionid', $Employee->divisionid)->where('unitid', $Employee->unitid)->count(),
            'outgoingCount' => voucher::orderby('created_at','desc')->get()->where('is_forwarded',true)->where('from_officeid', $Employee->officeid)->where('from_divisionid', $Employee->divisionid)->where('from_unitid', $Employee->unitid)->count(),
            'rejectedCount' => voucher::orderby('created_at','desc')->get()->where('is_rejected',true)->where('officeid', $Employee->officeid)->where('divisionid', $Employee->divisionid)->where('unitid', $Employee->unitid)->count(),
            'closedCount' => voucher::orderby('created_at','desc')->get()->where('is_active',false)->where('officeid', $Employee->officeid)->where('divisionid', $Employee->divisionid)->where('unitid', $Employee->unitid)->count(),
        ]);
    }
}
