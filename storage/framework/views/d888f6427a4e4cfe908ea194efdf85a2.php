<?php $__env->startSection('head'); ?>

<!-- Datatable CSS -->
<link href="<?php echo e(asset('vendor/datatables/css/jquery.dataTables.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('vendor/datatables/css/buttons.dataTables.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('css/datatable.css')); ?>" rel="stylesheet">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pretitle'); ?>
Listado principal <small>(<?php echo e(number_format($loadTime, 2)); ?> segundos)</small>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
Prestamistas
<?php $__env->stopSection(); ?>

<?php $__env->startSection('create'); ?>
<a href="#" class="btn btn-primary" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" data-bs-toggle="modal" data-bs-target="#modal-team">
    + Nuevo prestamista
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
        <div class="card">
            <div class="card-body">
                <table id="moneylenders" class="display table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>NOMBRE <br>PRESTAMISTA</th>
                            <th>EMPRESA <br>AFILIADA</th>
                            <th>Nº IDENTIDAD</th>
                            <th>Nº TELEFONO</th>
                            <th style="width: 8vh">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $moneylenders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $moneylender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="text-center">
                                <td>
                                    <a href="<?php echo e(route('moneylender.show', $moneylender)); ?>"><?php echo e($moneylender->moneylender_name); ?>

                                        <small>
                                            <sup>
                                                <img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="<?php echo e(asset('../static/svg/link.svg')); ?>" width="20" height="20" alt="">
                                            </sup>
                                        </small>
                                    </a>
                                </td>
                                <td><?php echo e($moneylender->moneylender_company_name); ?></td>
                                <td><?php echo e($moneylender->moneylender_dni); ?></td>
                                <td><?php echo e($moneylender->moneylender_phone); ?></td>                           
                                <td>
                                    <?php echo $__env->make('modules.moneylenders._delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <div class="btn-list flex-nowrap">
                                        <div class="dropdown">
                                            <button class="btn btn-sm dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                                Acciones
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <!-- Modification's option -->
                                                <small class="text-muted dropdown-item">Modificaciones</small>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-update-<?php echo e($moneylender->id); ?>">
                                                    <img style="filter: invert(42%) sepia(9%) saturate(0%) hue-rotate(136deg) brightness(99%) contrast(93%);" src="<?php echo e(asset('../static/svg/edit.svg')); ?>" width="20" height="20" alt="">
                                                    &nbsp;Actualizar información
                                                </a>
                                                
                                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo e($moneylender->id); ?>">
                                                    <img style="filter: invert(39%) sepia(68%) saturate(5311%) hue-rotate(342deg) brightness(94%) contrast(90%);" src="<?php echo e(asset('../static/svg/trash.svg')); ?>" width="20" height="20" alt="">
                                                    &nbsp;Eliminar inversionista
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Update moneylenders modal -->
                            <div class="modal modal-blur fade" id="modal-update-<?php echo e($moneylender->id); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                    <div class="modal-content" style="border: 2px solid #52524E">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Editar inversionista</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="<?php echo e(route('moneylender.update', ['moneylender' => $moneylender->id])); ?>" novalidate>
                                                <?php echo method_field('PUT'); ?>
                                                <?php echo csrf_field(); ?>
                                                <div class="row mb-3 align-items-end">
                                                    <div class="col">
                                                        <div class="form-floating">
                                                            <input type="text" maxlength="55" oninput="this.value = this.value.toUpperCase().replace(/[^A-Z\s]/g, '')" value="<?php echo e($moneylender->moneylender_name); ?>" name="moneylender_name" id="moneylender_name_<?php echo e($moneylender->id); ?>" class="form-control <?php $__errorArgs = ['moneylender_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Ingrese el nombre del inversionista" autocomplete="off"/>
                                                            <?php $__errorArgs = ['moneylender_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong><?php echo e($message); ?></strong>
                                                                </span>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            <label for="moneylender_name_<?php echo e($moneylender->id); ?>">Nombre del inversionista</label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-floating">
                                                            <input type="text" oninput="this.value = this.value.toUpperCase().replace(/\s/g, '')" maxlength="13" value="<?php echo e($moneylender->moneylender_dni); ?>" name="moneylender_dni" id="moneylender_dni_<?php echo e($moneylender->id); ?>" class="form-control <?php $__errorArgs = ['moneylender_dni'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Ingrese el número de identidad" autocomplete="off"/>
                                                            <?php $__errorArgs = ['moneylender_dni'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong><?php echo e($message); ?></strong>
                                                                </span>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            <label for="moneylender_dni_<?php echo e($moneylender->id); ?>">Nº identidad</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3 align-items-end">
                                                    <div class="col">
                                                        <div class="form-floating">
                                                            <select type="text" class="form-select" id="select-optgroups-<?php echo e($moneylender->id); ?>" name="moneylender_company_name" style="font-size: clamp(0.7rem, 3vh, 0.8rem);">
                                                                <option value="ROBENIOR" <?php echo e((old('moneylender_company_name') ?? $moneylender->moneylender_company_name) == 'ROBENIOR' ? 'selected' : ''); ?>>ROBENIOR</option>
                                                                <option value="MARSELLA" <?php echo e((old('moneylender_company_name') ?? $moneylender->moneylender_company_name) == 'MARSELLA' ? 'selected' : ''); ?>>MARSELLA</option>
                                                                <option value="JAGUER" <?php echo e((old('moneylender_company_name') ?? $moneylender->moneylender_company_name) == 'JAGUER' ? 'selected' : ''); ?>>JAGUER</option>
                                                                <option value="FUTURE CAPITAL" <?php echo e((old('moneylender_company_name') ?? $moneylender->moneylender_company_name) == 'FUTURE CAPITAL' ? 'selected' : ''); ?>>FUTURE CAPITAL</option>
                                                            </select>
                                                            <?php $__errorArgs = ['moneylender_company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong><?php echo e($message); ?></strong>
                                                                </span>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            <label for="moneylender_company_name_<?php echo e($moneylender->id); ?>">Empresa afiliada</label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-floating">
                                                            <input type="text" oninput="this.value = this.value.replace(/\D/g, '')" name="moneylender_phone" value="<?php echo e($moneylender->moneylender_phone); ?>" id="moneylender_phone_<?php echo e($moneylender->id); ?>" class="form-control <?php $__errorArgs = ['moneylender_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" autocomplete="off"/>
                                                            <?php $__errorArgs = ['moneylender_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong><?php echo e($message); ?></strong>
                                                                </span>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            <label for="moneylender_phone_<?php echo e($moneylender->id); ?>">Nº teléfono</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="<?php echo e(route('moneylender.index')); ?>" class="btn btn-dark me-auto">Volver</a>
                                                <button type="submit" class="btn btn-teal">Guardar cambios</button>
                                            </form>
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

<?php echo $__env->make('modules.moneylenders._create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<!-- Alert fade closer script-->
<script src="<?php echo e(asset('customjs/alert_closer.js')); ?>"></script>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="<?php echo e(asset('vendor/datatables/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('customjs/datatable/dt_moneylender.js')); ?>"></script>
<script src="<?php echo e(asset('customjs/datatable/dt_moneylender_funds.js')); ?>"></script>

<!-- PDF view -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/carlos/Code/InvestorInsight (Copiar)/resources/views/modules/moneylenders/index.blade.php ENDPATH**/ ?>