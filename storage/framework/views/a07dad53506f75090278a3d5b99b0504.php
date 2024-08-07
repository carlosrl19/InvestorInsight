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
Notas crédito
<?php $__env->stopSection(); ?>

<?php $__env->startSection('create'); ?>
<a href="#" class="btn btn-primary" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" data-bs-toggle="modal" data-bs-target="#modal-team">
    + Nuevo nota crédito
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
            <table id="example" class="display table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>CODIGO <br>NOTA CREDITO</th>
                        <th>FECHA <br>EMISION</th>
                        <th>NOMBRE <br>INVERSIONISTA</th>
                        <th>MONTO <br>NOTA CREDITO</th>
                        <th>COMENTARIO / MOTIVO NOTA CREDITO</th>
                        <th>EXPORTAR NOTA CREDITO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $creditNotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $creditNote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="text-center">
                        <td><?php echo e($creditNote->creditNote_code); ?></td>
                        <td><?php echo e($creditNote->creditNote_date); ?></td>
                        <td>
                            <a href="<?php echo e(route('investor.show', $creditNote->investor_id)); ?>"><?php echo e($creditNote->investor->investor_name); ?>

                                <small>
                                    <sup>
                                        <img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="<?php echo e(asset('../static/svg/link.svg')); ?>" width="20" height="20" alt="">
                                    </sup>
                                </small>
                            </a>
                        </td>
                        <td>Lps. <?php echo e(number_format($creditNote->creditNote_amount,2)); ?></td>
                        <td style="max-width: 50px;"><?php echo e($creditNote->creditNote_description); ?></td>
                        <td>
                            <a href="<?php echo e(route('credit_note.report', $creditNote->id)); ?>" style="font-size: clamp(0.6rem, 3vw, 0.65rem);" class="btn btn-sm btn-red" data-toggle="modal" data-target="#pdfModal">
                                &nbsp;&nbsp;&nbsp;<img style="filter: invert(99%) sepia(43%) saturate(0%) hue-rotate(95deg) brightness(110%) contrast(101%);" src="<?php echo e(asset('../static/svg/file-text.svg')); ?>" width="20" height="20" alt="">
                                &nbsp;NOTA CRÉDITO
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <!-- PDF Viewer Modal -->
            <div class="modal fade modal-blur" id="pdfModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="pdfModalLabel">Previsualización de nota crédito</h5>
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

<?php echo $__env->make('modules.credit_note._create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<!-- Alert fade closer script-->
<script src="<?php echo e(asset('customjs/alert_closer.js')); ?>"></script>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="<?php echo e(asset('vendor/datatables/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('customjs/datatable/dt_credit_note.js')); ?>"></script>

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
<?php echo $__env->make('layout.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/carlos/Code/En proceso/InvestorInsight/resources/views/modules/credit_note/index.blade.php ENDPATH**/ ?>