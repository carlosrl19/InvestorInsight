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
      const investorFinalProfit = 0.5 * investorProfit;
      investorFinalProfitInput.value = investorFinalProfit.toFixed(2);

      const commissioners = document.querySelectorAll('#project_commissioners_table tbody tr');
      let commissionerCommissions = 0;

      commissioners.forEach((commissioner, index) => {
          const commissionInput = commissioner.querySelector('input[name="commissioner_commission[]"]');
          let commission = 0;
          if (index === 0) {
              commission = commissioners.length === 1 ? 0.5 * investorProfit : 0.4 * investorProfit;
          } else if (index === 1) {
              commission = 0.1 * investorProfit;
          }
          commissionInput.value = commission.toFixed(2);
          commissionerCommissions += commission;
      });

      const updatedInvestorFinalProfit = investorProfit - commissionerCommissions;
      investorFinalProfitInput.value = updatedInvestorFinalProfit.toFixed(2);
  }

  calculateTotalInvestment();
}

// Calculate project_investment
function calculateTotalInvestment() {
  const investorInvestments = document.querySelectorAll('input[name="investor_investment"]');
  const totalInvestment = Array.from(investorInvestments).reduce((total, input) => total + parseFloat(input.value || 0), 0);
  document.getElementById('project_investment').value = totalInvestment.toFixed(2);
}

// Update investor investment amount in real time
// If a user returns to step 2 and modify transfer_amount, automatically this code update investor_investment in step 3
document.getElementById('transfer_amount').addEventListener('input', function() {
  const transferAmount = this.value;
  document.querySelectorAll('input[name="investor_investment"]').forEach(input => {
      input.value = transferAmount;
  });
  calculateTotalInvestment();
  const investorProfitInput = document.querySelector('input[name="investor_profit"]');
  if (investorProfitInput) {
      const event = new Event('input');
      investorProfitInput.dispatchEvent(event);
  }
});

//-------------------------
//  Commissioners Agent
//-------------------------

function addCommissioner() {
  const commissionerSelect = document.getElementById('commissioner_select');
  const selectedCommissioner = commissionerSelect.options[commissionerSelect.selectedIndex];
  const commissionerId = selectedCommissioner.value;

  if (!commissionerId || document.querySelector(`input[name="commissioner_id[]"][value="${commissionerId}"]`)) {
      alert(commissionerId ? "¡Este comisionista ya ha sido seleccionado!" : "¡Por favor, seleccione un comisionista!");
      return;
  }

  // Verificar si ya se han agregado dos filas
  if (document.querySelectorAll('#project_commissioners_table tbody tr').length >= 2) {
      alert("Solo se permiten agregar dos filas.");
      return;
  }

  const newRow = document.createElement('tr');
  newRow.innerHTML = `
    <td>${selectedCommissioner.text}</td>
    <td>
      <input type="number" name="commissioner_commission[]" id="commissioner_commission" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" placeholder="Comisión total del comisionista" min="1" class="form-control" required readonly>
      <input type="hidden" name="commissioner_id[]" value="${commissionerId}">
      <span class="invalid-feedback" role="alert" id="commissioner-commission-error" style="display: none;">
        <strong></strong>
    </span>
    </td>
    <td>
      <button type="button" class="btn btn-md btn-danger" style="border: none; padding: 5px 0px 5px 10px" onclick="removeCommissionerRow(this)" data-commissioner-id="${commissionerId}">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
          <path d="M4 7l16 0"></path>
          <path d="M10 11l0 6"></path>
          <path d="M14 11l0 6"></path>
          <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
          <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
        </svg>
      </button>
    </td>`;

  document.querySelector('#project_commissioners_table tbody').appendChild(newRow);
  selectedCommissioner.disabled = true;

  // Recalculate investor final profit
  const investorProfitInput = document.querySelector('input[name="investor_profit"]');
  if (investorProfitInput) {
      const event = new Event('input');
      investorProfitInput.dispatchEvent(event);
  }
}

// Disabled commission_agent default
document.addEventListener('DOMContentLoaded', (event) => {
  const commissionerSelect = document.getElementById('commissioner_select');
  const juniorOption = commissionerSelect.querySelector('option[value="1"]');
  if (juniorOption) {
    juniorOption.disabled = true;
  }
});

// Remove commissioner
function removeCommissionerRow(button) {
  const commissionerId = button.getAttribute('data-commissioner-id');
  const rowToRemove = button.closest('tr');
  document.getElementById('commissioner_select').querySelector(`option[value="${commissionerId}"]`).disabled = false;
  rowToRemove.remove();

  // Recalculate investor final profit
  const investorProfitInput = document.querySelector('input[name="investor_profit"]');
  if (investorProfitInput) {
      const event = new Event('input');
      investorProfitInput.dispatchEvent(event);
  }
}
