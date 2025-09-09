<?php

namespace App\Http\Livewire\User\Dtr\Upload;

use Carbon\Carbon;
use App\Models\DTR;
use App\Models\EmpBio;
use Livewire\Component;
use App\Models\DeviceBio;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use WithFileUploads;
    use WithPagination;
    use AuthorizesRequests;
    
    public $addDTR;
    public $selectedDevice, $DTRs;
    public $perPage;

    public function mount() {
        $this->DTRs = collect();
        $this->perPage = 10;
    }

    public function uploadDTR() {
        $this->authorize('create',App\Models\DTR::class);

        $this->validate([
           
            'addDTR' => ['file', 'mimes:txt,dat', 'max:12288'] ,
            'selectedDevice' => 'required'
        ], [
            'addDTR.mimes' => 'File must be a file of type: txt, dat. ',
            'addDTR.file' => 'File must be a file of type: txt, dat. ',
            'addDTR.max' => 'File is too large. ',
            'selectedDevice.required' => 'Device Name field is required. ',
        ]);

    
        if ($this->addDTR) {
                $this->DTRs = array();
                $fileName = $this->addDTR->getRealPath();
                $UploadedDTR = array();
                $FinalDTR = array();
                $totallate = null;
                $totalut = null;
                $fp = fopen($fileName, "r");
                if (!$fp) {
                    die("Cannot load file");
                    $this->showToastr('Something went wrong. Please contact System Administrator','error');
                }
           
                while (($line = fgets($fp, 4096)) !== false) {
            
                        list($word, $measure) = explode("\t", trim($line));
                        $UploadedDTR[] = [$word,$measure];
              
                 
                }
          
                foreach ($UploadedDTR as $DTR)
                {
          
                  $Log1 =  Carbon::createFromDate($DTR[1])->format('Y-m-d');
                  $Log2 = Carbon::createFromDate($DTR[1])->format('H:i');
          
                  $MorningInstart = Carbon::createFromTimeString('06:00')->format('H:i');
                  $MorningInend = Carbon::createFromTimeString('10:30')->format('H:i');
                  $MorningOutstart = Carbon::createFromTimeString('10:31')->format('H:i');
                  $MorningOutend = Carbon::createFromTimeString('12:09')->format('H:i');
                  $AfternoonInstart = Carbon::createFromTimeString('12:10')->format('H:i');
                  $AfternoonInend = Carbon::createFromTimeString('15:00')->format('H:i');
                  $AfternoonOutstart = Carbon::createFromTimeString('15:01')->format('H:i');
                  $AfternoonOutend = Carbon::createFromTimeString('22:00')->format('H:i');
          
                  if ($Log2 >= $MorningInstart && $Log2 <= $MorningInend) {
                    $Employee = EmpBio::where('device_id', $this->selectedDevice)->where('bio_id', $DTR[0])->get()->first();   
                    if ($Employee) 
                    {
                        $Start = "09:00";
                        $FinalLate = null;
                        $Undertime = null;
                        if ($Log2 > $Start)
                                    {
                                          $totalDuration =(Carbon::make($Log2)->timestamp - Carbon::make($Start)->timestamp) -27000;
                                          $FinalLate = date("H:i",$totalDuration);
                                      
                                    }
                  
                                    $FinalDTR[] = [$Employee->Employee->id ,$Employee->Employee->firstname , $Employee->Employee->middlename, $Employee->Employee->lastname, $Log1,'TimeInM', $Log2, $FinalLate,   $Undertime];
                                    $FinalLate = null;
                    }
                 
                  }
                  
                  
                  if ($Log2 >= $MorningOutstart && $Log2 <= $MorningOutend) {

                     $Employee = EmpBio::where('device_id', $this->selectedDevice)->where('bio_id', $DTR[0])->get()->first();   
                    if ($Employee) 
                    {
                        $Start = "12:00";
                  
                        if ($Log2 > $Start)
                                    {
                                        $FinalLate = null; 
                                        $Undertime = null; 
                                          $FinalDTR[] = [$Employee->Employee->id ,$Employee->Employee->firstname , $Employee->Employee->middlename, $Employee->Employee->lastname, $Log1,'TimeOutM', $Log2,  $FinalLate,   $Undertime];
                              
                                    }
                            else {
                                $totalDuration = 27000 -(Carbon::make($Log2)->timestamp - Carbon::make($Start)->timestamp) - 54000;
                                $Undertime = date("H:i",$totalDuration);
                                if ($Undertime == '00:00')
                                {
                                    $Undertime = null;
                                }
                                $FinalDTR[] = [$Employee->Employee->id ,$Employee->Employee->firstname , $Employee->Employee->middlename, $Employee->Employee->lastname, $Log1,'TimeOutM', $Log2, $FinalLate,   $Undertime];
                                $Undertime = null; 
                            }
        
                    }
                  }
               
                  if ($Log2 >= $AfternoonInstart && $Log2 <= $AfternoonInend) {

                    $Employee = EmpBio::where('device_id', $this->selectedDevice)->where('bio_id', $DTR[0])->get()->first();   
                    if ($Employee) 
                    {
                        $Start = "12:10";
                  
                        if ($Log2 > $Start)
                                    {   
                                        //   $LateTime = "13:00";
                                        //   $totalDuration =(Carbon::make($Log2)->timestamp - Carbon::make($LateTime)->timestamp) -27000;
                                        //   $FinalLate = date("H:i",$totalDuration);
                                        $LateTime = "13:00";
                                        if ($Log2 > $LateTime)
                                        {
                                            $totalDuration =(Carbon::make($Log2)->timestamp - Carbon::make($LateTime)->timestamp) -27000;
                                            $FinalLate = date("H:i",$totalDuration);
                                    
                                        }
                                        else {
                                            $FinalLate = null;
                                        }
                                  
                                          $FinalDTR[] = [$Employee->Employee->id ,$Employee->Employee->firstname , $Employee->Employee->middlename, $Employee->Employee->lastname, $Log1,'TimeInA', $Log2, $FinalLate,   $Undertime];     
                                    }
                       
                        $FinalLate = null;
        
                    }
           
                  }
          
                  if ($Log2 >= $AfternoonOutstart && $Log2 <= $AfternoonOutend) {
                  
                    $Employee = EmpBio::where('device_id', $this->selectedDevice)->where('bio_id', $DTR[0])->get()->first();   
                    if ($Employee) 
                    {
                        $Start = "16:00";
                        $FinalLate = null;
                        if ($Log2 > $Start)
                                    {
                                        $FinalLate = null;
                                         $Undertime = null; 
                                          $FinalDTR[] = [$Employee->Employee->id ,$Employee->Employee->firstname , $Employee->Employee->middlename, $Employee->Employee->lastname, $Log1,'TimeOutA', $Log2,$FinalLate, $Undertime];
                              
                                    }
                            else {
                                $totalDuration = 27000 -(Carbon::make($Log2)->timestamp - Carbon::make($Start)->timestamp) - 54000;
                                $Undertime = date("H:i",$totalDuration);
                                if ($Undertime == '00:00')
                                {
                                    $Undertime = null;
                                }
                                $FinalDTR[] = [$Employee->Employee->id ,$Employee->Employee->firstname , $Employee->Employee->middlename, $Employee->Employee->lastname, $Log1,'TimeOutA', $Log2,$FinalLate, $Undertime];
                                $Undertime = null; 
                            }
        
                    }
                  }
               
                }
           
              $this->DTRs = $FinalDTR;
              $this->dispatchBrowserEvent('hideUploadModal');
        }
        else {
            $this->showToastr('Something went wrong. Please contact System Administrator','error');
        }
        
    }

    public function addDTR() {
        $this->authorize('create',App\Models\DTR::class);
        $Count = count($this->DTRs);
        foreach($this->DTRs as $KEY => $DTR) {

            
            $check = DTR::where('emp_id', $DTR[0])->where('date', $DTR[4])->where('schedule', $DTR[5])->get()->first();
            if ($check) {
                unset($this->DTRs[$KEY]);
            }
            else {
                $toUpload = new DTR();
                $toUpload->emp_id = $DTR[0];
                $toUpload->date = $DTR[4];
                $toUpload->schedule = $DTR[5];
                $toUpload->time = $DTR[6];
                $toUpload->late = $DTR[7];
                $toUpload->undertime = $DTR[8];
                $toUpload->encoded_from = true;
    
                $success = $toUpload->save();
                if ($success) 
                {
                    unset($this->DTRs[$KEY]);
                }
              
            }
    
            if ($Count == $this->DTRs) {
                $this->showToastr('Something went wrong. Please contact System Administrator','error');
                $this->dispatchBrowserEvent('hideSaveModal');
            }
            else {
                $this->showToastr( ($Count - count($this->DTRs)) . ' of ' . $Count . ' Saved Successfully.','success');
                $this->dispatchBrowserEvent('hideSaveModal');
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
        
        return view('livewire.user.dtr.upload.index', [
            'DTRDevices' => DeviceBio::orderby('device', 'asc')->get(),
            'DTRs' => $this->DTRs,
        ]);
    }
}
