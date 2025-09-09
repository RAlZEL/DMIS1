<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Models\Admin\EMS\Employee;
use App\Models\Admin\AdminPanel\Category\Unit;
use App\Models\Admin\AdminPanel\Category\Office;
use App\Models\Admin\AdminPanel\Category\Division;

class Personal extends Component
{

    
    public $employeeid, $firstname, $middlename, $lastname, $birthdate, $contactnumber, $email, $address, $officeid, $divisionid, $unitid, $position, $datehired, $empstatus, $has_account, $is_retired;
    public $user;
    public $selected_employee_id;

    public function mount() {

        $this->user = User::find(auth('web')->id());
        $Employee = Employee::where('email',$this->user->email)->get()->first();
        $this->employeeid = $Employee->employeeid;
        $this->firstname = $Employee->firstname;
        $this->middlename = $Employee->middlename;
        $this->lastname = $Employee->lastname;
        $this->birthdate = $Employee->birthdate;
        $this->contactnumber = $Employee->contactnumber;
        $this->email = $Employee->email;
        $this->address = $Employee->address;
        $this->officeid = $Employee->officeid;
        $this->position = $Employee->position;
        $this->datehired = $Employee->datehired;
        $this->empstatus = $Employee->empstatus;
        $this->is_retired = $Employee->is_retired;
        $this->officeid = $Employee->office->office;
        $this->divisionid = $Employee->division->division;
        $this->unitid = $Employee->unit->unit;
        $this->selected_employee_id = $Employee->id;
    }


    public function UpdateDetails() {

        $this->validate([
            'employeeid' => ['required','max:50', Rule::unique('employees')->where('employeeid', $this->employeeid).$this->selected_employee_id],
            'firstname' => 'required|max:50',
            'middlename' => 'required|max:50',
            'lastname' => ['required', Rule::unique('employees')
                                    ->where('firstname', $this->firstname.$this->firstname)
                                    ->where('middlename', $this->middlename.$this->middlename)
                                    ->where('lastname', $this->lastname.$this->lastname)],
            'birthdate' => 'required',
            'contactnumber' => 'required',
            'address' => 'required|max:150',
            'position' => 'required|max:20',
            'datehired' => 'required',
            'empstatus' => 'required',     
            'empstatus' => 'required',         
        ]);       


        
        // $success = Employee::where('id', $this->selected_employee_id)->update([
        //     'username' => $this->username,
        // ]);



        $Employee = Employee::findOrFail($this->selected_employee_id);

        $Employee->employeeid = $this->employeeid;
        $Employee->firstname = $this->firstname;
        $Employee->middlename = $this->middlename;
        $Employee->lastname = $this->lastname;
        $Employee->birthdate = $this->birthdate;
        $Employee->contactnumber = $this->contactnumber;
        $Employee->address = $this->address;
        $Employee->position = $this->position;
        $Employee->datehired = $this->datehired;
        $Employee->empstatus = $this->empstatus;
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
            $this->emit('updateEmployeeProfileHeader');
            $this->emit('updateEmployeeTopHeader');
            $this->showToastr('Your Personal Information have been successfully updated.','success');
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


    public function render()
    {
        return view('livewire.user.personal');
    }
}
