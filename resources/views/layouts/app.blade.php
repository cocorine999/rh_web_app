<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CFA Empire messenging') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>
    {{--
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/tableselection.css') }}">

    --}}


    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- // EXTRA INCLUDE // -->

    <link rel="shortcut icon" href="{{ asset('assets/logo/logo.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/media/favicons/favicon-192x192.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/media/favicons/apple-touch-icon-180x180.png">

    <!-- // FONTS INCLUDE // -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700">
    <link rel="stylesheet" href="{{ asset('assets/fonts/Simple-Line-Icons.woff') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome-webfont.woff2') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/glyphicons-halflings-regular.woff2') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('assets/fonts/fa-solid-900.woff2') }}">

    <!-- // CSS INCLUDE // -->

    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/select2.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/oneui.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/oneui.min-4.6.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/oneui.min-5.1.css') }}">

    @yield('custom-css')
    @stack('css')
</head>

<body class="font-sans antialiased" id="page_id">



            <div>

                @yield('content')
                @include('sweetalert::alert')

            </div>
    @yield('custom-js')
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/oneui.core.min-4.6.js') }}"></script>
    <script src="{{ asset('assets/js/oneui.app.min-4.6.js') }}"></script>
    <script src="{{ asset('assets/js/oneui.app.min-5.1.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/es6-promise/es6-promise.auto.min.js') }}"></script>

    <script src="{{ asset('assets/js/base_ui_icons.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/full/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>


       {{--
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.js"></script>
    --}}

    <script>
        window.User = {
            id:{{ optional(auth()->user())->id }},
        };

        window.newNotification = false;

        /* window.Notifications = {
            notifications:{{ optional(auth()->user())->unreadNotifications }},
            count:{{ optional(optional(auth()->user())->unreadNotifications())->count() }}
        } */

        window.count_notifications = {{ optional(optional(auth()->user())->unreadNotifications())->count() }};
        if(count_notifications>0){
            document.getElementById('count-notifications').innerHTML =count_notifications;
        }



        function markHasRead() {
            $(document).ready(function() {
                document.getElementById('count-notifications').innerHTML = "";
                //Notifications.notifications = [];
                //Notifications.count = 0;
                console.log('onclick');
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            console.log();
            //document.getElementById('audio-back').play();
            if(window.NewNotification == true){
                console.log('D\'ACCORD');
            }
           /*  if(window.NewNotification == false){
                console.log('not cool');
            }
            else{
                console.log("cool");
                new Audio('{{asset('assets/media/audios/notifications.mp3')}}').play();
            } */
        });
    </script>

    <script>
        CKEDITOR.replace( 'description' );
    </script>

    @stack('js')
</body>

</html>
