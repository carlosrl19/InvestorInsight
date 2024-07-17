<div class="modal modal-blur fade" id="modal-team" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Agregar nuevo comisionista</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('commission_agent.store')}}" method="POST">
                    @csrf
                    <div class="row mb-3 align-items-end">
                        <div class="col" style="display: none;">
                            <div class="form-floating">
                                <input type="number" name="commissioner_balance" value="{{ $commissioner_balance}}" readonly id="commissioner_balance" class="form-control @error('commissioner_balance') is-invalid @enderror" autocomplete="off"/>
                                @error('commissioner_balance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="commissioner_name">Capital del comisionista</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" oninput="this.value = this.value.toUpperCase().replace(/[^A-Z\s]/g, '')" maxlength="55" name="commissioner_name" value="{{ old('commissioner_name') }}" id="commissioner_name" class="form-control @error('commissioner_name') is-invalid @enderror" autocomplete="off"/>
                                @error('commissioner_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="commissioner_name">Nombre del comisionista</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" oninput="this.value = this.value.toUpperCase().replace(/\s/g, '')" maxlength="13" name="commissioner_dni" value="{{ old('commissioner_dni') }}" id="commissioner_dni" class="form-control @error('commissioner_dni') is-invalid @enderror" autocomplete="off"/>
                                @error('commissioner_dni')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="commissioner_dni">Nº identidad</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" oninput="this.value = this.value.replace(/\D/g, '')" minlength="8" maxlength="8" name="commissioner_phone" value="{{ old('commissioner_phone') }}" id="commissioner_phone" class="form-control @error('commissioner_phone') is-invalid @enderror" autocomplete="off"/>
                                @error('commissioner_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="commissioner_phone">Nº teléfono</label>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-dark me-auto" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-teal">Guardar nuevo comisionista</button>
                </form>
            </div>
        </div>
   </div>
</div>