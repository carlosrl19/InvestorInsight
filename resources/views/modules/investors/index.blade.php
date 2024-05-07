@extends('layout.admin')

@section('pretitle')
Listado principal
@endsection

@section('title')
Inversionistas
@endsection

@section('create')
<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-team">
    + Nuevo inversionista
</a>
@endsection

@section('content')

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" style="margin-left: 18vh; margin-right: 18vh; font-size: clamp(0.6rem, 3.2vw, 0.8rem);" role="alert" data-auto-dismiss="4000">
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
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table" id="example">
            <thead>
              <tr>
                <th>#</th>
                <th>Nombre inversionista</th>
                <th>Nº Identidad</th>
                <th>Teléfono</th>
                <th>Referido por</th>
                <th>Estado / Disposición</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
                @foreach($investor as $i => $investor)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $investor->investor_name }}</td>
                    <td>{{ $investor->investor_dni }}</td>
                    <td>{{ $investor->investor_phone }}</td>
                    <td>{{ $investor->investor_reference }}</td>
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
                        
                        <div class="btn-list flex-nowrap">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                Acciones
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <small class="text-muted dropdown-item">Opciones</small>
                                    <a class="dropdown-item" href="#" >
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chart-line"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 19l16 0" /><path d="M4 15l4 -6l4 2l4 -5l4 4" /></svg>
                                        &nbsp;Historial de inversionista
                                    </a>
                                    <small class="text-muted dropdown-item">Modificaciones</small>
                                    <a class="dropdown-item" href="{{ route('investor.edit', $investor) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                        &nbsp;Actualizar información
                                    </a>
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $investor->id }}">
                                        <svg class="text-red"  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                        &nbsp;Eliminar inversionista
                                    </a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>

@include('modules.investors._create')
@endsection

@section('scripts')

<!-- Alert fade closer script-->
<script src="{{ asset('customjs/alert_closer.js')}}"></script>

@endsection