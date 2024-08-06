<div class="modal modal-blur fade" id="modal-team" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Nueva transferencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-8">
                        <form action="<?php echo e(route('transfer.store')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row mb-3 align-items-end">
                                <div class="col" style="display: none;">
                                    <div class="form-floating">
                                        <input type="text" maxlength="35" name="transfer_code"
                                            value="<?php echo e($generatedCode); ?>" id="transfer_code"
                                            class="form-control text-uppercase" readonly>
                                        <label for="transfer_code">Código de transferencia</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 align-items-end">
                                <div class="col" style="display: none;">
                                    <div class="form-floating">
                                        <input type="datetime-local" name="transfer_date" style="font-size: 10px;"
                                            value="<?php echo e(Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s')); ?>"
                                            id="transfer_date"
                                            min="<?php echo e(Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s')); ?>"
                                            max="<?php echo e(Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s')); ?>"
                                            class="form-control <?php $__errorArgs = ['transfer_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            readonly />
                                        <?php $__errorArgs = ['transfer_date'];
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
                                        <label for="transfer_date"><small>Fecha de
                                                transferencia</small></label>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-floating">
                                        <select style="font-size: clamp(0.7rem, 3vw, 0.75rem)" class="form-select" id="investor_id" name="investor_id"
                                            style="width: 100%;">
                                            <option selected disabled>Seleccione un inversionista</option>
                                            <?php $__currentLoopData = $investors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $investor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($investor->id); ?>"
                                                    <?php echo e(old('investor_id') == $investor->id ? 'selected' : ''); ?>>
                                                    <?php echo e($investor->investor_name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <label for="investor_id">Inversionistas</label>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-floating">
                                        <select style="font-size: clamp(0.7rem, 3vw, 0.75rem)" name="transfer_bank" id="select-optgroups"
                                            class="form-control <?php $__errorArgs = ['transfer_bank'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            autocomplete="off">
                                            <option selected disabled>Seleccione un método de pago</option>
                                            <optgroup label="Otros métodos">
                                                <?php $__currentLoopData = ['VARIOS MÉTODOS/TRANSFERENCIAS', 'REMESAS', 'EFECTIVO', 'TARJETA']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($method); ?>"><?php echo e($method); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </optgroup>
                                            <optgroup label="Bancos">
                                                <?php $__currentLoopData = ['BAC CREDOMATIC', 'BANCO ATLÁNTIDA', 'BANCO AZTECA', 'BANCO CUSCATLAN', 'BANRURAL', 'BANCO CENTRAL', 'BANTRABHN', 'BANCO DE OCCIDENTE', 'DAVIVIENDA', 'FICENSA', 'FICOHSA', 'BANHCAFE', 'LAFISE', 'BANPAIS', 'BANCO POPULAR', 'BANCO PROMÉRICA']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($bank); ?>"><?php echo e($bank); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </optgroup>
                                        </select>
                                        <?php $__errorArgs = ['transfer_bank'];
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
                                        <label for="transfer_bank">Banco / Modo de transferencia</label>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-floating">
                                        <input type="number" step="any" name="transfer_amount"
                                            value="<?php echo e(old('transfer_amount')); ?>" id="transfer_amount"
                                            class="form-control <?php $__errorArgs = ['transfer_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" />
                                        <?php $__errorArgs = ['transfer_amount'];
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
                                        <label for="transfer_amount">Monto de transferencia</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3 align-items-end">
                                <div class="col">
                                    <div class="form-floating">
                                        <textarea oninput="this.value = this.value.toUpperCase()" class="form-control <?php $__errorArgs = ['transfer_comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" autocomplete="off" maxlength="255"
                                            name="transfer_comment" id="transfer_comment" style="resize: none; height: 100px"><?php echo e(old('transfer_comment')); ?></textarea>
                                        <?php $__errorArgs = ['transfer_comment'];
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
                                        <label for="transfer_comment">Comentarios</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3 align-items-end">
                                <div class="col">
                                    <div class="form-floating">
                                        <input multiple style="font-size: clamp(0.6rem, 3vw, 0.7rem);" type="file" accept="image/*"
                                            class="form-control <?php $__errorArgs = ['transfer_img'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            id="transfer_img" name="transfer_img[]" alt="transfer-proof"
                                            onchange="previewImage(event)">
                                        <label for="transfer_img">Comprobante(s) de transferencia</label>
                                        <span class="invalid-feedback" role="alert" id="transfer-img-error"
                                            style="display: none;">
                                            <strong></strong>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-dark me-auto"
                                data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-teal">Guardar</button>
                        </form>
                    </div>

                    <div class="col-4">
                        <div class="form-floating"
                            style="border: 1px solid #e3e3e3; border-radius: 10px; padding: 10px; min-height: 40vh; max-height: 40vh;">
                            <span style="display: flex; justify-content: center; color: #5b5b5b">Visualizador de
                                comprobante ingresado de transferencia</span>
                            <div class="image-container" style="position: relative;">
                                <img id="image-preview" src="#" alt="Imagen de transferencia"
                                    style="max-width: 100%; max-height: 35vh; display: none;">
                                <div class="overlay">Pantalla completa</div>
                            </div>
                        </div>
                    </div>

                    <!-- Full viewer -->
                    <div class="modal fade" id="image-modal" tabindex="-1" aria-labelledby="image-modal-label"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="image-modal-label">Imagen de comprobante ingresado de
                                        transferencia</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body d-flex justify-content-center align-items-center">
                                    <img id="full-image" src="#" alt="Imagen de transferencia"
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        var preview = document.getElementById('image-preview');
        preview.style.display = 'block';
        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onload = function() {
            preview.src = reader.result;
        }
        reader.readAsDataURL(file);
    }
</script>

<script>
    var imagePreview = document.getElementById('image-preview');
    var fullImage = document.getElementById('full-image');

    imagePreview.addEventListener('click', function() {
        fullImage.src = this.src;
        var imageModal = new bootstrap.Modal(document.getElementById('image-modal'));
        imageModal.show();
    });
</script>

<style>
    .image-container {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .image-preview {
        display: inline-block;
    }

    .overlay:hover{
        cursor: help;
    }

    .overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        border-radius: 10px;
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        text-align: center;
        padding: 10px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .image-container:hover .overlay {
        opacity: 1;
    }
</style>
<?php /**PATH /home/carlos/Code/InvestorInsight (Copiar)/resources/views/modules/transfer/_create.blade.php ENDPATH**/ ?>