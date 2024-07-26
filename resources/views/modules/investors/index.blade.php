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
Inversionistas
@endsection

@section('create')
<a href="#" class="btn btn-primary" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" data-bs-toggle="modal" data-bs-target="#modal-team">
    + Nuevo inversionista
</a>
@endsection

@section('content')

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" style="margin-right: 10vh; margin-left: 10vh; font-size: clamp(0.6rem, 3.2vw, 0.8rem);" role="alert" data-auto-dismiss="4000">
        <strong>{{ session('success') }}</strong>
    </div>
    @endif
    
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible" alert-dismissible fade show" style="margin-right: 10vh; margin-left: 10vh; font-size: clamp(0.6rem, 3.2vw, 0.8rem);" role="alert" data-auto-dismiss="10000">
        <strong>El formulario contiene los siguientes errores:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="container-xl">
        <div class="card mb-2">
            <div class="card-body">
               <div id="search-filters-container">FILTROS</div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="example" class="display table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>ID</th>
                            <th>NOMBRE <br>INVERSIONISTA</th>
                            <th>EMPRESA <br>AFILIADA</th>
                            <th>Nº IDENTIDAD</th>
                            <th>Nº TELEFONO</th>
                            <th>FONDO MONETARIO</th>
                            <th>RECOMENDACION</th>
                            <th>ESTADO</th>
                            <th style="width: 8vh">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($investors as $i => $investor)
                            <tr class="text-center">
                                <td>{{ $i++ }}</td>
                                <td>
                                    <a href="{{ route('investor.show', $investor) }}">{{ $investor->investor_name }}
                                        <small>
                                            <sup>
                                                <img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="{{ asset('../static/svg/link.svg') }}" width="20" height="20" alt="">
                                            </sup>
                                        </small>
                                    </a>
                                </td>
                                <td>{{ $investor->investor_company_name }}</td>
                                <td>{{ $investor->investor_dni }}</td>
                                <td>{{ $investor->investor_phone }}</td>

                                @if($investor->investor_balance <= 0)
                                    <td><span class="text-light badge bg-red">Lps. {{ number_format($investor->investor_balance,2) }}</span></td>
                                @else
                                    <td>Lps. {{ number_format($investor->investor_balance,2) }}</td>
                                @endif

                                <td>
                                    @if($investor->investor_reference)
                                        <a href="{{ route('investor.show', ['investor' => $investor->investor_reference->id]) }}">
                                            {{ $investor->investor_reference->investor_name }}
                                            <small>
                                                <sup>
                                                    <img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="{{ asset('../static/svg/link.svg') }}" width="20" height="20" alt="">
                                                </sup>
                                            </small>
                                        </a>
                                    @else
                                        <strong class="text-red">Sin recomendación</strong>
                                    @endif
                                </td>
                                <td>
                                    @if($investor->investor_status == '1')
                                        <span class="badge bg-success me-1"></span> Disponible
                                    @elseif($investor->investor_status == '0')
                                        <span class="badge bg-orange me-1"></span> <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Habilite todas las acciones cambiando la disposición del inversionista a proyectos a 'Disponible' en el apartado de 'Actualizar información'.">No disponible</span>
                                    @elseif($investor->investor_status == '3')
                                        <span class="badge bg-red me-1"></span> <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Habilite todas las acciones cambiando la disposición del inversionista a proyectos a 'Disponible' en el apartado de 'Actualizar información'.">Liquidado / No disponible</span>
                                    @else
                                        <span class="badge bg-red me-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Existe un error en el estado del inversionista."></span> Estado inválido
                                    @endif
                                </td>
                                <td>
                                    @include('modules.investors._delete')
                                    @include('modules.investors._fund')
                                    
                                    @if($investor->id != 1)
                                        @if($investor->investor_status != 3)
                                        <div class="btn-list flex-nowrap">
                                            <div class="dropdown">
                                                <button class="btn btn-sm dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                                    Acciones
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <!-- Modification's option -->
                                                    <small class="text-muted dropdown-item">Modificaciones</small>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-update-{{ $investor->id }}">
                                                        <img style="filter: invert(42%) sepia(9%) saturate(0%) hue-rotate(136deg) brightness(99%) contrast(93%);" src="{{ asset('../static/svg/edit.svg') }}" width="20" height="20" alt="">
                                                        &nbsp;Actualizar información
                                                    </a>

                                                    <!-- 
                                                    @if($investor->investor_status == 1)
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-fund{{ $investor->id }}">
                                                        <img style="filter: invert(42%) sepia(9%) saturate(0%) hue-rotate(136deg) brightness(99%) contrast(93%);" src="{{ asset('../static/svg/coins.svg') }}" width="20" height="20" alt="">
                                                        &nbsp;Agregar fondo
                                                    </a>
                                                    @endif
                                                    -->
                                                    
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $investor->id }}">
                                                        <img style="filter: invert(39%) sepia(68%) saturate(5311%) hue-rotate(342deg) brightness(94%) contrast(90%);" src="{{ asset('../static/svg/trash.svg') }}" width="20" height="20" alt="">
                                                        &nbsp;Eliminar inversionista
                                                    </a>

                                                    <!-- Liquidation's option -->
                                                    @if($investor->investor_balance > 0)
                                                        <small class="text-muted dropdown-item">Liquidación</small>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-liquidate-{{ $investor->id }}">
                                                            <img style="filter: invert(42%) sepia(9%) saturate(0%) hue-rotate(136deg) brightness(99%) contrast(93%);" src="{{ asset('../static/svg/user-down.svg') }}" width="20" height="20" alt="">
                                                            &nbsp;Liquidar inversionista
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="btn-list flex-nowrap">
                                            <div class="dropdown">
                                                <button class="btn btn-sm dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                                    Acciones
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <!-- Modification's option -->
                                                    <small class="text-muted dropdown-item">Modificaciones</small>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-update-{{ $investor->id }}">
                                                        <img style="filter: invert(42%) sepia(9%) saturate(0%) hue-rotate(136deg) brightness(99%) contrast(93%);" src="{{ asset('../static/svg/edit.svg') }}" width="20" height="20" alt="">
                                                        &nbsp;Actualizar información
                                                    </a>

                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $investor->id }}">
                                                        <img style="filter: invert(39%) sepia(68%) saturate(5311%) hue-rotate(342deg) brightness(94%) contrast(90%);" src="{{ asset('../static/svg/trash.svg') }}" width="20" height="20" alt="">
                                                        &nbsp;Eliminar inversionista
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @else
                                    <strong class="text-red">No disponible</strong>
                                    @endif
                                </td>
                            </tr>

                            <!-- Update investors modal -->
                            <div class="modal modal-blur fade" id="modal-update-{{ $investor->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                    <div class="modal-content" style="border: 2px solid #52524E">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Editar inversionista</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('investor.update', ['investor' => $investor->id]) }}" novalidate>
                                                @method('PUT')
                                                @csrf
                                                <div class="row mb-3 align-items-end">
                                                    <div class="col">
                                                        <div class="form-floating">
                                                            <input type="text" maxlength="55" oninput="this.value = this.value.toUpperCase().replace(/[^A-Z\s]/g, '')" value="{{ $investor->investor_name }}" name="investor_name" id="investor_name_{{ $investor->id }}" class="form-control @error('investor_name') is-invalid @enderror" placeholder="Ingrese el nombre del inversionista" autocomplete="off"/>
                                                            @error('investor_name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <label for="investor_name_{{ $investor->id }}">Nombre del inversionista</label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-floating">
                                                            <input type="text" oninput="this.value = this.value.toUpperCase().replace(/\s/g, '')" maxlength="13" value="{{ $investor->investor_dni }}" name="investor_dni" id="investor_dni_{{ $investor->id }}" class="form-control @error('investor_dni') is-invalid @enderror" placeholder="Ingrese el número de identidad" autocomplete="off"/>
                                                            @error('investor_dni')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <label for="investor_dni_{{ $investor->id }}">Nº identidad</label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-floating">
                                                            <select class="form-select js-example-basic-multiple" name="investor_reference_id" style="font-size: clamp(0.6rem, 3vh, 0.8rem); width: 100%">
                                                                @foreach ($investors as $inv)
                                                                    <option value="{{ $inv->id }}" {{ $inv->id == $investor->investor_reference_id ? 'selected' : '' }}>
                                                                        {{ $inv->investor_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('investor_reference_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <label for="investor_reference_id_{{ $investor->id }}">Recomendado por</label>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="investor_status" value="1">
                                                </div>
                                                <div class="row mb-3 align-items-end">
                                                    <div class="col" style="display: none">
                                                        <div class="form-floating">
                                                            <input type="number" value="{{ $investor->investor_balance }}" name="investor_balance" id="investor_balance_{{ $investor->id }}" class="form-control @error('investor_balance') is-invalid @enderror" autocomplete="off"/>
                                                            @error('investor_balance')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <label for="investor_balance_{{ $investor->id }}">Fondo del inversionista</label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-floating">
                                                            <select type="text" class="form-select" id="select-optgroups-{{ $investor->id }}" name="investor_company_name" style="font-size: clamp(0.7rem, 3vh, 0.8rem);">
                                                                <option value="ROBENIOR" {{ (old('investor_company_name') ?? $investor->investor_company_name) == 'ROBENIOR' ? 'selected' : '' }}>ROBENIOR</option>
                                                                <option value="MARSELLA" {{ (old('investor_company_name') ?? $investor->investor_company_name) == 'MARSELLA' ? 'selected' : '' }}>MARSELLA</option>
                                                                <option value="JAGUER" {{ (old('investor_company_name') ?? $investor->investor_company_name) == 'JAGUER' ? 'selected' : '' }}>JAGUER</option>
                                                                <option value="FUTURE CAPITAL" {{ (old('investor_company_name') ?? $investor->investor_company_name) == 'FUTURE CAPITAL' ? 'selected' : '' }}>FUTURE CAPITAL</option>
                                                            </select>
                                                            @error('investor_company_name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <label for="investor_company_name_{{ $investor->id }}">Empresa afiliada</label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-floating">
                                                            <input type="text" oninput="this.value = this.value.replace(/\D/g, '')" name="investor_phone" value="{{ $investor->investor_phone }}" id="investor_phone_{{ $investor->id }}" class="form-control @error('investor_phone') is-invalid @enderror" autocomplete="off"/>
                                                            @error('investor_phone')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <label for="investor_phone_{{ $investor->id }}">Nº teléfono</label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-label">Disposición a proyectos</div>
                                                        <div>
                                                            <label class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="investor_status" value="1" {{ $investor->investor_status == 1 ? 'checked' : '' }}>
                                                                <span class="form-check-label">Disponible</span>
                                                            </label>
                                                            <label class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="investor_status" value="0" {{ $investor->investor_status == 0 ? 'checked' : '' }}>
                                                                <span class="form-check-label">No disponible</span>
                                                            </label>
                                                        </div>
                                                        @error('investor_status')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <a href="{{ route('investor.index') }}" class="btn btn-dark me-auto">Volver</a>
                                                <button type="submit" class="btn btn-teal">Guardar cambios</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Liquidation modal -->
                            <div class="modal modal-blur fade" id="modal-liquidate-{{ $investor->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content" style="border: 2px solid #52524E">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Liquidar inversionista</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('investor.liquidate', $investor->id) }}" enctype="multipart/form-data" novalidate>
                                                @method('PUT')
                                                @csrf
                                                <div style="border: 2px solid orange; padding: 10px; background-color: #fff3cd;">
                                                    <p style="color: #000; font-size: 16px; margin-left: 39%; font-weight: bold; margin-bottom: 15px">¡ATENCIÓN!</p>
                                                    <p style="color: #000;">
                                                        Está a punto de realizar la liquidación del inversionista identificado como <strong style="text-transform: uppercase">{{ $investor->investor_name }}</strong>. 
                                                        Esta acción conllevará el cierre definitivo de la cuenta, dejando el fondo del inversor en L. 0.00, una vez confirmado el proceso, no habrá marcha atrás.
                                                    </p>

                                                    <p style="color: #000;">
                                                        Si está seguro de que desea proceder con la liquidación, complete el siguiente formulario y luego haga clic en el botón "<strong>Liquidar inversionista</strong>".
                                                    </p>

                                                    <input type="hidden" name="investor_liquidation_amount" value="{{ $investor->investor_balance }}">
                                                    <input type="hidden" name="investor_liquidation_date" value="{{ $todayDate }}">
                                                    <input type="hidden" name="liquidation_code" value="{{ $generatedCode }}">

                                                    <h4 class="mt-2 mb-3" style="font-weight: 500; text-align: center; text-decoration: underline">FORMULARIO OBLIGATORIO DE LIQUIDACIÓN</h4>
                                                    
                                                    <div class="row mb-3 align-items-end">
                                                        <div class="col-8">
                                                            <div class="form-floating">
                                                                <select style="font-size: clamp(0.7rem, 3vw, 0.75rem)" name="liquidation_payment_mode" id="select-optgroups"
                                                                    class="form-control @error('liquidation_payment_mode') is-invalid @enderror"
                                                                    autocomplete="off">
                                                                    <option selected disabled>Seleccione un método de pago</option>
                                                                    <optgroup label="OTROS MÉTODOS">
                                                                        @foreach (['VARIOS MÉTODOS/TRANSFERENCIAS', 'BANCA ONLINE', 'TRANSFERENCIA', 'EFECTIVO'] as $method)
                                                                            <option value="{{ $method }}">{{ $method }}</option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                    <optgroup label="BANCOS">
                                                                        @foreach (['BAC CREDOMATIC', 'BANCO ATLÁNTIDA', 'BANCO AZTECA', 'BANCO CUSCATLAN', 'BANRURAL', 'BANCO CENTRAL', 'BANTRABHN', 'BANCO DE OCCIDENTE', 'DAVIVIENDA', 'FICENSA', 'FICOHSA', 'BANHCAFE', 'LAFISE', 'BANPAIS', 'BANCO POPULAR', 'BANCO PROMÉRICA'] as $bank)
                                                                            <option value="{{ $bank }}">{{ $bank }}</option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                </select>
                                                                @error('liquidation_payment_mode')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                                <span class="invalid-feedback" role="alert" id="transfer-bank-error"
                                                                    style="display: none;">
                                                                    <strong></strong>
                                                                </span>
                                                                <label for="liquidation_payment_mode">Método de pago utilizado</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-4">
                                                            <div class="form-floating">
                                                                <input style="color: gray" type="text" readonly min="{{ $investor->investor_balance }}" max="{{ $investor->investor_balance }}" value="{{ number_format($investor->investor_balance,2) }}" class="form-control @error('liquidation_payment_amount') is-invalid @enderror" autocomplete="off"/>
                                                                @error('liquidation_payment_amount')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                                <label for="liquidation_payment_amount">Total a liquidar</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-3" style="display: none">
                                                            <div class="form-floating">
                                                                <input type="number" readonly min="{{ $investor->investor_balance }}" max="{{ $investor->investor_balance }}" name="liquidation_payment_amount" value="{{ $investor->investor_balance }}" id="liquidation_payment_amount" class="form-control @error('liquidation_payment_amount') is-invalid @enderror" autocomplete="off"/>
                                                                @error('liquidation_payment_amount')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                                <label for="liquidation_payment_amount">Liquidación total</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3 align-items-end">
                                                        <div class="col">
                                                            <div class="form-floating">
                                                                <textarea oninput="this.value = this.value.toUpperCase()" class="form-control @error('liquidation_payment_comment') is-invalid @enderror" autocomplete="off" maxlength="255"
                                                                    name="liquidation_payment_comment" id="liquidation_payment_comment" style="resize: none; height: 110px">{{ old('liquidation_payment_comment') }}</textarea>
                                                                @error('liquidation_payment_comment')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                                <label for="liquidation_payment_comment">Comentarios adicionales</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3 align-items-end">
                                                        <div class="col">
                                                            <div class="form-floating">
                                                                <input type="file" style="font-size: clamp(0.6rem, 3vw, 0.7rem)" class="form-control @error('liquidation_payment_img') is-invalid @enderror"" id="liquidation_payment_imgs" name="liquidation_payment_imgs[]" multiple accept="image/*">
                                                                <label for="liquidation_payment_imgs">Comprobante(s) de liquidación</label>
                                                                <span class="invalid-feedback" role="alert" id="transfer-img-error"
                                                                    style="display: none;">
                                                                    <strong></strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
    
                                                    <br>
                                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                                                    <button class="btn btn-orange" style="margin-left: 5px; background-color: orange; font-size: 14px;">Liquidar inversionista</button>
                                                    <br>
                                                    <br>
                                                </div>
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

@include('modules.investors._create')

@endsection

@section('scripts')

<!-- Alert fade closer script-->
<script src="{{ asset('customjs/alert_closer.js')}}"></script>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('customjs/datatable/dt_investor.js') }}"></script>
<script src="{{ asset('customjs/datatable/dt_investor_funds.js') }}"></script>
<script src="{{ asset('customjs/datatable/dt_investor_liquidations.js') }}"></script>

<!-- PDF view -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection