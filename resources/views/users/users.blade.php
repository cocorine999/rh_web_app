@extends('layouts.dashboard')

{{-- SETTINGS PAGE SPECIFICATION --}}
@section('title')
    UTILISATEURS
@endsection

@section('subtitle')
    UTILISATEURS DU SYSTEME
@endsection

@section('dash')
    <div class="block-content">
        {{-- @canany(['manage-users', 'create-users']) --}}
            <div class="mb-4" style="display: flex;">

                <button id="newUser" type="button" class="btn btn-primary m-1 action-btn-cancel" data-bs-toggle="modal"
                    data-bs-target="#app-modal" data-backdrop="static" data-keyboard="false">
                    <i class="fa fa-plus opacity-50"></i> Nouvel utilisateur
                </button>
            </div>
        {{-- @endcanany --}}

        <div id="form_id" style="display: none!important;" class="block block-rounded d-flex flex-column h-100 mb-4">
            <div class="bg-body-light rounded-bottom">
                <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                    href="javascript:void(0)">
                    <span id="update">AJOUT D'UN NOUVEL UTILISATEUR</span>

                </a>
            </div>
            <div class="block-content block-content-full justify-content-between align-items-center">

                {{-- <form id="user_form" method="POST" action="{{ route('dashboard.users.store') }}">
                    @csrf

                    <p id="user_form_method"></p>

                    <div class="mb-4">
                        <label class="form-label" for="last_name">Nom</label>
                        <small class="help-block" style="color:red; font-size:small">*</small>
                        <input type="text" id="user-last-name" name="last_name" placeholder="AGBOKOU"
                            class="form-control form-control-lg @error('last_name') is-invalid @enderror" name="last_name"
                            value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                        <small class="help-block" style="color:red; font-size:small"></small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="first_name">Prénom</label>
                        <small class="help-block" style="color:red; font-size:small">*</small>
                        <input type="text" id="user-first-name" name="first_name" placeholder="Pierre"
                            class="form-control form-control-lg @error('first_name') is-invalid @enderror" name="first_name"
                            value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                        <small class="help-block" style="color:red; font-size:small"></small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="date_naissance">Date naissance</label>
                        <small class="help-block" style="color:red; font-size:small">*</small>
                        <input type="date" id="user-date-naissance" min="1920-02-26" max="2002-01-31" name="date_naissance"
                            placeholder="1996-04-21"
                            class="form-control form-control-lg @error('date_naissance') is-invalid @enderror"
                            name="date_naissance" value="{{ old('date_naissance') }}" required
                            autocomplete="date_naissance" autofocus>
                        <small class="help-block" style="color:red; font-size:small"></small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="civilite">Civilité</label>
                        <small class="help-block" style="color:red; font-size:small">*</small>
                        <select class="form-select" id="user-civilite" name="civilite"
                            class="form-control form-control-lg @error('civilite') is-invalid @enderror">
                            <option selected="">Faites votre choix</option>
                            <option value="mr">Monsieur</option>
                            <option value="mme">Madame</option>
                            <option value="mlle">Demoiselle</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="status_matrimoniale">Status matimoniale</label>
                        <small class="help-block" style="color:red; font-size:small">*</small>
                        <select class="form-select" id="user-status-matrimoniale" name="status_matrimoniale"
                            class="form-control form-control-lg @error('civilite') is-invalid @enderror">
                            <option selected="">Faites votre choix</option>
                            <option value="Célibataire">Célibataire</option>
                            <option value="Fiancé(e)">Fiancé(e)</option>
                            <option value="Marié(e)">Marié(e)</option>
                            <option value="Divorcé">Divorcé</option>
                            <option value="Veuf(ve)">Veuf(ve)</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="telephone">Téléphone</label>
                        <small class="help-block" style="color:red; font-size:small">*</small>
                        <input type="number" id="user-telephone" name="telephone" placeholder="90000000"
                            class="form-control form-control-lg @error('telephone') is-invalid @enderror" name="telephone"
                            value="{{ old('telephone') }}" required autocomplete="telephone" autofocus>
                        <small class="help-block" style="color:red; font-size:small"></small>
                    </div>


                    <div class="mb-4">
                        <label class="form-label" for="email">Adresse email</label>
                        <small class="help-block" style="color:red; font-size:small">*</small>
                        <input type="email" id="user-email" name="email" placeholder="90000000"
                            class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <small class="help-block" style="color:red; font-size:small"></small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="role">Rôle</label>
                        <small class="help-block" style="color:red; font-size:small">*</small>
                        <select class="form-select" id="user-roles" name="roles[]" multiple
                            onclick="event.preventDefault(); window.abilities = JSON.parse('{{ json_encode($abilities) }}');"
                            class="form-control form-control-lg @error('role') is-invalid @enderror">

                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" id="user-roles-{{ $role->id }}">
                                    {{ str_replace('\\', '', $role->name) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="role">Poste</label>
                        <small class="help-block" style="color:red; font-size:small">*</small>
                        <select class="form-select" id="user-postes" name="postes[]" multiple
                            onclick="event.preventDefault(); window.abilities = JSON.parse('{{ json_encode($abilities) }}');"
                            class="form-control form-control-lg @error('role') is-invalid @enderror">

                            @foreach ($postes as $poste)
                                <option value="{{ $poste->id }}" id="user-postes-{{ $poste->id }}">
                                    {{ str_replace('\\', '', $poste->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="abilities-section" style="display: none;">
                        <label class="form-label mb-2" for="name">Permissions</label>
                        <ul style="list-style-type:none; display:inline-block;" id="">

                            @foreach ($abilities as $key => $ability)
                                <li style="list-style-type:none; display:inline-block;" class="col-xl-2 mb-4">
                                    <input type="checkbox" name="abilities[]" value="{{ $ability->id }}"
                                        id="user-abilities-{{ $ability->id }}">
                                    <div>
                                        <label class="form-label"
                                            for="name">{{ \Str::upper(str_replace('\\', '', $ability->name)) }}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="" style=" display: flex;">
                        <button type="submit" class="btn btn-primary m-1 action-btn"
                            style="display: inline-block;">Enregistrer</button>
                        <button type="button" class="btn btn-secondary m-1 action-btn-cancel" onclick="
                                                                            event.preventDefault(); /* $('#user-last-name').val('');
                                                                             $('#user-first-name').val('');
                                                                             $('#user-telephone').val('');
                                                                             $('#user-email').val('');
                                                                             $('#user-civilite').val('');
                                                                             $('#user-status-matrimoniale').val('');
                                                                             $('#user-date-naissance').val('');
                                                                             $('#user-postes').val('');
                                                                             $('#user-roles').val('');
                                                                            $('.action-btn').html('Enregistrer'); */

                                                                        document.getElementById('user_form_method').innerHTML = '';
                                                                        document.getElementById('user_form').setAttribute('action','{{ route('dashboard.users.store') }}');
                                                                            $('#update').html('AJOUT D\'UN NOUVEL UTILISATEUR');

                                                                                $('#user_form').load(location.href+' #user_form>*','');
                                                                            " style="display: inline-block;">
                            Cancel
                        </button>
                    </div>
                </form> --}}
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success mb-4">
                <p>{{ $message }}</p>
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
                    Liste des utilisateurs
                </div>

                <div class="block-options space-x-1">
                    <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle"
                        data-target="#one-dashboard-search-orders" data-class="d-none" id="searchBtn">
                        <svg class="svg-inline--fa fa-search fa-w-16" aria-hidden="true" data-prefix="fa" data-icon="search"
                            user="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                            </path>
                        </svg>
                    </button>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-sm btn-alt-secondary" id="dropdown-recent-orders-filters"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg class="svg-inline--fa fa-flask fa-w-14 fa-fw" aria-hidden="true" data-prefix="fa"
                                data-icon="flask" user="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M437.2 403.5L320 215V64h8c13.3 0 24-10.7 24-24V24c0-13.3-10.7-24-24-24H120c-13.3 0-24 10.7-24 24v16c0 13.3 10.7 24 24 24h8v151L10.8 403.5C-18.5 450.6 15.3 512 70.9 512h306.2c55.7 0 89.4-61.5 60.1-108.5zM137.9 320l48.2-77.6c3.7-5.2 5.8-11.6 5.8-18.4V64h64v160c0 6.9 2.2 13.2 5.8 18.4l48.2 77.6h-172z">
                                </path>
                            </svg><!-- <i class="fa fa-fw fa-flask"></i> -->
                            Filters
                            <svg class="svg-inline--fa fa-angle-down fa-w-10 ms-1" aria-hidden="true" data-prefix="fa"
                                data-icon="angle-down" user="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
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
                                Poste
                                <input type="checkbox" name="poste_check" id="filterPosteCheck"
                                    onchange=" var value = this.checked; document.getElementById('filter-postes-section').style.display = value ? 'block' : 'none';">

                            </a>


                            <div id="filter-postes-section" style="display: none;">
                                <ul style="margin:0%!important; padding:6px!important;  list-style-type:none; display:inline-block;"
                                    id="">

                                    @foreach ($postes as $key => $poste)
                                        <li class="">

                                            <div class="col">
                                                <input type="checkbox" name="filter_postes[]" value="{{ $poste->id }}"
                                                    id="filter-postes">
                                                <label class="form-label text-center" style="font-size: 11px!important;"
                                                    for="name">{{ \Str::upper(str_replace('\\', '', $poste->name)) }}</label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                                href="javascript:void(0)">
                                Présent
                                <span class="badge bg-primary rounded-pill">{{ count($users) - 2 }}</span>
                            </a>
                            <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                                href="javascript:void(0)">
                                Abscent
                                <span class="badge bg-primary rounded-pill">{{ 2 }}</span>
                            </a>
                            <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between"
                                href="javascript:void(0)">
                                All
                                <span class="badge bg-primary rounded-pill">{{ count($users) }}</span>
                            </a>
                            <button type="button" style="color:#fff"
                                class="btn btn-sm btn-alt-secondary bg-primary text-right m-1"
                                onclick="event.preventDefault(); filterUsers();" style="font-size: .875rem!important;">
                                <i class="fa fa-fw fa-search opacity-50"></i>
                                Filtrer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="one-dashboard-search-orders" class="block-content border-bottom d-none">
                <form action="be_pages_dashboard.html" method="POST" onsubmit="return false;">
                    @csrf
                    <div class="push">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-alt" id="searchValue"
                                onchange="filterUsers();" onkeyup="this.onchange()"
                                oninput="this.onchange(); console.log('oninput')" onpaste="this.onchange()"
                                name="searchValue" placeholder="Search users..">
                            <span class="input-group-text bg-body border-0"
                                onclick="event.preventDefault(); filterUsers();">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>


            <div id="tableDIV" class="block-content block-content-full">
                <table class="table table-borderless table-striped table-vcenter js-dataTable-buttons">

                    <thead>
                        <tr>
                            <th class="text-center">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" value="" id="check-all"
                                        name="check-all">
                                    <label class="form-check-label" for="check-all"></label>
                                </div>
                            </th>
                            <th style="width: 30%;">Nom & Prénom</th>
                            <th>Contact</th>
                            <th>Poste</th>
                            <th>Salaire</th>
                            <th class="d-none d-sm-table-cell text-center" style="width: 30%;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-content">
                        @foreach ($users as $user)
                            <tr>
                                <td class="text-center">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                        <label class="form-check-label" for="row_1"></label>
                                    </div>
                                </td>
                                <td class="fs-sm">
                                    <p class="fw-semibold mb-1">
                                        <a>{{ \Str::ucfirst($user->civilite) }}
                                            {{ str_replace('\\', '', $user->last_name) }}
                                            {{ str_replace('\\', '', $user->first_name) }}</a>
                                    </p>
                                </td>

                                <td class="fs-sm">

                                    {{ $user->telephone }}

                                    <p class="text-muted mb-0">
                                        {{ $user->email }}
                                    </p>

                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <span
                                        class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success">
                                        {{ \Str::upper(optional(optional(optional($user)->user_actual_poste)->last())->name) ?? 'Arrêt' }}
                                    </span>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">{{ $user->salaire }}</td>
                                <td class="text-center">
                                    <div class="btn-group">

                                        <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST">


                                            @canany(['manage-users', 'view-users'])
                                                <a type="button" id="viewRapport"
                                                    href="{{ route('dashboard.users.show', $user->id) }}"
                                                    onclick="window.User =  $user; console.log('ok');"
                                                    class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                    data-bs-toggle="tooltip" title="Consulter"
                                                    data-bs-original-title="Edit Rapport">
                                                    <i class="fa fa-fw fa-eye"></i>
                                                </a>
                                             @endcanany

                                        @canany(['manage-users', 'update-users'])
                                                <a type="submit" id="editUser" data-bs-toggle="modal"
                                                    data-bs-target="#app-modal" data-backdrop="static" data-keyboard="false"
                                                    onclick="event.preventDefault();
                                                                                    console.log('edit');

                                                                                    $('#app-modal-form')[0].reset();
                                                                                    $('#user-last-name').val('{{ $user->last_name }}');
                                                                                    $('#user-first-name').val('{{ $user->first_name }}');
                                                                                    $('#user-civilite').val('{{ $user->civilite }}');
                                                                                    $('#user-date-naissance').val('{{ $user->date_naissance }}');
                                                                                    $('#user-email').val('{{ $user->email }}');
                                                                                    $('#user-telephone').val('{{ $user->telephone }}');
                                                                                    $('#user-status-matrimoniale').val('{{ $user->status_matrimoniale }}');

                                                                                    document.getElementById('abilities-section').style.display = 'block';

                                                                                    var data = {{ $user->abilities->pluck('id') }};

                                                                                    window.User = {{ $user }};

                                                                                    for (var i = 0; i < data.length; i++) {
                                                                                        document.getElementById('user-abilities-'+data[i]).checked = true;
                                                                                    }

                                                                                    var data = {{ $user->roles->pluck('id') }};

                                                                                    for (var i = 0; i < data.length; i++) {
                                                                                        document.getElementById('user-roles-'+data[i]).selected = true;
                                                                                    }

                                                                                    var data = {{ $user->postes->where('pivot.in_function', true)->pluck('id') }};

                                                                                    for (var i = 0; i < data.length; i++) {
                                                                                        document.getElementById('user-postes-'+data[i]).selected = true;
                                                                                    }

                                                                                    document.getElementById('app-modal-form').setAttribute('action','{{ route('dashboard.users.update', $user->id) }}');
                                                                                    "
                                                    class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                    data-bs-toggle="tooltip" title="" data-bs-original-title="Edit User">
                                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                                </a>
                                            @endcanany

                                           {{--  @csrf
                                            @method('DELETE')

                                            --}}

                                            @canany(['manage-users', 'delete-users'])
                                                <button
                                                    onclick=" event.preventDefault(); window.request = '{{ route('dashboard.users.destroy', $user->id) }}'; deleteUser();"
                                                    class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled btn btn-alt-secondary push mb-md-0"
                                                    data-bs-toggle="tooltip" title="" data-bs-original-title="Remove Client">
                                                    <i class="fa fa-fw fa-times"></i>
                                                </button>
                                            @endcanany

                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div id="form_id" style="display: none!important;" class="block block-rounded d-flex flex-column h-100 mb-4">
        <div class="bg-body-light rounded-bottom">
            <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                href="javascript:void(0)">
                <span id="update">AJOUT D'UN NOUVEL UTILISATEUR</span>

            </a>
        </div>
        <div class="block-content block-content-full justify-content-between align-items-center">

            <form id="user_form" method="POST" action="{{ route('dashboard.users.store') }}">
                @csrf



                <div class="" style=" display: flex;">
                    <button type="submit" class="btn btn-primary m-1 action-btn"
                        style="display: inline-block;">Enregistrer</button>
                    <button type="button" class="btn btn-secondary m-1 action-btn-cancel" onclick="
                                                                                        event.preventDefault();

                                                                                    document.getElementById('user_form_method').innerHTML = '';
                                                                                    document.getElementById('user_form').setAttribute('action','{{ route('dashboard.users.store') }}');
                                                                                        $('#update').html('AJOUT D\'UN NOUVEL UTILISATEUR');

                                                                                            $('#user_form').load(location.href+' #user_form>*','');
                                                                                        " style="display: inline-block;">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>



@endsection

@section('form-content')

    <div class="mb-4">
        <label class="form-label" for="last_name">Nom</label>
        <small class="help-block" style="color:red; font-size:small">*</small>
        <input type="text" id="user-last-name" name="last_name" placeholder="AGBOKOU"
            class="form-control form-control-lg @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}">
        <small class="help-block" style="color:red; font-size:small"></small>
    </div>

    <div class="mb-4">
        <label class="form-label" for="first_name">Prénom</label>
        <small class="help-block" style="color:red; font-size:small">*</small>
        <input type="text" id="user-first-name" name="first_name" placeholder="Pierre"
            class="form-control form-control-lg @error('first_name') is-invalid @enderror"
            value="{{ old('first_name') }}">
        <small class="help-block" style="color:red; font-size:small"></small>
    </div>

    <div class="mb-4">
        <label class="form-label" for="date_naissance">Date naissance</label>
        <small class="help-block" style="color:red; font-size:small">*</small>
        <input type="date" id="user-date-naissance" min="1920-02-26" max="2002-01-31" placeholder="1996-04-21"
            class="form-control form-control-lg @error('date_naissance') is-invalid @enderror" name="date_naissance"
            value="{{ old('date_naissance') }}">
        <small class="help-block" style="color:red; font-size:small"></small>
    </div>

    <div class="mb-4">
        <label class="form-label" for="civilite">Civilité</label>
        <small class="help-block" style="color:red; font-size:small">*</small>
        <select class="form-select" id="user-civilite" name="civilite"
            class="form-control form-control-lg @error('civilite') is-invalid @enderror">
            <option selected="">Faites votre choix</option>
            <option value="mr">Monsieur</option>
            <option value="mme">Madame</option>
            <option value="mlle">Demoiselle</option>
        </select>
        <small class="help-block" style="color:red; font-size:small"></small>
    </div>

    <div class="mb-4">
        <label class="form-label" for="status_matrimoniale">Status matimoniale</label>
        <small class="help-block" style="color:red; font-size:small">*</small>
        <select class="form-select" id="user-status-matrimoniale" name="status_matrimoniale"
            class="form-control form-control-lg @error('civilite') is-invalid @enderror">
            <option selected="">Faites votre choix</option>
            <option value="Célibataire">Célibataire</option>
            <option value="Fiancé(e)">Fiancé(e)</option>
            <option value="Marié(e)">Marié(e)</option>
            <option value="Divorcé">Divorcé</option>
            <option value="Veuf(ve)">Veuf(ve)</option>
        </select>
        <small class="help-block" style="color:red; font-size:small"></small>
    </div>

    <div class="mb-4">
        <label class="form-label" for="telephone">Téléphone</label>
        <small class="help-block" style="color:red; font-size:small">*</small>
        <input type="number" id="user-telephone" name="telephone" placeholder="90000000"
            class="form-control form-control-lg @error('telephone') is-invalid @enderror"
            value="{{ old('telephone') }}">
        <small class="help-block" style="color:red; font-size:small"></small>
    </div>


    <div class="mb-4">
        <label class="form-label" for="email">Adresse email</label>
        <small class="help-block" style="color:red; font-size:small">*</small>
        <input type="email" id="user-email" name="email" placeholder="johndoe@gmail.com"
            class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('email') }}">
        <small class="help-block" style="color:red; font-size:small"></small>
    </div>

    <div class="mb-4">
        <label class="form-label" for="role">Rôle</label>
        <small class="help-block" style="color:red; font-size:small">*</small>
        <select class="form-select" id="user-roles" name="roles[]" multiple
            onclick="event.preventDefault(); window.abilities = JSON.parse('{{ json_encode($abilities) }}');"
            class="form-control form-control-lg @error('role') is-invalid @enderror">

            @foreach ($roles as $role)
                <option value="{{ $role->id }}" id="user-roles-{{ $role->id }}">
                    {{ str_replace('\\', '', $role->name) }}</option>
            @endforeach
        </select>
        <small class="help-block" style="color:red; font-size:small"></small>
    </div>

    <div class="mb-4">
        <label class="form-label" for="role">Poste</label>
        <small class="help-block" style="color:red; font-size:small">*</small>
        <select class="form-select" id="user-postes" name="postes[]" multiple
            onclick="event.preventDefault(); window.abilities = JSON.parse('{{ json_encode($abilities) }}');"
            class="form-control form-control-lg @error('role') is-invalid @enderror">

            @foreach ($postes as $poste)
                <option value="{{ $poste->id }}" id="user-postes-{{ $poste->id }}">
                    {{ str_replace('\\', '', $poste->name) }}</option>
            @endforeach
        </select>
        <small class="help-block" style="color:red; font-size:small"></small>
    </div>
    <div id="abilities-section" style="display: none;">
        <label class="form-label mb-2" for="name">Permissions</label>
        <ul style="list-style-type:none; display:inline-block;" id="">

            @foreach ($abilities as $key => $ability)
                <li style="list-style-type:none; display:inline-block;" class="col-xl-2 mb-4">
                    <input class="form-check-input" type="checkbox" name="abilities[]" value="{{ $ability->id }}"
                        id="user-abilities-{{ $ability->id }}">
                    <div>
                        <label class="form-label form-check-label"
                            for="name">{{ \Str::upper(str_replace('\\', '', $ability->name)) }}</label>
                    </div>
                </li>
            @endforeach
        </ul>
        <small class="help-block" style="color:red; font-size:small"></small>
    </div>

@endsection

{{-- JAVASCRIPT INCLUDE SECTION --}}
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {

            document.getElementById('app-modal').children[0].classList.add('modal-lg')
            var sectionValue;
            $('body').on('click', '#editUser', function(event) {
                /* document.getElementById('user_form_method').innerHTML = '{{ method_field('PUT') }}';
                $('.action-btn').html('Modifier');
                $('html,body').animate({
                    scrollTop: 0
                }, 'fast'); */
                //$('html,body').animate({ scrollTop: 0 }, 'fast');
                event.preventDefault();

                document.getElementById('app-modal-form').setAttribute('method', "PUT");


                document.getElementById('app-modal-title').innerHTML =
                    'MODIFICATION DES INF0RMATIONS D\'UN UTILISATEUR';

                $('.app-modal-submit-btn-title').html('Mise à jour');

            });


            $('#app-modal').modal({
                backdrop: 'static',
                keyboard: false // to prevent closing with Esc button (if you want this too)
            });

            // ADD NEW USER ONCLICK FUNCTION

            $('body').on('click', '#newUser', function(event) {

                event.preventDefault();

                $('#app-modal-form').load(location.href + ' #app-modal-form>*', '');

                document.getElementById('app-modal-form-method').innerHTML = '';

                document.getElementById('app-modal-form').setAttribute('action',
                    '{{ route('dashboard.users.store') }}');

                document.getElementById('app-modal-form').setAttribute('method', "POST");

                document.getElementById('app-modal-title').innerHTML = 'AJOUT D\'UN NOUVEL UTILISATEUR';

                $('.app-modal-submit-btn-title').html('Ajouter');

            });

            $('body').on('click', '#user-postes', function(event) {

                //updateAccess();
                updateAccess();


            });

            $('body').on('click', '#user-roles', function(event) {
                updateAccess();

            });

        });
    </script>
    <script>
        function updateAccess() {
            /* access = abilities;
            for (var i = 0; i < abilities.length; i++) {
                document.getElementById('user-abilities-'+abilities[i]).checked = true;
            }
            */

            var selectPostes = $('#user-postes').val();

                var postes = <?php echo json_encode($postes); ?>;

                var posteIds = window.User.user_actual_poste.map(s=>s.id);

                for (let i = 0; i < posteIds.length; i++) {

                    if(!selectPostes.includes(String(posteIds[i]))){

                        postes.filter(function (poste) {

                            if(poste.id == posteIds[i]){

                                poste.abilities.forEach(ability => {
                                    document.getElementById('user-abilities-'+ability.id).checked = false;
                                });

                            }
                        });
                    }
                }

                for (let i = 0; i < selectPostes.length; i++) {

                    if(!posteIds.includes(parseInt(selectPostes[i]))){

                        postes.filter(function (poste) {

                            if(poste.id == selectPostes[i]){

                                poste.abilities.forEach(ability => {
                                    document.getElementById('user-abilities-'+ability.id).checked = true;
                                });

                            }

                        });

                    }

                }

            var selectRoles = $('#user-roles').val();

                var roles = <?php echo json_encode($roles); ?>;

                var roleIds = window.User.roles.map(s=>s.id);

                for (let i = 0; i < roleIds.length; i++) {

                    if(!selectRoles.includes(String(roleIds[i]))){

                        roles.filter(function (role) {

                            if(role.id == roleIds[i]){

                                role.abilities.forEach(ability => {
                                    document.getElementById('user-abilities-'+ability.id).checked = false;
                                });

                            }
                        });
                    }
                }

                for (let i = 0; i < selectRoles.length; i++) {

                    if(!roleIds.includes(parseInt(selectRoles[i]))){

                        roles.filter(function (role) {

                            if(role.id == selectRoles[i]){

                                role.abilities.forEach(ability => {
                                    document.getElementById('user-abilities-'+ability.id).checked = true;
                                });

                            }

                        });

                    }

                }

        }
        function deleteUser() {
            var response = window.confirm('Voulez vous vraiment supprimé cet utilisateur???');

            if (response) {

                $.ajax({
                        url: window.request,
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {},
                        dataType: 'json',

                    }).done(function(data) {
                        //refresh table with new data
                        $('#tableDIV').load(location.href + ' #tableDIV>*', '');
                    })
                    .fail(function(data) {
                        alert(data.responseJSON.errors);
                    });
            }
        }

        function filterUsers(e) {
            console.log("searching ...");

            var filter_postes = $('input[name="filter_postes[]"]:checked');

            var filterPostes = [];

            if (filter_postes.length > 0) {

                for (let index = 0; index < filter_postes.length; index++) {

                    filterPostes.push(filter_postes[index].value);

                }

            }

            $.ajax({
                    url: "{{ route('dashboard.users.searchUsers') }}",

                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        filter_postes: filterPostes,
                        searchValue: $('#searchValue').val(),
                    },
                    dataType: 'json',

                }).done(function(data) {
                    console.log(data);
                    document.getElementById("tableDIV").innerHTML = data.output;
                    resetInputData();
                    //$('#tableDIV').load(location.href+' #tableDIV>*','');

                })
                .fail(function(data) {
                    console.log(data.responseJSON);
                    alert(data.responseJSON);
                    $.each(data.responseJSON.errors, function(key, value) {
                        var input = '#modal-block-normal input[name=' + key + ']';
                        $(input + '+small').text(value);
                        $(input).parent().addClass('has-error');
                    });
                });
        }

        function resetInputData() {

            document.getElementById('filterPosteCheck').checked = false;

            var filter_postes = $('input[name="filter_postes[]"]:checked');

            if (filter_postes.length > 0) {

                for (let index = 0; index < filter_postes.length; index++) {

                    filter_postes[index].checked = false;

                }

            }

        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('body').on('onchange', '#filterPosteCheck', function(event) {
                console.log(document.getElementById('filter-postes-section').style.display = document
                    .getElementById('filterPosteCheck').checked);
                document.getElementById('filter-postes-section').style.display = document.getElementById(
                    'filterPosteCheck').checked ? "block" : "none";
            });

            $("#filterPosteCheck").change(function() {
                if (this.checked) {
                    console.log('block');
                } else {
                    console.log('none');
                }
            });

            $('#filterPosteCheck').on('change', function() {
                console.log('oay');
                var _val = $(this).is(':checked') ? 'block' : 'none';
                document.getElementById('filter-postes-section').style.display = _val;
                alert(_val);
            });

            $('#searchValue').bind('change parse keyup', function() {
                console.log($('this').val);
            });

            //SUBMIT FORM ONCLICK FUNCTION

            $('body').on('click', '#app-modal-submit-btn', function(event) {

                var last_name = $('#user-last-name').val();
                var first_name = $('#user-first-name').val();
                var telephone = $('#user-telephone').val();
                var email = $('#user-email').val();
                var civilite = $('#user-civilite').val();
                var status_matrimoniale = $('#user-status-matrimoniale').val();
                var date_naissance = $('#user-date-naissance').val();
                var postes = $('#user-postes').val();
                var roles = $('#user-roles').val();
                var abilities_components = $('input[name="abilities[]"]:checked');
                var abilities = [];
                if (abilities_components.length > 0) {
                    for (let index = 0; index < abilities_components.length; index++) {
                        abilities.push(abilities_components[index].value);
                    }
                }

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
                        data: {
                            //request form data
                            last_name: last_name,

                            first_name: first_name,

                            telephone: telephone,

                            civilite: civilite,

                            email: email,

                            roles: roles,

                            abilities: abilities,

                            postes: postes,

                            date_naissance: date_naissance,

                            status_matrimoniale: status_matrimoniale,
                        },
                        dataType: 'json',

                    }).done(function(data) {

                        //request is succed
                        $('.alert-success').removeClass('hidden');

                        //refresh table with new data
                        $('#tableDIV').load(location.href + ' #tableDIV>*', '');

                        //Hide modal
                        $('#app-modal').modal('hide');

                        alert(data.message);

                    })
                    .fail(function(data) {
                        console.log(data);

                        // set each errors message to corresponding input
                        $.each(data.responseJSON.errors, function(key, value) {

                            var input = '#app-modal input[name=' + key + ']';

                            //console.log($(input + '+small'));

                            $(input + '+small').text(value);

                            $(input).parent().addClass('has-error');

                            var select = '#app-modal select[name=' + key + ']';

                            $(select + '+small').text(value);

                            $(select).parent().addClass('has-error');

                        });

                    });
            });

        });
    </script>


@endpush
