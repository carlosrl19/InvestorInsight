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
<a href="#" class="btn btn-orange" style="font-size: clamp(0.6rem, 3vw, 0.7rem);" data-bs-toggle="modal"
    data-bs-target="#modal-loans">
    $ Historial de préstamos
</a>

<a href="#" class="btn btn-primary" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" data-bs-toggle="modal"
    data-bs-target="#modal-team">
    + Nuevo prestamista
</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show"
        style="margin-right: 10vh; margin-left: 10vh; font-size: clamp(0.6rem, 3.2vw, 0.8rem);" role="alert"
        data-auto-dismiss="4000">
        <strong><?php echo e(session('success')); ?></strong>
    </div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="alert alert-danger alert-dismissible" alert-dismissible fade show"
        style="margin-right: 10vh; margin-left: 10vh; font-size: clamp(0.6rem, 3.2vw, 0.8rem);" role="alert"
        data-auto-dismiss="10000">
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
            <div id="search-filters-moneylender-container">FILTROS
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table id="moneylenders" class="display table table-bordered">
                <thead>
                    <tr style="text-align: center;">
                        <th>ID</th>
                        <th>NOMBRE PRESTAMISTA</th>
                        <th>Nº IDENTIDAD</th>
                        <th>Nº TELÉFONO</th>
                        <th>DESCRIPCIÓN</th>
                        <th style="width: 8vh">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $moneylenders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $moneylender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr style="text-align: center;">
                            <td><?php echo e($i++); ?></td>
                            <td>
                                <a href="<?php echo e(route('moneylender.show', $moneylender)); ?>"><?php echo e($moneylender->moneylender_name); ?>

                                    <small>
                                        <sup>
                                            <img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);"
                                                src="<?php echo e(asset('../static/svg/link.svg')); ?>" width="20" height="20" alt="">
                                        </sup>
                                    </small>
                                </a>
                            </td>
                            <td><?php echo e($moneylender->moneylender_dni); ?></td>
                            <td><?php echo e($moneylender->moneylender_phone); ?></td>
                            <td><?php echo e($moneylender->moneylender_description); ?></td>
                            <td>
                                <?php echo $__env->make('modules.moneylenders._delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <div class="btn-list flex-nowrap">
                                    <div class="dropdown">
                                        <button class="btn btn-sm dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                            Acciones
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <small class="text-muted dropdown-item">Modificaciones</small>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#modal-update-<?php echo e($moneylender->id); ?>">
                                                <img style="filter: invert(42%) sepia(9%) saturate(0%) hue-rotate(136deg) brightness(99%) contrast(93%);"
                                                    src="<?php echo e(asset('../static/svg/edit.svg')); ?>" width="20" height="20"
                                                    alt="">
                                                &nbsp;Actualizar información
                                            </a>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#modal-loans-<?php echo e($moneylender->id); ?>">
                                                <img style="filter: invert(42%) sepia(9%) saturate(0%) hue-rotate(136deg) brightness(99%) contrast(93%);"
                                                    src="<?php echo e(asset('../static/svg/credit-card.svg')); ?>" width="20"
                                                    height="20" alt="">
                                                &nbsp;Solicitar préstamo
                                            </a>
                                            <a class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal<?php echo e($moneylender->id); ?>">
                                                <img style="filter: invert(39%) sepia(68%) saturate(5311%) hue-rotate(342deg) brightness(94%) contrast(90%);"
                                                    src="<?php echo e(asset('../static/svg/trash.svg')); ?>" width="20" height="20"
                                                    alt="">
                                                &nbsp;Eliminar prestamista
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal de actualización específico para cada prestamista -->
                        <div class="modal modal-blur fade" id="modal-update-<?php echo e($moneylender->id); ?>"
                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content" style="border: 2px solid #52524E">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar prestamista</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST"
                                            action="<?php echo e(route('moneylender.update', ['moneylender' => $moneylender->id])); ?>"
                                            novalidate>
                                            <?php echo method_field('PUT'); ?>
                                            <?php echo csrf_field(); ?>
                                            <div class="row mb-3 align-items-end">
                                                <div class="col">
                                                    <div class="form-floating">
                                                        <input type="text" maxlength="55"
                                                            oninput="this.value = this.value.toUpperCase()"
                                                            value="<?php echo e($moneylender->moneylender_name); ?>"
                                                            name="moneylender_name"
                                                            id="moneylender_name_<?php echo e($moneylender->id); ?>"
                                                            class="form-control <?php $__errorArgs = ['moneylender_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                            placeholder="Ingrese el nombre del prestamista"
                                                            autocomplete="off" />
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
                                                        <label for="moneylender_name_<?php echo e($moneylender->id); ?>">Nombre del
                                                            prestamista</label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-floating">
                                                        <input type="text" maxlength="13"
                                                            value="<?php echo e($moneylender->moneylender_dni); ?>"
                                                            name="moneylender_dni"
                                                            id="moneylender_dni_<?php echo e($moneylender->id); ?>"
                                                            class="form-control <?php $__errorArgs = ['moneylender_dni'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                            placeholder="Ingrese el número de identidad"
                                                            autocomplete="off" />
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
                                                        <label for="moneylender_dni_<?php echo e($moneylender->id); ?>">Nº
                                                            identidad</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3 align-items-end">
                                                <div class="col">
                                                    <div class="form-floating">
                                                        <input type="text" name="moneylender_phone"
                                                            value="<?php echo e($moneylender->moneylender_phone); ?>"
                                                            id="moneylender_phone_<?php echo e($moneylender->id); ?>"
                                                            class="form-control <?php $__errorArgs = ['moneylender_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                            data-mask="00000000" data-mask-visible="true"
                                                            placeholder="00000000" autocomplete="off" />
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
                                                        <label for="moneylender_phone_<?php echo e($moneylender->id); ?>">Nº
                                                            teléfono</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-3 align-items-end">
                                                <div class="col">
                                                    <div class="form-floating">
                                                        <textarea maxlength="255"
                                                            style="overflow: hidden; height: 150px; resize: none"
                                                            name="moneylender_description" id="moneylender_description"
                                                            class="form-control <?php $__errorArgs = ['moneylender_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                            autocomplete="off"
                                                            oninput="this.value = this.value.toUpperCase()"><?php echo e($moneylender->moneylender_description); ?></textarea>
                                                        <?php $__errorArgs = ['moneylender_description'];
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
                                                        <span class="invalid-feedback" role="alert"
                                                            id="project-comment-error" style="display: none;">
                                                            <strong></strong>
                                                        </span>
                                                        <label for="moneylender_description">
                                                            Descripción del prestamista
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <a href="<?php echo e(route('moneylender.index')); ?>"
                                                class="btn btn-dark me-auto">Volver</a>
                                            <button type="submit" class="btn btn-teal">Guardar cambios</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin del modal específico -->

                        <!-- Modal de actualización específico para cada prestamista -->
                        <div class="modal modal-blur fade" id="modal-loans-<?php echo e($moneylender->id); ?>" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content" style="border: 2px solid #52524E">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Solicitud de prestamo</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="<?php echo e(route('moneylender_loans.store')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <div class="row mb-3 align-items-end">
                                                <div class="col" style="display: none">
                                                    <div class="form-floating">
                                                        <input type="datetime-local" name="creditNote_date"
                                                            style="font-size: 10px;" value="<?php echo e($creditNoteDate); ?>"
                                                            id="creditNote_date" min="<?php echo e($creditNoteDate); ?>"
                                                            max="<?php echo e($creditNoteDate); ?>"
                                                            class="form-control <?php $__errorArgs = ['creditNote_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                            readonly />
                                                        <?php $__errorArgs = ['creditNote_date'];
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

                                                        <label for="creditNote_date"><small>Fecha de préstamo</small></label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-floating">
                                                        <select class="form-select" id="investor_id" name="investor_id"
                                                            style="width: 100%;">
                                                            <option value="" selected disabled>Seleccione un inversionista
                                                            </option>
                                                            <?php $__currentLoopData = $investors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $investor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($investor->id); ?>"
                                                                    data-balance="<?php echo e($investor->investor_balance); ?>" <?php echo e(old('investor_id') == $investor->id ? 'selected' : ''); ?>>
                                                                    <?php echo e($investor->investor_name); ?>

                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                        <label for="investor_id">Inversionistas</label>
                                                    </div>
                                                </div>
                                                <div class="row mb-3 align-items-end">
                                                    <div class="col">
                                                        <div class="form-floating">
                                                            <input type="text" name="moneylender_phone"
                                                                oninput="this.value = this.value.replace(/\D/g, '')"
                                                                minlength="8" maxlength="11"
                                                                value="<?php echo e(old('moneylender_phone')); ?>"
                                                                id="moneylender_phone"
                                                                class="form-control <?php $__errorArgs = ['moneylender_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                                autocomplete="off" />
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
                                                            <label for="moneylender_phone">Nº teléfono</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3 align-items-end">
                                                    <div class="col">
                                                        <div class="form-floating">
                                                            <textarea maxlength="255"
                                                                style="overflow: hidden; height: 150px; resize: none"
                                                                name="moneylender_description" id="moneylender_description"
                                                                class="form-control <?php $__errorArgs = ['moneylender_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                                autocomplete="off"
                                                                oninput="this.value = this.value.toUpperCase()"><?php echo e(old('moneylender_description')); ?></textarea>
                                                            <?php $__errorArgs = ['moneylender_description'];
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
                                                            <span class="invalid-feedback" role="alert"
                                                                id="project-comment-error" style="display: none;">
                                                                <strong></strong>
                                                            </span>
                                                            <label for="moneylender_description">
                                                                Descripción del prestamista
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-dark me-auto"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-teal">Guardar nuevo
                                                    prestamista</button>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('modules.moneylenders._create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('modules.moneylender_loans.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('scripts'); ?>

<!-- Alert fade closer script-->
<script src="<?php echo e(asset('customjs/alert_closer.js')); ?>"></script>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="<?php echo e(asset('vendor/datatables/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('customjs/datatable/dt_moneylender.js')); ?>"></script>
<script src="<?php echo e(asset('customjs/datatable/dt_moneylender_loans.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/carlos/Code/InvestorInsight/resources/views/modules/moneylenders/index.blade.php ENDPATH**/ ?>