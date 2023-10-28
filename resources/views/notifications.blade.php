@extends('layouts.dashboard')

{{-- SETTINGS PAGE SPECIFICATION --}}
@section('title')
    NOTIFICATIONS
@endsection

@section('subtitle')
    ROLES DU SYSTEME
@endsection

@section('dash')

    <div class="block-content">

        @if ($message = Session::get('success'))
            <div class="alert alert-success mb-4">
                <p>{{ $message }}</p>
            </div>
        @endif

        @if ($message = Session::get('erreurs'))
            <div class="alert alert-danger  mb-4">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <li>{{ $message }}</li>
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
                <h3 class="block-title">Liste des notifications</h3>
            </div>
            <div class="block-content">
                <table class="table table-borderless table-striped table-vcenter fs-sm">
                    <tbody>
                        @foreach ($notifications as $notification)

                            @if ($notification->type == 'App\\Notifications\\NewPermissionNotification')
                            <tr>
                                <td class="fs-base">
                                    <span class="badge bg-warning">Permission</span>
                                </td>
                                <td>
                                    <span class="fw-semibold"> {{ \Carbon\Carbon::parse($notification->created_at)->isoFormat('MMMM d, Y - h:m') }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('home') .'/permissions/'. $notification->data['permission_id'].'?read='.$notification->id}}">{{ $notification->data['user_name'] }}</a>
                                </td>
                                <td class="text-warning">Nouvelle demande de permission</td>
                            </tr>
                        @elseif($notification->type == 'App\\Notifications\\ValidatePermissionNotification')
                        <tr>
                            <td class="fs-base">
                                <span class="badge {{ $notification->data['status'] ? 'bg-success' : 'bg-danger' }}">Permission</span>
                            </td>
                            <td>
                                <span class="fw-semibold"> {{ \Carbon\Carbon::parse($notification->created_at)->isoFormat('MMMM d, Y - h:m') }}</span>
                            </td>
                            <td>
                                <a href="{{ route('home') .'/permissions/'. $notification->data['permission_id'].'?read='.$notification->id}}">Confirmation</a>
                            </td>
                            <td class="{{ $notification->data['status'] ? 'text-success' : 'text-danger' }}">{{ $notification->data['status'] ? 'Votre demande de permission est accepté par' : 'Votre demande de permission est rejeté par' }} {{ $notification->data['user_name'] }}</td>
                        </tr>
                        @elseif($notification->type == 'App\\Notifications\\MonthlyPayNotification')
                        <tr>
                            <td class="fs-base">
                                <span class="badge bg-warning">Paiement mensuel</span>
                            </td>
                            <td>
                                <span class="fw-semibold"> {{ \Carbon\Carbon::parse($notification->created_at)->isoFormat('MMMM d, Y - h:m') }}</span>
                            </td>
                            <td>
                                <a href="{{ route('home') .'/paiements/'. $notification->data['paiement_id'].'?read='.$notification->id}}">{{ $notification->data['user_name'] }}</a>
                            </td>
                            <td class="text-warning">Veuillez confirmer que vous avez recu votre paie</td>
                        </tr>
                        @elseif($notification->type == 'App\\Notifications\\ConfirmPayNotification')
                        <tr>
                            <td class="fs-base">
                                <span class="badge {{ $notification->data['status'] ? 'bg-success' : 'bg-danger' }}">Paiement</span>
                            </td>
                            <td>
                                <span class="fw-semibold"> {{ \Carbon\Carbon::parse($notification->created_at)->isoFormat('MMMM d, Y - h:m') }}</span>
                            </td>
                            <td>
                                <a href="{{ route('home') .'/paiements/'. $notification->data['paiement_id'].'?read='.$notification->id}}">Confirmation</a>
                            </td>
                            <td class="{{ $notification->data['status'] ? 'text-success' : 'text-danger' }}">{{ $notification->data['status'] ? 'Paiement confirmé' : 'Paiement non confirmé' }} par {{ $notification->data['user_name'] }}</td>
                        </tr>
                        @elseif($notification->type == 'App\\Notifications\\DailyReportNotification')
                        <tr>
                            <td class="fs-base">
                                <span class="badge bg-success">Rapport</span>
                            </td>
                            <td>
                                <span class="fw-semibold"> {{ \Carbon\Carbon::parse($notification->created_at)->isoFormat('MMMM d, Y - h:m') }}</span>
                            </td>
                            <td>
                                <a href="{{ route('home') .'/rapports/'. $notification->data['rapport_id'].'?read='.$notification->id}}">Rappel</a>
                            </td>
                            <td class="text-success">{{ $notification->data->message }}</td>
                        </tr>
                        @elseif($notification->type == 'App\\Notifications\\NewReportNotification')
                        <tr>
                            <td class="fs-base">
                                <span class="badge bg-success">Rapport</span>
                            </td>
                            <td>
                                <span class="fw-semibold"> {{ \Carbon\Carbon::parse($notification->created_at)->isoFormat('MMMM d, Y - h:m') }}</span>
                            </td>
                            <td>
                                <a href="{{ route('home') .'/rapports/'. $notification->data['rapport_id'].'?read='.$notification->id}}">{{ $notification->data['user_name'] }}</a>
                            </td>
                            <td class="text-success">Nouveau rapport soumis</td>
                        </tr>

                        @elseif($notification->type == 'App\\Notifications\\NewMessageNotification')
                        <tr>
                            <td class="fs-base">
                                <span class="badge bg-success">Nouveau message</span>
                            </td>
                            <td>
                                <span class="fw-semibold"> {{ \Carbon\Carbon::parse($notification->created_at)->isoFormat('MMMM d, Y - h:m') }}</span>
                            </td>
                            <td>
                                <a href="{{ route('home') .'/conversations/'. $notification->data['message_id'].'?read='.$notification->id}}">{{ $notification->data['user_name'] }}</a>
                            </td>
                            <td class="text-success">Vous avez recu un nouveau message</td>
                        </tr>
                        @endif
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
            document.getElementById("bar").style.display = "none";

        });
    </script>
@endpush
