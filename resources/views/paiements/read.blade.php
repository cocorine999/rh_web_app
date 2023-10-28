@extends('layouts.dashboard')

@push('css')
<style type="text/css"></style>
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/oneui.min-5.1.css') }}">
@endpush

@section('dash')
<div class="content">

<div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title"></h3>
      <div id="facture-btn">
          <button type="button" class="btn btn-sm ml-2 btn-primary" onclick="event.preventDefault(); printView(); " {{-- href="{{ route('export.pdf') }}" --}}>
              <i class="fa fa-print fa-w-16"></i>
          </button>
      </div>
    </div>
    <div id="facture" class="block-content">
      <div class="table-responsive">
        <table id="tableID" class="table table-borderless table-striped table-vcenter fs-sm">

            <tr>

              </tr>
              <tr>
                <td colspan="3" class="text-start">
                    <img src="{{ asset(optional(optional($setting)->logo)->url ?? 'assets/logo/logo.png') }}" alt="CFA Empire" style="width: 100%; max-width: 100px">
                    <br><br>

                    {{ optional($setting)->enterprise_name }}, Inc.<br>
                    {{ optional($setting)->enterprise_adress }}<br>

                </td>
                <td colspan="2" class="text-end">
                    <br>
                    Invoice #: <strong>tran.{{ $paiement->id }}</strong><br>
                    Created: {{ Str::ucfirst(\Carbon\Carbon::parse($paiement->created_at)->locale('fr')->isoFormat('MMMM d, Y')) }}<br>
                    Due: {{ Str::ucfirst(\Carbon\Carbon::parse($paiement->date)->locale('fr')->isoFormat('MMMM d, Y')) }}
                </td>
              </tr>

              <tr></tr>



              <tr>

                <td colspan="1"class="text-end" >

                    <strong>Employé : </strong>
                    <br><br><br>
                </td>
                <td colspan="2" class="text-start">
                    <a href="{{ route('dashboard.users.show',optional($paiement->poste_user->user)->id) }}">{{ \Str::ucfirst(optional($paiement->poste_user->user)->civilite) }}
                        {{ str_replace('\\','',optional($paiement->poste_user->user)->last_name) }} {{ str_replace('\\','',optional($paiement->poste_user->user)->first_name) }}</a>

                        <p class="text-muted mb-0">
                            {{ str_replace('\\','',$paiement->poste_user->poste->name) }}
                        </p>
                        {{ optional($paiement->poste_user->user)->email }}
                </td>
              </tr>

            <tr>
              <th>Libelle</th>
              <th class="text-center">Salaire mensuel</th>
              <th class="text-center">Période</th>
              <th class="text-start" style="width: 10%;">Status</th>
              <th class="text-end" style="width: 10%;">Montant</th>
            </tr>

            <br>

          <tbody>

            <tr></tr>
            <tr>
              <td> Paiement de salaire </td>
              <td class="text-center">{{ $paiement->salaire }}</td>
              <td class="text-center"><strong>
            <a>{{ Str::ucfirst(\Carbon\Carbon::parse($paiement->date)->locale('fr')->isoFormat('MMMM, Y')) }}</a></strong></td>
            <td>
                <span class="badge {{ $paiement->is_pay == -1 ? 'bg-danger' : '' }} {{ $paiement->is_pay == 1 ? 'bg-success' : 'bg-warning'   }} ">{{ $paiement->is_pay == -1 ? 'Non régler' : '' }} {{ $paiement->is_pay == 1 ? 'Régler' : 'En attente' }}</span>
            </td>
              <td class="text-end">{{ $paiement->salaire }}</td>
            </tr>

            <tr>
              <td colspan="4" class="text-end"><strong>Total payer:</strong></td>
              <td class="text-end">{{ $paiement->salaire }} xof</td>
            </tr>


            <tr>
              <td colspan="4" class="text-end text-uppercase"><strong>Reste à payer:</strong></td>
              <td class="text-end"><strong>0.0  xof</strong></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>@endsection

{{-- JAVASCRIPT INCLUDE SECTION --}}
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            document.getElementById("bar").style.display = "none";
        });
    </script>
    <script>
        function printView() {
            //console.log(window);
            //window.print();
            console.log('cool');
            var css = '@page { size: landscape; }',

            head = document.head || document.getElementsByTagName('head')[0],

            style = document.createElement('style');

            style.type = 'text/css';

            style.media = 'print';

            if (style.styleSheet){
                style.styleSheet.cssText = css;
            } else {
                style.appendChild(document.createTextNode(css));
            }

            head.appendChild(style);

            console.log(head);

            document.getElementById("facture-btn").style.display= 'none';

            window.print();

            document.getElementById("facture-btn").style.display= 'block';

            //var contentStyle = '<style type="text/css">body{background-color:white !important;} </style>';

            //style.styleSheet.cssText = '#facture-btn { display : none;}';
        }
    </script>
@endpush



@push('custom-js')
    {{-- <script src="{{ asset('assets/js/oneui.app.min-5.1.js') }}"></script>
<script src="{{ asset('assets/js/be_pages_dashboard.min.js') }}"></script> --}}
@endpush
