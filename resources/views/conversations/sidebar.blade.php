<nav id="sidebar" aria-label="Main Navigation" class="">
    <div class="content-header"style="width:100%!important">
        <a href="{{ route('dashboard.profile') }}">
            <img style="width: 45px!important; height:45px!important;" class="img-avatar" src="{{ asset(optional(optional(auth()->user())->profile)->url ??  'assets/media/avatars/avatar10.jpg') }}" alt="">
        </a>



        <div>
            <button type="button" class="btn btn-sm btn-alt-secondary" >
                <i class="far fa-moon"></i>
            </button>
            <button type="button" class="btn btn-sm btn-alt-secondary" id="newConversation" data-bs-target="#app-modal" data-backdrop="static" data-keyboard="false" data-bs-toggle="modal">
                <i class="fa fa-pencil-alt"></i>
            </button>
            <button type="button" class="btn btn-sm btn-dual mr-2 d-none d-lg-inline-block" id="newGroup" data-bs-target="#app-modal" data-backdrop="static" data-keyboard="false" data-bs-toggle="modal">
                <i class="fa fa-fw fa-ellipsis-v"></i>
            </button>
            <a class="d-lg-none btn btn-sm btn-dual ml-2" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                <i class="fa fa-fw fa-times"></i>
            </a>
        </div>
    </div>
    <div class="js-sidebar-scroll">
        <div class="content-side" style="width:100%!important">



            <div class="block-header block-header-default" style="margin-left: -2rem; margin-right: -2rem;margin-top: -1.2rem; ">
                <h3 class="block-title">

            <form class="">
                <div class="input-group input-group-xl col-md-12 col-lg-12 col-xl-12">
                    <input type="text" class=" form-control " style="border-right-color: white;" placeholder="Rechercher ou démarer une nouvelle discussion" id="page-header-search-input2" name="page-header-search-input2">
                    <span class="input-group-text" style="  background-color: white;border: 1px solid #dfe3ea;">
                        <i class="fa fa-fw fa-search"></i>
                    </span>
                </div>

            </form>
                </h3>
            </div>
            <ul class="nav-main mt-3">

                @foreach ($conversations as $conversation )


                @php
                         if($conversation->type == 'group'){
                            $src =  optional(optional($conversation)->illustration)->url ?? 'assets/media/avatars/avatar10.jpg';
                        }else {
                            $src = optional(optional(optional(optional($conversation)->interlocuteur)->first())->profile)->url ?? 'assets/media/avatars/avatar10.jpg';
                        }
                        //$src ='assets/media/avatars/avatar10.jpg';
                        $nbreUnread = optional(optional(optional($conversation)->groupe_users)->first())->messages_count ?? 0
                    @endphp
                <li class="nav-main-item" style="margin-bottom:2px; ">
                    <a class="d-flex py-2 nav-main-link" href="{{ route('dashboard.conversations.show',$conversation->id) }}"  onclick="markHasRead({{ $conversation->id }});">
                      <div class="flex-shrink-0 me-3 ms-2 overlay-container overlay-bottom" style="margin-right: .6rem!important; margin-left: 0rem!important;">
                        <img class="img-avatar" style="width: 43px;height:43px;" src="{{ asset($src) }}" alt="">
                        <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                      </div>
                      <div class="flex-grow-1" style="width: 70%!important;">
                        <div class="fw-semibold fs-sm mt-1">
                            <span class="nav-main-link-name fw-semibold fs-sm" style="font-size: .815rem!important;">
                                @if($conversation->type=="group")
                                    {{ str_replace('\\', '', $conversation->name) }}
                                @else
                                    {{ str_replace('\\', '', optional(optional($conversation->interlocuteur)->first())->last_name) }}
                                    {{ str_replace('\\', '', optional(optional($conversation->interlocuteur)->first())->first_name) }}
                                @endif
                            </span>
                        </div>
                        <div class="fs-sm text-muted " style="font-size: .751rem!important; margin-top:.2rem">
                            <i class="fa fa-fw fa-check text-success"></i>
                            {{ $conversation->last_message->first() != null ? \Str::ucfirst(str_replace('\\', '', \Str::limit($conversation->last_message->first()->content,24,'...'))) : '' }}

                        </div>

                      </div>

                      <div style=" text-align:right;">
                        <p class="fs-sm text-muted " style="font-size: .72rem!important; margin-bottom:0px!important;">

                            @if($conversation->last_message->first() != null)

                                @if(\Carbon\Carbon::now()->format('Y-m-d') == \Carbon\Carbon::parse($conversation->last_message->first()->created_at)->format('Y-m-d'))

                                    {{ \Carbon\Carbon::parse($conversation->last_message->first()->created_at)->format('h:m') }}

                                    {{-- @if(\Str::contains(\Carbon\Carbon::parse($conversation->last_message->first()->created_at)->diffForHumans(), ' seconds ago'))
                                        {{ $conversation->last_message->first() != null ? \Carbon\Carbon::parse($conversation->last_message->first()->created_at)->diffForHumans() : \Carbon\Carbon::parse($conversation->created_at)->diffForHumans() }}
                                    @else
                                        {{ \Carbon\Carbon::parse($conversation->last_message->first()->created_at)->format('h:m') }}
                                    @endif --}}

                                @else

                                    @php
                                        $date = \Carbon\Carbon::parse($conversation->last_message->first()->created_at)->format("Y-m-d H:i");
                                    @endphp

                                    @if (\Carbon\Carbon::now()->startOfWeek()->format("Y-m-d H:i") <= $date && \Carbon\Carbon::now()->endOfWeek()->format("Y-m-d H:i") >= $date)
                                        {{ \Carbon\Carbon::parse($conversation->last_message->first()->created_at)->format('l') }}
                                    @else
                                        {{ \Carbon\Carbon::parse($conversation->last_message->first()->created_at)->format('d/m/Y') }}
                                    @endif

                                @endif

                            @endif

                        </p>
                        @if($nbreUnread>0)
                            <span class="badge rounded-pill bg-success fw-semibold" style="font-size: .6rem!important">{{ $nbreUnread }}</span>
                        @endif
                      </div>
                    </a>
                </li>
                @endforeach



                <hr>

                <li class="nav-main-heading">User Interface</li>

                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ route('home') }}">
                        <i class="nav-main-link-icon si si-speedometer"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                    </a>
                </li>

                <li class="nav-main-item">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="nav-main-link"
                        href="route('logout')" onclick="event.preventDefault();
                    this.closest('form').submit();">
                        <i class="nav-main-link-icon si si-logout"></i>
                        <span class="nav-main-link-name">Déconnecter</span>
                    </a>
                </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

