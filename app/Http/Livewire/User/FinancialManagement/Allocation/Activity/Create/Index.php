<?php

namespace App\Http\Livewire\User\FinancialManagement\Allocation\Activity\Create;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\FinancialManagement\gaa\pap;
use App\Models\Admin\AdminPanel\Category\Office;
use App\Models\FinancialManagement\gaa\activity;
use App\Models\FinancialManagement\gaa\allocation\activity as AllocationActivity;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    use WithPagination;
    
    public $updateActivity = false;
    public $selected_activity_id;
    public $perPage;
    public $Search;
    public $activity;
    public $papid;



    protected $listeners = [
        'resetModalForm',
        'deleteActivityAction',
    ];

    public function mount() {
        $this->resetPage();
        $this->perPage = 10;
    }

    public function updateperPage() {
        $this->perPage = $this->perPage;
    }

    public function updatingSearch() {
        $this->resetPage();
    }
    
    public function resetModalForm() {
        $this->resetErrorBag();
        $this->activity = null;
        $this->papid = null;
    }   

    public function addActivity() {
        $this->authorize('createAllocation', App\Models\FinancialManagement\voucher::class);
        $this->validate([
            'activity' => 'required|max:50|unique:fm_activity,activity',
            'papid' => 'required',
        ]);
        $Activity = new activity();
        $Activity->activity = $this->activity;
        $Activity->papid = $this->papid;
        $success = $Activity->save();

        if ($success)
        {
            
            $this->dispatchBrowserEvent('hideAddModal');
            $this->activity = null;
            $this->papid = null;
            $this->showToastr('New Activity added Successfully.','success');

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


    public function editActivity($id) {
     
        $Activity = activity::findOrFail($id);
        $this->authorize('updateAllocation', App\Models\FinancialManagement\voucher::class);
        $this->selected_activity_id = $Activity->id;
        $this->updateActivity = true;
        $this->papid = $Activity->papid;
        $this->activity = $Activity->activity;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showUpdateModal');
    }


    public function updateActivity() {
        if ($this->selected_activity_id) {
            $this->validate([
                'activity' => 'required|unique:fm_activity,activity,'.$this->selected_activity_id,
                'papid' => 'required',
            ]);

            $Activity = activity::findOrFail($this->selected_activity_id);
            $Activity->papid = $this->papid;
            $Activity->activity = $this->activity;
            $Success = $Activity->save();

            if ($Success)
            {
                $this->dispatchBrowserEvent('hideUpdateModal');
                $this->papid = NULL;
                $this->selected_activity_id = NULL;
                $this->activity = NULL;
                $this->updateActivity = false;
                $this->showToastr('Activity has been successfully Updated.','success');
            }
            else{
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        }
    }



    public function deleteActivity($id) {
        $this->authorize('updateAllocation', App\Models\FinancialManagement\voucher::class);
        $Activity = activity::findOrFail($id);
        $this->selected_activity_id = $Activity->id;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showDeleteModal');
    }

    public function destroyActivity() {
        $this->authorize('updateAllocation', App\Models\FinancialManagement\voucher::class);
        if ($this->selected_activity_id) {
            $Activity = activity::findOrFail($this->selected_activity_id);
            
            $withAllocation = AllocationActivity::where('activity_id', $Activity->id )->count();
            
            if ($withAllocation) 
            {
                $this->dispatchBrowserEvent('hideDeleteModal');
                $this->showToastr('Unable to Delete. Activity has allocation.','error');  

            }
            else {
                $Success = $Activity->delete();

                if ($Success) {
                    $this->dispatchBrowserEvent('hideDeleteModal');
                    $this->selected_activity_id = null;
                    $this->showToastr('Activity has been successfully Deleted.','success');
                }
                else
                {
                    $this->showToastr('Something went wrong. Please contact System Administrator','error');  
                }
            
            }
           
        }

    }


    public function render()
    {
        return view('livewire.user.financial-management.allocation.activity.create.index', [
            'PAPs' => pap::orderby('pap', 'asc')->get(),
            'Activities' => activity::orderby('created_at', 'asc')->search(trim($this->Search))
            ->paginate($this->perPage), 
        ]);
    }
}
