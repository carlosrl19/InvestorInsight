<div class="modal modal-blur fade" id="modal-funds" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Proveedores - Historial de cambios en fondos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card mb-2">
                    <div class="card-body">
                        <div id="search-filters-funds-container">FILTROS</div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <table id="exampleProviderFunds" class="display table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>NOMBRE PROVEEDOR</th>
                                    <th>FECHA PAGO</th>
                                    <th>MONTO PAGO</th>
                                    <th>DESCARGAR COMPROBANTE</th>
                                    <th>MOTIVO / COMENTARIOS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($provider_funds as $provider_fund)
                                    <tr class="text-center">
                                        <td>{{ $provider_fund->provider->provider_name }}</td>
                                        <td>{{ $provider_fund->provider_change_date }}</td>
                                        <td>L. {{ number_format($provider_fund->provider_new_funds,2)  }}</td>
                                        <td>
                                            <a href="{{ route('provider_funds.bill_download', $provider_fund->id) }}" class="badge bg-red me-1 text-white">
                                                <img style="filter: invert(100%) sepia(0%) saturate(7398%) hue-rotate(181deg) brightness(105%) contrast(102%);" src="{{ asset('../static/svg/file-text.svg') }}" width="20" height="20" alt="">
                                                COMPROBANTE
                                            </a>
                                        </td>
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