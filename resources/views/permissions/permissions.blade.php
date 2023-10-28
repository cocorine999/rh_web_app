@extends('layouts.dashboard')

{{-- SETTINGS PAGE SPECIFICATION --}}
@section('title')
    DEMANDES
@endsection

@section('subtitle')
    HISTORIQUE DES DEMANDES
@endsection

@section('dash')

    <div class="block-content">

    @canany(['manage-permissions','create-permissions'])
    <div class="mb-4" style="display: flex;">

        <button type="submit" class="btn btn-alt-secondary m-1" style="display: inline-block;" id="permit_btn"
        onclick="event.preventDefault(); $('#update').html('NOUVELLE DEMANDE DE PERMISSION');  document.getElementById('form_id').style.display = 'block';">
                <i class="fa fa-plus opacity-50"></i>
                Demander une permission
        </button>
        <button id="conge_btn" onclick="event.preventDefault();
        $('#update').html('NOUVELLE DEMANDE DE CONGÉ'); document.getElementById('form_id').style.display = 'block';" type="button" class="btn btn-primary m-1 conge_btn">
            <i class="fa fa-plus opacity-50"></i>
            Demander un congé
        </button>
    </div>
    @endcanany

    <div id="form_id" style="display: none!important;" class="block block-rounded d-flex flex-column h-100 mb-4">


            <div class="bg-body-light rounded-bottom">
                <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                    href="javascript:void(0)">
                    <span id="update">ENVOYER UNE NOUVELLE DEMANDE</span>
                </a>
            </div>
            <div class="block-content block-content-full justify-content-between align-items-center">

                <form id="permission_form" method="POST" action="{{ route('dashboard.permissions.store') }}">
                    @csrf

                    <p id="permission_form_method"></p>

                    <input id="is_conge_id" type="hidden" name="is_conge">

                    <div class="mb-4">
                        <label class="form-label" for="motif">Intitule</label>
                        <input type="text" id="permission-motif" name="motif"
                            placeholder="Motif de la demande"
                            class="form-control form-control-lg @error('motif') is-invalid @enderror"
                            value="{{ old('motif') }}" required autocomplete="motif" autofocus>
                        <small class="help-block" style="color:red; font-size:small"></small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="description">Justificatif</label>
                        <textarea cols="30" rows="2" id="permission-description" name="description"
                            class="form-control form-control-lg @error('description') is-invalid @enderror"
                            value="{{ old('description') }}" required autocomplete="description" autofocus
                            placeholder="Justificatif de la demande"></textarea>
                        <small class="help-block" style="color:red; font-size:small"></small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="start_at">A compter du </label>
                        <small class="help-block" style="color:red; font-size:small">*</small>
                        <input type="datetime-local" id="permission-start-at" min="{{ \Carbon\Carbon::today()->format('Y-m-d\TH:i') }}" name="start_at"
                            class="form-control form-control-lg @error('start_at') is-invalid @enderror"
                            value="{{ old('start_at') }}" required autocomplete="start_at" autofocus>
                        <small class="help-block" style="color:red; font-size:small"></small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="end_at">Au </label>
                        <small class="help-block" style="color:red; font-size:small">*</small>
                        <input type="datetime-local" id="permission-end-at" min="{{ \Carbon\Carbon::today()->format('Y-m-d\TH:i') }}" name="end_at"
                            class="form-control form-control-lg @error('end_at') is-invalid @enderror"
                            value="{{ old('end_at') }}" required autocomplete="end_at" autofocus>
                        <small class="help-block" style="color:red; font-size:small"></small>
                    </div>

                    <div class="" style=" display: flex;">
                        <button type="submit" class="btn btn-primary m-1 action-btn" style="display: inline-block;">Envoyer
                            la demande</button>
                        <button type="button" class="btn btn-secondary m-1 action-btn-cancel" onclick="
                                            event.preventDefault();
                                                document.getElementById('form_id').style.display = 'block';
                                            $('#update').html('NOUVELLE DEMANDE DE PERMISSION');
                                document.getElementById('permission_form').setAttribute('action','{{ route('dashboard.permissions.store') }}');
                                            document.getElementById('permission_form_method').innerHTML = '';
                                            $('#permission_form').load(location.href+' #permission_form>*','');


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

                    HISTORIQUE DES DEMANDES
                </div>

                <div class="block-options space-x-1">
                    <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle"
                        data-target="#one-dashboard-search-orders" data-class="d-none">
                        <i class="fa fa-search"></i>
                    </button>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-sm btn-alt-secondary" id="dropdown-recent-orders-filters"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-fw fa-flask"></i>
                            Filters
                            <i class="fa fa-angle-down ms-1"></i>
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
                                name="searchValue" placeholder="Search demandes..">
                            <span class="input-group-text bg-body border-0">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>

            {{-- <div class="block-content">

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
                            <th>Nom & Prénom</th>
                            <th>Contenu</th>
                            <th class="text-left">Date de début</th>
                            <th class="text-left">Date de fin</th>
                            <th class="text-left">Status</th>
                            <th class="d-none d-sm-table-cell text-right" style="width: 20%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td class="text-right">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                        <label class="form-check-label" for="row_1"></label>
                                    </div>
                                </td>
                                <td class="fs-sm">
                                    <p class="fw-semibold mb-1">
                                        <a>{{ \Str::ucfirst(optional($permission->user)->civilite) }}
                                            {{ str_replace('\\','',optional($permission->user)->last_name) }} {{ str_replace('\\','',optional($permission->user)->first_name) }}</a>
                                    </p>
                                    <p class="text-muted mb-0">
                                        {{ str_replace('\\','',optional(optional(optional($permission->user)->postes)->first())->name) }}
                                    </p>
                                </td>
                                <td class="fs-sm">
                                    <p class="fw-semibold mb-1">
                                        <a>{{ \Str::ucfirst(str_replace('\\','',$permission->motif)) }}</a>
                                    </p>

                                    <p class="text-muted mb-0">
                                        {{ $permission->is_conge == true ? 'CONGE' : 'PERMISSION' }}
                                    </p>
                                </td>

                                <td class="fs-sm text-left">
                                    <p class="fw-semibold mb-1">
                                        <a>{{ str_replace('T',' à ',$permission->start_at) ?? '__/__/__ --:--' }}</a>
                                    </p>
                                </td>

                                <td class="fs-sm text-left">
                                    <p class="fw-semibold mb-1">
                                        <a>{{ str_replace('T',' à ',$permission->end_at) ?? '__/__/__ --:--' }}</a>
                                    </p>
                                </td>
                                <td class="d-none d-sm-table-cell text-left">
                                    @if ($permission->is_accept == 2)
                                        <span
                                            class=" text-center fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-warning">
                                            En attente
                                        </span>
                                    @elseif($permission->is_accept == 1 )
                                        <span
                                            class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success">
                                            Accordée
                                        </span>
                                    @elseif($permission->is_accept == -1 )
                                        <span
                                            class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger">
                                            Rejetée
                                        </span>
                                    @else
                                        <span
                                            class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-secondary-light text-secondary">
                                            UNKNOW
                                        </span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        @can('validate-permissions')
                                            @if($permission->is_accept == 2)
                                            <form class="mr-1"
                                                action="{{ route('dashboard.permissions.valider', $permission->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                    data-bs-toggle="tooltip" title="Valider la demande"
                                                    data-bs-original-title="Valider la demande">
                                                    <i class="fa fa-fw fa-thumbs-up"></i>
                                                </button>
                                            </form>
                                            @endif
                                            @if($permission->is_accept == 2)
                                            <form class="mr-1"
                                                action="{{ route('dashboard.permissions.rejeter', $permission->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                    data-bs-toggle="tooltip" title="Rejeter la demande"
                                                    data-bs-original-title="Rejeter la demande">
                                                    <i class="fa fa-fw fa-thumbs-down"></i>
                                                </button>
                                            </form>
                                            @endif
                                        @endif
                                        <form action="{{ route('dashboard.permissions.destroy', $permission->id) }}"
                                            method="POST">
                                            @if($permission->is_accept == 2)
                                            @can('update', $permission)
                                            <a type="button" id="editPermission"
                                                onclick="event.preventDefault();
                                                document.getElementById('form_id').style.display = 'block';
                                                        $('#permission-motif').val('{{ $permission->motif }}');
                                                        CKEDITOR.instances['permission-description'].setData('{{ \Str::ucfirst($permission->description) }}');
                                                        $('#permission-start-at').val('{{ \Carbon\Carbon::parse($permission->start_at)->format('Y-m-d\TH:i') }}');
                                                        $('#permission-end-at').val('{{ \Carbon\Carbon::parse($permission->end_at)->format('Y-m-d\TH:i') }}');
                                                        $('#is_conge_id').val('{{ $permission->is_conge }}');
                                                        $('#update').html('MODIFICATION DES DÉTAILS DE LA DEMANDE');
                                                        document.getElementById('permission_form').setAttribute('action','{{ route('dashboard.permissions.update', $permission->id) }}');"
                                                class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                data-bs-toggle="tooltip" title="Modifier les détails de la demande" data-bs-original-title="Edit Permission">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </a>
                                            @endcan
                                            @csrf
                                            @method('DELETE')

                                            @can('delete', $permission)
                                            <button type="submit"
                                                class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                data-bs-toggle="tooltip" title="Supprimer la demande"
                                                data-bs-original-title="Supprimer la demande">
                                                <i class="fa fa-fw fa-times"></i>
                                            </button>
                                            @endcan
                                            @endif
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
                {!! $permissions->links() !!}
            </div> --}}

            <div class="block-content block-content-full">
                <table class="table table-borderless table-striped table-vcenter js-dataTable-buttons">
                  <thead>
                    <tr>

                      <th class="text-center">
                          <div class="form-check d-inline-block">
                              <input class="form-check-input" type="checkbox" value="" id="check-all"
                                  name="check-all">
                          </div>
                      </th>
                      <th class="d-none d-sm-table-cell" style="width: 30%;">Nom & prénom</th>
                      <th class="d-none d-sm-table-cell" >Contenu</th>
                      <th class="d-none d-sm-table-cell" style="width: 30%;">Date de début</th>
                      <th class="d-none d-sm-table-cell" style="width: 30%;">Date de fin</th>
                      <th class="d-none d-sm-table-cell" style="width: 15%;">Status</th>
                      <th style="width: 15%;">Action</th>
                    </tr>
                  </thead>
                  <tbody>


                    @foreach ($permissions as $permission)
                    <tr>
                        <td class="text-right">
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                <label class="form-check-label" for="row_1"></label>
                            </div>
                        </td>
                        <td class="fs-sm">
                            <p class="fw-semibold mb-1">
                                <a>{{ \Str::ucfirst(optional($permission->user)->civilite) }}
                                    {{ str_replace('\\','',optional($permission->user)->last_name) }} {{ str_replace('\\','',optional($permission->user)->first_name) }}</a>
                            </p>
                            <p class="text-muted mb-0">
                                {{ str_replace('\\','',optional(optional(optional($permission->user)->postes)->first())->name) }}
                            </p>
                        </td>
                        <td class="fs-sm d-none d-sm-table-cell fs-sm" >
                            {{ \Str::ucfirst(str_replace('\\','',$permission->motif)) }}</a>
                            <p class="text-muted mb-0">
                                {{ $permission->is_conge == true ? 'Congé' : 'Permission' }}
                            </p>
                        </td>

                        <td class="fs-sm text-left mb-1"> {{ $permission->start_at ? str_replace('T',' à ',$permission->start_at) : '__/__/__ --:--' }}</td>

                        <td class="fs-sm text-left mb-1"> {{ $permission->end_at ? str_replace('T',' à ',$permission->end_at) : '__/__/__ --:--' }}</td>
                        <td class="d-none d-sm-table-cell text-left">
                            @if ($permission->is_accept == 2)
                                <span
                                    class=" text-center fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-warning">
                                    En attente
                                </span>
                            @elseif($permission->is_accept == 1 )
                                <span
                                    class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success">
                                    Accordée
                                </span>
                            @elseif($permission->is_accept == -1 )
                                <span
                                    class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger">
                                    Rejetée
                                </span>
                            @else
                                <span
                                    class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-secondary-light text-secondary">
                                    UNKNOW
                                </span>
                            @endif
                        </td>
                        <td class="text-right">
                            <div class="btn-group">
                                @can('validate-permissions')
                                    @if($permission->is_accept == 2)
                                    <form class="mr-1"
                                        action="{{ route('dashboard.permissions.valider', $permission->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                            data-bs-toggle="tooltip" title="Valider la demande"
                                            data-bs-original-title="Valider la demande">
                                            <i class="fa fa-fw fa-thumbs-up"></i>
                                        </button>
                                    </form>
                                    @endif
                                    @if($permission->is_accept == 2)
                                    <form class="mr-1"
                                        action="{{ route('dashboard.permissions.rejeter', $permission->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                            data-bs-toggle="tooltip" title="Rejeter la demande"
                                            data-bs-original-title="Rejeter la demande">
                                            <i class="fa fa-fw fa-thumbs-down"></i>
                                        </button>
                                    </form>
                                    @endif
                                @endif
                                <form action="{{ route('dashboard.permissions.destroy', $permission->id) }}"
                                    method="POST">
                                    @if($permission->is_accept == 2)
                                    @can('update', $permission)
                                    <a type="button" id="editPermission"
                                        onclick="event.preventDefault();
                                        document.getElementById('form_id').style.display = 'block';
                                                $('#permission-motif').val('{{ $permission->motif }}');
                                                CKEDITOR.instances['permission-description'].setData('{{ \Str::ucfirst($permission->description) }}');
                                                $('#permission-start-at').val('{{ \Carbon\Carbon::parse($permission->start_at)->format('Y-m-d\TH:i') }}');
                                                $('#permission-end-at').val('{{ \Carbon\Carbon::parse($permission->end_at)->format('Y-m-d\TH:i') }}');
                                                $('#is_conge_id').val('{{ $permission->is_conge }}');
                                                $('#update').html('MODIFICATION DES DÉTAILS DE LA DEMANDE');
                                                document.getElementById('permission_form').setAttribute('action','{{ route('dashboard.permissions.update', $permission->id) }}');"
                                        class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                        data-bs-toggle="tooltip" title="Modifier les détails de la demande" data-bs-original-title="Edit Permission">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                    @endcan
                                    @csrf
                                    @method('DELETE')

                                    @can('delete', $permission)
                                    <button type="submit"
                                        class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                        data-bs-toggle="tooltip" title="Supprimer la demande"
                                        data-bs-original-title="Supprimer la demande">
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                    @endcan
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
            $('body').on('click', '#editPermission', function(event) {
                document.getElementById('permission_form_method').innerHTML =
                '{{ method_field('PUT') }}';
                console.log($('#permission_form'));
                $('.action-btn').html('Modifier');
                $('html,body').animate({
                    scrollTop: 0
                }, 'fast');


            });

            $('body').on('click', '#permit_btn', function(event) {

                document.getElementById('is_conge_id').value = false;

            });

            $('body').on('click', '#conge_btn', function(event) {

                document.getElementById('is_conge_id').value = true;

            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('body').on('click', '#permission-end-at', function(event) {

                var congeValue = document.getElementById('is_conge_id').value;

                console.log(congeValue);

                if(congeValue == 'false'){
                    var start_at = $('#permission-start-at').val();
                    var date1 = new Date(start_at);
                    var maxDate =  new Date(date1.getFullYear(),date1.getMonth()+1, date1.getDate()+14);
                    if(start_at){
                        document.getElementById('permission-end-at').setAttribute('min',start_at);
                        document.getElementById('permission-end-at').setAttribute('max',maxDate.getFullYear()+'-'+maxDate.getMonth()+'-'+maxDate.getDate());
                    }
                }

            });

        });
    </script>
@endpush
