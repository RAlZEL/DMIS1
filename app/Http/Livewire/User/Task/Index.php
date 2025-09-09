<?php

namespace App\Http\Livewire\User\Task;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\Task\Task;
use Livewire\WithPagination;
use App\Models\Admin\EMS\Employee;
use App\Models\Task\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{

    use AuthorizesRequests;
    use WithPagination;

    public $perPage;
    public $Search;
    public $Comments;
    public $CommentLists;
    public $NewComment;

    public $EmployeeLists, $TaskEnd , $TaskStart, $UserAssignedTask ,$Task, $TaskRemarks;
    public $selected_task ;
    public $myTasksCount, $AssignedTasksCount , $AcceptedTasksCount, $RejectedTasksCount, $CompletedTasksCount;
    public $selected_task_id;
    

    protected $listeners = [

        'updateCountCreate',
        'updateCommentLists',
    ];

  
    public function updateCommentLists() {
        
        $this->Comments = Comment::where('task_id', $this->selected_task_id->id)->get();
} 

    public function updateCountCreate() {

        $Employee = Employee::where('email', auth('web')->user()->email)->get()->first();
        $this->myTasksCount = Task::where('employee_id', $Employee->id)->where('is_assigned', true)->count();
        $this->AssignedTasksCount = Task::where('user_id', auth('web')->user()->id)->count();
        $this->AcceptedTasksCount =Task::where( 'employee_id', $Employee->id)->where('is_accepted', true)->count();
        $this->RejectedTasksCount = Task::where('employee_id', $Employee->id)->where('is_rejected', true)->count();
        $this->CompletedTasksCount = Task::where('employee_id', $Employee->id)->where('is_completed', true)->count();

    }

    

    public function mount() {
        $this->resetPage();
        $this->Comments = [];
        $this->perPage = 10;
        $this->NewComment = null;
        $this->selected_task_id = null;
        $this->EmployeeLists = null;
   
        $CheckUsers = User::where('is_enable', true)->where('is_verified', true)->where('id', '!=' , '1')->get();
    
        foreach ($CheckUsers as $User) {
            $Employee = Employee::where('email', $User->email)->get()->first();
       
            $this->EmployeeLists[] = array($Employee->id, $Employee->lastname . ', ' . $Employee->firstname);
        }
        $this->EmployeeLists = collect( $this->EmployeeLists)->sortBy([1])->reverse()->toArray();
        $this->TaskEnd = Carbon::now()->format('Y-m-d');
        $this->TaskStart = Carbon::now()->format('Y-m-d');
        $this->selected_task = null;
        $Employee = Employee::where('email', auth('web')->user()->email)->get()->first();
       $this->updateCountCreate();
    
    }



    public function addTask() {
     
        $this->authorize('create', App\Models\Task\Task::class);
        {
            $this->validate([
                
                'TaskStart' => 'required',
                'TaskEnd' => 'required',
                'UserAssignedTask' => 'required',
                'TaskRemarks' => 'required',
                'Task' => 'required',
                
            ],
            [
                'TaskRemarks.required' => "Remarks field is required",
                'UserAssignedTask.required' => 'Employee field is required',
                'TaskStart.required' => 'Start Date field is required',
                'TaskEnd.required' => 'Due Date field is required',
                'Task.required' => 'Task field is required',
                          
            ]);

                $Task = new Task();
                $Task->start_date = $this->TaskStart;
                $Task->due_date = $this->TaskEnd;
                $Task->employee_id = $this->UserAssignedTask;
                $Task->task = $this->Task;
                $Task->remarks = $this->TaskRemarks;
                $Task->user_id = auth('web')->user()->id;
                $Success = $Task->save();

                if ($Success) {
                   
                        $this->dispatchBrowserEvent('hideTaskModal');
                        $this->dispatchBrowserEvent('updateCreateCount');
                        $this->showToastr('Task Added Successfully.','success');
                    
                }
                else {
                    $this->showToastr('Something went wrong. Please contact System Administrator','error');   
                   
                }
        }
        // $this->dispatchBrowserEvent('updateCreateCount');
    }

    public function AcceptTaskShow($id) {

        $task = Task::findOrFail($id);
        if ($task) {
            $this->authorize('acceptTask', $task);
            $this->selected_task = $task->id;
            $this->dispatchBrowserEvent('showAcceptTask');
        } 
    }

    public function updateTaskShow($id) {

        $task = Task::findOrFail($id);
        if ($task) {
            $this->authorize('updateTask', $task);
            $this->selected_task = $task->id;
            $this->dispatchBrowserEvent('showUpdateTask');
        } 
    }

    public function completeTask() {
        $Task = Task::findOrFail($this->selected_task);
        $this->authorize('updateTask', $Task);
        
        $Task->is_accepted = false;
        $Task->is_completed = true;
        $Success = $Task->save();
        if ($Success) {
                   
            $this->dispatchBrowserEvent('hideUpdateModal');
            $this->dispatchBrowserEvent('updateTaskCount');
            $this->dispatchBrowserEvent('updateCreateCount');
            $this->showToastr('Task Completed Successfully.','success');
        
    }
    else {
        $this->showToastr('Something went wrong. Please contact System Administrator','error');   
       
    }
    $this->dispatchBrowserEvent('updateTaskCount');
}


    public function RejectTaskShow($id) {

        $task = Task::findOrFail($id);
        if ($task) {
            $this->authorize('rejectTask', $task);
            $this->selected_task = $task->id;
            $this->dispatchBrowserEvent('showRejectTask');
        } 
    }


    public function rejectTask() {
        $Task = Task::findOrFail($this->selected_task);
        $this->authorize('rejectTask', $Task);
        
        $Task->is_assigned = false;
        $Task->is_rejected = true;
        $Success = $Task->save();
        if ($Success) {
                   
            $this->dispatchBrowserEvent('hideRejectModal');
            $this->dispatchBrowserEvent('updateTaskCount');
            $this->dispatchBrowserEvent('updateCreateCount');
            $this->showToastr('Task Rejected Successfully.','success');
        
    }
    else {
        $this->showToastr('Something went wrong. Please contact System Administrator','error');   
       
    }
    $this->dispatchBrowserEvent('updateTaskCount');
}

    public function acceptTask() {
        $Task = Task::findOrFail($this->selected_task);
        $this->authorize('acceptTask', $Task);
        
        $Task->is_assigned = false;
        $Task->is_accepted = true;
        $Success = $Task->save();
        if ($Success) {
                   
            $this->dispatchBrowserEvent('hideAcceptModal');
            $this->dispatchBrowserEvent('updateTaskCount');
            $this->dispatchBrowserEvent('updateCreateCount');
            $this->showToastr('Task Accepted Successfully.','success');
        
    }
    else {
        $this->showToastr('Something went wrong. Please contact System Administrator','error');   
       
    }
    $this->dispatchBrowserEvent('updateTaskCount');
    }


    public function showComment($id) {
        $this->resetErrorBag();
        $this->selected_task_id = Task::findOrFail($id);
        if ($this->selected_task_id) {
            $this->Comments = Comment::where('task_id', $this->selected_task_id->id)->orderby('created_at','asc')->get();
            $this->dispatchBrowserEvent('showAddComment');
        }
      
    }

    public function addComment() {
        if($this->NewComment != null || is_null($this->NewComment))  {

            $Comment = new Comment();
            $Comment->task_id = $this->selected_task_id->id;
            $Comment->comment = $this->NewComment;
            $Comment->user_id = auth('web')->user()->id;
            $Success = $Comment->save();
            if ($Success) {
                $this->NewComment = null;
                $this->dispatchBrowserEvent('updateComment');
            }
            else {
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
        
        $Employee = Employee::where('email', auth('web')->user()->email)->get()->first();
        $this->authorize('viewany', App\Models\DocumentTracking\Document::class);
        return view('livewire.user.task.index', [
            'MyTasks' => Task::where('employee_id', $Employee->id)->orderby('created_at','desc')->where('is_assigned', true)->search(trim($this->Search))->paginate($this->perPage),
 
            'AssignedTasks'=> Task::where('user_id', auth('web')->user()->id)->orderby('created_at','desc')->search(trim($this->Search))->paginate($this->perPage),

            'AcceptedTasks' => Task::where('employee_id', $Employee->id)->orderby('created_at','desc')->where('is_accepted', true)->search(trim($this->Search))->paginate($this->perPage),
  
            'RejectedTasks' => Task::where('employee_id', $Employee->id)->orderby('created_at','desc')->where('is_rejected', true)->search(trim($this->Search))->paginate($this->perPage),
          
            'CompletedTasks' => Task::where('employee_id', $Employee->id)->orderby('created_at','desc')->where('is_completed', true)->search(trim($this->Search))->paginate($this->perPage),
          
        ]);
    }
}



