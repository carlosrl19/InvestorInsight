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
Prestamistas
@endsection

@section('create')
<a href="#" class="btn btn-orange" style="font-size: clamp(0.6rem, 3vw, 0.7rem);" data-bs-toggle="modal" data-bs-target="#modal-loans">
    $ Historial de préstamos
</a>

<a href="#" class="btn btn-primary" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" data-bs-toggle="modal" data-bs-target="#modal-team">
    + Nuevo prestamista
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
           <div id="search-filters-moneylender-container">FILTROS
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="exampleMoneylender" class="display table table-bordered">
                <thead>
                    <tr style="text-align: center;">
                        <th>ID</th>
                        <th>NOMBRE PRESTAMISTA</th>
                        <th>Nº IDENTIDAD</th>
                        <th>Nº TELÉFONO</th>
                        <th>DESCRIPCIÓN</th>
                        <th style="width: 8vh">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($moneylenders as $i => $moneylender)
                    <tr style="text-align: center;">
                        <td>{{ $i++ }}</td>
                        <td>
                            <a href="{{ route('moneylender.show', $moneylender) }}">{{ $moneylender->moneylender_name }}
                                <small>
                                    <sup>
                                        <img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="{{ asset('../static/svg/link.svg') }}" width="20" height="20" alt="">
                                    </sup>
                                </small>
                            </a>
                        </td>
                        <td>{{ $moneylender->moneylender_dni }}</td>
                        <td>{{ $moneylender->moneylender_phone }}</td>
                        <td>{{ $moneylender->moneylender_description }}</td>
                        <td>
                            @include('modules.moneylenders._delete')
                            <div class="btn-list flex-nowrap">
                                <div class="dropdown">
                                    <button class="btn btn-sm dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                        Acciones
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <small class="text-muted dropdown-item">Modificaciones</small>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-update-{{ $moneylender->id }}">
                                            <img style="filter: invert(42%) sepia(9%) saturate(0%) hue-rotate(136deg) brightness(99%) contrast(93%);" src="{{ asset('../static/svg/edit.svg') }}" width="20" height="20" alt="">
                                            &nbsp;Actualizar información
                                        </a>
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $moneylender->id }}">
                                            <img style="filter: invert(39%) sepia(68%) saturate(5311%) hue-rotate(342deg) brightness(94%) contrast(90%);" src="{{ asset('../static/svg/trash.svg') }}" width="20" height="20" alt="">
                                            &nbsp;Eliminar prestamista
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal de actualización específico para cada prestamista -->
                    <div class="modal modal-blur fade" id="modal-update-{{ $moneylender->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content" style="border: 2px solid #52524E">
                                <div class="modal-header">
                                    <h5 class="modal-title">Editar prestamista</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('moneylender.update', ['moneylender' => $moneylender->id]) }}" novalidate>
                                        @method('PUT')
                                        @csrf
                                        <div class="row mb-3 align-items-end">
                                            <div class="col">
                                                <div class="form-floating">
                                                    <input type="text" maxlength="55" oninput="this.value = this.value.toUpperCase()" value="{{ $moneylender->moneylender_name }}" name="moneylender_name" id="moneylender_name_{{ $moneylender->id }}" class="form-control @error('moneylender_name') is-invalid @enderror" placeholder="Ingrese el nombre del prestamista" autocomplete="off"/>
                                                    @error('moneylender_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <label for="moneylender_name_{{ $moneylender->id }}">Nombre del prestamista</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-floating">
                                                    <input type="text" maxlength="13" value="{{ $moneylender->moneylender_dni }}" name="moneylender_dni" id="moneylender_dni_{{ $moneylender->id }}" class="form-control @error('moneylender_dni') is-invalid @enderror" placeholder="Ingrese el número de identidad" autocomplete="off"/>
                                                    @error('moneylender_dni')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <label for="moneylender_dni_{{ $moneylender->id }}">Nº identidad</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3 align-items-end">
                                            <div class="col">
                                                <div class="form-floating">
                                                    <input type="text" name="moneylender_phone" value="{{ $moneylender->moneylender_phone }}" id="moneylender_phone_{{ $moneylender->id }}" class="form-control @error('moneylender_phone') is-invalid @enderror" data-mask="00000000" data-mask-visible="true" placeholder="00000000" autocomplete="off"/>
                                                    @error('moneylender_phone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <label for="moneylender_phone_{{ $moneylender->id }}">Nº teléfono</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3 align-items-end">
                                            <div class="col">
                                                <div class="form-floating">
                                                    <textarea maxlength="255" style="overflow: hidden; height: 150px; resize: none"
                                                        name="moneylender_description" id="moneylender_description"
                                                        class="form-control @error('moneylender_description') is-invalid @enderror"
                                                        autocomplete="off" oninput="this.value = this.value.toUpperCase()">{{ $moneylender->moneylender_description }}</textarea>
                                                    @error('moneylender_description')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <span class="invalid-feedback" role="alert" id="project-comment-error"
                                                        style="display: none;">
                                                        <strong></strong>
                                                    </span>
                                                    <label for="moneylender_description">
                                                        Descripción del prestamista
                                                    </label>
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
@endsection

@include('modules.moneylenders._create')
@include('modules.moneylender_loans.index')

@section('scripts')

<!-- Alert fade closer script-->
<script src="{{ asset('customjs/alert_closer.js')}}"></script>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('customjs/datatable/dt_moneylender.js') }}"></script>
<script src="{{ asset('customjs/datatable/dt_moneylender_loans.js') }}"></script>

@endsection