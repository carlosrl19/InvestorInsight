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
                            <div class="card mb-4" style="height: auto; width: 410px;">
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
                                <div class="col-md-6">
                                    <p><div class="badge bg-success mt-1"></div>&nbsp; Proyecto: {{ $project->project_name }}</p>
                                    <p><div class="badge bg-success mt-1"></div>&nbsp; Código: CP-{{ $project->project_code }}</p>
                                    <p><div class="badge bg-success mt-1"></div>&nbsp; Inversión total: Lps. {{ number_format($project->project_investment,2) }}</p>
                                    <p><div class="badge bg-cyan mt-1"></div>
                                        &nbsp;Fondo inversionista: Lps. {{ number_format($project->investor_balance_history,2) }}
                                    </p>
                                </div>
                                <div class="col-md-6">
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
                                    <div class="col-md-6 mb-3">
                                        <div class="card">
                                            <div class="card-status-start-md bg-primary"></div>
                                            <div class="card-stamp">
                                                <div class="card-stamp-icon bg-primary">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-number-1">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M13 20v-16l-5 5" />
                                                </svg>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <a href="{{ route('investor.show', $investor) }}">
                                                    {{ $investor->investor_name }}
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-link">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M9 15l6 -6" />
                                                        <path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" />
                                                        <path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" />
                                                    </svg><br>
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
                                    <div class="col-md-6 mb-3">
                                        <div class="card">
                                            <div class="card-status-start-md bg-secondary"></div>
                                            <div class="card-stamp">
                                                <div class="card-stamp-icon bg-primary">
                                                    @if($key == 1) <!-- Verifica si es el segundo card -->
                                                        <!-- Imagen SVG para el segundo card -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-number-3">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M12 12a4 4 0 1 0 -4 -4" />
                                                            <path d="M8 16a4 4 0 1 0 4 -4" />
                                                        </svg>
                                                    @else
                                                        <!-- Imagen SVG original -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-number-2">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M8 8a4 4 0 1 1 8 0c0 1.098 -.564 2.025 -1.159 2.815l-6.841 9.185h8" />
                                                        </svg>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <a href="{{ route('commission_agent.show', $commissioner) }}">
                                                    {{ $commissioner->commissioner_name }}
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-link">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M9 15l6 -6" />
                                                        <path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" />
                                                        <path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" />
                                                    </svg><br>
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