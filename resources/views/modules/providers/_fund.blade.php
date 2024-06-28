<div class="modal modal-blur fade" id="modal-fund{{ $provider->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Agregar pago</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('provider.fund', $provider)}}" method="POST" novalidate>
                    @csrf
                    <div class="row align-items-end">
                        <div class="col" style="display: none">
                            <div class="form-floating">
                                <input type="datetime-local" 
                                    name="provider_change_date" 
                                    style="font-size: 10px;" 
                                    value="{{ $todayDate }}" 
                                    id="provider_change_date"
                                    min="{{ $todayDate }}" 
                                    max="{{ $todayDate }}" 
                                    class="form-control @error('provider_change_date') is-invalid @enderror" 
                                    readonly />
                                @error('provider_change_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label for="provider_change_date"><small>Fecha actual</small></label>
                            </div>
                        </div>

                        <div class="col-6 mb-4" style="display: none">
                            <div class="form-floating">
                                <input type="number" readonly value="{{ $provider->provider_balance }}"
                                    name="provider_old_funds" id="provider_old_funds"
                                    class="form-control @error('provider_old_funds') is-invalid @enderror"
                                    autocomplete="off" autofocus style="background-color: #fff6e980" />
                                @error('provider_old_funds')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="provider_old_funds">Fondo actual del proveedor</label>
                            </div>
                            <input type="hidden" name="provider_balance" value="{{ $provider->provider_balance }}">
                        </div>
                        
                        <div class="col mb-4">
                            <div class="form-floating">
                                <input type="number" value="0.00" min="0.00"
                                    name="provider_new_funds" id="provider_new_funds"
                                    class="form-control @error('provider_new_funds') is-invalid @enderror"
                                    autocomplete="off" />
                                @error('provider_new_funds')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="provider_new_funds">Monto de pago a proveedor</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 align-items-end">
                            <div class="col">
                                <div class="form-floating">
                                    <textarea maxlength="255"
                                        class="form-control @error('provider_new_funds_comment') is-invalid @enderror"
                                        autocomplete="off" maxlength="255" name="provider_new_funds_comment" id="provider_new_funds_comment"
                                        style="resize: none; height: 100px" oninput="this.value = this.value.toUpperCase()">{{ old('provider_new_funds_comment')}}</textarea>
                                    @error('provider_new_funds_comment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span class="invalid-feedback" role="alert" id="transfer-comment-error"
                                        style="display: none;">
                                        <strong></strong>
                                    </span>
                                    <label for="provider_new_funds_comment">Comentarios</label>
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