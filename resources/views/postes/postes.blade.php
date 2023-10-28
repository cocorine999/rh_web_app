@extends('layouts.dashboard')

{{-- SETTINGS PAGE SPECIFICATION --}}
@section('title')
    POSTES
@endsection

@section('subtitle')
    POSTES DU SYSTEME
@endsection

@section('dash')


<div class="block-content">
    @canany(['manage-postes','create-postes'])
    <div class="mb-4" style="display: flex;">

        <button id="btn-action" onclick="event.preventDefault(); document.getElementById('form_id').style.display = 'block';" type="button" class="btn btn-primary m-1 action-btn-cancel">
            <i class="fa fa-plus opacity-50"></i>
            Nouveau poste
        </button>
    </div>
    @endcanany

    <div id="form_id" style="display: none!important;" class="block block-rounded d-flex flex-column h-100 mb-4">

            <div class="bg-body-light rounded-bottom">
                <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                    href="javascript:void(0)">
                    <span id="update">AJOUT D'UN NOUVEAU POSTE</span>
                </a>
            </div>
            <div class="block-content block-content-full justify-content-between align-items-center">

                <form id="poste_form" method="POST" action="{{ route('dashboard.postes.store') }}">
                    @csrf

                    <p id="poste_form_method"></p>

                    <div class="mb-4">
                        <label class="form-label" for="name">Nom</label>
                        <input type="text" id="poste-name" name="name" placeholder="Comptable"
                            class="form-control form-control-lg @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required autocomplete="name" autofocus>
                        <small class="help-block" style="color:red; font-size:small"></small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="salaire">Salaire</label>

                        <input type="tel" id="poste-salaire" name="salaire" placeholder="100.000"
                            class="form-control form-control-lg @error('salaire') is-invalid @enderror" name="salaire"
                            value="{{ old('salaire') }}" required autocomplete="salaire" autofocus>
                        <small class="help-block" style="color:red; font-size:small"></small>
                    </div>



                    <div>
                        <ul style="list-style-type:none; display:inline-block;" id="">

                            @foreach ($abilities as $key => $ability)
                                <li style="list-style-type:none; display:inline-block;" class="col-xl-2 mb-4">
                                    <input type="checkbox" name="abilities[]" value="{{ $ability->id }}" id="poste-abilities-{{ $ability->id }}">
                                    <div>


                                    <label class="form-label" for="name">{{ \Str::upper(str_replace('\\', '', $ability->name)) }}</label>
                                    </div>

                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="" style="display: flex;">
                        <button type="submit" class="btn btn-primary m-1 action-btn"
                            style="display: inline-block;">Enregistrer</button>
                        <button type="button" class="btn btn-secondary m-1 action-btn-cancel" onclick="
                                        event.preventDefault();
                                        $('#poste_form').load(location.href+' #poste_form>*','');
                                        $('#update').html('AJOUT D\'UN NOUVEAU POSTE');
                                document.getElementById('poste_form').setAttribute('action','{{ route('dashboard.postes.store') }}');
                                        document.getElementById('poste_form_method').innerHTML = '';
                                        " style="display: inline-block;">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success mb-4">
                <p>{{ $message }}</p>
            </div>
        @endif

        @if ($message = Session::get('erreurs'))
            <div class="alert alert-danger mb-4">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <li>{{ $message }}</li>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger  mb-4">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="block block-rounded">

            <div class="block-header block-header-default">

                <div class="block-title mt-3 mt-md-0 ms-md-3 space-x-1">

                    {{-- <a class="btn btn-sm btn-alt-secondary" data-toggle="modal" data-target="#model-modal-apps">
                                <i class="fa fa-plus"></i>
                                <span>Ajouter</span>
                            </a>


                            <button type="button" class="btn btn-primary launch-modal" data-toggle="modal" data-target="#appModal">
                                Launch demo modal
                            </button>

                            <p class="edit">{{ $edit }}</p> --}}


                    Liste des postes


                </div>

                <div class="block-options space-x-1">
                    <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle"
                        data-target="#one-dashboard-search-orders" data-class="d-none">
                        <svg class="svg-inline--fa fa-search fa-w-16" aria-hidden="true" data-prefix="fa" data-icon="search"
                            poste="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                            </path>
                        </svg>
                    </button>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-sm btn-alt-secondary" id="dropdown-recent-orders-filters"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg class="svg-inline--fa fa-flask fa-w-14 fa-fw" aria-hidden="true" data-prefix="fa"
                                data-icon="flask" poste="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M437.2 403.5L320 215V64h8c13.3 0 24-10.7 24-24V24c0-13.3-10.7-24-24-24H120c-13.3 0-24 10.7-24 24v16c0 13.3 10.7 24 24 24h8v151L10.8 403.5C-18.5 450.6 15.3 512 70.9 512h306.2c55.7 0 89.4-61.5 60.1-108.5zM137.9 320l48.2-77.6c3.7-5.2 5.8-11.6 5.8-18.4V64h64v160c0 6.9 2.2 13.2 5.8 18.4l48.2 77.6h-172z">
                                </path>
                            </svg><!-- <i class="fa fa-fw fa-flask"></i> -->
                            Filters
                            <svg class="svg-inline--fa fa-angle-down fa-w-10 ms-1" aria-hidden="true" data-prefix="fa"
                                data-icon="angle-down" poste="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                                data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z">
                                </path>
                            </svg><!-- <i class="fa fa-angle-down ms-1"></i> -->
                        </button>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end fs-sm"
                            aria-labelledby="dropdown-recent-orders-filters">
                            <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                                href="javascript:void(0)">
                                Pending
                                <span class="badge bg-primary rounded-pill">20</span>
                            </a>
                            <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                                href="javascript:void(0)">
                                Active
                                <span class="badge bg-primary rounded-pill">72</span>
                            </a>
                            <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                                href="javascript:void(0)">
                                Completed
                                <span class="badge bg-primary rounded-pill">890</span>
                            </a>
                            <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                                href="javascript:void(0)">
                                All
                                <span class="badge bg-primary rounded-pill">997</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="one-dashboard-search-orders" class="block-content border-bottom d-none">
                <form action="{{ route('dashboard.postes.search-poste') }}" method="POST" onsubmit="return false;">
                    @csrf
                    <div class="push">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-alt" id="one-ecom-orders-search"
                                name="searchValue" placeholder="Search postes..">
                            <span class="input-group-text bg-body border-0">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>

            <div class="block-content">

                <table class="js-table-checkable table table-hover table-vcenter js-table-checkable-enabled">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 70px;">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" value="" id="check-all"
                                        name="check-all">
                                    <label class="form-check-label" for="check-all"></label>
                                </div>
                            </th>
                            <th class="text-center" style="width: 50px;">#</th>
                            <th>Poste</th>
                            <th>Salaire par défaut</th>
                            <th>Salaire maximum</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Nombre d'utilisateur</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Droit d'accès</th>
                            <th class="d-none d-sm-table-cell text-center" style="width: 20%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($postes as $poste)
                            <tr>
                                <td class="text-center">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                        <label class="form-check-label" for="row_1"></label>
                                    </div>
                                </td>
                                <th class="text-center" scope="row">{{ $i }}</th>
                                <td class="fs-sm">
                                    <p class="fw-semibold mb-1">
                                        <a>{{ \Str::ucfirst(str_replace('\\','',$poste->name)) }}</a>
                                    </p>
                                    <p class="text-muted mb-0">
                                        {{ $poste->slug }}
                                    </p>
                                </td>
                                <td class="fs-sm">
                                    <p class="fw-semibold mb-1">
                                        <a>{{ $poste->salaire }}</a>
                                    </p>
                                </td>
                                <td class="fs-sm">
                                    <p class="fw-semibold mb-1">
                                        <a>{{ $poste->salaire }}</a>
                                    </p>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <span
                                        class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success">{{ $poste->users_count }}</span>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <span
                                        class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success">{{ $poste->abilities_count }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">

                                        <form action="{{ route('dashboard.postes.destroy', $poste->id) }}" method="POST">

                                            @canany(['manage-postes','update-postes'])
                                            <a type="submit" id="editPoste"
                                                onclick="event.preventDefault();
                                                document.getElementById('form_id').style.display = 'block';
                                                    $('#poste-name').val('{{ $poste->name }}');
                                                    $('#poste-salaire').val('{{ $poste->salaire }}');
                                                    $('#poste-abilities').val('{{ count($poste->abilities)>0 ? $poste->abilities->pluck('id') : 0 }}');

                                                        var data = {{ $poste->abilities->pluck('id') }};

                                                        for (var i = 0; i < data.length; i++) {
                                                            document.getElementById('poste-abilities-'+data[i]).checked = true;
                                                        }
                                                    $('#update').html('MODIFICATION DES INF0RMATIONS D\'UN POSTE');
                                                    document.getElementById('poste_form').setAttribute('action','{{ route('dashboard.postes.update', $poste->id) }}');"
                                                class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                data-bs-toggle="tooltip" title="Modifier" data-bs-original-title="Edit Client">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </a>
                                            @endcanany

                                            @csrf
                                            @method('DELETE')

                                            @canany(['manage-postes','delete-postes'])
                                            <button type="submit" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                data-bs-toggle="tooltip" title="Supprimer" data-bs-original-title="Remove Client">
                                                <i class="fa fa-fw fa-times"></i>
                                            </button>
                                            @endcanany
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
                {!! $postes->links() !!}
            </div>
        </div>
    </div>

    {{-- Modal section --}}
@section('modal-content')
    <form id="modal_form">
        <div class="mb-4">
            <label class="form-label" for="name">Nom</label>
            <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="Administrateur">
        </div>
        <div class="row mb-4 text-center">
            <div class="col-md-6 col-xl-6 text-center">
                <button class="btn w-100 btn-alt-info" id="submit_form">
                    <i class="fa fa-save fa-save me-1 opacity-50"></i>
                    Enregistrer
                </button>
            </div>
        </div>
    </form>

@endsection

{{-- @section('contenu')
    @include('postes.form')
@endsection --}}
@section('model-title-modal-apps')
    AJOUTER D'UN NOUVEAU POSTE
@endsection

@endsection

{{-- JAVASCRIPT INCLUDE SECTION --}}
@push('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('body').on('click', '#editPoste', function(event) {
            document.getElementById('poste_form_method').innerHTML = '{{ method_field('PUT') }}';
            $('.action-btn').html('Modifier');
            $('html,body').animate({
                scrollTop: 0
            }, 'fast');
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('body').on('click', '#submit_form', function(event) {
            console.log("coucou");
            event.preventDefault()
            var name = $("#poste-name").val();
            console.log(name);

            $('input+small').text('');
            $('input').parent().removeClass('has-error');

            $.ajax({
                    url: 'postes/store',
                    type: "POST",
                    data: {
                        name: name,
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#modal_form').trigger("reset");
                        $('#appModal').modal('hide');
                        window.location.reload(true);
                    }
                })
                .done(function(data) {
                    $('.alert-success').removeClass('hidden');
                    $('#appModal').modal('hide');
                    window.location.reload(true);
                })
                .fail(function(data) {
                    console.log(data.responseJSON);
                    $.each(data.responseJSON.errors, function(key, value) {
                        var input = '#modal_form input[name=' + key + ']';
                        $(input + '+small').text(value);
                        $(input).parent().addClass('has-error');

                        var select = '#modal_form select[name=' + key + ']';
                        console.log(select);
                        $(select + '+small').text(value);
                        $(select).parent().addClass('has-error');
                    });
                });


        });

    });
</script>
@endpush
