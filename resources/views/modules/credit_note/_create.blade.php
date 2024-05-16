<div class="modal modal-blur fade" id="modal-team" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Nueva nota crédito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('credit_note.store')}}" method="POST">
                    @csrf
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="datetime-local" 
                                    name="creditNote_date" 
                                    style="font-size: 10px;" 
                                    value="{{Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s')}}"
                                    id="creditNote_date"
                                    min="{{Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s')}}"
                                    max="{{Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s')}}"
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
                        <div class="col" style="border: 1px solid #DADFE5; border-radius: 4px">
                            <label for="investor_id" class="mb-2" style="font-size: clamp(0.6rem, 3vh, 0.6rem); color: gray">Inversionistas</label><br>
                            <select class="form-select js-example-basic-multiple" name="investor_id" style="font-size: clamp(0.6rem, 3vh, 0.7rem); width: 100%">
                                <option></option>
                                @foreach ($investors as $investor)                                    
                                    <option value="{{ $investor->id }}">{{ $investor->investor_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="number" step="any" name="creditNote_amount" value="{{ old('creditNote_amount') }}" id="creditNote_amount" class="form-control @error('creditNote_amount') is-invalid @enderror"/>
                                @error('creditNote_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="creditNote_amount">Monto total de nota crédito</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" readonly class="form-control @error('creditNote_code') is-invalid @enderror" id="creditNote_code"
                                    name="creditNote_code" value="NC{{Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('YmdHms')}}" autocomplete="off"
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
                                    <textarea class="form-control @error('creditNote_description') is-invalid @enderror" autocomplete="off" maxlength="255" name="creditNote_description" id="creditNote_description" data-bs-toggle="autosize"> </textarea>
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