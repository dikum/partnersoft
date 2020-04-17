<?php

namespace App\Policies;

use App\Continent;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContinentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any continents.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if($user->isAdmin() || $user->isRegularUser()) {
        return true;
        }
    }

    /**
     * Determine whether the user can view the continent.
     *
     * @param  \App\User  $user
     * @param  \App\Continent  $continent
     * @return mixed
     */
    public function view(User $user, Continent $continent)
    {
        if($user->isAdmin() || $user->isRegularUser()) {
        return true;
        }
    }

    /**
     * Determine whether the user can create continents.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the continent.
     *
     * @param  \App\User  $user
     * @param  \App\Continent  $continent
     * @return mixed
     */
    public function update(User $user, Continent $continent)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the continent.
     *
     * @param  \App\User  $user
     * @param  \App\Continent  $continent
     * @return mixed
     */
    public function delete(User $user, Continent $continent)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the continent.
     *
     * @param  \App\User  $user
     * @param  \App\Continent  $continent
     * @return mixed
     */
    public function restore(User $user, Continent $continent)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the continent.
     *
     * @param  \App\User  $user
     * @param  \App\Continent  $continent
     * @return mixed
     */
    public function forceDelete(User $user, Continent $continent)
    {
        //
    }

    public function before($user, $ability)
    {
        return $user->isAdmin();
    }
}
