<?php

namespace App\Policies;

use App\Models\Rapport;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RapportPolicy
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
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Rapport  $rapport
     * @return \Illuminate\Auth\Access\Response|bool
     */

    public function viewAll(User $user)
    {
        return optional($user)->hasRoleorPoste('administrateur') || optional($user)->hasRoleorPoste('Chef projet') || optional($user)->hasRoleorPoste('Chef développeur');
    }

    public function view(User $user, Rapport $rapport)
    {
        return optional($user)->hasRoleorPoste('administrateur') || optional($user)->hasRoleorPoste('Chef projet') || optional($user)->hasRoleorPoste('Chef développeur') || optional($user)->id === $rapport->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Rapport  $rapport
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Rapport $rapport)
    {
        return optional($user)->id === $rapport->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Rapport  $rapport
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Rapport $rapport)
    {
        return optional($user)->id === $rapport->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Rapport  $rapport
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Rapport $rapport)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Rapport  $rapport
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Rapport $rapport)
    {
        //
    }
}
