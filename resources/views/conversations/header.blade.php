<header id="page-header">
    <div class="content-header" style="width:100%!important;">
        <div class="d-flex align-items-center">

            <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-fw fa-bars"></i>
              </button>

            @if(isset($conversation))

            @php
            if(isset($conversation)){

            if($conversation->type == 'group'){

                $src =  optional(optional($conversation)->illustration)->url ?? 'assets/media/avatars/avatar10.jpg';
            }else {
            $src = optional(optional(optional($conversation->interlocuteur)->first())->profile)->url ?? 'assets/media/avatars/avatar10.jpg';
            }
            }
            else {
            $conversation = null;
            }

            @endphp

            <li class="nav-main-item" style="margin-bottom:2px; ">
                <a class="d-flex py-2" style=" padding:0rem!important;" href="javascript:void(0)">
                    <div class="flex-shrink-0 me-3 ms-2 overlay-container overlay-bottom" style="margin-right: .6rem!important; margin-left: 0rem!important;">
                        @if($conversation)
                        <img class="img-avatar" style="width: 43px;height:43px;" src="{{ asset($src) }}" alt="">
                        <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                        @else
                        <span class=" item item-tiny item-circle border border-2 border-white bg-success" style="width: 3rem; height: 3rem;"></span>
                        @endif
                    </div>
                    <div class="flex-grow-1" style="width: 90%!important;">
                        <div class="fw-semibold fs-sm mt-1">
                            <span class="nav-main-link-name fw-semibold fs-sm" style="font-size: .815rem!important;">
                                @if(optional($conversation)->type=="group")
                                {{ str_replace('\\', '', $conversation->name) }}
                                @else
                                {{ str_replace('\\', '', optional(optional(optional($conversation)->interlocuteur)->first())->last_name) }}
                                {{ str_replace('\\', '', optional(optional(optional($conversation)->interlocuteur)->first())->first_name) }}
                                @endif
                            </span>
                        </div>
                        <div class="fs-sm text-muted " style="font-size: .7rem!important;">
                            Vu à 23:40
                        </div>
                    </div>

                </a>
            </li>
            @endif
        </div>
        <div class="d-flex align-items-center">

            <div class="dropdown d-inline-block ms-2">
                <button type="button" class="btn btn-sm btn-alt-secondary" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-bell"></i>
                    <span class="text-primary">•</span>
                    <span id="count-notifications" class="badge badge-primary badge-pill text-black"></span>
                </button>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0 border-0 fs-sm" aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-2 bg-body-light border-bottom text-center rounded-top text-white bg-primary" style="background-color: #4c78dd!important;">
                        <h5 class="dropdown-header text-uppercase" style="color:white!important;">Notifications</h5>
                    </div>

                    <ul id="notificationsMenu" class="nav-items mb-0">
                    </ul>

                    <div class="p-2 border-top" id="load-notification">
                        <a class="btn btn-sm btn-light btn-block text-center fw-medium" href="{{ route('dashboard.allNotifications') }}" style="width: 100%;">
                            <i class="fa fa-fw fa-arrow-down mr-1"></i> Load More...
                        </a>
                    </div>

                    <div class="p-2 border-top" id="no-notification" style="display: none;">
                        <a class="btn btn-sm btn-light btn-block text-center d-inline-block fw-medium" href="javascript:void(0)">
                            <i class="fa fa-fw fa-t mr-1"></i> Aucune notification
                        </a>
                    </div>

                </div>

            </div>
            @if(isset($conversation))
            <button type="button" class="btn btn-sm btn-alt-secondary ms-2" onclick="fetchAttachedFiles({{ optional($conversation)->id }})" data-toggle="layout" data-action="side_overlay_toggle">
                <i class="fa fa-fw fa-list-ul fa-flip-horizontal"></i>
            </button>

            @endif
        </div>
    </div>
    <div id="page-header-search" class="overlay-header bg-body-extra-light">
        <div class="content-header">
            <form class="w-100" action="be_pages_generic_search.html" method="POST">
                <div class="input-group">
                    <button type="button" class="btn btn-alt-danger" data-toggle="layout" data-action="header_search_off">
                        <i class="fa fa-fw fa-times-circle"></i>
                    </button>
                    <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                </div>
            </form>
        </div>
    </div>
    <div id="page-header-loader" class="overlay-header bg-body-extra-light">
        <div class="content-header">
            <div class="w-100 text-center">
                <i class="fa fa-fw fa-circle-notch fa-spin"></i>
            </div>
        </div>
    </div>
</header>
