<?php

namespace App\Policies;

use App\PartnerComment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PartnerCommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any partner comments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the partner comment.
     *
     * @param  \App\User  $user
     * @param  \App\PartnerComment  $partnerComment
     * @return mixed
     */
    public function view(User $user, PartnerComment $partnerComment)
    {
        if($user->isAdmin() || $user->isRegularUser())
            return true;
        return false;
    }

    /**
     * Determine whether the user can create partner comments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if($user->isAdmin() || $user->isRegularUser())
            return true;
        return false;
    }

    /**
     * Determine whether the user can update the partner comment.
     *
     * @param  \App\User  $user
     * @param  \App\PartnerComment  $partnerComment
     * @return mixed
     */
    public function update(User $user, PartnerComment $partnerComment)
    {
        if($user->isAdmin() || ($user->isRegularUser() &&  $user->user_id == $partnerComment->made_by))
            return true;
        return false;
    }

    /**
     * Determine whether the user can delete the partner comment.
     *
     * @param  \App\User  $user
     * @param  \App\PartnerComment  $partnerComment
     * @return mixed
     */
    public function delete(User $user, PartnerComment $partnerComment)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the partner comment.
     *
     * @param  \App\User  $user
     * @param  \App\PartnerComment  $partnerComment
     * @return mixed
     */
    public function restore(User $user, PartnerComment $partnerComment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the partner comment.
     *
     * @param  \App\User  $user
     * @param  \App\PartnerComment  $partnerComment
     * @return mixed
     */
    public function forceDelete(User $user, PartnerComment $partnerComment)
    {
        //
    }

}
