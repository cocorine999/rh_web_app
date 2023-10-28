@extends('layouts.dashboard')

@section('dash')
    <div class="bg-image" style="background-image: url({{ asset('assets/media/avatars/photo12@2x.jpg') }});">
        <div class="bg-black-50">
            <div class="content content-full text-center">
                <div class="my-3">

                    <img src="{{ asset(optional(optional($setting)->logo)->url ?? 'assets/logo/logo.jpg') }}" style="width: 100px; text-center">
                    {{-- <img class="img-avatar img-avatar-thumb" style="width: 100px; width: 100px; text-center"
                        src="{{ asset(optional(optional($setting)->logo)->url ?? 'assets/logo/logo.jpg') }}" alt=""> --}}
                </div>
                <h1 class="h2 text-white mb-0">{{ str_replace('\\', '', optional($setting)->enterprise_name) }}</h1>
                <span class="text-white-75">
                    {{ str_replace('\\', '', optional($setting)->slogan) }}
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

        {{-- <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Détails de l'application</h3>
            </div>
            <div class="block-content">
                <form action="be_pages_ecom_customer.html" onsubmit="return false;">
                    <div class="mb-4">
                        <label class="form-label" for="one-ecom-customer-note">{{ optional($setting)->app_name }}</label>
                    </div>
                </form>
            </div>
        </div> --}}

        <div class="block block-rounded">

            {{ $setting->id }}

            <div class="block-header block-header-default">
                <h3 class="block-title">DÉTAILS DE L'ENTREPRISE</h3>
            </div>
            <div class="block-content">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="block block-rounded block-bordered">
                            <div class="block-header border-bottom">
                                <h3 class="block-title">Information générale de l'entreprise</h3>
                            </div>
                            <div class="block-content">
                                <div class="fs-4 mb-1">{{ optional($setting)->enterprise_name }}</div>
                                <address class="fs-sm">
                                    {{ optional($setting)->enterprise_adress }}<br><br>
                                    <i class="fa fa-phone"></i> {{ optional($setting)->enterprise_phone_number }}<br><br>
                                    <i class="fa fa-envelope"></i> <a href="javascript:void(0)"> {{ optional($setting)->enterprise_contact_url }}</a>
                                </address>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="block block-rounded block-bordered">
                            <div class="block-header border-bottom">
                                <h3 class="block-title">Description du secteur d'activité</h3>
                            </div>
                            <div class="block-content">
                                <div class="fs-4 mb-1">{!! optional($setting)->description !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Parametre Généraux</h3>
            </div>
            <div class="block-content">
                <form id="setting_form_id" enctype="multipart/form-data" action="{{ route('dashboard.settings.update', optional($setting)->id) }}"
                    method="POST">
                    @csrf
                    <div class="row push">
                        <div class="col-lg-4">
                            <p class="fs-sm text-muted">
                                Your billing information is never shown to other users and only used for creating your
                                invoices.
                            </p>
                        </div>
                        <div class="col-lg-8">
                            <div class="mb-4">
                                <label class="form-label" for="app_name">Nom de l'application</label>
                                <input type="text" class="form-control"  value="{{ str_replace('\\', '', optional($setting)->app_name) }}" id="app_name" name="app_name">
                                <small class="help-block" style="color:red; font-size:small"></small>
                            </div>
                            <div class="mb-5">
                                <label class="form-label" for="app_url">Lien de l'application</label>
                                <input type="text" class="form-control" value="{{ optional($setting)->app_url }}" id="app_url" name="app_url">
                                <small class="help-block" style="color:red; font-size:small"></small>
                            </div>

                            <div class="mb-4 text-center">

                                {{-- <img src="{{ asset(optional(optional($setting)->logo)->url ?? 'assets/logo/logo.jpg') }}" style="width: 100px; text-center"> --}}

                                    <img class="img-avatar"
                                        src="{{asset(optional(optional($setting)->logo)->url ?? 'assets/logo/logo.jpg') }}"
                                        alt="">

                                <div class="mb-4">
                                    <label for="one-profile-edit-avatar" class="form-label">Changer de logo</label>
                                    <input class="form-control" type="file" name="logo" id="one-profile-edit-avatar">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="enterprise_name">Nom de l'entreprise</label>
                                <input type="text" value="{{ str_replace('\\', '', optional($setting)->enterprise_name) }}" class="form-control" id="enterprise_name" name="enterprise_name">
                                <small class="help-block" style="color:red; font-size:small"></small>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="slogan">Slogan de l'entreprise</label>
                                <textarea name="slogan" id="slogan"
                                    class="form-control form-control-lg @error('slogan') is-invalid @enderror">{{ str_replace('\\', '', optional($setting)->slogan) }}</textarea>
                                <small class="help-block" style="color:red; font-size:small"></small>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="description">Bref description du secteur d'activité de
                                    l'entreprise</label>
                                <textarea cols="30" rows="2" id="rapport-description" name="description"
                                    class="form-control form-control-lg @error('description') is-invalid @enderror">

                                    {{ str_replace('\\', '', optional($setting)->description) }}
                                </textarea>
                                <small class="help-block" style="color:red; font-size:small"></small>
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="site_web_url">Lien vers le site de l'entreprise</label>
                                <input type="text" class="form-control" id="site_web_url" name="site_web_url">
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="enterprise_contact_url">Adresse email de contact </label>
                                <input type="link" class="form-control" id="enterprise_contact_url"
                                    name="enterprise_contact_url">
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="enterprise_phone_number">Numéro de téléphone de l'entreprise</label>
                                <input type="tel" class="form-control" id="enterprise_phone_number" name="enterprise_phone_number">
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="enterprise_adress">Adresse de l'entreprise</label>
                                <input type="text" class="form-control" id="enterprise_adress" name="enterprise_adress">
                            </div>

                            <div class="mb-5">
                                <label class="form-label" for="site_web_url">Couleurs de l'entreprise</label>
                                <select class="form-select" id="colors" name="colors" multiple
                                    class="form-control form-control-lg @error('colors') is-invalid @enderror">
                                    <option value="red" id="colors-red"> Rouge </option>
                                    <option value="green" id="colors-green"> Vert </option>
                                    <option value="yellow" id="colors-yellow"> Jaune </option>
                                    <option value="grey" id="colors-grey"> Gris </option>
                                    <option value="blue" id="colors-blue"> Bleu </option>
                                </select>
                            </div>

                            <div class="row mb-4">
                                <label class="form-label" for="horaire_service_start">Horaire de service</label>
                                <div class="col-6">
                                    <label class="form-label" for="horaire_service_start">Commence à</label>
                                    <input type="time" class="form-control" id="horaire_service_start"
                                        name="horaire_service_start">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="horaire_service_end">Prend fin à</label>
                                    <input type="time" class="form-control" id="horaire_service_end"
                                        name="horaire_service_end">
                                </div>
                            </div>

                            <div class="row mb-5">
                                <label class="form-label" for="horaire_pause_start">Horaire de pause</label>
                                <div class="col-6">
                                    <label class="form-label" for="horaire_pause_start">Commence à</label>
                                    <input type="time" class="form-control" id="horaire_pause_start"
                                        name="horaire_pause_start">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="horaire_pause_end">Prend fin à</label>
                                    <input type="time" class="form-control" id="horaire_pause_end"
                                        name="horaire_pause_end">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label class="form-label" for="social_network">Social network links</label>
                                <div class="col-6">
                                    <label class="form-label" for="social_fb_url">Facebook link</label>
                                    <input type="link" class="form-control" id="social_fb_url" name="social_fb_url">
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="social_tw_url">Twitter link</label>
                                    <input type="link" class="form-control" id="social_tw_url" name="social_tw_url">
                                </div>

                                <div class="col-6">
                                    <label class="form-label" for="social_insta_url">Instagram link</label>
                                    <input type="link" class="form-control" id="social_insta_url"
                                        name="social_insta_url">
                                </div>

                                <div class="col-6">
                                    <label class="form-label" for="social_google_url">Google link</label>
                                    <input type="link" class="form-control" id="social_google_url"
                                        name="social_google_url">
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
        document.getElementById("bar").style.display = "none";
    </script>

    <script>
        $('#setting_form_id')[0].reset();/*
        $('#app_name').val('{{ optional($setting)->app_name }}');
        $('#app_url').val('{{ optional($setting)->app_url }}');
        $('#enterprise_name').val('{{ optional($setting)->enterprise_name }}'); */

        $('#colors').val('{{ optional($setting)->colors }}');
        $('#site_web_url').val('{{ optional($setting)->site_web_url }}');
        $('#enterprise_phone_number').val('{{ optional($setting)->enterprise_phone_number }}');
        $('#enterprise_adress').val('{{ optional($setting)->enterprise_adress }}');
        $('#horaire_service_start').val('{{ optional($setting)->horaire_service_start }}');
        $('#horaire_service_end').val('{{ optional($setting)->horaire_service_end }}');
        $('#horaire_pause_start').val('{{ optional($setting)->horaire_pause_start }}');
        $('#horaire_pause_end').val('{{ optional($setting)->horaire_pause_end }}');


        $('#social_fb_link').val('{{ optional($setting)->social_fb_link }}');
        $('#social_tw_link').val('{{ optional($setting)->social_tw_link }}');
        $('#social_insta_link').val('{{ optional($setting)->social_insta_link }}');
        $('#social_google_url').val('{{ optional($setting)->social_google_url }}');
        $('#enterprise_contact_url').val('{{ optional($setting)->enterprise_contact_url }}');
    </script>

@endpush
