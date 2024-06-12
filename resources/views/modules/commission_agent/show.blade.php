@extends('layout.admin')

@section('head')
<!-- Datatable CSS -->
<link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/datatables/css/buttons.dataTables.min.css') }}" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/history.css') }}">
@endsection

@section('pretitle')
Comisionistas
@endsection

@section('create')
<button class="btn" onclick="goBack()" style="background-color: transparent; margin-right: 5px">
    &nbsp;<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-back-up"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 14l-4 -4l4 -4" /><path d="M5 10h11a4 4 0 1 1 0 8h-1" /></svg>
    Volver
</button>
@endsection

@section('title')
Historial de comisionista /&nbsp;<b class="text-muted">{{ $commissioner->commissioner_name }}</b>
@endsection

@section('content')
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="accordion" id="accordion-example">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true">
                                    <h4>Información general del comisionista</h4>
                                </button>
                                </h2>
                                <div id="collapse-1" class="accordion-collapse collapse show" data-bs-parent="#accordion-example">
                                    <div class="accordion-body pt-0">
                                        <strong>{{ $commissioner->commissioner_name }}</strong> es un comisionista con número de identidad <strong>{{ $commissioner->commissioner_dni }}</strong>, número de teléfono <strong>{{ $commissioner->commissioner_phone }}</strong>.
                                        </strong> tiene un fondo total de Lps. <strong>{{ number_format($commissioner->commissioner_balance,2) }}</strong>. Fue ingresado al sistema en la fecha <strong>{{ $commissioner->created_at }}</strong>.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="accordion" id="accordion-example">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="true">
                                    <h4>Proyectos en proceso</h4>
                                </button>
                                </h2>
                                <div id="collapse-2" class="accordion-collapse collapse show" data-bs-parent="#accordion-example">
                                    <div class="accordion-body pt-0">
                                        <table id="example0" class="display table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Proyecto</th>
                                                    <th>Comisión del proyecto</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($activeProjects as $project)
                                                <tr>
                                                    <td>{{ $project->project_name }}</td>
                                                    <td>L. {{ number_format($project->commissioner_commission, 2) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="accordion" id="accordion-example">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="true">
                                    <h4>Historial de proyectos finalizados</h4>
                                </button>
                                </h2>
                                <div id="collapse-2" class="accordion-collapse collapse show" data-bs-parent="#accordion-example">
                                    <div class="accordion-body pt-0">
                                        <table id="example1" class="display table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Proyecto</th>
                                                    <th>Comisión del proyecto</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($completedProjects as $project)
                                                <tr>
                                                    <td>{{ $project->project_name }}</td>
                                                    <td>L. {{ number_format($project->commissioner_commission, 2) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<!-- Redirect button -->
<script src="{{ asset('customjs/return_redirect.js')}}"></script>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('customjs/datatable/dt_history.js')}}"></script>
@endsection