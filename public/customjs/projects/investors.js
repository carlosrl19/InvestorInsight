// Funciones relacionadas con los inversionistas

function updateInvestor() {
    const investorSelect = document.getElementById('investor_id');
    const selectedInvestor = investorSelect.options[investorSelect.selectedIndex];
    const investorId = selectedInvestor.value;

    // Remove existing investor row if any
    const existingRow = document.querySelector(`#project_investors_table tbody tr[data-investor-id]`);
    if (existingRow) {
            existingRow.remove();
            // Re-enable the previous option
            const previousInvestorId = existingRow.getAttribute('data-investor-id');
            const previousInvestorOption = document.querySelector(`#investor_id option[value="${previousInvestorId}"]`);
            if (previousInvestorOption) {
                previousInvestorOption.disabled = false;
            }
    }

        // Add the new investor row
        if (investorId) {
            addInvestor(investorId, selectedInvestor.text);
        }
    }

function addInvestor(investorId, investorName) {
    const transferAmount = document.getElementById('transfer_amount').value;

    const newRow = document.createElement('tr');
    newRow.setAttribute('data-investor-id', investorId);
    newRow.innerHTML = `
        <td>${investorName}</td>
        <td>
        <input type="number" readonly name="project_investment" value="${transferAmount}" style="font-size: clamp(0.6rem, 6vh, 0.68rem); display: none" placeholder="Capital de inversión" min="1" class="form-control" required oninput="calculateTotalInvestment()">
        <input type="number" readonly name="investor_investment" id="investor_investment" value="${transferAmount}" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" placeholder="Capital de inversión" min="1" class="form-control" required oninput="calculateTotalInvestment()">
        <span class="invalid-feedback" role="alert" id="investor-investment-error" style="display: none;">
            <strong></strong>
        </span>
        <input type="hidden" name="investor_id" value="${investorId}">
        </td>
        <td>
            <input type="number" name="investor_profit" id="investor_profit" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" placeholder="Ganancia total del proyecto" min="1" class="form-control" required">
            <span class="invalid-feedback" role="alert" id="investor-profit-error" style="display: none;">
                <strong></strong>
            </span>
        </td>
        <td>
            <input type="number" readonly name="investor_final_profit" id="investor_final_profit" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" placeholder="Ganancia inversionista principal" min="1" class="form-control">
            <span class="invalid-feedback" role="alert" id="investor-final-profit-error" style="display: none;">
                <strong></strong>
            </span>
        </td>`;

    document.querySelector('#project_investors_table tbody').appendChild(newRow);
    document.querySelector(`#investor_id option[value="${investorId}"]`).disabled = true;

    const investorProfitInput = newRow.querySelector('input[name="investor_profit"]');
    const investorFinalProfitInput = newRow.querySelector('input[name="investor_final_profit"]');

    investorProfitInput.addEventListener('input', calculateInvestorFinalProfit);

    function calculateInvestorFinalProfit() {
        const investorProfit = parseFloat(investorProfitInput.value) || 0;
        const juniorCommissionInput = document.getElementById('commissioner_commission_jr');
        const juniorCommission = parseFloat(juniorCommissionInput.value) || 0;

        const commissioners = document.querySelectorAll('#project_commissioners_table tbody tr');
        const numCommissioners = commissioners.length;

        let totalCommission = 0;

        commissioners.forEach((commissioner, index) => {
            const commissionInput = commissioner.querySelector('input[name="commissioner_commission[]"]');
            let commission = 0;

            if (index === 0) {
                // Para el primer comisionista (index === 0), el 50% del investor_profit si no hay otros comisionistas
                commission = numCommissioners === 1 ? 0.5 * investorProfit : 0.9 * juniorCommission;
            } else if (index === 1) {
                // Para el segundo comisionista (index === 1), el 10% de la comisión del primer comisionista
                commission = 0.1 * juniorCommission;
            } else {
                // Para los comisionistas adicionales, distribuir el restante entre ellos
                const remainingCommission = investorProfit - totalCommission;
                commission = remainingCommission / (numCommissioners - 1);
            }

            commissionInput.value = commission.toFixed(2);
            totalCommission += commission;
        });

        // Calcular el beneficio final del inversionista como el 50% del beneficio total
        const investorFinalProfit = 0.5 * investorProfit;
        investorFinalProfitInput.value = investorFinalProfit.toFixed(2);
    }

    calculateTotalInvestment();
    }

    // Update investor investment amount in real time (project_investment get value from investor_investment and investor_investment get value from transfer_amount)
    document.getElementById('transfer_amount').addEventListener('input', function() {
        const transferAmount = this.value;
        document.querySelectorAll('input[name="investor_investment"]').forEach(input => {
            input.value = transferAmount;
        });

        // Project investment = transfer amount value
        document.querySelectorAll('input[name="project_investment"]').forEach(input => {
            input.value = transferAmount;
        });

        
        calculateTotalInvestment();
        const investorProfitInput = document.querySelector('input[name="investor_profit"]');
        if (investorProfitInput) {
            const event = new Event('input');
            investorProfitInput.dispatchEvent(event);
        }
    });
