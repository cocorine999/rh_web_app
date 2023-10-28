@extends('layouts.dashboard')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/magnific-popup/magnific-popup.css') }}">
@endpush


@section('dash')

    <div class="bg-image" style="background-image: url('{{ asset('assets/media/avatars/promo-code.png') }}');">
        <div class="bg-primary-dark-op">
            <div class="content content-full text-center py-7 pb-5">
                <h1 class="h2 text-white mb-2">
                    {{ \Str::ucfirst(str_replace('\\', '', $rapport->libelle)) }}
                </h1>
                <h2 class="h4 fw-normal text-white-75">
                    rapport du
                    {{ \Str::lower(
    \Carbon\Carbon::parse($rapport->date)->locale('fr')->isoFormat('D MMMM, Y'),
) }}

                </h2>
            </div>
        </div>
    </div>
    <div class="bg-body-extra-light">
        <div class="content content-boxed py-3">
            <nav aria-label="breadcrumb">

                {{-- <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx text-dark" href="be_pages_elearning_courses.html">Courses</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="link-fx text-dark" href="be_pages_elearning_course.html">Learn HTML5</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">1.1 HTML5 Intro</a>
                        </li>
                    </ol> --}}

            </nav>
        </div>
    </div>
    <div class="content content-boxed">
        <div class="row">
            <div class="col-xl-8">
                <div class="block block-rounded">
                    <div class="block-content">
                        <h3>{{ \Str::ucfirst(str_replace('\\', '', $rapport->libelle)) }}</h3>
                        <p> {!! \Str::ucfirst(str_replace('\\', '', $rapport->description)) !!}.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="block block-rounded">

                    <div class="block-header block-header-default text-center">
                        <h3 class="block-title">Images</h3>
                    </div>
                    <div class="block-content">

                        {{-- @foreach ($rapport->files as $fichier)
                            @if (!strpos($fichier->name, '.zip'))
                                <embed class="mb-4" href="{{ asset($fichier->url) }}"
                                    src="{{ asset($fichier->url) }}" alt="{{ $rapport->name }}" width="100%"
                                    height="375">
                            @else
                                <p class="text-center" width="100%"><i width="100%" class="fa fa-2x fa-file-archive"></i>
                                </p>
                            @endif
                            <a class="btn btn-primary w-100 push" target="_blank" href="{{ asset($fichier->url) }}">
                                <i class="fa fa-download me-1"></i> Download
                            </a>
                        @endforeach --}}

                    </div>
                </div>
                <a class="block block-rounded block-link-shadow" href="javascript:void(0)">
                    <div class="block-header block-header-default text-center">
                        <h3 class="block-title">Rédiger par :</h3>
                    </div>
                    <div class="block-content block-content-full text-center">
                        <div class="push">
                            <img class="img-avatar" src="{{ asset(optional($rapport->user->profile)->url ?? 'assets/media/avatars/avatar10.jpg') }}" alt="">
                        </div>
                        <div class="fw-semibold mb-1">{{ $rapport->user->last_name }} {{ $rapport->user->first_name }}
                        </div>
                        <div class="fs-sm text-muted">{{ $rapport->user->user_actual_poste->first()->name }}</div>
                    </div>
                </a>
            </div>
        </div>

        <div id="page-container">

            <main id="main-container">

                <div class="content">
                    {{-- <h2 class="content-heading">Simple</h2>
                        <div class="row items-push js-gallery img-fluid-100">
                            @foreach ($rapport->files as $file)
                                <div class="col-md-6 col-lg-4 col-xl-3 animated fadeIn">
                                    <a class="img-link img-link-zoom-in img-thumb img-lightbox"
                                        href="{{ asset($file->url) }}">
                                        <img class="img-fluid" src="{{ asset($file->url) }}" alt="">
                                    </a>
                                </div>
                            @endforeach
                        </div> --}}
                    @if (count($rapport->files) > 0)
                        <h2 class="content-heading">GALERIE</h2>
                        <div id="divID" class="row g-sm items-push js-gallery push">
                            @foreach ($rapport->files as $file)
                                @if (strpos($file->url, '.png') || strpos($file->url, '.jpeg') || strpos($file->url, '.jpg'))
                                    <div class="col-md-6 col-lg-4 col-xl-3 animated fadeIn">
                                        <div class="options-container fx-item-rotate-r">
                                            <img class="img-fluid options-item" src="{{ asset($file->url) }}" alt="">
                                            <div class="options-overlay bg-black-75">
                                                <div class="options-overlay-content">
                                                    <h3 class="h4 fw-normal text-white mb-1">Image Caption</h3>
                                                    <h4 class="h6 fw-normal text-white-75 mb-3">Some extra info</h4>
                                                    <a class="btn btn-sm btn-primary img-lightbox"
                                                        href="{{ asset($file->url) }}">
                                                        <i class="fa fa-search-plus me-1"></i> View
                                                    </a>

                                                    <a class="btn btn-sm btn-secondary" href="javascript:void(0)"
                                                        onclick="event.preventDefault(); deleteFiles({{ $file->id }});">
                                                        <i class="fa fa-times-alt me-1"></i> Supprimer
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-6 col-lg-4 col-xl-3 animated fadeIn">
                                        <div class="options-container fx-item-rotate-r">
                                            <a class="img-link img-link-zoom-in img-thumb text-center" style="height: 277px; width: 277px;"
                                                href="{{ asset($file->url) }}" target="{{ asset($file->url) }}">
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
                                                    <h3 class="h4 fw-normal text-white mb-1">Image Caption</h3>
                                                    <h4 class="h6 fw-normal text-white-75 mb-3">Some extra info</h4>
                                                    <a class="btn btn-sm btn-primary "  target="{{ asset($file->url) }}"
                                                        href="{{ asset($file->url) }}">
                                                        <i class="fa fa-search-plus me-1"></i> View
                                                    </a>

                                                    <a class="btn btn-sm btn-secondary" href="javascript:void(0)"
                                                        onclick="event.preventDefault(); deleteFiles({{ $file->id }});">
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
                </div>
            </main>
        </div>
    </div>

@endsection

{{-- JAVASCRIPT INCLUDE SECTION --}}
@push('js')

    <script type="text/javascript">
        function deleteFiles(id) {

            var response = window.confirm('Voulez-vous vraiement supprimé ce fichier???');

            if (response) {
                destroyFile(id);
            }

        }


        function destroyFile(id) {

            $.ajax({
                    url: "{{ route('dashboard.rapports.delete.files') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: id
                    },
                    dataType: 'json',

                }).done(function(data) {
                    document.getElementById("divID").innerHTML = data.output;
                    /*
                    window.location.reload(true);
                    window.location.reload(true); */
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

        $(document).ready(function() {
            $('body').on('click', '#editRapport', function(event) {
                document.getElementById('rapport_form_method').innerHTML =
                    '{{ method_field('PUT') }}';
                console.log($('#rapport_form'));
                $('.action-btn').html('Modifier');
                $('html,body').animate({
                    scrollTop: 0
                }, 'fast');


            });
            document.getElementById("bar").style.display = "none";
        });
    </script>

    <script src="{{ asset('assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script>
        One.helpersOnLoad(['jq-magnific-popup']);
    </script>
@endpush
