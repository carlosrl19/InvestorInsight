<?php $__env->startSection('head'); ?>

<!-- Datatable CSS -->
<link href="<?php echo e(asset('vendor/datatables/css/jquery.dataTables.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('vendor/datatables/css/buttons.dataTables.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('css/datatable.css')); ?>" rel="stylesheet">

<!-- Badge CSS -->
<link href="<?php echo e(asset('/css/project.css')); ?>" rel="stylesheet">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pretitle'); ?>
Listado principal
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
Proyectos cerrados
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-xl">
    <div class="card mb-2">
        <div class="card-body">
           <div id="search-filters-container">FILTROS</div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="example" class="display table table-bordered" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre proyecto</th>
                        <th>Inicio</th>
                        <th>Final</th>
                        <th>Inversionista</th>
                        <th>Inversión</th>
                        <th>Ganancia</th>
                        <th>Estado</th>
                        <th>Motivo de cierre</th>
                    </tr>
                </thead>
                <?php
                    $groupedProjects = $projects->groupBy('project_code');
                ?>
                <tbody>
                    <?php $__currentLoopData = $groupedProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectCode => $projectGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $project = $projectGroup->first();
                        ?>
                        <tr>
                            <td><?php echo e($project->project_code); ?></td>
                            <td style="max-width: 150px; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;">
                                <a href="<?php echo e(route('project.show', $project)); ?>">
                                    <?php echo e($project->project_name); ?>

                                    &nbsp;<img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="<?php echo e(asset('../static/svg/link.svg')); ?>" width="20" height="20" alt="">
                                </a>
                            </td>
                            <td><?php echo e($project->project_start_date); ?></td>
                            <td style="text-decoration:line-through;"><?php echo e($project->project_end_date); ?></td>                            
                            <td>
                                <?php $__currentLoopData = $project->investors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $investor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('investor.show', $investor)); ?>"><?php echo e($investor->investor_name); ?><br>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <small>
                                    <sup>
                                        &nbsp;<img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="<?php echo e(asset('../static/svg/link.svg')); ?>" width="20" height="20" alt="">
                                    </sup>
                                </small>
                                </a>
                            </td>
                            <td style="text-decoration:line-through; color: red">L. <?php echo e(number_format($project->project_investment,2)); ?></td>
                            <td style="text-decoration:line-through; color: red">L. <?php echo e(number_format($project->investors->sum('pivot.investor_final_profit'),2)); ?></td>
                            <td>
                                <?php if($project->project_status == '2'): ?>
                                    <span class="badge badge-outline text-red me-1">
                                        <img style="filter: invert(39%) sepia(68%) saturate(5311%) hue-rotate(342deg) brightness(94%) contrast(90%);" src="<?php echo e(asset('../static/svg/lock-code.svg')); ?>" width="20" height="20" alt="">
                                        CERRADO
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-dark me-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Existe un error en el estado del proyecto, revisar detalles del mismo.">ESTADO DESCONOCIDO</span> 
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($project->project_close_comment != ''): ?>
                                    <span class="text-dark"><?php echo e($project->project_close_comment); ?></span>
                                <?php else: ?>
                                    <strong class="text-red">El usuario no dió motivos</strong>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="<?php echo e(asset('vendor/datatables/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('customjs/datatable/dt_project_terminated.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/carlos/Code/InvestorInsight/resources/views/modules/projects_closed/index.blade.php ENDPATH**/ ?>