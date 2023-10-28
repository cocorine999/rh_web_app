@extends('layouts.dashboard')

{{-- SETTINGS PAGE SPECIFICATION --}}
@section('title')
    PAIEMENT DE SALAIRE
@endsection

@section('subtitle')
    HISTORIQUE DES PAIEMENTS
@endsection

@section('dash')
    @php $edit =0; @endphp
    <div class="block-content">

        @canany(['manage-payments','create-payments'])
        <div class="mb-4" style="display: flex;">

            <button id="btn-action" onclick="event.preventDefault(); document.getElementById('form_id').style.display = 'block';" type="button" class="btn btn-primary m-1 action-btn-cancel">
                <i class="fa fa-plus opacity-50"></i>
                Payer salaire
            </button>
        </div>
        @endcanany

        <div id="form_id" style="display: none!important;" class="block block-rounded d-flex flex-column h-100 mb-4">

            <div class="bg-body-light rounded-bottom">
                <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                    href="javascript:void(0)">
                    <span id="update">PAIEMENT D'UN NOUVEAU SALAIRE</span>
                </a>
            </div>
            <div class="block-content block-content-full justify-content-between align-items-center">

                <form id="paiement_form" method="POST" action="{{ route('dashboard.paiements.store') }}">
                    @csrf

                    <p id="paiement_form_method"></p>

                    <div class="mb-4">
                        <label class="form-label" for="date">Salaire du</label>
                        <small class="help-block" style="color:red; font-size:small">*</small>
                        <input type="month" class="js-flatpickr form-control js-flatpickr-enabled flatpickr-input" id="paiement-date" name="date"
                        placeholder="{{ \Carbon\Carbon::today()->addWeeks(1)->format('Y-m') }}"
                      class="form-control form-control-lg @error('date') is-invalid @enderror"
                      value="{{ \Carbon\Carbon::today()->format('Y-m') }}" required="required" autocomplete="date" autofocus
                        >
                        <small class="help-block" style="color:red; font-size:small"></small>
                  </div>
                    <div class="mb-4">
                        <label class="form-label" for="user">Utilisateurs</label>
                        <small class="help-block" style="color:red; font-size:small">*</small>
                        <select class="form-select" id="paiement-user-id" name="user_id" required="required"
                            class="form-control form-control-lg @error('user') is-invalid @enderror">
                            <option value="">Faites votre choix</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"> {{ \Str::ucfirst($user->civilite) }}
                                    {{ str_replace('\\','',$user->last_name) }} {{ str_replace('\\','',$user->first_name) }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    @foreach ($user->user_actual_poste as $poste)
                                        {{ \Str::ucfirst(str_replace('\\', '', $poste->name)) }}
                                        @if ($user->user_actual_poste->last() != $poste)
                                            /
                                        @endif
                                    @endforeach

                                    {{-- {{ str_replace('\\','',$user->postes->first()->name) }} --}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- <div class="mb-4">
                        <label class="form-label" for="salaire">Montant </label>
                        <input type="tel" id="paiement-salaire" name="salaire" placeholder="100.000"
                            class="form-control form-control-lg @error('salaire') is-invalid @enderror" name="salaire"
                            value="{{ old('salaire') }}" required autocomplete="salaire" autofocus>
                        <small class="help-block" style="color:red; font-size:small"></small>
                    </div> --}}

                    <div class="" style="display: flex;">
                        <button type="submit" class="btn btn-primary m-1 action-btn"
                            style="display: inline-block;">PAYER</button>
                        <button type="button" class="btn btn-secondary m-1 action-btn-cancel" onclick="
                                        event.preventDefault();
                                        $('#update').html('PAIEMENT D\'UN NOUVEAU SALAIRE');
                                document.getElementById('paiement_form').setAttribute('action','{{ route('dashboard.paiements.store') }}');
                                            document.getElementById('paiement_form_method').innerHTML = '';
                                            $('#paiement_form').load(location.href+' #paiement_form>*','');
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
                    HISTORIQUE DES PAIEMENTS
                </div>

                <div class="block-options space-x-1">
                    <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle"
                        data-target="#one-dashboard-search-orders" data-class="d-none">
                        <svg class="svg-inline--fa fa-search fa-w-16" aria-hidden="true" data-prefix="fa" data-icon="search"
                            paiement="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                            <path fill="currentColor"
                                d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                            </path>
                        </svg>
                    </button>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-sm btn-alt-secondary" id="dropdown-recent-orders-filters"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-fw fa-flask"></i>
                            Filters<i class="fa fa-angle-down ms-1"></i>
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
                    <th class="d-none d-sm-table-cell" >Montant</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Période</th>
                    <th class="d-none d-sm-table-cell" style="width: 15%;">Status</th>
                    <th style="width: 15%;">Action</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach ($paiements as $paiement)
                            <tr>
                                <td class="text-center">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                        <label class="form-check-label" for="row_1"></label>
                                    </div>
                                </td>
                                <td class="fs-sm">
                                    <p class="fw-semibold mb-1">
                                        <a>{{ \Str::ucfirst(optional($paiement->poste_user->user)->civilite) }}
                                            {{ str_replace('\\','',optional($paiement->poste_user->user)->last_name) }} {{ str_replace('\\','',optional($paiement->poste_user->user)->first_name) }}</a>
                                    </p>
                                    <p class="text-muted mb-0">
                                        {{ str_replace('\\','',$paiement->poste_user->poste->name) }}
                                    </p>
                                </td>

                                <td class="d-none d-sm-table-cell fs-sm">{{ $paiement->salaire }}</td>

                                <td class="fs-sm">
                                    <p class="mb-1">
                                        @php
                                            $date =\Carbon\Carbon::parse($paiement->date)->locale('fr');
                                        @endphp
                                        <a>{{ Str::ucfirst(\Carbon\Carbon::parse($paiement->date)->locale('fr')->isoFormat('MMMM, Y')) }}</a>
                                    </p>
                                    @if ($paiement->is_pay == 1)
                                    <p class="text-muted mb-0">
                                        Payer le
                                        {{ \Carbon\Carbon::parse($paiement->date)->format('d-m-Y') }}
                                    </p>
                                    @endif

                                </td>
                                <td class="d-none d-sm-table-cell">
                                    @if ($paiement->is_pay == 0 || $paiement->is_pay == 2 )
                                        <span
                                            class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-warning">
                                            En attente
                                        </span>
                                    @elseif($paiement->is_pay == 1 )
                                        <span
                                            class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success">
                                            Confirmée
                                        </span>
                                    @else
                                        <span
                                            class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger">
                                            Non-Confirmée
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        @if ($paiement->is_pay == 1)
                                        <a type="button" id="viewPay"
                                        href="{{ route('dashboard.paiements.show', $paiement->id) }}"
                                        class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                        data-bs-toggle="tooltip" title="Consulter"
                                        data-bs-original-title="View pay">
                                        <i class="fa fa-fw fa-eye"></i>
                                    </a>
                                    @endif
                                        @if ($paiement->is_pay != -1 && $paiement->is_pay != 1 )
                                        @can('validate-paiement', $paiement)
                                            <form  action="{{ route('dashboard.paiements.valider', $paiement->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-alt-success bg-success-light mr-1 js-bs-tooltip-enabled"
                                                    data-bs-toggle="tooltip"  title="Veuillez confirmer que vous avez recu la paie du mois"
                                                    data-bs-original-title="Sortie de service">
                                                    <i class="fa fa-fw fa-check text-success"></i>
                                                </button>
                                            </form>

                                            <form action="{{ route('dashboard.paiements.rejeter', $paiement->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn mr-1 btn-sm btn-alt-warning js-bs-tooltip-enabled"
                                                    data-bs-toggle="tooltip" title="Notifier que vous n'avez pas reçu la paie du mois"
                                                    data-bs-original-title="Rejeter">
                                                    <i class="fa fa-fw fa-exclamation-triangle text-warning"></i>
                                                </button>
                                            </form>
                                        @endcan
                                        @canany(['manage-payments'])
                                            <form action="{{ route('dashboard.paiements.destroy', $paiement->id) }}"
                                                method="POST">
                                                @canany(['manage-payments','update-payments'])
                                                <a type="submit" id="editPay"
                                                    onclick="event.preventDefault();
                                                    document.getElementById('form_id').style.display = 'block';
                                                        $('#update').html('MODIFICATION DES INF0RMATIONS D\'UNE PAIE');
                                                        $('#paiement-user-id').val('{{ $paiement->user_id }}');
                                                        $('#paiement-salaire').val('{{ $paiement->salaire }}');
                                                        $('#paiement-date').val('{{ \Carbon\Carbon::parse($paiement->date)->format('Y-m') }}');
                                                        document.getElementById('paiement_form').setAttribute('action','{{ route('dashboard.paiements.update', $paiement->id) }}');"
                                                    class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                    data-bs-toggle="tooltip" title="Modifier les détails de la paie" data-bs-original-title="Edit Paiement">
                                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                                </a>
                                                @endcanany
                                                @csrf
                                                @method('DELETE')
                                                @canany(['manage-payments','delete-payments'])
                                                <button type="submit" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                    data-bs-toggle="tooltip" title="Supprimer la paie" data-bs-original-title="Remove la paie">
                                                    <i class="fa fa-fw fa-times"></i>
                                                </button>
                                                @endcanany
                                            </form>
                                        @endcanany
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                          </tbody>
              </table>
            </div>
        </div>
{{--

  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">Dynamic Table <small>Export Buttons</small></h3>
    </div>
    <div class="block-content block-content-full">
      <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
        <thead>
          <tr>
            <th class="text-center" style="width: 80px;">ID</th>
            <th>Name</th>
            <th class="d-none d-sm-table-cell" style="width: 30%;">Email</th>
            <th class="d-none d-sm-table-cell" style="width: 15%;">Access</th>
            <th style="width: 15%;">Registered</th>
          </tr>
        </thead>
        <tbody>
                      <tr>
              <td class="text-center fs-sm">1</td>
              <td class="fw-semibold fs-sm">
                <a href="be_pages_generic_profile.html">Jose Parker</a>
              </td>
              <td class="d-none d-sm-table-cell fs-sm">
                client1<span class="text-muted">@example.com</span>
              </td>
              <td class="d-none d-sm-table-cell">
                <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger">Disabled</span>
              </td>
              <td>
                <span class="text-muted fs-sm">3 days ago</span>
              </td>
            </tr>
                      <tr>
              <td class="text-center fs-sm">2</td>
              <td class="fw-semibold fs-sm">
                <a href="be_pages_generic_profile.html">Laura Carr</a>
              </td>
              <td class="d-none d-sm-table-cell fs-sm">
                client2<span class="text-muted">@example.com</span>
              </td>
              <td class="d-none d-sm-table-cell">
                <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-info-light text-info">Business</span>
              </td>
              <td>
                <span class="text-muted fs-sm">8 days ago</span>
              </td>
            </tr>
                  </tbody>
      </table>
    </div>
  </div> --}}

    </div>

@endsection

{{-- JAVASCRIPT INCLUDE SECTION --}}
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('body').on('click', '#editPay', function(event) {
                document.getElementById('paiement_form_method').innerHTML = '{{ method_field('PUT') }}';
                console.log($('#paiement_form'));
                $('.action-btn').html('Modifier');
                $('html,body').animate({
                    scrollTop: 0
                }, 'fast');
            });
        });
    </script>
@endpush
