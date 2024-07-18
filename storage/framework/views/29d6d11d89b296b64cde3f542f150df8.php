<div class="modal modal-blur fade" id="modal-payment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo pago</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('payments_investor.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <select name="promissoryNote_id" id="promissoryNote_id" class="form-control select2-promissoryNotes" style="width: 100%" onchange="updatePaymentDetails()">
                                    <?php if($promissoryNoteInvestors->where('promissoryNote_status', 0)->count() > 0): ?>
                                        <option value="" selected disabled>Seleccione el pagaré a pagar</option>
                                        <?php $__empty_1 = true; $__currentLoopData = $promissoryNoteInvestors->where('promissoryNote_status', 0); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promissoryNoteInvestor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <option value="<?php echo e($promissoryNoteInvestor->id); ?>" data-investor-id="<?php echo e($promissoryNoteInvestor->investor_id); ?>">
                                                <?php echo e($promissoryNoteInvestor->promissoryNote_code); ?> - Lps. <?php echo e(number_format($promissoryNoteInvestor->promissoryNote_amount, 2)); ?>

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
                                    value="<?php echo e(old('payment_amount', $promissoryNoteInvestor->promissoryNote_amount ?? '')); ?>" 
                                    id="payment_amount"
                                    min="<?php echo e(old('payment_amount', $promissoryNoteInvestor->promissoryNote_amount ?? '')); ?>" 
                                    max="<?php echo e(old('payment_amount', $promissoryNoteInvestor->promissoryNote_amount ?? '')); ?>" 
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
                        <input type="hidden" name="investor_id" id="investor_id" value="">
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

        // Obtener el investor_id del pagaré seleccionado
        var investorId = document.querySelector(`option[value="${selectedOption}"]`).getAttribute('data-investor-id');

        // Asignar el código del pagaré al campo payment_code
        document.getElementById('payment_code').value = promissoryNoteCode;

        // Asignar el investor_id al campo oculto
        document.getElementById('investor_id').value = investorId;
    }
</script><?php /**PATH C:\Users\Carlos Rodriguez\Desktop\Code\InvestorInsight\resources\views/modules/payment_investors/_create.blade.php ENDPATH**/ ?>