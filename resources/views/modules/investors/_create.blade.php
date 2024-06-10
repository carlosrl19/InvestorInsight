<div class="modal modal-blur fade" id="modal-team" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Agregar nuevo inversionista</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('investor.store')}}" method="POST">
                    @csrf
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" readonly name="investor_code" id="investor_code" value="{{ $investorCode }}" class="form-control @error('investor_name') is-invalid @enderror" autocomplete="off">
                                <label for="investor_code" name="investor_code">ID</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" maxlength="55" name="investor_name" value="{{ old('investor_name') }}" id="investor_name" class="form-control @error('investor_name') is-invalid @enderror" autocomplete="off"/>
                                @error('investor_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="investor_name">Nombre del inversionista</label>
                            </div>
                        </div>
                        <input type="hidden" name="investor_status" value="1">
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" name="investor_dni" value="{{ old('investor_dni') }}" id="investor_dni" class="form-control @error('investor_dni') is-invalid @enderror" data-mask="0000000000000" data-mask-visible="true" placeholder="0000000000000" autocomplete="off"/>
                                @error('investor_dni')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="investor_dni">Nº identidad</label>
                            </div>
                        </div>
                        <div class="col" style="display: none">
                            <div class="form-floating">
                                <input type="number" name="investor_balance" step="any" readonly value="0.00" title="Si el inversionista tiene fondos existentes y se está agregando al sistema por primera vez, agregue el fondo monetario como una transferencia y agregue el comentario referente a que ya era un fondo existente." data-bs-toggle="tooltip" data-bs-placement="right" id="investor_balance" class="form-control @error('investor_balance') is-invalid @enderror"/>
                                @error('investor_balance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="investor_balance">Fondo monetario</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" minlength="8" maxlength="11" name="investor_phone" value="{{ old('investor_phone') }}" id="investor_phone" class="form-control @error('investor_phone') is-invalid @enderror" autocomplete="off">
                                @error('investor_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="investor_phone">Nº teléfono</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <div class="mb-3">
                                    <label for="investor_reference_id" class="mb-2 mt-2" style="font-size: clamp(0.6rem, 3vh, 0.6rem); color: gray">Recomendado por</label>
                                    <select type="text" class="form-select" id="select-optgroups" name="investor_reference_id" style="font-size: clamp(0.6rem, 3vh, 0.7rem);">
                                        <optgroup label="Inversionistas">
                                        @foreach ($investors as $investor)
                                            <option value="{{ $investor->id }}" {{ old('investor_reference_id') == $investor->id ? 'selected' : '' }}>{{ $investor->investor_name }}</option>
                                        @endforeach
                                        </optgroup>
                                    </select>
                                    @error('investor_reference_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <div class="mb-3">
                                    <label for="investor_company_name" class="mb-2 mt-2" style="font-size: clamp(0.6rem, 3vh, 0.6rem); color: gray">Afiliado</label>
                                    <select type="text" class="form-select" id="select-optgroups" name="investor_company_name" style="font-size: clamp(0.6rem, 3vh, 0.7rem);">
                                        <option value="ROBENIOR" {{ old('investor_company_name') == 'ROBENIOR' ? 'selected' : '' }}>ROBENIOR</option>
                                        <option value="MARSELLA" {{ old('investor_company_name') == 'MARSELLA' ? 'selected' : '' }}>MARSELLA</option>
                                        <option value="JAGUER" {{ old('investor_company_name') == 'JAGUER' ? 'selected' : '' }}>JAGUER</option>
                                        <option value="FUTURE CAPITAL" {{ old('investor_company_name') == 'FUTURE CAPITAL' ? 'selected' : '' }}>FUTURE CAPITAL</option>
                                    </select>
                                    @error('investor_company_name')
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