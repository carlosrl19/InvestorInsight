<div class="modal modal-blur fade" id="modal-funds" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Historial de cambios en fondos</h5>
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
                        <table id="exampleFunds" class="display table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>NOMBRE INVERSIONISTA</th>
                                    <th>FECHA CAMBIO</th>
                                    <th>FONDO ANTERIOR</th>
                                    <th>DEPOSITO / CAMBIO EN FONDOS</th>
                                    <th>NUEVO FONDO</th>
                                    <th>MOTIVO / COMENTARIOS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($investorFunds as $investor)
                                    <tr class="text-center">
                                        <td>{{ $investor->investor->investor_name }}</td>
                                        <td>{{ $investor->investor_change_date }}</td>
                                        <td>Lps. {{ number_format($investor->investor_old_funds,2) }}</td>

                                        @if($investor->investor_new_funds - $investor->investor_old_funds < 0)
                                            <td class="text-red">L. {{ number_format($investor->investor_new_funds - $investor->investor_old_funds,2) }}</td>
                                        @else
                                            <td class="text-success">L. {{ number_format($investor->investor_new_funds - $investor->investor_old_funds,2) }}</td>
                                        @endif

                                        <td>Lps. {{ number_format($investor->investor_new_funds,2) }}</td>
                                        <td>{{ $investor->investor_new_funds_comment }}</td>
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