@extends('layout.admin')

@section('head')
<!-- Datatable CSS -->
<link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/datatables/css/buttons.dataTables.min.css') }}" rel="stylesheet">
@endsection

@section('pretitle')
Inversionistas <small>({{ number_format($loadTime, 2) }} segundos)</small>
@endsection

@section('create')
<button class="btn" onclick="goBack()" style="background-color: transparent; margin-right: 5px">
    &nbsp;<img src="{{ asset('../static/svg/arrow-back-up.svg') }}" width="20" height="20">&nbsp;
    Volver
</button>
@endsection

@section('title')
Historial de prestamista /&nbsp;
<b class="text-muted">{{ $moneylender->moneylender_name }}&nbsp;</b>
@endsection

@section('content')
    <div class="container-xl">
        <!-- General information about moneylender -->
        <div class="row mb-2">
            <div class="col-12">
                <div class="card mb-2">
                    <div class="card-body d-flex align-items-center">
                        <div class="col-auto me-4" style="border: 4px solid #000; border-radius: 10px">
                            <img src="{{ asset('../static/svg/user-dollar.svg') }}" width="90" height="90" alt="">
                        </div>
                        <div class="col">
                            <div class="accordion" id="accordion-example">
                                <div class="accordion-item" style="border: none;">
                                    <h2 class="accordion-header" id="heading-1">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true">
                                            <h4>Información general del inversionista</h4>
                                        </button>
                                    </h2>
                                    <div id="collapse-1" class="accordion-collapse collapse show" data-bs-parent="#accordion-example">
                                        <div class="accordion-body pt-0">
                                            <strong>{{ $moneylender->moneylender_name }}</strong> es un prestamista con número de identidad <strong>{{ $moneylender->moneylender_dni }}</strong>, número de teléfono <strong>{{ $moneylender->moneylender_phone }}</strong>.
                                            y afiliado a la empresa <strong>{{ $moneylender->moneylender_company_name}}</strong>. Fue ingresado al sistema en la fecha <strong>{{ $moneylender->created_at }}</strong>.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loans table -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="card" style="min-height: auto; max-height: 20rem">
                    <div class="card-header">
                        <h3 class="card-title">Historial de préstamos</h3>
                    </div>
                    <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                        <div class="divide-y">
                            <div>
                                <div class="row">
                                    <table id="loans" class="display table table-bordered">
                                        <thead>
                                            <tr style="text-align: center">
                                                <th>FECHA EMISION</th>
                                                <th>MONTO</th>
                                                <th>INTERES</th>
                                                <th>MONTO TOTAL</th>
                                                <th>PRESTATARIO</th>
                                                <th>MOTIVO / COMENTARIO</th>
                                                <th>EXPORTAR</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach ($moneylender_loans as $loan)
                                               <tr style="text-align: center">
                                                    <td>{{ $loan->loan_emission_date }}</td>
                                                    <td>Lps. {{ number_format($loan->loan_amount,2) }}</td>
                                                    <td>{{ $loan->loan_tax }}%</td>
                                                    <td>Lps. {{ $loan->loan_total_amount }}</td>
                                                    <td>{{ $loan->commissioner->commissioner_name }}</td>
                                                    <td>{{ $loan->loan_description }}</td>
                                                    <td></td>
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
@endsection

@section('scripts')
<!-- Redirect button -->
<script src="{{ asset('customjs/return_redirect.js')}}"></script>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('customjs/datatable/dt_loans.js')}}"></script>

@endsection