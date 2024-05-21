<div class="modal modal-blur fade" id="modal-team" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Nueva transferencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('transfer.store')}}" method="POST">
                    @csrf
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" maxlength="35" name="transfer_code" value="{{ $generatedCode }}" id="transfer_code" class="form-control text-uppercase" readonly>
                                <label for="transfer_code">Código de transferencia</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <select name="transfer_bank" id="select-optgroups" class="form-control @error('transfer_bank') is-invalid @enderror" autocomplete="off">
                                    <optgroup label="Bancos">
                                        <option value="Banco Atlántida">Banco Atlántida</option>
                                        <option value="Banco Azteca de Honduras">Banco Azteca de Honduras</option>
                                        <option value="Banco de América Central Honduras">Banco de América Central Honduras</option>
                                        <option value="Banco de Desarrollo Rural Honduras">Banco de Desarrollo Rural Honduras</option>
                                        <option value="Banco de Honduras">Banco de Honduras</option>
                                        <option value="Banco de Los Trabajadores">Banco de Los Trabajadores</option>
                                        <option value="Banco de Occidente">Banco de Occidente</option>
                                        <option value="Banco Davivienda Honduras">Banco Davivienda Honduras</option>
                                        <option value="Banco Financiera Centroamericana">Banco Financiera Centroamericana</option>
                                        <option value="Banco Financiera Comercial Hondureña">Banco Financiera Comercial Hondureña</option>
                                        <option value="Banco Hondureño del Café">Banco Hondureño del Café</option>
                                        <option value="Banco Lafise Honduras">Banco Lafise Honduras</option>
                                        <option value="Banco del País">Banco del País</option>
                                        <option value="Banco Popular">Banco Popular</option>
                                        <option value="Banco Promérica">Banco Promérica</option>
                                    </optgroup>
                                    <optgroup label="Otros métodos">
                                        <option value="PayPal">PayPal</option>
                                        <option value="Efectivo">Efectivo</option>
                                        <option value="Otro">Otro</option>
                                    </optgroup>
                                </select>
                                @error('transfer_bank')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="transfer_bank">Banco / Modo de transferencia</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="datetime-local" 
                                    name="transfer_date" 
                                    style="font-size: 10px;" 
                                    value="{{Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s')}}"
                                    id="transfer_date"
                                    min="{{Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s')}}"
                                    max="{{Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s')}}"
                                    class="form-control @error('transfer_date') is-invalid @enderror" 
                                    readonly />
                                @error('transfer_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label class="form-label" for="transfer_date"><small>Fecha de transferencia</small></label>
                            </div>
                        </div>
                        <div class="col" style="border: 1px solid lightgray; border-radius: 2px">
                            <label for="investor_id" class="mb-2" style="font-size: clamp(0.6rem, 3vh, 0.6rem); color: gray">Inversionistas</label>
                            <select class="form-select select2-investors" name="investor_id" id="investor_select" style="font-size: clamp(0.6rem, 3vh, 0.7rem); width: 100%">
                                <option></option>
                                @foreach ($investors as $investor)
                                    @if($investor->investor_status == 1)
                                        <option value="{{ $investor->id }}">{{ $investor->investor_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="number" step="any" name="transfer_amount" value="{{ old('transfer_amount') }}" id="transfer_amount" class="form-control @error('transfer_amount') is-invalid @enderror"/>
                                @error('transfer_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="transfer_amount">Monto de transferencia</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <textarea class="form-control @error('transfer_description') is-invalid @enderror" autocomplete="off" maxlength="255" name="transfer_description" id="transfer_description" data-bs-toggle="autosize"> </textarea>
                                @error('transfer_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="transfer_description">Comentarios</label>
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