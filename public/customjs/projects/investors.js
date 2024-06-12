// Funciones relacionadas con los inversionistas

function updateInvestor() {
    const investorSelect = document.getElementById('investor_id');
    const selectedInvestor = investorSelect.options[investorSelect.selectedIndex];
    const investorId = selectedInvestor.value;

    removeExistingInvestorRow();

    if (investorId) {
        addInvestor(investorId, selectedInvestor.text);
    }
}

function removeExistingInvestorRow() {
    const existingRow = document.querySelector(`#project_investors_table tbody tr[data-investor-id]`);
    if (existingRow) {
        const previousInvestorId = existingRow.getAttribute('data-investor-id');
        document.querySelector(`#investor_id option[value="${previousInvestorId}"]`).disabled = false;
        existingRow.remove();
    }
}

function addInvestor(investorId, investorName) {
    const transferAmount = document.getElementById('transfer_amount').value;

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
        </td>
        <td>
            <input type="number" readonly name="investor_final_profit" id="investor_final_profit" class="form-control" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" placeholder="Ganancia inversionista principal" min="1">
        </td>`;

    document.querySelector('#project_investors_table tbody').appendChild(newRow);
    document.querySelector(`#investor_id option[value="${investorId}"]`).disabled = true;

    newRow.querySelector('input[name="investor_profit"]').addEventListener('input', calculateInvestorFinalProfit);
    calculateTotalInvestment();
}

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
