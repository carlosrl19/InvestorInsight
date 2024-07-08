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
                        <form action="{{ route('transfer.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3 align-items-end">
                                <div class="col" style="display: none;">
                                    <div class="form-floating">
                                        <input type="text" maxlength="35" name="transfer_code"
                                            value="{{ $generatedCode }}" id="transfer_code"
                                            class="form-control text-uppercase" readonly>
                                        <label for="transfer_code">Código de transferencia</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 align-items-end">
                                <div class="col" style="display: none;">
                                    <div class="form-floating">
                                        <input type="datetime-local" name="transfer_date" style="font-size: 10px;"
                                            value="{{ Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s') }}"
                                            id="transfer_date"
                                            min="{{ Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s') }}"
                                            max="{{ Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s') }}"
                                            class="form-control @error('transfer_date') is-invalid @enderror"
                                            readonly />
                                        @error('transfer_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <label class="form-label" for="transfer_date"><small>Fecha de
                                                transferencia</small></label>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-floating">
                                        <select class="form-select" id="investor_id" name="investor_id"
                                            style="width: 100%;">
                                            @foreach ($investors as $investor)
                                                <option value="{{ $investor->id }}"
                                                    {{ old('investor_id') == $investor->id ? 'selected' : '' }}>
                                                    {{ $investor->investor_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="investor_id">Inversionistas</label>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-floating">
                                        <select name="transfer_bank" id="select-optgroups"
                                            class="form-control @error('transfer_bank') is-invalid @enderror"
                                            autocomplete="off">
                                            <optgroup label="Otros métodos">
                                                @foreach (['REMESAS', 'EFECTIVO', 'TARJETA'] as $method)
                                                    <option value="{{ $method }}">{{ $method }}</option>
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="Bancos">
                                                @foreach (['BAC CREDOMATIC', 'BANCO ATLÁNTIDA', 'BANCO AZTECA', 'BANCO CUSCATLAN', 'BANRURAL', 'BANCO CENTRAL', 'BANTRABHN', 'BANCO DE OCCIDENTE', 'DAVIVIENDA', 'FICENSA', 'FICOHSA', 'BANHCAFE', 'LAFISE', 'BANPAIS', 'BANCO POPULAR', 'BANCO PROMÉRICA'] as $bank)
                                                    <option value="{{ $bank }}">{{ $bank }}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                        @error('transfer_bank')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
                                            value="{{ old('transfer_amount') }}" id="transfer_amount"
                                            class="form-control @error('transfer_amount') is-invalid @enderror" />
                                        @error('transfer_amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <label for="transfer_amount">Monto de transferencia</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3 align-items-end">
                                <div class="col">
                                    <div class="form-floating">
                                        <textarea class="form-control @error('transfer_comment') is-invalid @enderror" autocomplete="off" maxlength="255"
                                            name="transfer_comment" id="transfer_comment" style="resize: none; height: 100px">{{ old('transfer_comment') }}</textarea>
                                        @error('transfer_comment')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <label for="transfer_comment">Comentarios</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3 align-items-end">
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="file" accept="image/*"
                                            class="form-control @error('transfer_img') is-invalid @enderror"
                                            id="transfer_img" name="transfer_img" alt="transfer-proof"
                                            onchange="previewImage(event)">
                                        <label for="transfer_img">Comprobante de transferencia</label>
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
                                <div class="overlay" title="Clic en la imagen para ver en pantalla completa." data-bs-toggle="tooltip" data-bs-placement="bottom">Pantalla completa</div>
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
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
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
