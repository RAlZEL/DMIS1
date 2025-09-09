<?php

namespace App\Http\Livewire\User\Mail;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Task\Task;
use Livewire\WithPagination;
use App\Models\Admin\EMS\Employee;
use App\Models\DocumentTracking\Route;
use App\Models\DocumentTracking\Document;
use App\Models\Admin\AdminPanel\Category\Office;
use App\Models\Admin\AdminPanel\Category\Division;
use App\Models\Admin\AdminPanel\createOffice\OfficeGroup;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Rejected extends Component
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

    protected $listeners = [
        'updateRejected' => '$refresh'
    ];


    public function mount() {
        $this->perPage = 10;
        $this->officeids = Office::orderby('office','asc')->get();
        $this->DivisionFinal = Division::orderby('division','asc')->get();
        $this->divisionids = collect();
        $this->unitids = collect();
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
            $Document1->remarks = $this->remarks;
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
    $this->reset(['selectedRows','selectedPageRows']);   
    $this->remarks = null;
    $this->selectedDivision= null;
    $this->selectedOffice= null;
    $this->selectedUnit= null;
}


    public function updatedselectedPageRows($value) {
        

        if ($value) 
        {
            $this->selectedRows = $this->RejectedLists->pluck('id')->map(function($id) {
                return (string) $id;
            });
        }
        else{
         $this->reset(['selectedRows','selectedPageRows']);   
        }

        // dd($this->selectedRows);
    }
    
   

    public function markAllPrint()
    {
       
        return redirect()->route('mail.printIncoming',json_encode($this->selectedRows) );

     
    }


   

    public function getRejectedListsProperty() {
       
       
       
        $Employee = Employee:: where('email', auth('web')->user()->email )->get()->first();
       return Document::orderby('updated_at','desc')->where('is_rejected',true)->where('officeid', $Employee->officeid)->where('divisionid', $Employee->divisionid)->where('unitid', $Employee->unitid)->search(trim($this->Search))->paginate($this->perPage);

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
        

        $RejectedLists = $this->RejectedLists;
        return view('livewire.user.mail.rejected',[
            'RejectedLists' => $RejectedLists, 
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
