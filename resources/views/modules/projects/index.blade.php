@extends('layout.admin')

@section('head')

<!-- Datatable CSS -->
<link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/datatables/css/buttons.dataTables.min.css') }}" rel="stylesheet">

<!-- Toast.JS CSS -->
<link rel="stylesheet" href="{{ asset('dist/libs/toast.js/css/Toast.min.css') }}">

<!-- Badge CSS -->
<link href="{{ asset('/css/project.css') }}" rel="stylesheet">

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
                        <th>Nombre proyecto</th>
                        <th>Inicio</th>
                        <th>Cierre <small>(previsto)</small></th>
                        <th>Inversionista</th>
                        <th>Inversión</th>
                        <th>Ganancia total</th>
                        <th>Excel</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                @php
                    $groupedProjects = $projects->groupBy('project_code');
                @endphp
                <tbody>
                    @foreach($groupedProjects as $projectCode => $projectGroup)
                        @php
                            $project = $projectGroup->first();
                        @endphp
                        <tr>
                            <td style="max-width: 150px; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;">
                                <a href="{{ route('project.show', $project) }}">
                                    {{ $project->project_name }}
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-link">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M9 15l6 -6" />
                                        <path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" />
                                        <path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" />
                                    </svg>
                                </a>
                            </td>
                            <td>{{ $project->project_start_date }}</td>
                            <td>{{ $project->project_end_date }}</td>
                            <td>
                                @foreach ($project->investors as $investor)
                                    {{ $investor->investor_name }}<br>
                                @endforeach
                            </td>
                            <td>L. {{ number_format($project->project_investment,2) }}</td>
                            <td>L. {{ number_format($project->investors->sum('pivot.investor_profit'),2) }}</td>
                            <td>
                                <a href="{{ route('project.excel', $project) }}" class="badge bg-teal me-1">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-spreadsheet">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                        <path d="M8 11h8v7h-8z" />
                                        <path d="M8 15h8" />
                                        <path d="M11 11v7" />
                                    </svg>
                                    EXCEL
                                </a>
                            </td>
                            <td>
                                @if($project->project_status == '0')
                                    <span class="badge bg-teal me-1">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-lock">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z" />
                                            <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" />
                                            <path d="M8 11v-4a4 4 0 1 1 8 0v4" />
                                        </svg> FINALIZADO
                                    </span>
                                @elseif($project->project_status == '1')
                                    <span class="badge bg-cyan me-1 project-active" data-bs-toggle="modal" data-bs-target="#finishModal{{ $project->id }}">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-lock-open">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M5 11m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" />
                                            <path d="M12 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                            <path d="M8 11v-5a4 4 0 0 1 8 0" />
                                        </svg> TRABAJANDO
                                    </span>
                                @elseif($project->project_status == '2')
                                <span class="badge bg-red me-1">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-lock-off"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 11h2a2 2 0 0 1 2 2v2m0 4a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2h4" />
                                        <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" />
                                        <path d="M8 11v-3m.719 -3.289a4 4 0 0 1 7.281 2.289v4" />
                                        <path d="M3 3l18 18" />
                                    </svg> CERRADO
                                </span>
                                @else
                                    <span class="badge bg-dark me-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Existe un error en el estado del proyecto, revisar detalles del mismo.">ESTADO DESCONOCIDO</span> 
                                @endif
                            </td>

                            <!-- Modal for finishing the project -->
                            <div class="modal fade" id="finishModal{{ $project->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="finishModal{{ $project->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background: darkred; color: white">
                                            <h5 class="modal-title" id="ModalLabel">Finalizar proyecto</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Desea cambiar el estado del proyecto <b>{{ $project->project_name }}</b> a "Finalizado"? Utilice esta opción únicamente cuando un proyecto haya concluido de forma exitosa.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <form action="{{ route('project.finish', $project->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Finalizar proyecto</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @if($project->project_status == '1')
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <div class="dropdown">
                                        <button class="btn btn-sm dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                        Acciones
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <small class="text-muted dropdown-item">Modificación de datos</small>
                                            <a class="dropdown-item" href="{{ route('project.edit', $project) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                    <path d="M16 5l3 3" />
                                                </svg>
                                                &nbsp;Actualizar información
                                            </a>
                                            <small class="text-muted dropdown-item">Acciones de finalización</small>
                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#closeModal{{ $project->id }}">
                                                <svg class="text-red" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-circle-x">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                    <path d="M10 10l4 4m0 -4l-4 4" />
                                                </svg>
                                                &nbsp;Cerrar proyecto
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            @else
                                <td>
                                    <span class="text-red">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-lock-off">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M15 11h2a2 2 0 0 1 2 2v2m0 4a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2h4" />
                                            <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" />
                                            <path d="M8 11v-3m.719 -3.289a4 4 0 0 1 7.281 2.289v4" />
                                            <path d="M3 3l18 18" />
                                        </svg> Ninguna
                                    </span>
                                </td>
                            @endif

                            <!-- Modal for closing the project -->
                            <div class="modal fade" id="closeModal{{ $project->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="closeModal{{ $project->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background: darkred; color: white">
                                            <h5 class="modal-title" id="ModalLabel">Cerrar proyecto</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Desea cambiar el estado del proyecto <b>{{ $project->project_name }}</b> a "Cerrado"? Utilice esta opción únicamente cuando un proyecto tenga conflictos para llevarse a cabo y no se pueda seguir con el mismo.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <form action="{{ route('project.close', $project->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Cerrar proyecto</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
<script src="{{ asset('customjs/datatable/dt_project.js') }}"></script>

<!-- ToastJS -->
<script src="{{ asset('dist/libs/toast.js/js/Toast.min.js') }}"></script>

<!-- Form steps -->
<script src="{{ asset('customjs/projects/steps_form.js') }}"></script>
@endsection