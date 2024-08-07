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
Comisionistas
@endsection

@section('create')
<a href="#" class="btn btn-primary" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" data-bs-toggle="modal" data-bs-target="#modal-team">
    + Nuevo comisionista
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
           <div id="search-filters-container">FILTROS
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="example" class="display table table-bordered">
                <thead>
                    <tr style="text-align: center;">
                        <th>ID</th>
                        <th>NOMBRE COMISIONISTA</th>
                        <th>Nº IDENTIDAD</th>
                        <th>Nº TELÉFONO</th>
                        <th>CAPITAL</th>
                        <th style="width: 8vh">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commission_agents as $i => $commission_agent)
                    <tr style="text-align: center;">
                        <td>{{ $i++ }}</td>
                        <td>
                            <a href="{{ route('commission_agent.show', $commission_agent) }}">{{ $commission_agent->commissioner_name }}
                                <small>
                                    <sup>
                                        <img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="{{ asset('../static/svg/link.svg') }}" width="20" height="20" alt="">
                                    </sup>
                                </small>
                            </a>
                        </td>
                        <td>{{ $commission_agent->commissioner_dni }}</td>
                        <td>{{ $commission_agent->commissioner_phone }}</td>
                        <td>Lps. {{ number_format($commission_agent->commissioner_balance,2 )}}</td>
                        <td>
                            @include('modules.commission_agent._delete')
                            <div class="btn-list flex-nowrap">
                                @if($commission_agent->id != 1)
                                <div class="dropdown">
                                    <button class="btn btn-sm dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                        Acciones
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <small class="text-muted dropdown-item">Modificaciones</small>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-update-{{ $commission_agent->id }}">
                                            <img style="filter: invert(42%) sepia(9%) saturate(0%) hue-rotate(136deg) brightness(99%) contrast(93%);" src="{{ asset('../static/svg/edit.svg') }}" width="20" height="20" alt="">
                                            &nbsp;Actualizar información
                                        </a>
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $commission_agent->id }}">
                                            <img style="filter: invert(39%) sepia(68%) saturate(5311%) hue-rotate(342deg) brightness(94%) contrast(90%);" src="{{ asset('../static/svg/trash.svg') }}" width="20" height="20" alt="">
                                            &nbsp;Eliminar comisionista
                                        </a>
                                    </div>
                                </div>
                                @else
                                <strong class="text-red">Acción no disponible</strong>
                                @endif
                            </div>
                        </td>
                    </tr>

                    <!-- Modal de actualización específico para cada comisionista -->
                    <div class="modal modal-blur fade" id="modal-update-{{ $commission_agent->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content" style="border: 2px solid #52524E">
                                <div class="modal-header">
                                    <h5 class="modal-title">Editar comisionista</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('commission_agent.update', ['commission_agent' => $commission_agent->id]) }}" novalidate>
                                        @method('PUT')
                                        @csrf
                                        <div class="row mb-3 align-items-end">
                                            <div class="col" style="display: none">
                                                <div class="form-floating">
                                                    <input type="text" readonly name="commissioner_balance" id="commissioner_balance" value="{{ $commission_agent->commissioner_balance }}" class="form-control" autocomplete="off">
                                                    <label for="commissioner_balance" name="commissioner_balance">Capital</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-floating">
                                                    <input type="text" oninput="this.value = this.value.toUpperCase().replace(/[^A-Z\s]/g, '')" maxlength="55" oninput="this.value = this.value.toUpperCase()" value="{{ $commission_agent->commissioner_name }}" name="commissioner_name" id="commissioner_name_{{ $commission_agent->id }}" class="form-control @error('commissioner_name') is-invalid @enderror" placeholder="Ingrese el nombre del comisionista" autocomplete="off"/>
                                                    @error('commissioner_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <label for="commissioner_name_{{ $commission_agent->id }}">Nombre del comisionista</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-floating">
                                                    <input type="text" oninput="this.value = this.value.toUpperCase().replace(/\s/g, '')" maxlength="13" value="{{ $commission_agent->commissioner_dni }}" name="commissioner_dni" id="commissioner_dni_{{ $commission_agent->id }}" class="form-control @error('commissioner_dni') is-invalid @enderror" placeholder="Ingrese el número de identidad" autocomplete="off"/>
                                                    @error('commissioner_dni')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <label for="commissioner_dni_{{ $commission_agent->id }}">Nº identidad</label>
                                                </div>
                                            </div>
                                            <input type="hidden" name="commissioner_status" value="1">
                                        </div>
                                        <div class="row mb-3 align-items-end">
                                            <div class="col">
                                                <div class="form-floating">
                                                    <input type="text" oninput="this.value = this.value.replace(/\D/g, '')" minlength="8" maxlength="8" name="commissioner_phone" value="{{ $commission_agent->commissioner_phone }}" id="commissioner_phone_{{ $commission_agent->id }}" class="form-control @error('commissioner_phone') is-invalid @enderror" data-mask="00000000" data-mask-visible="true" placeholder="00000000" autocomplete="off"/>
                                                    @error('commissioner_phone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <label for="commissioner_phone_{{ $commission_agent->id }}">Nº teléfono</label>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{ route('commission_agent.index') }}" class="btn btn-dark me-auto">Volver</a>
                                        <button type="submit" class="btn btn-teal">Guardar cambios</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin del modal específico -->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('modules.commission_agent._create')

@endsection

@section('scripts')

<!-- Alert fade closer script-->
<script src="{{ asset('customjs/alert_closer.js')}}"></script>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('customjs/datatable/dt_commissioner.js') }}"></script>

@endsection