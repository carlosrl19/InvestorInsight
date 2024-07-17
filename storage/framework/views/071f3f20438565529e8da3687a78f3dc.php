<div class="modal modal-blur fade" id="deleteModal<?php echo e($investor->id); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?php echo e($investor->id); ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #883939">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar acción</h5>
            </div>
            <form action="<?php echo e(route('investor.destroy', $investor->id)); ?>"
                method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <div class="modal-body">
                    <div style="border: 2px solid red; padding: 10px; background-color: #f8d7da;">
                    <p style="font-size: 16px; font-weight: bold;">¡ADVERTENCIA!</p>
                    <p>Está a punto de tomar una acción permanente e irreversible: eliminar por completo al inversionista <strong style="text-transform: uppercase"><?php echo e($investor->investor_name); ?></strong>. 
                    Esto borrará todo rastro de su actividad, incluyendo transacciones, historial de inversiones, y cualquier otro dato relacionado.</p>
                    
                    <p>Antes de proceder, se recomienda verificar cuidadosamente que esta es la acción correcta. Una vez eliminado, no habrá forma de recuperar la información del inversionista.</p>
                    
                    <p>Si está seguro de que desea continuar, haga clic en el botón "Confirmar acción" a continuación. De lo contrario, presione el botón "Cancelar" para evitar dicha eliminación.</p>
                    
                    <br>
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-red" style="margin-left: 5px; background-color: red; font-size: 14px; font-weight: bold;">Confirmar acción</button>
                    <br>
                    <br>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH /run/media/carlos/ROBENIOR/Code/En proceso/InvestorInsight/resources/views/modules/investors/_delete.blade.php ENDPATH**/ ?>