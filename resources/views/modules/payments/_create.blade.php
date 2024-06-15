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
                <form action="{{ route('payments.store')}}" method="POST">
                    @csrf

                    <div class="row mb-3 align-items-end">
                        <div class="form-floating">
                            <select name="promissoryNotes" id="promissoryNotes">
                                <optgroup label="Pagarés de inversionistas">
                                    @foreach ($promissoryNoteInvestors as $promissoryNoteInvestor)
                                        <option value="{{ $promissoryNoteInvestor->id }}">{{ $promissoryNoteInvestor->promissory_note_investors->promissoryNote_code }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>
                 
                    <button type="button" class="btn btn-dark me-auto" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-teal">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>