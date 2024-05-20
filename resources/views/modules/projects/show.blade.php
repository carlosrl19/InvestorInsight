@extends('layout.admin')

@section('head')
<!-- Datatable CSS -->
<link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/datatables/css/buttons.dataTables.min.css') }}" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/history.css') }}">
@endsection

@section('pretitle')
Proyectos /&nbsp;<b class="text-muted">{{ $project->project_name }}</b>
@endsection

@section('create')
<button class="btn" onclick="goBack()" style="background-color: transparent; margin-right: 5px">
    &nbsp;<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-back-up"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 14l-4 -4l4 -4" /><path d="M5 10h11a4 4 0 1 1 0 8h-1" /></svg>
    Volver
</button>
@endsection

@section('title')
@endsection

@section('content')
<div class="container-xl">
    <div class="card mb-2">
        <div class="card-body">
            <div class="card">
                <div class="container mt-2">
                    <div class="row mb-3">
                        <h3>Información general</h3>
                        <div class="col-md-6">
                            <p><div class="badge bg-success mt-1"></div>&nbsp;Nombre del proyecto: {{ $project->project_name }}</p>
                            <p><div class="badge bg-success mt-1"></div>&nbsp;Código único: {{ $project->project_code }}</p>
                            <p><div class="badge bg-success mt-1"></div>&nbsp;Inversión total: Lps. {{ number_format($project->project_investment,2) }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><div class="badge bg-success mt-1"></div>&nbsp;Fecha inicio: {{ $project->project_start_date }}</p>
                            <p><div class="badge bg-success mt-1"></div>&nbsp;Fecha cierre: {{ $project->project_end_date }}</p>
                            <p><div class="badge bg-success mt-1"></div>&nbsp;Comentarios del proyecto: {{ $project->project_description }}</p>
                        </div>
                    </div>
                    <h3>Inversionistas del proyecto</h3>
                    <div class="row">
                        @foreach($investors as $investor)
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="{{ route('investor.show', $investor) }}">
                                            {{ $investor->investor_name }}
                                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-link">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 15l6 -6" />
                                                <path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" />
                                                <path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @if ($loop->iteration % 4 == 0)
                                </div><div class="row">
                            @endif
                            </div>
                        @endforeach
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