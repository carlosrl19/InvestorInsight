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
                                    <input readonly type="date" name="project_end_date" value="{{ old('project_estimated_time') }}" id="project_end_date" class="form-control @error('project_estimated_time') is-invalid @enderror" min="{{ \Carbon\Carbon::now()->toDateString() }}"/>
                                    @error('project_end_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label class="form-label" for="project_end_date"><small>Fecha de cierre del proyecto</small></label>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <!-- Step 2 -->
                    <fieldset>
                        <h3 class="text-center text-muted"><span style="border: 2px solid #637282; padding: 5px 10px 5px 10px; border-radius: 50px">2</span> Inversión</h3>
                        <div class="row mb-3 align-items-end">
                            <input type="hidden" name="project_status" value="1">
                            <div class="col">
                                <div class="form-floating">
                                    <input readonly type="number" name="project_investment" value="{{ old('project_investment') }}" id="project_investment" class="form-control @error('project_investment') is-invalid @enderror" autocomplete="off"/>
                                    @error('project_investment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label class="form-label" for="project_investment"><small>Inversión del proyecto (Lempiras)</small></label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-end">
                            <div class="col">
                                <div class="form-floating">
                                    <div class="card">
                                        <div class="card-header">Selección de inversionistas</div>
                                        <select class="form-select js-example-basic-multiple" name="investor_id" style="font-size: clamp(0.6rem, 3vh, 0.7rem); width: 100%" multiple="multiple">
                                            <option></option>
                                            @foreach ($investors as $investor)                                    
                                                <option value="{{ $investor->id }}">{{ $investor->investor_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <!-- Step 3 -->
                    <fieldset>
                        <h3 class="text-center text-muted"><span style="border: 2px solid #637282; padding: 5px 12px 5px 10px; border-radius: 50px">3</span> Información adicional del proyecto</h3>
                        <div class="row mb-3 align-items-end">
                            <div class="col">
                                <div class="form-floating">
                                    <textarea maxlength="255" data-bs-toggle="autosize" style="overflow: hidden; overflow-wrap: break-word; resize: none; text-align: start;" 
                                    name="project_final_note" value="{{ old('project_final_note') }}" id="project_final_note" class="form-control @error('project_final_note') is-invalid @enderror" 
                                    autocomplete="off"/></textarea>
                                    @error('project_final_note')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label class="form-label" for="project_final_note"><small>Información adicional</small></label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    
                    <!-- Buttons -->
                    <button type="button" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" class="btn btn-dark me-auto" id="prevBtn">Anterior</button>
                    <button type="button" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" class="btn btn-orange" id="nextBtn">Siguiente</button>
                    <button type="submit" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" class="btn btn-teal" id="submitBtn" style="display: none;">Guardar nuevo proyecto</button>
                </form>
            </div>
        </div>
   </div>
</div>