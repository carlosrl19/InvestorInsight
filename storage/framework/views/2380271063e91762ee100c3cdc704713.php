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
Transferencias
<?php $__env->stopSection(); ?>

<?php $__env->startSection('create'); ?>
<a href="#" class="btn btn-primary" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" data-bs-toggle="modal" data-bs-target="#modal-team">
    + Nuevo transferencia
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
                    <th>Código</th>
                    <th>Inversionista</th>
                    <th>Fecha Hora</th>
                    <th>Banco transferencia</th>
                    <th>Monto transferencia</th>
                    <th>Motivo</th>
                    <th>Comprobante</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="text-center">
                    <td>#<?php echo e($transfer->transfer_code); ?></td>
                    <td>
                        <a href="<?php echo e(route('investor.show', $transfer->investor_id)); ?>"><?php echo e($transfer->investor->investor_name); ?>

                            <small>
						    	<sup>
                                    <img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="<?php echo e(asset('../static/svg/link.svg')); ?>" width="20" height="20" alt="">
						    	</sup>
						    </small>
                        </a>
                    </td>
                    <td><?php echo e($transfer->transfer_date); ?></td>
                    <td class="text-uppercase"><?php echo e($transfer->transfer_bank); ?></td>
                    <td>Lps. <?php echo e(number_format($transfer->transfer_amount,2)); ?></td>
                    <td><?php echo e($transfer->transfer_comment); ?></td>
                    <td>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal-<?php echo e($transfer->id); ?>">
                            <?php if(file_exists(public_path('images/transfers/' . $transfer->transfer_img))): ?>
                                <img src="<?php echo e(asset('images/transfers/' . $transfer->transfer_img)); ?>" style="height: 40px; width: 40px; display: flex; margin: auto" alt="transfer-proof">
                            <?php else: ?>
                                <img src="<?php echo e(asset('images/no-image.png')); ?>" style="height: 40px; width: 40px; display: flex; margin: auto" alt="no image available" title="Sin comprobante">
                            <?php endif; ?>
                        </a>
                    </td>
                </tr>

                <!-- Modal comprobante -->
                <div class="modal modal-blur fade" id="imageModal-<?php echo e($transfer->id); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content" style="border: 2px solid #52524E">
                            <div class="modal-header">
                                <h5 class="modal-title">Imagen de comprobante de transferencia</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <?php if(file_exists(public_path('images/transfers/' . $transfer->transfer_img))): ?>
                                    <img src="<?php echo e(asset('images/transfers/' . $transfer->transfer_img)); ?>" style="min-height: 70vh; max-height: 70vh; width: auto; display: flex; margin: auto" alt="transfer-proof">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('images/no-image.png')); ?>" style="min-height: 70vh; max-height: 70vh;; width: auto; display: flex; margin: auto" alt="no image available" title="Sin comprobante">
                                <?php endif; ?>
                                <br>
                                <button type="button" class="btn btn-dark me-auto" data-bs-dismiss="modal">Volver</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
      </div>
    </div>
</div>

<?php echo $__env->make('modules.transfer._create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<!-- Alert fade closer script-->
<script src="<?php echo e(asset('customjs/alert_closer.js')); ?>"></script>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="<?php echo e(asset('vendor/datatables/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('customjs/datatable/dt_transfer.js')); ?>"></script>

<!-- Select2 -->
<script src="<?php echo e(asset('vendor/select2/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('customjs/select2/s2_projects.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Carlos Rodriguez\Downloads\InvestorInsight\resources\views/modules/transfer/index.blade.php ENDPATH**/ ?>