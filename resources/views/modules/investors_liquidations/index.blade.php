<div class="modal modal-blur fade" id="modal-liquidations" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Inversionistas - Historial de liquidaciones</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card mb-2">
                    <div class="card-body">
                        <div id="search-filters-liquidations-container">FILTROS</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <table id="exampleLiquidations" class="display table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>NOMBRE INVERSIONISTA</th>
                                    <th>FECHA LIQUIDACIÓN</th>
                                    <th>FONDO LIQUIDADO</th>
                                    <th>DESCARGAR COMPROBANTE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($investorLiquidations as $investor)
                                    <tr class="text-center">
                                        <td>{{ $investor->investor->investor_name }}</td>
                                        <td>{{ $investor->investor_liquidation_date }}</td>
                                        <td>Lps. {{ number_format($investor->investor_liquidation_amount,2) }}</td>
                                        <td>
                                            <a href="{{ route('investors_liquidations.voucher_download', $investor->id) }}" class="badge bg-red me-1 text-white">
                                                <img style="filter: invert(100%) sepia(0%) saturate(7398%) hue-rotate(181deg) brightness(105%) contrast(102%);" src="{{ asset('../static/svg/file-text.svg') }}" width="20" height="20" alt="">
                                                COMPROBANTE
                                            </a>
                                        </td>
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