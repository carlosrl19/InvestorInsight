<div class="modal modal-blur fade" id="modal-team" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Agregar nuevo proyecto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="projectForm" action="{{ route('project.store')}}" method="POST">
                    <!-- Step 1 -->
                    <fieldset>
                        @csrf
                        <h3 class="text-center text-muted"><span style="border: 2px solid #637282; padding: 5px 12px 5px 12px; border-radius: 50px">1</span> Datos generales</h3>
                        <div class="row mb-3 align-items-end">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" name="project_name" value="{{ old('project_name') }}" id="project_name" class="form-control @error('project_name') is-invalid @enderror" autocomplete="off"/>
                                    @error('project_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label class="form-label" for="project_name"><small>Nombre del proyecto</small></label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-end">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="date" name="project_start_date" value="{{ old('project_start_date') }}" id="project_start_date" class="form-control @error('project_name') is-invalid @enderror" min="{{ \Carbon\Carbon::now()->toDateString() }}"/>
                                    @error('project_start_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label class="form-label" for="project_start_date"><small>Fecha inicial del proyecto</small></label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <input type="number" min="1" name="project_estimated_time" value="{{ old('project_estimated_time') }}" id="project_estimated_time" class="form-control @error('project_estimated_time') is-invalid @enderror" autocomplete="off"/>
                                    @error('project_estimated_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label class="form-label" for="project_estimated_time"><small>SM (tiempo estimado en semanas)</small></label>
                                </div>
                            </div>
                            <div class="col" style="display: none;">
                                <div class="form-floating">
                                    <input type="text" readonly class="form-control @error('project_code') is-invalid @enderror" id="project_code"
                                        name="project_code" value="PY{{Carbon\Carbon::now()->setTimezone('America/Costa_Rica')->format('smHdmY')}}" autocomplete="off"
                                        style="text-transform: uppercase; background-color: white; font-size: clamp(0.7rem, 3vw, 0.8rem)">
                                        @error('project_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <label for="project_code">ID único nota crédito</label>
                                </div>
                            </div>
                            <div class="col" style="display: none;">
                                <div class="form-floating">
                                    <input readonly type="date" name="project_end_date" value="{{ old('project_estimated_time') }}" id="project_end_date" class="form-control @error('project_estimated_time') is-invalid @enderror" min="{{ \Carbon\Carbon::now()->toDateString() }}"/>
                                    @error('project_end_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label class="form-label" for="project_end_date"><small>Fecha de cierre del proyecto</small></label>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <!-- Step 2 -->
                    <fieldset>
                        <h3 class="text-center text-muted"><span style="border: 2px solid #637282; padding: 5px 10px 5px 10px; border-radius: 50px">2</span> Inversión</h3>
                        <div class="row mb-3 align-items-end">
                            <input type="hidden" name="project_status" value="1">
                            <div class="col">
                                <div class="form-floating">
                                    <input readonly type="number" name="project_investment" value="{{ old('project_investment') }}" id="project_investment" class="form-control @error('project_investment') is-invalid @enderror" autocomplete="off"/>
                                    @error('project_investment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label class="form-label" for="project_investment"><small>Inversión del proyecto (Lempiras)</small></label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-end">
                            <div class="col">
                                <div class="form-floating">
                                    <div class="card">
                                        <div class="card-header">Listado de inversionistas disponibles para proyectos <button type="button" class="btn btn-primary" style="margin: auto;" id="add_investor_btn"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M16 19h6" /><path d="M19 16v6" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4" /></svg></button></div>
                                        <select class="form-select js-example-basic-multiple" id="investor_select" style="font-size: clamp(0.6rem, 3vh, 0.7rem); width: 100%">
                                            <option></option>
                                            @foreach ($investors as $investor)                                    
                                                <option value="{{ $investor->id }}">{{ $investor->investor_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="investors_container"></div>
                    </fieldset>

                    <!-- Step 3 -->
                    <fieldset>
                        <h3 class="text-center text-muted"><span style="border: 2px solid #637282; padding: 5px 12px 5px 10px; border-radius: 50px">3</span> Información adicional del proyecto</h3>
                        <div class="row mb-3 align-items-end">
                            <div class="col">
                                <div class="form-floating">
                                    <textarea maxlength="255" data-bs-toggle="autosize" style="overflow: hidden; overflow-wrap: break-word; resize: none; text-align: start;" 
                                    name="project_description" value="{{ old('project_description') }}" id="project_description" class="form-control @error('project_description') is-invalid @enderror" 
                                    autocomplete="off"/></textarea>
                                    @error('project_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label class="form-label" for="project_description"><small>Información adicional</small></label>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    
                    <!-- Buttons -->
                    <button type="button" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" class="btn btn-dark me-auto" id="prevBtn">Paso anterior</button>
                    <button type="button" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" class="btn btn-orange" id="nextBtn">Siguiente paso</button>
                    <button type="submit" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" class="btn btn-teal" id="submitBtn" style="display: none;">Guardar nuevo proyecto</button>
                </form>
            </div>
        </div>
   </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const investorSelect = document.getElementById('investor_select');
        const addInvestorBtn = document.getElementById('add_investor_btn');
        const investorsContainer = document.getElementById('investors_container');
        const projectInvestmentInput = document.getElementById('project_investment');

        let investorIndex = 0;

        addInvestorBtn.addEventListener('click', function () {
            const selectedInvestorId = investorSelect.value;
            const selectedInvestorName = investorSelect.options[investorSelect.selectedIndex].text;

            if (selectedInvestorId) {
                // Create the new investor entry
                const investorDiv = document.createElement('div');
                investorDiv.classList.add('row', 'mb-3', 'align-items-end');
                investorDiv.innerHTML = `
                    <div class="col" style="font-size: clamp(0.6rem, 3vh, 0.7rem);">
                        <div class="form-floating">
                            <input type="text" readonly class="form-control" value="${selectedInvestorName}" />
                            <input type="hidden" name="investors[${investorIndex}][id]" value="${selectedInvestorId}" />
                            <label class="form-label"><small>Inversionista</small></label>
                        </div>
                    </div>
                    <div class="col" style="font-size: clamp(0.6rem, 3vh, 0.7rem);">
                        <div class="form-floating">
                            <input type="number" name="investors[${investorIndex}][investment]" class="form-control investor-investment" placeholder="Inversión del inversionista" autocomplete="off" />
                            <label class="form-label"><small>Inversión (Lempiras)</small></label>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-danger remove-investor-btn">Eliminar</button>
                    </div>
                `;

                investorsContainer.appendChild(investorDiv);
                investorIndex++;

                // Disable the selected option
                investorSelect.querySelector(`option[value="${selectedInvestorId}"]`).disabled = true;
                investorSelect.value = '';

                // Add event listener to the remove button
                investorDiv.querySelector('.remove-investor-btn').addEventListener('click', function () {
                    investorsContainer.removeChild(investorDiv);
                    // Enable the option again
                    investorSelect.querySelector(`option[value="${selectedInvestorId}"]`).disabled = false;
                    calculateTotalInvestment();
                });

                // Add event listener to the investment input
                investorDiv.querySelector('.investor-investment').addEventListener('input', calculateTotalInvestment);
            }
        });

        function calculateTotalInvestment() {
            let totalInvestment = 0;
            document.querySelectorAll('.investor-investment').forEach(function(input) {
                totalInvestment += parseFloat(input.value) || 0;
            });
            projectInvestmentInput.value = totalInvestment.toFixed(2);
        }
    });
</script>