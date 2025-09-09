<?php

namespace App\Http\Livewire\User\Mail;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Admin\EMS\Employee;
use App\Models\DocumentTracking\Route;
use App\Models\DocumentTracking\Document;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Incoming extends Component
{

    use AuthorizesRequests;
    use WithPagination;
    public $selectedRows = [];
    public $selectedPageRows = false;
    public $perPage;
    public $Search;
    public $rejectremarks;
    
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


    public function markAccept() {

            $this->resetErrorBag();
            $this->dispatchBrowserEvent('showAcceptAllModal');

    }
    
    public function markReject() {

        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showRejectAllModal');

}
    
    public function markAllAccept() {
        foreach($this->selectedRows as $Selected) {
            
            $getPDN = Document::where('id', $Selected)->get()->first();
            if ($this->authorize('AcceptIncoming', $getPDN))
            {            
                $Route = new Route();
                $Route->actiondate = Carbon::now()->format('Y-m-d');
                $Route->documentid =  $getPDN->PDN;
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
                
                $Document = Document::where('PDN', $getPDN->PDN)->get()->first();

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
                    $this->dispatchBrowserEvent('hideAcceptAllModal');
                    $this->showToastr('Document ' . $getPDN->PDN . ' accepted Successfully.','success');
        
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
                $this->showToastr('You are not authorized to accept document ' . $getPDN->PDN . '.Please contact System Administrator','error');
            }
        }
        $this->reset(['selectedRows','selectedPageRows']);   
        $this->dispatchBrowserEvent('updateIncomingCount');
    }

    public function markAllPrint()
    {
       
            return redirect()->route('mail.printIncoming',json_encode($this->selectedRows) );
     
    }


    public function markAllReject() {
        foreach($this->selectedRows as $Selected) {
            
            $getPDN = Document::where('id', $Selected)->get()->first();
            if ($this->authorize('AcceptIncoming', $getPDN))
            {            
                $Route = new Route();
                $Route->actiondate = Carbon::now()->format('Y-m-d');
                $Route->documentid =  $getPDN->PDN;
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
                $Route->remarks = $this->rejectremarks;
                $Success = $Route->save();

                if ($Success)
                {
                
                $Document = Document::where('PDN', $getPDN->PDN)->get()->first();

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
                $Document->remarks = $this->rejectremarks;
                $SuccessDocument = $Document->save();

                if ($SuccessDocument)
                {
                    $this->dispatchBrowserEvent('updateIncomingCount');
                    $this->dispatchBrowserEvent('hideRejectAllModal');
                    $this->showToastr('Document ' . $getPDN->PDN . ' rejected Successfully.','success');
        
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
                $this->showToastr('You are not authorized to reject document ' . $getPDN->PDN . '.Please contact System Administrator','error');
            }
        }
        $this->reset(['selectedRows','selectedPageRows']);   
        $this->dispatchBrowserEvent('updateIncomingCount');
    }



    public function getIncomingListsProperty() {
       
       
       
        $Employee = Employee:: where('email', auth('web')->user()->email )->get()->first();
       return Document::orderby('updated_at','desc')->where('is_forwarded',true)->where('officeid', $Employee->officeid)->where('divisionid', $Employee->divisionid)->where('unitid', $Employee->unitid)->search(trim($this->Search))->paginate($this->perPage);

    }

    public function showToastr($message, $type) {
        return $this->dispatchBrowserEvent('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }

    public function viewDocument($id) {
        return redirect()->route('document-tracking.view',$id);
    }


    public function render()
    {
    
        $IncomingLists = $this->IncomingLists;
        return view('livewire.user.mail.incoming',[
            'IncomingLists' => $IncomingLists, 
           
        ]);
    }
}
