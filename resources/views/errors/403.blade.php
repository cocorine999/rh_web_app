@extends('layouts.app')

@section('content')
    <main id="main-container">
        <div class="hero">
            <div class="hero-inner text-center">
                <div class="bg-body-extra-light">
                    <div class="content content-full overflow-hidden">
                        <div class="py-4">
                            <h1 class="display-1 fw-bolder text-amethyst">
                                401
                            </h1>
                            <h2 class="h4 fw-normal text-muted mb-5">
                                We are sorry but you are not authorized to access this page..
                            </h2>
                            <form action="be_pages_generic_search.html" method="POST">
                                <div class="row justify-content-center mb-4">
                                    <div class="col-sm-6 col-xl-3">
                                        <div class="input-group input-group-lg">
                                            <input class="form-control form-control-alt" type="text"
                                                placeholder="Search application..">
                                            <button type="button" class="btn btn-dark">
                                                <i class="fa fa-search opacity-75"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="content content-full text-muted fs-sm fw-medium">
                    <p class="mb-1">
                        Would you like to let us know about it?
                    </p>
                    <a class="link-fx" href="javascript:void(0)">Report it</a> or <a class="link-fx"
                        href="be_pages_error_all.html">Go Back to Dashboard</a>
                </div>
            </div>
        </div>
    </main>

@endsection
