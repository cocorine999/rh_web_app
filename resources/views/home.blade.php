@extends('layouts.dashboard')

@section('title') Dashboard @endsection
@section('subtitle')
Welcome <a class="fw-semibold" href="{{ route('dashboard.profile') }}">{{ Auth::user()->last_name }}
    {{ Auth::user()->first_name }}</a>, everything looks great. @endsection

@section('dash')

<div class="content">
    @if (auth()->user()->hasRoleorPoste('administrateur'))
    <div class="row items-push">

        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $permissions_count }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Permissions en attente</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.permissions.index') }}">
                        <span>Voir toutes les demandes</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $rendez_vous_count }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Rendez-vous en attente</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.rendez-vous.index') }}">
                        <span>Voir toutes les demandes</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $users_count }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Utilisateurs</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.users.index') }}">
                        <span>Voir plus</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $postes_count }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Postes</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.postes.index') }}">
                        <span>Voir plus</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>
    @elseif(auth()->user()->hasPoste('RH'))
    <div class="row items-push">

        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $permissions_count }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Permissions en attente</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.permissions.index') }}">
                        <span>Voir toutes les demandes</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $rendez_vous_count }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Rendez-vous en attente</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.rendez-vous.index') }}">
                        <span>Voir toutes les demandes</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $users_count }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Utilisateurs</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.users.index') }}">
                        <span>Voir plus</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $postes_count }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Postes</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.postes.index') }}">
                        <span>Voir plus</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>
    @elseif(auth()->user()->hasPoste('Comptable'))
    <div class="row items-push">

        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $paiements_waiting }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Paiement en attente</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.paiements.index') }}">
                        <span>Voir toutes les demandes</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $paiements_reject }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Paiement non confirmé</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.paiements.index') }}">
                        <span>Voir toutes les demandes</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $users_count }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Utilisateurs</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.users.index') }}">
                        <span>Voir plus</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $postes_count }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Postes</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.postes.index') }}">
                        <span>Voir plus</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>
    @elseif(auth()->user()->hasPoste('Sécrétariat'))
    <div class="row items-push">



        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $rendez_vous_count }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Rendez-vous en attente</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.rendez-vous.index') }}">
                        <span>Consulter les rendez-vous</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $presences_count }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Employés en service</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.presences.index') }}">
                        <span>Voir les présences</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $users_count }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Utilisateurs</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.users.index') }}">
                        <span>Voir plus</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $postes_count }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Postes</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.postes.index') }}">
                        <span>Voir plus</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>
    @elseif(auth()->user()->hasPoste('Chef Projet'))
    <div class="row items-push">
        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $reports_count }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Rapports</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.rapports.index') }}">
                        <span>Consulter les rapports</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $presences_count }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Employés en service</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.presences.index') }}">
                        <span>Voir les présences</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $users_count }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Utilisateurs</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.users.index') }}">
                        <span>Voir plus</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $postes_count }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Postes</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.postes.index') }}">
                        <span>Voir plus</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>
    @elseif(auth()->user()->hasPoste('Chef développeur'))
    <div class="row items-push">
        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $reports_count }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Rapports</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.rapports.index') }}">
                        <span>Consulter les rapports</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $presences_count }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Employés en service</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.presences.index') }}">
                        <span>Voir les présences</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $users_count }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Utilisateurs</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.users.index') }}">
                        <span>Voir plus</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $postes_count }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Postes</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.postes.index') }}">
                        <span>Voir plus</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>

    @elseif(auth()->user()->hasPoste('Développeur'))
    <div class="row items-push">

        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $reports_count }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Rapports</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.rapports.index') }}">
                        <span>Consulter les rapports</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $presences_count }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Absences</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="">
                        <span>Non authorisé</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $paiements_waiting }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Paiement en attente</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.paiements.index') }}">
                        <span>Consulter les paiements</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-3">
            <div class="block block-rounded d-flex flex-column h-100 mb-0">
                <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="fs-3 fw-bold">{{ $permissions_count }}</dt>
                        <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Demandes en attente</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                        <i class="far fa-gem fs-3 text-primary"></i>
                    </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" href="{{ route('dashboard.permissions.index') }}">
                        <span>Voir les demandes</span>
                        <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>
    @endif

    @if (auth()->user()->hasRoleorPoste('administrateur'))
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Liste des rendez-vous</h3>
            <div class="block-options space-x-1">
                <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle" data-target="#one-dashboard-search-orders" data-class="d-none">
                    <i class="fa fa-search"></i>
                </button>
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn btn-sm btn-alt-secondary" id="dropdown-recent-orders-filters" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-flask"></i>
                        Filters
                        <i class="fa fa-angle-down ms-1"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-end fs-sm" aria-labelledby="dropdown-recent-orders-filters">
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            Pending
                            <span class="badge bg-primary rounded-pill">20</span>
                        </a>
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            Active
                            <span class="badge bg-primary rounded-pill">72</span>
                        </a>
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            Completed
                            <span class="badge bg-primary rounded-pill">890</span>
                        </a>
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            All
                            <span class="badge bg-primary rounded-pill">997</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="one-dashboard-search-orders" class="block-content border-bottom d-none">
            <form action="be_pages_dashboard.html" method="POST" onsubmit="return false;">
                <div class="push">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-alt" id="one-ecom-orders-search" name="one-ecom-orders-search" placeholder="Search all orders..">
                        <span class="input-group-text bg-body border-0">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="table table-hover table-vcenter">

                    <thead>
                        <tr>
                            <th class="text-center" style="width: 70px;">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" value="" id="check-all" name="check-all">
                                    <label class="form-check-label" for="check-all"></label>
                                </div>
                            </th>
                            <th>VISITEUR</th>
                            <th>Objet</th>
                            <th class="text-center">Date</th>
                            <th>Rendez-vous avec</th>
                            <th class="text-center">Status</th>
                            <th class="d-none d-sm-table-cell text-center" style="width: 30%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rendez_vous as $rdv)
                        <tr>
                            <td class="text-center">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                    <label class="form-check-label" for="row_1"></label>
                                </div>
                            </td>
                            <td class="fs-sm">
                                <p class="fw-semibold mb-1">
                                    <a>{{ \Str::ucfirst(str_replace('\\', '', $rdv->visiteur_name)) }}</a>
                                </p>
                                <p class="text-muted mb-0">
                                    {{ $rdv->visiteur_telephone }}
                                </p>
                            </td>

                            <td class="fs-sm">
                                <p class="fw-semibold mb-1">
                                    <a>
                                        {{ \Str::ucfirst(str_replace('\\', '', $rdv->libelle)) }}
                                    </a>
                                </p>

                                {{-- <p class="text-muted mb-0">
                                                {{ \Str::ucfirst(str_replace('\\', '', $rdv->description)) }}
                                </p> --}}
                            </td>

                            <td class="fs-sm text-center">
                                <p class="fw-semibold mb-1">
                                    <a>{{ \Carbon\Carbon::parse($rdv->date)->format('Y-m-d H:i') ?? '__/__/__' }}</a>
                                </p>
                            </td>

                            <td class="fs-sm">
                                <p class="fw-semibold mb-1">
                                    <a>{{ \Str::ucfirst($rdv->user->civilite ?? '') }}
                                        {{ str_replace('\\', '', $rdv->user->last_name ?? '') }}
                                        {{ str_replace('\\', '', $rdv->user->first_name ?? '') }}</a>
                                </p>{{-- <p class="text-muted mb-0">
                                        {{ str_replace('\\', '', $rdv->user->postes->first()->name ?? '' ) }}
                                </p> --}}
                            </td>
                            <td class="d-none d-sm-table-cell text-center">
                                @if ($rdv->status == 2)
                                <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-warning">
                                    EN ENTENTE
                                </span>
                                @elseif($rdv->status == 1 )
                                <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success">
                                    EFFECTUÉ
                                </span>
                                @elseif($rdv->status == -1 )
                                <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger">
                                    ANNULER
                                </span>
                                @elseif($rdv->status == 3 )
                                <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-warning">
                                    REPORTER
                                </span>
                                @else
                                <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-secondary-light text-secondary">
                                    UNKNOW
                                </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">

                                    @if ($rdv->status != 1)
                                    <form class="mr-1" action="{{ route('dashboard.rendez-vous.valider', $rdv->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" title="Confirmer le rendez-vous" data-bs-original-title="Valider le rendez-vous effectué">
                                            <i class="fa fa-fw fa-check"></i>
                                        </button>
                                    </form>
                                    @endif
                                    @if ($rdv->status == 2 || $rdv->status == 3)
                                    <form class="mr-1" action="{{ route('dashboard.rendez-vous.annuler', $rdv->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" title="Annuler le rendez-vous" data-bs-original-title="Annuler le rendez-vous">
                                            <i class="fa fa-fw fa-times-circle"></i>
                                        </button>
                                    </form>
                                    @endif
                                    <form action="{{ route('dashboard.rendez-vous.destroy', $rdv->id) }}" method="POST">

                                        <a type="button" id="viewRDV" href="{{ route('dashboard.rendez-vous.show', $rdv->id) }}" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" title="" data-bs-original-title="Voir plus">
                                            <i class="fa fa-fw fa-eye"></i>
                                        </a>

                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" title="" data-bs-original-title="Supprimer la demande">
                                            <i class="fa fa-fw fa-times"></i>
                                        </button>
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
    @elseif(auth()->user()->hasPoste('Sécrétariat'))
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Liste des rendez-vous</h3>
            <div class="block-options space-x-1">
                <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle" data-target="#one-dashboard-search-orders" data-class="d-none">
                    <i class="fa fa-search"></i>
                </button>
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn btn-sm btn-alt-secondary" id="dropdown-recent-orders-filters" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-flask"></i>
                        Filters
                        <i class="fa fa-angle-down ms-1"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-end fs-sm" aria-labelledby="dropdown-recent-orders-filters">
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            Pending
                            <span class="badge bg-primary rounded-pill">20</span>
                        </a>
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            Active
                            <span class="badge bg-primary rounded-pill">72</span>
                        </a>
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            Completed
                            <span class="badge bg-primary rounded-pill">890</span>
                        </a>
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            All
                            <span class="badge bg-primary rounded-pill">997</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="one-dashboard-search-orders" class="block-content border-bottom d-none">
            <form action="be_pages_dashboard.html" method="POST" onsubmit="return false;">
                <div class="push">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-alt" id="one-ecom-orders-search" name="one-ecom-orders-search" placeholder="Search all orders..">
                        <span class="input-group-text bg-body border-0">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="js-table-checkable table table-hover table-vcenter js-table-checkable-enabled">
                    <thead>
                        <tr>
                            <th>VISITEUR</th>
                            <th>Objet</th>
                            <th>Date</th>
                            <th>Rendez-vous avec</th>
                            <th class="text-center">Status</th>
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

                            <td class="fs-sm">
                                <p class="fw-semibold mb-1">
                                    <a>
                                        {{ \Str::ucfirst(str_replace('\\', '', $rdv->libelle)) }}
                                    </a>
                                </p>

                                {{-- <p class="text-muted mb-0">
                                                {{ \Str::ucfirst(str_replace('\\', '', $rdv->description)) }}
                                </p> --}}
                            </td>

                            <td class="fs-sm ">
                                <p class="fw-semibold mb-1">
                                    <a>{{ \Carbon\Carbon::parse($rdv->date)->format('Y-m-d H:i') ?? '__/__/__' }}</a>
                                </p>
                            </td>

                            <td class="fs-sm">
                                <p class="fw-semibold mb-1">
                                    <a>{{ \Str::ucfirst($rdv->user->civilite ?? '') }}
                                        {{ str_replace('\\', '', $rdv->user->last_name ?? '') }}
                                        {{ str_replace('\\', '', $rdv->user->first_name ?? '') }}</a>
                                </p>
                            </td>
                            <td class="d-none d-sm-table-cell text-center">
                                @if ($rdv->status == 2)
                                <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-warning">
                                    EN ENTENTE
                                </span>
                                @elseif($rdv->status == 1 )
                                <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success">
                                    EFFECTUÉ
                                </span>
                                @elseif($rdv->status == -1 )
                                <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger">
                                    ANNULER
                                </span>
                                @elseif($rdv->status == 3 )
                                <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-warning">
                                    REPORTER
                                </span>
                                @else
                                <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-secondary-light text-secondary">
                                    UNKNOW
                                </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    @can('confirm-meeting')
                                    @if ($rdv->status != 1 && $rdv->status != -1)
                                    <form class="mr-1" action="{{ route('dashboard.rendez-vous.valider', $rdv->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" title="Confirmer le rendez-vous" data-bs-original-title="Valider le rendez-vous effectué">
                                            <i class="fa fa-fw fa-check"></i>
                                        </button>
                                    </form>
                                    @endif
                                    @endcan

                                    @can('cancel-meeting')
                                    @if ($rdv->status == 2 || $rdv->status == 3)
                                    <form class="mr-1" action="{{ route('dashboard.rendez-vous.annuler', $rdv->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" title="Annuler le rendez-vous" data-bs-original-title="Annuler le rendez-vous">
                                            <i class="fa fa-fw fa-times-circle"></i>
                                        </button>
                                    </form>
                                    @endif
                                    @endcan

                                    <form action="{{ route('dashboard.rendez-vous.destroy', $rdv->id) }}" method="POST">
                                        @if ($rdv->status != 1 && $rdv->status != -1)

                                        <a type="button" id="viewRDV" href="{{ route('dashboard.rendez-vous.show', $rdv->id) }}" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" title="" data-bs-original-title="Voir plus">
                                            <i class="fa fa-fw fa-eye"></i>
                                        </a>

                                        @csrf
                                        @method('DELETE')

                                        @canany(['manage-meeting', 'delete-meeting'])
                                        <button type="submit" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" title="" data-bs-original-title="Supprimer la demande">
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
    @elseif(auth()->user()->hasPoste('RH'))
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Liste des permissions en attente</h3>
            <div class="block-options space-x-1">
                <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle" data-target="#one-dashboard-search-orders" data-class="d-none">
                    <i class="fa fa-search"></i>
                </button>
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn btn-sm btn-alt-secondary" id="dropdown-recent-orders-filters" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-flask"></i>
                        Filters
                        <i class="fa fa-angle-down ms-1"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-end fs-sm" aria-labelledby="dropdown-recent-orders-filters">
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            Pending
                            <span class="badge bg-primary rounded-pill">20</span>
                        </a>
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            Active
                            <span class="badge bg-primary rounded-pill">72</span>
                        </a>
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            Completed
                            <span class="badge bg-primary rounded-pill">890</span>
                        </a>
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            All
                            <span class="badge bg-primary rounded-pill">997</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="one-dashboard-search-orders" class="block-content border-bottom d-none">
            <form action="be_pages_dashboard.html" method="POST" onsubmit="return false;">
                <div class="push">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-alt" id="one-ecom-orders-search" name="one-ecom-orders-search" placeholder="Search all orders..">
                        <span class="input-group-text bg-body border-0">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="js-table-checkable table table-hover table-vcenter js-table-checkable-enabled">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 70px;">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" value="" id="check-all" name="check-all">
                                    <label class="form-check-label" for="check-all"></label>
                                </div>
                            </th>
                            <th>Nom & Prénom</th>
                            <th>Contenu</th>
                            <th class="text-left">Date de début</th>
                            <th class="text-left">Date de fin</th>
                            <th class="text-left">Status</th>
                            <th class="d-none d-sm-table-cell text-right" style="width: 30%;">Action</th>
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
                                    <a>{{ \Str::ucfirst($permission->user->civilite) }}
                                        {{ str_replace('\\', '', $permission->user->last_name) }}
                                        {{ str_replace('\\', '', $permission->user->first_name) }}</a>
                                </p>
                                <p class="text-muted mb-0">
                                    {{ str_replace('\\', '', $permission->user->user_actual_poste->first()->name) }}
                                </p>
                            </td>
                            <td class="fs-sm">
                                <p class="fw-semibold mb-1">
                                    <a>{{ \Str::ucfirst(str_replace('\\', '', $permission->motif)) }}</a>
                                </p>

                                <p class="text-muted mb-0">
                                    {{ $permission->is_conge == true ? 'CONGE' : 'PERMISSION' }}
                                </p>
                            </td>

                            <td class="fs-sm text-left">
                                <p class="fw-semibold mb-1">
                                    <a>{{ $permission->start_at ?? '__/__/__' }}</a>
                                </p>
                            </td>

                            <td class="fs-sm text-left">
                                <p class="fw-semibold mb-1">
                                    <a>{{ $permission->end_at ?? '__/__/__' }}</a>
                                </p>
                            </td>
                            <td class="d-none d-sm-table-cell text-left">
                                @if ($permission->is_accept == 2)
                                <span class=" text-center fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-warning">
                                    En attente
                                </span>
                                @elseif($permission->is_accept == 1 )
                                <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success">
                                    Accordée
                                </span>
                                @elseif($permission->is_accept == -1 )
                                <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger">
                                    Rejetée
                                </span>
                                @else
                                <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-secondary-light text-secondary">
                                    UNKNOW
                                </span>
                                @endif
                            </td>
                            <td class="text-right">
                                <div class="btn-group">
                                    @can('validate-permissions')
                                    @if ($permission->is_accept == 2)
                                    <form class="mr-1" action="{{ route('dashboard.permissions.valider', $permission->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" title="Valider la demande" data-bs-original-title="Valider la demande">
                                            <i class="fa fa-fw fa-thumbs-up"></i>
                                        </button>
                                    </form>
                                    @endif
                                    @if ($permission->is_accept == 2)
                                    <form class="mr-1" action="{{ route('dashboard.permissions.rejeter', $permission->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" title="Rejeter la demande" data-bs-original-title="Rejeter la demande">
                                            <i class="fa fa-fw fa-thumbs-down"></i>
                                        </button>
                                    </form>
                                    @endif
                                    @endif
                                    <form action="{{ route('dashboard.permissions.destroy', $permission->id) }}" method="POST">

                                        <a type="button" id="viewPermission" href="{{ route('dashboard.permissions.show', $permission->id) }}" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" title="" data-bs-original-title="Voir plus">
                                            <i class="fa fa-fw fa-eye"></i>
                                        </a>

                                        @if ($permission->is_accept == 2)

                                        @csrf
                                        @method('DELETE')

                                        @can('delete', $permission)
                                        <button type="submit" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" title="Supprimer la demande" data-bs-original-title="Supprimer la demande">
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

    @elseif(auth()->user()->hasPoste('Comptable'))
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Liste des paiements en attente ou non confirmé</h3>
            <div class="block-options space-x-1">
                <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle" data-target="#one-dashboard-search-orders" data-class="d-none">
                    <i class="fa fa-search"></i>
                </button>
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn btn-sm btn-alt-secondary" id="dropdown-recent-orders-filters" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-flask"></i>
                        Filters
                        <i class="fa fa-angle-down ms-1"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-end fs-sm" aria-labelledby="dropdown-recent-orders-filters">
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            Pending
                            <span class="badge bg-primary rounded-pill">20</span>
                        </a>
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            Active
                            <span class="badge bg-primary rounded-pill">72</span>
                        </a>
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            Completed
                            <span class="badge bg-primary rounded-pill">890</span>
                        </a>
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            All
                            <span class="badge bg-primary rounded-pill">997</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="one-dashboard-search-orders" class="block-content border-bottom d-none">
            <form action="be_pages_dashboard.html" method="POST" onsubmit="return false;">
                <div class="push">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-alt" id="one-ecom-orders-search" name="one-ecom-orders-search" placeholder="Search all orders..">
                        <span class="input-group-text bg-body border-0">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="js-table-checkable table table-hover table-vcenter js-table-checkable-enabled">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 70px;">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" value="" id="check-all" name="check-all">
                                    <label class="form-check-label" for="check-all"></label>
                                </div>
                            </th>
                            <th>Nom & Prénom</th>
                            <th class="">Montant</th>
                            <th class="">Du mois de</th>
                            <th class="         ">Status</th>
                            <th class="d-none
                                        d-sm-table-cell text-center" style="width: 30%;">Action</th>
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
                                        {{ str_replace('\\', '', optional($paiement->poste_user->user)->last_name) }}
                                        {{ str_replace('\\', '', optional($paiement->poste_user->user)->first_name) }}</a>
                                </p>
                                <p class="text-muted mb-0">
                                    {{ str_replace('\\', '', optional(optional(optional($paiement->poste_user->user)->user_actual_poste)->first())->name) }}
                                </p>
                            </td>

                            <td class="fs-sm">
                                <p class="fw-semibold mb-1">
                                    <a>{{ $paiement->salaire }}</a>
                                </p>
                            </td>

                            <td class="fs-sm">
                                <p class="fw-semibold mb-1">
                                    @php
                                    $date = \Carbon\Carbon::parse($paiement->date)->locale('fr');
                                    @endphp
                                    <a>{{ Str::ucfirst( \Carbon\Carbon::parse($paiement->date)->locale('fr')->isoFormat('MMMM, Y'),) }}</a>
                                </p>
                                @if ($paiement->is_pay == 1)
                                <p class="text-muted mb-0">
                                    Payer le
                                    {{ \Carbon\Carbon::parse($paiement->date)->format('d-m-Y') }}
                                </p>
                                @endif

                            </td>
                            <td class="d-none d-sm-table-cell">
                                @if ($paiement->is_pay == 0 || $paiement->is_pay == 2)
                                <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-warning">
                                    EN ENTENTE
                                </span>
                                @elseif($paiement->is_pay == 1 )
                                <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success">
                                    CONFIRMER
                                </span>
                                @else
                                <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger">
                                    NON-CONFIRMER
                                </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    @if ($paiement->is_pay != -1 && $paiement->is_pay != 1)
                                    @can('validate-paiement', $paiement)
                                    <form action="{{ route('dashboard.paiements.valider', $paiement->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-alt-success bg-success-light mr-1 js-bs-tooltip-enabled" data-bs-toggle="tooltip" title="Veuillez confirmer que vous avez recu la paie du mois" data-bs-original-title="Sortie de service">
                                            <i class="fa fa-fw fa-check text-success"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('dashboard.paiements.rejeter', $paiement->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn mr-1 btn-sm btn-alt-warning js-bs-tooltip-enabled" data-bs-toggle="tooltip" title="Notifier que vous n'avez pas reçu la paie du mois" data-bs-original-title="Rejeter">
                                            <i class="fa fa-fw fa-exclamation-triangle text-warning"></i>
                                        </button>
                                    </form>
                                    @endcan
                                    @canany(['manage-payments'])
                                    <form action="{{ route('dashboard.paiements.destroy', $paiement->id) }}" method="POST">

                                        @if($paiement->is_pay == 1)
                                        <a type="button" id="" href="{{ route('dashboard.paiements.show', $paiement->id) }}" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" title="" data-bs-original-title="Consulter le paiement">
                                            <i class="fa fa-fw fa-eye"></i>
                                        </a>
                                        @endif

                                        @csrf
                                        @method('DELETE')
                                        @canany(['manage-payments', 'delete-payments'])
                                        <button type="submit" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" title="Supprimer la paie" data-bs-original-title="Remove la paie">
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
    </div>
    @elseif(auth()->user()->hasPoste('Chef Projet'))
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Liste des rapports</h3>
            <div class="block-options space-x-1">
                <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle" data-target="#one-dashboard-search-orders" data-class="d-none">
                    <i class="fa fa-search"></i>
                </button>
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn btn-sm btn-alt-secondary" id="dropdown-recent-orders-filters" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-flask"></i>
                        Filters
                        <i class="fa fa-angle-down ms-1"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-end fs-sm" aria-labelledby="dropdown-recent-orders-filters">
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            Pending
                            <span class="badge bg-primary rounded-pill">20</span>
                        </a>
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            Active
                            <span class="badge bg-primary rounded-pill">72</span>
                        </a>
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            Completed
                            <span class="badge bg-primary rounded-pill">890</span>
                        </a>
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            All
                            <span class="badge bg-primary rounded-pill">997</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="one-dashboard-search-orders" class="block-content border-bottom d-none">
            <form action="be_pages_dashboard.html" method="POST" onsubmit="return false;">
                <div class="push">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-alt" id="one-ecom-orders-search" name="one-ecom-orders-search" placeholder="Search all orders..">
                        <span class="input-group-text bg-body border-0">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="js-table-checkable table table-hover table-vcenter js-table-checkable-enabled">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 70px;">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" value="" id="check-all" name="check-all">
                                    <label class="form-check-label" for="check-all"></label>
                                </div>
                            </th>
                            <th class="text-center" style="width: 100px;">
                                <i class="far fa-user"></i>
                            </th>
                            <th>Nom & Prénom</th>
                            <th>Contenu</th>
                            <th class="text-center">Rapport du</th>
                            <th class="d-none d-sm-table-cell text-center" style="width:30%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                        <tr>
                            <td class="text-center">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                    <label class="form-check-label" for="row_1"></label>
                                </div>
                            </td>
                            <td class="text-center">
                                <img class="img-avatar img-avatar48" src="{{ asset('assets/media/avatars/avatar10.jpg') }}" alt="">
                            </td>
                            <td class="fs-sm">
                                <p class="fw-semibold mb-1">
                                    <a>{{ \Str::ucfirst($report->user->civilite) }}
                                        {{ str_replace('\\', '', $report->user->last_name) }}
                                        {{ str_replace('\\', '', $report->user->first_name) }}</a>
                                </p>
                                <p class="text-muted mb-0">
                                    {{ \Str::ucfirst(str_replace('\\', '', $report->user->postes->first()->name)) }}
                                </p>
                            </td>
                            <td class="fs-sm">
                                <p class="fw-semibold mb-1">
                                    <a>{{ \Str::ucfirst(str_replace('\\', '', $report->libelle)) }}</a>
                                </p>
                            </td>

                            <td class="fs-sm text-center">
                                <p class="fw-semibold mb-1">
                                    <a>{{ $report->date ?? '__/__/__' }}</a>
                                </p>
                            </td>

                            <td class="text-center">
                                <div class="btn-group">
                                    <form action="{{ route('dashboard.rapports.destroy', $report->id) }}" method="POST">
                                        @can('view', $report)
                                        <a type="button" id="viewRapport" href="{{ route('dashboard.rapports.show', $report->id) }}" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" title="" data-bs-original-title="Consulter le rapport">
                                            <i class="fa fa-fw fa-eye"></i>
                                        </a>
                                        @endcan

                                        @csrf
                                        @method('DELETE')
                                        @can('delete-rapport', $report)
                                        <button type="submit" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" title="" data-bs-original-title="Supprimer le rapport">
                                            <i class="fa fa-fw fa-times"></i>
                                        </button>
                                        @endcan
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

    @elseif(auth()->user()->hasPoste('Chef développeur'))
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Liste des rapports</h3>
            <div class="block-options space-x-1">
                <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle" data-target="#one-dashboard-search-orders" data-class="d-none">
                    <i class="fa fa-search"></i>
                </button>
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn btn-sm btn-alt-secondary" id="dropdown-recent-orders-filters" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-flask"></i>
                        Filters
                        <i class="fa fa-angle-down ms-1"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-end fs-sm" aria-labelledby="dropdown-recent-orders-filters">
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            Pending
                            <span class="badge bg-primary rounded-pill">20</span>
                        </a>
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            Active
                            <span class="badge bg-primary rounded-pill">72</span>
                        </a>
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            Completed
                            <span class="badge bg-primary rounded-pill">890</span>
                        </a>
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            All
                            <span class="badge bg-primary rounded-pill">997</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="one-dashboard-search-orders" class="block-content border-bottom d-none">
            <form action="be_pages_dashboard.html" method="POST" onsubmit="return false;">
                <div class="push">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-alt" id="one-ecom-orders-search" name="one-ecom-orders-search" placeholder="Search all orders..">
                        <span class="input-group-text bg-body border-0">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="js-table-checkable table table-hover table-vcenter js-table-checkable-enabled">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 70px;">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" value="" id="check-all" name="check-all">
                                    <label class="form-check-label" for="check-all"></label>
                                </div>
                            </th>
                            <th class="text-center" style="width: 100px;">
                                <i class="far fa-user"></i>
                            </th>
                            <th>Nom & Prénom</th>
                            <th>Contenu</th>
                            <th class="text-center">Rapport du</th>
                            <th class="d-none d-sm-table-cell text-center" style="width: 30%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                        <tr>
                            <td class="text-center">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                    <label class="form-check-label" for="row_1"></label>
                                </div>
                            </td>
                            <td class="text-center">
                                <img class="img-avatar img-avatar48" src="{{ asset('assets/media/avatars/avatar10.jpg') }}" alt="">
                            </td>
                            <td class="fs-sm">
                                <p class="fw-semibold mb-1">
                                    <a>{{ \Str::ucfirst($report->user->civilite) }}
                                        {{ str_replace('\\', '', $report->user->last_name) }}
                                        {{ str_replace('\\', '', $report->user->first_name) }}</a>
                                </p>
                                <p class="text-muted mb-0">
                                    {{ \Str::ucfirst(str_replace('\\', '', $report->user->postes->first()->name)) }}
                                </p>
                            </td>
                            <td class="fs-sm">
                                <p class="fw-semibold mb-1">
                                    <a>{{ \Str::ucfirst(str_replace('\\', '', $report->libelle)) }}</a>
                                </p>
                            </td>

                            <td class="fs-sm text-center">
                                <p class="fw-semibold mb-1">
                                    <a>{{ $report->date ?? '__/__/__' }}</a>
                                </p>
                            </td>

                            <td class="text-center">
                                <div class="btn-group">
                                    <form action="{{ route('dashboard.rapports.destroy', $report->id) }}" method="POST">

                                        @can('view', $report)
                                        <a type="button" id="viewRapport" href="{{ route('dashboard.rapports.show', $report->id) }}" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" title="" data-bs-original-title="Consulter le rapport">
                                            <i class="fa fa-fw fa-eye"></i>
                                        </a>
                                        @endcan


                                        @csrf
                                        @method('DELETE')
                                        @can('delete-rapport', $report)
                                        <button type="submit" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" title="" data-bs-original-title="Supprimer le rapport">
                                            <i class="fa fa-fw fa-times"></i>
                                        </button>
                                        @endcan
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
    @elseif(auth()->user()->hasPoste('Développeur'))
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Liste des rapports</h3>
            <div class="block-options space-x-1">
                <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle" data-target="#one-dashboard-search-orders" data-class="d-none">
                    <i class="fa fa-search"></i>
                </button>
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn btn-sm btn-alt-secondary" id="dropdown-recent-orders-filters" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-flask"></i>
                        Filters
                        <i class="fa fa-angle-down ms-1"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-end fs-sm" aria-labelledby="dropdown-recent-orders-filters">
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            Pending
                            <span class="badge bg-primary rounded-pill">20</span>
                        </a>
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            Active
                            <span class="badge bg-primary rounded-pill">72</span>
                        </a>
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            Completed
                            <span class="badge bg-primary rounded-pill">890</span>
                        </a>
                        <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            All
                            <span class="badge bg-primary rounded-pill">997</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="one-dashboard-search-orders" class="block-content border-bottom d-none">
            <form action="be_pages_dashboard.html" method="POST" onsubmit="return false;">
                <div class="push">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-alt" id="one-ecom-orders-search" name="one-ecom-orders-search" placeholder="Search all orders..">
                        <span class="input-group-text bg-body border-0">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="js-table-checkable table table-hover table-vcenter js-table-checkable-enabled">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 70px;">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" value="" id="check-all" name="check-all">
                                    <label class="form-check-label" for="check-all"></label>
                                </div>
                            </th>
                            <th class="text-center" style="width: 100px;">
                                <i class="far fa-user"></i>
                            </th>
                            <th>Nom & Prénom</th>
                            <th>Contenu</th>
                            <th class="text-center">Rapport du</th>
                            <th class="d-none d-sm-table-cell text-center" style="width: 30%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                        <tr>
                            <td class="text-center">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" value="" id="row_1" name="row_1">
                                    <label class="form-check-label" for="row_1"></label>
                                </div>
                            </td>
                            <td class="text-center">
                                <img class="img-avatar img-avatar48" src="{{ asset('assets/media/avatars/avatar10.jpg') }}" alt="">
                            </td>
                            <td class="fs-sm">
                                <p class="fw-semibold mb-1">
                                    <a>{{ \Str::ucfirst($report->user->civilite) }}
                                        {{ str_replace('\\', '', $report->user->last_name) }}
                                        {{ str_replace('\\', '', $report->user->first_name) }}</a>
                                </p>
                                <p class="text-muted mb-0">
                                    {{ \Str::ucfirst(str_replace('\\', '', $report->user->postes->first()->name)) }}
                                </p>
                            </td>
                            <td class="fs-sm">
                                <p class="fw-semibold mb-1">
                                    <a>{{ \Str::ucfirst(str_replace('\\', '', $report->libelle)) }}</a>
                                </p>
                            </td>

                            <td class="fs-sm text-center">
                                <p class="fw-semibold mb-1">
                                    <a>{{ $report->date ?? '__/__/__' }}</a>
                                </p>
                            </td>

                            <td class="text-center">
                                <div class="btn-group">
                                    <form action="{{ route('dashboard.rapports.destroy', $report->id) }}" method="POST">

                                        @can('view', $report)
                                        <a type="button" id="viewRapport" href="{{ route('dashboard.rapports.show', $report->id) }}" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" title="" data-bs-original-title="Consulter le rapport">
                                            <i class="fa fa-fw fa-eye"></i>
                                        </a>
                                        @endcan

                                        @csrf
                                        @method('DELETE')
                                        @can('delete-rapport', $report)
                                        <button type="submit" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip" title="" data-bs-original-title="Supprimer le rapport">
                                            <i class="fa fa-fw fa-times"></i>
                                        </button>
                                        @endcan
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
    @else

    @endif


</div>
@endsection

@push('js')

<script>
    document.getElementById('markPresences').style.display = "block";
    document.getElementById('auth_user').style.display = "block";

</script>

@endpush
