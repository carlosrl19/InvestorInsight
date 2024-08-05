<div class="modal modal-blur fade" id="modal-team" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Agregar nuevo inversionista</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('moneylender.store')}}" method="POST">
                    @csrf
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" maxlength="55" name="moneylender_name" oninput="this.value = this.value.toUpperCase().replace(/[^A-Z\s]/g, '')" value="{{ old('moneylender_name') }}" id="moneylender_name" class="form-control @error('moneylender_name') is-invalid @enderror" autocomplete="off"/>
                                @error('moneylender_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="moneylender_name">Nombre del inversionista</label>
                            </div>
                        </div>
                        <input type="hidden" name="moneylender_status" value="1">
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" oninput="this.value = this.value.toUpperCase().replace(/\s/g, '')" name="moneylender_dni" maxlength="13" minlength="8" value="{{ old('moneylender_dni') }}" id="moneylender_dni" class="form-control @error('moneylender_dni') is-invalid @enderror" autocomplete="off"/>
                                @error('moneylender_dni')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="moneylender_dni">Nº identidad</label>
                            </div>
                        </div>
                        <div class="col" style="display: none">
                            <div class="form-floating">
                                <input type="number" name="moneylender_balance" step="any" readonly value="0.00" title="Si el inversionista tiene fondos existentes y se está agregando al sistema por primera vez, agregue el fondo monetario como una transferencia y agregue el comentario referente a que ya era un fondo existente." data-bs-toggle="tooltip" data-bs-placement="right" id="moneylender_balance" class="form-control @error('moneylender_balance') is-invalid @enderror"/>
                                @error('moneylender_balance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="moneylender_balance">Fondo monetario</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" oninput="this.value = this.value.replace(/\D/g, '')" minlength="8" maxlength="11" name="moneylender_phone" value="{{ old('moneylender_phone') }}" id="moneylender_phone" class="form-control @error('moneylender_phone') is-invalid @enderror" autocomplete="off">
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
                                <div class="mb-3">
                                    <label for="moneylender_company_name" class="mb-2 mt-2" style="font-size: clamp(0.6rem, 3vh, 0.6rem); color: gray">Afiliado</label>
                                    <select type="text" class="form-select" id="select-optgroups" name="moneylender_company_name" style="font-size: clamp(0.6rem, 3vh, 0.7rem);">
                                        <option value="ROBENIOR" {{ old('moneylender_company_name') == 'ROBENIOR' ? 'selected' : '' }}>ROBENIOR</option>
                                        <option value="MARSELLA" {{ old('moneylender_company_name') == 'MARSELLA' ? 'selected' : '' }}>MARSELLA</option>
                                        <option value="JAGUER" {{ old('moneylender_company_name') == 'JAGUER' ? 'selected' : '' }}>JAGUER</option>
                                        <option value="FUTURE CAPITAL" {{ old('moneylender_company_name') == 'FUTURE CAPITAL' ? 'selected' : '' }}>FUTURE CAPITAL</option>
                                    </select>
                                    @error('moneylender_company_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
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