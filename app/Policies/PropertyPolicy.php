<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserRole;
use App\Models\Admin\EMS\Employee;
use App\Models\InventoryManagement\property;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropertyPolicy
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

    public function viewMail(User $user)
    {
        $Role = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',42)->where('can_route', true)->get()->first();
        if(!empty($Role))
        {
            return ($user); 

        }  
    }


    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\InventoryManagement\property  $property
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, property $property)
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
      
        $Role = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',42)->where('can_add', true)->get()->first();
        if(!empty($Role))
        {
            return ($user); 

        }  
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\InventoryManagement\property  $property
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, property $property)
    {
        $Role = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',28)->where('can_edit', true)->get()->first();
        if(!empty($Role))
        {
            return ($user); 

        }  
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     *@param  \App\Models\InventoryManagement\property  $property
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, property $property)
    {
        $Role = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',28)->where('can_delete', true)->get()->first();
        if(!empty($Role))
        {
            return ($user); 

        }  
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     *@param  \App\Models\InventoryManagement\property  $property
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, property $property)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\InventoryManagement\property  $property
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, property $property)
    {
        //
    }

}
