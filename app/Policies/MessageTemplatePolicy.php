<?php

namespace App\Policies;

use App\MessageTemplate;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessageTemplatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any message templates.
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
     * Determine whether the user can view the message template.
     *
     * @param  \App\User  $user
     * @param  \App\MessageTemplate  $messageTemplate
     * @return mixed
     */
    public function view(User $user, MessageTemplate $messageTemplate)
    {
        if($user->isAdmin() || $user->isRegularUser())
            return true;
        return false;
    }

    /**
     * Determine whether the user can create message templates.
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
     * Determine whether the user can update the message template.
     *
     * @param  \App\User  $user
     * @param  \App\MessageTemplate  $messageTemplate
     * @return mixed
     */
    public function update(User $user, MessageTemplate $messageTemplate)
    {
        if($user->isAdmin() || $user->isRegularUser())
            return true;
        return false;
    }

    /**
     * Determine whether the user can delete the message template.
     *
     * @param  \App\User  $user
     * @param  \App\MessageTemplate  $messageTemplate
     * @return mixed
     */
    public function delete(User $user, MessageTemplate $messageTemplate)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the message template.
     *
     * @param  \App\User  $user
     * @param  \App\MessageTemplate  $messageTemplate
     * @return mixed
     */
    public function restore(User $user, MessageTemplate $messageTemplate)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the message template.
     *
     * @param  \App\User  $user
     * @param  \App\MessageTemplate  $messageTemplate
     * @return mixed
     */
    public function forceDelete(User $user, MessageTemplate $messageTemplate)
    {
        //
    }
}
