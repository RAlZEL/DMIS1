<?php

namespace App\Http\Livewire\User\Mail;

use Livewire\Component;
use App\Models\Admin\EMS\Employee;
use App\Models\DocumentTracking\Route;
use App\Models\DocumentTracking\Document;
use App\Models\Task\Task;

class Index extends Component
{

    protected $listeners = [
        'updateIncomingMail' => '$refresh',
        'updateIncoming' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.user.mail.index', [
            $Employee = Employee:: where('email', auth('web')->user()->email )->get()->first(),
            'incomingCount' => Document::orderby('created_at','desc')->get()->where('is_forwarded',true)->where('officeid', $Employee->officeid)->where('divisionid', $Employee->divisionid)->where('unitid', $Employee->unitid)->count(),
            'processingCount' => Document::orderby('created_at','desc')->get()->where('is_accepted',true)->where('officeid', $Employee->officeid)->where('divisionid', $Employee->divisionid)->where('unitid', $Employee->unitid)->count(),
            'outgoingCount' => Document::orderby('created_at','desc')->get()->where('is_forwarded',true)->where('from_officeid', $Employee->officeid)->where('from_divisionid', $Employee->divisionid)->where('from_unitid', $Employee->unitid)->count(),
            'rejectedCount' => Document::orderby('created_at','desc')->get()->where('is_rejected',true)->where('officeid', $Employee->officeid)->where('divisionid', $Employee->divisionid)->where('unitid', $Employee->unitid)->count(),
            'closedCount' => Document::orderby('created_at','desc')->get()->where('is_active',false)->where('officeid', $Employee->officeid)->where('divisionid', $Employee->divisionid)->where('unitid', $Employee->unitid)->count(),
            'AssignedTaskCount' =>Task::orderby('created_at','desc')->get()->where('user_id', auth('web')->user()->id)->count(),
        ]);
    }
}
