<div class="modal modal-blur fade" id="investorsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="investorsModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Filtrar excel por inversionista</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="form-floating">
                            <select name="investor_id" id="investor_id_select" class="form-select">
                                <option value="" selected disabled>Seleccione el inversionista</option>
                                <?php $__currentLoopData = $investorsWithActivedProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $investor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($investor->id); ?>"><?php echo e($investor->investor_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <label for="investor_id_select">Inversionistas con proyectos activos</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <button type="button" class="btn btn-teal" id="exportButton">Exportar proyectos activos del inversionista</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('exportButton').addEventListener('click', function() {
        var investorId = document.getElementById('investor_id_select').value;
        if (investorId) {
            var url = '<?php echo e(route("project.active_investor_projects", ":investorId")); ?>';
            url = url.replace(':investorId', investorId);
            window.location.href = url;
        } else {
            showToast('Por favor, seleccione un inversionista.');
        }
    });
</script>
<?php /**PATH R:\Code\En proceso\InvestorInsight\resources\views/modules/projects/_investors_select_project_export.blade.php ENDPATH**/ ?>