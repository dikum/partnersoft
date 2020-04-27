<?php

namespace App\Policies;

use App\Partner;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PartnerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any partners.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //$user = User::where('user_id', $user->id)->firstOrFail();

        if($user->type == 'admin' || $user->type == 'regular')
            return true;
        else
            return false;
    }

    /**
     * Determine whether the user can view the partner.
     *
     * @param  \App\User  $user
     * @param  \App\Partner  $partner
     * @return mixed
     */
    public function view(User $user, User $partner)
    {

        if($user->type ==  'admin' || $user->type == 'regular' || $user->user_id == $partner->user_id)
            return true;
        else
            return false;
    }

    /**
     * Determine whether the user can create partners.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the partner.
     *
     * @param  \App\User  $user
     * @param  \App\Partner  $partner
     * @return mixed
     */
    public function update(User $user, Partner $partner)
    {
        if($user->type == 'admin' || $user->type == 'regular' || $user->id == $partner->id);
    }

    /**
     * Determine whether the user can delete the partner.
     *
     * @param  \App\User  $user
     * @param  \App\Partner  $partner
     * @return mixed
     */
    public function delete(User $user, Partner $partner)
    {
        return $user->type === 'admin';
    }


    public function before($user, $ability)
    {
        return $user->isAdmin();
    }

}
