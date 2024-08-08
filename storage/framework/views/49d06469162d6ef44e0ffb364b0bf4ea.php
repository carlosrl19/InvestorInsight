<div class="modal modal-blur fade" id="modal-team" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Agregar nuevo prestamista</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('moneylender.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" maxlength="55" name="moneylender_name" oninput="this.value = this.value.toUpperCase().replace(/[^A-Z\s]/g, '')" value="<?php echo e(old('moneylender_name')); ?>" id="moneylender_name" class="form-control <?php $__errorArgs = ['moneylender_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" autocomplete="off"/>
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
                                <label for="moneylender_name">Nombre del prestamista</label>
                            </div>
                        </div>
                        <input type="hidden" name="moneylender_status" value="1">
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" oninput="this.value = this.value.toUpperCase().replace(/\s/g, '')" name="moneylender_dni" maxlength="13" minlength="8" value="<?php echo e(old('moneylender_dni')); ?>" id="moneylender_dni" class="form-control <?php $__errorArgs = ['moneylender_dni'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" autocomplete="off"/>
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
                                <label for="moneylender_dni">Nº identidad</label>
                            </div>
                        </div>
                        <div class="col" style="display: none">
                            <div class="form-floating">
                                <input type="number" name="moneylender_balance" step="any" readonly value="0.00" title="Si el prestamista tiene fondos existentes y se está agregando al sistema por primera vez, agregue el fondo monetario como una transferencia y agregue el comentario referente a que ya era un fondo existente." data-bs-toggle="tooltip" data-bs-placement="right" id="moneylender_balance" class="form-control <?php $__errorArgs = ['moneylender_balance'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"/>
                                <?php $__errorArgs = ['moneylender_balance'];
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
                                <label for="moneylender_balance">Fondo monetario</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" oninput="this.value = this.value.replace(/\D/g, '')" minlength="8" maxlength="11" name="moneylender_phone" value="<?php echo e(old('moneylender_phone')); ?>" id="moneylender_phone" class="form-control <?php $__errorArgs = ['moneylender_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" autocomplete="off">
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
                                <div class="mb-3">
                                    <label for="moneylender_company_name" class="mb-2 mt-2" style="font-size: clamp(0.6rem, 3vh, 0.6rem); color: gray">Afiliado</label>
                                    <select type="text" class="form-select" id="select-optgroups" name="moneylender_company_name" style="font-size: clamp(0.6rem, 3vh, 0.7rem);">
                                        <option value="ROBENIOR" <?php echo e(old('moneylender_company_name') == 'ROBENIOR' ? 'selected' : ''); ?>>ROBENIOR</option>
                                        <option value="MARSELLA" <?php echo e(old('moneylender_company_name') == 'MARSELLA' ? 'selected' : ''); ?>>MARSELLA</option>
                                        <option value="JAGUER" <?php echo e(old('moneylender_company_name') == 'JAGUER' ? 'selected' : ''); ?>>JAGUER</option>
                                        <option value="FUTURE CAPITAL" <?php echo e(old('moneylender_company_name') == 'FUTURE CAPITAL' ? 'selected' : ''); ?>>FUTURE CAPITAL</option>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-dark me-auto" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-teal">Guardar</button>
                </form>
            </div>
        </div>
   </div>
</div><?php /**PATH /home/carlos/Code/InvestorInsight/resources/views/modules/moneylenders/_create.blade.php ENDPATH**/ ?>