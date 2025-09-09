<?php

namespace App\Http\Livewire\User\Event;

use Carbon\Carbon;
use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Admin\AdminPanel\Category\Office;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{

    use AuthorizesRequests;
    use WithPagination;
    
    public $updateEvent, $event, $remarks, $date, $office, $schedule;
    public $selected_event_id;
    public $officelists;
    public $perPage;
    public $Search;


    public function updatingSearch() {
        $this->resetPage();
    }
    

    public function mount() {
        $this->resetPage();
        $this->perPage = 10;
        $this->updateEvent = false;
        $this->selected_event_id = false;
        $this->officelists = Office::orderby('office', 'asc')->get();
     
    }


    protected $listeners = [
        'resetModalForm',
  
    ];


    public function resetModalForm() {
        $this->date = null;
        $this->event = null;
        $this->schedule = null;
        $this->remarks = null;
        $this->office = null;
        $this->resetErrorBag();
    }   


    public function addEvent() {

        $this->authorize('create', App\Models\Event::class);
       
        $this->validate([
            'event' => 'required',
            'remarks' => 'required',
            'date' => 'required',
            'office' => 'required', 
            'schedule' => 'required',
        ]);

        $check = Event::where('date',$this->date)->where('office', $this->office)->get()->first();
        if ($check)
        {
            $this->showToastr('Unable to save. Date already have an event.','error');
        }
        else {
            $Event = new Event();
            $Event->date = $this->date;
            $Event->event = $this->event;
            $Event->schedule = $this->schedule;
            $Event->remarks = $this->remarks;
            $Event->office = $this->office;

            $success = $Event->save();
    
            if ($success)
            {   
            
                $this->showToastr('Event Added Successfully.','success');
    
            }
            else
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        }
    }

    public function editEvent($id) {
       
        $Event = Event::findOrFail($id);
        $this->authorize('update', $Event);
        $this->selected_event_id = $Event->id;
        $this->date = $Event->date;
        $this->event = $Event->event;
        $this->schedule = $Event->schedule;
        $this->remarks = $Event->remarks;
        $this->office = $Event->office;

        $this->updateEvent = true;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showUpdateModal');
    }

    public function updateEvent() {
        $Event = Event::findOrFail($this->selected_event_id);
        $this->authorize('update', $Event);
        if ($this->selected_event_id) {
            $this->validate([
                'event' => 'required',
                'remarks' => 'required',
                'date' => 'required',
                'office' => 'required', 
                'schedule' => 'required',
            ]);

            $Event->date = $this->date;
            $Event->event = $this->event;
            $Event->schedule = $this->schedule;
            $Event->remarks = $this->remarks;
            $Event->office = $this->office;

            $Success = $Event->save();

            if ($Success)
            {
                $this->dispatchBrowserEvent('hideAddModal');
                $this->date = null;
                $this->event = null;
                $this->schedule = null;
                $this->remarks = null;
                $this->office = null;
                $this->updateEvent = false;
                $this->showToastr('Event has been successfully Updated.','success');
            }
            else{
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        }

    }

    public function deleteEvent($id) {
        $Event = Event::findOrFail($id);
        $this->authorize('delete', $Event);
        $this->selected_event_id = $Event->id;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showDeleteModal');
    }

    public function destroyEvent() {
        $Event = Event::findOrFail($this->selected_event_id);
        $this->authorize('delete', $Event);
        if ($this->selected_event_id) {
            $EventDelete = Event::findOrFail($this->selected_event_id);
            
            $Success = $EventDelete->delete();

            if ($Success) {
                $this->dispatchBrowserEvent('hideDeleteModal');
                $this->selected_event_id = null;
                $this->showToastr('Event has been successfully Deleted.','success');
            }
            else
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');  
            }
        
        }

    }



    public function showToastr($message, $type) {
        return $this->dispatchBrowserEvent('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }

    public function render()
    {
        return view('livewire.user.event.index', [
            'Events' => Event::orderby('date','asc')->search(trim($this->Search))->paginate($this->perPage),
        ]);
    }
}
