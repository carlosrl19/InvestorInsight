@extends('layout.admin')

@section('head')
<!-- Datatable CSS -->
<link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/datatables/css/buttons.dataTables.min.css') }}" rel="stylesheet">
@endsection

@section('pretitle')
Proveedores
@endsection

@section('create')
<button class="btn" onclick="goBack()" style="background-color: transparent; margin-right: 5px">
    &nbsp;<img src="{{ asset('../static/svg/arrow-back-up.svg') }}" width="20" height="20">&nbsp;
    Volver
</button>
@endsection

@section('title')
Historial de proveedor /&nbsp;
<b class="text-muted">{{ $provider->provider_name }}</b>

@endsection

@section('content')
    <div class="container-xl">
        <!-- General information about proveedor -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body d-flex align-items center">
                        <div class="col-auto me-4">
                            <img src="{{ asset('../static/svg/user-scan.svg') }}" width="90" height="90" alt="provider-image">
                        </div>
                        <div class="col">
                            <div class="accordion" id="accordion-example">
                                <div class="row align-items-end">
                                    <div class="col">
                                        <div class="accordion-item" style="border: none">
                                            <h2 class="accordion-header" id="heading-1">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true">
                                                <h4 class="card-title">Información general</h4>
                                            </button>
                                            </h2>
                                            <div id="collapse-1" class="col accordion-collapse collapse show" data-bs-parent="#accordion-example">
                                                <div class="accordion-body pt-0">
                                                    <strong>{{ $provider->provider_name }}</strong> es un proveedor con número de identidad <strong>{{ $provider->provider_dni }}</strong>, número de teléfono <strong>{{ $provider->provider_phone }}</strong>. 
                                                    Tiene un fondo monetario de Lps. <strong>{{ number_format($provider->provider_balance,2) }}</strong>. Fue ingresado al sistema en la fecha <strong>{{ $provider->created_at }}</strong>.
                                                    <br> Una breve descripción de este proveedor es: "{{ $provider->provider_description }}"
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

        <!-- Funds changes table -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="card" style="min-height: auto; max-height: 20rem">
                    <div class="card-header">
                        <h4 class="card-title">Historial de pagos</h4>
                    </div>
                    <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                        <div class="divide-y">
                            <div>
                                <div class="row">
                                    <table class="display table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>FECHA CAMBIO</th>
                                                <th>FONDO ANTERIOR</th>
                                                <th>DEPOSITO / CAMBIO EN FONDOS</th>
                                                <th>MOTIVO / COMENTARIO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($providerFunds as $provider_fund)
                                                <tr>
                                                    <td>{{ $provider_fund->provider_change_date }}</td>
                                                    <td>{{ $provider_fund->provider_old_funds }}</td>
                                                    <td>{{ $provider_fund->provider_new_funds }}</td>
                                                    <td>{{ $provider_fund->provider_new_funds_comment }}</td>
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
<script src="{{ asset('customjs/datatable/dt_history.js')}}"></script>
@endsection