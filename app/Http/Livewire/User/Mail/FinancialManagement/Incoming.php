<?php

namespace App\Http\Livewire\User\Mail\FinancialManagement;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Admin\EMS\Employee;
use App\Models\DocumentTracking\Document;
use App\Models\FinancialManagement\Route;
use App\Models\FinancialManagement\voucher;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Incoming extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    public $selectedRows = [];
    public $selectedPageRows = false;
    public $perPage;
    public $Search;

    
    protected $listeners = [
        'updateIncoming' => '$refresh'
    ];


    public function mount() {
        $this->perPage = 10;
    }


    public function updatedselectedPageRows($value) {
        

        if ($value) 
        {
            $this->selectedRows = $this->IncomingLists->pluck('id')->map(function($id) {
                return (string) $id;
            });
        }
        else{
         $this->reset(['selectedRows','selectedPageRows']);   
        }

    }

    
    
    public function markAllAccept() {
        foreach($this->selectedRows as $Selected) {
            
            $getVoucher = voucher::where('id', $Selected)->get()->first();
            if ($this->authorize('AcceptIncoming', $getVoucher))
            {            
                $Route = new Route();
                $Route->actiondate = Carbon::now()->format('Y-m-d');
                $Route->sequenceid =  $getVoucher->sequenceid;
                $User = Employee::where('email', auth('web')->user()->email)->get()->first();
                $Route->officeid = $User->officeid;
                $Route->divisionid = $User->divisionid;
                $Route->unitid = $User->unitid;
                $Route->action = 'ACCEPTED';
                $Route->is_active = true;
                $Route->is_accepted = true;
                $Route->is_rejected = false;
                $Route->is_forwarded = false;
                $Route->remarks = NULL;
                $Route->userid = auth('web')->user()->id;
                $Route->from_office = $User->officeid;
                $Route->from_division = $User->divisionid;
                $Route->from_unit = $User->unitid;

                $Success = $Route->save();

                if ($Success)
                {
                
                $Document = voucher::where('sequenceid', $getVoucher->sequenceid)->get()->first();

                $Document->is_forwarded = false;
                $Document->is_accepted = true;
                $Document->is_rejected = false;
                $Document->is_active = true;
                $Document->is_created = false;
                $Document->officeid = $User->officeid;
                $Document->divisionid = $User->divisionid;
                $Document->unitid = $User->unitid;
                $Document->from_userid = auth('web')->user()->id;
                $Document->from_officeid = $User->officeid;
                $Document->from_divisionid = $User->divisionid;
                $Document->from_unitid = $User->unitid;

                $SuccessDocument = $Document->save();

                if ($SuccessDocument)
                {
                
                    $this->dispatchBrowserEvent('updateIncomingCount');
                    $this->showToastr('Document ' . $getVoucher->sequenceid . ' accepted Successfully.','success');
        
                }
                else
                {
                    $this->showToastr('Something went wrong. Please contact System Administrator','error');
                }
        
                }
                else
                {
                    $this->showToastr('Something went wrong. Please contact System Administrator','error');
                }
            }
            else{
                $this->showToastr('You are not authorized to accept document ' . $getVoucher->sequenceid . '.Please contact System Administrator','error');
            }
        }
        $this->reset(['selectedRows','selectedPageRows']);   
        $this->dispatchBrowserEvent('updateIncomingCount');
    }

    public function markAllPrint()
    {
       
            return redirect()->route('mail.printManifestFM',json_encode($this->selectedRows) );
     
    }


    public function markAllReject() {
        foreach($this->selectedRows as $Selected) {
            
            $Voucher = voucher::where('id', $Selected)->get()->first();
            if ($this->authorize('AcceptIncoming', $Voucher))
            {            
                $Route = new Route();
                $Route->actiondate = Carbon::now()->format('Y-m-d');
                $Route->sequenceid =  $Voucher->sequenceid;
                $User = Employee::where('email', auth('web')->user()->email)->get()->first();
                $Route->officeid = $User->officeid;
                $Route->divisionid = $User->divisionid;
                $Route->unitid = $User->unitid;
                $Route->action = 'REJECTED';
                $Route->is_active = true;
                $Route->is_accepted = false;
                $Route->is_rejected = true;
                $Route->is_forwarded = false;
                $Route->remarks = NULL;
                $Route->userid = auth('web')->user()->id;
                $Route->from_office = $User->officeid;
                $Route->from_division = $User->divisionid;
                $Route->from_unit = $User->unitid;

                $Success = $Route->save();

                if ($Success)
                {
                
                $Document = voucher::where('sequenceid', $Voucher->sequenceid)->get()->first();

                $Document->is_forwarded = false;
                $Document->is_accepted = false;
                $Document->is_rejected = true;
                $Document->is_active = true;
                $Document->is_created = false;
                $Document->officeid = $User->officeid;
                $Document->divisionid = $User->divisionid;
                $Document->unitid = $User->unitid;
                $Document->from_userid = auth('web')->user()->id;
                $Document->from_officeid = $User->officeid;
                $Document->from_divisionid = $User->divisionid;
                $Document->from_unitid = $User->unitid;

                $SuccessDocument = $Document->save();

                if ($SuccessDocument)
                {
                    $this->dispatchBrowserEvent('updateIncomingCount');
                    $this->showToastr('Document ' . $Voucher->sequenceid . ' rejected Successfully.','success');
        
                }
                else
                {
                    $this->showToastr('Something went wrong. Please contact System Administrator','error');
                }
        
                }
                else
                {
                    $this->showToastr('Something went wrong. Please contact System Administrator','error');
                }
            }
            else{
                $this->showToastr('You are not authorized to reject document ' . $Voucher->sequenceid . '.Please contact System Administrator','error');
            }
        }
        $this->reset(['selectedRows','selectedPageRows']);   
        $this->dispatchBrowserEvent('updateIncomingCount');
    }



    public function getIncomingListsProperty() {
       
       
       
        $Employee = Employee:: where('email', auth('web')->user()->email )->get()->first();
       return voucher::orderby('created_at','desc')->where('is_forwarded',true)->where('officeid', $Employee->officeid)->where('divisionid', $Employee->divisionid)->where('unitid', $Employee->unitid)->search(trim($this->Search))->paginate($this->perPage);

    }

    public function showToastr($message, $type) {
        return $this->dispatchBrowserEvent('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }

    // public function viewDocument($id) {
    //     return redirect()->route('document-tracking.view',$id);
    // }


    // public function render()
    // {
    
    //     $IncomingLists = $this->IncomingLists;
    //     return view('livewire.user.mail.incoming',[
    //         'IncomingLists' => $IncomingLists, 
           
    //     ]);
    // }


    public function render()
    {
        $IncomingLists = $this->IncomingLists;
        return view('livewire.user.mail.financial-management.incoming',[
            'IncomingLists' => $IncomingLists, 
        ]);
    }
}
