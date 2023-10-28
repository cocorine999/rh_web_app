<aside id="side-overlay">
    <div class="content-header border-bottom">

            <a class="d-flex py-2" style=" padding:0rem!important;" href="javascript:void(0)">
                <div class="flex-shrink-0 me-3 ms-2 overlay-container overlay-bottom" style="margin-right: .6rem!important; margin-left: 0rem!important;">
                    @if($conversation)
                    <img class="img-avatar" style="width: 43px;height:43px;" src="{{ asset($src) }}" alt="" id="change_illustration">
                    {{-- <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span> --}}
                    @if(optional($conversation)->type=="group" && auth()->user()->groupes()->wherePivot('groupe_id',$conversation->id)->wherePivot('in_groupe',true)->wherePivot('is_admin',true)->first())
                    <span class="overlay-item item item-tiny item-circle border border-2 border-white" onclick="document.getElementById('change_group_illustration').click();" style="border-color: #f6f7f9 !important; text-align:center; background-color: #ebeef2; bottom: -4px; right:-7px;width: 1.5rem;height: 1.5rem;">
                        <i class="fa fa-camera mt-1" style="color: #adb5bd; font-size:13px;"></i>
                        <input hidden="" type="file" accept="image/*" onchange="showPreviewImage(event,'change_illustration');" id="change_group_illustration" name="illustration">
                    </span>
                    @endif
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
                </div>
            </a>

        {{--
            <a class="img-link me-1" href="javascript:void(0)">
                <img class="img-avatar img-avatar32" src="{{ asset($src) }}" alt="">
            </a>
            <div class="ms-2">
                <a class="text-dark fw-semibold fs-sm" href="javascript:void(0)">
                    @if(optional($conversation)->type=="group")
                    {{ str_replace('\\', '', $conversation->name) }}
                    @else
                    {{ str_replace('\\', '', optional(optional(optional($conversation)->interlocuteur)->first())->last_name) }}
                    {{ str_replace('\\', '', optional(optional(optional($conversation)->interlocuteur)->first())->first_name) }}

                    @endif
                </a>
            </div>
        --}}
        <a class="ms-auto btn btn-sm btn-alt-secondary" id="resetIllustration" style="display: none;" href="javascript:void(0)" onclick="changeIllustration({{ optional($conversation)->id }})">
            <i class="fa fa-fw fa-save"></i>
        </a>

        <a class="ms-auto btn btn-sm btn-alt-danger" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_close">
            <i class="fa fa-fw fa-times"></i>
        </a>
    </div>
    <div class="content-side">
        <div class="block block-transparent pull-x pull-t">
            <ul class="nav nav-tabs nav-tabs-block nav-justified" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" id="so-overview-tab" data-bs-toggle="tab" data-bs-target="#so-overview" role="tab" aria-controls="so-overview" aria-selected="true">
                        <i class="fa fa-fw fa-cogs text-gray opacity-75 me-1"></i> Profil
                    </button>
                </li>
                {{--
                    <li class="nav-item">
                        <button type="button" class="nav-link" id="so-sales-tab" data-bs-toggle="tab" data-bs-target="#so-sales" role="tab" aria-controls="so-sales" aria-selected="false">
                            <i class="fa fa-fw fa-chart-line text-gray opacity-75 me-1"></i> Sales
                        </button>
                    </li>
                --}}
            </ul>
            <div class="block-content tab-content overflow-hidden">
                <div class="tab-pane pull-x fade fade-left show active" id="so-overview" role="tabpanel" aria-labelledby="so-overview-tab">
                    <div class="block block-transparent">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Galerie</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                    <i class="si si-refresh"></i>
                                </button>
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <ul class="nav-items mb-0">
                                @if(optional($conversation)->type == 'group')
                                <li>
                                    <a class="text-dark d-flex py-2" href="javascript:void(0)" id="newGroupMembers" data-bs-target="#app-modal" data-backdrop="static" data-keyboard="false" data-bs-toggle="modal" onclick="document.getElementById('new_members_group_id').setAttribute('value',{{ $conversation['id'] }})">
                                        <div class="flex-shrink-0 me-3 ms-2">
                                            <i class="fa fa-fw fa-plus text-success"></i>
                                        </div>
                                        <div class="flex-grow-1 fs-sm">
                                            <div class="fw-semibold">Ajouter un nouveau membre</div>
                                        </div>
                                    </a>
                                </li>
                                @endif

                                <div id="conversationAttachedFiles" class="row items-push js-gallery  img-fluid-100">

                                </div>

                            </ul>
                        </div>
                    </div>
                    <div class="block block-transparent">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                @if(optional($conversation)->type=="group")
                                Membres du groupe
                                @else
                                Contact
                                @endif
                            </h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                    <i class="si si-refresh"></i>
                                </button>
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <ul class="nav-items mb-0">

                                @if(optional($conversation)->type=="group")
                                    @foreach ($conversation->actif_users as $user)
                                        <li>
                                            <a class="d-flex py-2" href="javascript:void(0)">
                                                <div class="me-3 ms-2 overlay-container overlay-bottom">
                                                    <img class="img-avatar img-avatar48" src="{{ asset(optional($user->profile)->url ?? 'assets/media/avatars/avatar10.jpg') }}" alt="">
                                                    <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                                                </div>
                                                <div class="flex-grow-1 fs-sm" style="width: 70%!important;color:black:important; font-size:13px!important;">
                                                    <div class="fw-semibold" style="color: black!important;">{{ str_replace('\\', '', $user->last_name) }}
                                                        {{ str_replace('\\', '', $user->first_name) }}</div>
                                                    <div class="text-muted">{{ $user->user_actual_poste->first()->name}}</div>
                                                </div>

                                                <div style=" text-align:right;">
                                                    @if($user->pivot->is_admin == true)
                                                    <p class="fs-sm text-muted " style=" color:green!important;font-size: .72rem!important; color : green; margin-bottom:0px!important;">
                                                        Administrateur
                                                    </p>
                                                    @if( $user->id != auth()->id() && auth()->user()->groupes()->wherePivot('groupe_id',$conversation->id)->wherePivot('in_groupe',true)->wherePivot('is_admin',true)->first())
                                                    <span class="badge rounded-pill bg-success fw-semibold pl-1 pr-1" style="font-size: .7rem!important">Retirer du groupe</span>
                                                    @endif
                                                    @else

                                                    @if($user->id != auth()->id() && auth()->user()->groupes()->wherePivot('groupe_id',$conversation->id)->wherePivot('in_groupe',true)->wherePivot('is_admin',true)->first())
                                                    <span class=" text-danger fw-semibold pl-1 pr-1" style="font-size: .7rem!important" onclick="retreiveFromGroup({{ $conversation->id }},{{ $user->id }},'Retirer du groupe')">
                                                        Retirer du groupe
                                                    </span>
                                                    @endif
                                                    @endif

                                                </div>
                                            </a>
                                        </li>
                                    @endforeach

                                @else
                                    <li>
                                        <a class="d-flex py-2" href="javascript:void(0)">
                                            <div class="me-3 ms-2 overlay-container overlay-bottom">
                                                <img class="img-avatar img-avatar48" src="{{ asset( optional(optional(optional(optional($conversation)->interlocuteur)->first())->profile)->url ?? 'assets/media/avatars/avatar10.jpg') }}" alt="">
                                                <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                                            </div>
                                            <div class="flex-grow-1 fs-sm">
                                                <div class="fw-semibold">
                                                    {{ optional(optional(optional($conversation)->interlocuteur)->first())->first_name }}
                                                    {{ optional(optional(optional($conversation)->interlocuteur)->first())->last_name }}
                                                </div>
                                                <small class="text-muted fs-sm">{{ optional(optional(optional($conversation)->interlocuteur)->first())->telephone }}</small>
                                            </div>
                                        </a>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </div>
                    <div class="block block-transparent mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Extra</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <form action="" method="POST" onsubmit="return false;">

                                <div class="mb-4" id="block">
                                        @if($conversation)

                                            @if($conversation->type == "group")
                                                @if($conversation->users()->wherePivot('user_id',auth()->id())->first()->pivot->in_groupe == true)

                                                    <ul class="nav-items mb-0">
                                                        <li>
                                                            <a class="text-dark d-flex py-2" href="javascript:void(0)" onclick="getOutOfGroup({{ $conversation->id }},{{ auth()->id() }},'Quitter le groupe')">
                                                                <div class="flex-shrink-0 me-3 ms-2">
                                                                    <i class="si si-logout text-danger"></i>
                                                                </div>
                                                                <div class="flex-grow-1 fs-sm">
                                                                    <div class="fw-semibold">Quitter le groupe</div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>

                                                @endif
                                            @else

                                            @php
                                                $status = $conversation->users()->wherePivot('user_id',optional(optional(optional($conversation)->interlocuteur)->first())->id)->first()->pivot->in_groupe;
                                                $id = optional(optional(optional($conversation)->interlocuteur)->first())->id;
                                            @endphp

                                            <div class="mb-4">

                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" onchange="{{ $status ? "blockConversation(". $conversation->id.','.$id.','."'Bloquer')" : "unBlock(".$conversation->id.','.$id.','."'Débloquer','Voulez-vous vraiement débloquer cet utilisateur ???')"}}" type="checkbox" id="so-settings-check2" name="so-settings-check2" {{ $status ? "checked" : "" }}>
                                                    <label class="form-check-label fs-sm" for="so-settings-check2">{{ $status ? "Bloquer" : "Débloquer" }}</label>
                                                </div>
                                            </div>

                                        @endif
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>{{--
                <div class="tab-pane pull-x fade fade-right" id="so-sales" role="tabpanel" aria-labelledby="so-sales-tab">
                    <div class="block block-transparent mb-0">
                        <div class="block-content">
                            <div class="row items-push pull-t">
                                <div class="col-6">
                                    <div class="fs-sm fw-semibold text-uppercase">Sales</div>
                                    <a class="fs-lg" href="javascript:void(0)">22.030</a>
                                </div>
                                <div class="col-6">
                                    <div class="fs-sm fw-semibold text-uppercase">Balance</div>
                                    <a class="fs-lg" href="javascript:void(0)">$4.589,00</a>
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full block-content-sm bg-body-light">
                            <div class="row">
                                <div class="col-6">
                                    <span class="fs-sm fw-semibold text-uppercase">Today</span>
                                </div>
                                <div class="col-6 text-end">
                                    <span class="ext-muted">$996</span>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <ul class="nav-items push">
                                <li>
                                    <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                        <div class="flex-shrink-0 me-3 ms-2">
                                            <i class="fa fa-fw fa-plus text-success"></i>
                                        </div>
                                        <div class="flex-grow-1 fs-sm">
                                            <div class="fw-semibold">New sale! + $249</div>
                                            <small class="text-muted">3 min ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                        <div class="flex-shrink-0 me-3 ms-2">
                                            <i class="fa fa-fw fa-plus text-success"></i>
                                        </div>
                                        <div class="flex-grow-1 fs-sm">
                                            <div class="fw-semibold">New sale! + $129</div>
                                            <small class="text-muted">50 min ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                        <div class="flex-shrink-0 me-3 ms-2">
                                            <i class="fa fa-fw fa-plus text-success"></i>
                                        </div>
                                        <div class="flex-grow-1 fs-sm">
                                            <div class="fw-semibold">New sale! + $119</div>
                                            <small class="text-muted">2 hours ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                        <div class="flex-shrink-0 me-3 ms-2">
                                            <i class="fa fa-fw fa-plus text-success"></i>
                                        </div>
                                        <div class="flex-grow-1 fs-sm">
                                            <div class="fw-semibold">New sale! + $499</div>
                                            <small class="text-muted">3 hours ago</small>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="block-content block-content-full block-content-sm bg-body-light">
                            <div class="row">
                                <div class="col-6">
                                    <span class="fs-sm fw-semibold text-uppercase">Yesterday</span>
                                </div>
                                <div class="col-6 text-end">
                                    <span class="text-muted">$765</span>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <ul class="nav-items push">
                                <li>
                                    <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                        <div class="flex-shrink-0 me-3 ms-2">
                                            <i class="fa fa-fw fa-plus text-success"></i>
                                        </div>
                                        <div class="flex-grow-1 fs-sm">
                                            <div class="fw-semibold">New sale! + $249</div>
                                            <small class="text-muted">26 hours ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                        <div class="flex-shrink-0 me-3 ms-2">
                                            <i class="fa fa-fw fa-minus text-danger"></i>
                                        </div>
                                        <div class="flex-grow-1 fs-sm">
                                            <div class="fw-semibold">Product Purchase - $50</div>
                                            <small class="text-muted">28 hours ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                        <div class="flex-shrink-0 me-3 ms-2">
                                            <i class="fa fa-fw fa-plus text-success"></i>
                                        </div>
                                        <div class="flex-grow-1 fs-sm">
                                            <div class="fw-semibold">New sale! + $119</div>
                                            <small class="text-muted">29 hours ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                        <div class="flex-shrink-0 me-3 ms-2">
                                            <i class="fa fa-fw fa-minus text-danger"></i>
                                        </div>
                                        <div class="flex-grow-1 fs-sm">
                                            <div class="fw-semibold">Paypal Withdrawal - $300</div>
                                            <small class="text-muted">37 hours ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                        <div class="flex-shrink-0 me-3 ms-2">
                                            <i class="fa fa-fw fa-plus text-success"></i>
                                        </div>
                                        <div class="flex-grow-1 fs-sm">
                                            <div class="fw-semibold">New sale! + $129</div>
                                            <small class="text-muted">39 hours ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                        <div class="flex-shrink-0 me-3 ms-2">
                                            <i class="fa fa-fw fa-plus text-success"></i>
                                        </div>
                                        <div class="flex-grow-1 fs-sm">
                                            <div class="fw-semibold">New sale! + $119</div>
                                            <small class="text-muted">45 hours ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                        <div class="flex-shrink-0 me-3 ms-2">
                                            <i class="fa fa-fw fa-plus text-success"></i>
                                        </div>
                                        <div class="flex-grow-1 fs-sm">
                                            <div class="fw-semibold">New sale! + $499</div>
                                            <small class="text-muted">46 hours ago</small>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <div class="text-center">
                                <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                                    <i class="fa fa-arrow-down opacity-50 me-1"></i> Load More..
                                </a>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</aside>
