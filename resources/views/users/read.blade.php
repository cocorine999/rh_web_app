@extends('layouts.dashboard')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/fullcalendar/main.min.css') }}">
@endpush

@section('title')
    UTILISATEURS
@endsection

@section('subtitle')
    DÉTAILS UTILISATEURS
@endsection
@section('dash')

    <div class="content">
        <div class="row">
            <div class="col-6">
                <a class="block block-rounded block-link-shadow text-center" id="editUser" data-bs-toggle="modal"
                    data-bs-target="#app-modal" data-backdrop="static" data-keyboard="false" href="javascript:void(0)"
                    onclick="event.preventDefault();
                                console.log('edit');

                document.getElementById('app-modal').children[0].classList.add('modal-lg');

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
                                ">
                    <div class="block-content block-content-full">
                        <div class="fs-2 fw-semibold text-dark">
                            <i class="fa fa-pencil-alt"></i>
                        </div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="fw-medium fs-sm text-muted mb-0">
                            Modifier
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6">
                <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)"
                    onclick="event.preventDefault(); deleteUser()">
                    <div class="block-content block-content-full">
                        <div class="fs-2 fw-semibold text-danger">
                            <i class="fa fa-times"></i>
                        </div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="fw-medium fs-sm text-danger mb-0">
                            Supprimer
                        </p>
                    </div>
                </a>
            </div>
        </div>
        <div class="block block-rounded">
            <div class="block-content text-center">
                <div class="py-4">
                    <div class="mb-3">
                        <img class="img-avatar img-avatar-thumb"
                            src="{{ asset(optional($user->profile)->url ?? 'assets/media/avatars/avatar10.jpg') }}"
                            alt="">
                    </div>
                    <h1 class="fs-lg mb-0">
                        <span>{{ \Str::ucfirst($user->civilite) }} {{ str_replace('\\', '', $user->last_name) }}
                            {{ str_replace('\\', '', $user->first_name) }}</span>
                    </h1>
                    <p class="fs-sm fw-medium text-muted">
                        @foreach ($user->user_actual_poste as $poste)
                            {{ \Str::upper(str_replace('\\', '', $poste->name)) }}
                            @if ($user->user_actual_poste->last() != $poste)
                                /
                            @endif
                        @endforeach
                    </p>
                </div>
            </div>
            <div class="block-content bg-body-light text-center">
                <div class="row items-push text-uppercase">
                    <div class="col-6 col-md-3">
                        <div class="fw-semibold text-dark mb-1">Postes</div>
                        <a class="link-fx fs-3 text-primary"
                            href="javascript:void(0)">{{ $user->user_actual_poste->count() }}</a>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="fw-semibold text-dark mb-1">Rôles</div>
                        <a class="link-fx fs-3 text-primary" href="javascript:void(0)">{{ $user->roles->count() }}</a>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="fw-semibold text-dark mb-1">Permissions</div>
                        <a class="link-fx fs-3 text-primary"
                            href="javascript:void(0)">{{ $user->permissions->count() }}</a>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="fw-semibold text-dark mb-1">Abscences</div>
                        <a class="link-fx fs-3 text-primary"
                            href="javascript:void(0)">{{ $user->presences->where('is_present', -1)->count() }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="d-xl-none push">
            <div class="row g-sm">
                <div class="col-6">
                    <button type="button" class="btn btn-alt-secondary w-100" data-toggle="class-toggle"
                        data-target=".js-ecom-div-nav" data-class="d-none">
                        <i class="fa fa-fw fa-bars text-muted me-1"></i> Navigation
                    </button>
                </div>
                <div class="col-6">
                    <button type="button" class="btn btn-alt-secondary w-100" data-toggle="class-toggle"
                        data-target=".js-ecom-div-cart" data-class="d-none">
                        <i class="fa fa-fw fa-shopping-cart text-muted me-1"></i> Cart (3)
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 order-xl-1">
                <div class="block block-rounded js-ecom-div-nav d-none d-xl-block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-tags text-muted me-1"></i> Rôles
                        </h3>
                    </div>
                    <div class="block-content">
                        <ul class="nav nav-pills flex-column push">
                            @foreach ($user->roles as $role)
                                <li class="nav-item mb-1">
                                    <a class="nav-link d-flex justify-content-between align-items-center"
                                        href="javascript:void(0)">
                                        {{ $role->name }} <span class="badge rounded-pill bg-black-50 ms-1"></span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="block block-rounded js-ecom-div-nav d-none d-xl-block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-shield-alt text-muted me-1"></i> DROIT D'ACCÈS
                        </h3>
                    </div>
                    <div class="block-content" id="abilitiesBlock">

                        <span class="select2 select2-container mb-4 select2-container--default" dir="ltr"
                            data-select2-id="3" style="width: 100%;"><span class="selection"><span
                                    class="select2-selection select2-selection--multiple"
                                    style="border-color: white!important;" role="combobox" aria-haspopup="true"
                                    aria-expanded="false" tabindex="-1" aria-disabled="false">
                                    <ul class="select2-selection__rendered"
                                        style="border-color: white!important; padding-right: .0rem!important; padding-left: .0rem!important;">

                                        @foreach ($user->abilities as $ability)

                                            <li class="select2-selection__choice" title="HTML" data-select2-id="6">
                                                <a href="javascript:void(0)" id="retrieveID"
                                                    onclick="event.preventDefault(); console.log('cc'); window.AbilityID = '{{ $ability->id }}'; window.request = '{{ route('dashboard.users.retrievePermission', $user->id) }}'; "
                                                    type="button">
                                                    <span class="select2-selection__choice__remove"
                                                        role="presentation">×</span>
                                                </a> {{ $ability->name }}
                                            </li>

                                        @endforeach



                                    </ul>
                                </span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                    </div>
                </div>
                <div class="block block-rounded js-ecom-div-cart d-none d-xl-block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">
                            <i class="fa fa-fw fa-chart-line text-muted me-1"></i> EVOLUTION SALARIAL
                        </h3>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless table-hover table-vcenter">
                            <tbody>


                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="fs-sm fw-semibold text-success">Salaire mensuel</div>
                                        <div class="fs-sm text-muted"></div>
                                    </div>
                                    <div class="fs-2 fw-bold">
                                        {{ $user->salaire }}
                                    </div>
                                </div>
                                <hr>

                                @foreach ($salaires as $key => $salaire)

                                    @if ($salaire->motif == 'Augmentation')

                                        <tr>
                                            <td class="text-center">
                                                <a class="text-muted" href="javascript:void(0)"><i
                                                        class="fa fa-arrow-up text-success"></i></a>
                                            </td>
                                            <td>
                                                <a class="h6"
                                                    href="be_pages_ecom_store_product.html">{{ $salaire->motif }}</a>
                                                <div class="fs-sm text-muted">{{ $salaire->poste_user->poste->name }}
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <div class="fw-semibold">{{ $salaire->montant }}</div>
                                            </td>
                                        </tr>

                                    @elseif ($salaire->motif == 'Réduction')

                                        <tr>
                                            <td class="text-center">
                                                <a class="text-muted" href="javascript:void(0)"><i
                                                        class="fa fa-arrow-down text-danger"></i></a>
                                            </td>
                                            <td>
                                                <a class="h6"
                                                    href="be_pages_ecom_store_product.html">{{ $salaire->motif }}</a>
                                                <div class="fs-sm text-muted">{{ $salaire->poste_user->poste->name }}
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <div class="fw-semibold">{{ $salaire->montant }}</div>
                                            </td>
                                        </tr>

                                    @endif

                                @endforeach

                                @if (count($salaires) < 0)

                                    <tr class="table-active">
                                        <td class="text-center" colspan="3">
                                            <span class="h4 fw-medium">AUCUNE EVOLUTION</span>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="block-content block-content-full bg-body-light text-end">
                        @if (count($user->user_actual_poste) == 1)
                            <a class="btn btn-primary" href="javascript:void(0)"
                                onclick="event.preventDefault(); $('#user-graduation-poste-id-value').val('{{ $poste->id }}'); $('#user-graduation-motif').val('Augmentation'); $('#user-graduation-poste-id').val('{{ $poste->poste_users->last()->id }}'); document.getElementById('user-graduation-title').innerHTML = 'Augmentation de salaire';"
                                type="button" class="btn btn-sm btn-alt-secondary text-right" data-bs-toggle="modal"
                                data-bs-target="#user-graduation" data-backdrop="static" data-keyboard="false">
                                Augmenter
                                <i class="fa fa-arrow-up opacity-50 ms-1"></i>
                            </a>
                            <a class="btn btn-danger" href="javascript:void(0)"
                                onclick="event.preventDefault(); $('#user-graduation-poste-id-value').val('{{ $poste->id }}'); $('#user-graduation-motif').val('Réduction'); $('#user-graduation-poste-id').val('{{ $poste->poste_users->last()->id }}'); document.getElementById('user-graduation-title').innerHTML = 'Réduction de salaire';"
                                type="button" class="btn btn-sm btn-alt-secondary text-right" data-bs-toggle="modal"
                                data-bs-target="#user-graduation" data-backdrop="static" data-keyboard="false">
                                Réduire
                                <i class="fa fa-arrow-down opacity-50 ms-1"></i>

                            </a>
                        @endif
                    </div>
                </div>

            </div>
            <div class="col-xl-8 order-xl-0">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Informations personnelles</h3>
                    </div>
                    <div class="block-content">

                        <div class="row">
                            <div class="">
                            </div>
                        </div>

                        <div class="
                                block block-rounded">
                            <ul class="nav nav-tabs nav-tabs-alt align-items-center" role="tablist">
                                <li class="nav-item">
                                    <button type="button" class="nav-link active" id="ecom-product-info-tab"
                                        data-bs-toggle="tab" data-bs-target="#ecom-product-info" role="tab"
                                        aria-controls="ecom-product-reviews" aria-selected="true">Détails</button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" id="ecom-product-comments-tab"
                                        data-bs-toggle="tab" data-bs-target="#ecom-product-comments" role="tab"
                                        aria-controls="ecom-product-reviews" aria-selected="false">Historique des
                                        postes</button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" id="ecom-product-reviews-tab"
                                        data-bs-toggle="tab" data-bs-target="#ecom-product-reviews" role="tab"
                                        aria-controls="ecom-product-reviews" aria-selected="false">Extra</button>
                                </li>
                            </ul>
                            <div class="block-content tab-content">
                                <div class="tab-pane pull-x active" id="ecom-product-info" role="tabpanel"
                                    aria-labelledby="ecom-product-info-tab">
                                    <table class="table table-striped table-borderless">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Informations personnelles</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="width: 40%;">Nom </td>
                                                <td style="width: 60%;">
                                                    {{ str_replace('\\', '', $user->last_name) }} </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 40%;">Prénom</td>
                                                <td style="width: 80%;">
                                                    {{ str_replace('\\', '', $user->first_name) }}</td>
                                            </tr>

                                            <tr>
                                                <td style="width: 40%;">Civilité</td>
                                                <td style="width: 60%;"> {{ \Str::ucfirst($user->civilite) }} </td>
                                            </tr>
                                            <tr>
                                                <td>Âge</td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($user->date_naissance)->age }} ans
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 40%;">Status matrimoniale</td>
                                                <td style="width: 60%;">
                                                    {{ \Str::ucfirst($user->status_matrimoniale) }} </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 40%;">Numéro de téléphone</td>
                                                <td style="width: 60%;"> {{ $user->telephone }} </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 40%;">Adresse email</td>
                                                <td style="width: 60%;"> {{ $user->email }} </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane pull-x fs-sm" id="ecom-product-comments" role="tabpanel"
                                    aria-labelledby="ecom-product-comments-tab">

                                    @foreach ($user->postes->unique() as $key => $poste)

                                        <table class="table table-striped table-borderless">
                                            <thead>
                                                <tr>
                                                    <th>{{ $poste->name }}</th>
                                                    <th class="text-right">
                                                        @if ($poste->poste_users->last()->start_at == null && $poste->poste_users->last()->in_function == true)
                                                            <button
                                                                onclick="event.preventDefault();  $('#re_start_function').val(false); $('#user_poste_id_value').val('{{ $poste->poste_users->last()->id }}'); document.getElementById('modal-block-normal-title').innerHTML = 'Préciser la période de la fonction' "
                                                                type="button"
                                                                class="btn btn-sm btn-alt-secondary text-right"
                                                                data-bs-toggle="modal" data-bs-target="#modal-block-normal"
                                                                data-backdrop="static" data-keyboard="false">
                                                                <i class="fa fa-fw fa-calendar-check me-1"></i> Date de
                                                                prise de fonction
                                                            </button>

                                                        @elseif( $poste->poste_users->last()->in_function == true)
                                                            <button id="stop_user"
                                                                onclick="event.preventDefault(); window.UserPosteID = '{{ $poste->poste_users->last()->id }}'; window.request = '{{ route('dashboard.users.stopUser') }}';"
                                                                type="button"
                                                                class="btn btn-sm btn-alt-secondary text-right">
                                                                <i class="fa fa-fw fa-calendar-times me-1"></i> Fin de
                                                                fonction
                                                            </button>
                                                        @else
                                                            <button
                                                                onclick="event.preventDefault();  $('#re_start_function').val(true); $('#user_poste_id_value').val('{{ $poste->poste_users->last()->id }}'); document.getElementById('modal-block-normal-title').innerHTML = 'Préciser la période de la fonction' "
                                                                type="button"
                                                                class="btn btn-sm btn-alt-secondary text-right"
                                                                data-bs-toggle="modal" data-bs-target="#modal-block-normal"
                                                                data-backdrop="static" data-keyboard="false">
                                                                <i class="fa fa-fw fa-calendar-check me-1"></i> Reprise
                                                                de fonction
                                                            </button>

                                                        @endif
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td style="width: 40%;"> <i class="fa fa-fw  fa-calendar"></i>
                                                        Start At</td>
                                                    <td style="width: 60%;" id="start_date_id" class="text-right">
                                                        {{ $poste->poste_users->last()->start_at ? \Carbon\Carbon::parse($poste->poste_users->last()->start_at)->format('d M, Y') : '__/__/__' }}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="width: 40%;"> <i class="fa fa-fw fa-calendar-alt"></i>
                                                        End At</td>

                                                    <td style="width: 60%;" id="end_date_id" class="text-right">
                                                        {{ $poste->poste_users->last()->end_at ? \Carbon\Carbon::parse($poste->poste_users->last()->end_at)->format('d M, Y') : '__/__/__' }}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    @if ($poste->poste_users->last()->in_function == true)
                                                        <td class="text-left">
                                                        </td>
                                                        <td class="text-right">

                                                            <button class="btn btn-sm btn-alt-secondary"
                                                                id="user-graduation-poste-{{ $poste->poste_users->last()->id }}"
                                                                onclick="event.preventDefault(); $('#user-graduation-poste-id-value').val('{{ $poste->id }}'); $('#user-graduation-motif').val('Augmentation'); $('#user-graduation-poste-id').val('{{ $poste->poste_users->last()->id }}'); document.getElementById('user-graduation-title').innerHTML = 'Augmentation de salaire';"
                                                                type="button"
                                                                class="btn btn-sm btn-alt-secondary text-right"
                                                                data-bs-toggle="modal" data-bs-target="#user-graduation"
                                                                data-backdrop="static" data-keyboard="false">
                                                                <i class="fa fa-fw fa-arrow-up text-success"></i>
                                                                Augmenter
                                                            </button>

                                                            <button class="btn btn-sm btn-alt-secondary"
                                                                id="user-graduation-poste-{{ $poste->poste_users->last()->id }}"
                                                                onclick="event.preventDefault(); $('#user-graduation-poste-id-value').val('{{ $poste->id }}'); $('#user-graduation-motif').val('Réduction'); $('#user-graduation-poste-id').val('{{ $poste->poste_users->last()->id }}'); document.getElementById('user-graduation-title').innerHTML = 'Réduction de salaire';"
                                                                type="button"
                                                                class="btn btn-sm btn-alt-secondary text-right"
                                                                data-bs-toggle="modal" data-bs-target="#user-graduation"
                                                                data-backdrop="static" data-keyboard="false">
                                                                <i class="fa fa-fw fa-arrow-down text-danger"></i>
                                                                Réduire
                                                            </button>
                                                        </td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>

                                    @endforeach


                                {{--
                                    <table class="table table-striped table-borderless">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Postes</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td style="width: 40%;">
                                                    <select class="form-select form-select-sm" id="poste-id" name="ecom-license" size="1">
                                                        @foreach ($user->postes as $key => $poste)
                                                            <option value="{{ $poste->id }}" id="user-poste-{{ $poste->id }}">{{ $poste->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td id="dateIdBtn" class="text-right">
                                                    <button type="submit" class="btn btn-sm btn-alt-secondary">
                                                        <i class="far fa-fw fa-business-time"></i>
                                                        Préciser la date de démarrage
                                                    </button></td>
                                            </tr>

                                            <tr>
                                                <td style="width: 40%;"> <i class="fa fa-fw  fa-calendar"></i> Start At</td>
                                                <td style="width: 60%;" id="start_date_id"  class="text-right">__/__/__</td>
                                            </tr>

                                            <tr>
                                                <td style="width: 40%;"> <i class="fa fa-fw fa-calendar-alt"></i> End At</td>
                                                <td style="width: 60%;" id="end_date_id"  class="text-right">__/__/__</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="block-content block-content-full bg-body-light text-end">
                                        <a class="btn btn-primary" href="#">
                                            Augmenter
                                            <svg class="svg-inline--fa fa-arrow-up fa-w-14 opacity-50 ms-1" aria-hidden="true" data-prefix="fa" data-icon="arrow-up" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M34.9 289.5l-22.2-22.2c-9.4-9.4-9.4-24.6 0-33.9L207 39c9.4-9.4 24.6-9.4 33.9 0l194.3 194.3c9.4 9.4 9.4 24.6 0 33.9L413 289.4c-9.5 9.5-25 9.3-34.3-.4L264 168.6V456c0 13.3-10.7 24-24 24h-32c-13.3 0-24-10.7-24-24V168.6L69.2 289.1c-9.3 9.8-24.8 10-34.3.4z"></path></svg><!-- <i class="fa fa-arrow-up opacity-50 ms-1"></i> -->
                                        </a>
                                        <a class="btn btn-danger" href="#">
                                            Réduire
                                            <svg class="svg-inline--fa fa-arrow-down fa-w-14 opacity-50 ms-1" aria-hidden="true" data-prefix="fa" data-icon="arrow-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M413.1 222.5l22.2 22.2c9.4 9.4 9.4 24.6 0 33.9L241 473c-9.4 9.4-24.6 9.4-33.9 0L12.7 278.6c-9.4-9.4-9.4-24.6 0-33.9l22.2-22.2c9.5-9.5 25-9.3 34.3.4L184 343.4V56c0-13.3 10.7-24 24-24h32c13.3 0 24 10.7 24 24v287.4l114.8-120.5c9.3-9.8 24.8-10 34.3-.4z"></path></svg><!-- <i class="fa fa-arrow-down opacity-50 ms-1"></i> -->
                                        </a>
                                    </div>

                                --}}

                                </div>
                                {{-- <div class="tab-pane pull-x fs-sm" id="ecom-product-reviews" role="tabpanel"
                                aria-labelledby="ecom-product-reviews-tab">
                                <div class="block block-rounded bg-body-light">
                                    <div class="block-content text-center">
                                        <p class="text-warning mb-2">
                                            <i class="fa fa-star fa-2x"></i>
                                            <i class="fa fa-star fa-2x"></i>
                                            <i class="fa fa-star fa-2x"></i>
                                            <i class="fa fa-star fa-2x"></i>
                                            <i class="fa fa-star fa-2x"></i>
                                        </p>
                                        <p>
                                            <strong>5.0</strong>/5.0 out of <strong>5</strong> Ratings
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex push">
                                    <a class="flex-shrink-0 me-3" href="javascript:void(0)">
                                        <img class="img-avatar img-avatar32" src="assets/media/avatars/avatar12.jpg"
                                            alt="">
                                    </a>
                                    <div class="flex-grow-1">
                                        <span class="text-warning">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </span>
                                        <a class="fw-semibold" href="javascript:void(0)">Scott Young</a>
                                        <p class="my-1">Awesome Quality!</p>
                                        <span class="text-muted"><em>2 hours ago</em></span>
                                    </div>
                                </div>
                                <div class="d-flex push">
                                    <a class="flex-shrink-0 me-3" href="javascript:void(0)">
                                        <img class="img-avatar img-avatar32" src="assets/media/avatars/avatar4.jpg" alt="">
                                    </a>
                                    <div class="flex-grow-1">
                                        <span class="text-warning">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </span>
                                        <a class="fw-semibold" href="javascript:void(0)">Amanda Powell</a>
                                        <p class="my-1">So cool badges!</p>
                                        <span class="text-muted"><em>5 hours ago</em></span>
                                    </div>
                                </div>
                                <div class="d-flex push">
                                    <a class="flex-shrink-0 me-3" href="javascript:void(0)">
                                        <img class="img-avatar img-avatar32" src="assets/media/avatars/avatar12.jpg"
                                            alt="">
                                    </a>
                                    <div class="flex-grow-1">
                                        <span class="text-warning">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </span>
                                        <a class="fw-semibold" href="javascript:void(0)">Jose Parker</a>
                                        <p class="my-1">They look great, thank you!</p>
                                        <span class="text-muted"><em>15 hours ago</em></span>
                                    </div>
                                </div>
                                <div class="d-flex push">
                                    <a class="flex-shrink-0 me-3" href="javascript:void(0)">
                                        <img class="img-avatar img-avatar32" src="assets/media/avatars/avatar12.jpg"
                                            alt="">
                                    </a>
                                    <div class="flex-grow-1">
                                        <span class="text-warning">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </span>
                                        <a class="fw-semibold" href="javascript:void(0)">Albert Ray</a>
                                        <p class="my-1">Badges for life!</p>
                                        <span class="text-muted"><em>20 hours ago</em></span>
                                    </div>
                                </div>
                                <div class="d-flex push">
                                    <a class="flex-shrink-0 me-3" href="javascript:void(0)">
                                        <img class="img-avatar img-avatar32" src="assets/media/avatars/avatar6.jpg" alt="">
                                    </a>
                                    <div class="flex-grow-1">
                                        <span class="text-warning">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </span>
                                        <a class="fw-semibold" href="javascript:void(0)">Alice Moore</a>
                                        <p class="my-1">So good, keep it up!</p>
                                        <span class="text-muted"><em>22 hours ago</em></span>
                                    </div>
                                </div>
                            </div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="block-content block-content-full bg-body-light text-left">
                        @if (!count($user->user_actual_poste) == 0)
                            <a class="btn btn-primary" id='mise-a-pied' href="javascript:void(0)"
                                onclick="event.preventDefault(); window.UserPosteID = '{{ $poste->poste_users->last()->id }}'; window.request = '{{ route('dashboard.users.stopUser', $user->id) }}';">
                                Mise à pied <i class="fa fa-fw fa-times opacity-50"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Calendrier</h3>
            </div>
            <div class="block-content">
                <div class="row items-push">
                    <div class="col-md-8 col-lg-7 col-xl-9">
                        <div id="js-calendar" class="fc fc-media-screen fc-direction-ltr fc-theme-standard">
                            <div class="fc-header-toolbar fc-toolbar fc-toolbar-ltr">
                                <div class="fc-toolbar-chunk">
                                    <h2 class="fc-toolbar-title">October 2021</h2>
                                </div>
                                <div class="fc-toolbar-chunk"></div>
                                <div class="fc-toolbar-chunk">
                                    <div class="fc-button-group"><button
                                            class="fc-prev-button fc-button fc-button-primary" type="button"
                                            aria-label="prev"><span
                                                class="fc-icon fc-icon-chevron-left"></span></button><button
                                            class="fc-next-button fc-button fc-button-primary" type="button"
                                            aria-label="next"><span class="fc-icon fc-icon-chevron-right"></span></button>
                                    </div><button disabled="" class="fc-today-button fc-button fc-button-primary"
                                        type="button">today</button>
                                    <div class="fc-button-group"><button
                                            class="fc-dayGridMonth-button fc-button fc-button-primary fc-button-active"
                                            type="button">month</button><button
                                            class="fc-timeGridWeek-button fc-button fc-button-primary"
                                            type="button">week</button><button
                                            class="fc-timeGridDay-button fc-button fc-button-primary"
                                            type="button">day</button><button
                                            class="fc-listWeek-button fc-button fc-button-primary"
                                            type="button">list</button></div>
                                </div>
                            </div>
                            <div class="fc-view-harness fc-view-harness-active" style="height: 461.481px;">
                                <div class="fc-daygrid fc-dayGridMonth-view fc-view">

                                    <table class="fc-scrollgrid  fc-scrollgrid-liquid">
                                        <thead>
                                            <tr class="fc-scrollgrid-section fc-scrollgrid-section-header ">
                                                <td>
                                                    <div class="fc-scroller-harness">
                                                        <div class="fc-scroller" style="overflow: hidden scroll;">
                                                            <table class="fc-col-header " style="width: 605px;">
                                                                <colgroup></colgroup>
                                                                <tbody>
                                                                    <tr>
                                                                        <th class="fc-col-header-cell fc-day fc-day-mon">
                                                                            <div class="fc-scrollgrid-sync-inner"><a
                                                                                    class="fc-col-header-cell-cushion ">Mon</a>
                                                                            </div>
                                                                        </th>
                                                                        <th class="fc-col-header-cell fc-day fc-day-tue">
                                                                            <div class="fc-scrollgrid-sync-inner"><a
                                                                                    class="fc-col-header-cell-cushion ">Tue</a>
                                                                            </div>
                                                                        </th>
                                                                        <th class="fc-col-header-cell fc-day fc-day-wed">
                                                                            <div class="fc-scrollgrid-sync-inner"><a
                                                                                    class="fc-col-header-cell-cushion ">Wed</a>
                                                                            </div>
                                                                        </th>
                                                                        <th class="fc-col-header-cell fc-day fc-day-thu">
                                                                            <div class="fc-scrollgrid-sync-inner"><a
                                                                                    class="fc-col-header-cell-cushion ">Thu</a>
                                                                            </div>
                                                                        </th>
                                                                        <th class="fc-col-header-cell fc-day fc-day-fri">
                                                                            <div class="fc-scrollgrid-sync-inner"><a
                                                                                    class="fc-col-header-cell-cushion ">Fri</a>
                                                                            </div>
                                                                        </th>
                                                                        <th class="fc-col-header-cell fc-day fc-day-sat">
                                                                            <div class="fc-scrollgrid-sync-inner"><a
                                                                                    class="fc-col-header-cell-cushion ">Sat</a>
                                                                            </div>
                                                                        </th>
                                                                        <th class="fc-col-header-cell fc-day fc-day-sun">
                                                                            <div class="fc-scrollgrid-sync-inner"><a
                                                                                    class="fc-col-header-cell-cushion ">Sun</a>
                                                                            </div>
                                                                        </th>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                class="fc-scrollgrid-section fc-scrollgrid-section-body  fc-scrollgrid-section-liquid">
                                                <td>
                                                    <div class="fc-scroller-harness fc-scroller-harness-liquid">
                                                        <div class="fc-scroller fc-scroller-liquid-absolute"
                                                            style="overflow: hidden scroll;">
                                                            <div class="fc-daygrid-body fc-daygrid-body-unbalanced "
                                                                style="width: 605px;">
                                                                <table class="fc-scrollgrid-sync-table"
                                                                    style="width: 605px; height: 421px;">
                                                                    <colgroup></colgroup>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past fc-day-other"
                                                                                data-date="2021-09-27">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">27</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-tue fc-day-past fc-day-other"
                                                                                data-date="2021-09-28">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">28</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-wed fc-day-past fc-day-other"
                                                                                data-date="2021-09-29">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">29</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-thu fc-day-past fc-day-other"
                                                                                data-date="2021-09-30">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">30</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-fri fc-day-past"
                                                                                data-date="2021-10-01">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">1</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-event-harness"
                                                                                            style="margin-top: 0px;"><a
                                                                                                class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past">
                                                                                                <div
                                                                                                    class="fc-event-main">
                                                                                                    <div
                                                                                                        class="fc-event-main-frame">
                                                                                                        <div
                                                                                                            class="fc-event-title-container">
                                                                                                            <div
                                                                                                                class="fc-event-title fc-sticky">
                                                                                                                Gaming Day
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="fc-event-resizer fc-event-resizer-end">
                                                                                                </div>
                                                                                            </a></div>
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-sat fc-day-past"
                                                                                data-date="2021-10-02">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">2</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past"
                                                                                data-date="2021-10-03">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">3</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-event-harness"
                                                                                            style="margin-top: 0px;"><a
                                                                                                class="fc-daygrid-event fc-daygrid-dot-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past">
                                                                                                <div
                                                                                                    class="fc-daygrid-event-dot">
                                                                                                </div>
                                                                                                <div
                                                                                                    class="fc-event-time">
                                                                                                    12a</div>
                                                                                                <div
                                                                                                    class="fc-event-title">
                                                                                                    Skype Meeting</div>
                                                                                            </a></div>
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past"
                                                                                data-date="2021-10-04">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">4</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-tue fc-day-past"
                                                                                data-date="2021-10-05">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">5</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-wed fc-day-past"
                                                                                data-date="2021-10-06">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">6</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-thu fc-day-past"
                                                                                data-date="2021-10-07">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">7</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-fri fc-day-past"
                                                                                data-date="2021-10-08">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">8</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-sat fc-day-past"
                                                                                data-date="2021-10-09">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">9</a>
                                                                                    </div>

                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past"
                                                                                data-date="2021-10-10">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">10</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 23px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past"
                                                                                data-date="2021-10-11">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">11</a>
                                                                                    </div>

                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-tue fc-day-past"
                                                                                data-date="2021-10-12">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">12</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-wed fc-day-past"
                                                                                data-date="2021-10-13">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">13</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-thu fc-day-past"
                                                                                data-date="2021-10-14">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">14</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-fri fc-day-past"
                                                                                data-date="2021-10-15">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">15</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-sat fc-day-past"
                                                                                data-date="2021-10-16">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">16</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past"
                                                                                data-date="2021-10-17">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">17</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past"
                                                                                data-date="2021-10-18">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">18</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-tue fc-day-today "
                                                                                data-date="2021-10-19">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">19</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-wed fc-day-future"
                                                                                data-date="2021-10-20">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">20</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-thu fc-day-future"
                                                                                data-date="2021-10-21">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">21</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-fri fc-day-future"
                                                                                data-date="2021-10-22">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">22</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-sat fc-day-future"
                                                                                data-date="2021-10-23">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">23</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-sun fc-day-future"
                                                                                data-date="2021-10-24">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">24</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-daygrid-day fc-day fc-day-mon fc-day-future"
                                                                                data-date="2021-10-25">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">25</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-tue fc-day-future"
                                                                                data-date="2021-10-26">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">26</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-wed fc-day-future"
                                                                                data-date="2021-10-27">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">27</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-thu fc-day-future"
                                                                                data-date="2021-10-28">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">28</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-fri fc-day-future"
                                                                                data-date="2021-10-29">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">29</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-sat fc-day-future"
                                                                                data-date="2021-10-30">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">30</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-sun fc-day-future"
                                                                                data-date="2021-10-31">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">31</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-daygrid-day fc-day fc-day-mon fc-day-future fc-day-other"
                                                                                data-date="2021-11-01">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">1</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-tue fc-day-future fc-day-other"
                                                                                data-date="2021-11-02">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">2</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-wed fc-day-future fc-day-other"
                                                                                data-date="2021-11-03">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">3</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-thu fc-day-future fc-day-other"
                                                                                data-date="2021-11-04">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">4</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-fri fc-day-future fc-day-other"
                                                                                data-date="2021-11-05">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">5</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-sat fc-day-future fc-day-other"
                                                                                data-date="2021-11-06">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">6</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-sun fc-day-future fc-day-other"
                                                                                data-date="2021-11-07">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number">7</a>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-day-bottom"
                                                                                            style="margin-top: 0px;"></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-5 col-xl-3">
                        <form class="js-form-add-event push">

                        </form>
                        <ul id="js-events" class="list list-events">

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Pièces jointes</h3>
                <button id="newPieces" type="button"
                    onclick="event.preventDefault(); document.getElementById('add-pieces-form-div').style.display = 'block'; document.getElementById('show-pieces-div').style.display='none';"
                    style="font-size: 13px;" class="btn btn-primary m-1" {{-- data-bs-toggle="modal" data-bs-target="#app-modal"
                    data-backdrop="static" data-keyboard="false" --}}>
                    <i class="fa fa-plus opacity-50"></i> Ajouter de nouvelle piece ...
                </button>
            </div>
            <div class="block-content pb-4">

                <div class="block-content " id="add-pieces-form-div" style="display: none;">
                    <form id="addPieceForm" enctype="multipart/form-data"
                        action="{{ route('dashboard.users.joinPieces', $user->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label" for="name">Type de piece</label>
                            <small class="help-block" style="color:red; font-size:small">*</small>
                            <select class="form-select" id="user-type-piece" name="name"
                                class="form-control form-control-lg @error('civilite') is-invalid @enderror">
                                <option selected="">Faites votre choix</option>
                                <option value="cv">CV</option>
                                <option value="l-motivation">Lettre de motivation</option>
                                <option value="l-emploi">Lettre de demande d'emploi</option>
                                <option value="cni">Carte d'identite</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="form-label" class="form-label">Pieces jointes</label>
                            <small class="help-block" style="color:red; font-size:small">*</small>
                            <input class="form-control" id="user-pieces" name="pieces" type="file"
                                accept="image/jpeg,image/gif,image/png,application/pdf,application/doc,image/x-eps"
                                class="form-control form-control-lg @error('pieces') is-invalid @enderror">
                            <small class="help-block" style="color:red; font-size:small"></small>
                        </div>

                        <div class="block-content block-content-full text-end mb-4">
                            <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal"
                                onclick="$('#addPieceForm')[0].reset(); $('#add-pieces-form-div').style.display='none'; document.getElementById('show-pieces-div').style.display='block';">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary app-modal-submit-btn-title"
                                id="app-modal-submit-btn">Valider</button>
                        </div>

                    </form>
                </div>

                <div id="show-pieces-div">
                    <div id="" class="">

                        <main id="main-container">

                            <div class="content mb-4">
                                <div class="row items-push js-gallery img-fluid-100">
                                    @foreach ($user->pieces as $piece)
                                        <div class="col-md-6 col-lg-4 col-xl-3 animated fadeIn">

                                            @if (strpos($piece->url, '.png') || strpos($piece->url, '.jpeg') || strpos($piece->url, '.jpg'))

                                                <a class="img-link img-link-zoom-in img-thumb img-lightbox"
                                                    href="{{ asset($piece->url) }}" target="{{ asset($piece->url) }}">
                                                    <img class="img-fluid" href="{{ asset($piece->url) }}"
                                                        src="{{ asset($piece->url) }}"
                                                        alt="{{ asset($piece->name) }}">
                                                </a>
                                            @else

                                                <a class="img-link img-link-zoom-in img-thumb text-center"
                                                    href="{{ asset($piece->url) }}" target="{{ asset($piece->url) }}">
                                                    @if (strpos($piece->url, '.pdf'))
                                                        <i class="far fa-fw fa-file-pdf"></i>
                                                    @elseif(strpos($piece->url, '.txt'))
                                                        <i class="far fa-fw fa-file-alt"></i>
                                                    @elseif(strpos($piece->url, '.zip') || strpos($piece->url, '.tar'))
                                                        <i class="far fa-fw fa-file-archive"></i>
                                                    @elseif(strpos($piece->url, '.xls') || strpos($piece->url, '.xlsx')
                                                        || strpos($piece->url, '.xlxs'))
                                                        <i class="far fa-fw fa-file-excel"></i>
                                                    @elseif(strpos($piece->url, '.doc') || strpos($piece->url, '.docx')
                                                        || strpos($piece->url, '.odt'))
                                                        <i class="far fa-fw fa-file-word"></i>
                                                    @else
                                                        <i class="far fa-fw fa-file"></i>
                                                    @endif

                                                    {!! $piece->name !!}

                                                </a>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>

        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Private Notes</h3>
            </div>
            <div class="block-content">
                <form action="be_pages_ecom_customer.html" onsubmit="return false;">
                    <div class="mb-4">
                        <label class="form-label" for="one-ecom-customer-note">Note</label>
                        <textarea class="form-control" id="one-ecom-customer-note" name="one-ecom-customer-note" rows="4"
                            placeholder="Maybe a special request?"></textarea>
                    </div>
                    <div class="mb-4">
                        <button type="submit" class="btn btn-alt-primary">Add Note</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal" id="modal-block-normal" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title" id="modal-block-normal-title">Modal Title</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">

                        <form id="modal-block-normal-form" method="POST"
                            action="{{ route('dashboard.users.startFunctionUser') }}">
                            @csrf
                            <div>
                                <input type="text" name="user_poste_id" id="user_poste_id_value" hidden>
                            </div>
                            <div>
                                <input type="text" name="re_start" id="re_start_function" hidden>
                            </div>


                            <div class="mb-4">
                                <label class="form-label" for="start_at">Date de démarrage</label>
                                <small class="help-block" style="color:red; font-size:small">*</small>
                                <input type="date" id="start-at" min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}"
                                    name="start_at" placeholder="1996-04-21"
                                    class="form-control form-control-lg @error('start_at') is-invalid @enderror"
                                    name="start_at" value="{{ old('start_at') }}" required="required"
                                    autocomplete="start_at" autofocus>
                                <small class="help-block" style="color:red; font-size:small"></small>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="end_at">Date de fin</label>
                                <input type="date" id="end-at" min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}"
                                    name="end_at" placeholder="1996-04-21"
                                    class="form-control form-control-lg @error('end_at') is-invalid @enderror"
                                    name="end_at" value="{{ old('end_at') }}">
                                <small class="help-block" style="color:red; font-size:small"></small>
                            </div>
                        </form>


                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                            data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-sm btn-primary" id="submit-btn">Perfect</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="user-graduation" tabindex="-1" role="dialog" aria-labelledby="user-graduation"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title" id="user-graduation-title"></h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm">

                        <form id="user-graduation-form" method="POST" action="{{ route('dashboard.salaires.store') }}">
                            @csrf
                            <div>
                                <input type="text" name="poste_id" id="user-graduation-poste-id-value" hidden>
                            </div>
                            <div>
                                <input type="text" name="motif" id="user-graduation-motif" hidden>
                            </div>
                            <div>
                                <input type="text" name="user_poste_id" id="user-graduation-poste-id" hidden>
                            </div>
                            <div>
                                <input type="text" name="user_id" id="user-graduation-user-id-value"
                                    value="{{ $user->id }}" hidden>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="graduation-value">Nouveau salaire </label>
                                <input type="tel" id="graduation-value" name="salaire" placeholder="100.000"
                                    class="form-control form-control-lg @error('graduation-value') is-invalid @enderror"
                                    value="{{ old('graduation-value') }}" required autocomplete="graduation-value"
                                    autofocus>
                                <small class="help-block" style="color:red; font-size:small"></small>
                            </div>
                        </form>


                    </div>
                    <div class="block-content block-content-full text-end bg-body">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                            data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-sm btn-primary"
                            id="user-graduation-submit-btn">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('form-content')



    <div class="row col-md-12">
        <div class="mb-4 col-md-6">
            <label class="form-label" for="last_name">Nom</label>
            <small class="help-block" style="color:red; font-size:small">*</small>
            <input type="text" id="user-last-name" name="last_name" placeholder="AGBOKOU"
                class="form-control form-control-lg @error('last_name') is-invalid @enderror"
                value="{{ old('last_name') }}">
            <small class="help-block" style="color:red; font-size:small"></small>
        </div>

        <div class="mb-4 col-md-6">
            <label class="form-label" for="first_name">Prénom</label>
            <small class="help-block" style="color:red; font-size:small">*</small>
            <input type="text" id="user-first-name" name="first_name" placeholder="Pierre"
                class="form-control form-control-lg @error('first_name') is-invalid @enderror"
                value="{{ old('first_name') }}">
            <small class="help-block" style="color:red; font-size:small"></small>
        </div>
    </div>
    <div class="row col-md-12">
    <div class="mb-4 col-md-4">
        <label class="form-label" for="date_naissance">Date naissance</label>
        <small class="help-block" style="color:red; font-size:small">*</small>
        <input type="date" id="user-date-naissance" min="1920-02-26" max="2002-01-31" placeholder="1996-04-21"
            class="form-control form-control-lg @error('date_naissance') is-invalid @enderror" name="date_naissance"
            value="{{ old('date_naissance') }}">
        <small class="help-block" style="color:red; font-size:small"></small>
    </div>

    <div class="mb-4 col-md-4">
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

    <div class="mb-4 col-md-4">
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
</div>

<div class="row col-md-12">
    <div class="mb-4 col-md-6">
        <label class="form-label" for="telephone">Téléphone</label>
        <small class="help-block" style="color:red; font-size:small">*</small>
        <input type="number" id="user-telephone" name="telephone" placeholder="90000000"
            class="form-control form-control-lg @error('telephone') is-invalid @enderror"
            value="{{ old('telephone') }}">
        <small class="help-block" style="color:red; font-size:small"></small>
    </div>


    <div class="mb-4 col-md-6">
        <label class="form-label" for="email">Adresse email</label>
        <small class="help-block" style="color:red; font-size:small">*</small>
        <input type="email" id="user-email" name="email" placeholder="johndoe@gmail.com"
            class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('email') }}">
        <small class="help-block" style="color:red; font-size:small"></small>
    </div>
</div>

<div class="row col-md-12">
    <div class="mb-4 col-md-6">
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

    <div class="mb-4 col-md-6">
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

{{-- @section('form-content')

    <div class="mb-4">
        <label class="form-label" for="name">Type de piece</label>
        <small class="help-block" style="color:red; font-size:small">*</small>
        <select class="form-select" id="user-type-piece" name="name"
            class="form-control form-control-lg @error('civilite') is-invalid @enderror">
            <option selected="">Faites votre choix</option>
            <option value="cv">CV</option>
            <option value="l-motivation">Lettre de motivation</option>
            <option value="l-emploi">Lettre de demande d'emploi</option>
            <option value="cni">Carte d'identite</option>
        </select>
    </div>

    <div class="mb-4">
        <label for="form-label" class="form-label">Pieces jointes</label>
        <small class="help-block" style="color:red; font-size:small">*</small>
        <input class="form-control" id="user-pieces" name="pieces" type="file"
            accept="image/jpeg,image/gif,image/png,application/pdf,application/doc,image/x-eps"
            class="form-control form-control-lg @error('pieces') is-invalid @enderror">
        <small class="help-block" style="color:red; font-size:small"></small>
    </div>

    <div class="mb-4" style="display:none;" id="editFilesDiv"> </div>

@endsection --}}

{{-- JAVASCRIPT INCLUDE SECTION --}}
@push('js')
    <script>
        function deleteUser() {
            var response = window.confirm('Voulez vous vraiment supprimé cet utilisateur???');

            if (response) {
                $.ajax({
                        url: "{{ route('dashboard.users.destroy', $user->id) }}",
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {},
                        dataType: 'json',

                    }).done(function(data) {
                        window.location = document.referrer;
                    })
                    .fail(function(data) {
                        alert(data.responseJSON.errors);
                    });

            }
        }
    </script>
    <script>
        function retrievePermission() {

            $.ajax({
                    url: window.request,
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: window.AbilityID
                    },
                    dataType: 'json',

                }).done(function(data) {
                    $('#abilitiesBlock').load(location.href + ' #abilitiesBlock>*', '');
                })
                .fail(function(data) {
                    alert(data.responseJSON.errors);
                });

        }
    </script>
    <script>
        function addPieces() {

            var name = $('#user-type-piece').val();
            var pieces = $('#user-pieces').prop('files')[0];
            var formData = new FormData($('#app-modal-form')[0]);
            formData.append('file', pieces, pieces.name);
            formData.append('name', name);

            $('input+small').text('');
            $('input').parent().removeClass('has-error');

            $.ajax({
                    url: $('#app-modal-form').attr(
                        'action'), // "{{ route('dashboard.users.joinPieces', $user->id) }}", //
                    type: $('#app-modal-form').attr('method'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        name: name,
                        pieces: pieces,
                    },

                    dataType: 'json',

                }).done(function(data) {
                    console.log(data);
                    /*
                                        $('.alert-success').removeClass('hidden');
                                        $('#user-graduation').modal('hide');
                                        window.location.reload(true); */
                })
                .fail(function(data) {
                    console.log(data);
                    $.each(data.responseJSON.errors, function(key, value) {
                        var input = '#app-modal input[name=' + key + ']';
                        $(input + '+small').text(value);
                        $(input).parent().addClass('has-error');
                    });
                });

        }
    </script>
    <script>
        function miseAPied() {

            $.ajax({
                    url: window.request,
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        user_poste_id: window.UserPosteID
                    },
                    dataType: 'json',

                }).done(function(data) {
                    $('.alert-success').removeClass('hidden');
                    $('#modal-block-normal').modal('hide');
                    window.location.reload(true);
                })
                .fail(function(data) {
                    $.each(data.responseJSON.errors, function(key, value) {
                        var input = '#modal-block-normal input[name=' + key + ']';
                        $(input + '+small').text(value);
                        $(input).parent().addClass('has-error');
                    });
                });

        }
    </script>

    <script type="text/javascript">
        function suffisammentGrand(d1, d2) {

            var date1 = new Date(d1);

            var date2 = new Date(d2);

            //var maxDate =  new Date(date1.getFullYear(),date1.getMonth()+1, date1.getDate()+14);

            //return element >= 10;

        }

        function formatDate(date) {
            return new Date(date).toISOString().split('T')[0];
        }
        function formatTime(date) {

            //var time2 = new Date(0,0,0,parseInt(setting.horaire_service_end)) ;
            var time = new Date(date);
            return time.toLocaleTimeString();
        }
        $(document).ready(function() {

            var calendarTable = document.getElementById('calendar-content');
            var rowLength = calendarTable.rows.length;

            var user = <?php echo json_encode($user); ?>;

            var setting = <?php echo json_encode($setting); ?>;

            var userPresences = user.presences;

            var userPermissions = user.permissions;

            for (i = 0; i < rowLength; i++) {

                //gets cells of current row
                var oCells = calendarTable.rows.item(i).cells;

                //gets amount of cells of current row
                var cellLength = oCells.length;

                //loops through each cell in current row
                for (var j = 0; j < cellLength; j++) {

                    var date = oCells.item(j).getAttribute('data-date');

                    var presence = userPresences.filter(function(presence) {

                        console.log(formatTime(presence.in_at));

                        console.log(parseInt(formatTime(presence.in_at)) <= parseInt(setting.horaire_service_start));

                        if (formatDate(presence.created_at) == formatDate(date)) {

                            if (presence.is_present == 2 || presence.is_present == 0) {

                                if(parseInt(formatTime(presence.in_at)) <= parseInt(setting.horaire_service_start) && parseInt(formatTime(presence.out_at)) >= parseInt(setting.horaire_service_end) ){

                                    //oCells.item(j).children[0].children[0].innerHTML = oCells.item(j).children[0].children[0].innerHTML +'<a class="fc-daygrid-day-number">En service</a>' ;

                                    oCells.item(j).classList.add('bg-info-light');

                                    oCells.item(j).setAttribute('title', formatTime(presence.in_at) + ' - ' + "--:--");

                                    oCells.item(j).children[0].children[1].innerHTML = '';
                                }
                                else{
                                    if(userPermissions.length != 0){
                                        userPermissions.filter(function (permission) {
                                            if(formatDate(permission.start_at) <= formatDate(presence.in_at) && formatDate(permission.end_at) >= formatDate(presence.in_at) && permission.is_accept == 1){
                                                console.log(parseInt(formatTime(presence.in_at))<=parseInt(setting.horaire_service_start));
                                                if(parseInt(formatTime(presence.in_at))<=parseInt(setting.horaire_service_start)){
                                                    oCells.item(j).children[0].children[1].innerHTML = '<a title=\"'+formatTime(presence.in_at)+' - --:--'+'\" class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-start fc-event-past js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Right Tooltip" style="border-color: rgb(130, 181, 75); background-color: rgb(130, 181, 75);"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">En service</div></div></div></div></a>';
                                                }
                                                else{
                                                    oCells.item(j).children[0].children[1].innerHTML = '<div title=\"'+setting.horaire_service_start+' - '+ formatTime(presence.in_at)+'\" class="fc-daygrid-event-harness" style="margin-top: 0px;"><a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past" style="border-color: rgb(255, 177, 25); background-color: rgb(255, 177, 25);"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">Permissionnaire</div></div></div></div><div class="fc-event-resizer fc-event-resizer-end"></div></a></div><div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>';
                                                    oCells.item(j).children[0].children[1].innerHTML += '<a title=\"'+formatTime(presence.in_at)+' - --:--'+'\" class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-start fc-event-past js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Right Tooltip" style="border-color: rgb(130, 181, 75); background-color: rgb(130, 181, 75);"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">En service</div></div></div></div></a>';
                                                }

                                            }

                                            else{
                                                if(parseInt(formatTime(presence.in_at))<=parseInt(setting.horaire_service_start)){
                                                    oCells.item(j).children[0].children[1].innerHTML = '<a title=\"'+formatTime(presence.in_at)+' - '+ formatTime(presence.out_at)+'\" class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-start fc-event-past js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Right Tooltip" style="border-color: rgb(130, 181, 75); background-color: rgb(130, 181, 75);"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">En service</div></div></div></div></a>';

                                                }
                                                else{
                                                    oCells.item(j).children[0].children[1].innerHTML = '<div class="fc-daygrid-event-harness" title=\"'+setting.horaire_service_start +' - '+ formatTime(presence.in_at)+'\" style="margin-top: 0px;"><a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-end fc-event-past" style="border-color: rgb(224, 79, 26); background-color: rgb(224, 79, 26);"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">En retard</div></div></div></div><div class="fc-event-resizer fc-event-resizer-end"></div></a></div><div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>';
                                                    oCells.item(j).children[0].children[1].innerHTML += '<a title=\"'+formatTime(presence.in_at)+' - --:--'+'\" class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-start fc-event-past js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Right Tooltip" style="border-color: rgb(130, 181, 75); background-color: rgb(130, 181, 75);"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">En service</div></div></div></div></a>';
                                                }
                                            }

                                        });
                                    }
                                    else{
                                        if(parseInt(formatTime(presence.in_at))>parseInt(setting.horaire_service_start)){
                                            oCells.item(j).children[0].children[1].innerHTML = '<div class="fc-daygrid-event-harness" title=\"'+setting.horaire_service_start +' - '+ formatTime(presence.in_at)+'\" style="margin-top: 0px;"><a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-end fc-event-past" style="border-color: rgb(224, 79, 26); background-color: rgb(224, 79, 26);"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">En retard</div></div></div></div><div class="fc-event-resizer fc-event-resizer-end"></div></a></div><div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>';
                                            oCells.item(j).children[0].children[1].innerHTML += '<a title=\"'+formatTime(presence.in_at)+' - --:--'+'\" class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-start fc-event-past js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Right Tooltip" style="border-color: rgb(130, 181, 75); background-color: rgb(130, 181, 75);"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">En service</div></div></div></div></a>';
                                        }
                                        else{
                                            oCells.item(j).children[0].children[1].innerHTML = '<a title=\"'+formatTime(presence.in_at)+' - --:--'+'\" class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-start fc-event-past js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Right Tooltip" style="border-color: rgb(130, 181, 75); background-color: rgb(130, 181, 75);"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">En service</div></div></div></div></a>';
                                        }
                                    }

                                }

                            }

                            else if (presence.is_present == 1) {

                                if(parseInt(formatTime(presence.in_at)) <= parseInt(setting.horaire_service_start) && parseInt(formatTime(presence.out_at)) >= parseInt(setting.horaire_service_end) ){
                                    oCells.item(j).classList.add('bg-success-light');

                                    oCells.item(j).setAttribute('title', formatTime(presence.in_at)+' - '+ formatTime(presence.out_at));

                                    oCells.item(j).children[0].children[0].innerHTML = oCells.item(j).children[0].children[0].innerHTML +'<a class="fc-daygrid-day-number">P</a>' ;
                                    oCells.item(j).children[0].children[1].innerHTML = '';
                                }
                                else{
                                    if(userPermissions.length != 0){
                                        userPermissions.filter(function (permission) {
                                            if(formatDate(permission.start_at) <= formatDate(presence.in_at) && formatDate(permission.end_at) >= formatDate(presence.in_at) && permission.is_accept == 1){

                                                if(parseInt(formatTime(presence.in_at))<=parseInt(setting.horaire_service_start)){
                                                    oCells.item(j).children[0].children[1].innerHTML = '<a title=\"'+formatTime(presence.in_at)+' - '+ formatTime(presence.out_at)+'\" class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-start fc-event-past js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Right Tooltip" style="border-color: rgb(130, 181, 75); background-color: rgb(130, 181, 75);"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">Présent</div></div></div></div></a>';
                                                    oCells.item(j).children[0].children[1].innerHTML += '<div title=\"'+formatTime(presence.out_at)+' - '+ setting.horaire_service_end+'\" class="fc-daygrid-event-harness" style="margin-top: 0px;"><a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past" style="border-color: rgb(255, 177, 25); background-color: rgb(255, 177, 25);"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">Permissionnaire</div></div></div></div><div class="fc-event-resizer fc-event-resizer-end"></div></a></div><div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>';
                                                }
                                                else{
                                                    oCells.item(j).children[0].children[1].innerHTML = '<div title=\"'+setting.horaire_service_start+' - '+ formatTime(presence.in_at)+'\" class="fc-daygrid-event-harness" style="margin-top: 0px;"><a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past" style="border-color: rgb(255, 177, 25); background-color: rgb(255, 177, 25);"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">Permissionnaire</div></div></div></div><div class="fc-event-resizer fc-event-resizer-end"></div></a></div><div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>';
                                                    oCells.item(j).children[0].children[1].innerHTML += '<a title=\"'+formatTime(presence.in_at)+' - '+ formatTime(presence.out_at)+'\" class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-start fc-event-past js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Right Tooltip" style="border-color: rgb(130, 181, 75); background-color: rgb(130, 181, 75);"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">Présent</div></div></div></div></a>';
                                                }

                                            }

                                            else{
                                                //oCells.item(j).removeAttribute('title');

                                                if(parseInt(formatTime(presence.in_at))<=parseInt(setting.horaire_service_start)){
                                                    oCells.item(j).children[0].children[1].innerHTML = '<a title=\"'+formatTime(presence.in_at)+' - '+ formatTime(presence.out_at)+'\" class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-start fc-event-past js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Right Tooltip" style="border-color: rgb(130, 181, 75); background-color: rgb(130, 181, 75);"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">Présent</div></div></div></div></a>';
                                                    oCells.item(j).children[0].children[1].innerHTML += '<div class="fc-daygrid-event-harness" title=\"'+formatTime(presence.out_at)+' - '+ setting.horaire_service_end+'\" style="margin-top: 0px;"><a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-end fc-event-past" style="border-color: rgb(224, 79, 26); background-color: rgb(224, 79, 26);"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">Abscent</div></div></div></div><div class="fc-event-resizer fc-event-resizer-end"></div></a></div><div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>';
                                                }
                                                else{
                                                    oCells.item(j).children[0].children[1].innerHTML += '<div class="fc-daygrid-event-harness" title=\"'+setting.horaire_service_start +' - '+ formatTime(presence.in_at)+'\" style="margin-top: 0px;"><a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-end fc-event-past" style="border-color: rgb(224, 79, 26); background-color: rgb(224, 79, 26);"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">En retard</div></div></div></div><div class="fc-event-resizer fc-event-resizer-end"></div></a></div><div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>';
                                                    oCells.item(j).children[0].children[1].innerHTML = '<a title=\"'+formatTime(presence.in_at)+' - '+ formatTime(presence.out_at)+'\" class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-start fc-event-past js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Right Tooltip" style="border-color: rgb(130, 181, 75); background-color: rgb(130, 181, 75);"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">Présent</div></div></div></div></a>';
                                                }
                                            }

                                        });
                                    }

                                    else{
                                                //oCells.item(j).removeAttribute('title');

                                                if(parseInt(formatTime(presence.in_at))<=parseInt(setting.horaire_service_start)){
                                                    oCells.item(j).children[0].children[1].innerHTML = '<a title=\"'+formatTime(presence.in_at)+' - '+ formatTime(presence.out_at)+'\" class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-start fc-event-past js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Right Tooltip" style="border-color: rgb(130, 181, 75); background-color: rgb(130, 181, 75);"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">Présent</div></div></div></div></a>';
                                                    oCells.item(j).children[0].children[1].innerHTML += '<div class="fc-daygrid-event-harness" title=\"'+formatTime(presence.out_at)+' - '+ setting.horaire_service_end+'\" style="margin-top: 0px;"><a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-end fc-event-past" style="border-color: rgb(224, 79, 26); background-color: rgb(224, 79, 26);"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">Abscent</div></div></div></div><div class="fc-event-resizer fc-event-resizer-end"></div></a></div><div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>';
                                                }
                                                else{
                                                    oCells.item(j).children[0].children[1].innerHTML = '<div class="fc-daygrid-event-harness" title=\"'+setting.horaire_service_start +' - '+ formatTime(presence.in_at)+'\" style="margin-top: 0px;"><a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-end fc-event-past" style="border-color: rgb(224, 79, 26); background-color: rgb(224, 79, 26);"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">Abscent</div></div></div></div><div class="fc-event-resizer fc-event-resizer-end"></div></a></div><div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>';
                                                    oCells.item(j).children[0].children[1].innerHTML += '<a title=\"'+formatTime(presence.in_at)+' - '+ formatTime(presence.out_at)+'\" class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-start fc-event-past js-bs-tooltip-enabled" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Right Tooltip" style="border-color: rgb(130, 181, 75); background-color: rgb(130, 181, 75);"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">Présent</div></div></div></div></a>';
                                                }
                                            }

                                    /* oCells.item(j).children[0].children[1].innerHTML += '<div class="fc-daygrid-event-harness" style="margin-top: 0px;"><a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-end fc-event-past" style="border-color: rgb(224, 79, 26); background-color: rgb(224, 79, 26);"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">Présent</div></div></div></div><div class="fc-event-resizer fc-event-resizer-end"></div></a></div><div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>';

                                    oCells.item(j).children[0].children[1].innerHTML += '<a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-today" href="http://twitter.com/pixelcave" style="border-color: rgb(60, 144, 223); background-color: rgb(60, 144, 223);"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">Follow us on Twitter</div></div></div></div><div class="fc-event-resizer fc-event-resizer-end"></div></a>';

                                    oCells.item(j).children[0].children[1].innerHTML += '<div class="fc-daygrid-event-harness" style="margin-top: 0px;"><a class="fc-daygrid-event fc-daygrid-dot-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-today"><div class="fc-daygrid-event-dot"></div><div class="fc-event-time">8a</div><div class="fc-event-title">Coding</div></a></div>'; */

                                }



                            }

                            else if (presence.is_present == -1) {


                                var permission = userPermissions.filter(function (permission) {

                                    if(formatDate(permission.start_at) <= formatDate(date) && formatDate(permission.end_at) >= formatDate(date) && permission.is_accept == 1){

                                        oCells.item(j).classList.add('bg-warning-light');
                                        oCells.item(j).children[0].children[1].setAttribute('title', setting.horaire_service_start +
                                        ' - ' + setting.horaire_service_end);

                                        oCells.item(j).children[0].children[1].innerHTML = '<div class="fc-daygrid-event-harness" style="margin-top: 0px;"><a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past" style="border-color: rgb(255, 177, 25); background-color: rgb(255, 177, 25);"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">Permissionnaire</div></div></div></div><div class="fc-event-resizer fc-event-resizer-end"></div></a></div><div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>';

                                    }

                                    else{
                                        oCells.item(j).classList.add('bg-danger-light');
                                        oCells.item(j).removeAttribute('title');

                                        oCells.item(j).children[0].children[1].removeAttribute('title');

                                        oCells.item(j).children[0].children[1].innerHTML = '<div class="fc-daygrid-event-harness" style="margin-top: 0px;"><a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-end fc-event-past" style="border-color: rgb(224, 79, 26); background-color: rgb(224, 79, 26);"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title-container"><div class="fc-event-title fc-sticky">Abscent</div></div></div></div><div class="fc-event-resizer fc-event-resizer-end"></div></a></div><div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>';
                                    }
                                });

                            }

                        }
                    });

                    /* oCells.item(j).setAttribute('style','background-color:#daf5e6!important!;');

                    console.log(oCells.item(j).children[0].children[1]);

                    console.log(oCells.item(j).children[0].children[2]); */

                }
            }

            console.log(rowLength);

            // ADD NEW USER ONCLICK FUNCTION

            $('body').on('click', '#newPieces', function(event) {

                event.preventDefault();

                $('#app-modal').modal({
                    backdrop: 'static',
                    keyboard: false // to prevent closing with Esc button (if you want this too)
                });

                $('#app-modal-form').load(location.href + ' #app-modal-form>*', '');

                document.getElementById('app-modal-form-method').innerHTML = '';

                document.getElementById('app-modal-form').setAttribute('action',
                    "{{ route('dashboard.users.joinPieces', $user->id) }}");

                document.getElementById('app-modal-form').setAttribute('enctype', "multipart/form-data");

                document.getElementById('app-modal-title').innerHTML =
                    'Enregistrement de nouvelle piece jointes';
/*
                $('.app-modal-submit-btn-title').html('Joindre'); */

            });


            /* $('body').on('click', '#app-modal-submit-btn', function(event) {

                console.log('addPiece');

                //console.log(document.getElementById('user-pieces').files);

                addPieces();

                //document.getElementById('app-modal-form').submit();

            }); */

            $('body').on('click', '#retrieveID', function(event) {
                console.log('onclick');

                retrievePermission();

            });
            $('body').on('click', '#mise-a-pied', function(event) {
                console.log('onclick');

                miseAPied();

            });
            $('body').on('click', '#stop_user', function(event) {
                console.log('onclick');

                miseAPied();

            });

            $('#user-graduation').modal({
                backdrop: 'static',
                keyboard: false // to prevent closing with Esc button (if you want this too)
            });
            $('#app-modal').modal({
                backdrop: 'static',
                keyboard: false // to prevent closing with Esc button (if you want this too)
            });

            $('body').on('click', '#submit-btn', function(event) {
                console.log($('#modal-block-normal-form').attr('action'));

                var start_at = $("#start-at").val();
                var re_start = $("#re_start_function").val();
                var end_at = $("#end-at").val();
                var user_poste_id = $("#user_poste_id_value").val();

                console.log(user_poste_id);

                $('input+small').text('');
                $('input').parent().removeClass('has-error');

                $.ajax({
                        url: $('#modal-block-normal-form').attr('action'),
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            re_start: re_start,
                            start_at: start_at,
                            end_at: end_at,
                            user_poste_id: user_poste_id,
                        },
                        dataType: 'json',

                    }).done(function(data) {
                        $('.alert-success').removeClass('hidden');
                        $('#modal-block-normal').modal('hide');
                        window.location.reload(true);
                    })
                    .fail(function(data) {
                        $.each(data.responseJSON.errors, function(key, value) {
                            var input = '#modal-block-normal input[name=' + key + ']';
                            $(input + '+small').text(value);
                            $(input).parent().addClass('has-error');
                        });
                    });
            });

            $('body').on('click', '#user-graduation-submit-btn', function(event) {
                console.log($('#user-graduation-form').attr('action'));

                var salaire = $("#graduation-value").val();
                var user_poste_id = $("#user-graduation-poste-id").val();
                var poste_id = $("#user-graduation-poste-id-value").val();
                var motif = $("#user-graduation-motif").val();
                var user_id = $("#user-graduation-user-id-value").val();
                console.log(salaire + '\n' + user_poste_id + '\n' + motif);
                $('input+small').text('');
                $('input').parent().removeClass('has-error');

                $.ajax({
                        url: $('#user-graduation-form').attr('action'),
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            motif: motif,
                            salaire: salaire,
                            user_poste_id: user_poste_id,
                            poste_id: poste_id,
                            user_id: user_id,
                        },
                        dataType: 'json',

                    }).done(function(data) {
                        console.log(data);
                        $('.alert-success').removeClass('hidden');
                        $('#user-graduation').modal('hide');
                        window.location.reload(true);
                    })
                    .fail(function(data) {
                        $.each(data.responseJSON.errors, function(key, value) {
                            var input = '#user-graduation input[name=' + key + ']';
                            $(input + '+small').text(value);
                            $(input).parent().addClass('has-error');
                        });
                    });
            });

            document.getElementById("bar").style.display = "none";
            $('#modal-block-normal').modal({
                backdrop: 'static',
                keyboard: false // to prevent closing with Esc button (if you want this too)
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            var sectionValue;
            $('body').on('click', '#editUser', function(event) {
                /* document.getElementById('user_form_method').innerHTML = '{{ method_field('PUT') }}';
                $('.action-btn').html('Modifier');
                $('html,body').animate({
                    scrollTop: 0
                }, 'fast'); */


                event.preventDefault();

                document.getElementById('app-modal-form').setAttribute('method', "PUT");

                document.getElementById('app-modal-title').innerHTML =
                    'MODIFICATION DES INF0RMATIONS D\'UN UTILISATEUR';

                $('.app-modal-submit-btn-title').html('Mise à jour');
                $('#app-modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });



            });

            // ADD NEW USER ONCLICK FUNCTION

            $('body').on('click', '#user-postes', function(event) {
                updateAccess();
            });

            $('body').on('click', '#user-roles', function(event) {
                updateAccess();
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

                        window.location.reload(true);

                        //Hide modal
                        $('#app-modal').modal('hide');

                    })
                    .fail(function(data) {
                        console.log(data);

                        // set each errors message to corresponding input
                        $.each(data.responseJSON.errors, function(key, value) {

                            var input = '#app-modal input[name=' + key + ']';

                            $(input + '+small').text(value);

                            $(input).parent().addClass('has-error');

                            var select = '#app-modal select[name=' + key + ']';

                            console.log(select);

                            $(select + '+small').text(value);

                            $(select).parent().addClass('has-error');

                        });

                    });
            });


        });
    </script>


    <script>
        function updateAccess() {

            var selectPostes = $('#user-postes').val();

                var postes = <?php echo json_encode($postes); ?>;

                var user = <?php echo json_encode($user); ?>;

                var posteIds = user.user_actual_poste.map(s=>s.id);

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

                var roleIds = user.roles.map(s=>s.id);

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
    </script>

    <script src="{{ asset('assets/js/plugins/fullcalendar/main.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/be_comp_calendar.min.js') }}"></script>

    <script src="{{ asset('assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script>
        One.helpersOnLoad(['jq-magnific-popup']);
    </script>

@endpush
