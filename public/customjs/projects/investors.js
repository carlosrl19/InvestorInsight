// Funciones relacionadas con los inversionistas

// Add investor row function
document.getElementById('add_button_container').addEventListener('click', function() {
    const investorSelect = document.getElementById('investor_select');
    const investorId = investorSelect.value;
    const investorName = investorSelect.options[investorSelect.selectedIndex].text;
    const transferAmount = document.getElementById('transfer_amount').value;

    if (investorId && transferAmount) {
        const newRow = document.createElement('tr');
        newRow.setAttribute('data-investor-id', investorId);
        newRow.innerHTML = `
            <td>${investorName}</td>
            <td>
                <input type="number" readonly name="project_investment" value="${transferAmount}" class="form-control" style="font-size: clamp(0.6rem, 6vh, 0.68rem); display: none" placeholder="Capital de inversión" min="1" required>
                <input type="number" readonly name="investor_investment" id="investor_investment" value="${transferAmount}" class="form-control" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" placeholder="Capital de inversión" min="1" required>
                <input type="hidden" name="investor_id" value="${investorId}">
            </td>
            <td>
                <input type="number" name="investor_profit" id="investor_profit" class="form-control" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" placeholder="% de ganancia compartido" min="1" required>
                <span class="invalid-feedback" role="alert" id="investor-profit-error" style="display: none;">
                    <strong></strong>
                </span>
            </td>
            <td>
                <input type="number" name="investor_final_profit" id="investor_final_profit" class="form-control" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" placeholder="Ganancia inversionista" min="1">
                <span class="invalid-feedback" role="alert" id="investor-final-profit-error" style="display: none;">
                    <strong></strong>
                </span>
            </td>
            <td>
                <button type="button" class="btn btn-danger mt-3 text-white" onclick="deleteInvestorRow(this)" style="margin-bottom: 5px; border: none; padding: 5px 0px 5px 5px">
                &nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M4 7l16 0"></path>
                        <path d="M10 11l0 6"></path>
                        <path d="M14 11l0 6"></path>
                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                    </svg>
                </button>
            </td>`;

        document.querySelector('#project_investors_table tbody').appendChild(newRow);

        // Deshabilitar la opción seleccionada en el select del paso 3
        investorSelect.options[investorSelect.selectedIndex].disabled = true;

        // Limpiar valor seleccionado en el select
        investorSelect.value = '';

        // Agregar listener para calcular ganancia final del inversionista
        newRow.querySelector('input[name="investor_profit"]').addEventListener('input', calculateInvestorFinalProfit);
        calculateTotalInvestment();
    }
});

// Delete investor row function
function deleteInvestorRow(button) {
    const row = button.closest('tr');
    const investorId = row.getAttribute('data-investor-id');

    // Habilitar nuevamente la opción en el select del paso 3
    document.querySelector(`#investor_select option[value="${investorId}"]`).disabled = false;

    // Eliminar la fila
    row.remove();

    calculateTotalInvestment();
}

let previousInvestorId = null;

// Function updateInvestor that add selected investor to step3 table
function updateInvestor() {
    const investorSelect = document.getElementById('investor_id');
    
    // Se encarga de obtener el inversionista seleccionado
    const selectedInvestor = investorSelect.options[investorSelect.selectedIndex];
    const investorId = selectedInvestor.value;

    if (investorId) {
        const investorName = selectedInvestor.text;
        const transferAmount = document.getElementById('transfer_amount').value;

        // Eliminar todas las filas de la tabla de inversionistas
        const tbody = document.querySelector('#project_investors_table tbody');
        while (tbody.firstChild) {
            tbody.removeChild(tbody.firstChild);
        }

        const newRow = document.createElement('tr');
        newRow.setAttribute('data-investor-id', investorId);
        newRow.innerHTML = `
            <td>${investorName}</td>
            <td>
                <input type="number" readonly name="project_investment" value="${transferAmount}" class="form-control" style="font-size: clamp(0.6rem, 6vh, 0.68rem); display: none" placeholder="Capital de inversión" min="1" required>
                <input type="number" readonly name="investor_investment" id="investor_investment" value="${transferAmount}" class="form-control" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" placeholder="Capital de inversión" min="1" required>
                <input type="hidden" name="investor_id" value="${investorId}">
            </td>
            <td>
                <input type="number" name="investor_profit" id="investor_profit" class="form-control" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" placeholder="Ganancia total del proyecto" min="1" required>
                <span class="invalid-feedback" role="alert" id="investor-profit-error" style="display: none;">
                    <strong></strong>
                </span>
            </td>
            <td>
                <input type="number" readonly name="investor_final_profit" id="investor_final_profit" class="form-control" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" placeholder="Ganancia inversionista principal" min="1">
                <span class="invalid-feedback" role="alert" id="investor-final-profit-error" style="display: none;">
                    <strong></strong>
                </span>
            </td>
            <td>
                <span class="text-red text-bold">Acción no disponible</span>
            </td>`;

        tbody.appendChild(newRow);

        // Rehabilitar la opción del inversionista previamente seleccionado
        if (previousInvestorId) {
            document.querySelector(`#investor_id option[value="${previousInvestorId}"]`).disabled = false;
        }

        // Deshabilitar la opción del inversionista actualmente seleccionado
        document.querySelector(`#investor_id option[value="${investorId}"]`).disabled = true;

        // Actualizar el ID del inversionista previamente seleccionado
        previousInvestorId = investorId;

        newRow.querySelector('input[name="investor_profit"]').addEventListener('input', calculateInvestorFinalProfit);
        calculateTotalInvestment();
    }
}

// Calculate percetage in step3 table
function calculateInvestorFinalProfit() {
    const investorProfitInput = document.querySelector('input[name="investor_profit"]');
    const investorFinalProfitInput = document.querySelector('input[name="investor_final_profit"]');
    const investorProfit = parseFloat(investorProfitInput.value) || 0;

    let totalCommission = 0;
    const commissioners = document.querySelectorAll('#project_commissioners_table tbody tr');
    const numCommissioners = commissioners.length;
    const juniorCommission = parseFloat(document.getElementById('commissioner_commission_jr').value) || 0;

    commissioners.forEach((commissioner, index) => {
        const commissionInput = commissioner.querySelector('input[name="commissioner_commission[]"]');
        let commission = 0;

        if (index === 0) {
            commission = numCommissioners === 1 ? 0.5 * investorProfit : 0.9 * juniorCommission;
        } else if (index === 1) {
            commission = 0.1 * juniorCommission;
        } else {
            commission = (investorProfit - totalCommission) / (numCommissioners - 1);
        }

        commissionInput.value = commission.toFixed(2);
        totalCommission += commission;
    });

    investorFinalProfitInput.value = (0.5 * investorProfit).toFixed(2);
}

// Investor_investment = Transfer_amount
document.getElementById('transfer_amount').addEventListener('input', function() {
    const transferAmount = this.value;

    document.querySelectorAll('input[name="investor_investment"], input[name="project_investment"]').forEach(input => {
        input.value = transferAmount;
    });

    calculateTotalInvestment();
    const investorProfitInput = document.querySelector('input[name="investor_profit"]');
    if (investorProfitInput) {
        investorProfitInput.dispatchEvent(new Event('input'));
    }
});