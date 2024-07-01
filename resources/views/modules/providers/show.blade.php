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
                    <div class="card-body d-flex align-items-center">
                        <div class="col-auto me-4">
                            <img src="{{ asset('../static/svg/user-scan.svg') }}" width="90" height="90" alt="">
                        </div>
                        <div class="col">
                            <div class="accordion" id="accordion-example">
                                <div class="row align-items-end">
                                    <div class="col">
                                        <div class="accordion-item" style="border: none">
                                            <h2 class="accordion-header" id="heading-1">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true">
                                                <h4>Información general del proveedor</h4>
                                            </button>
                                            </h2>
                                            <div id="collapse-1" class="col accordion-collapse collapse show" data-bs-parent="#accordion-example">
                                                <div class="accordion-body pt-0">
                                                    <strong>{{ $provider->provider_name }}</strong> es un proveedor con número de identidad <strong>{{ $provider->provider_dni }}</strong>, número de teléfono <strong>{{ $provider->provider_phone }}</strong>. 
                                                    Fue ingresado al sistema en la fecha <strong>{{ $provider->created_at }}</strong>. Una breve descripción de este proveedor es: "{{ $provider->provider_description }}"
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
                        <h4 class="card-title">Proveedor - Historial de pagos</h4>
                    </div>
                    <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                        <div class="divide-y">
                            <div>
                                <div class="row">
                                    <table id="exampleProviderFunds" class="display table table-bordered">
                                        <thead>
                                            <tr class="text-center">
                                                <th>FECHA CAMBIO</th>
                                                <th>DEPOSITO / CAMBIO EN FONDOS</th>
                                                <th>EXPORTAR FACTURA</th>
                                                <th>MOTIVO / COMENTARIO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($providerFunds as $provider_fund)
                                                <tr class="text-center">
                                                    <td>{{ $provider_fund->provider_change_date }}</td>
                                                    <td>Lps. {{ number_format($provider_fund->provider_new_funds,2) }}</td>
                                                    <td>
                                                        <a href="{{ route('provider_funds.bill', $provider_fund->id) }}" class="badge bg-red me-1 text-white" data-toggle="modal" data-target="#pdfModal">
                                                            <img style="filter: invert(100%) sepia(0%) saturate(7398%) hue-rotate(181deg) brightness(105%) contrast(102%);" src="{{ asset('../static/svg/file-text.svg') }}" width="20" height="20" alt="">
                                                            FACTURA
                                                        </a>
                                                    </td>
                                                    <td>{{ $provider_fund->provider_new_funds_comment }}</td>
                                                </tr>
                                            @endforeach
                                            <!-- Modal for promissory note -->
                                            <div class="modal fade modal-blur" id="pdfModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="pdfModalLabel">Previsualización de factura de pago</h5>
                                                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <iframe id="pdf-frame" style="width:100%; height:500px;" src=""></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

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
<script src="{{ asset('customjs/datatable/dt_provider_funds.js')}}"></script>

<!-- PDF view -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- PDF Modal activator -->
<script>
    $('#pdfModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botón que activó el modal
        var url = button.attr('href'); // Extraer la información de los atributos data-*
        var modal = $(this);
        modal.find('#pdf-frame').attr('src', url);
    });
    $('#pdfModal').on('hidden.bs.modal', function (e) {
        $(this).find('#pdf-frame').attr('src', '');
    });
</script>  
@endsection