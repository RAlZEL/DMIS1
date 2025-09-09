<?php

namespace App\Policies;

use App\Models\DTR;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Admin\EMS\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;

class DTRPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DTR  $dTR
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, DTR $dTR)
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
       
        $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',38)->where('can_add', true)->get();
    
            if(!empty($Roles))
                {
                    foreach ($Roles as $Role)
                    {
                        if (  $Role->roleid == 38 && $Role->can_add == true)
                        {
                            return ($user);
                        }
                    }
                }
        
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DTR  $dTR
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, DTR $dTR)
    {
        // $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

        // if($Role)
        // {
        //     if (!is_null($dTR->time)) {
        //         return ($user);
        //     }

        // }
       
        $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',38)->where('can_edit', true)->get();
    
            if(!empty($Roles))
                {
                    foreach ($Roles as $Role)
                    {
                        if (  $Role->roleid == 38 && $Role->can_edit == true)
                        {
                            if (!is_null($dTR->time)) {

                                $Employee = Employee::where('id', $dTR->emp_id)->get()->first();
                                $Check = Employee:: where('email', auth('web')->user()->email)->get()->first();
                                if ($Employee->officeid == $Check->officeid )
                                 {
                                    if($Check->id != $dTR->emp_id ) {
                                        return ($user);
                                    }
                                 
                                 }
                            }
                         
                        }
                    }
                }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DTR  $dTR
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, DTR $dTR)
    {
        $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

        if($Role)
        {
            return ($user); 

        }
       
        $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',38)->where('can_delete', true)->get();
    
        if(!empty($Roles))
        {
            foreach ($Roles as $Role)
            {
                if (  $Role->roleid == 38 && $Role->can_delete == true)
                {
                    if (is_null($dTR->time)) {

                        $Employee = Employee::where('id', $dTR->emp_id)->get()->first();
                        $Check = Employee:: where('email', auth('web')->user()->email)->get()->first();
                        if ($Employee->officeid == $Check->officeid )
                         {
                            if($Check->id != $dTR->emp_id ) {
                                return ($user);
                            }
                         }
                    }

                    if (!is_null($dTR->time)) {

                        $Employee = Employee::where('id', $dTR->emp_id)->get()->first();
                        $Check = Employee:: where('email', auth('web')->user()->email)->get()->first();
                        if ($Employee->officeid == $Check->officeid )
                         {
                            if($Check->id != $dTR->emp_id ) {
                                return ($user);
                            }
                         }
                    }
                 
                }
            }
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DTR  $dTR
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, DTR $dTR)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DTR  $dTR
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, DTR $dTR)
    {
        //
    }


    public function viewMyDTR(User $user) {
        if(auth('web')->check())
        {
         return ($user); 
        }
    }

    public function print(User $user)
    {
        $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

        if($Role)
        {
            return ($user); 

        }
       
        $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',38)->where('can_process', true)->get();
    
            if(!empty($Roles))
                {
                    foreach ($Roles as $Role)
                    {
                        if (  $Role->roleid == 38 && $Role->can_process == true)
                        {
                            return ($user);
                        }
                    }
                }
        
    }

    public function upload(User $user)
    {
        $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

        if($Role)
        {
            return ($user); 

        }
       
        $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',38)->where('can_process', true)->get();
    
            if(!empty($Roles))
                {
                    foreach ($Roles as $Role)
                    {
                        if (  $Role->roleid == 38 && $Role->can_process == true)
                        {
                            return ($user);
                        }
                    }
                }
        
    }

    public function Biometric(User $user)
    {
        $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

        if($Role)
        {
            return ($user); 

        }
       
        $Roles = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',38)->where('can_process', true)->get();
    
            if(!empty($Roles))
                {
                    foreach ($Roles as $Role)
                    {
                        if (  $Role->roleid == 38 && $Role->can_process == true)
                        {
                            return ($user);
                        }
                    }
                }
        
    }


}
