<?php

namespace App\Http\Livewire\User\Announcement;

use App\Models\Admin\AdminPanel\Category\Office;
use App\Models\User;
use Livewire\Component;
use App\Models\Announcement;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Index extends Component
{

    use AuthorizesRequests;
    use WithPagination;
    
    public $perPage;
    public $Search;

    public $updateAnnouncement = false;
    public $selected_announcement_id = null;
    public $announce_to, $subject, $start_date, $end_date,$remarks,$office_id,$OfficeLists;


    public function updatingSearch() {
        $this->resetPage();
    }

    public function mount() {
        $this->resetPage();
        $this->perPage = 10;
        $this->updateAnnouncement = false;
        $this->selected_announcement_id = null;
        $this->OfficeLists = Office::where('office','!=','OTHERS')->orderby('office','asc')->get();

    }
    
    public function showToastr($message, $type) {
        return $this->dispatchBrowserEvent('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }

    public function addAnnouncement() {

            $this->authorize('create', App\Models\Announcement::class);
           
            $this->validate([
                'announce_to' => 'required',
                'subject' => 'required',
                'start_date' => 'required',
                'end_date' => 'required', 
                'office_id' => 'required',
                'remarks' => 'required',
              
            ]);
    
       
                $Announcement = new Announcement();
                $Announcement->announce_to = $this->announce_to;
                $Announcement->office_id = $this->office_id;
                $Announcement->remarks = $this->remarks;
                $Announcement->subject = $this->subject;
                $Announcement->start_date = $this->start_date;
                $Announcement->end_date = $this->end_date;
                $User = User::where('id', auth()->user()->id)->get()->first();
                $Announcement->user_id = $User->id;
    
                $success = $Announcement->save();
        
                if ($success)
                {   
                    $this->dispatchBrowserEvent('hideUpdateModal');
                    $this->showToastr('Announcement Added Successfully.','success');
        
                }
                else
                {
                    $this->showToastr('Something went wrong. Please contact System Administrator','error');
                }
          
        
    }

    public function editAnnouncement($id) {
        $Announcement = Announcement::findOrFail($id);
        $this->authorize('update', $Announcement);
        $this->selected_announcement_id = $Announcement->id;
        $this->announce_to = $Announcement->announce_to;
        $this->subject = $Announcement->subject;
        $this->start_date = $Announcement->start_date;
        $this->end_date = $Announcement->end_date;
        $this->updateAnnouncement = true;
        $this->office_id = $Announcement->office_id; 
        $this->remarks = $Announcement->remarks;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showUpdateModal');
    }

    public function updateAnnouncement() {
        $Announcement = Announcement::findOrFail($this->selected_announcement_id);
        $this->authorize('update', $Announcement);
        if ($this->selected_announcement_id) {
          
            $this->validate([
                'announce_to' => 'required',
                'subject' => 'required',
                'start_date' => 'required',
                'end_date' => 'required', 
              
            ]);

            $Announcement->announce_to = $this->announce_to;
            $Announcement->subject = $this->subject;
            $Announcement->start_date = $this->start_date;
            $Announcement->end_date = $this->end_date;
            $Announcement->office_id = $this->office_id;
            $Announcement->remarks = $this->remarks;

            $Success = $Announcement->save();

            if ($Success)
            {
                $this->dispatchBrowserEvent('hideUpdateModal');
                $this->announce_to = null;
                $this->subject = null;
                $this->start_date = null;
                $this->end_date = null;
                $this->updateAnnouncement = false;
                $this->showToastr('Announcement has been successfully Updated.','success');
            }
            else{
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        }

    }

    public function deleteAnnouncement($id) {
        $Announcement = Announcement::findOrFail($id);
        $this->authorize('delete', $Announcement);
        $this->selected_announcement_id = $Announcement->id;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showDeleteModal');
    }

    public function destroyAnnouncement() {
        $Announcement = Announcement::findOrFail($this->selected_announcement_id);
        $this->authorize('delete', $Announcement);
        if ($this->selected_announcement_id) {
            $AnnouncementDelete = Announcement::findOrFail($this->selected_announcement_id);
            
            $Success = $AnnouncementDelete->delete();

            if ($Success) {
                $this->dispatchBrowserEvent('hideDeleteModal');
                $this->selected_announcement_id = null;
                $this->showToastr('Announcement has been successfully Deleted.','success');
            }
            else
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');  
            }
        
        }

    }

    public function render()
    {
        return view('livewire.user.announcement.index', [
            'Announcements' => Announcement::orderby('created_at','asc')->search(trim($this->Search))->paginate($this->perPage),
        ]);
    }
}
