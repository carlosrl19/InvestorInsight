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
                    <tr style="text-align: center;">
                        <th>CODIGO <br>PROYECTO</th>
                        <th>NOMBRE <br>PROYECTO</th>
                        <th>FECHA <br>INICIAL</th>
                        <th>FECHA <br>FINAL</th>
                        <th>NOMBRE <br>INVERSIONISTA</th>
                        <th>MONTO <br>INVERSION</th>
                        <th>GANANCIA <br>TOTAL</th>
                        <th>ESTADO <br>PROYECTO</th>
                        <th>MOTIVO <br>CIERRE</th>
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
                                    &nbsp;<img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="{{ asset('../static/svg/link.svg') }}" width="20" height="20" alt="">
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
                                        &nbsp;<img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="{{ asset('../static/svg/link.svg') }}" width="20" height="20" alt="">
                                    </sup>
                                </small>
                                </a>
                            </td>
                            <td style="text-decoration:line-through; color: red">L. {{ number_format($project->project_investment,2) }}</td>
                            <td style="text-decoration:line-through; color: red">L. {{ number_format($project->investors->sum('pivot.investor_final_profit'),2) }}</td>
                            <td>
                                @if($project->project_status == '2')
                                    <span class="badge badge-outline text-red me-1">
                                        <img style="filter: invert(39%) sepia(68%) saturate(5311%) hue-rotate(342deg) brightness(94%) contrast(90%);" src="{{ asset('../static/svg/lock-code.svg') }}" width="20" height="20" alt="">
                                        CERRADO
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