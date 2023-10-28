@extends('layouts.dashboard')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/magnific-popup/magnific-popup.css') }}">
@endpush

@section('dash')

    <div class="bg-image" style="background-image: url('{{ asset('assets/media/avatars/promo-code.png') }}');">
        <div class="bg-primary-dark-op">
            <div class="content content-full text-center py-7 pb-5">
                <h1 class="h2 text-white mb-2">
                    Objet de la permission
                </h1>
                <h2 class="h4 fw-normal text-white-75">
                    {{ \Str::ucfirst(str_replace('\\', '',$permission->motif)) }}
                </h2>


                <p class="fs-sm mb-1 text-white">
                   Sur une période du <br>
                    {{ \Str::lower(\Carbon\Carbon::parse($permission->start_at)->locale('fr')->isoFormat('D MMMM à h:m'),) }} au
                    {{ \Str::lower(\Carbon\Carbon::parse($permission->end_at)->locale('fr')->isoFormat('D MMMM, Y à h:m'),) }}
                </p>
            </div>
        </div>
    </div>
    <div class="bg-body-extra-light">
        <div class="content content-boxed py-3">
            <nav aria-label="breadcrumb">

            </nav>
        </div>
    </div>
    <div class="content content-boxed">
        <div class="row">
            <div class="col-xl-8">
                <div class="block block-rounded">
                    <div class="block-content">
                        <h3>{{ \Str::ucfirst(str_replace('\\', '',$permission->motif)) }}</h3>
                        <p> {!! \Str::ucfirst(str_replace('\\', '',$permission->description)) !!}.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <a class="block block-rounded block-link-shadow" href="javascript:void(0)">
                    <div class="block-header block-header-default text-center">
                        <h3 class="block-title">Démander par :</h3>
                    </div>
                    <div class="block-content block-content-full text-center">
                        <div class="push">
                            <img class="img-avatar" src="{{ asset(optional($permission->user->profile)->url ?? 'assets/media/avatars/avatar10.jpg') }}" alt="">
                        </div>
                        <div class="fw-semibold mb-1">{{$permission->user->last_name }} {{$permission->user->first_name }}
                        </div>
                        <div class="fs-sm text-muted">{{ optional(optional($permission->user)->user_actual_poste)->first()->name }}</div>
                    </div>
                </a>
            </div>
        </div>

    </div>

@endsection

{{-- JAVASCRIPT INCLUDE SECTION --}}
@push('js')

<script>
    $(document).ready(function() {

            document.getElementById("bar").style.display = "none";
        });
</script>

@endpush
