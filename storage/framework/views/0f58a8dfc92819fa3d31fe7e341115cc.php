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
                        <?php if($transfer->transfer_img): ?>
                            <div class="d-flex flex-wrap justify-content-center">
                                <?php $__currentLoopData = json_decode($transfer->transfer_img); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="mx-2 my-1">
                                        <img id="image-preview" style="border: 1px solid #e3e3e3; border-radius: 5px; padding: 5px;" src="<?php echo e(asset('images/transfers/'. $image)); ?>" alt="Comprobante de transferencia" width="30" height="30">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <!-- Full viewer with carousel -->
                            <div class="modal fade" id="image-modal" tabindex="-1" aria-labelledby="image-modal-label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="image-modal-label">Pantalla completa de comprobante</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="carousel-indicators-thumb" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    <!-- Dynamic carousel items will be injected here -->
                                                </div>                                                                    
                                            </div>
                                            
                                            <div class="carousel-indicators carousel-indicators-thumb mt-2">
                                                <!-- Dynamic carousel indicators will be injected here -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            No hay imágenes
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
      </div>
    </div>
</div>

<?php echo $__env->make('modules.transfer._create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<style>
    .carousel-img {
        max-height: 75vh;
        max-width: 100%;
        width: auto;
        border: 1px solid #e3e3e3;
        border-radius: 19px;
        padding: 10px;
        margin: auto;
    }
</style>

<?php $__env->startSection('scripts'); ?>

<!-- Alert fade closer script-->
<script src="<?php echo e(asset('customjs/alert_closer.js')); ?>"></script>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="<?php echo e(asset('vendor/datatables/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('customjs/datatable/dt_transfer.js')); ?>"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var imagePreviewElements = document.querySelectorAll('#image-preview');

    imagePreviewElements.forEach(function(imagePreview) {
        imagePreview.addEventListener('click', function() {
            var fullImageSrc = this.src;
            var imageModal = new bootstrap.Modal(document.getElementById('image-modal'));

            // Get all images for the current row
            var row = this.closest('tr');
            var images = row.querySelectorAll('#image-preview');

            // Clear previous carousel items and indicators
            var carouselInner = document.querySelector('.carousel-inner');
            var carouselIndicators = document.querySelector('.carousel-indicators-thumb');
            carouselInner.innerHTML = '';
            carouselIndicators.innerHTML = '';

            // Populate the carousel with the images
            images.forEach((img, index) => {
                // Create carousel item
                var carouselItem = document.createElement('div');
                carouselItem.classList.add('carousel-item');
                if (img.src === fullImageSrc) {
                    carouselItem.classList.add('active');
                }

                // Create image element with class
                var imgElement = document.createElement('img');
                imgElement.classList.add('d-block', 'carousel-img');
                imgElement.src = img.src;

                carouselItem.appendChild(imgElement);
                carouselInner.appendChild(carouselItem);

                // Create carousel indicator
                var indicator = document.createElement('button');
                indicator.type = 'button';
                indicator.setAttribute('data-bs-target', '#carousel-indicators-thumb');
                indicator.setAttribute('data-bs-slide-to', index);
                indicator.classList.add('ratio', 'ratio-4x3');
                if (img.src === fullImageSrc) {
                    indicator.classList.add('active');
                }
                indicator.style.backgroundImage = 'url(' + img.src + ')';
                carouselIndicators.appendChild(indicator);
            });

            imageModal.show();
        });
    });
});

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH R:\Code\En proceso\InvestorInsight\resources\views/modules/transfer/index.blade.php ENDPATH**/ ?>