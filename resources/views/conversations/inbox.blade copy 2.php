@extends('layouts.app')

@push('css')
<link rel="stylesheet" id="css-main" href="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css">
@endpush

@section('content')

    <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed">

        @include('conversations.sidebar')
        @include('conversations.header')


        <main id="main-container">
            <div class="content">
                <div class="row">
                    {{-- <div class="col-md-3 col-xl-3">
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
                                        <button type="button" class="btn btn-sm btn-alt-primary" data-bs-toggle="modal" data-bs-target="#one-inbox-new-message">
                                            <i class="fa fa-pencil-alt me-1 opacity-50"></i> Compose
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
                                    <div class="js-pie-chart pie-chart push" data-percent="35" data-line-width="3" data-size="100" data-bar-color="#abe37d" data-track-color="#eeeeee" data-scale-color="#dddddd">
                                        <span>
                                            <img class="img-avatar" src="assets/media/avatars/avatar1.jpg" alt="">
                                        </span>
                                    </div>
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
                    </div> --}}
                    <div class="col-md-9 col-xl-9">
                        <div class="block block-rounded">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">
                                    15-30 <span class="fw-normal text-lowercase">from</span> 700
                                </h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-bs-toggle="tooltip" data-bs-placement="left" title="Previous 15 Messages">
                                        <i class="si si-arrow-left"></i>
                                    </button>
                                    <button type="button" class="btn-block-option" data-bs-toggle="tooltip" data-bs-placement="left" title="Next 15 Messages">
                                        <i class="si si-arrow-right"></i>
                                    </button>
                                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                        <i class="si si-refresh"></i>
                                    </button>
                                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                                </div>
                            </div>
                            <div class="block-content py-0">
                                <div class="pull-x">
                                    <table class="js-table-checkable table table-hover table-vcenter fs-sm">
                                        <thead>
                                            <tr>
                                                <td class="text-center">
                                                    <div class="form-check d-inline-block">
                                                        <input class="form-check-input" type="checkbox" value="" id="inbox-msg15" name="inbox-msg-all">
                                                        <label class="form-check-label" for="inbox-msg-all"></label>
                                                    </div>
                                                </td>
                                                <td colspan="4">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="btn-group">
                                                            <button class="btn btn-sm btn-alt-secondary" type="button">
                                                                <i class="fa fa-archive text-primary"></i>
                                                                <span class="d-none d-sm-inline ms-1">Archive</span>
                                                            </button>
                                                            <button class="btn btn-sm btn-alt-secondary" type="button">
                                                                <i class="fa fa-star text-warning"></i>
                                                                <span class="d-none d-sm-inline ms-1">Star</span>
                                                            </button>
                                                        </div>
                                                        <button class="btn btn-sm btn-alt-secondary" type="button">
                                                            <i class="fa fa-times text-danger"></i>
                                                            <span class="d-none d-sm-inline ms-1">Delete</span>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
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

                    <div class="col-md-3 col-xl-3">
                        <div class="block block-rounded">
                            <div>
                            <div class="content-header border-bottom " style="padding-left:4px; padding-right:4px; ">
                                <a class="img-link me-1" href="javascript:void(0)">
                                    <img class="img-avatar img-avatar32" src="{{ asset('assets/media/avatars/avatar10.jpg') }}" alt="">
                                </a>
                                <div class="ms-2">
                                    <a class="text-dark fw-semibold fs-sm" href="javascript:void(0)">John Smith</a>
                                </div>
                                <a class="ms-auto btn btn-sm btn-alt-danger" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_close">
                                    <i class="fa fa-fw fa-times"></i>
                                </a>
                            </div>
                            <div class="content-side">
                                <div class="block block-transparent pull-x pull-t">
                                    <ul class="nav nav-tabs nav-tabs-block nav-justified" role="tablist">
                                        <li class="nav-item">
                                            <button type="button" class="nav-link active" id="so-overview-tab" data-bs-toggle="tab" data-bs-target="#so-overview" role="tab" aria-controls="so-overview" aria-selected="true">
                                                <i class="fa fa-fw fa-coffee text-gray opacity-75 me-1"></i> Overview
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="block-content tab-content overflow-hidden">
                                        <div class="tab-pane pull-x fade fade-left show active" id="so-overview" role="tabpanel" aria-labelledby="so-overview-tab">
                                            <div class="block block-transparent">
                                                <div class="block-header block-header-default">
                                                    <h3 class="block-title">Recent Activity</h3>
                                                    <div class="block-options">
                                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                                            <i class="si si-refresh"></i>
                                                        </button>
                                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                                                    </div>
                                                </div>
                                                <div class="block-content">
                                                    <ul class="nav-items mb-0">
                                                        <li>
                                                            <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                                                <div class="flex-shrink-0 me-3 ms-2">
                                                                    <i class="fa fa-fw fa-plus text-success"></i>
                                                                </div>
                                                                <div class="flex-grow-1 fs-sm">
                                                                    <div class="fw-semibold">New sale ($15)</div>
                                                                    <div>Admin Template</div>
                                                                    <small class="text-muted">3 min ago</small>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                                                <div class="flex-shrink-0 me-3 ms-2">
                                                                    <i class="fa fa-fw fa-pencil-alt text-info"></i>
                                                                </div>
                                                                <div class="flex-grow-1 fs-sm">
                                                                    <div class="fw-semibold">You edited the file</div>
                                                                    <div>Documentation.doc</div>
                                                                    <small class="text-muted">15 min ago</small>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                                                <div class="flex-shrink-0 me-3 ms-2">
                                                                    <i class="fa fa-fw fa-trash text-danger"></i>
                                                                </div>
                                                                <div class="flex-grow-1 fs-sm">
                                                                    <div class="fw-semibold">Project deleted</div>
                                                                    <div>Line Icon Set</div>
                                                                    <small class="text-muted">4 hours ago</small>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="block block-transparent">
                                                <div class="block-header block-header-default">
                                                    <h3 class="block-title">Online Friends</h3>
                                                    <div class="block-options">
                                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                                            <i class="si si-refresh"></i>
                                                        </button>
                                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                                                    </div>
                                                </div>
                                                <div class="block-content">
                                                    <ul class="nav-items mb-0">
                                                        <li>
                                                            <a class="d-flex py-2" href="javascript:void(0)">
                                                                <div class="me-3 ms-2 overlay-container overlay-bottom">
                                                                    <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar2.jpg" alt="">
                                                                    <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                                                                </div>
                                                                <div class="flex-grow-1 fs-sm">
                                                                    <div class="fw-semibold">Amber Harvey</div>
                                                                    <div class="text-muted">Copywriter</div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="d-flex py-2" href="javascript:void(0)">
                                                                <div class="me-3 ms-2 overlay-container overlay-bottom">
                                                                    <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar13.jpg" alt="">
                                                                    <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                                                                </div>
                                                                <div class="flex-grow-1 fs-sm">
                                                                    <div class="fw-semibold">Wayne Garcia</div>
                                                                    <div class="text-muted">Web Developer</div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="d-flex py-2" href="javascript:void(0)">
                                                                <div class="me-3 ms-2 overlay-container overlay-bottom">
                                                                    <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar7.jpg" alt="">
                                                                    <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                                                                </div>
                                                                <div class="flex-grow-1 fs-sm">
                                                                    <div class="fw-semibold">Lisa Jenkins</div>
                                                                    <div class="text-muted">Web Designer</div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="d-flex py-2" href="javascript:void(0)">
                                                                <div class="me-3 ms-2 overlay-container overlay-bottom">
                                                                    <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar8.jpg" alt="">
                                                                    <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-warning"></span>
                                                                </div>
                                                                <div class="flex-grow-1 fs-sm">
                                                                    <div class="fw-semibold">Megan Fuller</div>
                                                                    <div class="text-muted">Photographer</div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="d-flex py-2" href="javascript:void(0)">
                                                                <div class="me-3 ms-2 overlay-container overlay-bottom">
                                                                    <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar14.jpg" alt="">
                                                                    <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-warning"></span>
                                                                </div>
                                                                <div class="flex-grow-1 fs-sm">
                                                                    <div class="fw-semibold">Carl Wells</div>
                                                                    <div class="text-muted">Graphic Designer</div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="block block-transparent mb-0">
                                                <div class="block-header block-header-default">
                                                    <h3 class="block-title">Quick Settings</h3>
                                                    <div class="block-options">
                                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                                                    </div>
                                                </div>
                                                <div class="block-content">
                                                    <form action="be_pages_dashboard.html" method="POST" onsubmit="return false;">
                                                        <div class="mb-4">
                                                            <p class="fs-sm fw-semibold mb-2">
                                                                Online Status
                                                            </p>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" value="" id="so-settings-check1" name="so-settings-check1" checked>
                                                                <label class="form-check-label fs-sm" for="so-settings-check1">Show your status to all</label>
                                                            </div>
                                                        </div>
                                                        <div class="mb-4">
                                                            <p class="fs-sm fw-semibold mb-2">
                                                                Auto Updates
                                                            </p>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" value="" id="so-settings-check2" name="so-settings-check2" checked>
                                                                <label class="form-check-label fs-sm" for="so-settings-check2">Keep up to date</label>
                                                            </div>
                                                        </div>
                                                        <div class="mb-4">
                                                            <p class="fs-sm fw-semibold mb-1">
                                                                Application Alerts
                                                            </p>
                                                            <div class="space-y-2">
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" type="checkbox" value="" id="so-settings-check3" name="so-settings-check3" checked>
                                                                    <label class="form-check-label fs-sm" for="so-settings-check3">Email Notifications</label>
                                                                </div>
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" type="checkbox" value="" id="so-settings-check4" name="so-settings-check4" checked>
                                                                    <label class="form-check-label fs-sm" for="so-settings-check4">SMS Notifications</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-4">
                                                            <p class="fs-sm fw-semibold mb-1">
                                                                API
                                                            </p>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" value="" id="so-settings-check5" name="so-settings-check5" checked>
                                                                <label class="form-check-label fs-sm" for="so-settings-check5">Enable access</label>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>


        <footer id="page-footer" class="bg-body-light">
            <div class="content py-3">
                <div class="row font-size-sm">
                    <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-right">
                        RH APP <i class="fa fa-heart text-danger"></i> by <a class="font-w600" href="cfa_empire.com"
                            target="_blank">cfaempire</a>
                    </div>
                </div>
            </div>
        </footer>


    </div>

    <div class="modal fade" id="one-modal-apps" tabindex="-1" role="dialog" aria-labelledby="one-modal-apps"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-top modal-sm" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Apps</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row gutters-tiny">
                            <div class="col-6">
                                <a class="block block-rounded block-themed bg-default" href="javascript:void(0)">
                                    <div class="block-content text-center">
                                        <i class="si si-speedometer fa-2x text-white-75"></i>
                                        <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                            CRM
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6">
                                <a class="block block-rounded block-themed bg-danger" href="javascript:void(0)">
                                    <div class="block-content text-center">
                                        <i class="si si-rocket fa-2x text-white-75"></i>
                                        <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                            Products
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6">
                                <a class="block block-rounded block-themed bg-success mb-0" href="javascript:void(0)">
                                    <div class="block-content text-center">
                                        <i class="si si-plane fa-2x text-white-75"></i>
                                        <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                            Sales
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6">
                                <a class="block block-rounded block-themed bg-warning mb-0" href="javascript:void(0)">
                                    <div class="block-content text-center">
                                        <i class="si si-wallet fa-2x text-white-75"></i>
                                        <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                            Payments
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="app-modal" tabindex="-1" role="dialog" aria-labelledby="app-modal" aria-hidden="true">
        <div class="modal-dialog app-modal-class modal-md" id="app-modal-class" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title" id="app-modal-title">Modal Title</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close" onclick="$('#app-modal-form')[0].reset();">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">

                        <form id="app-modal-form" method="POST" action="">
                            @csrf

                            <p id="app-modal-form-method"></p>

                            @yield('form-content')

                        </form>

                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" onclick="$('#app-modal-form')[0].reset();" class="btn btn-sm btn-alt-secondary me-1"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary app-modal-submit-btn-title"
                            id="app-modal-submit-btn">Valider</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')


@endpush
