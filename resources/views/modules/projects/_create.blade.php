<div class="modal modal-blur fade" id="modal-team" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Agregar nuevo proyecto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('project.store')}}" method="POST">
                    @csrf
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" maxlength="55" value="{{ old('project_name') }}" name="project_name" id="project_name" class="form-control @error('project_name') is-invalid @enderror" placeholder="Ingrese el nombre del inversionista" autocomplete="off"/>
                                @error('project_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label class="form-label" for="project_name">Nombre del proyecto</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" maxlength="13" value="{{ old('project_estimated_time') }}" name="project_estimated_time" id="project_estimated_time" class="form-control @error('project_estimated_time') is-invalid @enderror" placeholder="Ingrese el número de semanas estimadas para el proyecto" autocomplete="off"/>
                                @error('project_estimated_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label class="form-label" for="project_estimated_time">SM <small>(tiempo estimado)</small></label>
                            </div>
                        </div>
                        <input type="hidden" name="investor_status" value="1">
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="date" name="investor_phone" value="{{ old('investor_phone') }}" id="investor_phone" class="form-control @error('investor_phone') is-invalid @enderror" autocomplete="off" min="{{ \Carbon\Carbon::now()->toDateString() }}"/>
                                @error('investor_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label class="form-label" for="investor_phone">Fecha inicial</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="date" name="investor_phone" value="{{ old('investor_phone') }}" id="investor_phone" class="form-control @error('investor_phone') is-invalid @enderror" autocomplete="off" min="{{ \Carbon\Carbon::now()->toDateString() }}"/>
                                @error('investor_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label class="form-label" for="investor_phone">Fecha de cierre</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="date" name="project_investment" value="{{ old('project_investment') }}" id="project_investment" class="form-control @error('project_investment') is-invalid @enderror" autocomplete="off"/>
                                @error('project_investment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label class="form-label" for="project_investment">Inversionistas</label>
                            </div>
                            <div class="form-group">
                                <label>Inversionistas</label>
                                <select class="js-example-basic-multiple" multiple="multiple">
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                    <option value="AM">America</option>
                                    <option value="CA">Canada</option>
                                    <option value="RU">Russia</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="date" name="investor_phone" value="{{ old('investor_phone') }}" id="investor_phone" class="form-control @error('investor_phone') is-invalid @enderror" autocomplete="off" min="{{ \Carbon\Carbon::now()->toDateString() }}"/>
                                @error('investor_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label class="form-label" for="investor_phone">Fecha de cierre</label>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-dark me-auto" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-teal">Guardar nuevo proyecto</button>
                </form>
            </div>
        </div>
   </div>
</div>