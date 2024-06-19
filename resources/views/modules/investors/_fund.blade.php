<div class="modal modal-blur fade" id="modal-fund{{ $investor->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Agregar fondo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('investor.fund', $investor)}}" method="POST">
                    @csrf

                    <div class="row align-items-end">
                        <div class="col-6 mb-4">
                            <label class="form-label" for="investor_balance_{{ $investor->id }}">Fondo actual del inversionista</label>
                            <input type="number" readonly value="{{ $investor->investor_balance }}"
                                name="investor_balance" id="investor_balance_{{ $investor->id }}"
                                class="form-control @error('investor_balance') is-invalid @enderror"
                                autocomplete="off" autofocus style="background-color: #fff6e980" />
                            @error('investor_balance')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-6 mb-4">
                            <label class="form-label" for="investor_balance_{{ $investor->id }}">Nuevo fondo del
                                inversionista</label>
                            <input type="number" value="{{ $investor->investor_balance }}" name="investor_balance"
                                id="investor_balance_{{ $investor->id }}"
                                class="form-control @error('investor_balance') is-invalid @enderror"
                                autocomplete="off" />
                            @error('investor_balance')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <button type="button" class="btn btn-dark me-auto" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-teal">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>