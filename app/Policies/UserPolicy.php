<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy {

    use HandlesAuthorization;

    /**
     * Determine whether the given user can create a user.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user) {
        if ($user->role == 'administrator')
            return true;
        else
            return false;
    }

    /**
     * Determine whether the authenticated user can update the user.
     *
     * @param  \App\User  $auth_user
     * @param  \App\User  $user_to_update
     * @return mixed
     */
    public function update(User $auth_user, User $user_to_update) {
        if ($auth_user->role == 'administrator' && $auth_user->organisation_id === $user_to_update->organisation_id)
            return true;
        else
            return false;
    }

    /**
     * Determine whether the authenticated user can delete the user.
     *
     * @param  \App\User  $auth_user
     * @param  \App\User $user_to_update
     * @return mixed
     */
    public function delete(User $auth_user, User $user_to_update) {
        return $this->update($auth_user, $user_to_update);
    }

    /**
     * Determine whether the authenticated user can restore the user.
     *
     * @param  \App\User  $auth_user
     * @param  \App\User $user_to_update
     * @return mixed
     */
    public function restore(User $auth_user, User $user_to_update) {
        return $this->update($auth_user, $user_to_update);
    }

    /**
     * Determine whether the authenticated user can permanently delete the user.
     *
     * @param  \App\User  $auth_user
     * @param  \App\User $user_to_update
     * @return mixed
     */
    public function forceDelete(User $auth_user, User $user_to_update) {
        return $this->update($auth_user, $user_to_update);
    }

}
