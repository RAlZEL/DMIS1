<?php

namespace App\Http\Livewire\User\Dtr;

use App\Models\Admin\AdminPanel\Category\Office;
use Carbon\Carbon;
use App\Models\DTR;
use App\Models\Event;
use Livewire\Component;
use App\Models\Admin\EMS\Employee;

class PrintDTR extends Component
{

    public $startdate, $enddate;
    public $empStatus, $selectedEmployee;
    public $Employees;
    public $isDTR;
    public $time1, $time2, $time3, $time4,$Late, $Undetime, $lateMortning , $lateAfternoon,$UndertimeMorning, $UndertimeAfternoon, $remarks, $employeeOffice;
    public $all_dtr;
    public $employeeName;
    public $print;
    public $OfficeLists, $SelectedOffice;


    public function mount() {
        $this->startdate = $this->enddate = Carbon::now()->format('Y-m-d');
        $this->isDTR = false;
        $this->empStatus = null;
        $this->Employees = collect();
        $this->employeeName = null;
        $this->employeeOffice = null;
        $this->OfficeLists = Office::orderby('office','asc')->get();
    }

    public function updatedSelectedOffice($SelectedOffice) {
 
        
        $this->Employees = Employee::where('empstatus', $this->empStatus)->where('officeid', $SelectedOffice)->where('is_retired',false)->orderby('firstname','asc')->get();
  
    }

    public function updatedselectedEmployee($EmployeeID) {
 
        $Employee = Employee::where('id', $EmployeeID)->get()->first();
        $this->employeeName = $Employee->firstname . ' ' . $Employee->middlename . ' ' . $Employee->lastname;
        $this->employeeOffice = $Employee->officeid;
    }

    public function searchDTR() {
        $this->validate([
            'selectedEmployee' => 'required',
            'empStatus' => 'required',            
            'startdate' => 'required',  
            'enddate' => 'required', 
        ], [
            'selectedEmployee.required' => 'Employee Name field is required.',
            'empStatus.required' => 'Employee Status field is required.',
            'startdate.required' => 'Start Date field is required.',
            'enddate.required' => 'End Date field is required.',
        ]);   

       if ($this->startdate > $this->enddate) {
        $this->showToastr('Invalid date range.','error');
       }
       else 
       {
        // $this->DTRLists = null;

        $DTRLists = DTR::where('emp_id', $this->selectedEmployee)->whereBetween('date', [$this->startdate,$this->enddate])->get();
            if ($DTRLists) 
            {   
                $startDate = new Carbon($this->startdate);
                $endDate = new Carbon($this->enddate);
       
          
                $this->all_dtr = array();
                while ($startDate->lte($endDate)){


                    $Date = Carbon::createFromDate($startDate)->format('m/d/Y');
                   
                    $Event = Event::where('office',$this->employeeOffice)->where('date', $startDate)->get()->first();

                    if ($Event) {
                        $this->time1 =   $this->time2 =   $this->time3 =   $this->time4 = $Event->remarks;
                        $this->Late = $this->Undetime =  null;
                        $this->remarks = $Event->event;
         
                    }
                    elseif(Carbon::createFromDate($startDate)->format('D') == 'Sat')
                    
               
                    {
        
                    $this->time1 =   $this->time2 =   $this->time3 =   $this->time4 = 'SATURDAY';
                    $this->Late = $this->Undetime =  $this->remarks =  null;
                    }
                        elseif(Carbon::createFromDate($startDate)->format('D') == 'Sun')
                        {
                            $this->time1 =   $this->time2 =   $this->time3 =   $this->time4 = 'SUNDAY';
                            $this->Late = $this->Undetime = $this->remarks =  null;
                
                        }
                            elseif($DTRLists)
                            {
                
                                $this->time1 = null;
                                $this->time2 = null;   
                                $this->time3 = null;
                                $this->time4 = null;
                                $this->lateMortning = intval('0');
                                $this->lateAfternoon = intval('0');
                                $totalut = null;
                                $totallate = null;
                                $DTRTime = DTR::where('emp_id', $this->selectedEmployee)->where('date', $startDate)->get();
                            
                                if ($DTRTime) 
                                {   
                                    $this->Undetime = null;
                                    $this->Late  = null;

                                    foreach ($DTRTime as $Time) {

                                        if($Time->schedule == 'TRAVEL ORDER')
                                        {
                                            $this->time1 =   $this->time2 = $this->time3 = $this->time4 = 'TRAVEL ORDER';
                                            $this->remarks = $Time->remarks;
                                        }
                                        if($Time->schedule == 'LEAVE')
                                        {
                                            $this->time1 =   $this->time2 = $this->time3 = $this->time4 = 'LEAVE';
                                            $this->remarks = $Time->remarks;
                                        }
                                        if($Time->schedule == 'HOLIDAY')
                                        {
                                            $this->time1 =   $this->time2 = $this->time3 = $this->time4 = 'HOLIDAY';
                                            $this->remarks = $Time->remarks;
                                        }

                                
                                        if($Time->schedule == 'TimeInM')
                                        {
                                            $this->time1 = date('g:i A', strtotime($Time->time));
                                            $this->lateMortning = $Time->late;
                                        }
                                        if ($Time->schedule == 'TimeOutM') {
                                        
                                            $this->time2 = date('g:i A', strtotime($Time->time));
                                            $this->UndertimeMorning = $Time->undertime;
                                            
                                        }
                                        if ($Time->schedule == 'TimeInA') {
                
                                            $this->lateAfternoon = $Time->late;
                                       
                                            $this->time3 = date('g:i A', strtotime($Time->time));
                                        
                                        }
                                        if ($Time->schedule == 'TimeOutA') {
                                      
                                            $this->time4 = date('g:i A', strtotime($Time->time));
                                            $this->UndertimeAfternoon = $Time->undertime;
                                        }
                                        

                                        if ($Time->remarks == 'ABSENT')
                                            {
                                            
                                                if ($Time->schedule == '1stShift') {
                                                    $this->time1 =   $this->time2 = 'ABSENT';
                                                    $totallate = Carbon::make($Time->late)->timestamp;
                                                    $totallate = date("H:i", $totallate);
                                                }
                    
                                                if ($Time->schedule == '2ndShift') {
                                                    $this->time3 =   $this->time4 = 'ABSENT';
                                                    $totallate = Carbon::make($Time->late)->timestamp;
                                                    $totallate = date("H:i", $totallate);
                                                }

                                                if ($Time->schedule == 'WholeDay') {
                                                    $this->time1 =   $this->time2 =   $this->time3 =   $this->time4 = 'ABSENT';
                                                    $totallate = Carbon::make($Time->late)->timestamp;
                                                    $totallate = date("H:i", $totallate);
                                                }
                        
                                            }
                                  

                                        if ($Time->remarks != 'ABSENT' && $Time->schedule == 'WholeDay') {
                                            $this->time1 =   $this->time2 =   $this->time3 =   $this->time4 = 'EVENT';
                                            $this->remarks = $Time->remarks;
                                        }
                                        if ($Time->remarks != 'ABSENT' && $Time->schedule == '2ndShift') {
                                             $this->time3 =   $this->time4 = 'EVENT';
                                             $this->remarks = $Time->remarks;
                                        }
                                        if ($Time->remarks != 'ABSENT' && $Time->schedule == '1stShift') {
                                            $this->time1 =   $this->time2 = 'EVENT';
                                            $this->remarks = $Time->remarks;
                                        }
                                                        
                                    }
                                
                                        if (!empty($this->lateMortning) && (!empty($this->lateAfternoon)))
                                        {
                                        $totallate = Carbon::make($this->lateMortning)->timestamp + Carbon::make($this->lateAfternoon)->timestamp - 57600;
                                        $totallate = date("H:i", $totallate);
                                        }

                                        if(!empty($this->lateMortning) && empty($this->lateAfternoon)) {
                                            $totallate = Carbon::make($this->lateMortning)->timestamp;
                                        $totallate = date("H:i", $totallate);
                                        }
                                        if(empty($this->lateMortning) && !empty($this->lateAfternoon)) {
                                            $totallate = Carbon::make($this->lateAfternoon)->timestamp;
                                        $totallate = date("H:i", $totallate);
                                        }

                                        if (!empty($this->UndertimeMorning) && (!empty($this->UndertimeAfternoon)))
                                        {
                                        $totalut = Carbon::make($this->UndertimeMorning)->timestamp + Carbon::make($this->UndertimeAfternoon)->timestamp - 57600;
                                        $totalut = date("H:i", $totalut);
                                        }
                                        if(empty($this->UndertimeMorning) && !empty($this->UndertimeAfternoon)) {
                                            $totalut = Carbon::make($this->UndertimeAfternoon)->timestamp;
                                        $totalut = date("H:i", $totalut);
                                        }

                                        if(!empty($this->UndertimeMorning) && empty($this->UndertimeAfternoon)) {
                                            $totalut = Carbon::make($this->UndertimeMorning)->timestamp;
                                        $totalut = date("H:i", $totalut);
                                        }


                                    $this->Undetime = $totalut;
                                    $this->Late = $totallate;
                                 
                                  
                                    $this->lateMortning = intval('0');
                                    $this->lateAfternoon = intval('0');
                                    $this->UndertimeMorning = intval('0');
                                    $this->UndertimeAfternoon = intval('0');
                                    $totalut = null;
                                    $totallate = null;
                                 
                                 
                                
                                }
                                
                            }
                    $this->all_dtr[] = array($Date,$this->time1, $this->time2, $this->time3, $this->time4, $this->Late,$this->Undetime, $this->remarks);
               
                    $this->remarks = null;
                    $startDate->addDay(); 
                }
            }
       
        }
       
    }
    public function markAllPrint() {
       $this->print = array();
       $this->print = array($this->selectedEmployee,$this->startdate,$this->enddate);
       return redirect()->route('user.UserPrintDTR',json_encode($this->print),'_blank');
    }

    public function showToastr($message, $type) {
        return $this->dispatchBrowserEvent('showToastr',[
            'type'=>$type,
            'message'=>$message
        ]);
    }

    public function render()
    {
        return view('livewire.user.dtr.print-d-t-r');
    }
}
