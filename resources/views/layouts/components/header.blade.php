<header id="page-header">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <button type="button" class="btn btn-sm btn-dual mr-2 d-lg-none" data-toggle="layout"
                data-action="sidebar_toggle">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <button type="button" class="btn btn-sm btn-dual mr-2 d-none d-lg-inline-block" data-toggle="layout"
                data-action="sidebar_mini_toggle">
                <i class="fa fa-fw fa-ellipsis-v"></i>
            </button>
            <button type="button" class="btn btn-sm btn-dual d-sm-none" data-toggle="layout"
                data-action="header_search_on">
                <i class="si si-magnifier"></i>
            </button>
        </div>
        <div class="d-flex align-items-center">
            <div class="dropdown d-inline-block ml-2">
                <button type="button" class="btn btn-sm btn-dual" id="page-header-user-dropdown" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img class="rounded"
                        src="{{ asset(optional(auth()->user()->profile)->url ?? 'assets/media/avatars/avatar10.jpg') }}"
                        alt="Header Avatar" style="width: 18px;">
                    <span class="d-none d-sm-inline-block ml-1">{{ str_replace('\\', '', Auth::user()->first_name) }}</span>
                    <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right p-0 border-0 font-size-sm"
                    aria-labelledby="page-header-user-dropdown">
                    <div class="p-3 text-center bg-body-light border-bottom rounded-top">
                        <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ asset(optional(auth()->user()->profile)->url ?? 'assets/media/avatars/avatar10.jpg') }}" alt="">
                        <p class="mt-2 mb-0 fw-medium">{{ str_replace('\\', '', Auth::user()->last_name) }}
                            {{ str_replace('\\', '', Auth::user()->first_name) }}</p>
                        <p class="mb-0 text-muted fs-sm fw-medium">{{ optional(optional(Auth::user()->user_actual_poste)->last())->name }}</p>
                      </div>
                    <div class="p-2">
                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('dashboard.inbox') }}">
                            <span class="fs-sm fw-medium">Inbox</span>
                            <span class="badge rounded-pill bg-primary ms-2">3</span>
                        </a>
                        <a class="dropdown-item d-flex align-items-center justify-content-between"
                            href="{{ route('dashboard.profile') }}">
                            <span>Profil</span>
                            <span>
                                <span class="badge badge-pill badge-success">1</span>
                                <i class="si si-user ml-1"></i>
                            </span>
                        </a>
                        @can('manage-settings')
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="{{ route('dashboard.settings.index') }}">
                                <span>Settings</span>
                                <i class="si si-settings"></i>
                            </a>
                        @endcan
                        <div role="separator" class="dropdown-divider"></div>
                        <h5 class="dropdown-header text-uppercase">Actions</h5>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="route('logout')" onclick="event.preventDefault();
                            this.closest('form').submit();">
                                <span>Log Out</span>
                                <i class="si si-logout ml-1"></i>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="dropdown d-inline-block ml-2">
                <button id="notifications" type="button" class="btn btn-sm btn-dual"
                    id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="si si-bell"></i>
                    <span id="count-notifications" class="badge badge-primary badge-pill"></span>

                </button>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0 border-0 font-size-sm"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-2 bg-primary text-center">
                        <h5 class="dropdown-header text-uppercase text-white">Notifications</h5>
                    </div>
                    <ul id="notificationsMenu" class="nav-items mb-0">
                    </ul>
                    <div class="p-2 border-top" id="load-notification">
                        <a class="btn btn-sm btn-light btn-block text-center"
                            href="{{ route('dashboard.allNotifications') }}">
                            <i class="fa fa-fw fa-arrow-down mr-1"></i> Load More...
                        </a>
                    </div>

                    <div class="p-2 border-top" id="no-notification" style="display: none;">
                        <a class="btn btn-sm btn-light btn-block text-center" href="javascript:void(0)">
                            <i class="fa fa-fw fa-t mr-1"></i> Aucune notification
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>{{--
    <div id="page-header-search" class="overlay-header bg-white">
        <div class="content-header">
            <form class="w-100" action="be_pages_generic_search.html" method="POST">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-danger" data-toggle="layout"
                            data-action="header_search_off">
                            <i class="fa fa-fw fa-times-circle"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control" placeholder="Search or hit ESC.."
                        id="page-header-search-input" name="page-header-search-input">
                </div>
            </form>
        </div>
    </div> --}}
    <div id="page-header-loader" class="overlay-header bg-white">
        <div class="content-header">
            <div class="w-100 text-center">
                <i class="fa fa-fw fa-circle-notch fa-spin"></i>
            </div>
        </div>
    </div>
</header>
