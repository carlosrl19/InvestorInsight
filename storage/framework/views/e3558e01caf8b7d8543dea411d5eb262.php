<?php $__env->startSection('head'); ?>
<!-- Datatable CSS -->
<link href="<?php echo e(asset('vendor/datatables/css/jquery.dataTables.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('vendor/datatables/css/buttons.dataTables.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pretitle'); ?>
Inversionistas <small>(<?php echo e(number_format($loadTime, 2)); ?> segundos)</small>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('create'); ?>
<button class="btn" onclick="goBack()" style="background-color: transparent; margin-right: 5px">
    &nbsp;<img src="<?php echo e(asset('../static/svg/arrow-back-up.svg')); ?>" width="20" height="20">&nbsp;
    Volver
</button>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
Historial de prestamista /&nbsp;
<b class="text-muted"><?php echo e($moneylender->moneylender_name); ?>&nbsp;</b>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-xl">
        <!-- General information about moneylender -->
        <div class="row mb-2">
            <div class="col-12">
                <div class="card mb-2">
                    <div class="card-body d-flex align-items-center">
                        <div class="col-auto me-4" style="border: 4px solid #000; border-radius: 10px">
                            <img src="<?php echo e(asset('../static/svg/user-dollar.svg')); ?>" width="90" height="90" alt="">
                        </div>
                        <div class="col">
                            <div class="accordion" id="accordion-example">
                                <div class="accordion-item" style="border: none;">
                                    <h2 class="accordion-header" id="heading-1">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true">
                                            <h4>Información general del inversionista</h4>
                                        </button>
                                    </h2>
                                    <div id="collapse-1" class="accordion-collapse collapse show" data-bs-parent="#accordion-example">
                                        <div class="accordion-body pt-0">
                                            <strong><?php echo e($moneylender->moneylender_name); ?></strong> es un prestamista con número de identidad <strong><?php echo e($moneylender->moneylender_dni); ?></strong>, número de teléfono <strong><?php echo e($moneylender->moneylender_phone); ?></strong>.
                                            y afiliado a la empresa <strong><?php echo e($moneylender->moneylender_company_name); ?></strong>. Fue ingresado al sistema en la fecha <strong><?php echo e($moneylender->created_at); ?></strong>.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loans table -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="card" style="min-height: auto; max-height: 20rem">
                    <div class="card-header">
                        <h3 class="card-title">Historial de préstamos</h3>
                    </div>
                    <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                        <div class="divide-y">
                            <div>
                                <div class="row">
                                    <table id="loans" class="display table table-bordered">
                                        <thead>
                                            <tr style="text-align: center">
                                                <th>FECHA EMISION</th>
                                                <th>MONTO</th>
                                                <th>INTERES</th>
                                                <th>MONTO TOTAL</th>
                                                <th>PRESTATARIO</th>
                                                <th>MOTIVO / COMENTARIO</th>
                                                <th>PAGAR</th>
                                                <th>EXPORTAR</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php $__currentLoopData = $moneylender_loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               <tr style="text-align: center">
                                                    <td><?php echo e($loan->loan_emission_date); ?></td>
                                                    <td>Lps. <?php echo e(number_format($loan->loan_amount,2)); ?></td>
                                                    <td><?php echo e($loan->loan_tax); ?>%</td>
                                                    <td>Lps. <?php echo e($loan->loan_total_amount); ?></td>
                                                    <td><?php echo e($loan->commissioner->commissioner_name); ?></td>
                                                    <td><?php echo e($loan->loan_description); ?></td>
                                                    <td>
                                                        <a href="<?php echo e(route('moneylender_loans.payment', $loan->id)); ?>" class="badge bg-red me-1 text-white">
                                                            $ REALIZAR PAGO
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="" class="badge bg-teal me-1 text-white">
                                                            <img style="filter: invert(100%) sepia(0%) saturate(7398%) hue-rotate(181deg) brightness(105%) contrast(102%);" src="<?php echo e(asset('../static/svg/file-spreadsheet.svg')); ?>" width="20" height="20" alt="">
                                                            EXCEL
                                                        </a>
                                                    </td>
                                                </tr>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<script src="<?php echo e(asset('customjs/datatable/dt_loans.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/carlos/Code/En proceso/InvestorInsight/resources/views/modules/moneylenders/show.blade.php ENDPATH**/ ?>