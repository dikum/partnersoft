<?php

namespace App\Policies;

use App\BankStatement;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BankStatementPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any bank statements.
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
     * Determine whether the user can view the bank statement.
     *
     * @param  \App\User  $user
     * @param  \App\BankStatement  $bankStatement
     * @return mixed
     */
    public function view(User $user, BankStatement $bankStatement)
    {
        if($user->isAdmin() || $user->isRegularUser())
            return true;
        return false;
    }

    /**
     * Determine whether the user can create bank statements.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the bank statement.
     *
     * @param  \App\User  $user
     * @param  \App\BankStatement  $bankStatement
     * @return mixed
     */
    public function update(User $user, BankStatement $bankStatement)
    {
        if($user->isAdmin())
            return true;
        return false;
    }

    /**
     * Determine whether the user can delete the bank statement.
     *
     * @param  \App\User  $user
     * @param  \App\BankStatement  $bankStatement
     * @return mixed
     */
    public function delete(User $user, BankStatement $bankStatement)
    {
        if($user->isAdmin())
            return true;
        return false;
    }

    /**
     * Determine whether the user can restore the bank statement.
     *
     * @param  \App\User  $user
     * @param  \App\BankStatement  $bankStatement
     * @return mixed
     */
    public function restore(User $user, BankStatement $bankStatement)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the bank statement.
     *
     * @param  \App\User  $user
     * @param  \App\BankStatement  $bankStatement
     * @return mixed
     */
    public function forceDelete(User $user, BankStatement $bankStatement)
    {
        //
    }

    public function before($user, $ability)
    {
        return $user->isAdmin();
    }
}
