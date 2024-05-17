@extends('layout.admin')

@section('head')
<!-- Datatable CSS -->
<link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/datatables/css/buttons.dataTables.min.css') }}" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/history.css') }}">
@endsection

@section('pretitle')
Inversionistas
@endsection

@section('create')
<button class="btn" onclick="goBack()" style="background-color: transparent; margin-right: 5px">
    &nbsp;<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-back-up"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 14l-4 -4l4 -4" /><path d="M5 10h11a4 4 0 1 1 0 8h-1" /></svg>
    Volver
</button>
@endsection

@section('title')
Historial de inversionista /&nbsp;<b class="text-muted">{{ $investor->investor_name }}</b>
@endsection

@section('content')
<div class="container-xl">
    <div class="card mb-2">
        <div class="card-body">
            <div class="accordion" id="accordion-example">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-1">
                    <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true">
                        <h4>Información general del inversionista</h4>
                    </button>
                    </h2>
                    <div id="collapse-1" class="accordion-collapse collapse show" data-bs-parent="#accordion-example">
                        <div class="accordion-body pt-0">
                            <strong>{{ $investor->investor_name }}</strong> es un inversionista con número de identidad <strong>{{ $investor->investor_dni }}</strong>, número de teléfono <strong>{{ $investor->investor_phone }}</strong>.
                            Recomendado por
                            <strong>
                                @if($referenceInvestor)
                                <a href="{{ route('investor.show', ['investor' => $referenceInvestor->id]) }}">
                                    <strong>{{ $referenceInvestor->investor_name }}</strong>
                                </a>
                                @else
                                    <strong class="text-red">Sin recomendación</strong>
                                @endif
                            </strong>, tiene un saldo actual de Lps. <strong>{{ number_format($investor->investor_balance,2) }}</strong>. Fue ingresado al sistema en la fecha <strong>{{ $investor->created_at }}</strong>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div id="item-0">
                <div class="col-lg-12">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="card" style="height: 21rem">
                                <div class="card-header">
                                    <h3 class="card-title">Historial de transferencias</h3>
                                </div>
                                <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                                    <div class="divide-y">
                                        <div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="text-truncate">
                                                        <table id="example1" class="display table table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th>Fecha</th>
                                                                <th>Banco</th>
                                                                <th>Monto transferencia</th>
                                                                <th>Saldo actual</th>
                                                                <th>Nuevo saldo</th>
                                                                <th>Comentarios</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($transfers as $transfer)
                                                                <tr>
                                                                    <td>{{ $transfer->transfer_date }}</td>
                                                                    <td class="text-uppercase">{{ $transfer->transfer_bank }}</td>
                                                                    <td class="text-green">Lps. {{ number_format($transfer->transfer_amount, 2) }}</td>
                                                                    <td>Lps. {{ number_format($transfer->current_balance - $transfer->transfer_amount, 2) }}</td>
                                                                    <td>Lps. {{ number_format($transfer->current_balance, 2) }}</td>
                                                                    <td title="Comentario: {{ $transfer->transfer_description }}" data-bs-toggle="tooltip" data-bs-placement="right" class="text-muted" style="max-width: 20px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><i>Ver comentarios ...</i></td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- Card body close -->
    </div>
    
    <div class="card">
        <div class="card-body">
            <div id="item-1">
                <div class="col-lg-12">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="card" style="height: 21rem">
                                <div class="card-header">
                                    <h3 class="card-title">Historial de notas crédito</h3>
                                </div>
                                <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                                <div class="divide-y">
                                    <div>
                                        <div class="row">
                                        <div class="col">
                                            <div class="text-truncate">
                                                <table id="example2" class="display table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Monto nota crédito</th>
                                                        <th>Saldo actual</th>
                                                        <th>Nuevo saldo</th>
                                                        <th>Comentarios</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($creditNotes as $creditNote)
                                                    <tr>
                                                        <td>{{ $creditNote->creditNote_date }}</td>
                                                        <td class="text-red">Lps. {{ number_format($creditNote->creditNote_amount, 2) }}</td>
                                                        <td>Lps. {{ number_format($creditNote->current_balance + $creditNote->creditNote_amount, 2) }}</td>
                                                        <td>Lps. {{ number_format($creditNote->current_balance, 2) }}</td>
                                                        <td title="Comentario: {{ $creditNote->creditNote_description }}" data-bs-toggle="tooltip" data-bs-placement="right" class="text-muted" style="max-width: 20px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><i>Ver comentarios ...</i></td>
                                                    </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Redirect button -->
<script src="{{ asset('customjs/return_redirect.js')}}"></script>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('customjs/datatable/dt_history.js')}}"></script>
@endsection