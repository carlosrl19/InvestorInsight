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
Historial de inversionista /&nbsp;
<b class="text-muted"><?php echo e($investor->investor_name); ?>&nbsp;</b>
    <?php if($investor->investor_status == 3): ?>/&nbsp;
        <span class="status-dot status-dot-animated bg-red d-block"></span>&nbsp;
        <span style="color: rgb(231, 0, 0); font-style: italic; font-size: clamp(0.7rem, 3vw, 0.8rem)">LIQUIDADO</span>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-xl">
        <!-- General information about investor -->
        <div class="row mb-2">
            <div class="col-12">
                <div class="card mb-2">
                    <div class="card-body d-flex align-items-center">
                        <div class="col-auto me-4">
                            <img src="<?php echo e(asset('../static/svg/user-scan.svg')); ?>" width="90" height="90" alt="">
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
                                            <strong><?php echo e($investor->investor_name); ?></strong> es un inversionista con número de identidad <strong><?php echo e($investor->investor_dni); ?></strong>, número de teléfono <strong><?php echo e($investor->investor_phone); ?></strong>.
                                            Recomendado por
                                            <strong>
                                                <?php if($referenceInvestor): ?>
                                                    <a href="<?php echo e(route('investor.show', ['investor' => $referenceInvestor->id])); ?>">
                                                        <strong><?php echo e($referenceInvestor->investor_name); ?></strong>&nbsp;<img style="margin-bottom: 0.4vh; filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="<?php echo e(asset('../static/svg/link.svg')); ?>" width="20" height="20" alt="">
                                                    </a>
                                                <?php else: ?>
                                                    <strong class="text-red">(no tiene recomendación)</strong>,
                                                <?php endif; ?>
                                            </strong>
                                            <?php if($investor->investor_status != 3): ?>
                                            y afiliado a la empresa <strong><?php echo e($investor->investor_company_name); ?></strong>, tiene un fondo monetario de Lps. <strong><?php echo e(number_format($investor->investor_balance,2)); ?></strong>. Fue ingresado al sistema en la fecha <strong><?php echo e($investor->created_at); ?></strong>.
                                            <?php else: ?>
                                            fue ingresado al sistema en la fecha <strong><?php echo e($investor->created_at); ?></strong>.
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Funds changes table -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="card" style="min-height: auto; max-height: 20rem">
                    <div class="card-header">
                        <h3 class="card-title">Historial de cambios en fondo de inversionista</h3>
                        <a href="<?php echo e(route('investors_funds.excel', $investor)); ?>" class="badge bg-teal me-1 text-white" style="margin-left: 10px;">
                            <img style="filter: invert(100%) sepia(0%) saturate(7398%) hue-rotate(181deg) brightness(105%) contrast(102%);" src="<?php echo e(asset('../static/svg/file-spreadsheet.svg')); ?>" width="20" height="20" alt="">
                            EXPORTAR EXCEL
                        </a>
                    </div>
                    <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                        <div class="divide-y">
                            <div>
                                <div class="row">
                                    <table class="display table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>FECHA CAMBIO</th>
                                                <th>MOVIMIENTOS EN FONDOS</th>
                                                <th>FONDO ANTERIOR</th>
                                                <th>FONDO FINAL</th>
                                                <th>MOTIVO / COMENTARIO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $investorFunds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $investor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <?php if($investor->investor_new_funds_comment != 'LIQUIDACIÓN AL INVERSIONISTA.'): ?>
                                                <tr>
                                                    <td><?php echo e($investor->investor_change_date); ?></td>
                                                                                                    
                                                    <?php if($investor->investor_new_funds - $investor->investor_old_funds < 0): ?>
                                                        <td class="text-red">
                                                            <img style="filter: brightness(0) saturate(100%) invert(27%) sepia(21%) saturate(6806%) hue-rotate(340deg) brightness(100%) contrast(86%);" src="<?php echo e(asset('../static/svg/arrow-down.svg')); ?>" width="12" height="12" alt="">
                                                            L. <?php echo e(number_format($investor->investor_new_funds - $investor->investor_old_funds,2)); ?>

                                                        </td>
                                                    <?php else: ?>
                                                        <td class="text-success">
                                                            <img style="filter: brightness(0) saturate(100%) invert(53%) sepia(52%) saturate(632%) hue-rotate(78deg) brightness(96%) contrast(93%);" src="<?php echo e(asset('../static/svg/arrow-up.svg')); ?>" width="12" height="12" alt="">
                                                            L. <?php echo e(number_format($investor->investor_new_funds - $investor->investor_old_funds,2)); ?>

                                                        </td>
                                                    <?php endif; ?>

                                                    <td>L. <?php echo e(number_format($investor->investor_old_funds, 2)); ?></td>
                                                    <td>L. <?php echo e(number_format($investor->investor_new_funds,2)); ?></td>
                                                    <td><?php echo e($investor->investor_new_funds_comment); ?></td>
                                                </tr>
                                                <?php else: ?>
                                                <tr style="background-color: #c649492f;">
                                                    <td><?php echo e($investor->investor_change_date); ?></td>
                                                                                                    
                                                    <?php if($investor->investor_new_funds - $investor->investor_old_funds < 0): ?>
                                                        <td class="text-red">
                                                            <img style="filter: brightness(0) saturate(100%) invert(27%) sepia(21%) saturate(6806%) hue-rotate(340deg) brightness(100%) contrast(86%);" src="<?php echo e(asset('../static/svg/arrow-down.svg')); ?>" width="12" height="12" alt="">
                                                            L. <?php echo e(number_format($investor->investor_new_funds - $investor->investor_old_funds,2)); ?></td>
                                                    <?php else: ?>
                                                        <td class="text-success">L. <?php echo e(number_format($investor->investor_new_funds - $investor->investor_old_funds,2)); ?></td>
                                                    <?php endif; ?>

                                                    <td>L. <?php echo e(number_format($investor->investor_old_funds, 2)); ?></td>
                                                    <td>L. <?php echo e(number_format($investor->investor_new_funds,2)); ?></td>
                                                    <td>
                                                        <span class="text-red"></span> <?php echo e($investor->investor_new_funds_comment); ?>

                                                    </td>
                                                </tr>
                                                <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="5" style="text-align: center;">No se encontraron registros de cambios en fondos para mostrar.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- In-process projects / Closed projects -->
        <div class="row mb-3">
            <!-- In-process projects table -->
            <div class="col-6">
                <div class="card" style="min-height: auto; max-height: 20rem">
                    <div class="card-header">
                        <h3 class="card-title">Proyectos en proceso</h3>
                    </div>
                    <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                        <div class="divide-y">
                            <div>
                                <div class="row">
                                    <table id="example0" class="display table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>CÓDIGO</th>
                                                <th>PROYECTO</th>
                                                <th>INVERSIÓN</th>
                                                <th>GANANCIA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $activeProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>#<?php echo e($project->project_code); ?></td>
                                                <td><?php echo e($project->project_name); ?></td>
                                                <td>L. <?php echo e(number_format($project->investor_investment, 2)); ?></td>
                                                <td>L. <?php echo e(number_format($project->investor_final_profit + $project->investor_investment, 2)); ?></td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="background-color: #95D2B3; padding: 10px; border: 4px solid #fff; justify-content: space-between;">
                        <span style="margin-left: 5%; font-weight: bold;">TOTAL GANANCIA EN PROCESO</span>
                        <span style="float: right; margin-right: 7%; color: #fff; font-size: clamp(0.7rem, 3vw, 0.8rem)">L. <?php echo e(number_format($activeProjects->sum('investor_investment') + $activeProjects->sum('investor_final_profit'), 2)); ?></span>
                    </div>
                </div>
            </div>

            <!-- Completed projects table -->
            <div class="col-6">
                <div class="card" style="min-height: auto; max-height: 20rem">
                    <div class="card-header">
                        <h3 class="card-title">Proyectos finalizados</h3>
                    </div>
                    <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                        <div class="divide-y">
                            <div>
                                <div class="row">
                                    <table id="example1" class="display table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>CÓDIGO</th>
                                                <th>PROYECTO</th>
                                                <th>INVERSIÓN</th>
                                                <th>GANANCIA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $completedProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>#<?php echo e($project->project_code); ?></td>
                                                    <td><?php echo e($project->project_name); ?></td>
                                                    <td>L. <?php echo e(number_format($project->investor_investment, 2)); ?></td>
                                                    <td>L. <?php echo e(number_format($project->investor_final_profit + $project->investor_investment, 2)); ?></td>
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
                        <span style="float: right; margin-right: 7%; color: #fff; font-size: clamp(0.7rem, 3vw, 0.8rem)">L. <?php echo e(number_format($completedProjects->sum('investor_investment') + $completedProjects->sum('investor_final_profit'), 2)); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tranfers history table -->
        <div class="row mb-4">
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
                                        <table id="example2" class="display table table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="width: 50px">FECHA</th>
                                                <th>BANCO</th>
                                                <th style="width: 120px">TRANSFERENCIA</th>
                                                <th style="width: 120px">FONDO ANTERIOR</th>
                                                <th style="width: 120px">NUEVO CAPITAL</th>
                                                <th style="width: 400px;">COMENTARIOS AGREGADOS A TRANSFERENCIA</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($transfer->transfer_date); ?></td>
                                                    <td class="text-uppercase"><?php echo e($transfer->transfer_bank); ?></td>
                                                    <td class="text-green">Lps. <?php echo e(number_format($transfer->transfer_amount, 2)); ?></td>
                                                    <td>Lps. <?php echo e(number_format($transfer->current_balance - $transfer->transfer_amount, 2)); ?></td>
                                                    <td>Lps. <?php echo e(number_format($transfer->current_balance, 2)); ?></td>
                                                    <td class="text-muted" style="max-width: 20px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo e($transfer->transfer_comment); ?></td>
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
    
        <!-- Credit notes history table -->
        <div class="row">
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
                                <table id="example3" class="display table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>FECHA</th>
                                        <th>MONTO NOTA CRÉDITO</th>
                                        <th>CAPITAL</th>
                                        <th>NUEVO FONDO</th>
                                        <th>COMENTARIOS AGREGADOS A NOTA CRÉDITO</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $creditNotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $creditNote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($creditNote->creditNote_date); ?></td>
                                        <td class="text-red">Lps. <?php echo e(number_format($creditNote->creditNote_amount, 2)); ?></td>
                                        <td>Lps. <?php echo e(number_format($creditNote->current_balance + $creditNote->creditNote_amount, 2)); ?></td>
                                        <td>Lps. <?php echo e(number_format($creditNote->current_balance, 2)); ?></td>
                                        <td class="text-muted" style="max-width: 20px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo e($creditNote->creditNote_description); ?></td>
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
<?php echo $__env->make('layout.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/carlos/Code/InvestorInsight/resources/views/modules/investors/show.blade.php ENDPATH**/ ?>