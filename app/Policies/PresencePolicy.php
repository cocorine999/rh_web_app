<?php

namespace App\Policies;

use App\Models\Presence;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class PresencePolicy
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
        return (optional($user)->hasRoleorPoste('administrateur') || optional($user)->hasRoleorPoste('RH') || optional($user)->hasRoleorPoste('Sécrétariat'));
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Presence $presence)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $userpresencel
     */
    public function create(User $user)
    {
        $trafic = Presence::where('created_at','>=',Carbon::today())->where('user_id',optional($user)->id)->get();
        if(count($trafic) == 0)
            return true;
        else return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function sortie(User $user, Presence $presence)
    {
        return (optional($user)->hasRoleorPoste('administrateur') || optional($user)->hasRoleorPoste('RH') || optional($user)->hasRoleorPoste('Sécrétariat') || optional($user)->id === $presence->user_id) && $presence->in_at != null && $presence->out_at == null;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Presence $presence)
    {
        return optional($user)->can('update-presences');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Presence $presence)
    {
        return optional($user)->can('delete-presences');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Presence $presence)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Presence  $presence
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Presence $presence)
    {
        //
    }
}
