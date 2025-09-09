<?php

namespace App\Http\Livewire\User\Mail;

use Livewire\Component;
use App\Models\Task\Task as TaskLists;
use Livewire\WithPagination;
use App\Models\Admin\EMS\Employee;
use App\Models\DocumentTracking\Document;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Task extends Component
{

    
    use AuthorizesRequests;
    use WithPagination;
    public $selectedRows = [];
    public $selectedPageRows = false;
    public $perPage;
    public $Search;
    // public $AssignTaskLists;

    // protected $listeners = [
    //     'updateClosed' => '$refresh'
    // ];


    public function mount() {
        $this->perPage = 10;
    }



    public function updatedselectedPageRows($value) {
        

        if ($value) 
        {
            $this->selectedRows = $this->ClosedLists->pluck('id')->map(function($id) {
                return (string) $id;
            });
        }
        else{
         $this->reset(['selectedRows','selectedPageRows']);   
        }

      
    }
    
   

    // public function markAllPrint()
    // {
       
    //     return redirect()->route('mail.printIncoming',json_encode($this->selectedRows) );

     
    // }


   

    public function getAssignTaskListsProperty() {
       

       return TaskLists::orderby('created_at','desc')->where('document_id','!=', NULL)->get()->where('user_id', auth('web')->user()->id)->search(trim($this->Search))->paginate($this->perPage);
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




  

    
    public function render()
    {
        $AssignTaskLists = $this->AssignTaskLists;

        return view('livewire.user.mail.task', [
            'AssignTaskLists' =>TaskLists::orderby('created_at','desc')->where('document_id','!=', NULL)->get()->where('user_id', auth('web')->user()->id)->search(trim($this->Search))->paginate($this->perPage),
            
            $Employee = Employee:: where('email', auth('web')->user()->email )->get()->first(),
            'incomingCount' => Document::orderby('created_at','desc')->get()->where('is_forwarded',true)->where('officeid', $Employee->officeid)->where('divisionid', $Employee->divisionid)->where('unitid', $Employee->unitid)->count(),
            'processingCount' => Document::orderby('created_at','desc')->get()->where('is_accepted',true)->where('officeid', $Employee->officeid)->where('divisionid', $Employee->divisionid)->where('unitid', $Employee->unitid)->count(),
            'outgoingCount' => Document::orderby('created_at','desc')->get()->where('is_forwarded',true)->where('from_officeid', $Employee->officeid)->where('from_divisionid', $Employee->divisionid)->where('from_unitid', $Employee->unitid)->count(),
            'rejectedCount' => Document::orderby('created_at','desc')->get()->where('is_rejected',true)->where('officeid', $Employee->officeid)->where('divisionid', $Employee->divisionid)->where('unitid', $Employee->unitid)->count(),
            'closedCount' => Document::orderby('created_at','desc')->get()->where('is_active',false)->where('officeid', $Employee->officeid)->where('divisionid', $Employee->divisionid)->where('unitid', $Employee->unitid)->count(),
            'AssignedTaskCount' =>TaskLists::orderby('created_at','desc')->where('document_id','!=', NULL)->get()->where('user_id', auth('web')->user()->id)->count(),
        ]);
 
    }
}
