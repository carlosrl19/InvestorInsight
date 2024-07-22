<?php $__env->startSection('head'); ?>

<!-- Datatable CSS -->
<link href="<?php echo e(asset('vendor/datatables/css/jquery.dataTables.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('vendor/datatables/css/buttons.dataTables.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('css/datatable.css')); ?>" rel="stylesheet">

<!-- Toast.JS CSS -->
<link rel="stylesheet" href="<?php echo e(asset('dist/libs/toast.js/css/Toast.min.css')); ?>">

<!-- Badge CSS -->
<link href="<?php echo e(asset('/css/project.css')); ?>" rel="stylesheet">

<style>
    .image-container {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .image-preview {
        display: inline-block;
    }

    .overlay:hover{
        cursor: help;
    }

    .overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        border-radius: 10px;
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        text-align: center;
        padding: 10px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .image-container:hover .overlay {
        opacity: 1;
    }
</style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pretitle'); ?>
Listado principal <small>(Tiempo de carga: <?php echo e(number_format($loadTime, 2)); ?> segundos)</small>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
Proyectos activos
<?php $__env->stopSection(); ?>

<?php $__env->startSection('create'); ?>
<a href="#" class="btn btn-cyan" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" data-bs-toggle="modal" data-bs-target="#investorsModal"
    <?php if($activeProjectsCount == 0): ?> disabled <?php endif; ?>>
    <img style="filter: invert(100%) sepia(0%) saturate(7398%) hue-rotate(181deg) brightness(105%) contrast(102%); margin-right: 5px" src="<?php echo e(asset('../static/svg/file-spreadsheet.svg')); ?>" width="20" height="20" alt="">
    Filtrar excel
</a>

<a href="<?php echo e(route('project.active_projects')); ?>" class="btn btn-teal" style="font-size: clamp(0.6rem, 6vh, 0.7rem);"
    <?php if($activeProjectsCount == 0): ?> disabled <?php endif; ?>>
    <img style="filter: invert(100%) sepia(0%) saturate(7398%) hue-rotate(181deg) brightness(105%) contrast(102%); margin-right: 5px" src="<?php echo e(asset('../static/svg/file-spreadsheet.svg')); ?>" width="20" height="20" alt="">
    Excel proyectos activos
</a>

<a href="#" class="btn btn-primary" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" data-bs-toggle="modal" data-bs-target="#modal-team">
    + Nuevo proyecto
</a>
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
    <div class="card mb-2">
        <div class="card-body">
           <div id="search-filters-container">FILTROS</div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-body">
            <table id="example" class="display nowrap table table-bordered" style="width: 100%;">
                <thead>
                    <tr style="text-align: center;">
                        <th>Código <br>proyecto</th>
                        <th>Nombre <br>proyecto</th>
                        <th>Fecha <br>inicio</th>
                        <th>Fecha <br>final</th>
                        <th>Días</th>
                        <th>Nombre <br>inversionista(s)</th>
                        <th>Monto <br>inversión</th>
                        <th>Ganancia <br>proyecto</th>
                        <th>Exportar <br> excel</th>
                        <th>Exportar <br> pagaré</th>
                        <th>Estado <br>proyecto</th>
                        <th>Más <br>acciones</th>
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

                                    &nbsp;<img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="<?php echo e(asset('../static/svg/link.svg')); ?>" width="20" height="20" alt="">
                                </a>
                                <?php echo $__env->make('modules.projects._show', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </td>
                            <td><?php echo e($project->project_start_date); ?></td>
                            <td><?php echo e($project->project_end_date); ?></td>
                            <td style="text-align: center;"><?php echo e($project->days_remaining); ?></td> <!-- Get it from Controller -->
                            <td style="max-width: 150px; white-space: nowrap; text-overflow: ellipsis; overflow: hidden; font-size: clamp(0.6rem, 3vw, 0.65rem);">
                                <?php $__currentLoopData = $project->investors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $investor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a title="<?php echo e($investor->investor_name); ?>" data-bs-toggle="tooltip" data-bs-placement="top" href="<?php echo e(route('investor.show', $investor)); ?>"><?php echo e($investor->investor_name); ?>

                                    <small>
                                        <sup>
                                            <img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="<?php echo e(asset('../static/svg/link.svg')); ?>" width="20" height="20" alt="">
                                        </sup>
                                    </small><br>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </a>
                            </td>
                            <td>L. <?php echo e(number_format($project->project_investment,2)); ?></td>
                            <td>L. <?php echo e(number_format($project->investors->sum('pivot.investor_final_profit'),2)); ?></td>
                            <td>
                                <a href="<?php echo e(route('project.excel', $project)); ?>" class="badge bg-teal me-1 text-white" style="padding-right: 30px">
                                    <img style="filter: invert(100%) sepia(0%) saturate(7398%) hue-rotate(181deg) brightness(105%) contrast(102%);" src="<?php echo e(asset('../static/svg/file-spreadsheet.svg')); ?>" width="20" height="20" alt="">
                                    EXCEL
                                </a>
                            </td>
                            <td>
                                <a href="<?php echo e(route('promissory_note.report', $project->id)); ?>" class="badge bg-red me-1 text-white" style="padding-right: 30px" data-toggle="modal" data-target="#pdfModal">
                                    <img style="filter: invert(100%) sepia(0%) saturate(7398%) hue-rotate(181deg) brightness(105%) contrast(102%);" src="<?php echo e(asset('../static/svg/file-text.svg')); ?>" width="20" height="20" alt="">
                                    PAGARÉ
                                </a>
                            </td>
                            <td>
                                <?php if($project->project_status == '0'): ?>
                                    <span class="badge badge-outline text-success me-1">
                                        <img style="filter: invert(100%) sepia(0%) saturate(7398%) hue-rotate(181deg) brightness(105%) contrast(102%);" src="<?php echo e(asset('../static/svg/lock.svg')); ?>" width="20" height="20" alt="">
                                        FINALIZADO
                                    </span>
                                <?php elseif($project->project_status == '1'): ?>
                                    <span class="badge badge-outline text-cyan me-1 project-active" style="padding-right: 30px" data-bs-toggle="modal" data-bs-target="#finishModal<?php echo e($project->id); ?>">
                                        <img style="filter: invert(71%) sepia(60%) saturate(5470%) hue-rotate(149deg) brightness(89%) contrast(82%);" src="<?php echo e(asset('../static/svg/lock-open.svg')); ?>" width="20" height="20" alt="">
                                        TRABAJANDO
                                    </span>
                                <?php elseif($project->project_status == '2'): ?>
                                <span class="badge bg-red me-1">
                                    <img style="filter: invert(39%) sepia(68%) saturate(5311%) hue-rotate(342deg) brightness(94%) contrast(90%);" src="<?php echo e(asset('../static/svg/lock-code.svg')); ?>" width="20" height="20" alt="">
                                    CERRADO
                                </span>
                                <?php else: ?>
                                    <span class="badge bg-dark me-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Existe un error en el estado del proyecto, revisar detalles del mismo.">ESTADO DESCONOCIDO</span> 
                                <?php endif; ?>
                            </td>

                            <!-- Modal for finishing the project -->
                            <div class="modal modal-blur fade" id="finishModal<?php echo e($project->id); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="finishModal<?php echo e($project->id); ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="<?php echo e(route('project.finish', $project->id)); ?>" method="POST" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <div class="modal-header" style="background: darkred; color: white">
                                                <h5 class="modal-title" id="ModalLabel">Finalizar proyecto</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-8">
                                                        ¿Desea cambiar el estado del proyecto denominado <b>"<?php echo e($project->project_name); ?>"</b> a "Finalizado"? Utilize esta opción únicamente cuando un proyecto haya concluido de forma exitosa.
                                                        Es necesario que ingrese la fecha en la que el proyecto ha finalizado sus labores, así como el comprobante de pago de la transferencia del inversionista para el proyecto.
                                                        
                                                        <p class="mt-2" style="background-color: #e3e3e3; border-radius: 10px; padding: 10px">
                                                            <strong>PAGOS: </strong>
                                                            Una vez finalizado el proyecto, los pagos a los inversionistas y comisionistas se registrarán de manera inmediata. Es decir, los saldos se agregarán automáticamente a sus fondos.                                                </p>
                                                        
                                                        <div class="row mb-2 align-items-end">
                                                            <div class="col">
                                                                <div class="form-floating">
                                                                    <input style="font-size: clamp(0.6rem, 3vw, 0.7rem)" type="file" accept="image/*" 
                                                                    class="form-control <?php $__errorArgs = ['project_proof_transfer_img'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                                                    id="project_proof_transfer_img" name="project_proof_transfer_img" alt="proof-transfer" onchange="previewImage(event)">
                                                                    <label for="project_proof_transfer_img">Comprobante de transferencia</label>
                                                                    <span class="invalid-feedback" role="alert" id="transfer-img-error"
                                                                        style="display: none;">
                                                                        <strong></strong>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Full viewer -->
                                                        <div class="modal fade" id="image-modal" tabindex="-1" aria-labelledby="image-modal-label"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="image-modal-label">Imagen de comprobante ingresado de
                                                                            transferencia</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body d-flex justify-content-center align-items-center">
                                                                        <img id="full-image" style="max-height: 75vh; max-width: 100%; width: auto;" src="#" alt="Imagen de transferencia"
                                                                            class="img-fluid">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-floating"
                                                            style="border: 1px solid #e3e3e3; border-radius: 10px; padding: 10px; min-height: 32vh; max-height: 32vh;">
                                                            <span style="display: flex; justify-content: center; color: #5b5b5b">Visualizador de comprobante</span>
                                                            <div class="image-container" style="position: relative;">
                                                                <img id="image-preview" src="#" alt="Imagen de transferencia"
                                                                    style="max-width: 100%; max-height: 26vh; display: none; margin-top: 10px">
                                                                <div class="overlay">Clic en imagen para pantalla completa</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div style="margin: 0px 5px 20px 20px;">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-danger">Finalizar proyecto</button>
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <?php if($project->project_status == '1'): ?>
                            <td>
                                <div class="btn-list flex-nowrap">
                                    <div class="dropdown">
                                        <button class="btn btn-sm dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                        Acciones
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <small class="text-muted dropdown-item">Acciones de finalización</small>
                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#closeModal<?php echo e($project->id); ?>">
                                                <img style="filter: invert(39%) sepia(68%) saturate(5311%) hue-rotate(342deg) brightness(94%) contrast(90%);" src="<?php echo e(asset('../static/svg/circle-x.svg')); ?>" width="20" height="20" alt="">
                                                &nbsp;Cerrar proyecto
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <?php else: ?>
                                <td>
                                    <span class="text-red">
                                        <img style="filter: invert(39%) sepia(68%) saturate(5311%) hue-rotate(342deg) brightness(94%) contrast(90%);" src="<?php echo e(asset('../static/svg/lock-code.svg')); ?>" width="20" height="20" alt="">
                                        Ninguna
                                    </span>
                                </td>
                            <?php endif; ?>

                            <!-- Modal for promissory note -->
                            <div class="modal fade modal-blur" id="pdfModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
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

                            <!-- Modal for closing the project -->
                            <div class="modal fade" id="closeModal<?php echo e($project->id); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="closeModal<?php echo e($project->id); ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background: darkred; color: white">
                                            <h5 class="modal-title" id="ModalLabel">Cerrar proyecto</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="<?php echo e(route('project.close', $project->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <div class="modal-body">
                                                ¿Desea cambiar el estado del proyecto denominado <b>"<?php echo e($project->project_name); ?>"</b> a "Cerrado"? Utilice esta opción únicamente cuando un proyecto tenga conflictos para llevarse a cabo y no se pueda seguir con el mismo.

                                                <div class="form-floating mt-4 mb-2">
                                                    <textarea type="text" class="form-control" style="overflow: hidden; height: 100px; resize: none" name="project_close_comment" id="project_close_comment"></textarea>
                                                    <label for="project_close_comment">Motivo de cierre del proyecto</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-danger">Cerrar proyecto</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="toast-container" aria-live="polite" aria-atomic="true"></div>

<?php echo $__env->make('modules.projects._create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('modules.projects._investors_select_project_export', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- ToastJS -->
<script src="<?php echo e(asset('dist/libs/toast.js/js/Toast.min.js')); ?>"></script>

<!-- Alert fade closer script-->
<script src="<?php echo e(asset('customjs/alert_closer.js')); ?>"></script>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="<?php echo e(asset('vendor/datatables/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('customjs/datatable/dt_project.js')); ?>"></script>

<!-- Form steps -->
<script src="<?php echo e(asset('customjs/projects/steps_form.js')); ?>"></script>

<!-- PDF view -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- PDF Modal activator -->
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

<script>
    function previewImage(event) {
        var preview = document.getElementById('image-preview');
        preview.style.display = 'block';
        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onload = function() {
            preview.src = reader.result;
        }
        reader.readAsDataURL(file);
    }
</script>

<script>
    var imagePreview = document.getElementById('image-preview');
    var fullImage = document.getElementById('full-image');

    imagePreview.addEventListener('click', function() {
        fullImage.src = this.src;
        var imageModal = new bootstrap.Modal(document.getElementById('image-modal'));
        imageModal.show();
    });
</script>

<!-- Toast message -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const projects = <?php echo json_encode($projects); ?>; // datos de PHP a JSON
        const today = new Date();
        const toastContainer = document.getElementById('toast-container');

        setTimeout(() => {
            projects.forEach(project => {
                const projectEndDate = new Date(project.project_end_date);
                const timeDiff = projectEndDate.getTime() - today.getTime();
                const daysDiff = Math.floor(timeDiff / (1000 * 3600 * 24)) + 2;

                let toastMessage = '';

                if (daysDiff == 1) {
                    toastMessage = `Solo queda <strong>${daysDiff}</strong> día para la finalización del proyecto "<strong>${project.project_name}</strong>".`;
                } else if (daysDiff <= 5) {
                    toastMessage = `Quedan <strong>${daysDiff}</strong> días para la finalización del proyecto "<strong>${project.project_name}</strong>".`;
                } else if (daysDiff == 0) {
                    toastMessage = `Hoy finaliza el proyecto "<strong>${project.project_name}</strong>".`;
                } else if (daysDiff < 0) {
                    // No se debe mostrar el toast cuando daysDiff es menor a 0
                }

                if (daysDiff > 0 && daysDiff <= 5) {
                    const toast = document.createElement('div');
                    toast.classList.add('toast', 'toast-spacing');
                    toast.setAttribute('role', 'alert');
                    toast.setAttribute('aria-live', 'assertive');
                    toast.setAttribute('aria-atomic', 'true');
                    toast.innerHTML = `
                        <div class="toast-body">
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            ${toastMessage}
                        </div>
                    `;
                    toastContainer.appendChild(toast);

                    const bsToast = new bootstrap.Toast(toast);
                    bsToast.show();
                }
            });
        }, 3000); // Retrasar la ejecución 5 segundos (5000 milisegundos)
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/carlos/Code/En proceso/InvestorInsight/resources/views/modules/projects/index.blade.php ENDPATH**/ ?>