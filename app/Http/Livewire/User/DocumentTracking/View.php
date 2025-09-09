<?php

namespace App\Http\Livewire\User\DocumentTracking;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use App\Models\AutoNumber;
use App\Models\Admin\EMS\Employee;
use Illuminate\Support\Facades\File;
use App\Models\DocumentTracking\Route;
use App\Models\DocumentTracking\Document;
use App\Models\Admin\AdminPanel\Category\Office;
use App\Models\Admin\AdminPanel\Category\Division;
use App\Http\Livewire\Admin\AdminPanel\Office\Offices;
use App\Http\Livewire\User\DocumentTracking\Attachment;
use App\Models\Admin\AdminPanel\createOffice\OfficeGroup;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\DocumentTracking\Attachment as DocumentTrackingAttachment;
use App\Models\Task\Comment;
use App\Models\Task\Task;

class View extends Component
{

    use AuthorizesRequests;

    use WithFileUploads;

    public $document, $originatingoffice, $sendername,$senderaddress,$addressee, $subject, $doc_type, $datereceived,$attachments, $is_urgent ,$closeremarks, $rejectremarks, $is_paperless;
    public $TaskRemarks, $TaskStart, $TaskEnd, $AssignedTask, $UserAssignedTask;
    public $EmployeeLists;
    public $attachmentdetails, $addattachment, $c,$document_id;
    public $selected_document;
    public $PDN;
    public $Routes;
    public $remarks;
    public $selected_attachment_id, $selected_task_id;
    
    public $Document;
    public $addasTask = "ADD AS TASK";
    public $routeaction = "FORWARD TO";
    public $officeids;
    public $divisionids;
    public $unitids;
    public $selectedOffice;
    public $selectedDivision = NULL;
    public $selectedUnit= NULL;
    public $Comments, $NewComment;
    public $DivisionFinal = NULL;

    protected $listeners = [
        'resetModalFormAttachment',
        'updateAttachmentList',
        'updateRouteList',
     'updateCommentLists',
  
    ];



    public function updatedselectedOffice($officeid) {
    

        $this->divisionids  = OfficeGroup::where('office_id', $officeid)->get(); 
       
        $this->selectedDivision = NULL;
        $this->selectedUnit = NULL;


}

public function updatedselectedDivision($divisionid) {

    
    if(!is_null($this->selectedDivision))
    {     
     
            $this->unitids = OfficeGroup::where('office_id', $this->selectedOffice)->where('division_id', $this->selectedDivision)->get();
            $this->selectedUnit = NULL;

    }    
}


public function updateRouteList() {
    $Document = Document::findorfail($this->document_id);
    $this->Routes = $Document->Route;
} 


   public function updateAttachmentList() {
        $Document = Document::findorfail($this->document_id);
        $this->attachments = $Document->Attachment;
    } 

    public function resetModalFormAttachment() {
        $this->resetErrorBag();
        $this->attachmentdetails = NULL;
        $this->addattachment = NULL;
    }   

    public function addRoute() {
        $Document = Document::where('id',$this->document_id )->get()->first();
        $this->authorize('addRoute', $Document);
        $this->validate([
            'selectedOffice' => 'required',
            'selectedDivision' => 'required',
            'selectedUnit' => 'required',

        ]);

        $Route = new Route();
        $Route->actiondate = Carbon::now()->format('Y-m-d');
        $Route->documentid =  $this->PDN;
        $User = Employee::where('email', auth('web')->user()->email)->get()->first();

        $Route->officeid = $this->selectedOffice;
        $Route->divisionid = $this->selectedDivision;
        $Route->unitid = $this->selectedUnit;
        $Route->action = 'FORWARD TO';
        $Route->is_active = true;
        $Route->is_accepted = false;
        $Route->is_rejected = false;
        $Route->is_forwarded = true;
        $Route->remarks = $this->remarks;
        $Route->userid = auth('web')->user()->id;
        $Route->from_office = $User->officeid;
        $Route->from_division = $User->divisionid;
        $Route->from_unit = $User->unitid;

        $Success = $Route->save();

        if ($Success)
        {
            
            $Document = Document::where('PDN', $this->PDN)->get()->first();

            $Document->is_forwarded = true;
            $Document->is_accepted = false;
            $Document->is_rejected = false;
            $Document->is_active = true;
            $Document->is_created = false;
            $Document->officeid = $this->selectedOffice;
            $Document->divisionid = $this->selectedDivision;
            $Document->unitid = $this->selectedUnit;
            $Document->from_userid = auth('web')->user()->id;
            $Document->from_officeid = $User->officeid;
            $Document->from_divisionid = $User->divisionid;
            $Document->from_unitid = $User->unitid;

            $SuccessDocument = $Document->save();

            if ($SuccessDocument)
            {

                $this->dispatchBrowserEvent('hideAddRouteModal');
                $this->dispatchBrowserEvent('updateRoute');
                $this->dispatchBrowserEvent('updateIncomingCount');
                $this->remarks = null;
                $this->selectedDivision= null;
                $this->selectedOffice= null;
                $this->selectedUnit= null;
                $this->showToastr('Route added Successfully.','success');
    
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

    public function addAttachment() {
        $Document = Document::where('id',$this->document_id )->get()->first();
        $this->authorize('addAttachment', $Document);
        $this->validate([
            'attachmentdetails' => 'required',
            'addattachment' => 'required',
        ],[
            'attachmentdetails.required' => 'Attachment Details field is required',
            'addattachment.required' => 'Attachment field is required',

        ]);

        if($this->addattachment)
        {

            $user = User::find(auth('web')->user()->id);

           
            $Success = $this->addattachment->store('attachment', 'real_public');

            // $Success = $this->addattachment->storeAs('attachment',$this->addattachment->store('attachment', 'public'), 'real_public');


 
            if ($Success) 
            {
                $NewAttachment = new DocumentTrackingAttachment();
                $NewAttachment->documentid = $this->PDN;
                $NewAttachment->attachmentdetails = $this->attachmentdetails;
                $NewAttachment->attachment = $Success;
                $NewAttachment->userid = $user->id;
                $Success = $NewAttachment->save();
                
                if ($Success)
                {

                    $Route = new Route();
                    $Route->actiondate = Carbon::now()->format('Y-m-d');
                    $Route->documentid = $this->PDN ;
                    $User = Employee::where('email', auth('web')->user()->email)->get()->first();
        
                    $Route->officeid = $User->officeid;
                    $Route->divisionid = $User->divisionid;
                    $Route->unitid = $User->unitid;
                    $Route->action = 'ATTACHED A FILE';
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

                        $this->dispatchBrowserEvent('hideAddAttachmentModal');
                        $this->dispatchBrowserEvent('updateAttachment');
                        $this->dispatchBrowserEvent('updateRoute');
                        // $this->emit('updateAttachment',$this->PDN);
                        $this->resetModalFormAttachment();
                        $this->showToastr('New Attachment added Successfully.','success');
                    }
                    else{
                        $this->showToastr('Something went wrong. Please contact System Administrator','error');
                    }

                }
                else
                {
                    $this->showToastr('Something went wrong. Please contact System Administrator','error');
                }

            }
            else{
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        }
        else
        {


            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }
    }

    public function mount($id) {
        $this->selected_task_id = null;
        $this->NewComment = null;
        $this->Comments = [];
        $Document = Document::findorfail($id);
        $this->document_id = $Document->id;
        $this->PDN =   $Document->PDN;   
        $this->originatingoffice = $Document->originatingoffice;   
        $this->sendername = $Document->sendername;   
        $this->senderaddress = $Document->senderaddress;   
        $this->addressee = $Document->addressee;   
        $this->subject = $Document->subject;   
        $this->doc_type = $Document->doc_type;   
        $this->datereceived = $Document->datereceived;   
        $this->attachments = $Document->Attachment;
        $this->Routes = $Document->Route;
        $this->selected_document = $Document;
        $this->is_urgent = $Document->is_urgent;
        $this->is_paperless = $Document->is_paperless;
        $this->rejectremarks = null;
        $this->closeremarks = null;
        $this->TaskRemarks = null;
        $this->TaskEnd = Carbon::now()->format('Y-m-d');
        $this->TaskStart = Carbon::now()->format('Y-m-d');
        $this->AssignedTask = null;
        $this->UserAssignedTask = null;
        // $this->selectedOffice = null;
        // $this->selectedDivision = null;
        $CheckUsers = User::where('is_enable', true)->where('is_verified', true)->where('id', '!=' , '1')->get();
    
        foreach ($CheckUsers as $User) {
            $Employee = Employee::where('email', $User->email)->get()->first();

  
            $this->EmployeeLists[] = array($Employee->id, $Employee->lastname . ', ' . $Employee->firstname);

        }

        $this->EmployeeLists = collect( $this->EmployeeLists)->sortBy([1])->reverse()->toArray();
        $this->officeids = Office::orderby('office','asc')->get();
        $this->DivisionFinal = Division::orderby('division','asc')->get();
        $this->divisionids = collect();
        $this->unitids = collect();
    }


    public function updateDocument() {

        if ($this->selected_document) {
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




            $Document = Document::findOrFail($this->selected_document->id);
            $Document->originatingoffice = $this->originatingoffice;
            $Document->datereceived = $this->datereceived;
            $Document->sendername = $this->sendername;
            $Document->senderaddress = $this->senderaddress;
            $Document->doc_type = $this->doc_type;
            $Document->addressee = $this->addressee;
            $Document->subject = $this->subject;
            // $Document->PDN = $this->PDN;
            // $Document->userid = auth('web')->user()->id;
            if($this->is_urgent == true)
            {
                $Document->is_urgent = true;
            }
            else {
                $Document->is_urgent = false;
            }    
         
            $success = $Document->save();
    
            if ($success)
            {
                $this->dispatchBrowserEvent('hideUpdateDocumentModal');
                $this->resetErrorBag();
                $this->showToastr('Document updated Successfully.','success');
        
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

    public function showToastr($message, $type) {
        return $this->dispatchBrowserEvent('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }

    
    public function deleteAttachment($id) {
        // $this->authorize('viewany', App\Models\User::class);
        $Attachment = DocumentTrackingAttachment::findorfail($id);
        $this->selected_attachment_id = $Attachment->id;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showDeleteModal');
    }

    public function destroyDocument() {
        $DeleteDocument = Document::findorfail($this->document_id);

        if ($DeleteDocument)
        {
            $Success = $DeleteDocument->delete();

            if ($Success) {

                $this->dispatchBrowserEvent('hideDeleteDocumentModal');
                $this->document_id = null;
                $this->originatingoffice = null;
                $this->sendername = null;
                $this->senderaddress = null;
                $this->addressee = null;
                $this->subject = null;
                $this->doc_type = null;
                $this->datereceived = null;
                $this->attachments = null;
                $this->is_urgent = null;
                $this->showToastr('Document has been successfully Deleted.','success');
                return redirect()->route('document-tracking.userhome');
            
      
              
            }
            else
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');  
            }
        
        }

    }

    

    public function destroyAttachment() {
        $Attachment = DocumentTrackingAttachment::findorfail($this->selected_attachment_id);

        if ($Attachment)
        {
            $Success = $Attachment->delete();

            if ($Success) {

                if(File::exists(public_path($Attachment->attachment)))

                {
                    $Success = File::delete(public_path($Attachment->attachment));

                    if($Success) {
                        $this->dispatchBrowserEvent('hideDeleteAttachmentModal');
                        $this->dispatchBrowserEvent('updateAttachment');
                        $this->selected_attachment_id = null;
                        $this->showToastr('Attachment has been successfully Deleted.','success');
                    }
                    
                    else{
                        $this->showToastr('Something went wrong. Please contact System Administrator','error');  
                    }
                }
              
            }
            else
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');  
            }
        
        }

    }

    
    public function acceptDocument() {
            
            $getPDN = Document::where('id', $this->document_id)->get()->first();
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
                $Document->remarks = null;
                $SuccessDocument = $Document->save();

                if ($SuccessDocument)
                {   
                    $this->dispatchBrowserEvent('hideAcceptModal');
                    $this->dispatchBrowserEvent('updateRoute');
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

    public function rejectDocument() {
  
            $getPDN = Document::where('id',  $this->document_id)->get()->first();
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
                $Route->remarks = $this->rejectremarks;
                $Route->userid = auth('web')->user()->id;
                $Route->from_office = $User->officeid;
                $Route->from_division = $User->divisionid;
                $Route->from_unit = $User->unitid;

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
                    $this->dispatchBrowserEvent('hideRejectModal');
                    $this->dispatchBrowserEvent('updateRoute');
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


    public function addTask() {
        $Document = Document::where('id',  $this->document_id)->get()->first();
        if ($this->authorize('addTask', $Document)) 
        {
            $this->validate([
                'addasTask' => 'required',
                'TaskStart' => 'required',
                'TaskEnd' => 'required',
                'UserAssignedTask' => 'required',
                'TaskRemarks' => 'required',
            ],
            [
                'TaskRemarks.required' => "Remarks field is required",
                'UserAssignedTask.required' => 'Employee field is required',
                'TaskStart.required' => 'Start Date field is required',
                'TaskEnd.required' => 'Due Date field is required',
                'addasTask.required' => 'Route Action field is required',
                          
            ]);

                $EndNo = AutoNumber::where('code','=', 'T')->get()->first();
               
            
               
                $Document = Document::findOrFail($this->selected_document->id);
                $Task = new Task();
                 $TaskID = 'T'.'-'.date('Y') .'-'. str_pad($EndNo->end_no, 8, '0', STR_PAD_LEFT);
                 $Task->task_id =  $TaskID;
                $NewEndNo = AutoNumber::where('code','=', 'T')->get()->first();
                $NewEndNo->end_no = $NewEndNo->end_no + 1;
                $Task->start_date = $this->TaskStart;
                $Task->due_date = $this->TaskEnd;
                $Task->employee_id = $this->UserAssignedTask;
                $Task->document_id = $Document->id;
                $Task->task = $Document->PDN . ' - ' . $Document->subject;
                $Task->remarks = $this->TaskRemarks;
                $Task->user_id = auth('web')->user()->id;
                $Success = $Task->save();

                if ($Success) {
                    $Route = new Route();
                    $Route->actiondate = Carbon::now()->format('Y-m-d');
                    $Route->documentid =  $Document->PDN;
                    $User = Employee::where('email', auth('web')->user()->email)->get()->first();
                    $Route->officeid = $User->officeid;
                    $Route->divisionid = $User->divisionid;
                    $Route->unitid = $User->unitid;
                    $Route->action = 'ADD AS TASK';
                    $Route->is_active = false;
                    $Route->is_accepted = true;
                    $Route->is_rejected = false;
                    $Route->is_forwarded = false;
                    $assigned1 = Employee::findOrFail($this->UserAssignedTask);
                    $Route->task_id =  $TaskID;
                    $Route->remarks = $this->TaskRemarks;
                    $Route->userid = auth('web')->user()->id;
                    $Route->from_office = $User->officeid;
                    $Route->from_division = $User->divisionid;
                    $Route->from_unit = $User->unitid;
                    $Success = $Route->save();
                    if ($Success) {
                        $NewEndNo->save();
                        $this->dispatchBrowserEvent('hideTaskModal');
                        $this->dispatchBrowserEvent('updateRoute');
                        $this->showToastr('Task Added Successfully.','success');
                    }
                }
                else {
                    $this->showToastr('Something went wrong. Please contact System Administrator','error');      $this->showToastr('Something went wrong. Please contact System Administrator','error');
                }



        }
    }
    
    public function closeDocument() {
  
        $getPDN = Document::where('id',  $this->document_id)->get()->first();
        if ($this->authorize('markasclosed', $getPDN))
        {            
            $Route = new Route();
            $Route->actiondate = Carbon::now()->format('Y-m-d');
            $Route->documentid =  $getPDN->PDN;
            $User = Employee::where('email', auth('web')->user()->email)->get()->first();
            $Route->officeid = $User->officeid;
            $Route->divisionid = $User->divisionid;
            $Route->unitid = $User->unitid;
            $Route->action = 'CLOSED';
            $Route->is_active = false;
            $Route->is_accepted = false;
            $Route->is_rejected = false;
            $Route->is_forwarded = false;
            $Route->remarks = NULL;
            $Route->userid = auth('web')->user()->id;
            $Route->from_office = $User->officeid;
            $Route->from_division = $User->divisionid;
            $Route->from_unit = $User->unitid;
            $Route->remarks = $this->closeremarks;

            $Success = $Route->save();

            if ($Success)
            {
            
            $Document = Document::where('PDN', $getPDN->PDN)->get()->first();

            $Document->is_forwarded = false;
            $Document->is_accepted = false;
            $Document->is_rejected = false;
            $Document->is_active = false;
            $Document->is_created = false;
            $Document->officeid = $User->officeid;
            $Document->divisionid = $User->divisionid;
            $Document->unitid = $User->unitid;
            $Document->from_userid = auth('web')->user()->id;
            $Document->from_officeid = $User->officeid;
            $Document->from_divisionid = $User->divisionid;
            $Document->from_unitid = $User->unitid;
            $Document->remarks = $this->closeremarks;
            $SuccessDocument = $Document->save();

            if ($SuccessDocument)
            {
                $this->dispatchBrowserEvent('hideCloseModal');
                $this->dispatchBrowserEvent('updateRoute');
                $this->showToastr('Document ' . $getPDN->PDN . ' closed Successfully.','success');
    
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

 
public function updateCommentLists() {
        $this->Comments = Comment::where('task_id', $this->selected_task_id->id)->get();
} 


    public function showComment($id) {
        $this->Comments = null;
        $TaskId = Route::where('id',$id)->get()->first();
        $Task = Task::where('task_id',$TaskId->task_id)->get()->first();
        $this->Comments = Comment::where('task_id',$Task->id)->get();
        $this->selected_task_id = $Task;
        $this->dispatchBrowserEvent('showCommentModal');
    }

    public function addComment() {

        if($this->NewComment != null || is_null($this->NewComment))  {

            $Comment = new Comment();
            $Comment->task_id = $this->selected_task_id->id;
            $Comment->comment = $this->NewComment;
            $Comment->user_id = auth('web')->user()->id;
            $Success = $Comment->save();
            if ($Success) {
                $this->NewComment = null;
                // $this->dispatchBrowserEvent('hideCommentModal');
                $this->dispatchBrowserEvent('updateComment');
            }
            else {
          
                $this->showToastr('Something went wrong. Please contact System Administrator','error');   
            }

        }
    }

    public function render()
    {

        return view('livewire.user.document-tracking.view');
        
    }
}
