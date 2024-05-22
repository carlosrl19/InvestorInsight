// Add new row with investor
function addInvestor() {
  const investorSelect = document.getElementById('investor_select');
  const selectedInvestor = investorSelect.options[investorSelect.selectedIndex];
  const investorId = selectedInvestor.value;

  // Verificar si el inversionista ya ha sido seleccionado o si no se ha seleccionado ninguno
  if (!investorId || document.querySelector(`input[name="investor_id[]"][value="${investorId}"]`)) {
    alert(investorId ? "¡Este inversionista ya ha sido seleccionado!" : "¡Por favor, seleccione un inversionista!");
    return;
  }

  // Obtener el valor actualizado del campo transfer_amount
  const transferAmount = document.getElementById('transfer_amount').value;

  const newRow = document.createElement('tr');
  newRow.innerHTML = `
    <td>${selectedInvestor.text}</td>
    <td>
      <input type="number" readonly name="investor_investment[]" value="${transferAmount}" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" placeholder="Capital de inversión" min="1" class="form-control" required oninput="calculateTotalInvestment()">
      <input type="hidden" name="investor_id[]" value="${investorId}">
    </td>
    <td>
      <input type="number" name="investor_profit[]" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" placeholder="Ganancia total de inversión" min="1" class="form-control" required">
    </td>
    <td>
      <button type="button" class="btn btn-md btn-danger" style="border: none; padding: 5px 0px 5px 10px" onclick="removeInvestorRow(this)" data-investor-id="${investorId}">
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

  document.querySelector('#project_investors_table tbody').appendChild(newRow);
  selectedInvestor.readonly = true;
  calculateTotalInvestment();
}

// Remove investor
function removeInvestorRow(button) {
  const investorId = button.getAttribute('data-investor-id');
  const rowToRemove = button.closest('tr');
  document.getElementById('investor_select').querySelector(`option[value="${investorId}"]`).disabled = false;
  rowToRemove.remove();
  calculateTotalInvestment();
}

// Calculate project_investment
function calculateTotalInvestment() {
  const investorInvestments = document.querySelectorAll('input[name="investor_investment[]"]');
  const totalInvestment = Array.from(investorInvestments).reduce((total, input) => total + parseFloat(input.value || 0), 0);
  document.getElementById('project_investment').value = totalInvestment.toFixed(2);
}


// Update investor investment amount in real time
document.getElementById('transfer_amount').addEventListener('input', function() {
  const transferAmount = this.value;
  document.querySelectorAll('input[name="investor_investment[]"]').forEach(input => {
    input.value = transferAmount;
  });
  calculateTotalInvestment();
});

// Calculate work days
document.getElementById('project_estimated_time').addEventListener('input', function() {
  var weeks = parseInt(this.value);
  var days = weeks * 7;

  document.getElementById('result').value = days;
});


//-------------------------
//  Commissioners Agent
//-------------------------

// Add new row with commissioner
function addCommissioner() {
  const commissionerSelect = document.getElementById('commissioner_select');
  const selectedCommissioner = commissionerSelect.options[commissionerSelect.selectedIndex];
  const commissionerId = selectedCommissioner.value;

  if (!commissionerId || document.querySelector(`input[name="commissioner_id[]"][value="${commissionerId}"]`)) {
    alert(commissionerId ? "¡Este comisionista ya ha sido seleccionado!" : "¡Por favor, seleccione un comisionista!");
    return;
  }

  const newRow = document.createElement('tr');
  newRow.innerHTML = `
    <td>${selectedCommissioner.text}</td>
    <td>
      <input type="number" name="commissioner_commission[]" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" placeholder="Comisión" min="1" class="form-control" required>
      <input type="hidden" name="commissioner_id[]" value="${commissionerId}">
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
}

// Remove commissioner
function removeCommissionerRow(button) {
  const commissionerId = button.getAttribute('data-commissioner-id');
  const rowToRemove = button.closest('tr');
  document.getElementById('commissioner_select').querySelector(`option[value="${commissionerId}"]`).disabled = false;
  rowToRemove.remove();
}