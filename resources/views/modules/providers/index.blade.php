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
                            <th>FONDO MONETARIO</th>
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
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-link"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 15l6 -6" /><path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" /><path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" /></svg>
                                            </sup>
                                        </small>
                                    </a>
                                </td>
                                <td>{{ $provider->provider_dni }}</td>
                                <td>{{ $provider->provider_phone }}</td>
                                @if($provider->provider_balance <= 0)
                                    <td><span class="text-light badge bg-red">Lps. {{ number_format($provider->provider_balance,2) }}</span></td>
                                @else
                                    <td>Lps. {{ number_format($provider->provider_balance,2) }}</td>
                                @endif
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                                    &nbsp;Actualizar información
                                                </a>

                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-fund{{ $provider->id }}">
                                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-coins"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z" /><path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4" /><path d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z" /><path d="M3 6v10c0 .888 .772 1.45 2 2" /><path d="M3 11c0 .888 .772 1.45 2 2" /></svg>
                                                    &nbsp;Agregar pago
                                                </a>
                                                
                                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $provider->id }}">
                                                    <svg class="text-red" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
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