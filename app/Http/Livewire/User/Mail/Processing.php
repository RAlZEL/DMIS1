<?php

namespace App\Http\Livewire\User\Mail;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\Task\Task;
use App\Models\AutoNumber;
use Livewire\WithPagination;
use App\Models\Admin\EMS\Employee;
use App\Models\DocumentTracking\Route;
use App\Models\DocumentTracking\Document;
use App\Models\Admin\AdminPanel\Category\Office;
use App\Models\Admin\AdminPanel\Category\Division;
use App\Models\Admin\AdminPanel\createOffice\OfficeGroup;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Processing extends Component
{

    use AuthorizesRequests;
    use WithPagination;
    public $selectedRows = [];
    public $selectedPageRows = false;
    public $perPage;
    public $Search;
    public $routeaction = "FORWARD TO";
    public $officeids;
    public $divisionids;
    public $unitids;
    public $selectedOffice;
    public $selectedDivision = NULL;
    public $selectedUnit= NULL;
    public $remarks;
    public $DivisionFinal = NULL;
    public $closeremarks;
    public $TaskRemarks, $TaskStart, $TaskEnd, $AssignedTask, $UserAssignedTask,$addasTask;
    public $EmployeeLists;
    protected $listeners = [
        'updateProcessing' => '$refresh'
    ];


    public function mount() {
        $this->perPage = 10;
        $this->officeids = Office::orderby('office','asc')->get();
        $this->DivisionFinal = Division::orderby('division','asc')->get();
        $this->divisionids = collect();
        $this->unitids = collect();
        $this->remarks = null;
        $this->TaskRemarks = null;
        $this->TaskEnd = Carbon::now()->format('Y-m-d');
        $this->TaskStart = Carbon::now()->format('Y-m-d');
        $this->AssignedTask = null;
        $this->UserAssignedTask = null;
        $this->addasTask = 'ADD AS TASK';
        $CheckUsers = User::where('is_enable', true)->where('is_verified', true)->where('id', '!=' , '1')->get();
    
        foreach ($CheckUsers as $User) {
            $Employee = Employee::where('email', $User->email)->get()->first();

  
            $this->EmployeeLists[] = array($Employee->id, $Employee->lastname . ', ' . $Employee->firstname);

        }

        $this->EmployeeLists = collect( $this->EmployeeLists)->sortBy([1])->reverse()->toArray();
    }




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



public function addRoute() {

    foreach($this->selectedRows as $Selected) {

        $Document = Document::where('id',$Selected )->get()->first();
        $this->authorize('addRoute', $Document);
        $this->validate([
            'selectedOffice' => 'required',
            'selectedDivision' => 'required',
            'selectedUnit' => 'required',

        ]);

        $Route = new Route();
        $Route->actiondate = Carbon::now()->format('Y-m-d');
        $Route->documentid =  $Document->PDN;
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
            
            $Document1 = Document::where('PDN', $Document->PDN)->get()->first();

            $Document1->is_forwarded = true;
            $Document1->is_accepted = false;
            $Document1->is_rejected = false;
            $Document1->is_active = true;
            $Document1->is_created = false;
            $Document1->officeid = $this->selectedOffice;
            $Document1->divisionid = $this->selectedDivision;
            $Document1->unitid = $this->selectedUnit;
            $Document1->from_userid = auth('web')->user()->id;
            $Document1->from_officeid = $User->officeid;
            $Document1->from_divisionid = $User->divisionid;
            $Document1->from_unitid = $User->unitid;

            $SuccessDocument = $Document1->save();

            if ($SuccessDocument)
            {

                $this->dispatchBrowserEvent('hideAddRouteModal');
                $this->dispatchBrowserEvent('updateRoute');
                $this->dispatchBrowserEvent('updateIncomingCount');       
                $this->showToastr('Route for document ' . $Document1->PDN . ' added Successfully.','success');

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
    $this->remarks = null;
    $this->selectedDivision= null;
    $this->selectedOffice= null;
    $this->selectedUnit= null;
    $this->reset(['selectedRows','selectedPageRows']);   
}


    public function updatedselectedPageRows($value) {
        

        if ($value) 
        {
            $this->selectedRows = $this->processingLists->pluck('id')->map(function($id) {
                return (string) $id;
            });
        }
        else{
         $this->reset(['selectedRows','selectedPageRows']);   
        }

        // dd($this->selectedRows);
    }
    
    public function markClose() {

        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showCloseAllModal');

    }

  

    public function add_tasks() {

    $this->resetErrorBag();
    $this->dispatchBrowserEvent('showAddTaskModal');

    }

    public function markAllask() {

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
       

            foreach($this->selectedRows as $Selected) {

         
                $getPDN = Document::where('id', $Selected)->get()->first();
                if ($this->authorize('addTask', $getPDN))
                {            
                    $EndNo = AutoNumber::where('code','=', 'T')->get()->first();
                    $Document = Document::findOrFail($getPDN->id);
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
                        $SuccessRoute = $Route->save();
        
                        if ($SuccessRoute)
                        {
                            $this->dispatchBrowserEvent('updateProcessingCount');
                            $this->dispatchBrowserEvent('hideTaskAllModal');
                            $this->showToastr('Task added to Document ' . $getPDN->PDN . ' Successfully.','success');
                
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
                    $this->showToastr('You are not authorized to close document ' . $getPDN->PDN . '.Please contact System Administrator','error');
                }
            }
    
            $this->reset(['selectedRows','selectedPageRows']);   
            $this->dispatchBrowserEvent('updateProcessingCount');
            
        
    }
    
    public function markAllClose() {
        foreach($this->selectedRows as $Selected) {
            
            $getPDN = Document::where('id', $Selected)->get()->first();
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
                $Route->remarks =$this->closeremarks;
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
                    $this->dispatchBrowserEvent('updateProcessingCount');
                    $this->dispatchBrowserEvent('hideCloseAllModal');
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
                $this->showToastr('You are not authorized to close document ' . $getPDN->PDN . '.Please contact System Administrator','error');
            }
        }

        $this->reset(['selectedRows','selectedPageRows']);   
        $this->dispatchBrowserEvent('updateProcessingCount');
        
    
    }

    public function markAllPrint()
    {
       
        return redirect()->route('mail.printIncoming',json_encode($this->selectedRows) );

     
    }


   

    public function getprocessingListsProperty() {
       
       
       
        $Employee = Employee:: where('email', auth('web')->user()->email )->get()->first();
       return Document::orderby('updated_at','desc')->where('is_accepted',true)->where('officeid', $Employee->officeid)->where('divisionid', $Employee->divisionid)->where('unitid', $Employee->unitid)->search(trim($this->Search))->paginate($this->perPage);

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
        $processingLists = $this->processingLists;
        return view('livewire.user.mail.processing',[
            'processingLists' => $processingLists, 
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
