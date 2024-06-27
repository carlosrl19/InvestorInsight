<div class="modal modal-blur fade" id="modal-team" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Agregar nuevo proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('provider.store')}}" method="POST">
                    @csrf
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" maxlength="55" name="provider_name" oninput="this.value = this.value.toUpperCase()" value="{{ old('provider_name') }}" id="provider_name" class="form-control @error('provider_name') is-invalid @enderror" autocomplete="off"/>
                                @error('provider_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="provider_name">Nombre del proveedor</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" name="provider_dni" value="{{ old('provider_dni') }}" id="provider_dni" class="form-control @error('provider_dni') is-invalid @enderror" data-mask="0000000000000" data-mask-visible="true" placeholder="0000000000000" autocomplete="off"/>
                                @error('provider_dni')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="provider_dni">Nº identidad</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 align-items-end">

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" minlength="8" maxlength="11" name="provider_phone" value="{{ old('provider_phone') }}" id="provider_phone" class="form-control @error('provider_phone') is-invalid @enderror" autocomplete="off">
                                @error('provider_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="provider_phone">Nº teléfono</label>
                            </div>
                        </div>

                        <div class="col" style="display: none">
                            <div class="form-floating">
                                <input type="number" name="provider_balance" step="any" readonly value="0.00" id="provider_balance" class="form-control @error('provider_balance') is-invalid @enderror"/>
                                @error('provider_balance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="provider_balance">Fondo monetario</label>
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-ends mb-3">
                        <div class="col">
                            <div class="form-floating">
                                <textarea maxlength="80" style="height: 100px; resize: none" name="provider_description" oninput="this.value = this.value.toUpperCase()" id="provider_description" class="form-control @error('provider_name') is-invalid @enderror" autocomplete="off"/>{{ old('provider_description') }}</textarea>
                                @error('provider_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="provider_description">Breve descripción del proveedor</label>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-dark me-auto" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-teal">Guardar</button>
                </form>
            </div>
        </div>
   </div>
</div>