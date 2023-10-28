<?php

namespace App\Policies;

use App\Models\Poste;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostePolicy
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
        return optional($user)->isAdmin() || optional($user)->isRH() || optional($user)->isSecretaire() || optional($user)->isComptable();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Poste  $poste
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Poste $poste)
    {
        return optional($user)->isAdmin() || optional($user)->isRH();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return optional($user)->isAdmin() || optional($user)->isRH();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Poste  $poste
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Poste $poste)
    {
        return optional($user)->isAdmin() || optional($user)->isRH();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Poste  $poste
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Poste $poste)
    {
        return optional($user)->isAdmin() || optional($user)->isRH();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Poste  $poste
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Poste $poste)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Poste  $poste
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Poste $poste)
    {
        //
    }
}
