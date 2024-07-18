<?php $__env->startSection('head'); ?>

<!-- Datatable CSS -->
<link href="<?php echo e(asset('vendor/datatables/css/jquery.dataTables.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('vendor/datatables/css/buttons.dataTables.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('css/datatable.css')); ?>" rel="stylesheet">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('pretitle'); ?>
Listado principal
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
Comisionistas
<?php $__env->stopSection(); ?>

<?php $__env->startSection('create'); ?>
<a href="#" class="btn btn-primary" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" data-bs-toggle="modal" data-bs-target="#modal-team">
    + Nuevo comisionista
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
           <div id="search-filters-container">FILTROS
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="example" class="display table table-bordered">
                <thead>
                    <tr style="text-align: center;">
                        <th>ID</th>
                        <th>NOMBRE COMISIONISTA</th>
                        <th>Nº IDENTIDAD</th>
                        <th>Nº TELÉFONO</th>
                        <th>CAPITAL</th>
                        <th style="width: 8vh">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $commission_agents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $commission_agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr style="text-align: center;">
                        <td><?php echo e($i++); ?></td>
                        <td>
                            <a href="<?php echo e(route('commission_agent.show', $commission_agent)); ?>"><?php echo e($commission_agent->commissioner_name); ?>

                                <small>
                                    <sup>
                                        <img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="<?php echo e(asset('../static/svg/link.svg')); ?>" width="20" height="20" alt="">
                                    </sup>
                                </small>
                            </a>
                        </td>
                        <td><?php echo e($commission_agent->commissioner_dni); ?></td>
                        <td><?php echo e($commission_agent->commissioner_phone); ?></td>
                        <td>Lps. <?php echo e(number_format($commission_agent->commissioner_balance,2 )); ?></td>
                        <td>
                            <?php echo $__env->make('modules.commission_agent._delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="btn-list flex-nowrap">
                                <?php if($commission_agent->id != 1): ?>
                                <div class="dropdown">
                                    <button class="btn btn-sm dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                        Acciones
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <small class="text-muted dropdown-item">Modificaciones</small>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-update-<?php echo e($commission_agent->id); ?>">
                                            <img style="filter: invert(42%) sepia(9%) saturate(0%) hue-rotate(136deg) brightness(99%) contrast(93%);" src="<?php echo e(asset('../static/svg/edit.svg')); ?>" width="20" height="20" alt="">
                                            &nbsp;Actualizar información
                                        </a>
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo e($commission_agent->id); ?>">
                                            <img style="filter: invert(39%) sepia(68%) saturate(5311%) hue-rotate(342deg) brightness(94%) contrast(90%);" src="<?php echo e(asset('../static/svg/trash.svg')); ?>" width="20" height="20" alt="">
                                            &nbsp;Eliminar comisionista
                                        </a>
                                    </div>
                                </div>
                                <?php else: ?>
                                <strong class="text-red">Acción no disponible</strong>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal de actualización específico para cada comisionista -->
                    <div class="modal modal-blur fade" id="modal-update-<?php echo e($commission_agent->id); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content" style="border: 2px solid #52524E">
                                <div class="modal-header">
                                    <h5 class="modal-title">Editar comisionista</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="<?php echo e(route('commission_agent.update', ['commission_agent' => $commission_agent->id])); ?>" novalidate>
                                        <?php echo method_field('PUT'); ?>
                                        <?php echo csrf_field(); ?>
                                        <div class="row mb-3 align-items-end">
                                            <div class="col" style="display: none">
                                                <div class="form-floating">
                                                    <input type="text" readonly name="commissioner_balance" id="commissioner_balance" value="<?php echo e($commission_agent->commissioner_balance); ?>" class="form-control" autocomplete="off">
                                                    <label for="commissioner_balance" name="commissioner_balance">Capital</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-floating">
                                                    <input type="text" oninput="this.value = this.value.toUpperCase().replace(/[^A-Z\s]/g, '')" maxlength="55" oninput="this.value = this.value.toUpperCase()" value="<?php echo e($commission_agent->commissioner_name); ?>" name="commissioner_name" id="commissioner_name_<?php echo e($commission_agent->id); ?>" class="form-control <?php $__errorArgs = ['commissioner_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Ingrese el nombre del comisionista" autocomplete="off"/>
                                                    <?php $__errorArgs = ['commissioner_name'];
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
                                                    <label for="commissioner_name_<?php echo e($commission_agent->id); ?>">Nombre del comisionista</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-floating">
                                                    <input type="text" oninput="this.value = this.value.toUpperCase().replace(/\s/g, '')" maxlength="13" value="<?php echo e($commission_agent->commissioner_dni); ?>" name="commissioner_dni" id="commissioner_dni_<?php echo e($commission_agent->id); ?>" class="form-control <?php $__errorArgs = ['commissioner_dni'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Ingrese el número de identidad" autocomplete="off"/>
                                                    <?php $__errorArgs = ['commissioner_dni'];
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
                                                    <label for="commissioner_dni_<?php echo e($commission_agent->id); ?>">Nº identidad</label>
                                                </div>
                                            </div>
                                            <input type="hidden" name="commissioner_status" value="1">
                                        </div>
                                        <div class="row mb-3 align-items-end">
                                            <div class="col">
                                                <div class="form-floating">
                                                    <input type="text" oninput="this.value = this.value.replace(/\D/g, '')" minlength="8" maxlength="8" name="commissioner_phone" value="<?php echo e($commission_agent->commissioner_phone); ?>" id="commissioner_phone_<?php echo e($commission_agent->id); ?>" class="form-control <?php $__errorArgs = ['commissioner_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" data-mask="00000000" data-mask-visible="true" placeholder="00000000" autocomplete="off"/>
                                                    <?php $__errorArgs = ['commissioner_phone'];
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
                                                    <label for="commissioner_phone_<?php echo e($commission_agent->id); ?>">Nº teléfono</label>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="<?php echo e(route('commission_agent.index')); ?>" class="btn btn-dark me-auto">Volver</a>
                                        <button type="submit" class="btn btn-teal">Guardar cambios</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fin del modal específico -->
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php echo $__env->make('modules.commission_agent._create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<!-- Alert fade closer script-->
<script src="<?php echo e(asset('customjs/alert_closer.js')); ?>"></script>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="<?php echo e(asset('vendor/datatables/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('customjs/datatable/dt_commissioner.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/carlos/Code/En proceso/InvestorInsight/resources/views/modules/commission_agent/index.blade.php ENDPATH**/ ?>