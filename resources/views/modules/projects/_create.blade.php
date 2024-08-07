<div class="modal modal-blur fade" id="modal-team" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Agregar nuevo proyecto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="projectForm" action="{{ route('project.store')}}" method="POST" enctype="multipart/form-data">
                    <!-- Step 1 General data -->
                    <fieldset>
                        @csrf
                        <h4 class="text-center text-muted">
                            <img style="filter: invert(44%) sepia(11%) saturate(0%) hue-rotate(225deg) brightness(99%) contrast(85%);" src="{{ asset('../static/svg/circle-number-1.svg') }}" width="24" height="24">
                            Datos generales del proyecto
                            <span style="float: right; font-size: clamp(0.6rem, 6vh, 0.7rem)">Paso 1/4</span>
                        </h4>
                        <div class="row mb-3 align-items-end">
                            <div class="col" style="display: none">
                                <div class="form-floating">
                                    <div class="card-status-start bg-primary"></div>
                                    <input type="text" readonly
                                        class="form-control @error('project_code') is-invalid @enderror"
                                        id="project_code" name="project_code" value="{{ $generatedCode }}"
                                        autocomplete="off" minlength="12" maxlength="12"
                                        style="text-transform: uppercase; color: #52524E; font-size: clamp(0.7rem, 3vw, 0.8rem)">
                                    @error('project_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label for="project_code">Código de proyecto</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" name="project_name" value="{{ old('project_name') }}"
                                        id="project_name"
                                        class="form-control @error('project_name') is-invalid @enderror"
                                        autocomplete="off" maxlength="55"
                                        oninput="this.value = this.value.toUpperCase()" />
                                    @error('project_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span class="invalid-feedback" role="alert" id="project-name-error"
                                        style="display: none;">
                                        <strong></strong>
                                    </span>
                                    <label for="project_name"><small>Nombre del
                                            proyecto</small></label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <input type="date" name="project_start_date" value="{{ old('project_start_date') }}"
                                        id="project_start_date"
                                        class="form-control @error('project_start_date') is-invalid @enderror"
                                        onchange="validateStep1()" />
                                    @error('project_start_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span class="invalid-feedback" role="alert" id="start-date-error"
                                        style="display: none;">
                                        <strong></strong>
                                    </span>
                                    <label for="project_start_date"><small>Fecha inicial del
                                            proyecto</small></label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-end">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="date" name="project_end_date" value="{{ old('project_end_date') }}"
                                        id="project_end_date"
                                        class="form-control @error('project_end_date') is-invalid @enderror"
                                        min="{{ \Carbon\Carbon::now()->addDays(1)->toDateString() }}"
                                        onchange="validateStep1()" />
                                    @error('project_end_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span class="invalid-feedback" role="alert" id="end-date-error"
                                        style="display: none;">
                                        <strong></strong>
                                    </span>
                                    <label for="project_end_date"><small>Fecha de cierre del
                                            proyecto</small></label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <div class="card-status-start bg-primary"></div>
                                    <input type="text" id="project_work_days" name="project_work_days"
                                        value="{{old('project_work_days')}}" class="form-control" readonly
                                        onchange="validateStep1()">
                                    @error('project_end_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label for="project_work_days"><small>Días de
                                            trabajo</small></label>
                                </div>
                                <span class="invalid-feedback" role="alert" id="work-days-error" style="display: none;">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                    </fieldset>

                    <!-- Step 2 Transfer -->
                    <fieldset>
                        <h4 class="text-center text-muted">
                            <img style="filter: invert(44%) sepia(11%) saturate(0%) hue-rotate(225deg) brightness(99%) contrast(85%);" src="{{ asset('../static/svg/circle-number-2.svg') }}" width="24" height="24">
                            Depósito del proyecto
                            <span style="float: right; font-size: clamp(0.6rem, 6vh, 0.7rem)">Paso 2/4</span>
                        </h4>

                        <div class="row mb-3 align-items-end">
                            <div class="col" style="display: none">
                                <div class="form-floating">
                                    <div class="card-status-start bg-primary"></div>
                                    <input type="text" maxlength="12" minlength="12" name="transfer_code"
                                        value="{{ $generatedCode }}" id="transfer_code"
                                        class="form-control text-uppercase" readonly>
                                    <label for="transfer_code">Código de transferencia</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-floating">
                                    <select class="form-select" id="investor_id" name="investor_id" style="width: 100%;" required onchange="updateInvestor()">
                                        <option value="" selected disabled>Seleccione un inversionista</option>
                                        @foreach ($availableInvestors as $investor)
                                            <option value="{{ $investor->id }}" data-balance="{{ $investor->investor_balance }}" {{ old('investor_id') == $investor->id ? 'selected' : '' }}>
                                                {{ $investor->investor_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="investor_id">Inversionistas</label>
                                    <span class="invalid-feedback" role="alert" id="investor-id-error" style="display: none;">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-floating">
                                    <input type="number" id="investor_balance" name="investor_balance" class="form-control @error('investor_balance') is-invalid @enderror" autocomplete="off" readonly value="">
                                    <input type="hidden" id="investor_balance_history" name="investor_balance_history" class="form-control" value="" readonly>
                                    @error('investor_balance')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span class="invalid-feedback" role="alert" id="investor-balance-error"
                                        style="display: none;">
                                        <strong></strong>
                                    </span>
                                    <label for="investor_balance">Fondo actual</label>
                                </div>
                            </div>

                            <div class="col" style="width: 35vh; display: none">
                                <div class="form-floating">
                                    <select name="transfer_bank" id="transfer_bank" class="form-control select2-transferBank" style="width: 35vh">
                                        <option value="" selected disabled>Seleccione un banco</option>
                                        <optgroup label="Otros métodos">
                                            <option value="FONDOS" selected>FONDOS</option>
                                        </optgroup>
                                    </select>
                                    <label for="transfer_bank">Banco / Modo de transferencia</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-floating">
                                    <input type="number" min="0" value="" name="transfer_amount" id="transfer_amount"
                                        class="form-control @error('transfer_amount') is-invalid @enderror"/>
                                    @error('transfer_amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span class="invalid-feedback" role="alert" id="transfer-amount-error"
                                        style="display: none;">
                                        <strong></strong>
                                    </span>
                                    <label for="transfer_amount">Fondo a capital</label>
                                </div>
                            </div>                            
                        </div>

                        <div class="row mb-3 align-items-end">
                            <div class="col" style="display: none;">
                                <div class="form-floating">
                                    <div class="card-status-start bg-primary"></div>
                                    <input type="datetime-local" name="transfer_date"
                                        value="{{ $todayDate }}"
                                        id="transfer_date"
                                        min="{{ $todayDate }}"
                                        max="{{ $todayDate }}"
                                        class="form-control @error('transfer_date') is-invalid @enderror" />
                                    @error('transfer_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label for="transfer_date"><small>Fecha de
                                            transferencia</small></label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-end">
                            <div class="col">
                                <div class="form-floating">
                                    <textarea maxlength="255"
                                        class="form-control @error('transfer_comment') is-invalid @enderror"
                                        autocomplete="off" maxlength="255" name="transfer_comment" id="transfer_comment"
                                        style="resize: none; height: 100px" oninput="this.value = this.value.toUpperCase()">{{ old('transfer_comment')}}</textarea>
                                    @error('transfer_comment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span class="invalid-feedback" role="alert" id="transfer-comment-error"
                                        style="display: none;">
                                        <strong></strong>
                                    </span>
                                    <label for="transfer_comment">Comentarios</label>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <!-- Step 3 Investor / Commission agent select -->
                    <fieldset>
                        <h4 class="text-center text-muted">
                            <img style="filter: invert(44%) sepia(11%) saturate(0%) hue-rotate(225deg) brightness(99%) contrast(85%);" src="{{ asset('../static/svg/circle-number-3.svg') }}" width="24" height="24">
                            Integrantes del proyecto
                            <span style="float: right; font-size: clamp(0.6rem, 6vh, 0.7rem)">Paso 3/4</span>
                        </h4>
                        <input type="hidden" name="project_status" value="1">

                        <!-- Project's selected investor -->
                        <div class="row mb-3 alig-items-end">
                            <div class="col-11">
                                <div class="form-floating">
                                    <select class="form-select select2-investors" id="investor_select"
                                        style="font-size: clamp(0.6rem, 3vh, 0.8rem);">
                                        <option value="" selected disabled>Seleccione un inversionista</option>
                                        @foreach ($investors as $investor)
                                            <option value="{{ $investor->id }}" {{ old('investor_select') == $investor->id ? 'selected' : '' }}>
                                                {{ $investor->investor_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="investor_select">Inversionistas</label>
                                </div>
                            </div>
                            
                            <div class="col-1">
                                <button type="button" class="btn btn-red mt-3 text-white" id="add_investor_button_container"
                                    style="margin-bottom: 5px; border: none; padding: 5px 10px 5px 5px">
                                    &nbsp;<img style="filter: invert(100%) sepia(0%) saturate(7485%) hue-rotate(207deg) brightness(103%) contrast(103%);" src="{{ asset('../static/svg/user-plus.svg') }}" width="20" height="20">
                                </button>
                            </div>
                        </div>

                        <table class="table table-bordered" id="project_investors_table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>INVERSIONISTAS DEL PROYECTO</th>
                                    <th>CAPITAL DE INVERSIÓN</th>
                                    <th>GANANCIA TOTAL DEL PROYECTO</th>
                                    <th>GANANCIA FINAL INVERSIONISTA</th>
                                    <th style="width: 50px">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dinamically row creation -->
                            </tbody>
                        </table>
                        
                        <div class="row mb-3 alig-items-end">
                            <div class="col-11">
                                <div class="form-floating">
                                    <select class="form-select select2-commissioners" id="commissioner_select"
                                        style="font-size: clamp(0.6rem, 3vh, 0.8rem);">
                                        <option value="" selected disabled>Seleccione un comisionista</option>
                                        @foreach ($commissioners as $commissioner)
                                            <option value="{{ $commissioner->id }}" {{ old('commissioner_select') == $commissioner->id ? 'selected' : '' }}>
                                                {{ $commissioner->commissioner_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="commissioner_select">Comisionistas</label>
                                </div>
                            </div>
                            <div class="col-1">
                                <button type="button" class="btn btn-primary mt-3 text-white" id="add_button_container"
                                    onclick="addCommissioner()"
                                    style="margin-bottom: 5px; border: none; padding: 5px 10px 5px 5px">
                                    &nbsp;<img style="filter: invert(100%) sepia(0%) saturate(7485%) hue-rotate(207deg) brightness(103%) contrast(103%);" src="{{ asset('../static/svg/users-plus.svg') }}" width="20" height="20">
                                </button>
                            </div>
                        </div>

                        <div class="row mb-3 mt-3 align-items-end">
                            <div class="col-12">
                                <!-- Project's selected investor -->
                                <table class="table table-bordered table-striped" id="project_commissioners_table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>COMISIONISTAS DEL PROYECTO</th>
                                            <th>COMISIÓN TOTAL</th>
                                            <th style="width: 50px">ACCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>JUNOR AYALA</td>
                                            <td>
                                                <input type="number" name="commissioner_commission[]"
                                                    id="commissioner_commission_jr"
                                                    style="font-size: clamp(0.6rem, 6vh, 0.68rem)"
                                                    placeholder="Comisión total del comisionista" min="1"
                                                    class="form-control" required readonly>
                                                <input type="hidden" name="commissioner_id[]" value="1">
                                                <span class="invalid-feedback" role="alert"
                                                    id="commissioner-commission-jr-error" style="display: none;">
                                                    <strong></strong>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-red text-bold">Acción no disponible</span>
                                            </td>
                                        </tr>
                                        <!-- Dinamically row creation -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </fieldset>

                    <!-- Step 4 Comment -->
                    <fieldset>
                        <h4 class="text-center text-muted">
                            <img style="filter: invert(44%) sepia(11%) saturate(0%) hue-rotate(225deg) brightness(99%) contrast(85%);" src="{{ asset('../static/svg/circle-number-4.svg') }}" width="24" height="24">
                            Comentarios adicionales (Comentario del excel)
                            <span style="float: right; font-size: clamp(0.6rem, 6vh, 0.7rem)">Paso 4/4</span>
                        </h4>
                        <div class="row mb-3 align-items-end">
                            <div class="col">
                                <div class="form-floating">
                                    <textarea maxlength="255" style="overflow: hidden; height: 100px; resize: none"
                                        name="project_comment" id="project_comment"
                                        class="form-control @error('project_comment') is-invalid @enderror"
                                        autocomplete="off" oninput="this.value = this.value.toUpperCase()">{{ old('project_comment') }}</textarea>
                                    @error('project_comment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <span class="invalid-feedback" role="alert" id="project-comment-error"
                                        style="display: none;">
                                        <strong></strong>
                                    </span>
                                    <label for="project_comment"><small>Comentarios adicionales al
                                            proyecto</small></label>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <!-- Buttons -->
                    <button type="button" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" class="btn btn-dark me-auto"
                        id="prevBtn">Paso anterior</button>
                    <button type="button" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" class="btn btn-orange"
                        id="nextBtn">Siguiente paso</button>
                    <button type="submit" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" class="btn btn-teal"
                        id="submitBtn" style="display: none;">Guardar nuevo proyecto</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('customjs/projects/work_days_calculate.js') }}"></script>
<script src="{{ asset('customjs/projects/investors.js') }}"></script>
<script src="{{ asset('customjs/projects/commissioners.js') }}"></script>
<script src="{{ asset('customjs/projects/calculations.js') }}"></script>
<script src="{{ asset('customjs/investors/investor_balance.js') }}"></script>
