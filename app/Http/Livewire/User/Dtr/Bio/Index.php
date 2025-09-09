<?php

namespace App\Http\Livewire\User\Dtr\Bio;

use App\Models\Admin\EMS\Employee;
use App\Models\DeviceBio;
use App\Models\EmpBio;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use AuthorizesRequests;
    public $device, $selectedEmployee, $selectedDevice, $bioid;
    public $perPage;
    public $Search;
    public $selected_bio_id;

    public function mount() {
        $this->resetPage();
        $this->perPage = 10;
        $this->selected_bio_id = null;
        
    }


    public function addDevice() {
        $this->authorize('Biometric',App\Models\DTR::class);
        $this->validate([
            'device' => 'required',
    
        ], [
            'device.required' => 'Device Name field is required.',
      
        ]);   

        $Bio = new DeviceBio();
        $Bio->device = $this->device;
        $success = $Bio->save();

        if ($success)
        {   
            $this->device = null;
            $this->showToastr('Biometric Device Added Successfully.','success');

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

    public function deleteBio($id) {
        $this->authorize('Biometric',App\Models\DTR::class);
        $Bio = EmpBio::findOrFail($id);
        $this->selected_bio_id = $Bio->id;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showDeleteModal');
    }

    public function destroyBio() {
        $this->authorize('Biometric',App\Models\DTR::class);
        if ($this->selected_bio_id) {
            $Bio = EmpBio::findOrFail($this->selected_bio_id);
            
            $Success = $Bio->delete();

            if ($Success) {
                $this->dispatchBrowserEvent('hideDeleteModal');
                $this->selected_bio_id = null;
                $this->showToastr('Biometric Entry has been successfully Deleted.','success');
            }
            else
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');  
            }
        
        }

    }


    
    public function addEmployee() {
        $this->authorize('Biometric',App\Models\DTR::class);
        $this->validate([
            'selectedDevice' => 'required',
            'bioid' => 'required',
            'selectedEmployee' => 'required|unique:bio_emp,emp_id',
            
        ], [
            'selectedDevice.required' => 'Device field is required.',
            'selectedEmployee.required' => 'Employee Name field is required.',
            'bioid.required' => 'Biometric ID field is required.',
            'selectedEmployee.unique' => 'Duplicate Employee Name.',
        ]);   

        $Bio = new EmpBio();
        $Bio->emp_id = $this->selectedEmployee;
        $Bio->device_id = $this->selectedDevice;
        $Bio->bio_id = $this->bioid;
        $success = $Bio->save();

        if ($success)
        {   
            $this->bioid = null;
            $this->selectedEmployee = null;
            $this->showToastr('Biometric Device Added Successfully.','success');

        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }

        
    }

    public function render()
    {
        return view('livewire.user.dtr.bio.index', [
            'Employees' => Employee::orderby('firstname', 'asc')->get(),
            'DTRDevices' => DeviceBio::orderby('device', 'asc')->get(),
            'BioEmps' => EmpBio::orderby('created_at', 'asc')->search(trim($this->Search))->paginate($this->perPage),
        ]);
    }
}
