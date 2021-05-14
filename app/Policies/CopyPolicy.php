<?php

namespace App\Policies;

use App\Models\Copy;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CopyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Copy  $copy
     * @return mixed
     */
    public function view(User $user, Copy $copy)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('View copies');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Create copies');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Copy  $copy
     * @return mixed
     */
    public function update(User $user, Copy $copy)
    {
        return $user->hasRole('Admin') || $user->hasPermissionTo('Update copies');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Copy  $copy
     * @return mixed
     */
    public function delete(User $user, Copy $copy)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Copy  $copy
     * @return mixed
     */
    public function restore(User $user, Copy $copy)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Copy  $copy
     * @return mixed
     */
    public function forceDelete(User $user, Copy $copy)
    {
        //
    }
}
