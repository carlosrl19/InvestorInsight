<?php $__env->startSection('head'); ?>

<!-- Datatable CSS -->
<link href="<?php echo e(asset('vendor/datatables/css/jquery.dataTables.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('vendor/datatables/css/buttons.dataTables.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('css/datatable.css')); ?>" rel="stylesheet">

<!-- Badge CSS -->
<link href="<?php echo e(asset('/css/project.css')); ?>" rel="stylesheet">

<!-- Select2 -->
<link rel="stylesheet" href="<?php echo e(asset('vendor/select2/select2.min.css')); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pretitle'); ?>
Listado principal
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
Proyectos finiquitados
<?php $__env->stopSection(); ?>

<?php $__env->startSection('create'); ?>

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
                    <tr style="text-align: center;">
                        <th>Código <br> proyecto</th>
                        <th>Nombre <br> proyecto</th>
                        <th>Feha <br> inicio</th>
                        <th>Fecha <br> final</th>
                        <th>Nombre <br> inversionista(s)</th>
                        <th>Monto <br> Inversión</th>
                        <th>Ganancia <br> proyecto</th>
                        <th>Exportar <br> Finiquito</th>
                        <th>Estado <br> proyecto</th>
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
                        <tr style="text-align: center;">
                            <td>#<?php echo e($project->project_code); ?></td>
                            <td style="max-width: 150px; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;">
                                <a href="#" class="text-blue" style="font-size: clamp(0.6rem, 3vw, 0.65rem); border: none; margin-right: 5px" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#showModal<?php echo e($project->id); ?>"></>
                                    <?php echo e($project->project_name); ?>

                                    &nbsp;<svg class="text-blue" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-link"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 15l6 -6" /><path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464" /><path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463" /></svg>
                                </a>
                                <?php echo $__env->make('modules.projects._show', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </td>
                            <td><?php echo e($project->project_start_date); ?></td>
                            <td><?php echo e($project->project_end_date); ?></td>                            
                            <td>
                                <?php $__currentLoopData = $project->investors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $investor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a style="font-size: clamp(0.6rem, 3vw, 0.65rem);" href="<?php echo e(route('investor.show', $investor)); ?>"><?php echo e($investor->investor_name); ?>

                                    <small>
                                        <sup>
                                            <img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="<?php echo e(asset('../static/svg/link.svg')); ?>" width="20" height="20" alt="">
                                        </sup>
                                    </small>
                                    <br>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </a>
                            </td>
                            <td>L. <?php echo e(number_format($project->project_investment,2)); ?></td>
                            <td>L. <?php echo e(number_format($project->investors->sum('pivot.investor_final_profit'),2)); ?></td>
                            <td>
                                <?php if($project->project_status == 0): ?>
                                <a href="<?php echo e(route('termination.report', $project->id)); ?>" class="badge bg-red me-1 text-white" data-toggle="modal" data-target="#pdfModal">
                                    <img style="filter: invert(100%) sepia(0%) saturate(7398%) hue-rotate(181deg) brightness(105%) contrast(102%);" src="<?php echo e(asset('../static/svg/file-text.svg')); ?>" width="20" height="20" alt="">
                                    FINIQUITO
                                </a>
                                <?php else: ?>
                                    <span class="text-red"><strong>N/D</strong></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($project->project_status == '0'): ?>
                                    <span class="badge badge-outline text-success me-1 text-white">
                                        <img style="filter: brightness(0) saturate(100%) invert(49%) sepia(86%) saturate(434%) hue-rotate(78deg) brightness(98%) contrast(86%);" src="<?php echo e(asset('../static/svg/lock.svg')); ?>" width="20" height="20" alt="">
                                        FINALIZADO
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-dark me-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Existe un error en el estado del proyecto, revisar detalles del mismo.">ESTADO DESCONOCIDO</span> 
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <!-- Termination viewer Modal -->
            <div class="modal fade modal-blur" id="pdfModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="pdfModalLabel">Previsualización de finiquito</h5>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="<?php echo e(asset('vendor/datatables/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('customjs/datatable/dt_project_terminated.js')); ?>"></script>

<!-- Select2 -->
<script src="<?php echo e(asset('vendor/select2/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('customjs/select2/s2_init.js')); ?>"></script>

<!-- PDF view -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Termination iframe modal -->
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
<?php echo $__env->make('layout.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH R:\Code\En proceso\InvestorInsight\resources\views/modules/terminations/index.blade.php ENDPATH**/ ?>