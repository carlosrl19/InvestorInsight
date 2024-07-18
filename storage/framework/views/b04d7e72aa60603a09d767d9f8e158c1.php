<div class="modal modal-blur fade" id="modal-team" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo pagaré</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('promissory_note.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
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
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col" style="display: none">
                            <div class="form-floating">
                                <input type="date" 
                                    name="promissoryNote_emission_date" 
                                    style="font-size: 10px;" 
                                    value="<?php echo e(Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d')); ?>"
                                    id="promissoryNote_emission_date"
                                    min="<?php echo e(Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d')); ?>"
                                    max="<?php echo e(Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d')); ?>"
                                    class="form-control <?php $__errorArgs = ['promissoryNote_emission_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    readonly />
                                <?php $__errorArgs = ['promissoryNote_emission_date'];
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

                                <label for="promissoryNote_emission_date"><small>Fecha de emisión del pagaré</small></label>
                            </div>
                        </div>
                        <input type="hidden" name="promissoryNote_status" value="1">
                        <?php $__errorArgs = ['promissoryNote_status'];
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
                        <div class="col" style="display: none">
                            <div class="form-floating">
                                <input type="text" readonly class="form-control <?php $__errorArgs = ['promissoryNote_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="promissoryNote_code"
                                    name="promissoryNote_code" value="<?php echo e($promissoryCode); ?>" autocomplete="off"
                                    style="text-transform: uppercase; background-color: white; font-size: clamp(0.7rem, 3vw, 0.8rem)">
                                    <?php $__errorArgs = ['promissoryNote_code'];
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
                                    <label for="promissoryNote_code">ID único pagaré</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="number" step="any" name="promissoryNote_amount" value="<?php echo e(old('promissoryNote_amount')); ?>" id="promissoryNote_amount" class="form-control <?php $__errorArgs = ['promissoryNote_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"/>
                                <?php $__errorArgs = ['promissoryNote_amount'];
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
                                <label for="promissoryNote_amount">Monto total del pagaré</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="date" 
                                    name="promissoryNote_final_date" 
                                    style="font-size: 12px;" 
                                    value="<?php echo e(Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d')); ?>"
                                    id="promissoryNote_final_date"
                                    min="<?php echo e(Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d')); ?>"
                                    class="form-control <?php $__errorArgs = ['promissoryNote_final_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    />
                                <?php $__errorArgs = ['promissoryNote_final_date'];
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

                                <label for="promissoryNote_final_date"><small>Fecha de pago del pagaré</small></label>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-dark me-auto" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-teal">Guardar</button>
                </form>
            </div>
        </div>
   </div>
</div><?php /**PATH C:\Users\Carlos Rodriguez\Desktop\Code\InvestorInsight\resources\views/modules/promissory_note/_create.blade.php ENDPATH**/ ?>