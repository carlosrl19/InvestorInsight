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
                                    <th>CÓDIGO</th>
                                    <th>NOMBRE INVERSIONISTA</th>
                                    <th>FECHA LIQUIDACIÓN</th>
                                    <th>MÉTODO DE PAGO UTILIZADO</th>
                                    <th>FONDO LIQUIDADO</th>
                                    <th>DESCARGAR LIQUIDACIÓN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($investorLiquidations as $investorLiquidation)
                                    <tr class="text-center">
                                        <td>#{{ $investorLiquidation->liquidation_code }}</td>
                                        <td>{{ $investorLiquidation->investor->investor_name }}</td>
                                        <td>{{ $investorLiquidation->investor_liquidation_date }}</td>
                                        <td>{{ $investorLiquidation->liquidation_payment_mode }}</td>
                                        <td>Lps. {{ number_format($investorLiquidation->investor_liquidation_amount,2) }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-red" href="{{ route('investor.liquidation_download', $investorLiquidation)}}">
                                                <img style="filter: invert(99%) sepia(43%) saturate(0%) hue-rotate(95deg) brightness(110%) contrast(101%);" 
                                                src="{{ asset('../static/svg/file-text.svg') }}" width="20" height="20" alt="">
                                                &nbsp;LIQUIDACIÓN
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