@extends('layout.admin')

@section('head')

<!-- Datatable CSS -->
<link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/datatables/css/buttons.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/datatable.css') }}" rel="stylesheet">

<!-- Badge CSS -->
<link href="{{ asset('/css/project.css') }}" rel="stylesheet">

@endsection

@section('pretitle')
Listado principal
@endsection

@section('title')
Proyectos cerrados
@endsection

@section('content')
<div class="container-xl">
    <div class="card mb-2">
        <div class="card-body">
           <div id="search-filters-container">FILTROS</div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="example" class="display table table-bordered" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre proyecto</th>
                        <th>Inicio</th>
                        <th>Final</th>
                        <th>Inversionista</th>
                        <th>Inversión</th>
                        <th>Ganancia</th>
                        <th>Estado</th>
                        <th>Motivo de cierre</th>
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
                            <td>{{ $project->project_code}}</td>
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
                            <td style="text-decoration:line-through;">{{ $project->project_end_date }}</td>                            
                            <td>
                                @foreach ($project->investors as $investor)
                                    <a href="{{ route('investor.show', $investor) }}">{{ $investor->investor_name }}<br>
                                @endforeach
                                <small>
                                    <sup>
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-link"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 15l6 -6" /><path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" /><path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" /></svg>
                                    </sup>
                                </small>
                                </a>
                            </td>
                            <td style="text-decoration:line-through; color: red">L. {{ number_format($project->project_investment,2) }}</td>
                            <td style="text-decoration:line-through; color: red">L. {{ number_format($project->investors->sum('pivot.investor_final_profit'),2) }}</td>
                            <td>
                                @if($project->project_status == '2')
                                    <span class="badge badge-outline text-red me-1">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-lock">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z" />
                                            <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" />
                                            <path d="M8 11v-4a4 4 0 1 1 8 0v4" />
                                        </svg> CERRADO
                                    </span>
                                @else
                                    <span class="badge bg-dark me-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Existe un error en el estado del proyecto, revisar detalles del mismo.">ESTADO DESCONOCIDO</span> 
                                @endif
                            </td>
                            <td>
                                @if($project->project_close_comment != '')
                                    <span class="text-dark">{{ $project->project_close_comment }}</span>
                                @else
                                    <strong class="text-red">El usuario no dió motivos</strong>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('customjs/datatable/dt_project_terminated.js') }}"></script>
@endsection