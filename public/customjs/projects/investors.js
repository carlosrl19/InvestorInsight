// Add new row with investor
function addInvestor() {
  const investorSelect = document.getElementById('investor_select');
  const selectedInvestor = investorSelect.options[investorSelect.selectedIndex];
  const investorId = selectedInvestor.value;

  if (!investorId || document.querySelector(`input[name="investor_id[]"][value="${investorId}"]`)) {
    alert(investorId ? "¡Este inversionista ya ha sido seleccionado!" : "¡Por favor, seleccione un inversionista!");
    return;
  }

  if (document.querySelectorAll('#project_investors_table tbody tr').length > 0) {
    alert("Solo se permite agregar una fila.");
    return;
  }

  const transferAmount = document.getElementById('transfer_amount').value;

  const newRow = document.createElement('tr');
  newRow.innerHTML = `
    <td>${selectedInvestor.text}</td>
    <td>
      <input type="number" readonly name="investor_investment[]" value="${transferAmount}" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" placeholder="Capital de inversión" min="1" class="form-control" required oninput="calculateTotalInvestment()">
      <input type="hidden" name="investor_id[]" value="${investorId}">
    </td>
    <td>
      <input type="number" name="investor_profit[]" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" placeholder="Porcentaje de ganancia" min="1" class="form-control" required">
    </td>
    <td>
      <input type="number" name="investor_profit_perc[]" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" placeholder="Ganancia total de inversión" min="1" max="50" class="form-control" required oninput="validateTotalPercentage()">
    </td>
    <td>
      <input type="number" readonly name="investor_final_profit[]" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" placeholder="Ganancia final" min="1" class="form-control">
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
  selectedInvestor.disabled = true;

  const investorProfitInput = newRow.querySelector('input[name="investor_profit[]"]');
  const investorProfitPercInput = newRow.querySelector('input[name="investor_profit_perc[]"]');
  const investorFinalProfitInput = newRow.querySelector('input[name="investor_final_profit[]"]');

  investorProfitInput.addEventListener('input', calculateInvestorFinalProfit);
  investorProfitPercInput.addEventListener('input', calculateInvestorFinalProfit);

  function calculateInvestorFinalProfit() {
    const investorProfit = parseFloat(investorProfitInput.value) || 0;
    const investorProfitPerc = parseFloat(investorProfitPercInput.value) || 0;
    const investorFinalProfit = investorProfit * (investorProfitPerc / 100);
    investorFinalProfitInput.value = investorFinalProfit.toFixed(2);
  }

  calculateTotalInvestment();
}

function validateTotalPercentage() {
  const investorProfitPerc = parseFloat(document.querySelector('input[name="investor_profit_perc[]"]').value) || 0;
  const commissionerPercInputs = document.querySelectorAll('input[name="commissioner_commission_perc[]"]');
  let totalCommissionerPerc = 0;

  commissionerPercInputs.forEach(input => {
    totalCommissionerPerc += parseFloat(input.value) || 0;
  });

  if (investorProfitPerc + totalCommissionerPerc > 100) {
    alert("El porcentaje total de ganancia y comisión no puede exceder el 100%");
  }
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

// Calcular la diferencia en días entre startDate y endDate para el project_work_days
function calcularDiferencia() {
  var startDate = new Date(document.getElementById('project_start_date').value);
  var endDate = new Date(document.getElementById('project_end_date').value);

  // Verificar si las fechas son válidas
  if (isNaN(startDate) || isNaN(endDate)) {
    document.getElementById('project_work_days').value = '';
    return;
  }

  // Calcular la diferencia en milisegundos
  var diffInMs = endDate - startDate;

  // Convertir a días (sumando 1 para incluir ambos extremos)
  var diffInDays = Math.floor(diffInMs / (1000 * 60 * 60 * 24));

  document.getElementById('project_work_days').value = diffInDays;
}

// Escuchar cambios en las fechas
document.getElementById('project_start_date').addEventListener('change', calcularDiferencia);
document.getElementById('project_end_date').addEventListener('change', calcularDiferencia);


// Disable dates before start date in project_end_date 
document.getElementById('project_start_date').addEventListener('change', function() {
  var startDate = new Date(this.value);
  var minEndDate = new Date(startDate.getTime() + 24 * 60 * 60 * 1000); // Agregar un día a la fecha de inicio

  var minEndDateStr = minEndDate.toISOString().split('T')[0]; // Formatear la fecha mínima

  document.getElementById('project_end_date').min = minEndDateStr;
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

  if (document.querySelectorAll('#project_commissioners_table tbody tr').length >= 2) {
    alert("Solo se permiten agregar dos filas.");
    return;
  }

  const newRow = document.createElement('tr');
  newRow.innerHTML = `
    <td>${selectedCommissioner.text}</td>
    <td>
      <input type="number" name="commissioner_commission_perc[]" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" placeholder="Porcentaje de comisión" min="10" max="40" class="form-control" required oninput="validateTotalPercentage()">
    </td>
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

function validateTotalPercentage() {
  const investorProfitPerc = parseFloat(document.querySelector('input[name="investor_profit_perc[]"]').value) || 0;
  const commissionerPercInputs = document.querySelectorAll('input[name="commissioner_commission_perc[]"]');
  let totalCommissionerPerc = 0;

  commissionerPercInputs.forEach(input => {
    totalCommissionerPerc += parseFloat(input.value) || 0;
  });

  if (investorProfitPerc + totalCommissionerPerc > 100) {
    alert("El porcentaje total de ganancia y comisión no puede exceder el 100%");
  }
}

// Remove commissioner
function removeCommissionerRow(button) {
  const commissionerId = button.getAttribute('data-commissioner-id');
  const rowToRemove = button.closest('tr');
  document.getElementById('commissioner_select').querySelector(`option[value="${commissionerId}"]`).disabled = false;
  rowToRemove.remove();
}