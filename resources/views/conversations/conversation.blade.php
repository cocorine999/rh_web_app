@extends('conversations.inbox')

@push('css')
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

@section('content')
<div class="content" style="width: 100%;">


        @php
            $last_date = \Carbon\Carbon::now()->format('d/M/Y');
        @endphp

    @foreach ($messages->sortBy('created_at') as $message )


    @if($last_date != \Carbon\Carbon::parse($message->created_at)->format('d/M/Y'))
        <div class="text-center pt-2 pb-2 mb-4 fs-sm fw-semibold" style=" border-radius:5rem; font-size: 12px !important;">
            {{ \Carbon\Carbon::parse($message->created_at)->isoFormat('d MMMM Y') }}
        </div>
    @endif


    <div class="content-header"  id="parent-{{ $message->id }}" dir="{{ $message->author->id == auth()->id() ? 'rtl' : 'ltr' }}" style=" justify-content:stretch; margin:0rem; margin-bottom : 20px; {{ $message->author->id == auth()->id() ? 'margin-left:8%!important;' :'margin-right:8%!important;' }}      height:auto;">
        <div class="d-flex align-items-center">

            <li class="nav-main-item" style="margin-bottom:2px; ">
                <a class="d-flex py-2" style=" padding:0rem!important;min-height:auto;" href="javascript:void(0)">
                    <div class="flex-shrink-0 me-3 ms-2 overlay-container overlay-bottom" style=";margin-right: .6rem!important; margin-left: 0rem!important;">

                        {{-- group users profile image --}}

                        @if($conversation->type == 'group' && $message->author->id != auth()->id())
                            <img class="img-avatar" style="width: 43px;height:43px;" src="{{ asset(optional(optional(optional($message)->author)->profile)->url ?? 'assets/media/avatars/avatar10.jpg') }}" alt="">
                            <span class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                        @endif

                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-semibold fs-sm mt-1" style="vertical-align: initial;display:block!important;width: 100%!important; {{ $message->author->id != auth()->id() ? 'border-radius:8px 5.4px 5.4px 0rem; background-color: white;' : 'border-radius:5.4px 8px 0rem 5.4px; background-color: #f6f7f9;'}} padding: .2rem .46rem ">

                            {{-- Start of author section --}}


                                @if($conversation->type == 'group' && $message->author->id != auth()->id() )
                                    <span class="nav-main-link-name fs-sm " style="font-size: .68rem!important;--bs-text-opacity: 1; color:#4c78dd;">
                                        {{ str_replace('\\', '', $message->author->last_name) }}
                                        {{ str_replace('\\', '', $message->author->first_name) }}
                                    </span>
                                    <br>
                                @else
                                    <span class="nav-main-link-name fs-sm text-success " style="font-size: .68rem!important; color:red;">
                                        Vous
                                        <br>
                                    </span>
                                @endif


                            {{-- end of author section --}}

                            {{-- Start of reply section --}}
                            @if($message->parent!= null)
                                <div class="mb-1 mt-1" id="{{ $message['id'] }}" style="background-color:#ebeef2; padding: 5px; 0px; border-radius:4px; border-color:transparent transparent transparent red; " onclick=" $('html,body').animate({ scrollTop: document.getElementById('parent-{{  optional($message->parent)->id  }}').offsetTop - 100 }, 'fast'); $('#parent-{{optional($message->parent)->id }}').fadeOut(1100).fadeIn(800).fadeOut(800).fadeIn(800);">
                                    @if($message->parent->author->id != auth()->id())
                                        <span class="nav-main-link-name fs-sm text-success " style="font-size: .68rem!important; color:red;">
                                            {{ str_replace('\\', '', $message->parent->author->last_name) }}
                                            {{ str_replace('\\', '', $message->parent->author->first_name) }}
                                        </span>
                                        <br>
                                    @else
                                    <span class="nav-main-link-name fs-sm text-success " style="font-size: .68rem!important; color:red;">
                                        Vous
                                        <br>
                                    </span>
                                    @endif
                                    <div class="fs-sm" style="font-size: .78rem!important; --bs-text-opacity: .8;">
                                        {!! nl2br(e(str_replace('\\', '', $message->parent->content))) !!}
                                    </div>
                                </div>
                            @endif
                            {{-- Start of reply section --}}

                            {{-- Start of images section --}}
                            @if(count($message->attached_files) >0 )
                            <br>
                            <div id="divID" class="row g-sm items-push js-gallery push pb-2 pt-2 mt-1 mb-2" style="background-color:#ebeef2; padding: 5px; 0px; border-radius:4px;">
                                @foreach ($message->attached_files as $file)
                                @if (strpos($file->url, '.png') || strpos($file->url, '.jpeg') || strpos($file->url, '.jpg'))
                                <div class="col-md-6 col-lg-6 col-xl-6 col-xs-6 animated fadeIn" style=" width: 180px;height: 170px;">
                                    <div class="options-container fx-item-rotate-r" style="border: 4px solid #d9e2e6; border-radius: .4rem; width: 100%;height: 100%;">
                                        <img class="img-fluid options-item" src="{{ asset($file->url) }}" alt=""  style="width: 100%;height: 100%;">
                                        <div class="options-overlay bg-black-75">
                                            <div class="options-overlay-content">
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
                            {{-- End of images section --}}



                            {{-- Start of content section --}}
                            <div class="fs-sm" style="font-size: .78rem!important; --bs-text-opacity: .8;">
                                {!! nl2br(e(str_replace('\\', '', $message->content))) !!}
                            </div>
                            {{-- End of content section --}}

                        </div>
                        <div class="fs-sm text-muted " style="font-size: .7rem!important; padding: 2px 3px;">
                            {{ \Carbon\Carbon::parse($message->created_at)->format('h:m') }}
                        </div>
                    </div>

                </a>
            </li>
        </div>
        <div class="d-flex" style="margin-top: -20px!important;">

            <a class="btn-block-option me-2" onclick="$('#message_id').val({{ $message->id }});" href="#page-footer">
                <i class="fa fa-reply fa-fw "></i>
            </a>

            <button type="button" class="btn btn-sm btn-dual mr-2 d-none d-lg-inline-block"  href="javascript:void(0)" onclick="event.preventDefault(); deleteMessage({{ $message->id }});">
                <i class="fa fa-fw fa-trash"></i>
            </button>
            <button type="button" class="btn btn-sm btn-dual mr-2 d-none d-lg-inline-block">
                <i class="fa fa-fw fa-ellipsis-v"></i>
            </button>

        </div>
    </div>

    @endforeach



    <div class="text-center pt-2 pb-2 fs-sm fw-semibold bg-body-light" id="attached-files-preview" style="display: none;margin-left: -32px;margin-right: -32px;margin-bottom: -1px;background-color: #f6f7f9;">

    </div>
</div>

@endsection

@section('footer')

<footer id="page-footer" class="bg-body-light">
    <div class="content py-3" style="width:100%!important;  padding: 1rem 1rem 1px;">
        <form action="{{ route('dashboard.messages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row fs-sm" style="">
                <div class="col-sm-2 text-sm-end" style="">

                    <button id="emojiComponent" type="" class="btn" style="">
                        <i class="far fa-2x fa-grin-alt" style="font-size: 1.4rem;"></i>
                    </button>

                    <a type="file" id="attachedComponent" class="btn" onclick="document.getElementById('attached-files').click();">
                        <i class="fa fa-paperclip fa-2x me-1" style="font-size: 1.4rem;"></i>
                        <input hidden type="file" accept="image/*" onchange="showPreviewAttachedFiles(event);" id="attached-files" multiple name="attached_files[]" style="visibility: hidden;">
                    </a>

                </div>

                <div class="col-sm-9 text-sm-start">
                    <textarea rows="1" aria-multiline="6" onsubmit="" id="content" name="content" class="form-control form-control-lg @error('content') is-invalid @enderror" value="{{ old('content') }}" autofocus placeholder="Type here your message"></textarea>
                </div>

                <div class="col-sm-1 text-center text-sm-end">
                    <button id="sendComponent" type="submit" class="btn">
                        <i class="fa fa-paper-plane fa-2x me-1" style="font-size: 1.4rem;"></i>
                    </button>
                </div>

                <div>

                    <input type="hidden" value="{{ $conversation->id }}" name="group_id" id="group_id">
                    <input type="hidden" name="parent_message_id" id="message_id">
                </div>
            </div>
        </form>
    </div>
</footer>
@endsection

@push('js')

<script>
    $(document).ready(function() {

        document.getElementById('sendComponent').setAttribute('style', 'padding-top :' + parseInt(document.querySelector('textarea').scrollHeight - (document.querySelector('textarea').scrollHeight / 2)) + 'px;');
        document.getElementById('emojiComponent').setAttribute('style', 'padding-top :' + parseInt(document.querySelector('textarea').scrollHeight - (document.querySelector('textarea').scrollHeight / 2)) + 'px;');
        document.getElementById('attachedComponent').setAttribute('style', 'padding-top :' + parseInt(document.querySelector('textarea').scrollHeight - (document.querySelector('textarea').scrollHeight / 2)) + 'px;');

        var textarea = document.querySelector('textarea');
        var footer = document.querySelector('footer');

        textarea.addEventListener('keydown', autosize);

        function autosize() {
            var el = this;
            setTimeout(function() {
                el.style.cssText = 'height:auto; padding:0';
                footer.style.cssText = 'height:auto; padding:0';

                $('html,body').animate({
                    scrollTop: $('html,body').scrollHeight
                }, 'fast');

                el.style.cssText = 'height:' + el.scrollHeight + 'px';

                footer.style.cssText = 'height:' + parseInt(footer.scrollHeight) + 'px';

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
                $('#page-container').load(location.href + ' #page-container>*', '');
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
                url: "{{ route('dashboard.messages.index')}}"+'/'+id,
                type: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id
                }
                , dataType: 'json',

            }).done(function(data) {
                $('#page-container').load(location.href + ' #page-container>*', '');
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

    function blockConversation(id,user_id,motif) {

        var response = window.confirm('Voulez-vous vraiement bloqué cet utilisateur ???');

        if (response) {
            block(id,user_id,motif);
        }

    }

    function block(id,user_id,motif) {
        $.ajax({
                url: "{{ route('dashboard.conversations.blockConversation')}}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    user_id: user_id,
                    motif: motif,
                }
                , dataType: 'json',

            }).done(function(data) {
                $('block').load(location.href + ' block>*', '');
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

    function getOutOfGroup(id,user_id,motif) {

        var response = window.confirm('Voulez-vous vraiement quitté ce groupe ???');

        if (response) {
            getOut(id,user_id,motif);
        }

    }

    function getOut(id,user_id,motif) {
        $.ajax({
                url: "{{ route('dashboard.conversations.getOutConversation')}}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    user_id: user_id,
                    motif: motif,
                }
                , dataType: 'json',

            }).done(function(data) {
                $('block').load(location.href + ' block>*', '');
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

    function retreiveFromGroup(id,user_id,motif) {

        var response = window.confirm('Voulez-vous vraiement retiré cet utilisateur du groupe ???');

        if (response) {
            retrieveUser(id,user_id,motif);
        }

    }


    function retrieveUser(id,user_id,motif) {
        $.ajax({
                url: "{{ route('dashboard.conversations.retrieveFromConversation')}}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    user_id: user_id,
                    motif: motif,
                }
                , dataType: 'json',

            }).done(function(data) {
                $('block').load(location.href + ' block>*', '');
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


    function unBlock(id,user_id,motif, message) {

        var response = window.confirm(message);

        if (response) {
            unBlockConversation(id,user_id,motif);
        }

    }


    function unBlockConversation(id,user_id,motif) {
        $.ajax({
                url: "{{ route('dashboard.conversations.unBlockConversation')}}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    user_id: user_id,
                    motif: motif,
                }
                , dataType: 'json',

            }).done(function(data) {
                $('block').load(location.href + ' block>*', '');
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

                div1.setAttribute('class', 'col-md-2 mr-2');
                div1.setAttribute('id', index + '' + src);
                div1.setAttribute('style', 'margin-bottom:16px; margin-right:8px; display:inline-block; text-align:center;');
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

            }
            preview.style.display = "block";
        }
    }

    function deleteFiles(id) {
        document.getElementById(id).style.display = "none";
    }

</script>

<script src="{{ asset('assets/js/pages/be_ui_animations.min.js') }}"></script>

@endpush
