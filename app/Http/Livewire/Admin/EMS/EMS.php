<?php

namespace App\Http\Livewire\Admin\EMS;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use App\Models\Admin\EMS\Employee;
use App\Models\Admin\AdminPanel\Category\Unit;
use App\Models\Admin\AdminPanel\Category\Office;
use App\Models\Admin\AdminPanel\Category\Division;
use App\Models\Admin\AdminPanel\createOffice\OfficeGroup;

class EMS extends Component
{

    use WithPagination;

    public $employeeid;
    // public $employeeid, $firstname, $middlename, $lastname, $birthdate, $contactnumber, $email, $address, $officeid, $divisionid, $unitid, $position, $datehired, $empstatus, $has_account, $is_retired;
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

    public function mount() {
        $this->resetPage();
        $this->perPage = 10;
        // $this->officeids = Office::orderby('office','asc')->get();
        // $this->divisionids = collect();
        // $this->unitids = collect();
        $this->DivisionFinal = Division::orderby('division','asc')->get();
    }

  
    public function resetModalForm() {
        $this->resetErrorBag();
        $this->employeeid = null;
     
    }   
    // public function resetModalForm() {

    //     $this->resetErrorBag();

    //     $this->updateEmployee = false;
        
    //     $this->employeeid = null;
        // $this->firstname = null;
        // $this->middlename = null;
        // $this->lastname = null;
        // $this->birthdate = null;
        // $this->contactnumber = null;
        // $this->email = null;
        // $this->address = null;
        // $this->officeid = null;
        // $this->divisionid = null;
        // $this->unitid = null;
        // $this->position = null;
        // $this->datehired = null;
        // $this->empstatus = null;
        // $this->has_account = false;
        // $this->is_retired = false;
    
        // $this->selectedDivision = NULL;
        // $this->selectedUnit = NULL;
        // $this->selectedOffice = NULL;
    // }  




    // public function updatedSelectedOffice($officeid) {
    


    //         $this->divisionids = Division::get();
    //         $this->selectedDivision = NULL;
    //         $this->selectedUnit = NULL;
 

    // }

    // public function updatedSelectedDivision($divisionid) {
    //     if(!is_null($divisionid))
    //     {     
    //             $this->unitids = OfficeGroup::where('office_id', $this->selectedOffice)->where('division_id', $divisionid)->get();
    //             $this->selectedUnit = NULL;
    
    //     }    
    // }


    public function updatingSearch() {
        $this->resetPage();
    }
    
   

    // public function addEmployee() {
    //     $this->validate([
    //         'employeeid' => ['required','max:50', Rule::unique('employees')->where('employeeid', $this->employeeid)],
    //         'firstname' => 'required|max:50',
    //         'middlename' => 'required|max:50',
    //         'lastname' => ['required', Rule::unique('employees')
    //                                 ->where('firstname', $this->firstname)
    //                                 ->where('middlename', $this->middlename)
    //                                 ->where('lastname', $this->lastname)],
    //         'birthdate' => 'required',
    //         'contactnumber' => 'required',
    //         'email' => 'required|email',
    //         'address' => 'required|max:150',
    //         // 'selectedOffice' => 'required',
    //         // 'selectedDivision'=> 'required',
    //         // 'selectedUnit' => 'required',
    //         'position' => 'required|max:50',
    //         'datehired' => 'required',
    //         'empstatus' => 'required',            
    //     ]);       
    
    //     $Employee = new Employee();
    //     $Employee->employeeid = $this->employeeid;
    //     $Employee->firstname = $this->firstname;
    //     $Employee->middlename = $this->middlename;
    //     $Employee->lastname = $this->lastname;
    //     $Employee->birthdate = $this->birthdate;
    //     $Employee->contactnumber = $this->contactnumber;
    //     $Employee->email = $this->email;
    //     $Employee->address = $this->address;
    //     // $Employee->officeid = $this->selectedOffice;
    //     // $Employee->divisionid = $this->selectedDivision;
    //     // $Employee->unitid = $this->selectedUnit;
    //     $Employee->position = $this->position;
    //     $Employee->datehired = $this->datehired;
    //     $Employee->empstatus = $this->empstatus;
    //     $Employee->has_account = false;
    //     if($this->is_retired == true)
    //     {
    //         $Employee->is_retired = true;
    //     }
    //     else {
    //         $Employee->is_retired = false;
    //     }

    //     $success = $Employee->save();

    //     if ($success)
    //     {
    //         $this->dispatchBrowserEvent('hideEmployeeModal');
    //         $this->updateEmployee = false;
    //         $this->resetModalForm();
    //         $this->showToastr('New Employee added Successfully.','success');

    //     }
    //     else
    //     {
    //         $this->showToastr('Something went wrong. Please contact System Administrator','error');
    //     }

    // }



    // public function editOffice($id) {
    //     $Employee = Employee::findOrFail($id);
    //     $this->selected_employee_id = $Employee->id;
    //     $this->employeeid = $Employee->employeeid;
    //     $this->firstname = $Employee->firstname;
    //     $this->middlename = $Employee->middlename;
    //     $this->lastname = $Employee->lastname;
    //     $this->birthdate = $Employee->birthdate;
    //     $this->contactnumber = $Employee->contactnumber;
    //     $this->email = $Employee->email;
    //     $this->address = $Employee->address;
    //     // $this->selectedOffice = $Employee->officeid;
    //     // $this->selectedDivision = $Employee->divisionid;
    //     // $this->selectedUnit = $Employee->unitid;
    //     $this->position = $Employee->position;
    //     $this->datehired = $Employee->datehired;
    //     $this->empstatus = $Employee->empstatus;
    //     $this->is_retired = $Employee->is_retired;
    //     $this->updateEmployee = true;

    //     $this->resetErrorBag();
    //     $this->dispatchBrowserEvent('showUpdateModal');
    // }


    // public function updateEmployee() {
    // //     if ($this->selected_office_id) {
    // //         $this->validate([
    // //             'office' => 'required|unique:office,office,'.$this->selected_office_id,
    // //         ]);

    // //         $Office = Office::findOrFail($this->selected_office_id);
    // //         $Office->office = $this->office;
    // //         $Office->address = $this->address;
    // //         $Success = $Office->save();

    // //         if ($Success)
    // //         {
    // //             $this->dispatchBrowserEvent('hideOfficeModal');
    // //             $this->office = null;
    // //             $this->address = null;
    // //             $this->updateOffice = false;
    // //             $this->showToastr('Office has been successfully Updated.','success');
    // //         }
    // //         else{
    // //             $this->showToastr('Something went wrong. Please contact System Administrator','error');
    // //         }
    // //     }
    // }




    public function showToastr($message, $type) {
        return $this->dispatchBrowserEvent('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }


    public function render()
    {
        return view('livewire.admin.e-m-s.e-m-s', [
            'Employees' => Employee::orderby('employeeid','asc')->search(trim($this->Search))->paginate($this->perPage),
        ]);
    }
}
