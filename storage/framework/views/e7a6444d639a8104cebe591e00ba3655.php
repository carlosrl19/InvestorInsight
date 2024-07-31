<?php $__env->startSection('head'); ?>
<!-- Datatable CSS -->
<link href="<?php echo e(asset('vendor/datatables/css/jquery.dataTables.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('vendor/datatables/css/buttons.dataTables.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pretitle'); ?>
Prestamistas
<?php $__env->stopSection(); ?>

<?php $__env->startSection('create'); ?>
<button class="btn" onclick="goBack()" style="background-color: transparent; margin-right: 5px">
    &nbsp;<img src="<?php echo e(asset('../static/svg/arrow-back-up.svg')); ?>" width="20" height="20">&nbsp;
    Volver
</button>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
Historial de prestamista /&nbsp;
<b class="text-muted"><?php echo e($moneylender->moneylender_name); ?></b>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-xl">
        <div class="row mb-3">
            <div class="col-12">
                <div class="card mb-2">
                    <div class="card-body d-flex align-items-center">
                        <div class="col-auto me-4">
                            <img src="<?php echo e(asset('../static/svg/user-pentagon.svg')); ?>" width="90" height="90" alt="moneylender-image">
                        </div>
                        <div class="col">
                            <div class="accordion" id="accordion-example">
                                <div class="accordion-item" style="border: none">
                                    <h2 class="accordion-header" id="heading-1">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true">
                                            <h4>Información general del prestamista</h4>
                                        </button>
                                    </h2>
                                    <div id="collapse-1" class="accordion-collapse collapse show" data-bs-parent="#accordion-example">
                                        <div class="accordion-body pt-0">
                                            <strong><?php echo e($moneylender->moneylender_name); ?></strong> es un prestamista con número de identidad <strong><?php echo e($moneylender->moneylender_dni); ?></strong>, número de teléfono <strong><?php echo e($moneylender->moneylender_phone); ?></strong></strong>. Fue ingresado al sistema en la fecha <strong><?php echo e($moneylender->created_at); ?></strong>.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card" style="min-height: auto; max-height: 20rem">
                    <div class="card-header">
                        <h3 class="card-title">Préstamos activos</h3>
                    </div>
                    <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                        <div class="divide-y">
                            <div>
                                <div class="row">
                                    <table id="moneylender_active" class="display table table-bordered">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th style="width: 5%; text-align: center">Nº</th>
                                                <th style="width: 10%;">CÓDIGO</th>
                                                <th style="width: 28%;">MONTO PRÉSTAMO</th>
                                                <th style="width: 55%;">MOTIVO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card" style="min-height: auto; max-height: 20rem">
                    <div class="card-header">
                        <h3 class="card-title">Préstamos pagados</h3>
                    </div>
                    <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                        <div class="divide-y">
                            <div>
                                <div class="row">
                                    <table id="moneylender_payments" class="display table table-bordered">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>Nº</th>
                                                <th>CÓDIGO</th>
                                                <th>PROYECTO</th>
                                                <th>COMISIÓN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<!-- Redirect button -->
<script src="<?php echo e(asset('customjs/return_redirect.js')); ?>"></script>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="<?php echo e(asset('vendor/datatables/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('customjs/datatable/dt_moneylender.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/carlos/Code/InvestorInsight/resources/views/modules/moneylenders/show.blade.php ENDPATH**/ ?>