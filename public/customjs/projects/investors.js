function addInvestor() {
  const investorSelect = document.getElementById('investor_select');
  const selectedInvestor = investorSelect.options[investorSelect.selectedIndex];
  const investorId = selectedInvestor.value;

  if (!investorId || document.querySelector(`input[name="investor_id[]"][value="${investorId}"]`)) {
    alert(investorId ? "¡Este inversor ya ha sido seleccionado!" : "¡Por favor, selecciona un inversor!");
    return;
  }

  const newRow = document.createElement('tr');
  newRow.innerHTML = `
    <td>${selectedInvestor.text}</td>
    <td>
      <input type="number" name="investor_investment[]" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" placeholder="Inversión" min="1" class="form-control" required oninput="calculateTotalInvestment()">
      <input type="hidden" name="investor_id[]" value="${investorId}">
    </td>
    <td>
      <input type="number" step="1" name="investor_profit_perc[]" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" placeholder="% ganancia" min="10" class="form-control" required oninput="calculateInvestorProfit(this)">
    </td>
    <td>
      <input type="number" name="investor_profit[]" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" class="form-control" readonly>
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
  calculateTotalInvestment();
}

function removeInvestorRow(button) {
  const investorId = button.getAttribute('data-investor-id');
  const rowToRemove = button.closest('tr');
  document.getElementById('investor_select').querySelector(`option[value="${investorId}"]`).disabled = false;
  rowToRemove.remove();
  calculateTotalInvestment();
}

function calculateTotalInvestment() {
  const investorInvestments = document.querySelectorAll('input[name="investor_investment[]"]');
  const totalInvestment = Array.from(investorInvestments).reduce((total, input) => total + parseFloat(input.value || 0), 0);
  document.getElementById('project_investment').value = totalInvestment.toFixed(2);
}

function calculateInvestorProfit(input) {
  const row = input.closest('tr');
  const investmentInput = row.querySelector('input[name="investor_investment[]"]');
  const profitPercentInput = row.querySelector('input[name="investor_profit_perc[]"]');
  const profitInput = row.querySelector('input[name="investor_profit[]"]');

  const investment = parseFloat(investmentInput.value || 0);
  const profitPercent = parseFloat(profitPercentInput.value || 0);

  const profit = investment * (profitPercent / 100);
  profitInput.value = profit.toFixed(2);

  calculateTotalInvestment();
}

// Calculate work days
document.getElementById('project_estimated_time').addEventListener('input', function() {
  var weeks = parseInt(this.value);
  var days = weeks * 7;

  document.getElementById('result').value = days;
});