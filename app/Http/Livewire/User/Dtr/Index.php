<?php

namespace App\Http\Livewire\User\Dtr;

use Carbon\Carbon;
use App\Models\DTR;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Admin\EMS\Employee;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{

    use AuthorizesRequests;
    use WithPagination;

    public $perPage;

    public $Search;

    public $updateDTR1 = false;

    public $selectedEmployee;   
    public $schedule; 
    public $dtrdate;
    public $time;

    public $selectedEmployeeA;   
    public $scheduleA; 
    public $dtrdateA;

    public $selectedEmployeeR;   
    public $scheduleR; 
    public $dtrdateR;
    public $remarks;
    public $UpdateLate;
    public $UpdateUndertime;

    public $MorningLate;
    public $AfternoonLate;
    public $finalLate;
    public $FinalUndertime;
    public $seleceted_dtr_id;

    public $eventtype;
    
    public function mount() {
        $this->resetPage();
        $this->perPage = 10;
        
    }


    public function editDTR($id) {
       
        $DTR = DTR::findOrFail($id);
        $this->authorize('update', $DTR);
        $this->seleceted_dtr_id = $DTR->id;
        $this->resetErrorBag();
        $this->updateDTR1 = true;
        $this->dtrdate = $DTR->date;
        $this->selectedEmployee = $DTR->Employee->firstname . ' ' . $DTR->Employee->lastname;
        // $this->schedule -> $DTR->schedule;
        $this->time = $DTR->time;
        

        if(!is_null($DTR->late )) {
            $this->UpdateLate = $DTR->late;
        }
        else {
            $this->UpdateLate = "00:00:00";
        }

        if(!is_null($DTR->undertime)) {
            $this->UpdateUndertime = $DTR->undertime;
        }
        else {
            $this->UpdateUndertime = "00:00:00";
        }


  
        $this->dispatchBrowserEvent('showUpdateModal');
    }

    public function updateDTR() {

        $DTR = DTR::findOrFail($this->seleceted_dtr_id);
        $this->authorize('update', $DTR);
        if ($DTR) {
            $this->validate([
                'dtrdate' => 'required',
                'selectedEmployee' => 'required',
                'time' => 'required',
                'schedule' => 'required',
            ]);

            $DTR->schedule = $this->schedule;
            $DTR->time = $this->time;
            
            if ($this->UpdateUndertime != "00:00:00") {
                $DTR->undertime = $this->UpdateUndertime;
                // $DTR->undertime = date("H:i",$this->UpdateUndertime );
            }
            else {
                $DTR->undertime = null;
            }
            if ($this->UpdateLate != "00:00:00") {
                      $DTR->late = $this->UpdateLate;
          
                // $DTR->late = date("H:i",$this->UpdateLate );
            }
            else {
                $DTR->late = null;
            }

            $Success = $DTR->save();

            if ($Success)
            {
                $this->dispatchBrowserEvent('hideUpdateModal');
                $this->updateDTR1 = false;
                $this->seleceted_dtr_id = false;
            
                $this->showToastr('DTR has been successfully Updated.','success');
            }
            else{
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        }
    }

    public function deleteDTR($id) {
       
        $DTR = DTR::findOrFail($id);
        $this->authorize('delete', $DTR);
        $this->seleceted_dtr_id = $DTR->id;
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('showDeleteModal');
    }

    public function destroyDTR() {
     
        if ($this->seleceted_dtr_id) {
            $DTR = DTR::findOrFail($this->seleceted_dtr_id);
            $this->authorize('delete', $DTR);
            $Success = $DTR->delete();

            if ($Success) {
                $this->dispatchBrowserEvent('hideDeleteModal');
                $this->seleceted_dtr_id = null;
                $this->showToastr('Biometric Entry has been successfully Deleted.','success');
            }
            else
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');  
            }
        
        }

    }


    public function addDTR() {
        $this->authorize('create',App\Models\DTR::class);
        $this->validate([
            'selectedEmployee' => 'required',
            'schedule' => 'required',            
            'dtrdate' => 'required',  
            'time' => 'required',  
        ], [
            'selectedEmployee.required' => 'Employee Name field is required.',
            'dtrdate.required' => 'DTR Date field is required.',
            'schedule.required' => 'Time Schedule field is required.',
            'time.required' => 'Time field is required.',
        ]);   
        $check = DTR::where('emp_id',$this->selectedEmployee)->where('date',  $this->dtrdate)->where('schedule',$this->schedule)->get()->first();
        if ($check) {
            $this->showToastr('Unable to Save. Duplicate DTR.','error');
        }
        else {
            $DTR = new DTR();
            $DTR->emp_id = $this->selectedEmployee;
            $DTR->date = $this->dtrdate;
            $DTR->schedule = $this->schedule;
            $DTR->time = $this->time;
            
            if ($this->schedule == 'TimeInM' && strtotime($this->time) > strtotime("09:00:00"))
            {
              
                $late = Carbon::make($this->time)->timestamp;
                $MorningLate  = $late - 32400; 
                $this->finalLate = date("H:i",$MorningLate );
             
            }
            else {
                if ($this->schedule == 'TimeInA' && strtotime($this->time) > strtotime("13:00:00"))
                {
                    $late = Carbon::make($this->time)->timestamp;
                    $AfternoonLate  = $late - 46800; 
                    $this->finalLate = date("H:i",$AfternoonLate );
                }
                else {
                    $this->finalLate = null;
                }
            }
    
            if ($this->schedule == 'TimeOutM' && strtotime($this->time) < strtotime("12:00:00"))
            {
             
                $undertime = Carbon::make($this->time)->timestamp;
                $MorningUndertime  = 43200 - $undertime - 54000; 
                $this->FinalUndertime = date("H:i",$MorningUndertime);
           
            }
            else {
                if ($this->schedule == 'TimeOutA' && strtotime($this->time) < strtotime("16:00:00"))
                {
                    $undertime = Carbon::make($this->time)->timestamp;
                    $AfternoonUndertime  =  57600 - $undertime - 54000; 
                    $this->FinalUndertime = date("H:i",$AfternoonUndertime );
    
                }
                else {
         
                    $this->FinalUndertime = null;
                }
            }
    
            $DTR->late = $this->finalLate;
            $DTR->undertime = $this->FinalUndertime;
            $success = $DTR->save();
    
            if ($success)
            {   
                $this->selectedEmployee = null;
                $this->showToastr('DTR Added Successfully.','success');
    
            }
            else
            {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
            }
        }
       

    }

    public function addAbsent() {
        $this->authorize('create',App\Models\DTR::class);
        $this->validate([
            'selectedEmployeeA' => 'required',
            'scheduleA' => 'required',            
            'dtrdateA' => 'required',  
    
        ], [
            'selectedEmployeeA.required' => 'Employee Name field is required.',
            'dtrdateA.required' => 'DTR Date field is required.',
            'scheduleA.required' => 'Time Schedule field is required.',
        ]);   
        
        $DTR = new DTR();
        $DTR->emp_id = $this->selectedEmployeeA;
        $DTR->date = $this->dtrdateA;
        $DTR->schedule = $this->scheduleA;
        $DTR->time = null;
        $DTR->remarks = 'ABSENT';

        if ($this->scheduleA == '1stShift' || $this->scheduleA == '2ndShift') {

            $absent = Carbon::make('04:00:00')->timestamp;
            $this->finalLate = date("H:i",$absent );
        
        } else {
            if ($this->scheduleA =='WholeDay') {
                $absent = Carbon::make('08:00:00')->timestamp;
                $this->finalLate = date("H:i",$absent );
            }
            else {
                $this->finalLate = null;
            }
            
        }

        $DTR->late = $this->finalLate;
        $success = $DTR->save();

        if ($success)
        {   
            $this->selectedEmployee = null;
            $this->showToastr('DTR Added Successfully.','success');

        }
        else
        {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }


    }

    public function addEvent() {
        $this->authorize('create',App\Models\DTR::class);
        $this->validate([
            'selectedEmployeeR' => 'required',
            'scheduleR' => 'required',            
            'dtrdateR' => 'required',  
            'remarks' => 'required', 
        ], [
            'selectedEmployeeR.required' => 'Employee Name field is required.',
            'dtrdateR.required' => 'DTR Date field is required.',
            'scheduleR.required' => 'Time Schedule field is required.',
            'remarks.required' => 'Remarks field is required.',
        ]);   
        
        $DTR = new DTR();
        $DTR->emp_id = $this->selectedEmployeeR;
        $DTR->date = $this->dtrdateR;
        $DTR->schedule = $this->scheduleR;
    
        $DTR->time = null;
        $DTR->remarks = $this->remarks;

        $success = $DTR->save();

        if ($success)
        {   
            
            $this->selectedEmployee = null;
            $this->showToastr('DTR Added Successfully.','success');

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
        return view('livewire.user.dtr.index', [
            'Employees' => Employee::orderby('firstname','asc')->where('officeid',auth('web')->user()->Employee->officeid)->get(),
            'DTRs' => DTR::orderby('created_at', 'desc')->search(trim($this->Search))->paginate($this->perPage),
        ]);
    }
}
