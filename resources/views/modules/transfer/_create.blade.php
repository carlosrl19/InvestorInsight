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
                                <input type="text" maxlength="35" name="transfer_code"  value="{{ old('transfer_code') }}" id="transfer_code" class="form-control @error('transfer_code') is-invalid @enderror" autocomplete="off"/>
                                @error('transfer_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="transfer_code">Código de transferencia</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="text" maxlength="30" name="transfer_bank" value="{{ old('transfer_bank') }}" id="transfer_bank" class="form-control @error('transfer_bank') is-invalid @enderror" autocomplete="off"/>
                                @error('transfer_bank')investor_name
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="transfer_bank">Banco / Modo de transferencia</label>
                            </div>
                        </div>
                        <input type="hidden" name="investor_status" value="1">
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="date" name="transfer_date" style="font-size: 10px;" value="{{ \Carbon\Carbon::now()->toDateString() }}" id="transfer_date" class="form-control @error('project_name') is-invalid @enderror" min="{{ \Carbon\Carbon::now()->toDateString() }}" max="{{ \Carbon\Carbon::now()->toDateString() }}" readonly/>
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
                            <select type="text" name="investor_id" class="form-select" style="font-size: clamp(0.6rem, 3vh, 0.7rem);">
                                <option selected disabled>Seleccione el inversionista</option>
                                @foreach ($investors as $investor)                                    
                                    <option value="{{ $investor->id }}">{{ $investor->investor_name }}</option>
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