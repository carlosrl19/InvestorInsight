<div class="modal modal-blur fade" id="modal-liquidations" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Inversionistas - Historial de liquidaciones</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card mb-2">
                    <div class="card-body">
                        <div id="search-filters-liquidations-container">FILTROS</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <table id="exampleLiquidations" class="display table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>CÓDIGO</th>
                                    <th>NOMBRE INVERSIONISTA</th>
                                    <th>FECHA LIQUIDACIÓN</th>
                                    <th>MÉTODO DE PAGO</th>
                                    <th>LIQUIDACIÓN</th>
                                    <th>COMPROBANTE(S)</th>
                                    <th>DESCARGAR <br>LIQUIDACIÓN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($investorLiquidations as $investorLiquidation)
                                    <tr class="text-center">
                                        <td>#{{ $investorLiquidation->liquidation_code }}</td>
                                        <td>{{ $investorLiquidation->investor->investor_name }}</td>
                                        <td>{{ $investorLiquidation->investor_liquidation_date }}</td>
                                        @if($investorLiquidation->liquidation_payment_mode == 'VARIOS MÉTODOS/TRANSFERENCIAS')
                                            <td>VARIOS MÉTODOS</td>
                                        @else
                                            <td>{{ $investorLiquidation->liquidation_payment_mode }}</td>
                                        @endif
                                        <td>Lps. {{ number_format($investorLiquidation->investor_liquidation_amount,2) }}</td>
                                        <td>
                                            @if ($investorLiquidation->liquidation_payment_imgs)
                                                <div class="d-flex flex-wrap justify-content-center">
                                                    @foreach (json_decode($investorLiquidation->liquidation_payment_imgs) as $image)
                                                        <div class="mx-2 my-1">
                                                            <img id="image-preview" style="border: 1px solid #e3e3e3; border-radius: 5px; padding: 5px;" src="{{ asset('images/liquidations/'. $image) }}" alt="Comprobante de liquidación" width="30" height="30">
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <!-- Full viewer with carousel -->
                                                <div class="modal fade" id="image-modal" tabindex="-1" aria-labelledby="image-modal-label" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="image-modal-label">Pantalla completa de comprobante</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div id="carousel-indicators-thumb" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                                                    <div class="carousel-inner">
                                                                        <!-- Dynamic carousel items will be injected here -->
                                                                    </div>                                                                    
                                                                </div>

                                                                <div class="carousel-indicators carousel-indicators-thumb mt-2">
                                                                    <!-- Dynamic carousel indicators will be injected here -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                No hay imágenes
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-red" style="font-size: clamp(0.6rem, 3vw, 0.6rem)" href="{{ route('investor.liquidation_download', $investorLiquidation)}}">
                                                <img style="filter: invert(99%) sepia(43%) saturate(0%) hue-rotate(95deg) brightness(110%) contrast(101%);" 
                                                src="{{ asset('../static/svg/file-text.svg') }}" width="20" height="20" alt="">
                                                &nbsp;LIQUIDACIÓN&nbsp;&nbsp;
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .carousel-img {
        max-height: 75vh;
        max-width: 100%;
        width: auto;
        border: 1px solid #e3e3e3;
        border-radius: 19px;
        padding: 10px;
        margin: auto;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var imagePreviewElements = document.querySelectorAll('#image-preview');

    imagePreviewElements.forEach(function(imagePreview) {
        imagePreview.addEventListener('click', function() {
            var fullImageSrc = this.src;
            var imageModal = new bootstrap.Modal(document.getElementById('image-modal'));

            // Get all images for the current row
            var row = this.closest('tr');
            var images = row.querySelectorAll('#image-preview');

            // Clear previous carousel items and indicators
            var carouselInner = document.querySelector('.carousel-inner');
            var carouselIndicators = document.querySelector('.carousel-indicators-thumb');
            carouselInner.innerHTML = '';
            carouselIndicators.innerHTML = '';

            // Populate the carousel with the images
            images.forEach((img, index) => {
                // Create carousel item
                var carouselItem = document.createElement('div');
                carouselItem.classList.add('carousel-item');
                if (img.src === fullImageSrc) {
                    carouselItem.classList.add('active');
                }

                // Create image element with class
                var imgElement = document.createElement('img');
                imgElement.classList.add('d-block', 'carousel-img');
                imgElement.src = img.src;

                carouselItem.appendChild(imgElement);
                carouselInner.appendChild(carouselItem);

                // Create carousel indicator
                var indicator = document.createElement('button');
                indicator.type = 'button';
                indicator.setAttribute('data-bs-target', '#carousel-indicators-thumb');
                indicator.setAttribute('data-bs-slide-to', index);
                indicator.classList.add('ratio', 'ratio-4x3');
                if (img.src === fullImageSrc) {
                    indicator.classList.add('active');
                }
                indicator.style.backgroundImage = 'url(' + img.src + ')';
                carouselIndicators.appendChild(indicator);
            });

            imageModal.show();
        });
    });
});

</script>