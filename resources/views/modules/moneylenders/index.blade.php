@extends('layout.admin')

@section('head')

<!-- Datatable CSS -->
<link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/datatables/css/buttons.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/datatable.css') }}" rel="stylesheet">

@endsection

@section('pretitle')
Listado principal <small>({{ number_format($loadTime, 2) }} segundos)</small>
@endsection

@section('title')
Prestamistas
@endsection

@section('create')
<a href="#" class="btn btn-primary" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" data-bs-toggle="modal"
    data-bs-target="#modal-team">
    + Nuevo prestamista
</a>
@endsection

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show"
        style="margin-right: 10vh; margin-left: 10vh; font-size: clamp(0.6rem, 3.2vw, 0.8rem);" role="alert"
        data-auto-dismiss="4000">
        <strong>{{ session('success') }}</strong>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible" alert-dismissible fade show"
        style="margin-right: 10vh; margin-left: 10vh; font-size: clamp(0.6rem, 3.2vw, 0.8rem);" role="alert"
        data-auto-dismiss="10000">
        <strong>El formulario contiene los siguientes errores:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container-xl">
    <div class="card">
        <div class="card-body">
            <table id="moneylenders" class="display table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>NOMBRE <br>PRESTAMISTA</th>
                        <th>EMPRESA <br>AFILIADA</th>
                        <th>Nº IDENTIDAD</th>
                        <th>Nº TELEFONO</th>
                        <th style="width: 8vh">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($moneylenders as $i => $moneylender)
                        <tr class="text-center">
                            <td>
                                <a href="{{ route('moneylender.show', $moneylender) }}">{{ $moneylender->moneylender_name }}
                                    <small>
                                        <sup>
                                            <img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);"
                                                src="{{ asset('../static/svg/link.svg') }}" width="20" height="20" alt="">
                                        </sup>
                                    </small>
                                </a>
                            </td>
                            <td>{{ $moneylender->moneylender_company_name }}</td>
                            <td>{{ $moneylender->moneylender_dni }}</td>
                            <td>{{ $moneylender->moneylender_phone }}</td>
                            <td>
                                @include('modules.moneylenders._delete')
                                <div class="btn-list flex-nowrap">
                                    <div class="dropdown">
                                        <button class="btn btn-sm dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                            Acciones
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <!-- Modification's option -->
                                            <small class="text-muted dropdown-item">Modificaciones</small>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#modal-update-{{ $moneylender->id }}">
                                                <img style="filter: invert(42%) sepia(9%) saturate(0%) hue-rotate(136deg) brightness(99%) contrast(93%);"
                                                    src="{{ asset('../static/svg/edit.svg') }}" width="20" height="20"
                                                    alt="">
                                                &nbsp;Actualizar información
                                            </a>

                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#modal-loan-create-{{ $moneylender->id }}">
                                                <img style="filter: invert(42%) sepia(9%) saturate(0%) hue-rotate(136deg) brightness(99%) contrast(93%);"
                                                    src="{{ asset('../static/svg/credit-card.svg') }}" width="20"
                                                    height="20" alt="">
                                                &nbsp;Nuevo préstamo
                                            </a>

                                            <a class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $moneylender->id }}">
                                                <img style="filter: invert(39%) sepia(68%) saturate(5311%) hue-rotate(342deg) brightness(94%) contrast(90%);"
                                                    src="{{ asset('../static/svg/trash.svg') }}" width="20" height="20"
                                                    alt="">
                                                &nbsp;Eliminar prestamista
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Update moneylenders modal -->
                        <div class="modal modal-blur fade" id="modal-update-{{ $moneylender->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                <div class="modal-content" style="border: 2px solid #52524E">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar prestamista</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST"
                                            action="{{ route('moneylender.update', ['moneylender' => $moneylender->id]) }}"
                                            novalidate>
                                            @method('PUT')
                                            @csrf
                                            <div class="row mb-3 align-items-end">
                                                <div class="col">
                                                    <div class="form-floating">
                                                        <input type="text" maxlength="55"
                                                            oninput="this.value = this.value.toUpperCase().replace(/[^A-Z\s]/g, '')"
                                                            value="{{ $moneylender->moneylender_name }}"
                                                            name="moneylender_name"
                                                            id="moneylender_name_{{ $moneylender->id }}"
                                                            class="form-control @error('moneylender_name') is-invalid @enderror"
                                                            placeholder="Ingrese el nombre del prestamista"
                                                            autocomplete="off" />
                                                        @error('moneylender_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <label for="moneylender_name_{{ $moneylender->id }}">Nombre del
                                                            prestamista</label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-floating">
                                                        <input type="text"
                                                            oninput="this.value = this.value.toUpperCase().replace(/\s/g, '')"
                                                            maxlength="13" value="{{ $moneylender->moneylender_dni }}"
                                                            name="moneylender_dni"
                                                            id="moneylender_dni_{{ $moneylender->id }}"
                                                            class="form-control @error('moneylender_dni') is-invalid @enderror"
                                                            placeholder="Ingrese el número de identidad"
                                                            autocomplete="off" />
                                                        @error('moneylender_dni')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <label for="moneylender_dni_{{ $moneylender->id }}">Nº
                                                            identidad</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3 align-items-end">
                                                <div class="col">
                                                    <div class="form-floating">
                                                        <select type="text" class="form-select"
                                                            id="select-optgroups-{{ $moneylender->id }}"
                                                            name="moneylender_company_name"
                                                            style="font-size: clamp(0.7rem, 3vh, 0.8rem);">
                                                            <option value="ROBENIOR" {{ (old('moneylender_company_name') ?? $moneylender->moneylender_company_name) == 'ROBENIOR' ? 'selected' : '' }}>ROBENIOR</option>
                                                            <option value="MARSELLA" {{ (old('moneylender_company_name') ?? $moneylender->moneylender_company_name) == 'MARSELLA' ? 'selected' : '' }}>MARSELLA</option>
                                                            <option value="JAGUER" {{ (old('moneylender_company_name') ?? $moneylender->moneylender_company_name) == 'JAGUER' ? 'selected' : '' }}>JAGUER</option>
                                                            <option value="FUTURE CAPITAL" {{ (old('moneylender_company_name') ?? $moneylender->moneylender_company_name) == 'FUTURE CAPITAL' ? 'selected' : '' }}>FUTURE CAPITAL</option>
                                                        </select>
                                                        @error('moneylender_company_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <label for="moneylender_company_name_{{ $moneylender->id }}">Empresa
                                                            afiliada</label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-floating">
                                                        <input type="text" minlength="8" maxlength="11"
                                                            oninput="this.value = this.value.replace(/\D/g, '')"
                                                            name="moneylender_phone"
                                                            value="{{ $moneylender->moneylender_phone }}"
                                                            id="moneylender_phone_{{ $moneylender->id }}"
                                                            class="form-control @error('moneylender_phone') is-invalid @enderror"
                                                            autocomplete="off" />
                                                        @error('moneylender_phone')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <label for="moneylender_phone_{{ $moneylender->id }}">Nº
                                                            teléfono</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="{{ route('moneylender.index') }}"
                                                class="btn btn-dark me-auto">Volver</a>
                                            <button type="submit" class="btn btn-teal">Guardar cambios</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Moneylender loan modal -->
                        <div class="modal modal-blur fade" id="modal-loan-create-{{ $moneylender->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content" style="border: 2px solid #52524E">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Nuevo préstamo</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('moneylender_loans.store')}}" method="POST">
                                            @csrf
                                            
                                            <input type="hidden" value="1" name="commissioner_id" id="commissioner_id">
                                            <input type="hidden" value="{{ $loanCode }}" name="loan_code" id="loan_code">

                                            <div class="row mb-3 align-items-end">
                                                <div class="col-4">
                                                    <div class="form-floating">
                                                        <input type="text" readonly
                                                            value="{{ $moneylender->id }}"
                                                            name="moneylender_id"
                                                            id="moneylender_id"
                                                            class="form-control @error('moneylender_id') is-invalid @enderror"
                                                            autocomplete="off" style="font-size: clamp(0.6rem, 3vw, 0.7rem); border-left: 2px solid gray;"/>
                                                        @error('moneylender_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <label for="moneylender_id">Nombre del prestamista</label>
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-floating">
                                                        <input type="date" readonly class="form-control" value="{{ $todayDate }}" name="loan_emission_date" id="loan_emission_date" style="font-size: clamp(0.6rem, 3vw, 0.7rem); border-left: 2px solid gray;">
                                                        @error('loan_emission_date')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <label for="loan_emission_date">Fecha actual</label>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-4">
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control" name="loan_first_paydate" id="loan_first_paydate" style="font-size: clamp(0.6rem, 3vw, 0.7rem);">
                                                        @error('loan_first_paydate')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <label for="loan_first_paydate">Fecha primer pago <sup class="text-red">*</sup></label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3 align-items-end">
                                                <div class="col-4">
                                                    <div class="form-floating">
                                                        <input type="number" min="1"
                                                            name="loan_amount"
                                                            id="loan_amount"
                                                            class="form-control @error('loan_amount') is-invalid @enderror"
                                                            autocomplete="off" style="font-size: clamp(0.6rem, 3vw, 0.7rem);"/>
                                                        @error('loan_amount')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <label for="loan_amount">Monto a prestar ( Lps. ) <sup class="text-red">*</sup></label>
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-floating">
                                                        <input type="number" min="0" max="100"
                                                            name="loan_tax"
                                                            id="loan_tax"
                                                            class="form-control @error('loan_tax') is-invalid @enderror"
                                                            autocomplete="off" style="font-size: clamp(0.6rem, 3vw, 0.7rem);"/>
                                                        @error('loan_tax')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <label for="loan_tax">Interes ( % ) <sup class="text-red">*</sup></label>
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-floating">
                                                        <input type="number" min="1" readonly
                                                            name="loan_total_amount"
                                                            id="loan_total_amount"
                                                            class="form-control @error('loan_total_amount') is-invalid @enderror"
                                                            autocomplete="off" style="font-size: clamp(0.6rem, 3vw, 0.7rem); border-left: 2px solid gray;"/>
                                                        @error('loan_total_amount')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <label for="loan_tax">Total a pagar ( Lps. )</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3 align-items-end">
                                                <div class="col-6">
                                                    <div class="form-floating">
                                                        <input type="number" min="1" value="1"
                                                            name="loan_quotas"
                                                            id="loan_quotas"
                                                            class="form-control @error('loan_quotas') is-invalid @enderror"
                                                            autocomplete="off" style="font-size: clamp(0.6rem, 3vw, 0.7rem);"/>
                                                        @error('loan_quotas')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <label for="loan_tax">Cuotas ( Nº ) <sup class="text-red">*</sup></label>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-floating">
                                                        <input type="number"
                                                            name="loan_quota_amount" 
                                                            id="loan_quota_amount"
                                                            class="form-control @error('loan_quota_amount') is-invalid @enderror"
                                                            autocomplete="off" style="font-size: clamp(0.6rem, 3vw, 0.7rem); border-left: 2px solid gray;"/>
                                                        @error('loan_quota_amount')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <label for="loan_quota_amount">Total a pagar por cuota ( Lps. )</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3 align-items-end">
                                                <div class="col">
                                                    <div class="form-floating">
                                                        <textarea oninput="this.value = this.value.toUpperCase()" maxlength="255" style="overflow: hidden; height: 100px; resize: none" class="form-control @error('loan_description') is-invalid @enderror" autocomplete="off" name="loan_description" id="loan_description"> </textarea>
                                                        @error('loan_description')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <label for="loan_description">Descripción / Comentarios sobre el préstamo</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <a href="{{ route('moneylender.index') }}"
                                                class="btn btn-dark me-auto">Volver</a>
                                            <button type="submit" class="btn btn-teal">Guardar cambios</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('modules.moneylenders._create')

@endsection

@section('scripts')

<!-- Alert fade closer script-->
<script src="{{ asset('customjs/alert_closer.js')}}"></script>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('customjs/datatable/dt_moneylender.js') }}"></script>
<script src="{{ asset('customjs/datatable/dt_moneylender_funds.js') }}"></script>

<!-- PDF view -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Validation to max in loan_tax -->
<script>
    document.getElementById('loan_tax').addEventListener('input', function() {
        const value = parseInt(this.value);

        // Verifica si el valor ingresado es mayor que 100
        if (value > 100) {
            this.value = 100; // Opcional: establece el valor máximo permitido
        }
    });
</script>

<!-- Get loan_total_amount input automatically -->
<script>
    // Selecciona elementos por su ID
    const loanInput = document.querySelector("#loan_amount");
    const taxInput = document.querySelector("#loan_tax");
    const totalOutput = document.querySelector("#loan_total_amount");
    const quotaField = document.querySelector("#loan_quotas");
    const quotaAmountField = document.querySelector("#loan_quota_amount");

    // Event listeners para los campos de entrada
    [loanInput, taxInput, quotaField].forEach(input => input.addEventListener("input", updateCalculations));

    function updateCalculations() {
        const loan = parseFloat(loanInput.value) || 0;
        const tax = parseFloat(taxInput.value) || 0;
        const quotas = parseInt(quotaField.value) || 1;

        // Calcular el loan_total_amount con impuestos
        const loan_total_amount = loan + loan * (tax / 100);
        totalOutput.value = loan_total_amount.toFixed(2);

        // Calcular el monto de la cuota
        const quotaAmount = loan_total_amount / quotas;
        quotaAmountField.value = quotaAmount.toFixed(2);
    }

    // Inicializa el loan_total_amount y la cuota al cargar la página
    updateCalculations();
</script>
@endsection