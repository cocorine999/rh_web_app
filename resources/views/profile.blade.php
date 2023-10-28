@extends('layouts.dashboard')

@section('dash')

    @php
        if($user == null){
            $user = auth()->user();
        }
    @endphp
    <div class="bg-image" style="background-image: url({{ asset('assets/media/avatars/photo12@2x.jpg') }});">
        <div class="bg-black-50">
            <div class="content content-full text-center">
                <div class="my-3">
                    <img class="img-avatar img-avatar-thumb"
                        src="{{ asset(optional($user->profile)->url ?? 'assets/media/avatars/avatar10.jpg') }}"
                        alt="">

                        <a class="d-flex py-2"  style=" padding:0rem!important;" href="javascript:void(0)">
                            <div class="flex-shrink-0 me-3 ms-2 overlay-container overlay-bottom" style="margin-right: .6rem!important; margin-left: 0rem!important;">
                                <img class="img-avatar img-avatar-thumb" id="profilPreview" src="{{ asset(optional($user->profile)->url ?? 'assets/media/avatars/avatar10.jpg') }}" alt="">
                                <span class="overlay-item " onclick="document.getElementById('profileImage').click();" style=" text-align:center; bottom: 0px; right:-2px;width: 1.5rem;height: 1.5rem;">
                                    <i class="fa fa-camera mt-1" style="color:#adb5bd; font-size:18px;"></i>
                                    <input hidden="" type="file" accept="image/*" onchange="showPreviewImage(event,'profilPreview');" id="profileImage" name="profile">
                                </span>
                            </div>
                        </a>

        <a class="ms-auto btn btn-sm btn-alt-secondary" id="resetProfile" style="display: none;" href="javascript:void(0)" onclick="resetProfil({{ optional($user)->id }})">
            <i class="fa fa-fw fa-pencil"></i> Modifier
        </a>
                </div>
                <h1 class="h2 text-white mb-0">{{ str_replace('\\', '', $user->last_name) }}
                    {{ str_replace('\\', '', $user->first_name) }}</h1>
                <span class="text-white-75">
                    @foreach ($user->user_actual_poste as $poste)
                        {{ \Str::upper(str_replace('\\', '', $poste->name)) }}
                        @if ($user->user_actual_poste->last() != $poste)
                            /
                        @endif
                    @endforeach
                </span>
            </div>
        </div>
    </div>

    <div class="content content-boxed">
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
                <h3 class="block-title">Information personnelle.</h3>
            </div>
            <div class="block-content">


                <form id="user_form" method="POST" action="{{ route('dashboard.users.update', Auth::id()) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row push">
                        <div class="col-lg-3">
                            <p class="fs-sm text-muted">

                            </p>
                        </div>

                        <div class="col-lg-6 col-xl-6">

                            <div class="mb-4">
                                <label class="form-label" for="last_name">Nom</label>

                                <input type="text" id="user-last-name" name="last_name" value="{{ old('last_name') }}"
                                    class="form-control form-control-lg @error('last_name') is-invalid @enderror">
                                <small class="help-block" style="color:red; font-size:small"></small>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="first_name">Nom</label>

                                <input type="text" id="user-first-name" name="first_name" value="{{ old('first_name') }}"
                                    class="form-control form-control-lg @error('first_name') is-invalid @enderror">
                                <small class="help-block" style="color:red; font-size:small"></small>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="date_naissance">Date naissance</label>
                                <small class="help-block"
                                    style="color:red; font-size:small">{{ \Carbon\Carbon::parse($user->date_naissance)->age }}
                                    ans</small>
                                <input type="date" id="user-date-naissance" name="date_naissance"
                                    value="{{ old('date_naissance') }}"
                                    class="form-control form-control-lg @error('date_naissance') is-invalid @enderror">
                                <small class="help-block" style="color:red; font-size:small"></small>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="civilite">Civilité</label>

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

                                <input type="number" id="user-telephone" readonly
                                    class="form-control form-control-lg @error('telephone') is-invalid @enderror"
                                    name="telephone" value="{{ old('telephone') }}">
                                <small class="help-block" style="color:red; font-size:small"></small>
                            </div>


                            <div class="mb-4">
                                <label class="form-label" for="email">Adresse email</label>

                                <input type="email" id="user-email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}">
                                <small class="help-block" style="color:red; font-size:small"></small>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Your Avatar</label>
                                <div class="mb-4">
                                    <img class="img-avatar"
                                        src="{{ asset(optional($user->profile)->url ?? 'assets/media/avatars/avatar10.jpg') }}"
                                        alt="">
                                </div>
                                <div class="mb-4">
                                    <label for="one-profile-edit-avatar" class="form-label">Choose a new avatar</label>
                                    <input class="form-control" type="file" name="profile" id="one-profile-edit-avatar">
                                </div>
                            </div>

                            <div class="mb-4">
                                <button type="submit" class="btn btn-alt-primary">
                                    Mettre à jour
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Change Password</h3>
            </div>
            <div class="block-content">
                <form action="{{ route('dashboard.users.resetPassword', auth()->id()) }}" method="POST">
                    @csrf
                    <div class="row push">
                        <div class="col-lg-4">
                            <p class="fs-sm text-muted">
                                Changer votre mot de passe de connexion est un moyen simple de sécuriser votre compte..
                            </p>
                        </div>
                        <div class="col-lg-8 col-xl-5">
                            <div class="mb-4">
                                <label class="form-label" for="current-password">Mot de passe actuel</label>
                                <input type="password" required class="form-control" id="current-password"
                                    name="current_password">
                            </div>
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label class="form-label" for="password">Nouveau mot de passe</label>
                                    <input type="password" required class="form-control" id="password" name="password">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label class="form-label" for="confirmation-password">Confirmer le nouveau
                                        Mot de passe</label>
                                    <input type="password" class="form-control" id="confirmation-password"
                                        name="password_confirmation">
                                </div>
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="btn btn-alt-primary">
                                    Mettre à jour
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
@push('js')

    <script>


    function resetProfil(id){

        var formData =  new FormData();

        formData.append("id",id);
        formData.append("profile",$('#profileImage')[0].files[0]);

        $.ajax({
                url: "{{ route('dashboard.users.resetProfil')}}",
                type: "POST",
                enctype:'multipart/form-data',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                dataType:'json',
                contentType:false,
                processData:false,

            }).done(function(data) {
                $('#page-container').load(location.href + ' #page-container>*', '');
            })
            .fail(function(data) {
                console.log(data.responseJSON);
                window.alert(data.responseJSON.message);
            });


        }
    </script>

    <script>
        document.getElementById("bar").style.display = "none";
    </script>



    <script>
        $('#user_form')[0].reset();
        $('#user-last-name').val('{{ $user->last_name }}');
        $('#user-first-name').val('{{ $user->first_name }}');
        $('#user-civilite').val('{{ $user->civilite }}');
        $('#user-date-naissance').val('{{ $user->date_naissance }}');
        $('#user-email').val('{{ $user->email }}');
        $('#user-telephone').val('{{ $user->telephone }}');
        $('#user-status-matrimoniale').val('{{ $user->status_matrimoniale }}');
    </script>

@endpush
