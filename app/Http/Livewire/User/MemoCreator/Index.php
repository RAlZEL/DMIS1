<?php

namespace App\Http\Livewire\User\MemoCreator;

use App\Models\Memorandum\Memorandum;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    // public $subject, $date, $from_emp, $from_pos;


    // protected $listeners = [
    //     'ResetModalForm',
 
  
    // ];

    // public function mount() {
    //     $this->date = Carbon::now()->format('Y-m-d');
    // }

    // public function ResetModalForm() {
    //     $this->date = Carbon::now()->format('Y-m-d');
    //     $this->subject = null;
    //     $this->from_emp = null;
    //     $this->from_pos = null;
    // }

    // public function createMemorandum() {
    //     // $this->authorize('create', App\Models\Announcement::class);
           
    //     $this->validate([
    //         'date' => 'required',
    //         'subject' => 'required',
    //         'from_emp' => 'required',
    //         'from_pos' => 'required',
          
    //     ], [
    //         'from_emp.required' => 'Employee Name field is required.',
    //         'from_pos.required' => 'Employee Position field is required.'
    //     ]);


   
    //         $Memorandum = new Memorandum();
    //         $Memorandum->date = $this->date;
    //         $Memorandum->subject = $this->subject;
    //         $Memorandum->from_emp = $this->from_emp;
    //         $Memorandum->from_pos = $this->from_pos;
    //         $Memorandum->user_id = auth('web')->user()->id;

    //         $success = $Memorandum->save();
    
    //         if ($success)
    //         {   
    //             $this->dispatchBrowserEvent('hideAddModal');
    //             $this->dispatchBrowserEvent('ResetModalForm');
    //             $this->showToastr('Memorandum Added Successfully.','success');
    
    //         }
    //         else
    //         {
    //             $this->showToastr('Something went wrong. Please contact System Administrator','error');
    //         }
      
    // }

    // public function showToastr($message, $type) {
    //     return $this->dispatchBrowserEvent('showToastr',[
    //         'type'=>$type,
    //         'message'=>$message
    //     ]);
    // }
    


    public function render()
    {
        return view('livewire.user.memo-creator.index',[
            'Memorandums' => Memorandum::orderby('created_at', 'desc')->get(),
        ]);
    }
}
