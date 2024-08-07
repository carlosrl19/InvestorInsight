<?php $__env->startSection('head'); ?>
<!-- Datatable CSS -->
<link href="<?php echo e(asset('vendor/datatables/css/jquery.dataTables.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('vendor/datatables/css/buttons.dataTables.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('css/datatable.css')); ?>" rel="stylesheet">

<!-- Select2 -->
<link rel="stylesheet" href="<?php echo e(asset('vendor/select2/select2.min.css')); ?>">

<!-- Fullcalendar -->
<link href="<?php echo e(asset('vendor/fullcalendar/css/main.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pretitle'); ?>
Listado principal
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
Pagos comisionistas
<?php $__env->stopSection(); ?>

<?php $__env->startSection('create'); ?>
<div style="background-color: rgb(23, 162, 184); color: #fff; border-radius: 4px; padding: 3px 9px 3px 9px">
    <a class="btn btn-sm bg-cyan text-white" id="btn-list" style="font-size: clamp(0.6rem, 3vw, 0.65rem)" onclick="showList()">
        <img style="filter: brightness(0) saturate(100%) invert(89%) sepia(100%) saturate(1%) hue-rotate(258deg) brightness(104%) contrast(101%);" alt="image" id="list-active" width="25" src="<?php echo e(asset('static/svg/calendar.svg')); ?>">
        &nbsp; Modo lista
    </a>
    &nbsp;&nbsp;
    <a class="btn btn-sm bg-cyan text-white" id="btn-calendar" style="font-size: clamp(0.6rem, 3vw, 0.65rem)" onclick="showCalendar()">
        <img style="filter: brightness(0) saturate(100%) invert(89%) sepia(100%) saturate(1%) hue-rotate(258deg) brightness(104%) contrast(101%);" alt="image" id="calendar-active" width="25" src="<?php echo e(asset('static/svg/list.svg')); ?>">
        &nbsp; Modo calendario
    </a>
</div>

<a href="#" class="btn btn-orange" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" data-bs-toggle="modal"
    data-bs-target="#modal-promissoryCommissionerNotes">
    <img style="filter: invert(100%) sepia(0%) saturate(7398%) hue-rotate(181deg) brightness(105%) contrast(102%); margin-right: 5px"
        src="<?php echo e(asset('../static/svg/receipt.svg')); ?>" width="20" height="20" alt="">
    Pagarés
</a>


<!-- 
<a href="#" class="btn btn-primary" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" data-bs-toggle="modal" data-bs-target="#modal-payment">
    + Nuevo pago
</a>
-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" style="margin-right: 10vh; margin-left: 10vh; font-size: clamp(0.6rem, 3.2vw, 0.8rem);" role="alert" data-auto-dismiss="4000">
        <strong><?php echo e(session('success')); ?></strong>
    </div>
    <?php endif; ?>
    
    <?php if($errors->any()): ?>
    <div class="alert alert-danger alert-dismissible" alert-dismissible fade show" style="margin-right: 10vh; margin-left: 10vh; font-size: clamp(0.6rem, 3.2vw, 0.8rem);" role="alert" data-auto-dismiss="10000">
        <strong>El formulario contiene los siguientes errores:</strong>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>

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
                    <th>NOMBRE PROYECTO</th>
                    <th>MONTO A PAGAR</th>
                    <th>EXPORTAR <br>REPORTE DE PAGO</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="text-center">
                    <td>#<?php echo e($payment->payment_code); ?></td>
                    <td><?php echo e($payment->payment_date); ?></td>
                    <td><?php echo e($payment->commissioner->commissioner_name); ?></td>
                    <td><?php echo e($payment->project->project_name); ?></td>
                    <td class="text-red">Lps. <?php echo e(number_format($payment->payment_amount,2)); ?></td>
                    
                    <?php if($payment->commissioner->id == 1): ?>
                        <td class="text-red">
                            No necesario
                        </td>
                    <?php else: ?>
                        <td class="text-red">
                            <a href="<?php echo e(route('payments_commissioner.report', $payment->id)); ?>" class="badge bg-red me-1 text-white" data-toggle="modal" data-target="#pdfModal">
                                <img style="filter: invert(100%) sepia(0%) saturate(7398%) hue-rotate(181deg) brightness(105%) contrast(102%);" src="<?php echo e(asset('../static/svg/file-text.svg')); ?>" width="20" height="20" alt="">
                                REPORTE DE PAGO
                            </a>
                        </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        
        <!-- PDF Viewer Modal -->
        <div class="modal fade modal-blur" id="pdfModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pdfModalLabel">Previsualización de reporte de pago de comisión</h5>
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

    <!-- Calendar style container -->
    <div class="card mt-3 card-calendar">
        <div class="card-body">
            <div id="calendar-container" class="fullcalendar">
                <!-- Calendar style -->
            </div>
        </div>
    </div>

    <!-- Calendar's information modal -->
    <div class="modal modal-blur fade" id="modalInfo" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalInfoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalInfoLabel">Más información</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Aquí se mostrará la información -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('modules.payment_commissioners._create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('modules.promissory_note_commissioner._index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<!-- Alert fade closer script-->
<script src="<?php echo e(asset('customjs/alert_closer.js')); ?>"></script>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="<?php echo e(asset('vendor/datatables/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('customjs/datatable/dt_transfer.js')); ?>"></script>

<!-- Select2 -->
<script src="<?php echo e(asset('vendor/select2/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('customjs/select2/s2_init.js')); ?>"></script>


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

<!-- Fullcalendar -->
<script src="<?php echo e(asset('customjs/fullcalendar/fullcalendar-config.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/fullcalendar/js/main.min.js')); ?>"></script>

<script>
   document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar-container');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'title,prev,next',
                right: 'today',
                center: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week: 'Semana',
                day: 'Día',
                list: 'Lista'
            },
            allDayText: 'Todo el día',
            locales: 'es',
            selectable: true,
            editable: false,
            nowIndicator: true,

            events: [
               <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               {
                    title: 'L. <?php echo e(number_format($payment->payment_amount, 2)); ?>',
                    start: '<?php echo e($payment->payment_date); ?>',
                    extendedProps: {
                        paymentCode: '<?php echo e($payment->payment_code); ?>',
                        paymentAmount: 'Lps. <?php echo e(number_format($payment->payment_amount, 2)); ?>',
                        paymentDate: '<?php echo e($payment->payment_date); ?>',
                        commissionerName: '<?php echo e($payment->commissioner->commissioner_name); ?>',
                        projectName: '<?php echo e($payment->project->project_name); ?>',
                        commissionerId: '<?php echo e($payment->commissioner_id); ?>'
                    }
               },
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           ],

            eventDidMount: function(info) {
                // Cambiar el color del evento si commissionerId es 1
                if (info.event.extendedProps.commissionerId == 1) {
                    info.el.style.backgroundColor = '#AE0773'; // Color de fondo
                    info.el.style.borderColor = '#AE0773'; // Color del borde
                }
            },

            eventClick: function(info) {
                // Obtener la información del evento
                var projectName = info.event.extendedProps.projectName;
                var paymentCode = info.event.extendedProps.paymentCode;
                var paymentAmount = info.event.extendedProps.paymentAmount;
                var paymentDate = info.event.extendedProps.paymentDate;
                var commissionerName = info.event.extendedProps.commissionerName;

                // Mostrar la información en un modal
                $('#modalInfo .modal-body').html(`
                    <div style="text-align: center; border: 2px solid green; padding: 10px; background-color: #A8E2C0;">
                        <p style="font-size: 16px; font-weight: bold;">DETALLES DEL PAGO <span style="text-decoration: underline;">#${paymentCode}</span></p>
                        <strong style="line-height: 1.8; font-size: clamp(0.6rem, 3vw, 0.8rem);">Nombre del proyecto:</strong> <span style="font-size: clamp(0.6rem, 3vw, 0.8rem">${projectName}</span><br>
                        <strong style="line-height: 1.8; font-size: clamp(0.6rem, 3vw, 0.8rem);">Comisionista:</strong> <span style="font-size: clamp(0.6rem, 3vw, 0.8rem">${commissionerName}</span><br>
                        <strong style="line-height: 1.8; font-size: clamp(0.6rem, 3vw, 0.8rem);">Monto de pago:</strong> <span style="font-size: clamp(0.6rem, 3vw, 0.8rem">${paymentAmount}</span><br>
                        <strong style="line-height: 1.8; font-size: clamp(0.6rem, 3vw, 0.8rem);">Fecha de pago:</strong> <span style="font-size: clamp(0.6rem, 3vw, 0.8rem">${paymentDate}</span><br>
                    </div>
                `);
                $('#modalInfo').modal('show');
           }
       });
       calendar.render();
   });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/carlos/Code/InvestorInsight/resources/views/modules/payment_commissioners/index.blade.php ENDPATH**/ ?>