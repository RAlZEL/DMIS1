<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserRole;
use App\Models\Task\Task;
use App\Models\Admin\EMS\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
     
        if(auth('web')->check())
        {
         return ($user); 
        }

    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task\Task  $task
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Task $task)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

        if($Role)
        {
            return ($user);     

        }

        $Role = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',40)->where('can_add', true)->get()->first();

        if(!empty($Role))
        {
            return ($user); 

        }  
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task\Task  $task
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Task $task)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task\Task  $task
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Task $task)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task\Task  $task
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Task $task)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task\Task  $task
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Task $task)
    {
        //
    }

    public function acceptTask(User $user, Task $Task) {



        $Employee = Employee::where('email', auth('web')->user()->email)->get()->first();
      
        $Check = Task::where('employee_id', $Employee->id)->where('is_assigned', true)->where('id', $Task->id)->get()->first();

        if(!empty($Check))
        {
      
            return ($user); 
        }  
    }

    public function rejectTask(User $user, Task $Task) {


        $Employee = Employee::where('email', auth('web')->user()->email)->get()->first();
      
        $Check = Task::where('employee_id', $Employee->id)->where('is_assigned', true)->where('id', $Task->id)->get()->first();

        if(!empty($Check))
        {
      
            return ($user); 
        }  
    }

    public function updateTask(User $user, Task $Task) {


        $Employee = Employee::where('email', auth('web')->user()->email)->get()->first();
      
        $Check = Task::where('employee_id', $Employee->id)->where('is_accepted', true)->where('id', $Task->id)->get()->first();

        if(!empty($Check))
        {
      
            return ($user); 
        }  
    }

    public function multipleTask(User $user) {


        $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

        if($Role)
        {
            return ($user); 

        }
        $Role = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',40)->where('can_add', true)->get()->first();

        if(!empty($Role))
        {
            return ($user); 

        }  

    }

    public function addComment(User $user, Task $Task) {
      
        $Employee = Employee::where('email', auth('web')->user()->email)->get()->first();
        $Check = Task::where('employee_id', $Employee->id)->where('id', $Task->id)->get()->first();
        if(!empty($Check))
        {
            return ($user); 
        }  
        
          $Check = Task::where('user_id', auth('web')->user()->id)->where('id', $Task->id)->get()->first();
        if(!empty($Check))
        {
            return ($user); 
        }  
        


    }
}
