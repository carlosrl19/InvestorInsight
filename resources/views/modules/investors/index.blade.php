@extends('layout.admin')

@section('head')

<!-- Datatable CSS -->
<link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/datatables/css/buttons.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/datatable.css') }}" rel="stylesheet">

@endsection

@section('pretitle')
Listado principal
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
                            <th>Nombre inversionista</th>
                            <th>Empresa</th>
                            <th>Nº Identidad</th>
                            <th>Teléfono</th>
                            <th>Fondo monetario</th>
                            <th>Recomendación</th>
                            <th>Estado</th>
                            <th>Acciones</th>
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
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-link"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 15l6 -6" /><path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" /><path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" /></svg>
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-link"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 15l6 -6" /><path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" /><path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" /></svg>
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
                                        <span class="badge bg-orange me-1"></span> No disponible
                                    @else
                                        <span class="badge bg-red me-1"></span> Estado inválido
                                    @endif
                                </td>
                                <td>
                                    @include('modules.investors._delete')
                                    @if($investor->id != 1)
                                    <div class="btn-list flex-nowrap">
                                        <div class="dropdown">
                                            <button class="btn btn-sm dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                                Acciones
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <small class="text-muted dropdown-item">Modificaciones</small>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-update-{{ $investor->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                                    &nbsp;Actualizar información
                                                </a>
                                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $investor->id }}">
                                                    <svg class="text-red" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                    &nbsp;Eliminar inversionista
                                                </a>
                                            </div>
                                        </div>
                                    </div>
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
                                                        <label class="form-label" for="investor_name_{{ $investor->id }}">Nombre del inversionista</label>
                                                        <input type="text" maxlength="55" value="{{ $investor->investor_name }}" name="investor_name" id="investor_name_{{ $investor->id }}" class="form-control @error('investor_name') is-invalid @enderror" placeholder="Ingrese el nombre del inversionista" autocomplete="off"/>
                                                        @error('investor_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label class="form-label" for="investor_dni_{{ $investor->id }}">Nº identidad</label>
                                                        <input type="text" maxlength="13" value="{{ $investor->investor_dni }}" name="investor_dni" id="investor_dni_{{ $investor->id }}" class="form-control @error('investor_dni') is-invalid @enderror" placeholder="Ingrese el número de identidad" autocomplete="off"/>
                                                        @error('investor_dni')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <input type="hidden" name="investor_status" value="1">
                                                </div>
                                                <div class="row mb-3 align-items-end">
                                                    <div class="col">
                                                        <label class="form-label" for="investor_balance_{{ $investor->id }}">Fondo del inversionista</label>
                                                        <input type="number" value="{{ $investor->investor_balance }}" name="investor_balance" id="investor_balance_{{ $investor->id }}" class="form-control @error('investor_balance') is-invalid @enderror" autocomplete="off"/>
                                                        @error('investor_balance')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label class="form-label" for="investor_company_name_{{ $investor->id }}">Empresa afiliada</label>
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
                                                    </div>
                                                </div>
                                                <div class="row mb-3 align-items-end">
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
                                                    <div class="col">
                                                        <label class="form-label" for="investor_phone_{{ $investor->id }}">Nº teléfono</label>
                                                        <input type="text" name="investor_phone" value="{{ $investor->investor_phone }}" id="investor_phone_{{ $investor->id }}" class="form-control @error('investor_phone') is-invalid @enderror" data-mask="00000000" data-mask-visible="true" placeholder="00000000" autocomplete="off"/>
                                                        @error('investor_phone')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label class="form-label" for="investor_reference_id_{{ $investor->id }}">Recomendado por</label>
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
                                                    </div>
                                                </div>
                                                <a href="{{ route('investor.index') }}" class="btn btn-dark me-auto">Volver</a>
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

@include('modules.investors._create')
@endsection

@section('scripts')

<!-- Alert fade closer script-->
<script src="{{ asset('customjs/alert_closer.js')}}"></script>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('customjs/datatable/dt_investor.js') }}"></script>

@endsection