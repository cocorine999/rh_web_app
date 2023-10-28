@extends('layouts.dashboard')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/js/plugins/magnific-popup/magnific-popup.css') }}">
<style>
    textarea {
        padding: 10px;
        margin-top: 8px;
        /*
                box-sizing: padding-box;
                overflow:hidden;
                demo only:
                padding:10px;
                width:250px;
                font-size:14px;
                margin:50px auto;
                display:block;
                border-radius:10px;
                border:6px solid #556677;
            */
    }

</style>
@endpush

@section('dash')
<div class="content">

    <div class="block block-rounded js-animation-section">
        <div class="block-header block-header-default">
            <h3 class="block-title">Hey all! I just signed up!</h3>
            <div class="block-options">
                <a class="btn-block-option me-2" href="#forum-reply-form">
                    <i class="fa fa-reply me-1"></i> Reply
                </a>
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"><i class="si si-size-fullscreen"></i></button>
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                    <i class="si si-refresh"></i>
                </button>
            </div>
        </div>
        <div class="block-content">
            <table class="table table-borderless " id="tableID">
                <tbody>

                    @foreach ($messages->sortBy('created_at') as $message)

                    @if ($message->author->id == auth()->id())
                    <tr class="bg-body-light">
                        <td class="fs-sm text-muted" colspan="12" style="text-align: right;">
                            <a class="fw-semibold" href="{{ route('dashboard.profile',$message->author->id) }}">
                                {{ str_replace('\\', '', $message->author->last_name) }}
                                {{ str_replace('\\', '', $message->author->first_name) }}
                            </a>
                        </td>
                    </tr>
                    <tr class="" id="parent-{{ $message->id }}">
                        <td colspan="12" style="text-align: right;{{ $message->parent ? ' padding-left: 0px!important;padding-right: 0px!important;' :'' }}">
                            @if($message->parent)
                            <div class="d-flex fs-sm" style="background-color: #f0f0f0; padding:10px;">

                                <div class="flex-grow-1" onclick=" $('html,body').animate({ scrollTop: document.getElementById('parent-{{ optional($message->parent)->id }}').offsetTop }, 'fast'); $('#parent-{{optional($message->parent)->id }}').fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);">
                                    <p>
                                        <a class="fw-semibold" href="javascript:void(0)">{{ str_replace('\\', '', $message->parent->author->last_name) }}
                                            {{ str_replace('\\', '', $message->parent->author->first_name) }}</a>
                                        <p>{!! str_replace('\\', '', $message->parent->content) !!}</p>
                                    </p>
                                </div>

                            </div>
                            <p style="border-style: solid;border-block-color: #f0f0f0;padding:10px;">{!! str_replace('\\', '', $message->content) !!}</p>


                            <div id="divID" dir="rtl" class="row text-right g-sm items-push js-gallery push">
                                @foreach ($message->attached_files as $file)
                                @if (strpos($file->url, '.png') || strpos($file->url, '.jpeg') || strpos($file->url, '.jpg'))
                                <div class="col-md-2 col-lg-2 col-xl-2 col-xs-2 animated fadeIn">
                                    <div class="options-container fx-item-rotate-r" style="border: 4px solid #d9e2e6; border-radius: .4rem;">
                                        <img class="img-fluid options-item" src="{{ asset($file->url) }}" alt="">
                                        <div class="options-overlay bg-black-75">
                                            <div class="options-overlay-content">
                                                <h3 class="h4 fw-normal text-white mb-1"></h3>
                                                <h4 class="h6 fw-normal text-white-75 mb-3"></h4>
                                                <a class="btn btn-sm btn-primary img-lightbox mb-2" href="{{ asset($file->url) }}">
                                                    <i class="fa fa-search-plus me-1"></i> View
                                                </a>

                                                <a class="btn btn-sm btn-secondary mb-2" href="javascript:void(0)" onclick="event.preventDefault(); detachFile({{ $file->id }});">
                                                    <i class="fa fa-times-alt me-1"></i> Supprimer
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="col-md-2 col-lg-2 col-xl-2 col-xs-2 animated fadeIn">
                                    <div class="options-container fx-item-rotate-r" style="border: 4px solid #d9e2e6; border-radius: .4rem;">
                                        <a class="img-link img-link-zoom-in img-thumb text-center" style="height: 277px; width: 277px;" href="{{ asset($file->url) }}" target="{{ asset($file->url) }}">
                                            @if (strpos($file->url, '.pdf'))
                                            <i class="far fa-fw fa-file-pdf"></i>
                                            @elseif(strpos($file->url, '.txt'))
                                            <i class="far fa-fw fa-file-alt"></i>
                                            @elseif(strpos($file->url, '.zip') || strpos($file->url, '.tar'))
                                            <i class="far fa-fw fa-file-archive"></i>
                                            @elseif(strpos($file->url, '.xls') || strpos($file->url, '.xlsx') ||
                                            strpos($file->url, '.xlxs'))
                                            <i class="far fa-fw fa-file-excel"></i>
                                            @elseif(strpos($file->url, '.doc') || strpos($file->url, '.docx') ||
                                            strpos($file->url, '.odt'))
                                            <i class="far fa-fw fa-file-word"></i>
                                            @else
                                            <i class="far fa-fw fa-file"></i>
                                            @endif
                                            {!! $file->name !!}
                                        </a>
                                        <div class="options-overlay bg-black-75">
                                            <div class="options-overlay-content">
                                                <h3 class="h4 fw-normal text-white mb-1"></h3>
                                                <h4 class="h6 fw-normal text-white-75 mb-3"></h4>
                                                <a class="btn btn-sm btn-primary " target="{{ asset($file->url) }}" href="{{ asset($file->url) }}">
                                                    <i class="fa fa-search-plus me-1"></i> View
                                                </a>

                                                <a class="btn btn-sm btn-secondary" href="javascript:void(0)" onclick="event.preventDefault(); detachFile({{ $file->id }});">
                                                    <i class="fa fa-times-alt me-1"></i> Supprimer
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>

                            @else
                            <p>{!! str_replace('\\', '', $message->content) !!}</p>
                            <div id="divID" dir="rtl" class="row text-right g-sm items-push js-gallery push text-right">
                                @foreach ($message->attached_files as $file)
                                @if (strpos($file->url, '.png') || strpos($file->url, '.jpeg') || strpos($file->url, '.jpg'))
                                <div class="col-md-2 col-lg-2 col-xl-2 col-xs-2 animated fadeIn">
                                    <div class="options-container fx-item-rotate-r" style="border: 4px solid #d9e2e6; border-radius: .4rem;">
                                        <img class="img-fluid options-item" src="{{ asset($file->url) }}" alt="">
                                        <div class="options-overlay bg-black-75">
                                            <div class="options-overlay-content">
                                                <h3 class="h4 fw-normal text-white mb-1"></h3>
                                                <h4 class="h6 fw-normal text-white-75 mb-3"></h4>
                                                <a class="btn btn-sm btn-primary img-lightbox mb-2" href="{{ asset($file->url) }}">
                                                    <i class="fa fa-search-plus me-1"></i> View
                                                </a>

                                                <a class="btn btn-sm btn-secondary mb-2" href="javascript:void(0)" onclick="event.preventDefault(); detachFile({{ $file->id }});">
                                                    <i class="fa fa-times-alt me-1"></i> Supprimer
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="col-md-2 col-lg-2 col-xl-2 col-xs-2 animated fadeIn">
                                    <div class="options-container fx-item-rotate-r" style="border: 4px solid #d9e2e6; border-radius: .4rem;">
                                        <a class="img-link img-link-zoom-in img-thumb text-center" style="height: 277px; width: 277px;" href="{{ asset($file->url) }}" target="{{ asset($file->url) }}">
                                            @if (strpos($file->url, '.pdf'))
                                            <i class="far fa-fw fa-file-pdf"></i>
                                            @elseif(strpos($file->url, '.txt'))
                                            <i class="far fa-fw fa-file-alt"></i>
                                            @elseif(strpos($file->url, '.zip') || strpos($file->url, '.tar'))
                                            <i class="far fa-fw fa-file-archive"></i>
                                            @elseif(strpos($file->url, '.xls') || strpos($file->url, '.xlsx') ||
                                            strpos($file->url, '.xlxs'))
                                            <i class="far fa-fw fa-file-excel"></i>
                                            @elseif(strpos($file->url, '.doc') || strpos($file->url, '.docx') ||
                                            strpos($file->url, '.odt'))
                                            <i class="far fa-fw fa-file-word"></i>
                                            @else
                                            <i class="far fa-fw fa-file"></i>
                                            @endif
                                            {!! $file->name !!}
                                        </a>
                                        <div class="options-overlay bg-black-75">
                                            <div class="options-overlay-content">
                                                <h3 class="h4 fw-normal text-white mb-1"></h3>
                                                <h4 class="h6 fw-normal text-white-75 mb-3"></h4>
                                                <a class="btn btn-sm btn-primary " target="{{ asset($file->url) }}" href="{{ asset($file->url) }}">
                                                    <i class="fa fa-search-plus me-1"></i> View
                                                </a>

                                                <a class="btn btn-sm btn-secondary" href="javascript:void(0)" onclick="event.preventDefault(); detachFile({{ $file->id }});">
                                                    <i class="fa fa-times-alt me-1"></i> Supprimer
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                            @endif
                            <hr>
                            <p class="fs-sm text-muted">Envoyé il y a <span class="text-muted">{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</span></p>
                            <a class="btn-block-option me-2" onclick="$('#message_id').val({{ $message->id }});" href="#forum-reply-form">
                                <i class="fa fa-reply me-1"></i> Reply
                            </a>

                        </td>
                    </tr>
                    @else
                    <tr class="bg-body-light">
                        <td class="d-none d-sm-table-cell" colspan="1" style="width:3%!important;padding-top: 2px!important;padding-bottom: 2px!important; ">
                            <a class="flex-shrink-0 img-link" href="javascript:void(0)">
                                <img class="img-avatar img-avatar48 img-avatar-thumb" style="" src="{{ asset('assets/media/avatars/avatar1.jpg') }}" alt="">
                            </a>
                        </td>
                        <td class="fs-sm text-muted" colspan="11">
                            <a class="fw-semibold" href="{{ route('dashboard.profile',$message->author->id) }}">
                                {{ str_replace('\\', '', $message->author->last_name) }}
                                {{ str_replace('\\', '', $message->author->first_name) }}
                            </a>
                        </td>
                    </tr>
                    <tr id="parent-{{ $message->id }}">
                        <td class="d-none d-sm-table-cell text-center" colspan="1" style="width: 140px;">
                            <p>
                                <a href="{{ route('dashboard.profile',$message->author->id) }}">
                                    <img class="img-avatar" src="{{ asset(optional(optional($message->author)->profile)->url ?? 'assets/media/avatars/avatar10.jpg') }}" alt="">
                                </a>
                            </p>

                        </td>
                        <td colspan="11" style="{{ $message->parent ? ' padding-left: 0px!important;padding-right: 0px!important;' :'' }}">
                            @if($message->parent)
                            <div class="d-flex fs-sm" style="background-color: #f0f0f0; padding:10px;">

                                <div class="flex-grow-1" onclick="$('html,body').animate({ scrollTop: document.getElementById('parent-{{ optional($message->parent)->id }}').offsetTop }, 'fast'); $('#parent-{{optional($message->parent)->id }}').fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);">
                                    <p>
                                        <a class="fw-semibold" href="javascript:void(0)">{{ str_replace('\\', '', $message->parent->author->last_name) }}
                                            {{ str_replace('\\', '', $message->parent->author->first_name) }}</a>
                                        <p>{!! str_replace('\\', '', $message->parent->content) !!}</p>
                                    </p>
                                </div>
                            </div>
                            <p style="border-style: solid;border-block-color: #f0f0f0;padding:10px;">{!! str_replace('\\', '', $message->content) !!}</p>
                            <div id="divID" class="row g-sm items-push js-gallery push">
                                @foreach ($message->attached_files as $file)
                                @if (strpos($file->url, '.png') || strpos($file->url, '.jpeg') || strpos($file->url, '.jpg'))
                                <div class="col-md-2 col-lg-2 col-xl-2 col-xs-2 animated fadeIn">
                                    <div class="options-container fx-item-rotate-r" style="border: 4px solid #d9e2e6; border-radius: .4rem;">
                                        <img class="img-fluid options-item" src="{{ asset($file->url) }}" alt="">
                                        <div class="options-overlay bg-black-75">
                                            <div class="options-overlay-content">
                                                <h3 class="h4 fw-normal text-white mb-1"></h3>
                                                <h4 class="h6 fw-normal text-white-75 mb-3"></h4>
                                                <a class="btn btn-sm btn-primary img-lightbox mb-2" href="{{ asset($file->url) }}">
                                                    <i class="fa fa-search-plus me-1"></i> View
                                                </a>

                                                <a class="btn btn-sm btn-secondary mb-2" href="javascript:void(0)" onclick="event.preventDefault(); detachFile({{ $file->id }});">
                                                    <i class="fa fa-times-alt me-1"></i> Supprimer
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="col-md-2 col-lg-2 col-xl-2 col-xs-2 animated fadeIn">
                                    <div class="options-container fx-item-rotate-r" style="border: 4px solid #d9e2e6; border-radius: .4rem;">
                                        <a class="img-link img-link-zoom-in img-thumb text-center" style="height: 277px; width: 277px;" href="{{ asset($file->url) }}" target="{{ asset($file->url) }}">
                                            @if (strpos($file->url, '.pdf'))
                                            <i class="far fa-fw fa-file-pdf"></i>
                                            @elseif(strpos($file->url, '.txt'))
                                            <i class="far fa-fw fa-file-alt"></i>
                                            @elseif(strpos($file->url, '.zip') || strpos($file->url, '.tar'))
                                            <i class="far fa-fw fa-file-archive"></i>
                                            @elseif(strpos($file->url, '.xls') || strpos($file->url, '.xlsx') ||
                                            strpos($file->url, '.xlxs'))
                                            <i class="far fa-fw fa-file-excel"></i>
                                            @elseif(strpos($file->url, '.doc') || strpos($file->url, '.docx') ||
                                            strpos($file->url, '.odt'))
                                            <i class="far fa-fw fa-file-word"></i>
                                            @else
                                            <i class="far fa-fw fa-file"></i>
                                            @endif
                                            {!! $file->name !!}
                                        </a>
                                        <div class="options-overlay bg-black-75">
                                            <div class="options-overlay-content">
                                                <h3 class="h4 fw-normal text-white mb-1"></h3>
                                                <h4 class="h6 fw-normal text-white-75 mb-3"></h4>
                                                <a class="btn btn-sm btn-primary " target="{{ asset($file->url) }}" href="{{ asset($file->url) }}">
                                                    <i class="fa fa-search-plus me-1"></i> View
                                                </a>

                                                <a class="btn btn-sm btn-secondary" href="javascript:void(0)" onclick="event.preventDefault(); detachFile({{ $file->id }});">
                                                    <i class="fa fa-times-alt me-1"></i> Supprimer
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                            @else
                            <p>{!! str_replace('\\', '', $message->content) !!}</p>
                            <div id="divID" class="row g-sm items-push js-gallery push">
                                @foreach ($message->attached_files as $file)
                                @if (strpos($file->url, '.png') || strpos($file->url, '.jpeg') || strpos($file->url, '.jpg'))
                                <div class="col-md-2 col-lg-2 col-xl-2 col-xs-2 animated fadeIn">
                                    <div class="options-container fx-item-rotate-r" style="border: 4px solid #d9e2e6; border-radius: .4rem;">
                                        <img class="img-fluid options-item" src="{{ asset($file->url) }}" alt="">
                                        <div class="options-overlay bg-black-75">
                                            <div class="options-overlay-content">
                                                <h3 class="h4 fw-normal text-white mb-1"></h3>
                                                <h4 class="h6 fw-normal text-white-75 mb-3"></h4>
                                                <a class="btn btn-sm btn-primary img-lightbox mb-2" href="{{ asset($file->url) }}">
                                                    <i class="fa fa-search-plus me-1"></i> View
                                                </a>

                                                <a class="btn btn-sm btn-secondary mb-2" href="javascript:void(0)" onclick="event.preventDefault(); detachFile({{ $file->id }});">
                                                    <i class="fa fa-times-alt me-1"></i> Supprimer
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="col-md-2 col-lg-2 col-xl-2 col-xs-2 animated fadeIn">
                                    <div class="options-container fx-item-rotate-r" style="border: 4px solid #d9e2e6; border-radius: .4rem;">
                                        <a class="img-link img-link-zoom-in img-thumb text-center" style="height: 277px; width: 277px;" href="{{ asset($file->url) }}" target="{{ asset($file->url) }}">
                                            @if (strpos($file->url, '.pdf'))
                                            <i class="far fa-fw fa-file-pdf"></i>
                                            @elseif(strpos($file->url, '.txt'))
                                            <i class="far fa-fw fa-file-alt"></i>
                                            @elseif(strpos($file->url, '.zip') || strpos($file->url, '.tar'))
                                            <i class="far fa-fw fa-file-archive"></i>
                                            @elseif(strpos($file->url, '.xls') || strpos($file->url, '.xlsx') ||
                                            strpos($file->url, '.xlxs'))
                                            <i class="far fa-fw fa-file-excel"></i>
                                            @elseif(strpos($file->url, '.doc') || strpos($file->url, '.docx') ||
                                            strpos($file->url, '.odt'))
                                            <i class="far fa-fw fa-file-word"></i>
                                            @else
                                            <i class="far fa-fw fa-file"></i>
                                            @endif
                                            {!! $file->name !!}
                                        </a>
                                        <div class="options-overlay bg-black-75">
                                            <div class="options-overlay-content">
                                                <h3 class="h4 fw-normal text-white mb-1"></h3>
                                                <h4 class="h6 fw-normal text-white-75 mb-3"></h4>
                                                <a class="btn btn-sm btn-primary " target="{{ asset($file->url) }}" href="{{ asset($file->url) }}">
                                                    <i class="fa fa-search-plus me-1"></i> View
                                                </a>

                                                <a class="btn btn-sm btn-secondary" href="javascript:void(0)" onclick="event.preventDefault(); detachFile({{ $file->id }});">
                                                    <i class="fa fa-times-alt me-1"></i> Supprimer
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                            @endif
                            <hr>
                            <a class="btn-block-option me-2" onclick="$('#message_id').val({{ $message->id }});" href="#forum-reply-form">
                                <i class="fa fa-reply me-1"></i> Reply
                            </a>
                        </td>
                    </tr>
                    @endif

                    @endforeach

                    <tr class="table-active" id="forum-reply-form">
                        <td class="fs-sm text-muted" colspan="12">

                        </td>
                    </tr>

                    <tr>
                        <td colspan="12">

                            <form action="{{ route('dashboard.messages.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-md-10">
                                        <textarea rows="1" aria-multiline="6" onsubmit="" id="content" name="content" class="form-control form-control-lg @error('content') is-invalid @enderror" value="{{ old('content') }}" autofocus placeholder="Type here your message"></textarea>
                                    </div>


                                    <div class="col-md-2" style="margin:0px!important; padding:0px!important;">
                                        <button type="submit" class="btn" style="margin-left:-4px!important;position: absolute; bottom:0px;">
                                            <i class="fa fa-paper-plane fa-2x me-1" style="font-size: 1.4rem;"></i>
                                        </button>
                                        <a type="file" class="btn" onclick="document.getElementById('attached-files').click();" style="margin-left:35%!important;position: absolute; bottom:0px;">
                                            <i class="fa fa-paperclip fa-2x me-1" style="font-size: 1.4rem;"></i>
                                            <input type="file" accept="image/*" onchange="showPreviewAttachedFiles(event);" id="attached-files" multiple name="attached_files[]" style="visibility: hidden;">
                                        </a>
                                        <button type="" class="btn" style="margin-left:72%!important;position: absolute; bottom:0px;">
                                            <i class="far fa-2x fa-grin-alt" style="font-size: 1.4rem;"></i>
                                        </button>
                                    </div>
                                </div>
                                <div>

                                    <input type="hidden" value="{{ $conversation->id }}" name="group_id" id="group_id">
                                    <input type="hidden" name="parent_message_id" id="message_id">
                                </div>
                            </form>
                        </td>

                    </tr>
                    <tr>
                        <td colspan="12">
                            <div id="attached-files-preview" style="display: none;">
                            </div>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection




@push('js')

<script>
    document.getElementById("bar").style.display = "none";

</script>

<script>
    $(document).ready(function() {
        $('html,body').animate({
            scrollTop: document.getElementById('forum-reply-form').offsetTop
        }, 'fast');
        $('#forum-reply-form').scrollTop($('#forum-reply-form')[0].scrollHeight + 1000); //$('html,body').animate({ scrollTop: document.getElementById('#forum-reply-form').offsetTop }, 'fast');
        // ADD NEW MESSAGE ONCLICK FUNCTION

        $('body').on('click', '#newMessage', function(event) {
            console.log("cool");
            event.preventDefault();
            $('#app-modal-form').load(location.href + ' #app-modal-form>*', '');

            $('#app-modal').modal('show');

            document.getElementById('app-modal-form-method').innerHTML = '';

            //document.getElementById('app-modal-form').setAttribute('action','{ route('dashboard.messages.store ') }}');

            document.getElementById('app-modal-form').setAttribute('method', "POST");

            document.getElementById('app-modal-title').innerHTML = 'ENVOIE D\'UN NOUVEAU MESSAGE';

            $('.app-modal-submit-btn-title').html('ENVOYER');

            document.getElementById("messageDIV").style.display = 'block';

        });



        //SUBMIT FORM ONCLICK FUNCTION

        $('body').on('click', '#app-modal-submit-btn', function(event) {

            var formData = {};

            var members = []

            var formData2 = $('#app-modal-form').serializeArray();

            $.each(formData2, function(i, data) {

                formData[data.name] = data.value;
            });

            //Reset input errors message
            $('input+small').text('');

            $('input').parent().removeClass('has-error');

            // send request
            $.ajax({
                    url: $('#app-modal-form').attr('action')
                    , type: $('#app-modal-form').attr('method')
                    , headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , data: formData,

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
            var members = []
            var formData2 = $('#discussions-modal-form').serializeArray();
            console.log(formData2);

            $.each(formData2, function(i, data) {
                if (data.name == 'details') {
                    formData['description'] = data.value;
                } else if (data.name == 'group_members[]') {
                    members.push(data.value);
                } else {
                    formData[data.name] = data.value;
                }
            });
            formData["group_members[]"] = members;

            $.ajax({
                    url: $('#discussions-modal-form').attr('action')
                    , type: $('#discussions-modal-form').attr('method')
                    , headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , data: {
                        name: formData.name
                        , description: formData.description
                    , }
                    , dataType: 'json',

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
            backdrop: 'static'
            , keyboard: false // to prevent closing with Esc button (if you want this too)
        });

        var textarea = document.querySelector('textarea');

        textarea.addEventListener('keydown', autosize);

        function autosize() {
            var el = this;
            setTimeout(function() {
                el.style.cssText = 'height:auto; padding:0';
                // for box-sizing other than "content-box" use:
                // el.style.cssText = '-moz-box-sizing:content-box';
                el.style.cssText = 'height:' + el.scrollHeight + 'px';
            }, 0);
        }
    });

</script>

<script>
    function detachFile(id) {

        var response = window.confirm('Voulez-vous vraiement supprimé ce fichier???');

        if (response) {
            destroyFile(id);
        }

    }

    function destroyFile(id) {

        $.ajax({
                url: "{{ route('dashboard.messages.detach.file') }}"
                , type: "POST"
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , data: {
                    id: id
                }
                , dataType: 'json',

            }).done(function(data) {
                $('#tableID').load(location.href + ' #tableID>*', '');
            })
            .fail(function(data) {
                console.log(data.responseJSON);
                window.alert(data.responseJSON.message);
                $.each(data.responseJSON.errors, function(key, value) {
                    var input = '#modal-block-normal input[name=' + key + ']';
                    $(input + '+small').text(value);
                    $(input).parent().addClass('has-error');
                });
            });

    }

    function deleteMessage(id) {

var response = window.confirm('Voulez-vous vraiement supprimé ce message???');

if (response) {
    softDeleteMessage(id);
}

}

function softDeleteMessage(id) {

$.ajax({
        url: "{{ route('dashboard.messages.destroy',"+id+") }}"
        , type: "POST"
        , headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, data: {
            id: id
        }
        , dataType: 'json',

    }).done(function(data) {
        $('#tableID').load(location.href + ' #tableID>*', '');
    })
    .fail(function(data) {
        console.log(data.responseJSON);
        window.alert(data.responseJSON.message);
        $.each(data.responseJSON.errors, function(key, value) {
            var input = '#modal-block-normal input[name=' + key + ']';
            $(input + '+small').text(value);
            $(input).parent().addClass('has-error');
        });
    });

}

</script>

<script>
    function showPreviewAttachedFiles(event) {

        if (event.target.files.length > 0) {
            var preview = document.getElementById('attached-files-preview');
            console.log(preview);
            var content = '';
            for (let index = 0; index < event.target.files.length; index++) {
                var src = URL.createObjectURL(event.target.files[index]);

                console.log(src);

                var div1 = document.createElement('div');

                div1.setAttribute('class', 'col-md-2');
                div1.setAttribute('id', index + '' + src);
                div1.setAttribute('style', 'margin-bottom:16px; display:inline-block; text-align:center;');
                var a1 = document.createElement('a');
                a1.setAttribute('type', 'button');

                var img = document.createElement('img');

                img.setAttribute('src', src);
                img.setAttribute('class', 'img-thumbnail');
                img.setAttribute('width', '150');
                img.setAttribute('height', '200');
                img.setAttribute('style', 'margin-bottom:12px;');

                a1.appendChild(img);

                div1.appendChild(a1);

                var btn = document.createElement('button');

                btn.setAttribute('type', 'button');
                btn.setAttribute('class', 'btn btn-link remove_image text-danger');

                btn.onclick = function() {
                    deleteFiles(index + '' + src);
                }

                var i1 = document.createElement('i');

                i1.setAttribute('class', 'fa fa-fw fa-times text-danger');

                btn.appendChild(i1);

                btn.append("   Supprimer");

                div1.appendChild(btn);

                preview.appendChild(div1);

                //content += '<img src="src" alt="">';

                //preview.innerHTML+= '<img src="'+src'+" alt="">';

            }
            preview.style.display = "block";
        }
        /* if(event.target.files.length > 0){
            var preview = document.getElementById('attached-files-preview');
            console.log(preview);
            for (let index = 0; index < event.target.files.length; index++) {
                var src = URL.createObjectURL(event.target.files[index]);

                preview.innerHTML+= '<img src="'+src'+" alt="">'

            }
            preview.style.display = 'block';

        } */
    }

    function deleteFiles(id) {
        console.log(id);
        console.log(document.getElementById(id));
        document.getElementById(id).style.display = "none";
    }

</script>

<script src="{{ asset('assets/js/pages/be_ui_animations.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script>
    One.helpersOnLoad(['jq-magnific-popup']);

</script>
@endpush
