<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>{{ config('app.name', 'CFA Empire messenging') }}</title>
    <link rel="shortcut icon" href="assets/media/favicons/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/media/favicons/favicon-192x192.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/media/favicons/apple-touch-icon-180x180.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/chat.oneui.min-5.1.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/js/plugins/magnific-popup/magnific-popup.css') }}">
    @stack('css')
</head>
<body>
    <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-fixed main-content-narrow">
        @php
        if(isset($conversation)){

        if($conversation->type == 'group'){
        $src = optional($conversation->illustration)->url ?? 'assets/media/avatars/avatar10.jpg';
        }else {
        $src = optional(optional(optional($conversation->interlocuteur)->first())->profile)->url ?? 'assets/media/avatars/avatar10.jpg';
        }
        }
        else {
        $conversation = null;
        }

        @endphp

        @include('conversations.aside')

        @include('conversations.header')
        @include('conversations.sidebar')

        <main id="main-container">
            <div class="content" style="width:100%!important; padding: 1rem 1rem 1px;">
                <div class="row">

                    @yield('content')

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

                                <form id="app-modal-form" method="POST" action="" enctype="multipart/form-data">
                                    @csrf

                                    <p id="app-modal-form-method"></p>

                                    @yield('form-content')

                                    <div id="addMembers" style="display: none;">

                                        @php
                                           $newmembers = $users->whereNotIn('id',optional(optional($conversation)->actif_users)->pluck('id'));
                                        @endphp

                                        @if(count($newmembers)>0)

                                        <div class="mb-2">
                                            <label class="form-label" for="group-descrition">Nouveau membres</label>
                                        </div>

                                        <input type="hidden" name="id" id="new_members_group_id">

                                        <div>
                                            <ul class="nav-items fs-sm" style="list-style-type:none; display:inline-block;">
                                                @foreach ($newmembers as $user)
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

                                                            <input class="form-check-input" type="checkbox" name="group_members[]" value="{{ $user->id }}" id="group-members-{{ $user->id }}">
                                                        </div>
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @else
                                        <div class="mb-2">
                                            <label class="form-label" for="group-descrition">Il y a plus de nouveau membre disponible </label>
                                        </div>
                                        @endif
                                    </div>

                                    <div id="groupDIV" style="display: none;">

                                        <div class="mb-5 text-center" onclick="document.getElementById('group_illustration').click();">
                                            <a class="d-flex py-2" style=" padding:0rem!important;" href="javascript:void(0)">
                                                <div class="overlay-container overlay-bottom" style="margin-right: .6rem!important; margin-left: 0rem!important;">
                                                    <img id="illustration" class="img-avatar img-avatar-thumb" src="{{ asset(optional(optional($conversation)->illustration)->url ?? 'assets/media/avatars/avatar10.jpg') }}" style="box-shadow: 0 0 0 0.25rem rgb(180 180 180 / 30%);">
                                                    <span class="overlay-item item item-tiny item-circle border border-2 border-white" style="border-color: #f6f7f9 !important; text-align:center; background-color: #ebeef2; bottom: 2px; right:4px;width: 1.5rem;
                                                        height: 1.5rem;">
                                                        <i class="fa fa-camera mt-1" style="color: #adb5bd; font-size:13px;"></i>
                                                        <input hidden type="file" accept="image/*" onchange="showPreviewImage(event,'illustration');" id="group_illustration" name="illustration">
                                                    </span>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label" for="group-name">Nom du groupe</label>
                                            <input class="form-control form-control-alt" type="text" id="group-name" name="name">
                                            <input class="form-control form-control-alt" type="hidden" id="group-type" name="type">
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label" for="group-descrition">Bref description du groupe</label>
                                            <textarea class="form-control form-control-alt" cols="30" rows="2" id="group-descrition" name="description"></textarea>
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

                                                            <input class="form-check-input" type="checkbox" name="group_members[]" value="{{ $user->id }}" id="group-members-{{ $user->id }}">
                                                        </div>
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                    <div id="messageDIV" style="display: none;">

                                        <div class="mb-4">
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

                                                            <input class="form-check-input" type="radio" name="to[]" value="{{ $user->id }}" id="to-{{ $user->id }}">
                                                        </div>
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="content">Contenu du méssage</label>
                                            <textarea class="form-control form-control-alt" cols="30" rows="2" id="content" name="content"></textarea>
                                        </div>

                                        <div class="mb-4">
                                            <input class="form-control form-control-alt" type="file" accept="image/*" onchange="showPreview(event);" id="attached_files" multiple name="attached_files[]">
                                        </div>

                                        <input type="hidden" name="group_id">

                                        <div class="text-center pt-2 pb-2 fs-sm fw-semibold bg-body-light" id="attached_files_preview" style="display: none; margin-left: -20px; margin-right: -20px; margin-bottom: 0px; background-color: #f6f7f9;">

                                        </div>


                                    </div>

                                </form>

                            </div>
                            <div class="block-content block-content-full text-end bg-body">
                                <button type="button" onclick="$('#app-modal-form')[0].reset(); " class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-sm btn-primary app-modal-submit-btn-title" id="app-modal-submit-btn">Valider</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        @yield('footer')
    </div>
    <script src="{{ asset('assets/js/oneui.app.min-5.1.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>

    <script src="{{ asset('assets/js/base_ui_icons.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="assets/js/plugins/easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script>
        One.helpersOnLoad(['one-table-tools-checkable', 'jq-easy-pie-chart']);

    </script>

    <script>
        window.User = {
            id: {{ optional(auth()->user())->id }},
        };

        window.newNotification = false;

        window.count_notifications = {{
                optional(optional(auth()->user())->unreadNotifications())->count()
        }};

        if (count_notifications > 0) {
            document.getElementById('count-notifications').innerHTML = count_notifications;
        }

    </script>

<script>
    function showPreview(event) {

        if (event.target.files.length > 0) {

            var preview = document.getElementById('attached_files_preview');

            for (let index = 0; index < event.target.files.length; index++) {

                var src = URL.createObjectURL(event.target.files[index]);

                var div1 = document.createElement('div');

                div1.setAttribute('class', 'col-md-2 mr-2');
                div1.setAttribute('id', index + '' + src);
                div1.setAttribute('style', 'margin-bottom:0px; margin-right:8px; display:inline-block; text-align:center;');
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

                btn.setAttribute('style', 'font-size: 13.4px;');

                btn.setAttribute('class', 'btn btn-link remove_image text-danger');

                btn.onclick = function() {
                    deleteFiles(index + '' + src);
                }

                var i1 = document.createElement('i');

                i1.setAttribute('class', 'fa fa-fw fa-times text-danger');

                i1.setAttribute('style', 'font-size: 13.2px;');

                btn.appendChild(i1);

                btn.append("   Supprimer");

                div1.appendChild(btn);

                preview.appendChild(div1);

            }

            preview.style.display = "block";
        }
    }

    function changeIllustration(id){

        var formData =  new FormData();

        formData.append("id",id);
        formData.append("illustration",$('#change_group_illustration')[0].files[0]);

        $.ajax({
                url: "{{ route('dashboard.conversations.changeIllustration')}}",
                type: "POST",
                enctype:'multipart/form-data',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                dataType:'json',
                contentType:false,
                processData:false,

            }).done(function(data) {
                $('#page-container').load(location.href + ' #page-container>*', '');
            })
            .fail(function(data) {
                console.log(data.responseJSON);
                window.alert(data.responseJSON.message);
            });


    }

    function showPreviewImage(event,id) {

        if (event.target.files.length > 0) {

            var preview = document.getElementById(id);

            for (let index = 0; index < event.target.files.length; index++) {

                var src = URL.createObjectURL(event.target.files[index]);

                preview.setAttribute('src', src);

                document.getElementById("resetIllustration").style.display = "block";
            }
        }
    }

    function deleteFiles(id) {
        document.getElementById(id).style.display = "none";
    }

    function markHasRead(id) {

        $.ajax({
                url: "{{ route('dashboard.conversations.markHasRead')}}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
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

function fetchAttachedFiles(id) {

    $.ajax({
            url: "{{ route('dashboard.conversations.index')}}"+'/fetchAttachedFiles/'+id,
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {

            },
            dataType: 'json',

        }).done(function(data) {
           // window.AttachedFiles = data.data;
           //$('#aside').load(location.href + ' #aside>*', '');
            var attachedFilesPreview = document.getElementById('conversationAttachedFiles');

            files = data.data;

            for (let index = 0; index < files.length; index++) {

                attachedFile = files[index];

                var div = document.createElement('div');

                div.setAttribute("class","col-md-6 col-lg-4 col-xl-6 animated fadeIn");
                div.setAttribute('style'," margin-bottom: 1rem!important; padding: .5rem!important;");

                var alink = document.createElement('a');

                alink.setAttribute('class','img-link img-link-zoom-in img-thumb img-lightbox');
                alink.setAttribute('href',"{{ asset("") }}"+attachedFile.url);
                alink.setAttribute('style',"background-color: #f6f7f9;");

                var img = document.createElement('img');

                img.setAttribute('class','img-fluid');
                img.setAttribute('src',"{{ asset("") }}"+attachedFile.url);
                img.setAttribute('alt',attachedFile.name);
                img.setAttribute('style',"height: 130px;");

                alink.appendChild(img);

                div.appendChild(alink);

                attachedFilesPreview.appendChild(div);

            }

            //attachedFilesPreview.appendChild("<div class='col-md-6 col-lg-4 col-xl-3 animated fadeIn'><a class='img-link img-link-zoom-in img-thumb img-lightbox' href='{{ asset('assets/media/photos/photo11@2x.jpg') }}'><img class='img-fluid' src='{{ asset('assets/media/photos/photo11.jpg') }}' alt=''></a></div>");

            console.log(attachedFilesPreview);

        })
        .fail(function(data) {
            console.log(data.responseJSON);
            window.alert(data.responseJSON.message);
        });

}

    </script>

    <script>
        $(document).ready(function() {

            $('#app-modal').modal({
                backdrop: 'static'
                , keyboard: false // to prevent closing with Esc button (if you want this too)
            });

            document.getElementById('app-modal').children[0].classList.add('modal-lg');

            // ADD NEW USER ONCLICK FUNCTION

            $('body').on('click', '#newGroup', function(event) {

                event.preventDefault();

                $('#app-modal-form')[0].reset();

                document.getElementById('app-modal-form-method').innerHTML = '';

                document.getElementById('app-modal-form').setAttribute('action', '{{ route('dashboard.conversations.store') }}');

                document.getElementById('app-modal-form').setAttribute('method', "POST");

                document.getElementById('app-modal-title').innerHTML = 'Creation d\'un nouveau groupe';

                $('.app-modal-submit-btn-title').html('Ajouter');

                document.getElementById("groupDIV").style.display = 'block';
                document.getElementById("messageDIV").style.display = 'none';
                document.getElementById("addMembers").style.display = 'none';

            });

            $('body').on('click', '#newConversation', function(event) {


                $('#app-modal-form')[0].reset();

                document.getElementById('app-modal-form-method').innerHTML = '';

                document.getElementById('app-modal-form').setAttribute('action', '{{ route('dashboard.messages.store') }}');

                document.getElementById('app-modal-form').setAttribute('method', "POST");

                document.getElementById('app-modal-title').innerHTML = 'ENVOIE D\'UN NOUVEAU MESSAGE';

                $('.app-modal-submit-btn-title').html('Envoyer');

                document.getElementById("messageDIV").style.display = 'block';
                document.getElementById("addMembers").style.display = 'none';
                document.getElementById("groupDIV").style.display = 'none';

            });

            $('body').on('click', '#newGroupMembers', function(event) {

                $('#app-modal-form')[0].reset();

                document.getElementById('app-modal-form-method').innerHTML = '';

                document.getElementById('app-modal-form').setAttribute('action', '{{ route('dashboard.conversations.addMembers') }}');

                document.getElementById('app-modal-form').setAttribute('method', "POST");

                document.getElementById('app-modal-title').innerHTML = 'Ajout de nouveau membre';

                $('.app-modal-submit-btn-title').html('Ajouter');

                document.getElementById("addMembers").style.display = 'block';
                document.getElementById("groupDIV").style.display = 'none';
                document.getElementById("messageDIV").style.display = 'none';

            });

            $('body').on('click', '#app-modal-submit-btn', function(event) {

                //console.log($('#group_illustration')[0].files);

                var formData =  new FormData($('#app-modal-form')[0]);


                /* console.log($('#app-modal-form').serializeArray());

                formData.set("illustration",$('#group_illustration')[0].files[0])

                console.log(formData2.get('file'));

                var formData2 = $('#app-modal-form').serializeArray();

                    var formData = {};

                    $.each(formData2, function(i, data) {
                        formData[data.name] = data.value;
                    });

                    formData['illustration'] =  //" $('#group_illustration')[0].files[0]";

                    console.log(formData); */


                //Reset input errors message
                $('input+small').text('');

                $('input').parent().removeClass('has-error');

                // send request
                $.ajax({
                        url: $('#app-modal-form').attr('action'),
                        type: $('#app-modal-form').attr('method'),
                        enctype:'multipart/form-data',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData,
                        dataType:'json',
                        contentType:false,
                        processData:false,

                    }).done(function(data) {

                        //refresh page with new data
                        $('#page-container').load(location.href + ' #page-container>*', '');

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
        });

    </script>

<script src="{{ asset('assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script>
    One.helpersOnLoad(['jq-magnific-popup']);

</script>

    @stack('js')
</body>
</html>
