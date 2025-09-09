<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserRole;
use App\Models\Task\Task;
use App\Models\Admin\EMS\Employee;
use App\Models\DocumentTracking\Route;
use App\Models\DocumentTracking\Document;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentPolicy
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
       
        $Roles = UserRole::where('userid','=',auth('web')->user()->id)->get();

        foreach ($Roles as $Role)
        {
            if($Role->roleid == 24 && $Role->can_view == true)
            {
                return ($user); 
    
            }
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Document $document)
    {
        $Roles = UserRole::where('userid','=',auth('web')->user()->id)->get();

        foreach ($Roles as $Role)
        {
            if($Role->roleid == 24 && $Role->can_view == true)
            {
                return ($user); 
    
            }
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {

        $Roles = UserRole::where('userid','=',auth('web')->user()->id)->get();

        foreach ($Roles as $Role)
        {
            if($Role->roleid == 24 && $Role->can_add == true)
            {
                return ($user); 
    
            }
        }

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Document $document)
    {
        $Roles = UserRole::where('userid','=',auth('web')->user()->id)->get();

        foreach ($Roles as $Role)
        {
            if($Role->roleid == 24 && $Role->can_edit == true)
            {
                return ($user); 
    
            }
        }

        $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

        if($Role)
        {
            return ($user); 

        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Document $document)
    {
        $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

        if($Role)
        {
            return ($user); 

        }

        $Role = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',24)->where('can_delete', true)->get()->first();
                    if(!empty($Role))
                    {
                        return ($user); 

                    }  


    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Document $document)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Document $document)
    {
        //
    }


    // public function route(User $user, Document $document)
    // {
    //     $Roles = UserRole::where('userid','=',auth('web')->user()->id)->get();

    //     foreach ($Roles as $Role)
    //     {
    //         if($Role->roleid == 24 && $Role->can_route == true)
    //         {
    //             return ($user); 
    
    //         }
    //     }
    // }

    public function deleteAttachment(User $user, Document $document)
    {
        $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

        if($Role)
        {
            return ($user); 

        }

        $Role = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',24)->where('can_delete', true)->get()->first();
                    if(!empty($Role))
                    {
                        return ($user); 

                    }  


    }

    public function addAttachment(User $user, Document $document)

    {        
        $employee = Employee::where('email','=',auth('web')->user()->email)->get()->first(); 

                if ($document->is_forwarded == false && $document->is_accepted == false &&  $document->is_rejected == false && $document->is_active == true  && $document->is_created == true  && $document->is_created == true) 
                {
                    $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',24)->where('can_process', true)->where('can_add', true)->get();

                    if(!empty($Roles))
                        {
                            foreach ($Roles as $Role)
                            {
                                if (  $Role->roleid == '24' && $Role->can_process == true)
                                {
                                    return ($user);
                                }
                            }
                        }

                }

                if ($document->is_forwarded == false && $document->is_accepted == true &&  $document->is_rejected == false && $document->is_active == true && $document->officeid == $employee->officeid && $document->divisionid == $employee->divisionid && $document->unitid == $employee->unitid)  
                {
                  
                    $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',24)->where('can_process', true)->get();

                    if(!empty($Roles))
                        {
                            foreach ($Roles as $Role)
                            {
                                if (  $Role->roleid == 24 && $Role->can_process == true)
                                {
                                    return ($user);
                                }
                            }
                        }

                }
    }


    public function addTask(User $user, Document $document) {

        $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

        if($Role)
        {
            return ($user); 

        }

        // $Employee = Employee::where('email', auth('web')->user()->email)->get()->first();
        // $Check = Task::where('employee_id', $Employee->id)->orwhere('user_id', auth('web')->user()->id)->where('id', $document->id)->get()->first();
        // if(!empty($Check))
        // {
        //     return ($user); 
        // }  



        $employee = Employee::where('email','=',auth('web')->user()->email)->get()->first(); 

        if ($document->is_forwarded == false && $document->is_accepted == false &&  $document->is_rejected == false && $document->is_active == true && $document->is_created == true && $employee->unitid == $document->unitid) 
        {
            $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',40)->where('can_add', true)->get()->first();

            if(!empty($Roles))
                {
                   
                    return ($user);
                  
                }

        }

        if ($document->is_forwarded == false && $document->is_accepted == true &&  $document->is_rejected == false && $document->is_active == true && $document->is_created == false && $employee->unitid == $document->unitid) 
        {
            $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',40)->where('can_add', true)->get()->first();

            if(!empty($Roles))
                {
                   
                    return ($user);
                  
                }

        }

        // if ($document->is_forwarded == false && $document->is_accepted == true &&  $document->is_rejected == false && $document->is_active == true & $document->officeid == $employee->officeid && $document->divisionid == $employee->divisionid && $document->unitid == $employee->unitid) 
        // {
          
        //     $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',24)->where('can_route', true)->get();

        //     if(!empty($Roles))
        //         {
        //             foreach ($Roles as $Role)
        //             {
        //                 if (  $Role->roleid == 24 && $Role->can_route == true)
        //                 {
        //                     return ($user);
        //                 }
        //             }
        //         }

        // }

        // if ($document->is_forwarded == true && $document->is_accepted == false &&  $document->is_rejected == false && $document->is_active == true & $document->from_officeid == $employee->officeid && $document->from_divisionid == $employee->divisionid && $document->from_unitid == $employee->unitid) 
        // {
          
        //     $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',24)->where('can_route', true)->get();

        //     if(!empty($Roles))
        //         {
        //             foreach ($Roles as $Role)
        //             {
        //                 if (  $Role->roleid == 24 && $Role->can_route == true)
        //                 {
        //                     return ($user);
        //                 }
        //             }
        //         }

        // }

        // if ($document->is_forwarded == false && $document->is_accepted == false &&  $document->is_rejected == true && $document->is_active == true & $document->officeid == $employee->officeid && $document->divisionid == $employee->divisionid && $document->unitid == $employee->unitid) 
        // {
          
        //     $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',24)->where('can_route', true)->get();

        //     if(!empty($Roles))
        //         {
        //             foreach ($Roles as $Role)
        //             {
        //                 if (  $Role->roleid == 24 && $Role->can_route == true)
        //                 {
        //                     return ($user);
        //                 }
        //             }
        //         }

        // }

    }

    public function addMultipleRooute(User $user) {
        $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

        if($Role)
        {
            return ($user); 

        }
    }

    public function addMultipleAccept(User $user) {
        $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

        if($Role)
        {
            return ($user); 

        }

        $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',24)->where('can_accept', true)->get();

            if(!empty($Roles))
                {
                    foreach ($Roles as $Role)
                    {
                        if (  $Role->roleid == 24 && $Role->can_accept == true)
                        {
                            return ($user);
                        }
                    }
                }


    }

    public function addMultipleClose(User $user) {
        $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

        if($Role)
        {
            return ($user); 

        }

        $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',24)->where('can_process', true)->get();

            if(!empty($Roles))
                {
                    foreach ($Roles as $Role)
                    {
                        if (  $Role->roleid == 24 && $Role->can_process == true)
                        {
                            return ($user);
                        }
                    }
                }


    }

    public function addMultipleRoute(User $user) {
        $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

        if($Role)
        {
            return ($user); 

        }

        $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',24)->where('can_route', true)->get();

            if(!empty($Roles))
                {
                    foreach ($Roles as $Role)
                    {
                        if (  $Role->roleid == 24 && $Role->can_route == true)
                        {
                            return ($user);
                        }
                    }
                }


    }






    
    public function addRoute(User $user, Document $document)

    {

        $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

        if($Role)
        {
            return ($user); 

        }


        $employee = Employee::where('email','=',auth('web')->user()->email)->get()->first(); 

        if ($document->is_forwarded == false && $document->is_accepted == false &&  $document->is_rejected == false && $document->is_active == true && $document->is_created == true) 
        {
            $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',24)->where('can_route', true)->where('can_add', true)->get();

            if(!empty($Roles))
                {
                    foreach ($Roles as $Role)
                    {
                        if (  $Role->roleid == '24' && $Role->can_route == true)
                        {
                            return ($user);
                        }
                    }
                }

        }

        if ($document->is_forwarded == false && $document->is_accepted == true &&  $document->is_rejected == false && $document->is_active == true & $document->officeid == $employee->officeid && $document->divisionid == $employee->divisionid && $document->unitid == $employee->unitid) 
        {
          
            $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',24)->where('can_route', true)->get();

            if(!empty($Roles))
                {
                    foreach ($Roles as $Role)
                    {
                        if (  $Role->roleid == 24 && $Role->can_route == true)
                        {
                            return ($user);
                        }
                    }
                }

        }

        if ($document->is_forwarded == true && $document->is_accepted == false &&  $document->is_rejected == false && $document->is_active == true & $document->from_officeid == $employee->officeid && $document->from_divisionid == $employee->divisionid && $document->from_unitid == $employee->unitid) 
        {
          
            $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',24)->where('can_route', true)->get();

            if(!empty($Roles))
                {
                    foreach ($Roles as $Role)
                    {
                        if (  $Role->roleid == 24 && $Role->can_route == true)
                        {
                            return ($user);
                        }
                    }
                }

        }

        if ($document->is_forwarded == false && $document->is_accepted == false &&  $document->is_rejected == true && $document->is_active == true & $document->officeid == $employee->officeid && $document->divisionid == $employee->divisionid && $document->unitid == $employee->unitid) 
        {
          
            $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',24)->where('can_route', true)->get();

            if(!empty($Roles))
                {
                    foreach ($Roles as $Role)
                    {
                        if (  $Role->roleid == 24 && $Role->can_route == true)
                        {
                            return ($user);
                        }
                    }
                }

        }

    }
    
    public function AcceptIncoming(User $user, Document $document) {
        $employee = Employee::where('email','=',auth('web')->user()->email)->get()->first(); 
        if ($document->is_forwarded == true && $document->is_accepted == false &&  $document->is_rejected == false && $document->is_active == true & $document->officeid == $employee->officeid && $document->divisionid == $employee->divisionid && $document->unitid == $employee->unitid) 
        {
          
            $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',24)->where('can_accept', true)->get();

            if(!empty($Roles))
                {
                    foreach ($Roles as $Role)
                    {
                        if (  $Role->roleid == 24 && $Role->can_accept == true)
                        {
                            return ($user);
                        }
                    }
                }

        }
    }

    public function markasclosed(User $user, Document $document) {
        $employee = Employee::where('email','=',auth('web')->user()->email)->get()->first(); 
        if ($document->is_forwarded == false && $document->is_accepted == true &&  $document->is_rejected == false && $document->is_active == true & $document->officeid == $employee->officeid && $document->divisionid == $employee->divisionid && $document->unitid == $employee->unitid) 
        {
          
            $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',24)->where('can_process', true)->get();

            if(!empty($Roles))
                {
                    foreach ($Roles as $Role)
                    {
                        if (  $Role->roleid == 24 && $Role->can_process == true)
                        {
                            return ($user);
                        }
                    }
                }

        }
    }

    public function adminView(User $user)
    {
        $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

        if($Role)
        {
            return ($user); 
        }
    }
    
    public function viewDocumentOffice(User $user, Document $document) {

        $Routes = Route::where('from_office', $document->origin)->orwhere('officeid', $document->origin)->get();
        if($Routes) {
            if($user->Employee->officeid == $document->origin) {
                return ($user);
            }
    
        }

        if($user->Employee->officeid == 1) {
            return ($user);
        }

    }
}
