<div class="modal modal-blur fade" id="modal-calendar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Calendario de comisiones</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="calendar-container" class="fullcalendar">
                    <!-- Calendar style -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="modalInfo" tabindex="-1" aria-labelledby="modalInfoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalInfoLabel">Información del Pago</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Aquí se mostrará la información -->
            </div>
        </div>
    </div>
</div>

<!-- Fullcalendar -->
<link href="<?php echo e(asset('vendor/fullcalendar/css/main.min.css')); ?>" rel="stylesheet">
<script src="<?php echo e(asset('vendor/fullcalendar/js/main.min.js')); ?>"></script>

<!-- Fullcalendar -->
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
               <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               {
                    title: '<?php echo e($payment->payment_code); ?>',
                    start: '<?php echo e($payment->payment_date); ?>',
                    extendedProps: {
                        paymentCode: '<?php echo e($payment->payment_code); ?>',
                        paymentAmount: 'Lps. <?php echo e(number_format($payment->payment_amount, 2)); ?>',
                        paymentDate: '<?php echo e($payment->payment_date); ?>',
                        commissionerName: '<?php echo e($payment->commissioner->commissioner_name); ?>',
                    }
               },
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
</script><?php /**PATH C:\Users\Carlos Rodriguez\Desktop\Code\InvestorInsight - experimental\resources\views/modules/payment_commissioners/_calendar.blade.php ENDPATH**/ ?>