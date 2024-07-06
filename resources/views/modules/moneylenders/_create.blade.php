<div class="modal modal-blur fade" id="modal-team" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Agregar nuevo prestamista</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('moneylender.store')}}" method="POST">
                    @csrf
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" maxlength="55" name="moneylender_name" oninput="this.value = this.value.toUpperCase()" value="{{ old('moneylender_name') }}" id="moneylender_name" class="form-control @error('moneylender_name') is-invalid @enderror" autocomplete="off"/>
                                @error('moneylender_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="moneylender_name">Nombre del prestamista</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" maxlength="13" name="moneylender_dni" value="{{ old('moneylender_dni') }}" id="moneylender_dni" class="form-control @error('moneylender_dni') is-invalid @enderror" autocomplete="off"/>
                                @error('moneylender_dni')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="moneylender_dni">Nº identidad</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" name="moneylender_phone" value="{{ old('moneylender_phone') }}" id="moneylender_phone" class="form-control @error('moneylender_phone') is-invalid @enderror" data-mask="00000000" data-mask-visible="true" placeholder="00000000" autocomplete="off"/>
                                @error('moneylender_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="moneylender_phone">Nº teléfono</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <textarea maxlength="255" style="overflow: hidden; height: 150px; resize: none"
                                    name="moneylender_description" id="moneylender_description"
                                    class="form-control @error('moneylender_description') is-invalid @enderror"
                                    autocomplete="off" oninput="this.value = this.value.toUpperCase()">{{ old('moneylender_description') }}</textarea>
                                @error('moneylender_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span class="invalid-feedback" role="alert" id="project-comment-error"
                                    style="display: none;">
                                    <strong></strong>
                                </span>
                                <label for="moneylender_description">
                                    Descripción del prestamista
                                </label>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-dark me-auto" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-teal">Guardar nuevo prestamista</button>
                </form>
            </div>
        </div>
   </div>
</div>