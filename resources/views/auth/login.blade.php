
@extends('layouts.app')

@section('content')
<main id="main-container">
    <div class="hero-static d-flex align-items-center">
        <div class="content">
            <div class="row justify-content-center push">

                <div class="col-md-8 col-lg-6 col-xl-4 " >

                    <div class="text-center">
                        <img src="{{ "assets/logo/logo.jpg" }}" style="width: 100px; text-center">
                    </div>

                    <div class="block block-rounded mb-0 mt-4">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Sign In</h3>
                            <div class="block-options">
                                <a class="btn-block-option fs-sm" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                                {{-- <a class="btn-block-option js-bs-tooltip-enabled" href="{{ route('register') }}"
                                    data-bs-toggle="tooltip" data-bs-placement="left" title=""
                                    data-bs-original-title="{{ __('Register') }}">
                                    <i class="fa fa-user-plus"></i>
                                </a> --}}
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">

                                @error('errors')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors }}</strong>
                                    </span>
                                @enderror
                                <form class="js-validation-signin"
                                    novalidate="novalidate" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="py-3">
                                        <div class="mb-4">
                                            <input type="text"
                                                class="form-control form-control-alt form-control-lg"
                                                id="telephone" name="telephone"
                                                placeholder="Téléphone">
                                            @error('telephone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <input type="password"
                                                class="form-control form-control-alt form-control-lg"
                                                id="password" name="password"
                                                placeholder="Password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="remember" name="remember">
                                                <label class="form-check-label"
                                                    for="remember">Remember Me</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-6 col-xl-6">
                                            <button type="submit" class="btn w-100 btn-alt-primary">
                                                <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i>
                                                Connecter
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fs-sm text-muted text-center">
                <strong>CFA Empire</strong> © <span data-toggle="year-copy"
                    class="js-year-copy-enabled">2021</span>
            </div>
        </div>
    </div>
</main>

@endsection
