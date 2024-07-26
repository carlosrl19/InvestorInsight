<?php $__env->startSection('head'); ?>
<!-- Datatable CSS -->
<link href="<?php echo e(asset('vendor/datatables/css/jquery.dataTables.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('vendor/datatables/css/buttons.dataTables.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pretitle'); ?>
Comisionistas <small>(<?php echo e(number_format($loadTime, 2)); ?> segundos)</small>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('create'); ?>
<button class="btn" onclick="goBack()" style="background-color: transparent; margin-right: 5px">
    &nbsp;<img src="<?php echo e(asset('../static/svg/arrow-back-up.svg')); ?>" width="20" height="20">&nbsp;
    Volver
</button>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
Historial de comisionista /&nbsp;
<b class="text-muted"><?php echo e($commissioner->commissioner_name); ?></b>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-xl">
        <div class="row mb-3">
            <div class="col-12">
                <div class="card mb-2">
                    <div class="card-body d-flex align-items-center">
                        <div class="col-auto me-4">
                            <img src="<?php echo e(asset('../static/svg/user-scan.svg')); ?>" width="90" height="90" alt="commissioner-image">
                        </div>
                        <div class="col">
                            <div class="accordion" id="accordion-example">
                                <div class="accordion-item" style="border: none">
                                    <h2 class="accordion-header" id="heading-1">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true">
                                            <h4>Información general del comisionista</h4>
                                        </button>
                                    </h2>
                                    <div id="collapse-1" class="accordion-collapse collapse show" data-bs-parent="#accordion-example">
                                        <div class="accordion-body pt-0">
                                            <strong><?php echo e($commissioner->commissioner_name); ?></strong> es un comisionista con número de identidad <strong><?php echo e($commissioner->commissioner_dni); ?></strong>, número de teléfono <strong><?php echo e($commissioner->commissioner_phone); ?></strong>,
                                            </strong> tiene un fondo total de Lps. <strong><?php echo e(number_format($commissioner->commissioner_balance,2)); ?></strong>. Fue ingresado al sistema en la fecha <strong><?php echo e($commissioner->created_at); ?></strong>.
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
                        <h3 class="card-title">Proyectos en proceso</h3>
                        <a href="<?php echo e(route('commission_agent.excel_active_projects', $commissioner)); ?>" class="badge bg-teal me-1 text-white" style="margin-left: 10px;">
                            <img style="filter: invert(100%) sepia(0%) saturate(7398%) hue-rotate(181deg) brightness(105%) contrast(102%);" src="<?php echo e(asset('../static/svg/file-spreadsheet.svg')); ?>" width="20" height="20" alt="">
                            EXPORTAR EXCEL
                        </a>
                    </div>
                    <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                        <div class="divide-y">
                            <div>
                                <div class="row">
                                    <table id="example0" class="display table table-bordered">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th style="width: 5%; text-align: center">Nº</th>
                                                <th style="width: 10%;">CÓDIGO</th>
                                                <th style="width: 68%;">PROYECTO</th>
                                                <th style="width: 15%;">COMISIÓN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $activeProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr style="text-align: center;">
                                                <td style="text-align: center"><?php echo e($i++); ?></td>
                                                <td>#<?php echo e($project->project_code); ?></td>
                                                <td><?php echo e($project->project_name); ?></td>
                                                <td class="text-left">L. <?php echo e(number_format($project->commissioner_commission, 2)); ?></td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="background-color: #95D2B3; padding: 10px; border: 4px solid #fff; justify-content: space-between;">
                        <span style="margin-left: 5%; font-weight: bold;">TOTAL COMISIONES EN PROCESO</span>
                        <span style="float: right; margin-right: 7%; color: #fff; font-size: clamp(0.7rem, 3vw, 0.8rem)">L. <?php echo e(number_format($activeProjects->sum('commissioner_commission'), 2)); ?></span>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card" style="min-height: auto; max-height: 20rem">
                    <div class="card-header">
                        <h3 class="card-title">Proyectos finalizados</h3>
                        <a href="<?php echo e(route('commission_agent.excel_terminated_projects', $commissioner)); ?>" class="badge bg-teal me-1 text-white" style="margin-left: 10px;">
                            <img style="filter: invert(100%) sepia(0%) saturate(7398%) hue-rotate(181deg) brightness(105%) contrast(102%);" src="<?php echo e(asset('../static/svg/file-spreadsheet.svg')); ?>" width="20" height="20" alt="">
                            EXPORTAR EXCEL
                        </a>
                    </div>
                    <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                        <div class="divide-y">
                            <div>
                                <div class="row">
                                    <table id="example1" class="display table table-bordered">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>Nº</th>
                                                <th>CÓDIGO</th>
                                                <th>PROYECTO</th>
                                                <th>COMISIÓN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $completedProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr style="text-align: center;">
                                                <td><?php echo e($i++); ?></td>
                                                <td>#<?php echo e($project->project_code); ?></td>
                                                <td><?php echo e($project->project_name); ?></td>
                                                <td>L. <?php echo e(number_format($project->commissioner_commission, 2)); ?></td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="background-color: #95D2B3; padding: 10px; border: 4px solid #fff; justify-content: space-between;">
                        <span style="margin-left: 5%; font-weight: bold;">TOTAL GANANCIA DE PROYECTOS</span>
                        <span style="float: right; margin-right: 7%; color: #fff; font-size: clamp(0.7rem, 3vw, 0.8rem)">L. <?php echo e(number_format($completedProjects->sum('commissioner_commission'),2)); ?></span>
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
<script src="<?php echo e(asset('customjs/datatable/dt_history.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/carlos/Code/InvestorInsight/resources/views/modules/commission_agent/show.blade.php ENDPATH**/ ?>