<?php

namespace App\Policies;

use App\Bank;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BankPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any banks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if($user->isAdmin() || $user->isRegularUser())
            return true;
        return false;
    }

    /**
     * Determine whether the user can view the bank.
     *
     * @param  \App\User  $user
     * @param  \App\Bank  $bank
     * @return mixed
     */
    public function view(User $user, Bank $bank)
    {
        if($user->isAdmin() || $user->isRegularUser())
            return true;
        return false;
    }

    /**
     * Determine whether the user can create banks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if($user->isAdmin()))
            return true;
        return false;
    }

    /**
     * Determine whether the user can update the bank.
     *
     * @param  \App\User  $user
     * @param  \App\Bank  $bank
     * @return mixed
     */
    public function update(User $user, Bank $bank)
    {
        if($user->isAdmin())
            return true;
        return false;
    }

    /**
     * Determine whether the user can delete the bank.
     *
     * @param  \App\User  $user
     * @param  \App\Bank  $bank
     * @return mixed
     */
    public function delete(User $user, Bank $bank)
    {
        if($user->isAdmin())
            return true;
        return false;
    }

    /**
     * Determine whether the user can restore the bank.
     *
     * @param  \App\User  $user
     * @param  \App\Bank  $bank
     * @return mixed
     */
    public function restore(User $user, Bank $bank)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the bank.
     *
     * @param  \App\User  $user
     * @param  \App\Bank  $bank
     * @return mixed
     */
    public function forceDelete(User $user, Bank $bank)
    {
        //
    }

    public function before($user, $ability)
    {
        if($user->isAdmin()) {
        return true;
    }
}
