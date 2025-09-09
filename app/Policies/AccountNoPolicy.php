<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\FinancialManagement\account\accountno;

class AccountNoPolicy
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

        $Role = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',27)->where('can_view', true)->get()->first();
        if(!empty($Role))
        {
            return ($user); 

        }  
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FinancialManagement\account\accountno  $accountno
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, accountno $accountno)
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

        $Role = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',27)->where('can_add', true)->get()->first();
        if(!empty($Role))
        {
            return ($user); 

        }  
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FinancialManagement\account\accountno  $accountno
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, accountno $accountno)
    {
        $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

        if($Role)
        {
            return ($user); 

        }

        $Role = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',27)->where('can_edit', true)->get()->first();
        if(!empty($Role))
        {
            return ($user); 

        }  
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FinancialManagement\account\accountno  $accountno
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, accountno $accountno)
    {
        $Role = User::where('id','=',auth('web')->user()->id)->where('is_admin', true)->get()->first();

        if($Role)
        {
            return ($user); 

        }

        $Role = UserRole::where('userid','=',auth('web')->user()->id)->where('roleid',27)->where('can_delete', true)->get()->first();
        if(!empty($Role))
        {
            return ($user); 

        }  
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FinancialManagement\account\accountno  $accountno
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, accountno $accountno)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FinancialManagement\account\accountno  $accountno
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, accountno $accountno)
    {
        //
    }
}
