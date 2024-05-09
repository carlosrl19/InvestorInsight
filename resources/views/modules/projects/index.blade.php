@extends('layout.admin')

@section('head')

<!-- Datatable CSS -->
<link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/datatables/css/buttons.dataTables.min.css') }}" rel="stylesheet">

<link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet">

@endsection

@section('pretitle')
Listado principal
@endsection

@section('title')
Proyectos
@endsection

@section('create')
<a href="#" class="btn btn-primary" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" data-bs-toggle="modal" data-bs-target="#modal-team">
    + Nuevo proyecto
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
    <div class="card">
      <div class="card-body">
        <table id="example" class="display table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre proyecto</th>
                    <th>SM <small>(tiempo estimado)</small></th>
                    <th>Fecha inicio</th>
                    <th>Fecha cierre <small>(previsto)</small></th>
                    <th>Inversión</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $i => $project)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $project->project_name }}</td>
                    <td>{{ $project->project_estimated_time }} semanas</td>
                    <td>{{ $project->project_start_date }}</td>
                    <td>{{ $project->project_end_date }}</td>
                    <td>L. {{ number_format($project->project_investment) }}</td>
                    <td>
                        @if($project->project_status == '1')
                            <span class="badge bg-success me-1">En proceso</span>
                        @elseif($project->project_status == '0')
                            <span class="badge bg-orange me-1">Finalizado</span> 
                        @else
                            <span class="badge bg-red me-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Existe un error en el estado del proyecto, revisar detalles del mismo.">Estado inválido</span> 
                        @endif
                    </td>
                    <td>                        
                        <div class="btn-list flex-nowrap">
                            <div class="dropdown">
                                <button class="btn btn-sm dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                Acciones
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <small class="text-muted dropdown-item">Modificaciones</small>
                                    <a class="dropdown-item" href="{{ route('project.edit', $project) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                        &nbsp;Actualizar información
                                    </a>
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $project->id }}">
                                        <svg class="text-red" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-flower"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M12 2a3 3 0 0 1 3 3c0 .562 -.259 1.442 -.776 2.64l-.724 1.36l1.76 -1.893c.499 -.6 .922 -1 1.27 -1.205a2.968 2.968 0 0 1 4.07 1.099a3.011 3.011 0 0 1 -1.09 4.098c-.374 .217 -.99 .396 -1.846 .535l-2.664 .366l2.4 .326c1 .145 1.698 .337 2.11 .576a3.011 3.011 0 0 1 1.09 4.098a2.968 2.968 0 0 1 -4.07 1.098c-.348 -.202 -.771 -.604 -1.27 -1.205l-1.76 -1.893l.724 1.36c.516 1.199 .776 2.079 .776 2.64a3 3 0 0 1 -6 0c0 -.562 .259 -1.442 .776 -2.64l.724 -1.36l-1.76 1.893c-.499 .601 -.922 1 -1.27 1.205a2.968 2.968 0 0 1 -4.07 -1.098a3.011 3.011 0 0 1 1.09 -4.098c.374 -.218 .99 -.396 1.846 -.536l2.664 -.366l-2.4 -.325c-1 -.145 -1.698 -.337 -2.11 -.576a3.011 3.011 0 0 1 -1.09 -4.099a2.968 2.968 0 0 1 4.07 -1.099c.348 .203 .771 .604 1.27 1.205l1.76 1.894c-1 -2.292 -1.5 -3.625 -1.5 -4a3 3 0 0 1 3 -3z" /></svg>
                                        &nbsp;Cerrar proyecto
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

@include('modules.projects._create')
@endsection

@section('scripts')

<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Alert fade closer script-->
<script src="{{ asset('customjs/alert_closer.js')}}"></script>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>

<!-- Final date -->
<script src="{{ asset('customjs/projects/project_final_date.js') }}"></script>
<script src="{{ asset('customjs/projects/steps_form.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('customjs/select2/s2_projects.js') }}"></script>
@endsection