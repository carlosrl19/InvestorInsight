<div class="modal modal-blur fade" id="modal-payment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo pago</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('payments_commissioner.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <select name="promissoryNote_id" id="promissoryNote_id" class="form-control select2-promissoryNotes" style="width: 100%" onchange="updatePaymentDetails()">
                                    <?php if($promissoryNoteCommissioners->where('promissoryNoteCommissioner_status', 1)->count() > 0): ?>
                                        <option value="" selected disabled>Seleccione el pagaré a pagar</option>
                                        <?php $__empty_1 = true; $__currentLoopData = $promissoryNoteCommissioners->where('promissoryNoteCommissioner_status', 1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promissoryNoteCommissioner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <option value="<?php echo e($promissoryNoteCommissioner->id); ?>" data-commissioner-id="<?php echo e($promissoryNoteCommissioner->commissioner_id); ?>">
                                                <?php echo e($promissoryNoteCommissioner->promissoryNoteCommissioner_code); ?> - Lps. <?php echo e(number_format($promissoryNoteCommissioner->promissoryNoteCommissioner_amount, 2)); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <option value="" disabled selected>No existen pagarés para pagar</option>
                                    <?php endif; ?>
                                </select>
                                <label for="promissoryNote_id">Pagarés pendientes de pago</label>
                            </div>
                        </div>
                        <div class="col" style="display: none">
                            <div class="form-floating">
                                <input type="datetime-local" 
                                    name="payment_date" 
                                    style="font-size: 10px;" 
                                    value="<?php echo e($todayDate); ?>" 
                                    id="payment_date"
                                    min="<?php echo e($todayDate); ?>" 
                                    max="<?php echo e($todayDate); ?>" 
                                    class="form-control <?php $__errorArgs = ['payment_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    readonly />
                                <?php $__errorArgs = ['payment_date'];
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

                                <label for="payment_date"><small>Fecha actual</small></label>
                            </div>
                        </div>
                        <div class="col" style="display: none">
                            <div class="form-floating">
                                <input type="number" 
                                    name="payment_amount" 
                                    style="font-size: 10px;" 
                                    value="<?php echo e(old('payment_amount', $promissoryNoteCommissioner->promissoryNoteCommissioner_amount ?? '')); ?>" 
                                    id="payment_amount"
                                    min="<?php echo e(old('payment_amount', $promissoryNoteCommissioner->promissoryNoteCommissioner_amount ?? '')); ?>" 
                                    max="<?php echo e(old('payment_amount', $promissoryNoteCommissioner->promissoryNoteCommissioner_amount ?? '')); ?>" 
                                    class="form-control <?php $__errorArgs = ['payment_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    readonly />
                                <?php $__errorArgs = ['payment_amount'];
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

                                <label for="payment_amount"><small>Monto a pagar</small></label>
                            </div>
                        </div>
                        <div class="col" style="display: none">
                            <div class="form-floating">
                                <input type="text" 
                                    class="form-control <?php $__errorArgs = ['payment_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    id="payment_code"
                                    name="payment_code" 
                                    value="" 
                                    autocomplete="off"
                                    readonly>
                                    <?php $__errorArgs = ['payment_code'];
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
                                <label for="payment_code">Código pago</label>
                            </div>
                        </div>
                        <input type="hidden" name="commissioner_id" id="commissioner_id" value="">
                    </div>
                    <button type="button" class="btn btn-dark me-auto" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-teal">Realizar pago</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function updatePaymentDetails() {
        // Obtener el valor seleccionado en el select
        var selectedOption = document.getElementById('promissoryNote_id').value;

        // Obtener el código del pagaré seleccionado
        var promissoryNoteCode = document.querySelector(`option[value="${selectedOption}"]`).textContent.split(' - ')[0];

        // Obtener el commissioner_id del pagaré seleccionado
        var commissionerId = document.querySelector(`option[value="${selectedOption}"]`).getAttribute('data-commissioner-id');

        // Asignar el código del pagaré al campo payment_code
        document.getElementById('payment_code').value = promissoryNoteCode;

        // Asignar el commissioner_id al campo oculto
        document.getElementById('commissioner_id').value = commissionerId;
    }
</script><?php /**PATH /home/carlos/Code/InvestorInsight (Copiar)/resources/views/modules/payment_commissioners/_create.blade.php ENDPATH**/ ?>