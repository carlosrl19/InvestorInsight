<div class="modal modal-blur fade" id="modal-payment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo pago</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('payments_investor.store')}}" method="POST">
                    @csrf
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <select name="promissoryNote_id" id="promissoryNote_id" class="form-control select2-promissoryNotes" style="width: 100%" onchange="updatePaymentDetails()">
                                    @if ($promissoryNoteInvestors->where('promissoryNote_status', 0)->count() > 0)
                                        <option value="" selected disabled>Seleccione el pagaré a pagar</option>
                                        @forelse ($promissoryNoteInvestors->where('promissoryNote_status', 0) as $promissoryNoteInvestor)
                                            <option value="{{ $promissoryNoteInvestor->id }}" data-investor-id="{{ $promissoryNoteInvestor->investor_id }}">
                                                {{ $promissoryNoteInvestor->promissoryNote_code }} - {{ $promissoryNoteInvestor->project->project_name }} - Lps. {{ number_format($promissoryNoteInvestor->promissoryNote_amount, 2) }}
                                            </option>
                                        @empty
                                        @endforelse
                                    @else
                                        <option value="" disabled selected>No existen pagarés para pagar</option>
                                    @endif
                                </select>
                                <label for="promissoryNote_id">Pagarés pendientes de pago</label>
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

                                <label for="payment_date"><small>Fecha actual</small></label>
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

                                <label for="payment_amount"><small>Monto a pagar</small></label>
                            </div>
                        </div>

                        <div class="col" style="display: none">
                            <div class="form-floating">
                                <input type="text" 
                                    class="form-control @error('payment_code') is-invalid @enderror" 
                                    id="payment_code"
                                    name="payment_code" 
                                    value="" 
                                    autocomplete="off"
                                    readonly>
                                    @error('payment_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <label for="payment_code">Código pago</label>
                            </div>
                        </div>
                        
                        <input type="hidden" name="investor_id" id="investor_id" value="">
                    </div>
                    <button type="button" class="btn btn-dark me-auto" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-teal">Realizar pago</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function updatePaymentDetails() {
        // Obtener el valor seleccionado en el select
        var selectedOption = document.getElementById('promissoryNote_id').value;

        // Obtener el código del pagaré seleccionado
        var promissoryNoteCode = document.querySelector(`option[value="${selectedOption}"]`).textContent.split(' - ')[0];

        // Obtener el investor_id del pagaré seleccionado
        var investorId = document.querySelector(`option[value="${selectedOption}"]`).getAttribute('data-investor-id');

        // Asignar el código del pagaré al campo payment_code
        document.getElementById('payment_code').value = promissoryNoteCode;

        // Asignar el investor_id al campo oculto
        document.getElementById('investor_id').value = investorId;
    }
</script>