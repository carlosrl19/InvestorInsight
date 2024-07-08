@extends('layout.admin')

@section('head')

<!-- Datatable CSS -->
<link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/datatables/css/buttons.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/datatable.css') }}" rel="stylesheet">

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">

@endsection

@section('pretitle')
Listado principal
@endsection

@section('title')
Transferencias
@endsection

@section('create')
<a href="#" class="btn btn-primary" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" data-bs-toggle="modal" data-bs-target="#modal-team">
    + Nuevo transferencia
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
                    <th>Código</th>
                    <th>Inversionista</th>
                    <th>Fecha Hora</th>
                    <th>Banco transferencia</th>
                    <th>Monto transferencia</th>
                    <th>Motivo</th>
                    <th>Comprobante</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transfers as $transfer)
                <tr class="text-center">
                    <td>#{{ $transfer->transfer_code }}</td>
                    <td>
                        <a href="{{ route('investor.show', $transfer->investor_id) }}">{{ $transfer->investor->investor_name }}
                            <small>
						    	<sup>
                                    <img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="{{ asset('../static/svg/link.svg') }}" width="20" height="20" alt="">
						    	</sup>
						    </small>
                        </a>
                    </td>
                    <td>{{ $transfer->transfer_date }}</td>
                    <td class="text-uppercase">{{ $transfer->transfer_bank }}</td>
                    <td>Lps. {{ number_format($transfer->transfer_amount,2) }}</td>
                    <td>{{ $transfer->transfer_comment }}</td>
                    <td>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal-{{ $transfer->id }}">
                            @if (file_exists(public_path('images/transfers/' . $transfer->transfer_img)))
                                <img src="{{ asset('images/transfers/' . $transfer->transfer_img) }}" style="height: 40px; width: 40px; display: flex; margin: auto" alt="transfer-proof">
                            @else
                                <img src="{{ asset('images/no-image.png') }}" style="height: 40px; width: 40px; display: flex; margin: auto" alt="no image available" title="Sin comprobante">
                            @endif
                        </a>
                    </td>
                </tr>

                <!-- Modal comprobante -->
                <div class="modal modal-blur fade" id="imageModal-{{ $transfer->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content" style="border: 2px solid #52524E">
                            <div class="modal-header">
                                <h5 class="modal-title">Imagen de comprobante</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @if (file_exists(public_path('images/transfers/' . $transfer->transfer_img)))
                                    <img src="{{ asset('images/transfers/' . $transfer->transfer_img) }}" style="height: auto; width: 100%; display: flex; margin: auto" alt="transfer-proof">
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" style="height: 35vh; width: 100%; display: flex; margin: auto" alt="no image available" title="Sin comprobante">
                                @endif
                                <br>
                                <button type="button" class="btn btn-dark me-auto" data-bs-dismiss="modal">Volver</button>
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

@include('modules.transfer._create')
@endsection

@section('scripts')

<!-- Alert fade closer script-->
<script src="{{ asset('customjs/alert_closer.js')}}"></script>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('customjs/datatable/dt_transfer.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('customjs/select2/s2_projects.js') }}"></script>

@endsection