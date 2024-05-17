<div class="modal modal-blur fade" id="modal-team" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo pagaré</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('promissory_note.store')}}" method="POST">
                    @csrf
                    <div class="row mb-3 align-items-end">
                        <div class="col" style="border: 1px solid #DADFE5; border-radius: 4px">
                            <label for="investor_id" class="mb-2" style="font-size: clamp(0.6rem, 3vh, 0.6rem); color: gray">Inversionista deudor</label><br>
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
                                <input type="date" 
                                    name="promissoryNote_emission_date" 
                                    style="font-size: 10px;" 
                                    value="{{Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d')}}"
                                    id="promissoryNote_emission_date"
                                    min="{{Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d')}}"
                                    max="{{Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d')}}"
                                    class="form-control @error('promissoryNote_emission_date') is-invalid @enderror" 
                                    readonly />
                                @error('promissoryNote_emission_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label class="form-label" for="promissoryNote_emission_date"><small>Fecha de emisión del pagaré</small></label>
                            </div>
                        </div>
                        <input type="hidden" name="promissoryNote_status" value="0">
                        @error('promissoryNote_status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" readonly class="form-control @error('promissoryNote_code') is-invalid @enderror" id="promissoryNote_code"
                                    name="promissoryNote_code" value="PG{{Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('YmdHms')}}" autocomplete="off"
                                    style="text-transform: uppercase; background-color: white; font-size: clamp(0.7rem, 3vw, 0.8rem)">
                                    @error('promissoryNote_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label for="promissoryNote_code">ID único pagaré</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="number" step="any" name="promissoryNote_amount" value="{{ old('promissoryNote_amount') }}" id="promissoryNote_amount" class="form-control @error('promissoryNote_amount') is-invalid @enderror"/>
                                @error('promissoryNote_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="promissoryNote_amount">Monto total del pagaré</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="date" 
                                    name="promissoryNote_final_date" 
                                    style="font-size: 10px;" 
                                    value="{{Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d')}}"
                                    id="promissoryNote_final_date"
                                    min="{{Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d')}}"
                                    class="form-control @error('promissoryNote_final_date') is-invalid @enderror" 
                                    />
                                @error('promissoryNote_final_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label class="form-label" for="promissoryNote_final_date"><small>Fecha de pago del pagaré</small></label>
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