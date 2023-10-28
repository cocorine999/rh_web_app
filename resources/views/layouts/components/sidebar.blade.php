<nav id="sidebar" aria-label="Main Navigation">
    <div class="content-header bg-white-5">
        <a class="font-w600 text-dual" href="javascript:void(0)">
            <img style="width: 35px!important; height:35px!important;border-radius:0px!important;" class="img-avatar" src="{{ asset(optional(optional($setting)->logo)->url ?? 'assets/logo/logo.jpg') }}" alt="">
            <span class="smini-hide">
                <span class="font-w700 font-size-h5">{{ optional($setting)->app_name }}</span>
            </span>
        </a>
        <div>
            <div class="dropdown d-inline-block ml-2">
                <a class="btn btn-sm btn-dual" id="sidebar-themes-dropdown" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false" href="#">
                    <i class="si si-drop"></i>
                </a>
            </div>
            <a class="d-lg-none btn btn-sm btn-dual ml-2" data-toggle="layout" data-action="sidebar_close"
                href="javascript:void(0)">
                <i class="fa fa-fw fa-times"></i>
            </a>
        </div>
    </div>
    <div class="js-sidebar-scroll content-side content-side-full">
        <ul class="nav-main">

            <li class="nav-main-item">
                <a class="nav-main-link" href="{{ route('home') }}" active="true">
                    <i class="nav-main-link-icon si si-speedometer"></i>
                    <span class="nav-main-link-name">Dashboard</span>
                </a>
            </li>

            @canany(['manage-payments', 'validate-payments'])
            <li class="nav-main-item">
                <a class="nav-main-link" href="{{ route('dashboard.paiements.index') }}">
                    <i class="nav-main-link-icon si si-wallet"></i>
                    <span class="nav-main-link-name">Paiements</span>
                </a>
            </li>
            @endcanany

            @canany(['manage-reports', 'view-reports'])
            <li class="nav-main-item">
                <a class="nav-main-link" href="{{ route('dashboard.rapports.index') }}">
                    <i class="nav-main-link-icon si si-layers"></i>
                    <span class="nav-main-link-name">Rapports</span>
                </a>
            </li>
            @endcanany

            @canany(['manage-meeting', 'view-meeting'])
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('dashboard.rendez-vous.index') }}">
                        <i class="nav-main-link-icon si si-globe"></i>
                        <span class="nav-main-link-name">Gestion des rendez-vous</span>
                    </a>
                </li>
            @endcanany

            @canany(['manage-permissions', 'view-permissions'])
            <li class="nav-main-item">
                <a class="nav-main-link" href="{{ route('dashboard.permissions.index') }}">
                    <i class="nav-main-link-icon si si-shield"></i>
                    <span class="nav-main-link-name">Permissions</span>
                </a>
            </li>
            @endcanany

            @canany(['manage-presences', 'view-presences'])
            <li class="nav-main-item">
                <a class="nav-main-link" href="{{ route('dashboard.presences.index') }}">
                    <i class="nav-main-link-icon si si-directions"></i>
                    <span class="nav-main-link-name">Présences</span>
                </a>
            </li>
            @endcanany




            {{-- @canany(['manage-users', 'view-users']) --}}

                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('dashboard.users.index') }}">
                        <i class="nav-main-link-icon si si-users"></i>
                        <span class="nav-main-link-name">Utilisateurs</span>
                    </a>
                </li>
            {{-- @endcanany--}}

            @canany(['manage-postes', 'view-postes'])
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('dashboard.postes.index') }}">
                        <i class="nav-main-link-icon si si-briefcase"></i>
                        <span class="nav-main-link-name">Postes</span>
                    </a>
                </li>
            @endcanany

            @canany(['manage-roles', 'view-roles'])
            <li class="nav-main-item">
                <a class="nav-main-link" href="{{ route('dashboard.roles.index') }}">
                    <i class="nav-main-link-icon si si-tag"></i>
                    <span class="nav-main-link-name">Roles</span>
                </a>
            </li>
            @endcanany

            @canany(['manage-access', 'view-access'])
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('dashboard.abilities.index') }}">
                        <i class="nav-main-link-icon si si-users"></i>
                        <span class="nav-main-link-name">ACCÈS</span>
                    </a>
                </li>
            @endcanany

            {{-- @endif --}}
        </ul>
    </div>
</nav>
