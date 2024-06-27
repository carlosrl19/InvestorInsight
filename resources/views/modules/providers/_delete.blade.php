<div class="modal modal-blur fade" id="deleteModal{{ $provider->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $provider->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #883939">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('provider.destroy', $provider->id) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p class="text-left">Esta intentando eliminar a un proveedor, esta acción no se puede deshacer y eliminará por completo toda información sobre el proveedor <strong style="text-transform: uppercase">{{ $provider->provider_name }}</strong>.</p>

                    <div class="mt-4 text-left">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Confirmar acción</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>