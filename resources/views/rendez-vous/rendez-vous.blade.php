@extends('layouts.dashboard')

{{-- SETTINGS PAGE SPECIFICATION --}}
@section('title')
    GESTION DES RENDEZ-VOUS
@endsection

@section('subtitle')
    RENDEZ-VOUS ADMINISTRATIF
@endsection

@section('dash')

    <div class="block-content">

        @canany(['manage-meeting','create-meeting'])
        <div class="mb-4" style="display: flex;">
            <button id="btn-action" onclick="event.preventDefault(); document.getElementById('form_id').style.display = 'block';" type="button" class="btn btn-primary m-1 action-btn-cancel">
                <i class="fa fa-plus opacity-50"></i>
                Nouveau rendez-vous
            </button>
        </div>
        @endcanany

        <div id="form_id" style="display: none!important;" class="block block-rounded d-flex flex-column h-100 mb-4">

            <div class="bg-body-light rounded-bottom">
                <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                    href="javascript:void(0)">
                    <span id="update">AJOUT D'UN NOUVEAU RENDEZ-VOUS</span>
                </a>
            </div>
            <div class="block-content block-content-full justify-content-between align-items-center">

                <form id="rendez_vous_form" method="POST" action="{{ route('dashboard.rendez-vous.store') }}">
                    @csrf

                    <p id="rendez_vous_form_method"></p>

                    <div class="mb-4">
                        <label class="form-label" for="visiteur_name">Information sur le visiteur</label>
                        <input type="text" id="rendez-vous-visiteur-name" name="visiteur_name"
                            placeholder="Nom & prénom du visiteur"
                            class="form-control form-control-lg @error('visiteur_name') is-invalid @enderror"
                            value="{{ old('visiteur_name') }}" required autocomplete="visiteur_name" autofocus>
                        <small class="help-block" style="color:red; font-size:small"></small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="visiteur_telephone">Numéro de téléphone du visiteur</label>
                        <input type="text" id="rendez-vous-visiteur-telephone" name="visiteur_telephone"
                            placeholder="Numéro de téléphone du visiteur"
                            class="form-control form-control-lg @error('visiteur_telephone') is-invalid @enderror"
                            value="{{ old('visiteur_telephone') }}" required autocomplete="visiteur_telephone" autofocus>
                        <small class="help-block" style="color:red; font-size:small"></small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="libelle">Objet du rendez-vous</label>
                        <small class="help-block" style="color:red; font-size:small">*</small>
                        <input type="text" id="rendez-vous-libelle" name="libelle" placeholder="Objet du rendez-vous"
                            class="form-control form-control-lg @error('libelle') is-invalid @enderror"
                            value="{{ old('libelle') }}" required autocomplete="libelle" autofocus>
                        <small class="help-block" style="color:red; font-size:small"></small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="description">Details</label>
                        <textarea cols="30" rows="2" id="rendez-vous-description" name="description"
                            class="form-control form-control-lg @error('description') is-invalid @enderror"
                            value="{{ old('description') }}" required autocomplete="description" autofocus
                            placeholder="Détails du rendez-vous"></textarea>
                        <small class="help-block" style="color:red; font-size:small"></small>
                    </div>

                    <div class="mb-4">
                        <label class="date" for="date">Aura lieu le</label>
                        <small class="help-block" style="color:red; font-size:small">*</small>
                        <input type="datetime-local" {{-- min="2021-10-30T12:10" --}} min="{{ \Carbon\Carbon::today()->format('Y-m-d\TH:i') }}"
                            id="rendez-vous-date" name="date"
                            value="{{ old('date') }}"
                            class="form-control form-control-lg @error('date') is-invalid @enderror"
                            required="required">
                        <small class="help-block" style="color:red; font-size:small"></small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="rendez-vous">Rendez-vous avec</label>
                        <small class="help-block" style="color:red; font-size:small">*</small>
                        <select class="form-select" placeholder="Faites votre choix" id="rendez-vous-user-id" name="user_id" required="required"
                            class="form-control form-control-lg @error('rendez-vous') is-invalid @enderror">
                            <option value="">Faites votre choix</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ \Str::ucfirst($user->civilite) }}
                                    {{ $user->last_name }} {{ $user->first_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="" style=" display: flex;">
                        <button type="submit" class="btn btn-primary m-1 action-btn"
                            style="display: inline-block;">Enregistrer le rendez-vous</button>
                        <button type="button" class="btn btn-secondary m-1 action-btn-cancel" onclick="
                                            event.preventDefault();
                                            $('#update').html('AJOUT D\'UN NOUVEAU RENDEZ-VOUS');
                                document.getElementById('rendez_vous_form').setAttribute('action','{{ route('dashboard.rendez-vous.store') }}');
                                document.getElementById('rendez_vous_form_method').innerHTML = '';
                                            $('#rendez_vous_form').load(location.href+' #rendez_vous_form>*','');
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
                    Liste des rendez-vous
                </div>

                <div class="block-options space-x-1">
                    <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle"
                        data-target="#one-dashboard-search-orders" data-class="d-none">
                        <svg class="svg-inline--fa fa-search fa-w-16" aria-hidden="true" data-prefix="fa" data-icon="search"
                            permission="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                            </path>
                        </svg>
                    </button>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-sm btn-alt-secondary" id="dropdown-recent-orders-filters"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg class="svg-inline--fa fa-flask fa-w-14 fa-fw" aria-hidden="true" data-prefix="fa"
                                data-icon="flask" permission="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M437.2 403.5L320 215V64h8c13.3 0 24-10.7 24-24V24c0-13.3-10.7-24-24-24H120c-13.3 0-24 10.7-24 24v16c0 13.3 10.7 24 24 24h8v151L10.8 403.5C-18.5 450.6 15.3 512 70.9 512h306.2c55.7 0 89.4-61.5 60.1-108.5zM137.9 320l48.2-77.6c3.7-5.2 5.8-11.6 5.8-18.4V64h64v160c0 6.9 2.2 13.2 5.8 18.4l48.2 77.6h-172z">
                                </path>
                            </svg><!-- <i class="fa fa-fw fa-flask"></i> -->
                            Filters
                            <svg class="svg-inline--fa fa-angle-down fa-w-10 ms-1" aria-hidden="true" data-prefix="fa"
                                data-icon="angle-down" permission="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 320 512" data-fa-i2svg="">
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
                <form action="" method="POST" onsubmit="return false;">
                    @csrf
                    <div class="push">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-alt" id="one-ecom-orders-search"
                                name="searchValue" placeholder="Search rendez-vous..">
                            <span class="input-group-text bg-body border-0">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>

            <div class="block-content block-content-full">
                <table class="table table-borderless table-striped table-vcenter js-dataTable-buttons">
                  <thead>
                    <tr>
                      <th class="d-none d-sm-table-cell" style="width: 20%;">VISITEUR</th>
                      <th class="d-none d-sm-table-cell" >Objet</th>
                      <th class="d-none d-sm-table-cell" style="width: 18%;">Date</th>
                      <th class="d-none d-sm-table-cell" style="width: 20%;">Rendez-vous avec</th>
                      <th class="text-center" style="width: 15%;">Status</th>
                      <th class="d-none d-sm-table-cell text-center" style="width: 30%;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach ($rendez_vous as $rdv)
                            <tr>
                                <td class="fs-sm">
                                    <p class="fw-semibold mb-1">
                                        <a>{{ \Str::ucfirst(str_replace('\\', '', $rdv->visiteur_name ?? '')) }}</a>
                                    </p>
                                    <p class="text-muted mb-0">
                                        {{ $rdv->visiteur_telephone ?? '-- -- -- --' }}
                                    </p>
                                </td>

                                <td class="fs-sm d-none d-sm-table-cell fs-sm"> {{ \Str::ucfirst(str_replace('\\', '', $rdv->libelle)) }} </td>

                                <td class="fs-sm text-left mb-1"> {{ $rdv->date ? str_replace('T',' à ',$rdv->date) : '__/__/__ --:--' }}</td>

                                <td class="fs-sm">
                                    <p class="fw-semibold mb-1">
                                        <a>{{ \Str::ucfirst($rdv->user->civilite ?? '' ) }}
                                            {{ str_replace('\\', '', $rdv->user->last_name ?? '' ) }}
                                            {{ str_replace('\\', '', $rdv->user->first_name ?? '' ) }}</a>
                                    </p>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    @if ($rdv->status == 2)
                                        <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-warning">
                                            En entente
                                        </span>
                                    @elseif($rdv->status == 1 )
                                        <span
                                            class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success">
                                            Effectué
                                        </span>
                                    @elseif($rdv->status == -1 )
                                        <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger">
                                            Annulé
                                        </span>
                                    @elseif($rdv->status == 3 )
                                        <span
                                            class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-warning">
                                            Reporté
                                        </span>
                                    @else
                                        <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-secondary-light text-secondary">
                                            Unknow
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        @can('confirm-meeting')
                                            @if ($rdv->status != 1 && $rdv->status != -1)
                                            <form class="mr-1"
                                                action="{{ route('dashboard.rendez-vous.valider', $rdv->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                    data-bs-toggle="tooltip" title="Confirmer le rendez-vous"
                                                    data-bs-original-title="Valider le rendez-vous effectué">
                                                    <i class="fa fa-fw fa-check"></i>
                                                </button>
                                            </form>
                                            @endif
                                        @endcan

                                        @can('report-meeting')
                                            @if ($rdv->status == 2)
                                            <button type="submit"
                                                class=" mr-1 btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                id="reportRendezVous"
                                                onclick="event.preventDefault();
                                                    $('#rendez-vous-visiteur-name').val('{{ \Str::ucfirst($rdv->visiteur_name) }}');
                                                    $('#rendez-vous-visiteur-telephone').val('{{ $rdv->visiteur_telephone }}');
                                                        $('#rendez-vous-libelle').val('{{ \Str::ucfirst($rdv->libelle) }}');
                                                        $('#rendez-vous-date').val('{{ \Carbon\Carbon::parse($rdv->date)->format('Y-m-d\TH:i') }}');
                                                        $('#rendez-vous-user-id').val('{{ $rdv->user->id }}');
                                                        $('#update').html('REPORT DE RENDEZ-VOUS \n\n Veuillez précisez la date de report du rendez-vous');
                                                        $('.date').html('Reporter pour le');
                                                        /* document.getElementById('rendez-vous-date').setAttribute('min',' \Carbon\Carbon::parse($rdv->date)->format('Y-m-d') '); */
                                                        document.getElementById('rendez-vous-libelle').setAttribute('readonly','readonly');
                                                        document.getElementById('rendez-vous-description').setAttribute('readonly','readonly');
                                                        document.getElementById('rendez-vous-visiteur-telephone').setAttribute('readonly','readonly');
                                                        document.getElementById('rendez-vous-user-id').setAttribute('readonly','readonly');
                                                        document.getElementById('rendez-vous-user-id').setAttribute('disabled',true);
                                                        document.getElementById('rendez-vous-visiteur-name').setAttribute('readonly','readonly');
                                                        document.getElementById('rendez_vous_form').setAttribute('action','{{ route('dashboard.rendez-vous.reporter', $rdv->id) }}');"
                                                data-bs-toggle="tooltip" title="Reporter le rendez-vous"
                                                data-bs-original-title="Reporter le rendez-vous">
                                                <i class="fa fa-fw fa-history"></i>
                                            </button>
                                            @endif
                                        @endcan

                                        @can('cancel-meeting')
                                            @if ($rdv->status == 2 || $rdv->status == 3)
                                                <form class="mr-1"
                                                    action="{{ route('dashboard.rendez-vous.annuler', $rdv->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                        data-bs-toggle="tooltip" title="Annuler le rendez-vous"
                                                        data-bs-original-title="Annuler le rendez-vous">
                                                        <i class="fa fa-fw fa-times-circle"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        @endcan

                                        <form action="{{ route('dashboard.rendez-vous.destroy', $rdv->id) }}"
                                            method="POST">
                                            @if($rdv->status != 1 && $rdv->status != -1)

                                            <a type="button" id="viewRDV" href="{{ route('dashboard.rendez-vous.show', $rdv->id) }}"
                                                class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" title="" data-bs-original-title="Voir plus">
                                                <i class="fa fa-fw fa-eye"></i>
                                            </a>

                                            @canany(['manage-meeting','update-meeting'])
                                            <a type="button" id="editRendezVous"
                                                onclick="event.preventDefault();
                                                document.getElementById('form_id').style.display = 'block';
                                                        $('#rendez-vous-visiteur-name').val('{{ \Str::ucfirst($rdv->visiteur_name) }}');
                                                        $('#rendez-vous-visiteur-telephone').val('{{ $rdv->visiteur_telephone }}');
                                                        $('#rendez-vous-libelle').val('{{ \Str::ucfirst($rdv->libelle) }}');

                                                        CKEDITOR.instances['rendez-vous-description'].setData('{{ \Str::ucfirst($rdv->description) }}');

                                                        $('#rendez-vous-date').val('{{ \Carbon\Carbon::parse($rdv->date)->format('Y-m-d\TH:i') }}');
                                                        $('#rendez-vous-user-id').val('{{ $rdv->user->id }}');
                                                        $('#update').html('MODIFICATION DES INF0RMATIONS DU RENDEZ-VOUS');

                                                        document.getElementById('rendez_vous_form').setAttribute('action','{{ route('dashboard.rendez-vous.update', $rdv->id) }}');"
                                                class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                data-bs-toggle="tooltip" title=""
                                                data-bs-original-title="Modifier le rendez-vous">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </a>
                                            @endcanany

                                            @csrf
                                            @method('DELETE')

                                            @canany(['manage-meeting','delete-meeting'])
                                            <button type="submit"
                                                class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                data-bs-toggle="tooltip" title=""
                                                data-bs-original-title="Supprimer la demande">
                                                <i class="fa fa-fw fa-times"></i>
                                            </button>
                                            @endcanany
                                            @endif
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

@endsection

{{-- JAVASCRIPT INCLUDE SECTION --}}
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('body').on('click', '#editRendezVous', function(event) {
                document.getElementById('rendez_vous_form_method').innerHTML =
                    '{{ method_field('PUT') }}';
                console.log($('#rendez_vous_form'));
                $('.action-btn').html('Modifier');
                $('html,body').animate({
                    scrollTop: 0
                }, 'fast');


            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('body').on('click', '#reportRendezVous', function(event) {
                document.getElementById('rendez_vous_form_method').innerHTML =
                    '{{ method_field('PUT') }}';
                console.log($('#rendez_vous_form'));
                $('.action-btn').html('Reporter');
                $('html,body').animate({
                    scrollTop: 0
                }, 'fast');


            });
        });
    </script>
@endpush
