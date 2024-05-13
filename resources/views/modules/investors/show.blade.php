@extends('layout.admin')

@section('head')
<style>
.angry-grid {
   display: grid; 

   grid-template-rows: 1fr 1fr 1fr;
   grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
   
   gap: 0px;
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
Historial de inversionista /&nbsp;<b class="text-muted">{{ $investor->investor_name }}<b/>
@endsection

@section('content')
<div class="container-xl">
   <div class="card">
      <div class="card-body">
         <div class="angry-grid">
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
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Fecha</th>
                                                                <th>Banco</th>
                                                                <th>Monto</th>
                                                                <th>Historial saldo</th>
                                                                <th>Comentarios</th>
                                                            </tr>
                                                        </thead>
                                                        @php
                                                            $current_balance = 0;
                                                        @endphp

                                                        <tbody>
                                                            @foreach($transfers as $transfer)
                                                                @php
                                                                    $current_balance += $transfer->transfer_amount;
                                                                @endphp
                                                                <tr>
                                                                    <td>{{ $transfer->transfer_date }}</td>
                                                                    <td>{{ $transfer->transfer_bank }}</td>
                                                                    <td class="text-green">Lps. {{ number_format($transfer->transfer_amount,2) }} <sup>+</sup> </td>
                                                                    <td>Lps. {{ number_format($current_balance, 2) }}</td>
                                                                    <td title="Comentario: {{ $transfer->transfer_description }}" data-bs-toggle="tooltip" data-bs-placement="right" class="text-muted" style="max-width: 20px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><i>Ver más ...</i></td>
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
                                                        <th>Monto solicitado</th>
                                                        <th>Historial saldo</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody> 
                                                    <tr>
                                                        <td>{{ $transfer->transfer_date }}</td>
                                                        <td class="text-red">Lps. {{ number_format($transfer->transfer_amount,2) }} <sup>-</sup> </td>
                                                        <td title="Motivo: {{ $transfer->transfer_description }}" data-bs-toggle="tooltip" data-bs-placement="right">Lps. {{ number_format($current_balance, 2) }}</td>
                                                    </tr>
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
            <div id="item-2">
            </div>
         </div>
      </div>
   </div>
</div>
@endsection