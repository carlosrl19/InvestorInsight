<div class="modal modal-blur fade" id="modal-team" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Agregar nuevo proyecto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="projectForm" action="{{ route('project.store')}}" method="POST">
                    <!-- Step 1 -->
                    <fieldset>
                        @csrf
                        <h3 class="text-center text-muted"><span style="border: 2px solid #637282; padding: 5px 12px 5px 12px; border-radius: 50px">1</span> Datos generales</h3>
                        <div class="row mb-3 align-items-end">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" name="project_name" value="{{ old('project_name') }}" id="project_name" class="form-control @error('project_name') is-invalid @enderror" autocomplete="off"/>
                                    @error('project_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label class="form-label" for="project_name"><small>Nombre del proyecto</small></label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-end">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="date" name="project_start_date" value="{{ old('project_start_date') }}" id="project_start_date" class="form-control @error('project_name') is-invalid @enderror" min="{{ \Carbon\Carbon::now()->toDateString() }}"/>
                                    @error('project_start_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label class="form-label" for="project_start_date"><small>Fecha inicial del proyecto</small></label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <input type="number" min="1" name="project_estimated_time" value="{{ old('project_estimated_time') }}" id="project_estimated_time" class="form-control @error('project_estimated_time') is-invalid @enderror" autocomplete="off"/>
                                    @error('project_estimated_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label class="form-label" for="project_estimated_time"><small>SM (tiempo estimado en semanas)</small></label>
                                </div>
                            </div>
                            <div class="col" style="display: none;">
                                <div class="form-floating">
                                    <input type="text" readonly class="form-control @error('project_code') is-invalid @enderror" id="project_code"
                                        name="project_code" value="PY{{Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('smHdmY')}}" autocomplete="off"
                                        style="text-transform: uppercase; background-color: white; font-size: clamp(0.7rem, 3vw, 0.8rem)">
                                        @error('project_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <label for="project_code">ID único nota crédito</label>
                                </div>
                            </div>
                            <div class="col" style="display: none;">
                                <div class="form-floating">
                                    <input readonly type="date" name="project_end_date" value="{{ old('project_end_date') }}" id="project_end_date" class="form-control @error('project_estimated_time') is-invalid @enderror" min="{{ \Carbon\Carbon::now()->toDateString() }}"/>
                                    @error('project_end_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label class="form-label" for="project_end_date"><small>Fecha de cierre del proyecto</small></label>
                                </div>
                            </div>
                            <input readonly style="display: none;" type="number" name="project_total_worked_days" value="0" id="project_total_worked_days" class="form-control @error('project_total_worked_days') is-invalid @enderror" autocomplete="off"/>
                        </div>
                    </fieldset>

                    <!-- Step 2 -->
                    <fieldset>
                        <h3 class="text-center text-muted"><span style="border: 2px solid #637282; padding: 5px 10px 5px 10px; border-radius: 50px">2</span> Inversionistas</h3>
                        <input type="hidden" name="project_status" value="1">
                        
                        <!-- Project total investment -->
                        <input readonly style="display: none;" type="number" name="project_investment" value="{{ old('project_investment') }}" id="project_investment" class="form-control @error('project_investment') is-invalid @enderror" autocomplete="off"/>
                        @error('project_investment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                        <div class="row mb-3 mt-3 align-items-end">
                            <div class="col-11">
                                <div class="form-floating">
                                    <select class="form-select js-example-basic-multiple" id="investor_select" style="font-size: clamp(0.6rem, 3vh, 0.7rem); width: 100%">
                                        <option></option>
                                        @foreach ($investors as $investor)
                                            @if($investor->investor_status == 1)
                                                <option value="{{ $investor->id }}">{{ $investor->investor_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-1 d-flex justify-content-end" style="margin-bottom: 1vh">
                                <button type="button" title="Agregar inversionista seleccionado al proyecto" data-bs-toggle="tooltip" data-bs-placement="top" class="btn btn-md text-white" id="add_button_container" onclick="addInvestor()" style="background-color: gray; border: none; padding: 5px 0px 5px 5px">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                        <path d="M16 19h6"></path>
                                        <path d="M19 16v6"></path>
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Project's selected investor -->
                        <table class="table table-bordered" id="project_investors_table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th title="Info: Columna para mostrar el nombre del inversionista" data-bs-toggle="tooltip" data-bs-placement="left">Inversionista</th>
                                    <th title="Info: Columna para mostrar el monto de inversión del inversionista para el proyecto" data-bs-toggle="tooltip" data-bs-placement="top">Monto de inversión (Lps)</th>
                                    <th title="Info: Columna para mostrar botón de remover inversionista de los inversionistas seleccionados para formar parte del proyecto" data-bs-toggle="tooltip" data-bs-placement="right">Eliminar</th>
                                </th>
                            </thead>
                            <tbody>
                                <tr>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>

                    <!-- Step 3 -->
                    <fieldset>
                        <h3 class="text-center text-muted"><span style="border: 2px solid #637282; padding: 5px 12px 5px 10px; border-radius: 50px">3</span> Información adicional del proyecto</h3>
                        <div class="row mb-3 align-items-end">
                            <div class="col">
                                <div class="form-floating">
                                    <textarea maxlength="255" data-bs-toggle="autosize" style="overflow: hidden; overflow-wrap: break-word; resize: none; text-align: start;" 
                                    name="project_description" value="{{ old('project_description') }}" id="project_description" class="form-control @error('project_description') is-invalid @enderror" 
                                    autocomplete="off"/></textarea>
                                    @error('project_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label class="form-label" for="project_description"><small>Información adicional</small></label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    
                    <!-- Buttons -->
                    <button type="button" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" class="btn btn-dark me-auto" id="prevBtn">Paso anterior</button>
                    <button type="button" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" class="btn btn-orange" id="nextBtn">Siguiente paso</button>
                    <button type="submit" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" class="btn btn-teal" id="submitBtn" style="display: none;">Guardar nuevo proyecto</button>
                </form>
            </div>
        </div>
   </div>
</div>

<script src="{{ asset('customjs/projects/investors.js') }}"></script>