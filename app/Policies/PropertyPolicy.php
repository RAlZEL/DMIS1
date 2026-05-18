<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserRole;
use App\Models\InventoryManagement\Property;
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
        return $this->isImAdmin($user) || $this->hasImPermission($user, 'can_view');
    }

    public function viewMail(User $user)
    {
        return $this->isImAdmin($user) || $this->hasImPermission($user, 'can_route');
    }


    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\InventoryManagement\property  $property
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Property $property)
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
        return $this->isImAdmin($user) || $this->hasImPermission($user, 'can_add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\InventoryManagement\property  $property
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Property $property)
    {
        return $this->isImAdmin($user) || $this->hasImPermission($user, 'can_edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     *@param  \App\Models\InventoryManagement\property  $property
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Property $property)
    {
        return $this->isImAdmin($user) || $this->hasImPermission($user, 'can_delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     *@param  \App\Models\InventoryManagement\property  $property
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Property $property)
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
    public function forceDelete(User $user, Property $property)
    {
        //
    }

    private function isImAdmin(User $user): bool
    {
        return (bool) $user->is_admin;
    }

    private function hasImPermission(User $user, string $column): bool
    {
        return UserRole::where('userid', $user->id)
            ->where('roleid', 42)
            ->where($column, true)
            ->exists();
    }

}
