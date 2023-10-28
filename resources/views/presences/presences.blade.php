@extends('layouts.dashboard')

{{-- SETTINGS PAGE SPECIFICATION --}}
@section('title')
    PRÉSENCES
@endsection

@section('subtitle')
    HISTORIQUE DES ENTRÉES/SORTIES
@endsection

@section('dash')
    <div class="block-content">

        @canany(['manage-presences', 'create-presences'])
            <div class="mb-4" style="display: flex;">

                <button id="btn-action"
                    onclick="event.preventDefault(); document.getElementById('form_id').style.display = 'block';" type="button"
                    class="btn btn-primary m-1 action-btn-cancel">
                    <i class="fa fa-plus opacity-50"></i>
                    Nouvelle arrivée
                </button>
            </div>
        @endcanany

        <div id="form_id" style="display: none!important;" class="block block-rounded d-flex flex-column h-100 mb-4">

            <div class="bg-body-light rounded-bottom">
                <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                    href="javascript:void(0)">
                    <span id="update">AJOUT D'UNE NOUVELLE ENTRÉE</span>
                </a>
            </div>
            <div class="block-content block-content-full justify-content-between align-items-center">

                <form id="presence_form" method="POST" action="{{ route('dashboard.presences.store') }}">
                    @csrf

                    <p id="presence_form_method"></p>

                    {{-- <div class="mb-4" id="in-at">
                        <label class="form-label" for="in_at">Heure d'arrivée </label>
                        <small class="help-block" style="color:red; font-size:small">*</small>
                        <input type="time" id="presence-in-at" name="in_at"
                            placeholder="{{ \Carbon\Carbon::today()->format("h:m:s") }}"
                            class="form-control form-control-lg @error('in_at') is-invalid @enderror"
                            value="{{ old('in_at') }}" required autocomplete="in_at" autofocus>
                        <small class="help-block" style="color:red; font-size:small"></small>
                    </div>

                    <div class="mb-4" id="out-at">
                        <label class="form-label" for="out_at">Heure de sortie </label>
                        <small class="help-block" style="color:red; font-size:small">*</small>
                        <input type="time" id="presence-out-at" name="out_at"
                            placeholder="18h30"
                            class="form-control form-control-lg @error('out_at') is-invalid @enderror"
                            value="{{ old('out_at') }}" required autocomplete="out_at" autofocus>
                        <small class="help-block" style="color:red; font-size:small"></small>
                    </div> --}}

                    <div class="mb-4">
                        <label class="form-label" for="user-id">Utilisateurs</label>
                        <small class="help-block" style="color:red; font-size:small">*</small>
                        <select class="form-select" id="presence-user-id" name="user_id" required="required"
                            placeholder="Faites votre choix"
                            class="form-control form-control-lg @error('user-id') is-invalid @enderror">
                            <option value="">Faites votre choix</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ \Str::ucfirst($user->civilite) }}
                                    {{ str_replace('\\', '', $user->last_name) }}
                                    {{ str_replace('\\', '', $user->first_name) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="" style=" display: flex;">
                        <button type="submit" class="btn btn-primary m-1 action-btn"
                            style="display: inline-block;">Enregistrer</button>
                        <button type="button" class="btn btn-secondary m-1 action-btn-cancel" onclick="
                                            event.preventDefault();
                                            $('#presence_form').load(location.href+' #presence_form>*','');
                                            $('#update').html('AJOUT D\'UNE NOUVELLE ENTRÉE');
                                    document.getElementById('presence_form').setAttribute('action','{{ route('dashboard.presences.store') }}');
                                            document.getElementById('presence_form_method').innerHTML = '';"
                            style="display: inline-block;">
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
                    HISTORIQUE DES ENTRÉES/SORTIES
                </div>

                <div class="block-options space-x-1">
                    <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle"
                        data-target="#one-dashboard-search-orders" data-class="d-none">
                        <svg class="svg-inline--fa fa-search fa-w-16" aria-hidden="true" data-prefix="fa" data-icon="search"
                            presence="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                            </path>
                        </svg>
                    </button>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-sm btn-alt-secondary" id="dropdown-recent-orders-filters"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg class="svg-inline--fa fa-flask fa-w-14 fa-fw" aria-hidden="true" data-prefix="fa"
                                data-icon="flask" presence="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                data-fa-i2svg="">
                                <path fill="currentColor"
                                    d="M437.2 403.5L320 215V64h8c13.3 0 24-10.7 24-24V24c0-13.3-10.7-24-24-24H120c-13.3 0-24 10.7-24 24v16c0 13.3 10.7 24 24 24h8v151L10.8 403.5C-18.5 450.6 15.3 512 70.9 512h306.2c55.7 0 89.4-61.5 60.1-108.5zM137.9 320l48.2-77.6c3.7-5.2 5.8-11.6 5.8-18.4V64h64v160c0 6.9 2.2 13.2 5.8 18.4l48.2 77.6h-172z">
                                </path>
                            </svg><!-- <i class="fa fa-fw fa-flask"></i> -->
                            Filters
                            <svg class="svg-inline--fa fa-angle-down fa-w-10 ms-1" aria-hidden="true" data-prefix="fa"
                                data-icon="angle-down" presence="img" xmlns="http://www.w3.org/2000/svg"
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
                                name="searchValue" placeholder="Search presences..">
                            <span class="input-group-text bg-body border-0">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>

            <div class="block-content block-content-full">
                <table id="tableDIV" class="table table-borderless table-striped table-vcenter js-dataTable-buttons">
                  <thead>
                    <tr>

                      <th class="text-center">
                          <div class="form-check d-inline-block">
                              <input class="form-check-input" type="checkbox" value="" id="check-all"
                                  name="check-all">
                          </div>
                      </th>
                      <th class="" style="width: 25%;">Nom & prénom</th>
                      <th class="" style="width: 20%;">Heure d'arrivée</th>
                      <th class="d-none d-sm-table-cell" style="width: 20%;">Heure de sortie</th>
                      <th class="d-none d-sm-table-cell text-center" style="width: 15%;">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach ($presences as $presence)
                            <tr>
                                <td class="text-center">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                        <label class="form-check-label" for="row_1"></label>
                                    </div>
                                </td>
                                <td class="fs-sm">
                                    <p class="fw-semibold mb-1">
                                        <a>{{ \Str::ucfirst($presence->user->civilite) }}
                                            {{ str_replace('\\', '', $presence->user->last_name) }}
                                            {{ str_replace('\\', '', $presence->user->first_name) }}</a>
                                    </p>
                                    <p class="text-muted mb-0">
                                        {{ \Str::ucfirst(str_replace('\\', '', $presence->user->postes->first()->name)) }}
                                    </p>
                                </td>

                                <td class="d-none d-sm-table-cell fs-sm">
                                    {{ $presence->in_at ?  str_replace('T',' à ',$presence->in_at) : '__/__/__ --:--'  }}
                                </td>

                                <td class="d-none d-sm-table-cell fs-sm">
                                    {{ str_replace('T',' à ',$presence->out_at) ?? '__/__/__ --:--'  }}
                                </td>

                                <td class="d-none d-sm-table-cell text-center">
                                    @if ($presence->is_present == -1)
                                        <span
                                            class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger">
                                            Abscent
                                        </span>
                                    @elseif($presence->is_present == 1 )
                                        <span
                                            class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success">
                                            Présent
                                        </span>
                                    @else
                                        <span
                                            class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-info-light text-info">
                                            En service
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        @can('sortie-service', $presence)
                                            <form action="{{ route('dashboard.presences.sortie', $presence->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="btn btn-sm mr-1 btn-alt-secondary js-bs-tooltip-enabled"
                                                    data-bs-toggle="tooltip" title="Sortie de service"
                                                    data-bs-original-title="Sortie de service">
                                                    <i class="fa fa-fw fa-reply-all"></i>
                                                </button>
                                            </form>
                                        @endcan
                                        <form action="{{ route('dashboard.presences.destroy', $presence->id) }}"
                                            method="POST">
                                            {{-- @if($presence->is_present !=1) --}}
                                            @can('update-presences')
                                                <a type="submit" id="editTrafic" data-bs-toggle="modal" data-bs-target="#app-modal" data-backdrop="static" data-keyboard="false" onclick="

                                                            event.preventDefault();

                                                            //$('#app-modal-form').load(location.href + ' #app-modal-form>*', '');

                                                            document.getElementById('app-modal-form-method').innerHTML = '';

                                                            document.getElementById('app-modal-title').innerHTML = 'AJOUT D\'UN NOUVEL UTILISATEUR';

                                                            $('.app-modal-submit-btn-title').html('Modifier');

                                                            $('#id').val('{{ $presence->user->id }}');

                                                            $('#p-out-at').val('{{ \Carbon\Carbon::parse( $presence->out_at)->format('Y-m-d\TH:i') }}');

                                                            $('#p-in-at').val('{{ \Carbon\Carbon::parse( $presence->in_at)->format('Y-m-d\TH:i') }}');

                                                            document.getElementById('app-modal-form').setAttribute('action','{{ route('dashboard.presences.update', $presence->id) }}');

                                                            document.getElementById('app-modal-form').setAttribute('method','PUT')

                                                            "
                                                    class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                    data-bs-toggle="tooltip" title="Modifier"
                                                    data-bs-original-title="Edit User">
                                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                                </a>
                                            @endcan
                                            @csrf
                                            @method('DELETE')
                                            @can('delete-presences')
                                                <button type="submit" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                    data-bs-toggle="tooltip" title="Supprimer"
                                                    data-bs-original-title="Remove trafic">
                                                    <i class="fa fa-fw fa-times"></i>
                                                </button>
                                            @endcan
                                            {{-- @endif --}}
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
@section('form-content')


<div>
    <input type="text" name="id" id="id" hidden>
</div>


<div class="mb-4">
    <label class="form-label" for="in_at">Heure d'arrivée</label>
    <small class="help-block" style="color:red; font-size:small">*</small>
    <input type="datetime-local" id="p-in-at" name="in_at" class="form-control form-control-lg @error('in_at') is-invalid @enderror">
    <small class="help-block" style="color:red; font-size:small"></small>
</div>

<div class="mb-4">
    <label class="form-label" for="out_at">Heure de sortie</label>
    <input type="datetime-local" id="p-out-at" name="out_at" class="form-control form-control-lg @error('out_at') is-invalid @enderror">
    <small class="help-block" style="color:red; font-size:small"></small>
</div>

@endsection

{{-- JAVASCRIPT INCLUDE SECTION --}}
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('body').on('click', '#editTrafic', function(event) {
            });


            $('#app-modal').modal({
                backdrop: 'static',
                keyboard: false // to prevent closing with Esc button (if you want this too)
            });

            document.getElementById('markPresences').style.display = "none";



            //SUBMIT FORM ONCLICK FUNCTION

            $('body').on('click', '#app-modal-submit-btn', function(event) {

                var out_at = $('#p-out-at').val();
                var in_at = $('#p-in-at').val();

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

                            in_at: in_at,

                            out_at: out_at,

                    },
                        dataType: 'json',

                    }).done(function(data) {

                        console.log(data);

                        //request is succed
                        //$('.alert-success').removeClass('hidden');

                        $('#tableDIV').load(location.href + ' #tableDIV>*', '');

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
@endpush
