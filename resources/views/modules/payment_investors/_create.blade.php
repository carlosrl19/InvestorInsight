<div class="modal modal-blur fade" id="modal-team" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo pago
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('payments_investor.store')}}" method="POST">
                    @csrf
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <select name="promissoryNoteInvestor_id" id="promissoryNoteInvestor_id" class="form-control">
                                    <optgroup label="Pagarés de inversionistas">
                                        <option value="" selected disabled>Seleccione el pagaré a pagar</option>
                                        @foreach ($promissoryNoteInvestors->where('promissoryNote_status', 1) as $promissoryNoteInvestor)
                                            <option value="{{ $promissoryNoteInvestor->id }}">{{ $promissoryNoteInvestor->promissoryNote_code }} - Lps. {{ $promissoryNoteInvestor->promissoryNote_amount }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                                <label for="promissoryNoteInvestor_id">Pagarés pendientes de pago</label>
                            </div>
                        </div>
                        <div class="col" style="display: none">
                            <div class="form-floating">
                                <input type="datetime-local" 
                                    name="payment_date" 
                                    style="font-size: 10px;" 
                                    value="{{ $todayDate }}" 
                                    id="payment_date"
                                    min="{{ $todayDate }}" 
                                    max="{{ $todayDate }}" 
                                    class="form-control @error('payment_date') is-invalid @enderror" 
                                    readonly />
                                @error('payment_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label class="form-label" for="payment_date"><small>Fecha actual</small></label>
                            </div>
                        </div>
                        <div class="col" style="display: none">
                            <div class="form-floating">
                                <input type="number" 
                                    name="payment_amount" 
                                    style="font-size: 10px;" 
                                    value="{{ old('payment_amount', $promissoryNoteInvestor->promissoryNote_amount ?? '') }}" 
                                    id="payment_amount"
                                    min="{{ old('payment_amount', $promissoryNoteInvestor->promissoryNote_amount ?? '') }}" 
                                    max="{{ old('payment_amount', $promissoryNoteInvestor->promissoryNote_amount ?? '') }}" 
                                    class="form-control @error('payment_amount') is-invalid @enderror" 
                                    readonly />
                                @error('payment_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label class="form-label" for="payment_amount"><small>Monto a pagar</small></label>
                            </div>
                        </div>
                        <div class="col" style="display: none">
                            <div class="form-floating">
                                <input type="text" 
                                    class="form-control @error('payment_code') is-invalid @enderror" 
                                    id="payment_code"
                                    name="payment_code" 
                                    value="{{ $generatedCode }}" 
                                    autocomplete="off"
                                    readonly">
                                    @error('payment_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <label for="payment_code">Código pago</label>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-dark me-auto" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-teal">Realizar pago</button>
                </form>
            </div>
        </div>
    </div>
</div>