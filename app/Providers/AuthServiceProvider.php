<?php

namespace App\Providers;

use App\Models\Paiement;
use App\Models\Permission;
use App\Models\Poste;
use App\Models\Presence;
use App\Models\Rapport;
use App\Models\RendezVous;
use App\Models\Role;
use App\Models\User;
use App\Policies\MessagePolicy;
use App\Policies\PaiementPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\PostePolicy;
use App\Policies\PresencePolicy;
use App\Policies\RapportPolicy;
use App\Policies\RendezVousPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Paiement::class => PaiementPolicy::class,
        Rapport::class => RapportPolicy::class,
        Permission::class => PermissionPolicy::class,
        RendezVous::class => RendezVousPolicy::class,
        Presence::class => PresencePolicy::class,
        Poste::class => PostePolicy::class,
        Role::class => RolePolicy::class,
        User::class => UserPolicy::class,
        Message::class => MessagePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('validate-paiement', [PaiementPolicy::class, 'validate']);
        Gate::define('update-paiement', [PaiementPolicy::class, 'update']);
        Gate::define('update-rapport', [RapportPolicy::class, 'update']);
        Gate::define('delete-rapport', [RapportPolicy::class, 'delete']);
        Gate::define('delete-message', [MessagePolicy::class, 'delete']);
        Gate::define('validate-permission', [PermissionPolicy::class, 'validate']);
        Gate::define('view-all-reports', [RapportPolicy::class, 'viewAll']);
        Gate::define('sortie-service', [PresencePolicy::class, 'sortie']);
        //
    }
}
