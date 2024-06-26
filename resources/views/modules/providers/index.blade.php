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
Proveedores
@endsection

@section('create')
<a href="#" class="btn btn-orange" style="font-size: clamp(0.6rem, 3vw, 0.7rem);" data-bs-toggle="modal" data-bs-target="#modal-funds">
    $ Historial de cambios en fondos
</a>

<a href="#" class="btn btn-primary" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" data-bs-toggle="modal" data-bs-target="#modal-team">
    + Nuevo proveedor
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
                            <th>NOMBRE PROVEEDOR</th>
                            <th>Nº IDENTIDAD</th>
                            <th>Nº TELÉFONO</th>
                            <th>DESCRIPCIÓN</th>
                            <th style="width: 8vh">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($providers as $i => $provider)
                            <tr class="text-center">
                                <td>{{ $i++ }}</td>
                                <td>
                                    <a href="{{ route('provider.show', $provider) }}">{{ $provider->provider_name }}
                                        <small>
                                            <sup>
                                                <img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="{{ asset('../static/svg/link.svg') }}" width="20" height="20" alt="">
                                            </sup>
                                        </small>
                                    </a>
                                </td>
                                <td>{{ $provider->provider_dni }}</td>
                                <td>{{ $provider->provider_phone }}</td>
                                <td>{{ $provider->provider_description }}</td>
                                <td>
                                    @include('modules.providers._delete')
                                    @include('modules.providers._fund')

                                    <div class="btn-list flex-nowrap">
                                        <div class="dropdown">
                                            <button class="btn btn-sm dropdown-toggle align-text-top" style="margin-right: -7vh; min-width: auto" data-bs-toggle="dropdown">ACCIONES</button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <small class="text-muted dropdown-item">Modificaciones</small>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-update-{{ $provider->id }}">
                                                    <img style="filter: invert(42%) sepia(9%) saturate(0%) hue-rotate(136deg) brightness(99%) contrast(93%);" src="{{ asset('../static/svg/edit.svg') }}" width="20" height="20" alt="">
                                                    &nbsp;Actualizar información
                                                </a>

                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-fund{{ $provider->id }}">
                                                    <img style="filter: invert(42%) sepia(9%) saturate(0%) hue-rotate(136deg) brightness(99%) contrast(93%);" src="{{ asset('../static/svg/coins.svg') }}" width="20" height="20" alt="">
                                                    &nbsp;Realizar pago
                                                </a>
                                                
                                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $provider->id }}">
                                                    <img style="filter: invert(39%) sepia(68%) saturate(5311%) hue-rotate(342deg) brightness(94%) contrast(90%);" src="{{ asset('../static/svg/trash.svg') }}" width="20" height="20" alt="">
                                                    &nbsp;Eliminar proveedor
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Update provider modal -->
                            <div class="modal modal-blur fade" id="modal-update-{{ $provider->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content" style="border: 2px solid #52524E">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Editar proveedor</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('provider.update', ['provider' => $provider->id]) }}" novalidate>
                                                @method('PUT')
                                                @csrf
                                                <div class="row mb-3 align-items-end">
                                                    <div class="col">
                                                        <div class="form-floating">
                                                            <input type="text" maxlength="55" oninput="this.value = this.value.toUpperCase()" value="{{ $provider->provider_name }}" name="provider_name" id="provider_name_{{ $provider->id }}" class="form-control @error('provider_name') is-invalid @enderror" placeholder="Ingrese el nombre del proveedor" autocomplete="off"/>
                                                            @error('provider_name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <label for="provider_name_{{ $provider->id }}">Nombre del inversionista</label>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-floating">
                                                            <input type="text" maxlength="13" value="{{ $provider->provider_dni }}" name="provider_dni" id="provider_dni_{{ $provider->id }}" class="form-control @error('provider_dni') is-invalid @enderror" placeholder="Ingrese el número de identidad" autocomplete="off"/>
                                                            @error('provider_dni')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <label for="provider_dni_{{ $provider->id }}">Nº identidad</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3 align-items-end">
                                                    <div class="col" style="display: none">
                                                        <div class="form-floating">
                                                            <input type="number" value="{{ $provider->provider_balance }}" name="provider_balance" id="provider_balance_{{ $provider->id }}" class="form-control @error('provider_balance') is-invalid @enderror" autocomplete="off"/>
                                                            @error('provider_balance')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <label for="provider_balance_{{ $provider->id }}">Fondo del inversionista</label>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col">
                                                        <div class="form-floating">
                                                            <input type="text" name="provider_phone" value="{{ $provider->provider_phone }}" id="provider_phone_{{ $provider->id }}" class="form-control @error('provider_phone') is-invalid @enderror" data-mask="00000000" data-mask-visible="true" placeholder="00000000" autocomplete="off"/>
                                                            @error('provider_phone')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <label for="provider_phone_{{ $provider->id }}">Nº teléfono</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row align-items-ends mb-3">
                                                    <div class="col">
                                                        <div class="form-floating">
                                                            <textarea maxlength="80" style="height: 100px; resize: none" name="provider_description" oninput="this.value = this.value.toUpperCase()" id="provider_description" class="form-control @error('provider_name') is-invalid @enderror" autocomplete="off"/>{{ $provider->provider_description }}</textarea>
                                                            @error('provider_description')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            <label for="provider_description">Breve descripción del proveedor</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <a href="{{ route('provider.index') }}" class="btn btn-dark me-auto">Volver</a>
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

@include('modules.providers._create')
@include('modules.provider_funds.index')

@endsection

@section('scripts')

<!-- Alert fade closer script-->
<script src="{{ asset('customjs/alert_closer.js')}}"></script>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('customjs/datatable/dt_provider.js') }}"></script>
<script src="{{ asset('customjs/datatable/dt_provider_funds.js') }}"></script>

<!-- PDF view -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- PDF Modal activator -->
<script>
    $('#pdfModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botón que activó el modal
        var url = button.attr('href'); // Extraer la información de los atributos data-*
        var modal = $(this);
        modal.find('#pdf-frame').attr('src', url);
    });
    $('#pdfModal').on('hidden.bs.modal', function (e) {
        $(this).find('#pdf-frame').attr('src', '');
    });
</script>   

@endsection