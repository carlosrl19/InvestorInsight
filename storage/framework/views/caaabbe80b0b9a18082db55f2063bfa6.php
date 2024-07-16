<div class="modal modal-blur fade" id="modal-fund<?php echo e($investor->id); ?>" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Agregar fondo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('investor.fund', $investor)); ?>" method="POST" novalidate>
                    <?php echo csrf_field(); ?>
                    <div class="row align-items-end">
                        <div class="col" style="display: none">
                            <div class="form-floating">
                                <input type="datetime-local" 
                                    name="investor_change_date" 
                                    style="font-size: 10px;" 
                                    value="<?php echo e($todayDate); ?>" 
                                    id="investor_change_date"
                                    min="<?php echo e($todayDate); ?>" 
                                    max="<?php echo e($todayDate); ?>" 
                                    class="form-control <?php $__errorArgs = ['investor_change_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    readonly />
                                <?php $__errorArgs = ['investor_change_date'];
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

                                <label for="investor_change_date"><small>Fecha actual</small></label>
                            </div>
                        </div>
                        
                        <div class="col-6 mb-4">
                            <div class="form-floating">
                                <input type="number" readonly value="<?php echo e($investor->investor_balance); ?>"
                                    name="investor_old_funds" id="investor_old_funds"
                                    class="form-control <?php $__errorArgs = ['investor_old_funds'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    autocomplete="off" autofocus/>
                                <?php $__errorArgs = ['investor_old_funds'];
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
                                <label for="investor_old_funds">Fondo actual del inversionista</label>
                            </div>
                            <input type="hidden" name="investor_balance" value="<?php echo e($investor->investor_balance); ?>">
                        </div>
                        
                        <div class="col-6 mb-4">
                            <div class="form-floating">
                                <input type="number" value="<?php echo e($investor->investor_balance); ?>" min="<?php echo e($investor->investor_balance); ?>"
                                    name="investor_new_funds" id="investor_new_funds"
                                    class="form-control <?php $__errorArgs = ['investor_new_funds'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    autocomplete="off" />
                                <?php $__errorArgs = ['investor_new_funds'];
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
                                <label for="investor_new_funds">Nuevo fondo del inversionista</label>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-end">
                            <div class="col">
                                <div class="form-floating">
                                    <textarea maxlength="255"
                                        class="form-control <?php $__errorArgs = ['investor_new_funds_comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        autocomplete="off" maxlength="255" name="investor_new_funds_comment" id="investor_new_funds_comment"
                                        style="resize: none; height: 100px;" oninput="this.value = this.value.toUpperCase()"><?php echo e(old('investor_new_funds_comment')); ?></textarea>
                                    <?php $__errorArgs = ['investor_new_funds_comment'];
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
                                    <span class="invalid-feedback" role="alert" id="transfer-comment-error"
                                        style="display: none;">
                                        <strong></strong>
                                    </span>
                                    <label for="investor_new_funds_comment">Comentarios / Motivo para agregar fondos</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" style="float: left;" class="btn btn-dark me-auto" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" style="float: left; margin-left: 5px" class="btn btn-teal">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div><?php /**PATH R:\Code\En proceso\InvestorInsight\resources\views/modules/investors/_fund.blade.php ENDPATH**/ ?>