@extends('layout.admin')

@section('head')
<style>
.angry-grid {
   display: grid; 

   grid-template-rows: 1fr 1fr 1fr;
   grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
   
   gap: 10px;
   height: 100%;
}
  
#item-0 {

   grid-row-start: 1;
   grid-column-start: 1;

   grid-row-end: 4;
   grid-column-end: 2;
   
}

#item-1 {

   grid-row-start: 1;
   grid-column-start: 3;

   grid-row-end: 4;
   grid-column-end: 4;
   
}

#item-2 {
   background-color: #76F99F; 
   grid-row-start: 1;
   grid-column-start: 5;
   grid-row-end: 4;
   grid-column-end: 6;
   
}
</style>
@endsection

@section('pretitle')
Inversionistas
@endsection

@section('title')
Historial de inversionista /&nbsp;<b class="text-muted">{{ $investor->investor_name }}</b>
@endsection

@section('content')
<div class="container-xl">
    <div class="card mb-2">
        <div class="card-body">
            <div class="accordion" id="accordion-example">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-1">
                    <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true">
                        <h4>Información general del inversionista</h4>
                    </button>
                    </h2>
                    <div id="collapse-1" class="accordion-collapse collapse show" data-bs-parent="#accordion-example">
                        <div class="accordion-body pt-0">
                            <strong>{{ $investor->investor_name }}</strong> es un inversionista con número de identidad <strong>{{ $investor->investor_dni }}</strong>, número de teléfono <strong>{{ $investor->investor_phone }}</strong>.
                            Recomendado por <strong>{{ $investor->investor_reference }}</strong>, tiene un saldo actual de Lps. <strong>{{ number_format($investor->investor_balance,2) }}</strong>. Fue ingresado al sistema en la fecha <strong>{{ $investor->created_at }}</strong>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div id="item-0">
                <div class="col-lg-12">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="card" style="height: 21rem">
                                <div class="card-header">
                                    <h3 class="card-title">Historial de transferencias</h3>
                                </div>
                                <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                                    <div class="divide-y">
                                        <div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="text-truncate">
                                                        <table class="table table-bordered" style="width: 100%;">
                                                            <thead>
                                                            <tr>
                                                                <th>Fecha</th>
                                                                <th>Banco</th>
                                                                <th>Monto transferencia</th>
                                                                <th>Saldo actual</th>
                                                                <th>Nuevo saldo</th>
                                                                <th>Comentarios</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($transfers as $transfer)
                                                                <tr>
                                                                    <td>{{ $transfer->transfer_date }}</td>
                                                                    <td class="text-uppercase">{{ $transfer->transfer_bank }}</td>
                                                                    <td class="text-green">Lps. {{ number_format($transfer->transfer_amount, 2) }}</td>
                                                                    <td>Lps. {{ number_format($transfer->current_balance - $transfer->transfer_amount, 2) }}</td>
                                                                    <td>Lps. {{ number_format($transfer->current_balance, 2) }}</td>
                                                                    <td title="Comentario: {{ $transfer->transfer_description }}" data-bs-toggle="tooltip" data-bs-placement="right" class="text-muted" style="max-width: 20px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><i>Ver comentarios ...</i></td>
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
                </div>
            </div>
        </div> <!-- Card body close -->
    </div>
    
    <div class="card">
        <div class="card-body">
            <div id="item-1">
                <div class="col-lg-12">
                    <div class="row row-cards">
                        <div class="col-12">
                            <div class="card" style="height: 21rem">
                                <div class="card-header">
                                    <h3 class="card-title">Historial de notas crédito</h3>
                                </div>
                                <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                                <div class="divide-y">
                                    <div>
                                        <div class="row">
                                        <div class="col">
                                            <div class="text-truncate">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Monto nota crédito</th>
                                                        <th>Saldo actual</th>
                                                        <th>Nuevo saldo</th>
                                                        <th>Comentarios</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($creditNotes as $creditNote)
                                                    <tr>
                                                        <td>{{ $creditNote->creditNote_date }}</td>
                                                        <td class="text-red">Lps. {{ number_format($creditNote->creditNote_amount, 2) }}</td>
                                                        <td>Lps. {{ number_format($creditNote->current_balance + $creditNote->creditNote_amount, 2) }}</td>
                                                        <td>Lps. {{ number_format($creditNote->current_balance, 2) }}</td>
                                                        <td title="Comentario: {{ $creditNote->creditNote_description }}" data-bs-toggle="tooltip" data-bs-placement="right" class="text-muted" style="max-width: 20px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><i>Ver comentarios ...</i></td>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection