@extends('layout.admin')

@section('head')
<!-- Datatable CSS -->
<link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/datatables/css/buttons.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/datatable.css') }}" rel="stylesheet">

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">

<!-- Fullcalendar -->
<link href="{{ asset('vendor/fullcalendar/css/main.min.css') }}" rel="stylesheet">
@endsection

@section('pretitle')
Listado principal
@endsection

@section('title')
Pagos comisionistas
@endsection

@section('create')
<div style="background-color: orange; color: #fff; border-radius: 10px; padding: 3px 9px 3px 0px">
    <a onclick="showList()">
        <img alt="image" id="list-active" width="25" src="{{ asset('static/svg/calendar.svg') }}">
        &nbsp; Modo lista
    </a>
    &nbsp;&nbsp;
    <a onclick="showCalendar()">
        <img alt="image" id="calendar-active" width="25" src="{{ asset('static/svg/list.svg') }}">
        &nbsp; Modo calendario
    </a>
</div>

<a href="#" class="btn btn-primary" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" data-bs-toggle="modal" data-bs-target="#modal-payment">
    + Nuevo pago
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
    <div class="card card-list-filters mb-2">
        <div class="card-body">
           <div id="search-filters-container">FILTROS</div>
        </div>
    </div>
    <div class="card card-list">
      <div class="card-body">
        <table id="example" class="display table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>CÓDIGO</th>
                    <th>FECHA HORA</th>
                    <th>NOMBRE COMISIONISTA</th>
                    <th>MONTO TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                <tr class="text-center">
                    <td>#{{ $payment->payment_code }}</td>
                    <td>{{ $payment->payment_date }}</td>
                    <td>{{ $payment->commissioner->commissioner_name }}</td>
                    <td class="text-red">Lps. {{ number_format($payment->payment_amount,2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>
    </div>

    <div class="card mt-3 card-calendar">
        <div class="card-body">
            <div id="calendar-container" class="fullcalendar">
                <!-- Calendar style -->
            </div>
        </div>
    </div>
</div>

@include('modules.payment_commissioners._create')
@endsection

@section('scripts')
<!-- Fullcalendar -->
<script src="{{ asset('customjs/fullcalendar/fullcalendar-config.js') }}"></script>
<script src="{{ asset('vendor/fullcalendar/js/main.min.js') }}"></script>

<script>
   document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar-container');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'title,prev,next',
                right: 'today',
                center: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            selectable: true,
            editable: false,
            nowIndicator: true,

            events: [
               @foreach($payments as $payment)
               {
                    title: '{{ $payment->payment_code }}',
                    start: '{{ $payment->payment_date }}',
                    extendedProps: {
                        paymentCode: '{{ $payment->payment_code }}',
                        paymentAmount: 'Lps. {{ number_format($payment->payment_amount, 2) }}',
                        paymentDate: '{{ $payment->payment_date }}',
                        commissionerName: '{{ $payment->commissioner->commissioner_name }}',
                    }
               },
               @endforeach
           ],

            eventClick: function(info) {
                // Obtener la información del evento
                var paymentCode = info.event.extendedProps.paymentCode;
                var paymentAmount = info.event.extendedProps.paymentAmount;
                var paymentDate = info.event.extendedProps.paymentDate;
                var commissionerName = info.event.extendedProps.commissionerName;

                // Mostrar la información en un modal
                $('#modalInfo .modal-body').html(`
                    <strong>Código de Pago:</strong> #${paymentCode}<br>
                    <strong>Monto:</strong> ${paymentAmount}<br>
                    <strong>Fecha:</strong> ${paymentDate}<br>
                    <strong>Comisionista:</strong> ${commissionerName}<br>
                `);
                $('#modalInfo').modal('show');
           }
       });
       calendar.render();
   });
</script>

<!-- Alert fade closer script-->
<script src="{{ asset('customjs/alert_closer.js')}}"></script>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('customjs/datatable/dt_transfer.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('customjs/select2/s2_init.js') }}"></script>
@endsection
