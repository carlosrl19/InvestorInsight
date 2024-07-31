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
                                <input type="text" maxlength="55" name="moneylender_name" oninput="this.value = this.value.toUpperCase()" value="<?php echo e(old('moneylender_name')); ?>" id="moneylender_name" class="form-control <?php $__errorArgs = ['moneylender_name'];
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
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" oninput="this.value = this.value.toUpperCase().replace(/\s/g, '')" maxlength="13" name="moneylender_dni" value="<?php echo e(old('moneylender_dni')); ?>" id="moneylender_dni" class="form-control <?php $__errorArgs = ['moneylender_dni'];
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
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" name="moneylender_phone" oninput="this.value = this.value.replace(/\D/g, '')" minlength="8" maxlength="11" value="<?php echo e(old('moneylender_phone')); ?>" id="moneylender_phone" class="form-control <?php $__errorArgs = ['moneylender_phone'];
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
                                <label for="moneylender_phone">Nº teléfono</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <textarea maxlength="255" style="overflow: hidden; height: 150px; resize: none"
                                    name="moneylender_description" id="moneylender_description"
                                    class="form-control <?php $__errorArgs = ['moneylender_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    autocomplete="off" oninput="this.value = this.value.toUpperCase()"><?php echo e(old('moneylender_description')); ?></textarea>
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
                                <span class="invalid-feedback" role="alert" id="project-comment-error"
                                    style="display: none;">
                                    <strong></strong>
                                </span>
                                <label for="moneylender_description">
                                    Descripción del prestamista
                                </label>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-dark me-auto" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-teal">Guardar nuevo prestamista</button>
                </form>
            </div>
        </div>
   </div>
</div><?php /**PATH /home/carlos/Code/InvestorInsight/resources/views/modules/moneylenders/_create.blade.php ENDPATH**/ ?>