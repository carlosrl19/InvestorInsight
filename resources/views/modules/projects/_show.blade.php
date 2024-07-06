<div class="modal modal-blur fade" id="showModal{{ $project->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="showModal{{ $project->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Datos del proyecto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row"> <!-- Inicia la fila principal -->
                        <div class="col-lg-6"> <!-- Col que debe estar a la izquierda -->
                            <h3>Imagen del comprobante de pago</h3>
                            <div class="card mb-4" style="margin: auto; border: none; height: auto; width: 390px;">
                                @if($project->project_status != 0)
                                    <img src="{{ asset('static/in_process.gif') }}" alt="in_process" style="height: auto; width: 180px; padding-top: 20%; padding-bottom: 30%; margin: auto">
                                    <p class="mt-3 text-center">PROYECTO EN PROCESO</p>
                                @else
                                    <img src="/images/transfers/{{ $project->project_proof_transfer_img }}" style="height: auto; width: 410px;">
                                @endif
                            </div>
                        </div> <!-- Fin de col izquierda -->

                        <div class="col-lg-6"> <!-- Columna derecha -->
                            <div class="row mb-3"> <!-- Inicio del segundo col que debe ser a la derecha -->
                                <h3>Información general del proyecto</h3>
                                <div class="col-md-6 text-start">
                                    <p><div class="badge bg-success mt-1"></div>&nbsp; Nombre: {{ $project->project_name }}</p>
                                    <p><div class="badge bg-success mt-1"></div>&nbsp; Código: CP-{{ $project->project_code }}</p>
                                    <p><div class="badge bg-success mt-1"></div>&nbsp; Inversión total: Lps. {{ number_format($project->project_investment,2) }}</p>
                                    <p><div class="badge bg-cyan mt-1"></div>
                                        &nbsp;Fondo inversionista: Lps. {{ number_format($project->investor_balance_history,2) }}
                                    </p>
                                </div>
                                <div class="col-md-6 text-start">
                                    <p><div class="badge bg-success mt-1"></div>&nbsp; Fecha inicio: {{ $project->project_start_date }}</p>
                                    <p><div class="badge bg-success mt-1"></div>&nbsp; Fecha final: {{ $project->project_end_date }}</p>
                                    <p><div class="badge bg-success mt-1"></div>&nbsp;
                                        @foreach($project->investors as $investor)
                                             Ganancia total: Lps. {{ number_format($investor->pivot->investor_final_profit + $project->project_investment,2) }}
                                            <br>
                                        @endforeach
                                    </p>
                                </p>
                                </div>
                            </div>
                            <h3>Inversionistas del proyecto</h3>
                            <div class="row">
                                @foreach($project->investors as $investor)
                                    <div class="col mb-3 text-start">
                                        <div class="card">
                                            <div class="card-status-start-md bg-primary"></div>
                                            <div class="card-stamp">
                                                <div class="card-stamp-icon bg-primary">
                                                    <img style="filter: invert(100%) sepia(0%) saturate(7441%) hue-rotate(237deg) brightness(118%) contrast(100%);" src="{{ asset('../static/svg/number-1.svg') }}" width="90" height="90">
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <a href="{{ route('investor.show', $investor) }}">
                                                    {{ $investor->investor_name }}
                                                    <img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="{{ asset('../static/svg/link.svg') }}" width="20" height="20" alt="">
                                                    <br>
                                                    <span class="badge bg-orange mt-2">Inversión (I): Lps. {{ number_format($investor->pivot->investor_investment) }}</span><br>
                                                    <span class="badge bg-cyan mt-2">Ganancia (C): Lps. {{ number_format($investor->pivot->investor_profit / 2,2) }}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <h3>Comisionistas del proyecto</h3>
                            <div class="row">
                                @foreach($project->commissioners as $key => $commissioner)
                                    <div class="col mb-3 text-start">
                                        <div class="card">
                                            <div class="card-status-start-md bg-secondary"></div>
                                            <div class="card-stamp">
                                                <div class="card-stamp-icon bg-primary">
                                                    @if($key == 1) <!-- Verifica si es el segundo card -->
                                                        <img style="filter: invert(100%) sepia(0%) saturate(7441%) hue-rotate(237deg) brightness(118%) contrast(100%);" src="{{ asset('../static/svg/number-3.svg') }}" width="90" height="90">
                                                    @else
                                                        <img style="filter: invert(100%) sepia(0%) saturate(7441%) hue-rotate(237deg) brightness(118%) contrast(100%);" src="{{ asset('../static/svg/number-2.svg') }}" width="90" height="90">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <a href="{{ route('commission_agent.show', $commissioner) }}">
                                                    {{ $commissioner->commissioner_name }}
                                                    <img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="{{ asset('../static/svg/link.svg') }}" width="20" height="20" alt="">
                                                    <br>
                                                    <span class="badge bg-secondary mt-2">Comisión: Lps. {{ number_format($commissioner->pivot->commissioner_commission,2) }}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div> <!-- Fin del col derecho -->
                        </div> <!-- Fin de col-lg-6 derecha -->
                </div> <!-- Fin de la fila principal -->
            </div>
        </div>
    </div>
</div>