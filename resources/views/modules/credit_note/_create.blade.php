<div class="modal modal-blur fade" id="modal-team" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Nueva nota crédito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('credit_note.store')}}" method="POST">
                    @csrf
                    <div class="row mb-3 align-items-end">
                       <div class="col" style="display: none">
                            <div class="form-floating">
                                <input type="datetime-local" 
                                    name="creditNote_date" 
                                    style="font-size: 10px;" 
                                    value="{{ $creditNoteDate }}" 
                                    id="creditNote_date"
                                    min="{{ $creditNoteDate }}" 
                                    max="{{ $creditNoteDate }}" 
                                    class="form-control @error('creditNote_date') is-invalid @enderror" 
                                    readonly />
                                @error('creditNote_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label class="form-label" for="creditNote_date"><small>Fecha de nota crédito</small></label>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-floating">
                                <select class="form-select" id="investor_id" name="investor_id" style="width: 100%;">
                                    <option value="" selected disabled>Seleccione un inversionista</option>
                                    @foreach ($investors as $investor)
                                        <option value="{{ $investor->id }}" data-balance="{{ $investor->investor_balance }}" {{ old('investor_id') == $investor->id ? 'selected' : '' }}>
                                            {{ $investor->investor_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="investor_id">Inversionistas</label>
                            </div>
                        </div>
                        
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" id="investor_balance" class="form-control" value="" readonly>
                                <label for="investor_balance">Fondo actual</label>
                            </div>
                        </div>
                        
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" name="creditNote_amount" value="{{ old('creditNote_amount') }}" id="creditNote_amount" class="form-control @error('creditNote_amount') is-invalid @enderror" autocomplete="off"/>
                                @error('creditNote_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="creditNote_amount">Monto total de nota crédito</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col" style="display: none">
                            <div class="form-floating">
                                <input type="text" readonly class="form-control @error('creditNote_code') is-invalid @enderror" id="creditNote_code"
                                    name="creditNote_code" value="{{ $creditNoteCode }}" autocomplete="off"
                                    style="text-transform: uppercase; background-color: white; font-size: clamp(0.7rem, 3vw, 0.8rem)">
                                    @error('creditNote_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label for="creditNote_code">ID único nota crédito</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <textarea oninput="this.value = this.value.toUpperCase()" maxlength="255" style="overflow: hidden; height: 100px; resize: none" class="form-control @error('creditNote_description') is-invalid @enderror" autocomplete="off" name="creditNote_description" id="creditNote_description"> </textarea>
                                @error('creditNote_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="creditNote_description">Comentarios</label>
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

<script src="{{ asset('customjs/investors/investor_balance.js') }}"></script>