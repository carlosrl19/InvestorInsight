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
                    <p class="text-left">Esta intentando eliminar a un inversionista, esta acción no se puede deshacer y eliminará por completo toda información sobre el inversionista <strong style="text-transform: uppercase">{{ $commission_agent->commission_agent_name }}</strong>.</p>

                    <div class="mt-4 text-left">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>