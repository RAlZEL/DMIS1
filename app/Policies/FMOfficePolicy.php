<?php

namespace App\Policies;

use App\Models\Admin\AdminPanel\FinancialManagement\Office as FM_OFFICE;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FMOfficePolicy
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
        $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

        if($Role)
        {
            return ($user); 

        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\AdminPanel\FinancialManagement\Office  $office
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, FM_OFFICE $office)
    {
         $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

        if($Role)
        {
            return ($user); 

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
        $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

        if($Role)
        {
            return ($user); 

        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\AdminPanel\FinancialManagement\Office  $office
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, FM_OFFICE $office)
    {
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
     * @param  \App\Models\Admin\AdminPanel\FinancialManagement\Office  $office
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, FM_OFFICE $office)
    {
        $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

        if($Role)
        {
            return ($user); 

        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\AdminPanel\FinancialManagement\Office  $office
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, FM_OFFICE $office)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\AdminPanel\FinancialManagement\Office  $office
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, FM_OFFICE $office)
    {
        //
    }
}
