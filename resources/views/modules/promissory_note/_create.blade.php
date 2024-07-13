<div class="modal modal-blur fade" id="modal-team" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <div class="col">
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
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col" style="display: none">
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

                                <label for="promissoryNote_emission_date"><small>Fecha de emisión del pagaré</small></label>
                            </div>
                        </div>
                        <input type="hidden" name="promissoryNote_status" value="1">
                        @error('promissoryNote_status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="col" style="display: none">
                            <div class="form-floating">
                                <input type="text" readonly class="form-control @error('promissoryNote_code') is-invalid @enderror" id="promissoryNote_code"
                                    name="promissoryNote_code" value="{{ $promissoryCode }}" autocomplete="off"
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
                                    style="font-size: 12px;" 
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

                                <label for="promissoryNote_final_date"><small>Fecha de pago del pagaré</small></label>
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