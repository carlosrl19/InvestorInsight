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
Inversionistas
<?php $__env->stopSection(); ?>

<?php $__env->startSection('create'); ?>
<a href="#" class="btn btn-primary" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" data-bs-toggle="modal" data-bs-target="#modal-team">
    + Nuevo inversionista
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
                            <th>ID</th>
                            <th>NOMBRE <br>INVERSIONISTA</th>
                            <th>EMPRESA <br>AFILIADA</th>
                            <th>Nº IDENTIDAD</th>
                            <th>Nº TELEFONO</th>
                            <th>FONDO MONETARIO</th>
                            <th>RECOMENDACION</th>
                            <th>ESTADO</th>
                            <th style="width: 8vh">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $investors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $investor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="text-center">
                                <td><?php echo e($i++); ?></td>
                                <td>
                                    <a href="<?php echo e(route('investor.show', $investor)); ?>"><?php echo e($investor->investor_name); ?>

                                        <small>
                                            <sup>
                                                <img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="<?php echo e(asset('../static/svg/link.svg')); ?>" width="20" height="20" alt="">
                                            </sup>
                                        </small>
                                    </a>
                                </td>
                                <td><?php echo e($investor->investor_company_name); ?></td>
                                <td><?php echo e($investor->investor_dni); ?></td>
                                <td><?php echo e($investor->investor_phone); ?></td>

                                <?php if($investor->investor_balance <= 0): ?>
                                    <td><span class="text-light badge bg-red">Lps. <?php echo e(number_format($investor->investor_balance,2)); ?></span></td>
                                <?php else: ?>
                                    <td>Lps. <?php echo e(number_format($investor->investor_balance,2)); ?></td>
                                <?php endif; ?>

                                <td>
                                    <?php if($investor->investor_reference): ?>
                                        <a href="<?php echo e(route('investor.show', ['investor' => $investor->investor_reference->id])); ?>">
                                            <?php echo e($investor->investor_reference->investor_name); ?>

                                            <small>
                                                <sup>
                                                    <img style="filter: invert(38%) sepia(58%) saturate(6939%) hue-rotate(204deg) brightness(94%) contrast(72%);" src="<?php echo e(asset('../static/svg/link.svg')); ?>" width="20" height="20" alt="">
                                                </sup>
                                            </small>
                                        </a>
                                    <?php else: ?>
                                        <strong class="text-red">Sin recomendación</strong>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($investor->investor_status == '1'): ?>
                                        <span class="badge bg-success me-1"></span> Disponible
                                    <?php elseif($investor->investor_status == '0'): ?>
                                        <span class="badge bg-orange me-1"></span> <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Habilite todas las acciones cambiando la disposición del inversionista a proyectos a 'Disponible' en el apartado de 'Actualizar información'.">No disponible</span>
                                    <?php elseif($investor->investor_status == '3'): ?>
                                        <span class="badge bg-red me-1"></span> <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Habilite todas las acciones cambiando la disposición del inversionista a proyectos a 'Disponible' en el apartado de 'Actualizar información'.">Liquidado / No disponible</span>
                                    <?php else: ?>
                                        <span class="badge bg-red me-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Existe un error en el estado del inversionista."></span> Estado inválido
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo $__env->make('modules.investors._delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php echo $__env->make('modules.investors._fund', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    
                                    <?php if($investor->id != 1): ?>
                                        <?php if($investor->investor_status != 3): ?>
                                        <div class="btn-list flex-nowrap">
                                            <div class="dropdown">
                                                <button class="btn btn-sm dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                                    Acciones
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <!-- Modification's option -->
                                                    <small class="text-muted dropdown-item">Modificaciones</small>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-update-<?php echo e($investor->id); ?>">
                                                        <img style="filter: invert(42%) sepia(9%) saturate(0%) hue-rotate(136deg) brightness(99%) contrast(93%);" src="<?php echo e(asset('../static/svg/edit.svg')); ?>" width="20" height="20" alt="">
                                                        &nbsp;Actualizar información
                                                    </a>

                                                    <?php if($investor->investor_status == 1): ?>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-fund<?php echo e($investor->id); ?>">
                                                        <img style="filter: invert(42%) sepia(9%) saturate(0%) hue-rotate(136deg) brightness(99%) contrast(93%);" src="<?php echo e(asset('../static/svg/coins.svg')); ?>" width="20" height="20" alt="">
                                                        &nbsp;Agregar fondo
                                                    </a>
                                                    <?php endif; ?>
                                                    
                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo e($investor->id); ?>">
                                                        <img style="filter: invert(39%) sepia(68%) saturate(5311%) hue-rotate(342deg) brightness(94%) contrast(90%);" src="<?php echo e(asset('../static/svg/trash.svg')); ?>" width="20" height="20" alt="">
                                                        &nbsp;Eliminar inversionista
                                                    </a>

                                                    <!-- Liquidation's option -->
                                                    <?php if($investor->investor_balance > 0): ?>
                                                        <small class="text-muted dropdown-item">Liquidación</small>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-liquidate-<?php echo e($investor->id); ?>">
                                                            <img style="filter: invert(42%) sepia(9%) saturate(0%) hue-rotate(136deg) brightness(99%) contrast(93%);" src="<?php echo e(asset('../static/svg/user-down.svg')); ?>" width="20" height="20" alt="">
                                                            &nbsp;Liquidar inversionista
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php else: ?>
                                        <div class="btn-list flex-nowrap">
                                            <div class="dropdown">
                                                <button class="btn btn-sm dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                                    Acciones
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <!-- Modification's option -->
                                                    <small class="text-muted dropdown-item">Modificaciones</small>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-update-<?php echo e($investor->id); ?>">
                                                        <img style="filter: invert(42%) sepia(9%) saturate(0%) hue-rotate(136deg) brightness(99%) contrast(93%);" src="<?php echo e(asset('../static/svg/edit.svg')); ?>" width="20" height="20" alt="">
                                                        &nbsp;Actualizar información
                                                    </a>

                                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo e($investor->id); ?>">
                                                        <img style="filter: invert(39%) sepia(68%) saturate(5311%) hue-rotate(342deg) brightness(94%) contrast(90%);" src="<?php echo e(asset('../static/svg/trash.svg')); ?>" width="20" height="20" alt="">
                                                        &nbsp;Eliminar inversionista
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                    <strong class="text-red">No disponible</strong>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <!-- Update investors modal -->
                            <div class="modal modal-blur fade" id="modal-update-<?php echo e($investor->id); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                    <div class="modal-content" style="border: 2px solid #52524E">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Editar inversionista</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="<?php echo e(route('investor.update', ['investor' => $investor->id])); ?>" novalidate>
                                                <?php echo method_field('PUT'); ?>
                                                <?php echo csrf_field(); ?>
                                                <div class="row mb-3 align-items-end">
                                                    <div class="col">
                                                        <div class="form-floating">
                                                            <input type="text" maxlength="55" oninput="this.value = this.value.toUpperCase().replace(/[^A-Z\s]/g, '')" value="<?php echo e($investor->investor_name); ?>" name="investor_name" id="investor_name_<?php echo e($investor->id); ?>" class="form-control <?php $__errorArgs = ['investor_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Ingrese el nombre del inversionista" autocomplete="off"/>
                                                            <?php $__errorArgs = ['investor_name'];
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
                                                            <label for="investor_name_<?php echo e($investor->id); ?>">Nombre del inversionista</label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-floating">
                                                            <input type="text" oninput="this.value = this.value.toUpperCase().replace(/\s/g, '')" maxlength="13" value="<?php echo e($investor->investor_dni); ?>" name="investor_dni" id="investor_dni_<?php echo e($investor->id); ?>" class="form-control <?php $__errorArgs = ['investor_dni'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Ingrese el número de identidad" autocomplete="off"/>
                                                            <?php $__errorArgs = ['investor_dni'];
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
                                                            <label for="investor_dni_<?php echo e($investor->id); ?>">Nº identidad</label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-floating">
                                                            <select class="form-select js-example-basic-multiple" name="investor_reference_id" style="font-size: clamp(0.6rem, 3vh, 0.8rem); width: 100%">
                                                                <?php $__currentLoopData = $investors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($inv->id); ?>" <?php echo e($inv->id == $investor->investor_reference_id ? 'selected' : ''); ?>>
                                                                        <?php echo e($inv->investor_name); ?>

                                                                    </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                            <?php $__errorArgs = ['investor_reference_id'];
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
                                                            <label for="investor_reference_id_<?php echo e($investor->id); ?>">Recomendado por</label>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="investor_status" value="1">
                                                </div>
                                                <div class="row mb-3 align-items-end">
                                                    <div class="col" style="display: none">
                                                        <div class="form-floating">
                                                            <input type="number" value="<?php echo e($investor->investor_balance); ?>" name="investor_balance" id="investor_balance_<?php echo e($investor->id); ?>" class="form-control <?php $__errorArgs = ['investor_balance'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" autocomplete="off"/>
                                                            <?php $__errorArgs = ['investor_balance'];
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
                                                            <label for="investor_balance_<?php echo e($investor->id); ?>">Fondo del inversionista</label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-floating">
                                                            <select type="text" class="form-select" id="select-optgroups-<?php echo e($investor->id); ?>" name="investor_company_name" style="font-size: clamp(0.7rem, 3vh, 0.8rem);">
                                                                <option value="ROBENIOR" <?php echo e((old('investor_company_name') ?? $investor->investor_company_name) == 'ROBENIOR' ? 'selected' : ''); ?>>ROBENIOR</option>
                                                                <option value="MARSELLA" <?php echo e((old('investor_company_name') ?? $investor->investor_company_name) == 'MARSELLA' ? 'selected' : ''); ?>>MARSELLA</option>
                                                                <option value="JAGUER" <?php echo e((old('investor_company_name') ?? $investor->investor_company_name) == 'JAGUER' ? 'selected' : ''); ?>>JAGUER</option>
                                                                <option value="FUTURE CAPITAL" <?php echo e((old('investor_company_name') ?? $investor->investor_company_name) == 'FUTURE CAPITAL' ? 'selected' : ''); ?>>FUTURE CAPITAL</option>
                                                            </select>
                                                            <?php $__errorArgs = ['investor_company_name'];
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
                                                            <label for="investor_company_name_<?php echo e($investor->id); ?>">Empresa afiliada</label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-floating">
                                                            <input type="text" oninput="this.value = this.value.replace(/\D/g, '')" name="investor_phone" value="<?php echo e($investor->investor_phone); ?>" id="investor_phone_<?php echo e($investor->id); ?>" class="form-control <?php $__errorArgs = ['investor_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" autocomplete="off"/>
                                                            <?php $__errorArgs = ['investor_phone'];
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
                                                            <label for="investor_phone_<?php echo e($investor->id); ?>">Nº teléfono</label>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-label">Disposición a proyectos</div>
                                                        <div>
                                                            <label class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="investor_status" value="1" <?php echo e($investor->investor_status == 1 ? 'checked' : ''); ?>>
                                                                <span class="form-check-label">Disponible</span>
                                                            </label>
                                                            <label class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="investor_status" value="0" <?php echo e($investor->investor_status == 0 ? 'checked' : ''); ?>>
                                                                <span class="form-check-label">No disponible</span>
                                                            </label>
                                                        </div>
                                                        <?php $__errorArgs = ['investor_status'];
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
                                                    </div>
                                                </div>
                                                <a href="<?php echo e(route('investor.index')); ?>" class="btn btn-dark me-auto">Volver</a>
                                                <button type="submit" class="btn btn-teal">Guardar cambios</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Liquidation modal -->
                            <div class="modal modal-blur fade" id="modal-liquidate-<?php echo e($investor->id); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content" style="border: 2px solid #52524E">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Liquidar inversionista</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="<?php echo e(route('investor.liquidate', $investor->id)); ?>" enctype="multipart/form-data" novalidate>
                                                <?php echo method_field('PUT'); ?>
                                                <?php echo csrf_field(); ?>
                                                <div style="border: 2px solid orange; padding: 10px; background-color: #fff3cd;">
                                                    <p style="color: #000; font-size: 16px; margin-left: 39%; font-weight: bold; margin-bottom: 15px">¡ATENCIÓN!</p>
                                                    <p style="color: #000;">
                                                        Está a punto de realizar la liquidación del inversionista identificado como <strong style="text-transform: uppercase"><?php echo e($investor->investor_name); ?></strong>. 
                                                        Esta acción conllevará el cierre definitivo de la cuenta, dejando el fondo del inversor en L. 0.00, una vez confirmado el proceso, no habrá marcha atrás.
                                                    </p>

                                                    <p style="color: #000;">
                                                        Si está seguro de que desea proceder con la liquidación, complete el siguiente formulario y luego haga clic en el botón "<strong>Liquidar inversionista</strong>".
                                                    </p>

                                                    <input type="hidden" name="investor_liquidation_amount" value="<?php echo e($investor->investor_balance); ?>">
                                                    <input type="hidden" name="investor_liquidation_date" value="<?php echo e($todayDate); ?>">
                                                    <input type="hidden" name="liquidation_code" value="<?php echo e($generatedCode); ?>">

                                                    <h4 class="mt-2 mb-3" style="font-weight: 500; text-align: center; text-decoration: underline">FORMULARIO OBLIGATORIO DE LIQUIDACIÓN</h4>
                                                    
                                                    <div class="row mb-3 align-items-end">
                                                        <div class="col-8">
                                                            <div class="form-floating">
                                                                <select style="font-size: clamp(0.7rem, 3vw, 0.75rem)" name="liquidation_payment_mode" id="select-optgroups"
                                                                    class="form-control <?php $__errorArgs = ['liquidation_payment_mode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                                    autocomplete="off">
                                                                    <option selected disabled>Seleccione un método de pago</option>
                                                                    <optgroup label="OTROS MÉTODOS">
                                                                        <?php $__currentLoopData = ['VARIOS MÉTODOS/TRANSFERENCIAS', 'BANCA ONLINE', 'TRANSFERENCIA', 'EFECTIVO']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($method); ?>"><?php echo e($method); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </optgroup>
                                                                    <optgroup label="BANCOS">
                                                                        <?php $__currentLoopData = ['BAC CREDOMATIC', 'BANCO ATLÁNTIDA', 'BANCO AZTECA', 'BANCO CUSCATLAN', 'BANRURAL', 'BANCO CENTRAL', 'BANTRABHN', 'BANCO DE OCCIDENTE', 'DAVIVIENDA', 'FICENSA', 'FICOHSA', 'BANHCAFE', 'LAFISE', 'BANPAIS', 'BANCO POPULAR', 'BANCO PROMÉRICA']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($bank); ?>"><?php echo e($bank); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </optgroup>
                                                                </select>
                                                                <?php $__errorArgs = ['liquidation_payment_mode'];
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
                                                                <span class="invalid-feedback" role="alert" id="transfer-bank-error"
                                                                    style="display: none;">
                                                                    <strong></strong>
                                                                </span>
                                                                <label for="liquidation_payment_mode">Método de pago utilizado</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-4">
                                                            <div class="form-floating">
                                                                <input style="color: gray" type="text" readonly min="<?php echo e($investor->investor_balance); ?>" max="<?php echo e($investor->investor_balance); ?>" value="<?php echo e(number_format($investor->investor_balance,2)); ?>" class="form-control <?php $__errorArgs = ['liquidation_payment_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" autocomplete="off"/>
                                                                <?php $__errorArgs = ['liquidation_payment_amount'];
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
                                                                <label for="liquidation_payment_amount">Total a liquidar</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-3" style="display: none">
                                                            <div class="form-floating">
                                                                <input type="number" readonly min="<?php echo e($investor->investor_balance); ?>" max="<?php echo e($investor->investor_balance); ?>" name="liquidation_payment_amount" value="<?php echo e($investor->investor_balance); ?>" id="liquidation_payment_amount" class="form-control <?php $__errorArgs = ['liquidation_payment_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" autocomplete="off"/>
                                                                <?php $__errorArgs = ['liquidation_payment_amount'];
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
                                                                <label for="liquidation_payment_amount">Liquidación total</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3 align-items-end">
                                                        <div class="col">
                                                            <div class="form-floating">
                                                                <textarea oninput="this.value = this.value.toUpperCase()" class="form-control <?php $__errorArgs = ['liquidation_payment_comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" autocomplete="off" maxlength="255"
                                                                    name="liquidation_payment_comment" id="liquidation_payment_comment" style="resize: none; height: 110px"><?php echo e(old('liquidation_payment_comment')); ?></textarea>
                                                                <?php $__errorArgs = ['liquidation_payment_comment'];
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
                                                                <label for="liquidation_payment_comment">Comentarios adicionales</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3 align-items-end">
                                                        <div class="col">
                                                            <div class="form-floating">
                                                                <input type="file" style="font-size: clamp(0.6rem, 3vw, 0.7rem)" class="form-control <?php $__errorArgs = ['liquidation_payment_img'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"" id="liquidation_payment_imgs" name="liquidation_payment_imgs[]" multiple accept="image/*">
                                                                <label for="liquidation_payment_imgs">Comprobante(s) de liquidación</label>
                                                                <span class="invalid-feedback" role="alert" id="transfer-img-error"
                                                                    style="display: none;">
                                                                    <strong></strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
    
                                                    <br>
                                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                                                    <button class="btn btn-orange" style="margin-left: 5px; background-color: orange; font-size: 14px;">Liquidar inversionista</button>
                                                    <br>
                                                    <br>
                                                </div>
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

<?php echo $__env->make('modules.investors._create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<!-- Alert fade closer script-->
<script src="<?php echo e(asset('customjs/alert_closer.js')); ?>"></script>

<!-- Datatable -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="<?php echo e(asset('vendor/datatables/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('customjs/datatable/dt_investor.js')); ?>"></script>
<script src="<?php echo e(asset('customjs/datatable/dt_investor_funds.js')); ?>"></script>
<script src="<?php echo e(asset('customjs/datatable/dt_investor_liquidations.js')); ?>"></script>

<!-- PDF view -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/carlos/Code/En proceso/InvestorInsight/resources/views/modules/investors/index.blade.php ENDPATH**/ ?>