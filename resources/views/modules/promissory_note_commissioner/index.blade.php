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
Pagarés comisionistas
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
                        <th>CÓDIGO</th>
                        <th>PROYECTO</th>
                        <th>FECHA EMISIÓN</th>
                        <th>FECHA PAGO</th>
                        <th>COMISIONISTA</th>
                        <th>MONTO PAGARÉ</th>
                        <th>ESTADO PAGARÉ</th>
                        <th>EXPORTAR PAGARÉ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($promissoryNotesCommissioner as $promissoryNote)
                    <tr class="text-center">
                        <td>#{{ $promissoryNote->promissoryNoteCommissioner_code }}</td>
                        <td>{{ $promissoryNote->project->project_name }}</td>
                        <td>{{ $promissoryNote->promissoryNoteCommissioner_emission_date }}</td>
                        <td>{{ $promissoryNote->promissoryNoteCommissioner_final_date }}</td>
                        <td>
                            <a href="{{ route('commission_agent.show', $promissoryNote) }}">{{ $promissoryNote->commissioner->commissioner_name }}
                                <small>
                                    <sup>
                                    <img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="{{ asset('../static/svg/link.svg') }}" width="20" height="20" alt="">
                                    </sup>
                                </small>
                            </a>
                        </td>
                        <td>Lps. {{ number_format($promissoryNote->promissoryNoteCommissioner_amount,2) }}</td>
                        <td>
                            @if($promissoryNote->promissoryNoteCommissioner_status == '1')
                                <span class="badge bg-orange me-1"></span>  Emitido / Sin pagar
                            @elseif($promissoryNote->promissoryNoteCommissioner_status == '0')
                                <span class="badge bg-success me-1"></span>  Emitido / Pagado
                            @else
                                <span class="badge bg-red me-1"></span> Estado inválido
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('promissory_note_commissioner.report', $promissoryNote->id) }}" style="font-size: clamp(0.6rem, 3vw, 0.65rem);" class="btn btn-sm btn-red" data-toggle="modal" data-target="#pdfModal">
                            &nbsp;&nbsp;&nbsp;<img style="filter: invert(99%) sepia(43%) saturate(0%) hue-rotate(95deg) brightness(110%) contrast(101%);" src="{{ asset('../static/svg/file-text.svg') }}" width="20" height="20" alt="">
                            &nbsp;PAGARÉ
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Modal -->
            <div class="modal fade modal-blur" id="pdfModal" data-backdrop="static" data-keyboard="false"  tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="pdfModalLabel">Previsualización de pagaré</h5>
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

@section('scripts')

<!-- Alert fade closer script-->
<script src="{{ asset('customjs/alert_closer.js')}}"></script>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('customjs/datatable/dt_transfer.js') }}"></script>

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