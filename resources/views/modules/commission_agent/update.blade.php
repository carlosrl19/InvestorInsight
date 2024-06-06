<div class="modal modal-blur fade" id="modal-team-update" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Editar inversionista</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('commission_agent.update', ['commission_agent' => $commission_agent]) }}" novalidate>
                    @method('PUT')
                    @csrf
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <label class="form-label" for="commissioner_name">Nombre del comisionista</label>
                            <input type="text" maxlength="55" value="{{ $commission_agent->commissioner_name }}" name="commissioner_name" id="commissioner_name" class="form-control @error('commissioner_name') is-invalid @enderror" placeholder="Ingrese el nombre del comisionista" autocomplete="off"/>
                            @error('commissioner_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col">
                            <label class="form-label" for="commissioner_dni">Nº identidad</label>
                            <input type="text" maxlength="13" value="{{ $commission_agent->commissioner_dni }}" name="commissioner_dni" id="commissioner_dni" class="form-control @error('commissioner_dni') is-invalid @enderror" placeholder="Ingrese el número de identidad" autocomplete="off"/>
                            @error('commissioner_dni')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="hidden" name="commissioner_status" value="1">
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <label class="form-label" for="commissioner_phone">Nº teléfono</label>
                            <input type="text" name="commissioner_phone" value="{{ $commission_agent->commissioner_phone }}" id="commissioner_phone" class="form-control @error('commissioner_phone') is-invalid @enderror" data-mask="00000000" data-mask-visible="true" placeholder="00000000" autocomplete="off"/>
                            @error('commissioner_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <a href="{{ route('commission_agent.index') }}" class="btn btn-dark me-auto">Volver</a>
                    <button type="submit" class="btn btn-teal">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('customjs/uppercase.js') }}"></script>