<?php $__env->startSection('head'); ?>

<!-- Datatable CSS -->
<link href="<?php echo e(asset('vendor/datatables/css/jquery.dataTables.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('vendor/datatables/css/buttons.dataTables.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('css/datatable.css')); ?>" rel="stylesheet">

<!-- Select2 -->
<link rel="stylesheet" href="<?php echo e(asset('vendor/select2/select2.min.css')); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pretitle'); ?>
Listado principal
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
Pagos inversionistas
<?php $__env->stopSection(); ?>

<?php $__env->startSection('create'); ?>
<a href="#" class="btn btn-orange" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" data-bs-toggle="modal"
    data-bs-target="#modal-promissoryInvestorNotes">
    <img style="filter: invert(100%) sepia(0%) saturate(7398%) hue-rotate(181deg) brightness(105%) contrast(102%); margin-right: 5px"
        src="<?php echo e(asset('../static/svg/receipt.svg')); ?>" width="20" height="20" alt="">
    Pagarés
</a>

<a href="#" class="btn btn-primary" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" data-bs-toggle="modal"
    data-bs-target="#modal-payment">
    + Nuevo pago
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show"
        style="margin-right: 10vh; margin-left: 10vh; font-size: clamp(0.6rem, 3.2vw, 0.8rem);" role="alert"
        data-auto-dismiss="4000">
        <strong><?php echo e(session('success')); ?></strong>
    </div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="alert alert-danger alert-dismissible" alert-dismissible fade show"
        style="margin-right: 10vh; margin-left: 10vh; font-size: clamp(0.6rem, 3.2vw, 0.8rem);" role="alert"
        data-auto-dismiss="10000">
        <strong>El formulario contiene los siguientes errores:</strong>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<div class="container-xl">
    <div class="card mb-2">
        <div class="card-body">
            <div id="search-filters-container">FILTROS</div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="investorPayments" class="display table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>CODIGO <br>PAGO</th>
                        <th>FECHA / HORA <br>PAGO</th>
                        <th>NOMBRE <br>INVERSIONISTA</th>
                        <th>MONTO A PAGAR</th>
                        <th>REPORTE DE PAGO <br>DE COMISIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="text-center">
                            <td>#<?php echo e($payment->payment_code); ?></td>
                            <td><?php echo e($payment->payment_date); ?></td>
                            <td>
                                <a href="<?php echo e(route('investor.show', $payment->investor)); ?>"><?php echo e($payment->investor->investor_name); ?>

                                    <small>
                                        <sup>
                                            <img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);"
                                                src="<?php echo e(asset('../static/svg/link.svg')); ?>" width="20" height="20" alt="">
                                        </sup>
                                    </small>
                            </td>
                            <td class="text-red">Lps. <?php echo e(number_format($payment->payment_amount, 2)); ?></td>
                            <td class="text-red">
                                <a href="<?php echo e(route('payments_investor.report', $payment->id)); ?>"
                                    class="badge bg-red me-1 text-white" data-toggle="modal" data-target="#pdfModal">
                                    <img style="filter: invert(100%) sepia(0%) saturate(7398%) hue-rotate(181deg) brightness(105%) contrast(102%);"
                                        src="<?php echo e(asset('../static/svg/file-text.svg')); ?>" width="20" height="20" alt="">
                                    REPORTE DE PAGO
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <!-- PDF Viewer Modal -->
            <div class="modal fade modal-blur" id="pdfModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
                role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="pdfModalLabel">Previsualización de reporte de pago de comisión
                            </h5>
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

<?php echo $__env->make('modules.payment_investors._create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('modules.promissory_note._index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<!-- Alert fade closer script-->
<script src="<?php echo e(asset('customjs/alert_closer.js')); ?>"></script>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="<?php echo e(asset('vendor/datatables/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('customjs/datatable/dt_investor_payments.js')); ?>"></script>

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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/carlos/Code/InvestorInsight (Copiar)/resources/views/modules/payment_investors/index.blade.php ENDPATH**/ ?>