@extends('layouts.app')

@push('css')
<link rel="stylesheet" id="css-main" href="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css">
@endpush

@section('content')

    <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed">

        @include('layouts.components.sidebar')
        @include('layouts.components.header')

        <main id="main-container">
            <div class="bg-body-light" id="bar">
                <div class="content">
                    <div id="bar_present" style="display: none;"
                        class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
                        <div class="flex-grow-1 mb-1 mb-md-0">
                            <h1 class="h3 fw-bold mb-2">
                                @yield('title')
                            </h1>
                            <h2 class="h6 fw-medium fw-medium text-muted mb-0">
                                @yield("subtitle")
                            </h2>
                        </div>

                        <div class="mt-3 mt-md-0 ms-md-3 space-x-1">

                            {{-- @can('manage-presences')
                                <a class="btn btn-sm btn-alt-secondary space-x-1" id="markPresences"
                                    href="{{ route('dashboard.presences.index') }}">
                                    <i class="fa fa-plus opacity-50"></i>
                                    <span>Marquer une arrivée</span>
                                </a>
                            @endcan --}}
                            @can(['create-presences'])
                                @if (auth()->user()->isPresent() == null ||
            auth()->user()->isPresent() == '' ||
            auth()->user()->isPresent() == 0)
                                    <a class="btn btn-sm btn-alt-secondary space-x-1" id="auth_user"
                                        onclick="event.preventDefault(); inAt();" href="javascript:void(0)">
                                        <i class="fa fa-directions opacity-50"></i>
                                        <span>Marquer ma présence</span>
                                    </a>
                                @elseif(auth()->user()->isPresent() == 2 )
                                    <a class="btn btn-sm btn-alt-secondary space-x-1" type="submit" id="auth_user"
                                        onclick="event.preventDefault(); outAt();">
                                        <i class="fa fa-fw fa-map-signs opacity-50"></i>
                                        <span>Marquer ma sortie</span>
                                    </a>
                                @else

                                @endif

                            @endcan
                            {{-- <div class="dropdown d-inline-block">
                                <button type="button" class="btn btn-sm btn-alt-secondary space-x-1"
                                    id="dropdown-analytics-overview" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-fw fa-calendar-alt opacity-50"></i>
                                    <span>All time</span>
                                    <i class="fa fa-fw fa-angle-down"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end fs-sm"
                                    aria-labelledby="dropdown-analytics-overview">
                                    <a class="dropdown-item fw-medium" href="javascript:void(0)">Last 30 days</a>
                                    <a class="dropdown-item fw-medium" href="javascript:void(0)">Last month</a>
                                    <a class="dropdown-item fw-medium" href="javascript:void(0)">Last 3 months</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item fw-medium" href="javascript:void(0)">This year</a>
                                    <a class="dropdown-item fw-medium" href="javascript:void(0)">Last Year</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                                        href="javascript:void(0)">
                                        <span>All time</span>
                                        <i class="fa fa-check"></i>
                                    </a>
                                </div>
                            </div> --}}
                        </div>

                    </div>
                    <div></div>
                </div>
            </div>

            <div id="audioID">
                {{-- <audio autoplay='true' id="audio-back" loop='true'>
                    <source src="{{asset('assets/media/audios/notifications.mp3')}}" type="audio/mp3">
                </audio> --}}
            </div>
            @yield('dash')
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

    <div class="modal fade" id="model-modal-apps" tabindex="-1" role="dialog" aria-labelledby="model-modal-apps"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-md mt-6" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">@yield('model-title-modal-apps')</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row gutters-tiny">

                            @yield('modal-content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <!-- Modal HTML -->
    <div id="appModal" class="modal fade" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    @yield('contenu')

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="submit_form">
                        <i class="fa fa-save fa-save me-1 opacity-50"></i>
                        Enregistrer
                    </button>
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
    <script type="text/javascript">
        $(document).ready(function() {

            $('body').on('click', '#auth_user_in', function(event) {

                console.log('in');

                $('#bar_present').load(location.href + ' #bar_present>*', '');


            });
            $('body').on('click', '#auth_user_out', function(event) {

                console.log('out');


                $('#bar_present').load(location.href + ' #bar_present>*', '');


            });


        });

        console.log({{ auth()->user()->isPresent() }});
    </script>
    <script>
        $(document).ready(function() {
            $('.launch-modal').click(function() {
                $('#appModal').modal({
                    backdrop: 'static'
                });
            });
        });
    </script>


    <script>

        function showPreviewImage(event,id) {

            if (event.target.files.length > 0) {

                var preview = document.getElementById(id);

                for (let index = 0; index < event.target.files.length; index++) {

                    var src = URL.createObjectURL(event.target.files[index]);

                    preview.setAttribute('src', src);

                    document.getElementById("resetProfile").style.display = "block";

                }
            }
        }

        function inAt() {
            $.ajax({
                    url: "{{ route('dashboard.presences.userInAt') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {},
                    dataType: 'json',

                }).done(function(data) {
                    console.log(data);
                    $('#bar').load(location.href + ' #bar>*', '');
                    //window.location.reload(true);
                })
                .fail(function(data) {
                    console.log(data.responseJSON);
                    alert(data.responseJSON.errors);
                });

        }

        function outAt() {
            $.ajax({
                    url: "{{ route('dashboard.presences.userOutAt') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {},
                    dataType: 'json',

                }).done(function(data) {
                    console.log(data);
                    $('#bar').load(location.href + ' #bar>*', '');
                    //window.location.reload(true);
                })
                .fail(function(data) {
                    alert(data.responseJSON.errors);
                });

        }
    </script>

<script src="{{ asset('assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/be_comp_dialogs.min.js') }}"></script>

<script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/be_tables_datatables.min.js') }}"></script>
@endpush

@push('custom-js')
    {{-- <script src="{{ asset('assets/js/oneui.app.min-5.1.js') }}"></script>
<script src="{{ asset('assets/js/be_pages_dashboard.min.js') }}"></script> --}}
@endpush
