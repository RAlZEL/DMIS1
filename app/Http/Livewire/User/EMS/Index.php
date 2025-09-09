<?php

namespace App\Http\Livewire\User\EMS;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use App\Models\Admin\EMS\Employee;
use App\Models\Admin\AdminPanel\Category\Unit;
use App\Models\Admin\AdminPanel\Category\Office;
use App\Models\Admin\AdminPanel\Category\Division;
use App\Models\Admin\AdminPanel\createOffice\OfficeGroup;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Index extends Component
{

    use AuthorizesRequests;

    use WithPagination;

    public $employeeid, $firstname, $middlename, $lastname, $birthdate, $contactnumber, $email, $address, $officeid, $divisionid, $unitid, $position, $datehired, $empstatus, $has_account, $is_retired;
    public $selected_employee_id;

    public $updateEmployee = false;
    public $perPage;

    public $Search;

    public $officeids;
    public $divisionids;
    public $unitids;
    public $selectedOffice = NULL;
    public $selectedDivision = NULL;
    public $selectedUnit = NULL;
    public $DivisionFinal;

    protected $listeners = [
        'resetModalForm',
        'deleteOfficeAction',
    ];

    public function mount() {
        $this->resetPage();
        $this->perPage = 10;
        $this->officeids = Office::orderby('office','asc')->get();
        $this->divisionids = collect();
        $this->unitids = collect();
        $this->DivisionFinal = Division::orderby('division','asc')->get();
    }


    public function resetModalForm() {

        $this->resetErrorBag();

        $this->updateEmployee = false;
        
        $this->employeeid = null;
        $this->firstname = null;
        $this->middlename = null;
        $this->lastname = null;
        $this->birthdate = null;
        $this->contactnumber = null;
        $this->email = null;
        $this->address = null;
        $this->officeid = null;
        $this->divisionid = null;
        $this->unitid = null;
        $this->position = null;
        $this->datehired = null;
        $this->empstatus = null;
        $this->has_account = false;
        $this->is_retired = false;
    
        $this->selectedDivision = NULL;
        $this->selectedUnit = NULL;
        $this->selectedOffice = NULL;
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


    public function addEmployee() {
        $this->authorize('viewany', App\Models\Admin\EMS\Employee::class);
        $this->validate([
            'employeeid' => ['required','max:50', Rule::unique('employees')->where('employeeid', $this->employeeid)],
            'firstname' => 'required|max:50',
            'middlename' => 'required|max:50',
            'lastname' => ['required', Rule::unique('employees')
                                    ->where('firstname', $this->firstname)
                                    ->where('middlename', $this->middlename)
                                    ->where('lastname', $this->lastname)],
            'birthdate' => 'required',
            'contactnumber' => 'required',
            'email' => 'required|email',
            'address' => 'required|max:150',
            'selectedOffice' => 'required',
            'selectedDivision'=> 'required',
            'selectedUnit' => 'required',
            'position' => 'required|max:50',
            'datehired' => 'required',
            'empstatus' => 'required',            
        ]);       
    
        $Employee = new Employee();
        $Employee->employeeid = $this->employeeid;
        $Employee->firstname = $this->firstname;
        $Employee->middlename = $this->middlename;
        $Employee->lastname = $this->lastname;
        $Employee->birthdate = $this->birthdate;
        $Employee->contactnumber = $this->contactnumber;
        $Employee->email = $this->email;
        $Employee->address = $this->address;
        $Employee->officeid = $this->selectedOffice;
        $Employee->divisionid = $this->selectedDivision;
        $Employee->unitid = $this->selectedUnit;
        $Employee->position = $this->position;
        $Employee->datehired = $this->datehired;
        $Employee->empstatus = $this->empstatus;
        // $Employee->officesectionunit = $this->selectedOffice . ','. $this->selectedDivision . ','. $this->selectedUnit;
        $Employee->has_account = false;
        if($this->is_retired == true)
        {
            $Employee->is_retired = true;
        }
        else {
            $Employee->is_retired = false;
        }

        $success = $Employee->save();

        if ($success)
        {
            $this->dispatchBrowserEvent('hideEmployeeModal');
            $this->updateEmployee = false;
            $this->resetModalForm();
            $this->showToastr('New Employee added Successfully.','success');

        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }

    }


    public function editEmployee($id) {
        $this->authorize('viewany', App\Models\Admin\EMS\Employee::class);
        $Employee = Employee::findOrFail($id);
        $this->selected_employee_id = $Employee->id;
        $this->employeeid = $Employee->employeeid;
        $this->firstname = $Employee->firstname;
        $this->middlename = $Employee->middlename;
        $this->lastname = $Employee->lastname;
        $this->birthdate = $Employee->birthdate;
        $this->contactnumber = $Employee->contactnumber;
        $this->email = $Employee->email;
        $this->address = $Employee->address;
        $this->selectedOffice = $Employee->officeid;
        $this->selectedDivision = $Employee->divisionid;
        $this->selectedUnit = $Employee->unitid;
        $this->position = $Employee->position;
        $this->datehired = $Employee->datehired;
        $this->empstatus = $Employee->empstatus;
        $this->is_retired = $Employee->is_retired;
        $this->updateEmployee = true;

        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showUpdateModal');
    }


    public function updatingSearch() {
        $this->resetPage();
    }

    
    public function updateEmployee() {
        $this->authorize('viewany', App\Models\Admin\EMS\Employee::class);
        if ($this->selected_employee_id) {
            $this->validate([
                'employeeid' => ['required','max:50', Rule::unique('employees')->where('employeeid', $this->employeeid).$this->selected_employee_id],
                'firstname' => 'required|max:50',
                'middlename' => 'required|max:50',
                'lastname' => ['required', Rule::unique('employees')
                                        ->where('firstname', $this->firstname)
                                        ->where('middlename', $this->middlename)
                                        ->where('lastname', $this->lastname).$this->selected_employee_id],
                'birthdate' => 'required',
                'contactnumber' => 'required',
                'email' => ['required','email', Rule::unique('employees')->where('email', $this->email).$this->selected_employee_id],
                'address' => 'required|max:150',
                'selectedOffice' => 'required',
                'selectedDivision'=> 'required',
                'selectedUnit' => 'required',
                'position' => 'required|max:50',
                'datehired' => 'required',
                'empstatus' => 'required',            
            ]);

            $Employee = Employee::findOrFail($this->selected_employee_id);


            $Employee->employeeid = $this->employeeid;
            $Employee->firstname = $this->firstname;
            $Employee->middlename = $this->middlename;
            $Employee->lastname = $this->lastname;
            $Employee->birthdate = $this->birthdate;
            $Employee->contactnumber = $this->contactnumber;
            $Employee->email = $this->email;
            $Employee->address = $this->address;
            $Employee->officeid = $this->selectedOffice;
            $Employee->divisionid = $this->selectedDivision;
            $Employee->unitid = $this->selectedUnit;
            $Employee->position = $this->position;
            $Employee->datehired = $this->datehired;
            $Employee->empstatus = $this->empstatus;
            $Employee->has_account = false;
            if($this->is_retired == true)
            {
                $Employee->is_retired = true;
            }
            else {
                $Employee->is_retired = false;
            }
            $Success = $Employee->save();

            if ($Success)
            {
                $this->dispatchBrowserEvent('hideEmployeeModal');
                $this->updateEmployee = false;
                $this->resetModalForm();
                $this->showToastr('Employee has been successfully Updated.','success');
            }
            else{
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        }
    }

    public function deleteEmployee($id) {

        $Employee = Employee::findOrFail($id);
        $this->authorize('update', $Employee);
        $this->selected_employee_id = $Employee->id;
        $this->firstname = $Employee->firstname;
        $this->middlename = $Employee->middlename;
        $this->lastname = $Employee->lastname;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showDeleteModal');
    }

    public function destroyEmployee() {
     
        if ($this->selected_employee_id) {
            $Employee = Employee::findOrFail($this->selected_employee_id);
            $this->authorize('delete', $Employee);
            $Success = $Employee->delete();

            if ($Success) {
                $this->dispatchBrowserEvent('hideDeleteEmployeeModal');
                $this->selected_employee_id = null;
                $this->resetModalForm();
                $this->showToastr('Employee has been successfully Deleted.','success');
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

        $this->authorize('viewany', App\Models\Admin\EMS\Employee::class);
        return view('livewire.user.e-m-s.index', [
            'Employees' => Employee::orderby('employeeid','asc')->search(trim($this->Search))->paginate($this->perPage),
        ]);
    }
}
