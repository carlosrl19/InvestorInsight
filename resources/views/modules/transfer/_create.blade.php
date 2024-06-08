<div class="modal modal-blur fade" id="modal-team" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Nueva transferencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('transfer.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3 align-items-end">
                        <div class="col" style="display: none;">
                            <div class="form-floating">
                                <input type="text" maxlength="35" name="transfer_code" value="{{ $generatedCode }}"
                                    id="transfer_code" class="form-control text-uppercase" readonly>
                                <label for="transfer_code">Código de transferencia</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col" style="display: none;">
                            <div class="form-floating">
                                <input type="datetime-local" name="transfer_date" style="font-size: 10px;"
                                    value="{{Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s')}}"
                                    id="transfer_date"
                                    min="{{Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s')}}"
                                    max="{{Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s')}}"
                                    class="form-control @error('transfer_date') is-invalid @enderror" readonly />
                                @error('transfer_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label class="form-label" for="transfer_date"><small>Fecha de
                                        transferencia</small></label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <select class="form-select" id="investor_id" name="investor_id" style="width: 100%;">
                                    @foreach ($investors as $investor)
                                        <option value="{{ $investor->id }}" {{ old('investor_id') == $investor->id ? 'selected' : '' }}>
                                            {{ $investor->investor_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="investor_id">Inversionistas</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <select name="transfer_bank" id="select-optgroups"
                                    class="form-control @error('transfer_bank') is-invalid @enderror"
                                    autocomplete="off">
                                    <optgroup label="Otros métodos">
                                        @foreach(['EFECTIVO', 'FONDOS', 'REMESAS', 'TARJETA'] as $method)
                                            <option value="{{ $method }}">{{ $method }}</option>
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Bancos">
                                        @foreach(['BAC CREDOMATIC', 'BANCO ATLÁNTIDA', 'BANCO AZTECA DE HONDURAS', 'BANCO CUSCATLAN HONDURAS', 'BANCO DE AMÉRICA CENTRAL HONDURAS', 'BANCO DE DESARROLLO RURAL HONDURAS', 'BANCO DE HONDURAS', 'BANCO DE LOS TRABAJADORES', 'BANCO DE OCCIDENTE', 'BANCO DAVIVIENDA HONDURAS', 'BANCO FINANCIERA CENTROAMERICANA', 'BANCO FINANCIERA COMERCIAL HONDUREÑA', 'BANCO HONDUREÑO DEL CAFÉ', 'BANCO LAFISE HONDURAS', 'BANCO DEL PAÍS', 'BANCO POPULAR', 'BANCO PROMÉRICA'] as $bank)                                            <option value="{{ $bank }}">{{ $bank }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                                @error('transfer_bank')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span class="invalid-feedback" role="alert" id="transfer-bank-error"
                                    style="display: none;">
                                    <strong></strong>
                                </span>
                                <label for="transfer_bank">Banco / Modo de transferencia</label>
                            </div>
                        </div>
                        
                        <div class="col">
                            <div class="form-floating">
                                <input type="number" step="any" name="transfer_amount"
                                    value="{{ old('transfer_amount') }}" id="transfer_amount"
                                    class="form-control @error('transfer_amount') is-invalid @enderror" />
                                @error('transfer_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="transfer_amount">Monto de transferencia</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <textarea class="form-control @error('transfer_comment') is-invalid @enderror"
                                    autocomplete="off" maxlength="255" name="transfer_comment" id="transfer_comment"
                                    style="resize: none; height: 100px">{{ old('transfer_comment') }}</textarea>
                                @error('transfer_comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="transfer_comment">Comentarios</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="file" accept="image/*" class="form-control @error('transfer_img') is-invalid @enderror" id="transfer_img" name="transfer_img" alt="transfer-proof">
                                <label for="transfer_img">Comprobante de transferencia</label>
                                <span class="invalid-feedback" role="alert" id="transfer-img-error"
                                    style="display: none;">
                                    <strong></strong>
                                </span>
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