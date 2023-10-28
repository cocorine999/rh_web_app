@extends('layouts.dashboard')

{{-- SETTINGS PAGE SPECIFICATION --}}
@section('title')
    GESTION RAPPORTS
@endsection

@section('subtitle')
    POINTS JOURNALIERS DES TRAVAUX
@endsection

@section('dash')

    <div class="block-content">


        @canany(['manage-reports', 'create-reports'])
            <div class="mb-4" style="display: flex;">

                <button id="btn-action"
                    onclick="event.preventDefault(); document.getElementById('form_id').style.display = 'block';" type="button"
                    class="btn btn-primary m-1 action-btn-cancel">
                    <i class="fa fa-plus opacity-50"></i>
                    Nouveau rapport
                </button>
            </div>
        @endcanany

        <div id="form_id" style="display: none!important;" class="block block-rounded d-flex flex-column h-100 mb-4">

            <div class="bg-body-light rounded-bottom">
                <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between"
                    href="javascript:void(0)">
                    <span id="update">REDIGER MON RAPPORT</span>
                </a>
            </div>
            <div class="block-content block-content-full justify-content-between align-items-center">

                <form id="rapport_form" method="POST" name="form_name" action="{{ route('dashboard.rapports.store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <p id="rapport_form_method"></p>

                    <div class="mb-4">
                        <label class="form-label" for="libelle">Titre du rapport</label>
                        <small class="help-block" style="color:red; font-size:small">*</small>
                        <input type="text" id="rapport-libelle" name="libelle" placeholder="Titre du rapport"
                            class="form-control form-control-lg @error('libelle') is-invalid @enderror"
                            value="{{ old('libelle') }}" required="required" autocomplete="libelle" autofocus>
                        <small class="help-block" style="color:red; font-size:small"></small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="description">Point des travaux effectué dans la journéé</label>
                        <textarea cols="30" rows="2" id="rapport-description" name="description"
                            class="form-control form-control-lg @error('description') is-invalid @enderror"
                            value="{{ old('description') }}" required autocomplete="description" autofocus
                            placeholder="Ecrivez le point de l'ensemble des activités que vous avez effectué aujourd'hui pour le compte de l'entreprise"></textarea>
                        <small class="help-block" style="color:red; font-size:small"></small>
                    </div>

                    <div class="mb-4">
                        <label for="form-label" class="form-label">Fichiers</label>
                        <small class="help-block" style="color:red; font-size:small">*</small>
                        <input class="form-control" name="fichiers[]" type="file"
                            accept="image/jpeg,image/gif,image/png,application/pdf,application/doc,image/x-eps"
                            id="rapport-files" multiple="" placeholder="Associer des fichiers si possible"
                            class="form-control form-control-lg @error('fichiers') is-invalid @enderror"
                            autocomplete="fichiers" autofocus>
                        <small class="help-block" style="color:red; font-size:small"></small>
                    </div>

                    <div class="mb-4" style="display:none;" id="editFilesDiv">

                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="date">Rapport du</label>
                        <small class="help-block" style="color:red; font-size:small">*</small>
                        <input type="date" min="{{ \Carbon\Carbon::today()->subWeek()->format('Y-m-d') }}"
                            max="{{ \Carbon\Carbon::today()->format('Y-m-d') }}"
                            class="js-flatpickr form-control js-flatpickr-enabled flatpickr-input" id="rapport-date"
                            name="date" placeholder="{{ \Carbon\Carbon::today() }}"
                            class="form-control form-control-lg @error('date') is-invalid @enderror"
                            value="{{ old('date') }}" required="required" autocomplete="date" autofocus>

                        <small class="help-block" style="color:red; font-size:small"></small>
                    </div>


                    <div class="" style=" display: flex;">
                        <button type="submit" class="btn btn-primary m-1 action-btn" style="display: inline-block;">Envoyer
                            le rapport</button>
                        <button type="button" class="btn btn-secondary m-1 action-btn-cancel" onclick="
                                        event.preventDefault();
                                        $('#update').html('REDIGER MON RAPPORT');
                                            document.getElementById('rapport_form').setAttribute('action','{{ route('dashboard.rapports.store') }}');
                                        document.getElementById('rapport_form_method').innerHTML = '';
                                        $('#rapport_form').load(location.href+' #rapport_form>*','');"
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

        {{-- <div class="panel-body">
            <form id="dropzoneForm" class="dropzone" action="{{ route('dashboard.rapports.add.files') }}">
              @csrf
            </form>

            <div class="text-center">
              <button type="button" class="btn btn-info" id="submit-all">Upload</button>
            </div>
        </div> --}}

        <div class="block block-rounded">

            <div class="block-header block-header-default">

                <div class="block-title mt-3 mt-md-0 ms-md-3 space-x-1">
                    HISTORIQUE DES RAPPORTS
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
                                name="searchValue" placeholder="Search rapports..">
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

                      <th class="text-center">
                          <div class="form-check d-inline-block">
                              <input class="form-check-input" type="checkbox" value="" id="check-all"
                                  name="check-all">
                          </div>
                      </th>
                      <th class="d-none d-sm-table-cell" style="width: 30%;">Nom & prénom</th>
                      <th class="d-none d-sm-table-cell" >Contenu</th>
                      <th class="d-none d-sm-table-cell" style="width: 30%;">Rapport du</th>
                      <th class="d-none d-sm-table-cell text-center" style="width: 20%;">Action</th>
                    </tr>
                  </thead>
                  <tbody>

                        @foreach ($rapports as $rapport)
                            <tr>
                                <td class="text-center">
                                    <div class="form-check d-inline-block">
                                        <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                        <label class="form-check-label" for="row_1"></label>
                                    </div>
                                </td>
                                <td class="fs-sm">
                                    <p class="fw-semibold mb-1">
                                        <a>{{ \Str::ucfirst($rapport->user->civilite) }}
                                            {{ str_replace('\\', '', $rapport->user->last_name) }}
                                            {{ str_replace('\\', '', $rapport->user->first_name) }}</a>
                                    </p>
                                    <p class="text-muted mb-0">
                                        {{ \Str::ucfirst(str_replace('\\', '', $rapport->user->postes->first()->name)) }}
                                    </p>
                                </td>
                                <td class="fs-sm d-none d-sm-table-cell fs-sm"> {{ \Str::ucfirst(str_replace('\\', '', $rapport->libelle)) }} </td>

                                <td class="fs-sm text-left mb-1"> {{ $rapport->date ? str_replace('T',' à ',$rapport->date) : '__/__/__ --:--' }}</td>

                                <td class="text-center">
                                    <div class="btn-group">
                                        <form action="{{ route('dashboard.rapports.destroy', $rapport->id) }}"
                                            method="POST">
                                            @can('view', $rapport)
                                                <a type="button" id="viewRapport"
                                                    href="{{ route('dashboard.rapports.show', $rapport->id) }}"
                                                    class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                    data-bs-toggle="tooltip" title="" data-bs-original-title="Edit Rapport">
                                                    <i class="fa fa-fw fa-eye"></i>
                                                </a>
                                            @endcan
                                            @can('update-rapport', $rapport)
                                                <a type="button" id="editRapport"
                                                    onclick="event.preventDefault();
                                                                        document.getElementById('form_id').style.display = 'block';

                                                                                        $('#rapport-libelle').val('{{ $rapport->libelle }}');
                                                                                        $('#rapport-date').val('{{ $rapport->date }}');
                                                                                        CKEDITOR.instances['rapport-description'].setData('{{ \Str::ucfirst($rapport->description) }}');
                                                                                        $('#update').html('MODIFICATION DES INF0RMATIONS DANS LE RAPPORT');

                                                                                        var fichiers = {{ $rapport->files }};

                                                                                        window.Fichiers = fichiers;
                                                                                        document.getElementById('rapport_form').setAttribute('action','{{ route('dashboard.rapports.update', $rapport->id) }}');"
                                                    class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                    data-bs-toggle="tooltip" title="" data-bs-original-title="Edit Rapport">
                                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                                </a>
                                            @endcan

                                            @csrf
                                            @method('DELETE')
                                            @can('delete-rapport', $rapport)
                                                <button type="submit" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                                    data-bs-toggle="tooltip" title=""
                                                    data-bs-original-title="Supprimer le rapport">
                                                    <i class="fa fa-fw fa-times"></i>
                                                </button>
                                            @endcan
                                        </form>
                                        {{-- for (let index = 0; index < fichiers.length; index++) {
                                            output += '<div class="col-md-2 text-center" style="margin-bottom:16px;"> <img src="'{{ asset($fichiers[$index].url) }}'" class="img-thumbnail" width="175" height="175" style="height:175px;" /> <button type="button" class="btn btn-link remove_image" id="'+$fichiers[$index].name+'">Remove</button> </div> ';
                                        }
                                        $output += '</div>'; --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {!! $rapports->links() !!}
            </div>
        </div>
    </div>

    <div class="modal" id="previewFile" tabindex="-1" role="dialog" aria-labelledby="previewFile"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <div class="block-options text-right" style="text-align: right;">
                            <button type="button" class="btn-block-option text-right" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i class="fa fa-fw fa-times text-right"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content fs-sm text-center">
                        <embed id="preview-file-component" class="mb-4" href="" src="" alt=""
                            height="375px">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- JAVASCRIPT INCLUDE SECTION --}}
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('body').on('click', '#editRapport', function(event) {
                document.getElementById('rapport_form_method').innerHTML =
                    '{{ method_field('PUT') }}';

                reloadFilesComponent();

                $('.action-btn').html('Modifier');
                $('html,body').animate({
                    scrollTop: 0
                }, 'fast');
            });
        });
    </script>

    <script>
        function reloadFilesComponent(id) {

            console.log(window.Fichiers);

            var fichiers =  window.Fichiers.filter(item => item.id != id);

            window.Fichiers = fichiers;

            console.log(window.Fichiers);

            var output = null;

            for (let index = 0; index < fichiers.length; index++) {
                if (fichiers[index].id != id) {

                    var src = fichiers[index].url;
                    if (output == null) {
                        output =
                            '<div class="col-md-2" style="margin-bottom:16px; display:inline-block; text-align:center;"> <a type="button" data-bs-toggle="modal" data-bs-target="#previewFile" data-backdrop="static" data-keyboard="false" onclick="event.preventDefault(); previewFiles();" id="' +
                            fichiers[index].id + '"> <embed style="margin-bottom:12px;" src="{{ asset('') }}' + src +
                            '" class="img-thumbnail" width="175" height="175" style="height:175px;"/> </a> <button type="button" class="btn btn-link remove_image text-danger" onclick="event.preventDefault(); deleteFiles();" id="' +
                            fichiers[index].id +
                            '"><i class="fa fa-fw fa-times text-danger"></i> &nbsp; Supprimer</button> </div>';
                    } else {
                        output +=
                            '<div class="col-md-2" style="margin-bottom:16px; display:inline-block; text-align:center;"> <a type="button" data-bs-toggle="modal" data-bs-target="#previewFile" data-backdrop="static" data-keyboard="false" onclick="event.preventDefault(); previewFiles();" id="' +
                            fichiers[index].id + '"> <embed style="margin-bottom:12px;" src="{{ asset('') }}' + src +
                            '" class="img-thumbnail" width="175" height="175" style="height:175px;"/> </a> <button type="button" class="btn btn-link remove_image text-danger" onclick="event.preventDefault(); deleteFiles();" id="' +
                            fichiers[index].id +
                            '"><i class="fa fa-fw fa-times text-danger"></i> &nbsp; Supprimer</button> </div>';
                    }
                }


            }

            document.getElementById('editFilesDiv').innerHTML = output;

            document.getElementById('editFilesDiv').setAttribute('style', 'display:block;');

        }

        function deleteFiles() {

            var response = window.confirm('Voulez-vous vraiement supprimé ce fichier???');

            if (response) {
                destroyFile(event.srcElement.id);
            }

        }

        function previewFiles() {
            $('#previewFile').modal('hide');
            document.getElementById('preview-file-component').setAttribute("src", event.srcElement.src);
            $('#previewFile').modal('show');
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
                    console.log(data);
                    reloadFilesComponent(id);
                    /* $('.alert-success').removeClass('hidden');
                    $('#modal-block-normal').modal('hide');
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
    </script>

@endpush



@push('custom-js')
    {{-- <script src="{{ asset('assets/js/oneui.app.min-5.1.js') }}"></script>
<script src="{{ asset('assets/js/be_pages_dashboard.min.js') }}"></script> --}}
@endpush
