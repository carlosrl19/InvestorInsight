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
    <div class="card">
      <div class="card-body">
        <table id="example" class="display table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Banco</th>
                    <th>Código transferencia</th>
                    <th>Inversionista</th>
                    <th>Monto transferencia</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transfers as $i => $transfer)
                <tr class="text-center">
                    <td>{{ ++$i }}</td>
                    <td>{{ $transfer->transfer_date }}</td>
                    <td>{{ $transfer->transfer_bank }}</td>
                    <td>{{ $transfer->transfer_code }}</td>
                    <td><a href="{{ route('investor.show', $transfer->investor_id) }}"  title="Ver historial de {{ $transfer->investor->investor_name }}" data-bs-toggle="tooltip" data-bs-placement="bottom">{{ $transfer->investor->investor_name }}</a></td>
                    <td>Lps. {{ number_format($transfer->transfer_amount,2) }}</td>
                </tr>
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
@endsection