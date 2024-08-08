<div class="modal modal-blur fade" id="modal-fund{{ $investor->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Agregar fondo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('investor.fund', $investor)}}" method="POST" novalidate>
                    @csrf
                    <div class="row align-items-end">
                        <div class="col" style="display: none">
                            <div class="form-floating">
                                <input type="datetime-local" 
                                    name="investor_change_date" 
                                    style="font-size: 10px;" 
                                    value="{{ $todayDate }}" 
                                    id="investor_change_date"
                                    min="{{ $todayDate }}" 
                                    max="{{ $todayDate }}" 
                                    class="form-control @error('investor_change_date') is-invalid @enderror" 
                                    readonly />
                                @error('investor_change_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label for="investor_change_date"><small>Fecha actual</small></label>
                            </div>
                        </div>
                        
                        <div class="col-6 mb-4">
                            <div class="form-floating">
                                <input type="number" readonly value="{{ $investor->investor_balance }}"
                                    name="investor_old_funds" id="investor_old_funds"
                                    class="form-control @error('investor_old_funds') is-invalid @enderror"
                                    autocomplete="off" autofocus/>
                                @error('investor_old_funds')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="investor_old_funds">Fondo actual del inversionista</label>
                            </div>
                            <input type="hidden" name="investor_balance" value="{{ $investor->investor_balance }}">
                        </div>
                        
                        <div class="col-6 mb-4">
                            <div class="form-floating">
                                <input type="number" value="{{ $investor->investor_balance }}" min="{{ $investor->investor_balance }}"
                                    name="investor_new_funds" id="investor_new_funds"
                                    class="form-control @error('investor_new_funds') is-invalid @enderror"
                                    autocomplete="off" />
                                @error('investor_new_funds')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="investor_new_funds">Nuevo fondo del inversionista</label>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-end">
                            <div class="col">
                                <div class="form-floating">
                                    <textarea maxlength="255"
                                        class="form-control @error('investor_new_funds_comment') is-invalid @enderror"
                                        autocomplete="off" maxlength="255" name="investor_new_funds_comment" id="investor_new_funds_comment"
                                        style="resize: none; height: 100px;" oninput="this.value = this.value.toUpperCase()">{{ old('investor_new_funds_comment')}}</textarea>
                                    @error('investor_new_funds_comment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span class="invalid-feedback" role="alert" id="transfer-comment-error"
                                        style="display: none;">
                                        <strong></strong>
                                    </span>
                                    <label for="investor_new_funds_comment">Comentarios / Motivo para agregar fondos</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" style="float: left;" class="btn btn-dark me-auto" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" style="float: left; margin-left: 5px" class="btn btn-teal">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>