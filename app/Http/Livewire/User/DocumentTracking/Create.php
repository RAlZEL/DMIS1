<?php

namespace App\Http\Livewire\User\DocumentTracking;

use App\Models\Admin\EMS\Employee;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\AutoNumber;
use App\Models\DocumentTracking\Document;
use App\Models\DocumentTracking\Route;
use GrahamCampbell\ResultType\Success;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends Component
{

    use AuthorizesRequests;

    public $is_urgent, $originatingoffice, $datereceived, $sendername, $senderaddress, $doc_type, $subject, $addressee, $is_paperless;

    public $PDN, $newPDN;

    protected $listeners = [
        'resetModalForm',
        'deleteAccountAction',
    ];

    public function mount() {

        $this->datereceived = Carbon::now()->format('Y-m-d');
        $this->addressee = "PENRO - Occidental Mindoro";
    }
    

    public function createDocument() {
        $this->authorize('create', App\Models\Document::class);
       
        $this->validate([
            'originatingoffice' => 'required',
            'datereceived' => 'required',
            'sendername' => 'required',
            'senderaddress' => 'required',
            'doc_type' => 'required|min:4', 
            'subject' => 'required|min:6',
            'addressee' => 'required',
        ],
        [
            'originatingoffice.required' => "Originating Office field is required",
            'datereceived.required' => 'Date Received field is required',
            'sendername.required' => 'Sender name field is required',
            'senderaddress.required' => 'Sender address field is required',
            'doc_type.required' => 'Document Type field is required',
            'doc_type.min' => 'The document type must be at least 4 characters.',
                      
        ]);

        $Document = new Document();
        $Document->originatingoffice = $this->originatingoffice;
        $Document->datereceived = $this->datereceived;
        $Document->sendername = $this->sendername;
        $Document->senderaddress = $this->senderaddress;
        $Document->doc_type = $this->doc_type;
        $Document->addressee = $this->addressee;
        $Document->subject = $this->subject;
        $Document->origin = auth()->user()->Employee->officeid;
        if($this->is_urgent == true)
        {
            $Document->is_urgent = true;
        }
        else {
            $Document->is_urgent = false;
        }
        
             if($this->is_paperless == true)
        {
            $Document->is_paperless = true;
        }
        else {
            $Document->is_paperless = false;
        }
        $Document->userid = auth('web')->user()->id;
        
        $Employee = Employee::where('email', auth('web')->user()->email)->get()->first();

        $Document->officeid = $Employee->officeid;
        $Document->divisionid = $Employee->divisionid;
        $Document->unitid = $Employee->unitid;
        $Document->from_officeid = $Employee->officeid;
        $Document->from_divisionid = $Employee->divisionid;
        $Document->from_unitid = $Employee->unitid;
        $Document->from_userid = auth('web')->user()->id;

        $EndNo = AutoNumber::where('code','=', 'DT')->get()->first();
        $Document->PDN = 'P'.'-'.date('Y') .'-'. str_pad($EndNo->end_no, 8, '0', STR_PAD_LEFT) ;
        $NewEndNo = AutoNumber::where('code','=', 'DT')->get()->first();
        $NewEndNo->end_no = $NewEndNo->end_no + 1;
        $Success = $NewEndNo->save();
        $success = $Document->save();

        if ($success && $Success)
        {
            $Route = new Route();
            $Route->actiondate = Carbon::now()->format('Y-m-d');
            $Route->documentid =  'P'.'-'.date('Y') .'-'. str_pad($EndNo->end_no, 8, '0', STR_PAD_LEFT) ;
            $User = Employee::where('email', auth('web')->user()->email)->get()->first();

            $Route->officeid = $User->officeid;
            $Route->divisionid = $User->divisionid;
            $Route->unitid = $User->unitid;
            $Route->action = 'DOCUMENT CREATED';
            $Route->is_active = true;
            $Route->is_accepted = false;
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
                $this->newPDN = Document::where('subject', $this->subject)->get()->first();
                $this->originatingoffice = null;
                // $this->datereceived= null;
                $this->sendername= null;
                $this->senderaddress= null;
                $this->doc_type= null;
                $this->subject = null;
               
                $this->dispatchBrowserEvent('viewDocument');
                $this->showToastr('New Document added Successfully.','success');
    
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

    
    public function viewDocument($id)
    {
        return redirect()->route('document-tracking.view',$id);
  
    }

    public function resetModalForm() {
        $this->resetErrorBag();
        $this->newPDN = NULL;
        $this->sendername= null;
        $this->senderaddress= null;
        $this->doc_type= null;
        $this->subject = null;
    }



    public function showToastr($message, $type) {
        return $this->dispatchBrowserEvent('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }


    public function render()
    {
        
        return view('livewire.user.document-tracking.create');
    }
}
