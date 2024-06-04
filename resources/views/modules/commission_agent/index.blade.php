@extends('layout.admin')

@section('head')

<!-- Datatable CSS -->
<link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/datatables/css/buttons.dataTables.min.css') }}" rel="stylesheet">

@endsection

@section('pretitle')
Listado principal
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
    
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" style="margin-right: 10vh; margin-left: 10vh; font-size: clamp(0.6rem, 3.2vw, 0.8rem);" role="alert" data-auto-dismiss="10000">
        <strong>{{ session('error') }}</strong>
    </div>
    @endif

<div class="container-xl">
    <div class="card">
      <div class="card-body">
        <table id="example" class="display table table-bordered">
            <thead>
                <tr>
                    <th>Nombre comisionista</th>
                    <th>Nº Identidad</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                    @foreach($commission_agents as $commission_agent)
                    <tr>
                        <td>{{ $commission_agent->commissioner_name }}</td>
                        <td>{{ $commission_agent->commissioner_dni }}</td>
                        <td>{{ $commission_agent->commissioner_phone }}</td>
                        <td>
                            @include('modules.commission_agent._delete')
                            
                            <div class="btn-list flex-nowrap">
                                <div class="dropdown">
                                    <button class="btn btn-sm dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                    Acciones
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <small class="text-muted dropdown-item">Modificaciones</small>
                                        <a class="dropdown-item" href="{{ route('commission_agent.edit', $commission_agent) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                            &nbsp;Actualizar información
                                        </a>
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $commission_agent->id }}">
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

@include('modules.commission_agent._create')
@endsection

@section('scripts')

<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Alert fade closer script-->
<script src="{{ asset('customjs/alert_closer.js')}}"></script>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('customjs/datatable/dt_commissioner.js') }}"></script>

@endsection