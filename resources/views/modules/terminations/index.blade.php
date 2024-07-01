@extends('layout.admin')

@section('head')

<!-- Datatable CSS -->
<link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/datatables/css/buttons.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/datatable.css') }}" rel="stylesheet">

<!-- Badge CSS -->
<link href="{{ asset('/css/project.css') }}" rel="stylesheet">

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">

@endsection

@section('pretitle')
Listado principal
@endsection

@section('title')
Proyectos finiquitados
@endsection

@section('create')
<a href="#" class="btn btn-primary" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" data-bs-toggle="modal" data-bs-target="#modal-payment">
    + Nuevo pago de finiquito
</a>
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
                        <th>Código <br> proyecto</th>
                        <th>Nombre <br> proyecto</th>
                        <th>Feha <br> inicio</th>
                        <th>Fecha <br> final</th>
                        <th>Nombre <br> inversionista</th>
                        <th>Monto <br> Inversión</th>
                        <th>Ganancia <br> proyecto</th>
                        <th>Exportar <br> Finiquito</th>
                        <th>Estado <br> proyecto</th>
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
                        <tr style="text-align: center;">
                            <td>#{{ $project->project_code}}</td>
                            <td style="max-width: 150px; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;">
                                <a href="#" class="text-blue" style="font-size: clamp(0.6rem, 3vw, 0.65rem); border: none; margin-right: 5px" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#showModal{{ $project->id }}"></>
                                    {{ $project->project_name }}
                                    &nbsp;<svg class="text-blue" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-link"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 15l6 -6" /><path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" /><path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" /></svg>
                                </a>
                                @include('modules.projects._show')
                            </td>
                            <td>{{ $project->project_start_date }}</td>
                            <td>{{ $project->project_end_date }}</td>                            
                            <td>
                                @foreach ($project->investors as $investor)
                                    <a style="font-size: clamp(0.6rem, 3vw, 0.65rem);" href="{{ route('investor.show', $investor) }}">{{ $investor->investor_name }}
                                    <small>
                                        <sup>
                                            <img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="{{ asset('../static/svg/link.svg') }}" width="20" height="20" alt="">
                                        </sup>
                                    </small>
                                    <br>
                                @endforeach
                                </a>
                            </td>
                            <td>L. {{ number_format($project->project_investment,2) }}</td>
                            <td>L. {{ number_format($project->investors->sum('pivot.investor_final_profit'),2) }}</td>
                            <td>
                                @if($project->project_status == 0)
                                <a href="{{ route('termination.report', $project->id) }}" class="badge bg-red me-1 text-white" data-toggle="modal" data-target="#pdfModal">
                                    <img style="filter: invert(100%) sepia(0%) saturate(7398%) hue-rotate(181deg) brightness(105%) contrast(102%);" src="{{ asset('../static/svg/file-text.svg') }}" width="20" height="20" alt="">
                                    FINIQUITO
                                </a>
                                @else
                                    <span class="text-red"><strong>N/D</strong></span>
                                @endif
                            </td>
                            <td>
                                @if($project->project_status == '0')
                                    <span class="badge badge-outline text-success me-1 text-white">
                                        <img style="filter: brightness(0) saturate(100%) invert(49%) sepia(86%) saturate(434%) hue-rotate(78deg) brightness(98%) contrast(86%);" src="{{ asset('../static/svg/lock.svg') }}" width="20" height="20" alt="">
                                        FINALIZADO
                                    </span>
                                @else
                                    <span class="badge bg-dark me-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Existe un error en el estado del proyecto, revisar detalles del mismo.">ESTADO DESCONOCIDO</span> 
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Modal -->
            <div class="modal fade modal-blur" id="pdfModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="pdfModalLabel">Previsualización de finiquito</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <iframe id="pdf-frame" style="width:100%; height:500px;" src=""></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include('modules.payment_investors._create')

@section('scripts')

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('customjs/datatable/dt_project_terminated.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('customjs/select2/s2_init.js') }}"></script>

<!-- PDF view -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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