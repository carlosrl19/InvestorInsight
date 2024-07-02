<div class="modal modal-blur fade" data-bs-backdrop="static" data-bs-keyboard="false" id="deleteModal{{ $commission_agent->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $commission_agent->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #883939">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('commission_agent.destroy', $commission_agent->id) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div style="border: 2px solid red; padding: 10px; background-color: #f8d7da;">
                        <p style="font-size: 16px; font-weight: bold;">¡ADVERTENCIA!</p>
                        <p>Está a punto de tomar una acción permanente e irreversible: eliminar por completo al comisionista <strong style="text-transform: uppercase">{{ $commission_agent->commissioner_name }}</strong>. 
                        Esto borrará todo rastro de su actividad, incluyendo historial de comisioies, y cualquier otro dato relacionado.</p>
                        
                        <p>Antes de proceder, se recomienda verificar cuidadosamente que esta es la acción correcta. Una vez eliminado, no habrá forma de recuperar la información del comisionista.</p>
                        
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
</div>