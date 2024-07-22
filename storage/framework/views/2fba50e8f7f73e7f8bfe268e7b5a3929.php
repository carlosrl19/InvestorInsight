<div class="modal modal-blur fade" id="modal-team" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Nueva nota crédito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('credit_note.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row mb-3 align-items-end">
                       <div class="col" style="display: none">
                            <div class="form-floating">
                                <input type="datetime-local" 
                                    name="creditNote_date" 
                                    style="font-size: 10px;" 
                                    value="<?php echo e($creditNoteDate); ?>" 
                                    id="creditNote_date"
                                    min="<?php echo e($creditNoteDate); ?>" 
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

                                <label for="creditNote_date"><small>Fecha de nota crédito</small></label>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-floating">
                                <select class="form-select" id="investor_id" name="investor_id" style="width: 100%;">
                                    <option value="" selected disabled>Seleccione un inversionista</option>
                                    <?php $__currentLoopData = $investors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $investor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($investor->id); ?>" data-balance="<?php echo e($investor->investor_balance); ?>" <?php echo e(old('investor_id') == $investor->id ? 'selected' : ''); ?>>
                                            <?php echo e($investor->investor_name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <label for="investor_id">Inversionistas</label>
                            </div>
                        </div>
                        
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" id="investor_balance" class="form-control" value="" readonly>
                                <label for="investor_balance">Fondo actual</label>
                            </div>
                        </div>
                        
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" name="creditNote_amount" value="<?php echo e(old('creditNote_amount')); ?>" id="creditNote_amount" class="form-control <?php $__errorArgs = ['creditNote_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" autocomplete="off"/>
                                <?php $__errorArgs = ['creditNote_amount'];
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
                                <label for="creditNote_amount">Monto total de nota crédito</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col" style="display: none">
                            <div class="form-floating">
                                <input type="text" readonly class="form-control <?php $__errorArgs = ['creditNote_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="creditNote_code"
                                    name="creditNote_code" value="<?php echo e($creditNoteCode); ?>" autocomplete="off"
                                    style="text-transform: uppercase; background-color: white; font-size: clamp(0.7rem, 3vw, 0.8rem)">
                                    <?php $__errorArgs = ['creditNote_code'];
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
                                    <label for="creditNote_code">ID único nota crédito</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <textarea oninput="this.value = this.value.toUpperCase()" maxlength="255" style="overflow: hidden; height: 100px; resize: none" class="form-control <?php $__errorArgs = ['creditNote_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" autocomplete="off" name="creditNote_description" id="creditNote_description"> </textarea>
                                <?php $__errorArgs = ['creditNote_description'];
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
                                <label for="creditNote_description">Comentarios</label>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-dark me-auto" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-teal">Guardar</button>
                </form>
            </div>
        </div>
   </div>
</div>

<script src="<?php echo e(asset('customjs/investors/investor_balance.js')); ?>"></script><?php /**PATH /home/carlos/Code/En proceso/InvestorInsight/resources/views/modules/credit_note/_create.blade.php ENDPATH**/ ?>