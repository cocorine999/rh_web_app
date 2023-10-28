@extends('layouts.dashboard')

@section('dash')
<div class="content">
    <div class="row">
      <div class="col-md-5 col-xl-3">
        <div class="d-md-none push">
          <button type="button" class="btn w-100 btn-primary" data-toggle="class-toggle" data-target="#one-inbox-side-nav" data-class="d-none">
            Inbox Menu
          </button>
        </div>
        <div id="one-inbox-side-nav" class="d-none d-md-block push">
          <div class="block block-rounded">
            <div class="block-header block-header-default">
              <h3 class="block-title">Inbox</h3>
              <div class="block-options">
                <button type="button" id="newGroup" class="btn btn-sm btn-alt-primary" data-bs-toggle="modal" data-backdrop="static" data-keyboard="false" data-bs-target="#app-modal">
                  <i class="fa fa-plus me-1 opacity-50"></i> Nouveau groupe
                </button>
              </div>
            </div>
            <div class="block-content">
              <ul class="nav nav-pills flex-column fs-sm push">
                <li class="nav-item my-1">
                  <a class="nav-link d-flex justify-content-between align-items-center active" href="">
                    <span>
                      <i class="fa fa-fw fa-inbox me-1 opacity-50"></i> Inbox
                    </span>
                    <span class="badge rounded-pill bg-black-50">3</span>
                  </a>
                </li>
                <li class="nav-item my-1">
                  <a class="nav-link d-flex justify-content-between align-items-center" href="javascript:void(0)">
                    <span>
                      <i class="fa fa-fw fa-star me-1 opacity-50"></i> Starred
                    </span>
                    <span class="badge rounded-pill bg-black-50">48</span>
                  </a>
                </li>
                <li class="nav-item my-1">
                  <a class="nav-link d-flex justify-content-between align-items-center" href="javascript:void(0)">
                    <span>
                      <i class="fa fa-fw fa-paper-plane me-1 opacity-50"></i> Sent
                    </span>
                    <span class="badge rounded-pill bg-black-50">1480</span>
                  </a>
                </li>
                <li class="nav-item my-1">
                  <a class="nav-link d-flex justify-content-between align-items-center" href="javascript:void(0)">
                    <span>
                      <i class="fa fa-fw fa-pencil-alt me-1 opacity-50"></i> Draft
                    </span>
                    <span class="badge rounded-pill bg-black-50">2</span>
                  </a>
                </li>
                <li class="nav-item my-1">
                  <a class="nav-link d-flex justify-content-between align-items-center" href="javascript:void(0)">
                    <span>
                      <i class="fa fa-fw fa-folder me-1 opacity-50"></i> Archive
                    </span>
                    <span class="badge rounded-pill bg-black-50">1987</span>
                  </a>
                </li>
                <li class="nav-item my-1">
                  <a class="nav-link d-flex justify-content-between align-items-center" href="javascript:void(0)">
                    <span>
                      <i class="fa fa-fw fa-trash-alt me-1 opacity-50"></i> Trash
                    </span>
                    <span class="badge rounded-pill bg-black-50">10</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="block block-rounded">
            <div class="block-header block-header-default">
              <h3 class="block-title">Friends</h3>
              <div class="block-options">
                <button type="button" class="btn-block-option">
                  <i class="si si-settings"></i>
                </button>
              </div>
            </div>
            <div class="block-content">
              <ul class="nav-items fs-sm">
                <li>
                  <a class="d-flex py-2" href="javascript:void(0)">
                    <div class="flex-shrink-0 me-3 ms-2 overlay-container overlay-bottom">
                      <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar3.jpg" alt="">
                      <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                    </div>
                    <div class="flex-grow-1">
                      <div class="fw-semibold">Lori Moore</div>
                      <div class="fw-normal text-muted">Web Designer</div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="d-flex py-2" href="javascript:void(0)">
                    <div class="flex-shrink-0 me-3 ms-2 overlay-container overlay-bottom">
                      <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar14.jpg" alt="">
                      <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                    </div>
                    <div class="flex-grow-1">
                      <div class="fw-semibold">Albert Ray</div>
                      <div class="fw-normal text-muted">Graphic Designer</div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="d-flex py-2" href="javascript:void(0)">
                    <div class="flex-shrink-0 me-3 ms-2 overlay-container overlay-bottom">
                      <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar2.jpg" alt="">
                      <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-warning"></span>
                    </div>
                    <div class="flex-grow-1">
                      <div class="fw-semibold">Danielle Jones</div>
                      <div class="fw-normal text-muted">Photographer</div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="d-flex py-2" href="javascript:void(0)">
                    <div class="flex-shrink-0 me-3 ms-2 overlay-container overlay-bottom">
                      <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar9.jpg" alt="">
                      <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-warning"></span>
                    </div>
                    <div class="flex-grow-1">
                      <div class="fw-semibold">Jose Parker</div>
                      <div class="fw-normal text-muted">Copywriter</div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="d-flex py-2" href="javascript:void(0)">
                    <div class="flex-shrink-0 me-3 ms-2 overlay-container overlay-bottom">
                      <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar12.jpg" alt="">
                      <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-danger"></span>
                    </div>
                    <div class="flex-grow-1">
                      <div class="fw-semibold">David Fuller</div>
                      <div class="fw-normal text-muted">UI designer</div>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="block block-rounded">
            <div class="block-header block-header-default">
              <h3 class="block-title">Account</h3>
              <div class="block-options">
                <button type="button" class="btn-block-option">
                  <i class="si si-settings"></i>
                </button>
              </div>
            </div>
            <div class="block-content">
              <div class="js-pie-chart pie-chart push js-pie-chart-enabled" data-percent="35" data-line-width="3" data-size="100" data-bar-color="#abe37d" data-track-color="#eeeeee" data-scale-color="#dddddd">
                <span>
                  <img class="img-avatar" src="assets/media/avatars/avatar1.jpg" alt="">
                </span>
              <canvas height="100" width="100"></canvas></div>
              <a class="block block-rounded block-bordered block-link-shadow" href="javascript:void(0)">
                <div class="block-content block-content-full text-center">
                  <div class="push">
                    <i class="si si-like fa-2x text-success"></i>
                  </div>
                  <div class="fs-2 fw-bold">
                    <span class="text-muted">+</span> 2.5TB
                  </div>
                  <div class="fs-sm text-muted text-uppercase">Upgrade Now</div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-7 col-xl-9">
        <div class="block block-rounded">
          <div class="block-header block-header-default">
            <h3 class="block-title">
              15-30 <span class="fw-normal text-lowercase">from</span> 700
            </h3>
            <div class="block-options">
              <button type="button" class="btn-block-option js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-placement="left" title="" data-bs-original-title="Previous 15 Messages">
                <i class="si si-arrow-left"></i>
              </button>
              <button type="button" class="btn-block-option js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-placement="left" title="" data-bs-original-title="Next 15 Messages">
                <i class="si si-arrow-right"></i>
              </button>
              <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                <i class="si si-refresh"></i>
              </button>
              <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"><i class="si si-size-fullscreen"></i></button>
            </div>
          </div>
          <div class="block-content py-0">
            <div class="pull-x">
              <table id="conversationsComponent" class="js-table-checkable table table-hover table-vcenter fs-sm js-table-checkable-enabled">
                <thead>
                  <tr>
                    <td colspan="6">
                      <div class="d-flex justify-content-between">
                        <div class="btn-group">
                          <button class="btn btn-sm btn-alt-secondary" onclick="" type="button" id="newMessage" >
                            <i class="fa fa-pencil-alt text-primary"></i>
                            <span class="d-none d-sm-inline ms-1">Nouveau message</span>
                          </button>
                        </div>
                        <form class="d-none d-md-inline-block" action="{{ route('dashboard.messages.filter') }}" method="POST">
                            <div class="input-group input-group-sm">
                              <input type="text" class="form-control form-control-alt" placeholder="Search.." id="search-input-id" name="searchValue">
                              <span class="input-group-text border-0">
                                <i class="fa fa-fw fa-search"></i>
                              </span>
                            </div>
                        </form>
                      </div>
                    </td>
                  </tr>
                </thead>
                <tbody>

                    @foreach ($conversations as $conversation)

                    <tr onclick=" console.log('great');console.log(document.getElementById('#link-{{ $conversation->id }}'));">
                        <a href="{{ route('dashboard.conversations.show',$conversation->id) }}" id="link-{{ $conversation->id }}" style="display: none;"></a>
                        <td class="text-center" style="width: 60px;">
                          <div class="form-check d-inline-block">
                            <input class="form-check-input" type="checkbox" value="" id="conversation-{{ $conversation['id'] }}" name="box-conversation-{{ $conversation['id'] }}">
                            <label class="form-check-label" for="conversation-{{ $conversation['id'] }}"></label>
                          </div>
                        </td>
                        <td class="d-none d-sm-table-cell fw-semibold" style="width: 13%;">

                              <a class="d-flex py-2" href="javascript:void(0)">
                                <div class="flex-shrink-0 ms-2 overlay-container overlay-bottom">
                                    @php
                                        if($conversation->type == 'group'){
                                            $src = optional($conversation->illustration)->url ?? 'assets/media/avatars/avatar10.jpg';
                                        }else {
                                            $src = optional(optional(optional($conversation->interlocuteur)->first())->profile)->url ?? 'assets/media/avatars/avatar10.jpg';
                                        }
                                    @endphp
                                  <img class="img-avatar img-avatar48" src="{{ asset($src) }}" alt="">
                                  <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                                </div>
                              </a>
                        </td>
                        <td>
                            <a class="fw-semibold" href="{{ route('dashboard.conversations.show',$conversation->id) }}">
                                @if($conversation->type=="group")
                                    {{ str_replace('\\', '', $conversation->name) }}
                                @else
                                    {{ str_replace('\\', '', optional(optional($conversation->interlocuteur)->first())->last_name) }}
                                    {{ str_replace('\\', '', optional(optional($conversation->interlocuteur)->first())->first_name) }}
                                @endif
                            </a>
                            <div class="text-muted mt-1">
                                {{ $conversation->last_message->first() != null ? \Str::ucfirst(str_replace('\\', '', $conversation->last_message->first()->content)) : '' }}
                            </div>
                        </td>
                        <td class="d-none d-xl-table-cell text-muted" style="width: 80px;">
                            @if($conversation->last_message->first() != null && count($conversation->last_message->first()->attached_files) != 0)
                                <i class="fa fa-paperclip me-1"></i> ({{count($conversation->last_message->first()->attached_files)}})
                            @endif
                        </td>
                        <td class="d-none d-xl-table-cell text-muted" style="width: 120px;">
                          <em>
                            {{ $conversation->last_message->first() != null ? \Carbon\Carbon::parse($conversation->last_message->first()->created_at)->diffForHumans() : \Carbon\Carbon::parse($conversation->created_at)->diffForHumans() }}
                              {{-- 2 min ago --}}
                            </em>
                        </td>
                      </tr>
                    @endforeach
                  <tr>
                    <td class="text-center" style="width: 60px;">
                      <div class="form-check d-inline-block">
                        <input class="form-check-input" type="checkbox" value="" id="inbox-msg15" name="inbox-msg15">
                        <label class="form-check-label" for="inbox-msg15"></label>
                      </div>
                    </td>
                    <td class="d-none d-sm-table-cell fw-semibold" style="width: 140px;">Scott Young</td>
                    <td>
                      <a class="fw-semibold" data-bs-toggle="modal" data-bs-target="#one-inbox-message" href="#">Welcome to our service</a>
                      <div class="text-muted mt-1">It's a pleasure to have you on our service..</div>
                    </td>
                    <td class="d-none d-xl-table-cell text-muted" style="width: 80px;">
                      <i class="fa fa-paperclip me-1"></i> (3)
                    </td>
                    <td class="d-none d-xl-table-cell text-muted" style="width: 120px;">
                      <em>2 min ago</em>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <div class="form-check d-inline-block">
                        <input class="form-check-input" type="checkbox" value="" id="inbox-msg14" name="inbox-msg14">
                        <label class="form-check-label" for="inbox-msg14"></label>
                      </div>
                    </td>
                    <td class="d-none d-sm-table-cell fw-semibold">Jack Greene</td>
                    <td>
                      <a class="fw-semibold" data-bs-toggle="modal" data-bs-target="#one-inbox-message" href="#">Your subscription was updated</a>
                      <div class="text-muted mt-1">We are glad you decided to go with a vip..</div>
                    </td>
                    <td class="d-none d-xl-table-cell text-muted">
                      <i class="fa fa-paperclip me-1"></i> (2)
                    </td>
                    <td class="d-none d-xl-table-cell text-muted">
                      <em>10 min ago</em>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <div class="form-check d-inline-block">
                        <input class="form-check-input" type="checkbox" value="" id="inbox-msg13" name="inbox-msg13">
                        <label class="form-check-label" for="inbox-msg13"></label>
                      </div>
                    </td>
                    <td class="d-none d-sm-table-cell fw-semibold">Jose Wagner</td>
                    <td>
                      <a class="fw-semibold" data-bs-toggle="modal" data-bs-target="#one-inbox-message" href="#">Update is available</a>
                      <div class="text-muted mt-1">An update is under way for your app..</div>
                    </td>
                    <td class="d-none d-xl-table-cell text-muted"></td>
                    <td class="d-none d-xl-table-cell text-muted">
                      <em>25 min ago</em>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <div class="form-check d-inline-block">
                        <input class="form-check-input" type="checkbox" value="" id="inbox-msg12" name="inbox-msg12">
                        <label class="form-check-label" for="inbox-msg12"></label>
                      </div>
                    </td>
                    <td class="d-none d-sm-table-cell fw-semibold">Judy Ford</td>
                    <td>
                      <a class="fw-semibold" data-bs-toggle="modal" data-bs-target="#one-inbox-message" href="#">New Sale!</a>
                      <div class="text-muted mt-1">You had a new sale and earned..</div>
                    </td>
                    <td class="d-none d-xl-table-cell text-muted">
                      <i class="fa fa-paperclip me-1"></i> (1)
                    </td>
                    <td class="d-none d-xl-table-cell text-muted">
                      <em>30 min ago</em>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <div class="form-check d-inline-block">
                        <input class="form-check-input" type="checkbox" value="" id="inbox-msg11" name="inbox-msg11">
                        <label class="form-check-label" for="inbox-msg11"></label>
                      </div>
                    </td>
                    <td class="d-none d-sm-table-cell fw-semibold">Carol White</td>
                    <td>
                      <a class="fw-semibold" data-bs-toggle="modal" data-bs-target="#one-inbox-message" href="#">Action Required for your account!</a>
                      <div class="text-muted mt-1">Your account is inactive for a long time and..</div>
                    </td>
                    <td class="d-none d-xl-table-cell text-muted"></td>
                    <td class="d-none d-xl-table-cell text-muted">
                      <em>1 hour ago</em>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <div class="form-check d-inline-block">
                        <input class="form-check-input" type="checkbox" value="" id="inbox-msg10" name="inbox-msg10">
                        <label class="form-check-label" for="inbox-msg10"></label>
                      </div>
                    </td>
                    <td class="d-none d-sm-table-cell fw-semibold">Sara Fields</td>
                    <td>
                      <a class="fw-semibold" data-bs-toggle="modal" data-bs-target="#one-inbox-message" href="#">New Photo Pack!</a>
                      <div class="text-muted mt-1">Our new photo pack is available now! You..</div>
                    </td>
                    <td class="d-none d-xl-table-cell text-muted"></td>
                    <td class="d-none d-xl-table-cell text-muted">
                      <em>2 hrs ago</em>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <div class="form-check d-inline-block">
                        <input class="form-check-input" type="checkbox" value="" id="inbox-msg9" name="inbox-msg9">
                        <label class="form-check-label" for="inbox-msg9"></label>
                      </div>
                    </td>
                    <td class="d-none d-sm-table-cell fw-semibold">Jeffrey Shaw</td>
                    <td>
                      <a class="fw-semibold" data-bs-toggle="modal" data-bs-target="#one-inbox-message" href="#">Product is released!</a>
                      <div class="text-muted mt-1">This is a notification about our new product..</div>
                    </td>
                    <td class="d-none d-xl-table-cell text-muted">
                      <i class="fa fa-paperclip me-1"></i> (1)
                    </td>
                    <td class="d-none d-xl-table-cell text-muted">
                      <em>1 day ago</em>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <div class="form-check d-inline-block">
                        <input class="form-check-input" type="checkbox" value="" id="inbox-msg8" name="inbox-msg8">
                        <label class="form-check-label" for="inbox-msg8"></label>
                      </div>
                    </td>
                    <td class="d-none d-sm-table-cell fw-semibold">Carol Ray</td>
                    <td>
                      <a class="fw-semibold" data-bs-toggle="modal" data-bs-target="#one-inbox-message" href="#">Now on Sale!</a>
                      <div class="text-muted mt-1">Our Book is out! You can buy a copy and..</div>
                    </td>
                    <td class="d-none d-xl-table-cell text-muted">
                      <i class="fa fa-paperclip me-1"></i> (9)
                    </td>
                    <td class="d-none d-xl-table-cell text-muted">
                      <em>1 day ago</em>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <div class="form-check d-inline-block">
                        <input class="form-check-input" type="checkbox" value="" id="inbox-msg7" name="inbox-msg7">
                        <label class="form-check-label" for="inbox-msg7"></label>
                      </div>
                    </td>
                    <td class="d-none d-sm-table-cell fw-semibold">Judy Ford</td>
                    <td>
                      <a class="fw-semibold" data-bs-toggle="modal" data-bs-target="#one-inbox-message" href="#">Monthly Report</a>
                      <div class="text-muted mt-1">The monthly report you requested for..</div>
                    </td>
                    <td class="d-none d-xl-table-cell text-muted">
                      <i class="fa fa-paperclip me-1"></i> (6)
                    </td>
                    <td class="d-none d-xl-table-cell text-muted">
                      <em>3 days ago</em>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <div class="form-check d-inline-block">
                        <input class="form-check-input" type="checkbox" value="" id="inbox-msg6" name="inbox-msg6">
                        <label class="form-check-label" for="inbox-msg6"></label>
                      </div>
                    </td>
                    <td class="d-none d-sm-table-cell fw-semibold">Barbara Scott</td>
                    <td>
                      <a class="fw-semibold" data-bs-toggle="modal" data-bs-target="#one-inbox-message" href="#">Trial Started!</a>
                      <div class="text-muted mt-1">You 30-day trial has now started and..</div>
                    </td>
                    <td class="d-none d-xl-table-cell text-muted"></td>
                    <td class="d-none d-xl-table-cell text-muted">
                      <em>3 days ago</em>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <div class="form-check d-inline-block">
                        <input class="form-check-input" type="checkbox" value="" id="inbox-msg5" name="inbox-msg5">
                        <label class="form-check-label" for="inbox-msg5"></label>
                      </div>
                    </td>
                    <td class="d-none d-sm-table-cell fw-semibold">Wayne Garcia</td>
                    <td>
                      <a class="fw-semibold" data-bs-toggle="modal" data-bs-target="#one-inbox-message" href="#">Invoice #INV001645</a>
                      <div class="text-muted mt-1">This is the invoice for the project we..</div>
                    </td>
                    <td class="d-none d-xl-table-cell text-muted"></td>
                    <td class="d-none d-xl-table-cell text-muted">
                      <em>5 days ago</em>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <div class="form-check d-inline-block">
                        <input class="form-check-input" type="checkbox" value="" id="inbox-msg4" name="inbox-msg4">
                        <label class="form-check-label" for="inbox-msg4"></label>
                      </div>
                    </td>
                    <td class="d-none d-sm-table-cell fw-semibold">Marie Duncan</td>
                    <td>
                      <a class="fw-semibold" data-bs-toggle="modal" data-bs-target="#one-inbox-message" href="#">Friend Request!</a>
                      <div class="text-muted mt-1">You have a new friend request. Click the..</div>
                    </td>
                    <td class="d-none d-xl-table-cell text-muted">
                      <i class="fa fa-paperclip me-1"></i> (5)
                    </td>
                    <td class="d-none d-xl-table-cell text-muted">
                      <em>1 week ago</em>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <div class="form-check d-inline-block">
                        <input class="form-check-input" type="checkbox" value="" id="inbox-msg3" name="inbox-msg3">
                        <label class="form-check-label" for="inbox-msg3"></label>
                      </div>
                    </td>
                    <td class="d-none d-sm-table-cell fw-semibold">Carol White</td>
                    <td>
                      <a class="fw-semibold" data-bs-toggle="modal" data-bs-target="#one-inbox-message" href="#">Enjoy life!</a>
                      <div class="text-muted mt-1">Thank you for helping us with our cause...</div>
                    </td>
                    <td class="d-none d-xl-table-cell text-muted">
                      <i class="fa fa-paperclip me-1"></i> (3)
                    </td>
                    <td class="d-none d-xl-table-cell text-muted">
                      <em>1 week ago</em>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <div class="form-check d-inline-block">
                        <input class="form-check-input" type="checkbox" value="" id="inbox-msg2" name="inbox-msg2">
                        <label class="form-check-label" for="inbox-msg2"></label>
                      </div>
                    </td>
                    <td class="d-none d-sm-table-cell fw-semibold">Thomas Riley</td>
                    <td>
                      <a class="fw-semibold" data-bs-toggle="modal" data-bs-target="#one-inbox-message" href="#">New Twitter follower!</a>
                      <div class="text-muted mt-1">You have a new follower, congratulations..</div>
                    </td>
                    <td class="d-none d-xl-table-cell text-muted">
                      <i class="fa fa-paperclip me-1"></i> (1)
                    </td>
                    <td class="d-none d-xl-table-cell text-muted">
                      <em>2 weeks ago</em>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">
                      <div class="form-check d-inline-block">
                        <input class="form-check-input" type="checkbox" value="" id="inbox-msg1" name="inbox-msg1">
                        <label class="form-check-label" for="inbox-msg1"></label>
                      </div>
                    </td>
                    <td class="d-none d-sm-table-cell fw-semibold">Henry Harrison</td>
                    <td>
                      <a class="fw-semibold" data-bs-toggle="modal" data-bs-target="#one-inbox-message" href="#">Huge Discount available!</a>
                      <div class="text-muted mt-1">Due to the fact that you are a great..</div>
                    </td>
                    <td class="d-none d-xl-table-cell text-muted"></td>
                    <td class="d-none d-xl-table-cell text-muted">
                      <em>3 weeks ago</em>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="one-inbox-message" tabindex="-1" role="dialog" aria-labelledby="one-inbox-message" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-popout" role="document">
        <div class="modal-content">
          <div class="block block-rounded block-transparent mb-0">
            <div class="block-header block-header-default">
              <h3 class="block-title">Welcome to our service</h3>
              <div class="block-options">
                <button type="button" class="btn-block-option js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-placement="left" title="" aria-label="Reply" data-bs-original-title="Reply">
                  <i class="fa fa-fw fa-reply"></i>
                </button>
                <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                  <i class="fa fa-fw fa-times"></i>
                </button>
              </div>
            </div>
            <div class="block-content block-content-full text-center bg-image" style="background-image: url('assets/media/photos/photo7.jpg');">
              <img class="img-avatar img-avatar96 img-avatar-thumb" src="assets/media/avatars/avatar4.jpg" alt="">
            </div>
            <div class="block-content block-content-full fs-sm d-flex justify-content-between bg-body-light">
              <a href="javascript:void(0)">user@example.com</a>
              <span class="text-muted"><em>2 min ago</em></span>
            </div>
            <div class="block-content">
              <p>Dear John,</p>
              <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
              <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
              <p>Best Regards,</p>
              <p>Amber Harvey</p>
            </div>
            <div class="block-content bg-body-light">
              <div class="row g-sm items-push fs-sm">
                <div class="col-md-4">
                  <div class="options-container fx-item-zoom-in mb-2">
                    <img class="img-fluid options-item" src="assets/media/photos/photo1.jpg" alt="">
                    <div class="options-overlay bg-black-75">
                      <div class="options-overlay-content">
                        <a class="btn btn-sm btn-light" href="javascript:void(0)">
                          <i class="fa fa-download me-1"></i> Download
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="text-muted">01.jpg (350kb)</div>
                </div>
                <div class="col-md-4">
                  <div class="options-container fx-item-zoom-in mb-2">
                    <img class="img-fluid options-item" src="assets/media/photos/photo2.jpg" alt="">
                    <div class="options-overlay bg-black-75">
                      <div class="options-overlay-content">
                        <a class="btn btn-sm btn-light" href="javascript:void(0)">
                          <i class="fa fa-download me-1"></i> Download
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="text-muted">02.jpg (480kb)</div>
                </div>
                <div class="col-md-4">
                  <div class="options-container fx-item-zoom-in mb-2">
                    <img class="img-fluid options-item" src="assets/media/photos/photo3.jpg" alt="">
                    <div class="options-overlay bg-black-75">
                      <div class="options-overlay-content">
                        <a class="btn btn-sm btn-light" href="javascript:void(0)">
                          <i class="fa fa-download me-1"></i> Download
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="text-muted">03.jpg (652kb)</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection



@section('form-content')

<div id="groupDIV" style="display: none;">
    <div class="mb-4">
        <label class="form-label" for="group-name">Nom du groupe</label>
        <input class="form-control form-control-alt" type="text" id="group-name" name="name">
    </div>

    <div class="mb-4">
        <label class="form-label" for="group-descrition">Bref description du groupe</label>
        <textarea class="form-control form-control-alt" cols="30" rows="2" id="group-descrition" name="details"></textarea>
    </div>

    <div>
        <ul class="nav-items fs-sm" style="list-style-type:none; display:inline-block;">
            @foreach ($users->where('id','!=',auth()->id()) as $user)
                <li style="list-style-type:none; display:inline-block;">
                    <a class="d-flex py-3" style="border-bottom:0px;" href="javascript:void(0)" onclick="document.getElementById('group-members-{{ $user->id }}').checked = !document.getElementById('group-members-{{ $user->id }}').checked; ">
                        <div class="flex-shrink-0 me-3 ms-2 overlay-container overlay-bottom">
                            <img class="img-avatar img-avatar48" src="{{ asset(optional($user->profile)->url ?? 'assets/media/avatars/avatar10.jpg') }}" alt="">
                            <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-semibold fs-sm" style="font-size:.8rem!important;">{{ str_replace('\\', '', $user->last_name) }}
                                {{ str_replace('\\', '', $user->first_name) }}
                            </div>
                            <div class="fw-normal fs-sm text-muted" style="font-size:.8rem!important;">
                                @foreach ($user->user_actual_poste as $poste)
                                    {{ \Str::upper(str_replace('\\', '', $poste->name)) }}
                                    @if ($user->user_actual_poste->last() != $poste)
                                        /
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="flex-shrink-0 me-3 ms-5 overlay-container overlay-bottom">

                            <input class="form-check-input" type="checkbox" name="group_members[]" value="{{ $user->id }}"
                            id="group-members-{{ $user->id }}">
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
<div id="messageDIV" style="display: block;">

    <div class="mb-4">
        <label class="form-label" for="group-descrition">Bref description du groupe</label>
        <textarea class="form-control form-control-alt" cols="30" rows="2" id="group-descrition" name="content"></textarea>
    </div>

    <input type="hidden" name="group_id" >

    <div>
        <ul class="nav-items fs-sm" style="list-style-type:none; display:inline-block;">
            @foreach ($users->where('id','!=',auth()->id()) as $user)
                <li style="list-style-type:none; display:inline-block;">
                    <a class="d-flex py-3" style="border-bottom:0px;" href="javascript:void(0)" onclick="document.getElementById('to-{{ $user->id }}').checked = !document.getElementById('to-{{ $user->id }}').checked; ">
                        <div class="flex-shrink-0 me-3 ms-2 overlay-container overlay-bottom">
                            <img class="img-avatar img-avatar48" src="{{ asset(optional($user->profile)->url ?? 'assets/media/avatars/avatar10.jpg') }}" alt="">
                            <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-semibold fs-sm" style="font-size:.8rem!important;">{{ str_replace('\\', '', $user->last_name) }}
                                {{ str_replace('\\', '', $user->first_name) }}
                            </div>
                            <div class="fw-normal fs-sm text-muted" style="font-size:.8rem!important;">
                                @foreach ($user->user_actual_poste as $poste)
                                    {{ \Str::upper(str_replace('\\', '', $poste->name)) }}
                                    @if ($user->user_actual_poste->last() != $poste)
                                        /
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="flex-shrink-0 me-3 ms-5 overlay-container overlay-bottom">

                            <input class="form-check-input" type="radio" name="to[]" value="{{ $user->id }}"
                            id="to-{{ $user->id }}">
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection

@push('js')

    <script>
        document.getElementById("bar").style.display = "none";
    </script>

<script>

    $(document).ready(function() {

            // ADD NEW GROUP ONCLICK FUNCTION

            $('body').on('click', '#newGroup', function(event) {

                event.preventDefault();
                $('#app-modal-form').load(location.href + ' #app-modal-form>*', '');

                document.getElementById('app-modal-form-method').innerHTML = '';

                document.getElementById('app-modal-form').setAttribute('action',
                    '{{ route('dashboard.conversations.store') }}');

                document.getElementById('app-modal-form').setAttribute('method', "POST");

                document.getElementById('app-modal-title').innerHTML = 'CRÉATION D\'UN NOUVEAU GROUPE';

                $('.app-modal-submit-btn-title').html('CRÉER');


                $('#app-modal').hide();

                $('#app-modal').show();

                document.getElementById("groupDIV").style.display='block';

            });
            // ADD NEW MESSAGE ONCLICK FUNCTION

            $('body').on('click', '#newMessage', function(event) {
                console.log("cool");
                event.preventDefault();
                $('#app-modal-form').load(location.href + ' #app-modal-form>*', '');

                $('#app-modal').modal('show');

                document.getElementById('app-modal-form-method').innerHTML = '';

                document.getElementById('app-modal-form').setAttribute('action',
                    '{{ route('dashboard.messages.store') }}');

                document.getElementById('app-modal-form').setAttribute('method', "POST");

                document.getElementById('app-modal-title').innerHTML = 'ENVOIE D\'UN NOUVEAU MESSAGE';

                $('.app-modal-submit-btn-title').html('ENVOYER');

                document.getElementById("messageDIV").style.display='block';

            });



            //SUBMIT FORM ONCLICK FUNCTION

            $('body').on('click', '#app-modal-submit-btn', function(event) {

            var formData = {};

            var members= []

            var formData2 = $('#app-modal-form').serializeArray();

            $.each(formData2, function (i, data) {
                if(data.name == 'details'){
                    formData['description'] = data.value;
                }
                else if(data.name == 'group_members[]'){
                    members.push(data.value);
                }else{
                    formData[data.name] = data.value;
                }
            });

            formData["group_members[]"] = members;

            //Reset input errors message
            $('input+small').text('');

            $('input').parent().removeClass('has-error');

            // send request
            $.ajax({
                    url: $('#app-modal-form').attr('action'),
                    type: $('#app-modal-form').attr('method'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,

                    dataType: 'json',

                }).done(function(data) {

                    console.log(data);

                    //request is succed
                    $('.alert-success').removeClass('hidden');

                    //refresh table with new data
                    $('#conversationsComponent').load(location.href + ' #conversationsComponent>*', '');

                    //Hide modal
                    $('#app-modal').modal('hide');

                    //alert(data.message);

                })
                .fail(function(data) {
                    console.log(data);

                    // set each errors message to corresponding input
                    $.each(data.responseJSON.errors, function(key, value) {

                        var input = '#app-modal input[name=' + key + ']';

                        $(input + '+small').text(value);

                        $(input).parent().addClass('has-error');

                    });

                });
            });


        $('body').on('click', '#discussions-modal-submit-btn', function(event) {
            console.log("submit");
            var formData = {};
            var members= []
            var formData2 = $('#discussions-modal-form').serializeArray();
            console.log(formData2);

            $.each(formData2, function (i, data) {
                if(data.name == 'details'){
                    formData['description'] = data.value;
                }
                else if(data.name == 'group_members[]'){
                    members.push(data.value);
                }else{
                    formData[data.name] = data.value;
                }
            });
            formData["group_members[]"] = members;

            $.ajax({
                url: $('#discussions-modal-form').attr('action'),
                type:  $('#discussions-modal-form').attr('method'),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    name : formData.name,
                    description : formData.description,
                },
                dataType: 'json',

            }).done(function(data) {
                //$('.alert-success').removeClass('hidden');
                //$('#discussions-modal').modal('hide');
                //$('#conversationsComponent').load(location.href + ' #conversationsComponent>*', '');
                //window.location.reload(true);
            })
            .fail(function(data) {
                $.each(data.responseJSON.errors, function(key, value) {
                    var input = '#discussions-modal input[name=' + key + ']';
                    $(input + '+small').text(value);
                    $(input).parent().addClass('has-error');
                });
            });

        });

        $('#discussions-modal').modal({
                backdrop: 'static',
                keyboard: false // to prevent closing with Esc button (if you want this too)
            });
    });
</script>


@endpush
