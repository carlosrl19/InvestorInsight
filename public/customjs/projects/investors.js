// Funciones relacionadas con los inversionistas

  let firstInvestorFinalProfit = 0;

  // Función para agregar una fila de inversionista
  function addInvestorRow() {
    const investorSelect = document.getElementById('investor_select');
    const investorId = investorSelect.value;
    const investorName = investorSelect.options[investorSelect.selectedIndex].text;
    const transferAmount = document.getElementById('transfer_amount').value;
  
    if (investorId && transferAmount) {
      const newRow = createInvestorRow(investorId, investorName, transferAmount);
      document.querySelector('#project_investors_table tbody').appendChild(newRow);
  
      // Deshabilitar la opción seleccionada en el select del paso 3
      investorSelect.options[investorSelect.selectedIndex].disabled = true;
  
      // Limpiar valor seleccionado en el select
      investorSelect.value = '';
  
      // Agregar listener para calcular ganancia final del inversionista
      newRow.querySelector('input[name="investor_profit[]"]').addEventListener('input', calculateInvestorFinalProfit);
  
      // Obtener el investor_final_profit del primer inversionista
      firstInvestorFinalProfit = parseFloat(document.querySelector('input[name="investor_final_profit[]"]').value);
  
      // Calcular el investor_profit del segundo inversionista
      const secondInvestorProfit = 0.05 * firstInvestorFinalProfit;
  
      // Actualizar los valores en la nueva fila del segundo inversionista
      newRow.querySelector('input[name="investor_profit[]"]').value = secondInvestorProfit.toFixed(2);
      newRow.querySelector('input[name="investor_final_profit[]"]').value = secondInvestorProfit.toFixed(2);
  
      // Restar el 5% al investor_final_profit del primer inversionista
      const firstInvestorFinalProfitInput = document.querySelectorAll('input[name="investor_final_profit[]"]')[0];
      firstInvestorFinalProfit -= secondInvestorProfit;
      firstInvestorFinalProfitInput.value = firstInvestorFinalProfit.toFixed(2);
  
      calculateTotalInvestment();
    }
  }

  // Función para crear una fila de inversionista
  function createInvestorRow(investorId, investorName, transferAmount) {
    const newRow = document.createElement('tr');
    newRow.setAttribute('data-investor-id', investorId);
    newRow.innerHTML = `
        <td>${investorName}</td>
        <td>
            <input type="number" readonly name="project_investment" value="${transferAmount}" class="form-control" style="font-size: clamp(0.6rem, 6vh, 0.68rem); display: none" placeholder="Capital de inversión" min="1" required>
            <input type="number" step="any" readonly name="investor_investment[]" id="investor_investment" value="${transferAmount}" class="form-control" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" placeholder="Capital de inversión" min="1" required>
            <input type="hidden" name="investor_id[]" value="${investorId}">
        </td>
        <td>
            <input type="number" step="any" name="investor_profit[]" id="investor_profit" class="form-control" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" placeholder="% de ganancia compartido" min="1" required>
            <span class="invalid-feedback" role="alert" id="investor-profit-error" style="display: none;">
            <strong></strong>
            </span>
        </td>
        <td>
            <input type="number" step="any" name="investor_final_profit[]" id="investor_final_profit" class="form-control" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" placeholder="Ganancia inversionista" min="1">
            <span class="invalid-feedback" role="alert" id="investor-final-profit-error" style="display: none;">
            <strong></strong>
            </span>
        </td>
        <td>
            <button type="button" class="btn btn-danger mt-3 text-white" onclick="deleteInvestorRow(this)" style="margin-bottom: 5px; border: none; padding: 5px 0px 5px 5px">
            &nbsp;<img style="filter: brightness(0) saturate(100%) invert(100%) sepia(100%) saturate(0%) hue-rotate(288deg) brightness(102%) contrast(102%); padding-right: 10px" src="../static/svg/trash.svg" width="26" height="20" alt="">
            </button>
        </td>`;
  
    return newRow;
  }
  
  // Función para eliminar una fila de inversionista
  function deleteInvestorRow(button) {
    const row = button.closest('tr');
    const investorId = row.getAttribute('data-investor-id');
  
    // Habilitar nuevamente la opción en el select del paso 3
    document.querySelector(`#investor_select option[value="${investorId}"]`).disabled = false;
  
    // Obtener el investor_final_profit del segundo inversionista
    const secondInvestorFinalProfit = parseFloat(row.querySelector('input[name="investor_final_profit[]"]').value);
  
    // Sumar el 5% al investor_final_profit del primer inversionista
    const firstInvestorFinalProfitInput = document.querySelectorAll('input[name="investor_final_profit[]"]')[0];
    firstInvestorFinalProfit += secondInvestorFinalProfit;
    firstInvestorFinalProfitInput.value = firstInvestorFinalProfit.toFixed(2);
  
    // Eliminar la fila
    row.remove();
  
    calculateTotalInvestment();
  }
  
  let previousInvestorId = null;
  
  // Función para actualizar el inversionista
  function updateInvestor() {
    const investorSelect = document.getElementById('investor_id');
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
  
      const newRow = createInvestorRow(investorId, investorName, transferAmount);
      tbody.appendChild(newRow);
  
      // Rehabilitar la opción del inversionista previamente seleccionado
      if (previousInvestorId) {
        document.querySelector(`#investor_id option[value="${previousInvestorId}"]`).disabled = false;
      }
  
      // Deshabilitar la opción del inversionista actualmente seleccionado
      document.querySelector(`#investor_id option[value="${investorId}"]`).disabled = true;
  
      // Actualizar el ID del inversionista previamente seleccionado
      previousInvestorId = investorId;
  
      newRow.querySelector('input[name="investor_profit[]"]').addEventListener('input', calculateInvestorFinalProfit);
      calculateTotalInvestment();
    }
  }
  
  // Función para calcular el porcentaje en la tabla del paso 3
  function calculateInvestorFinalProfit() {
    const investorProfitInput = document.querySelector('input[name="investor_profit[]"]');
    const investorFinalProfitInput = document.querySelector('input[name="investor_final_profit[]"]');
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
  
  // Función para actualizar el valor de investor_investment y project_investment
  function updateInvestmentValues() {
    const transferAmount = document.getElementById('transfer_amount').value;
  
    document.querySelectorAll('input[name="investor_investment[]"], input[name="project_investment"]').forEach(input => {
      input.value = transferAmount;
    });
  
    calculateTotalInvestment();
    const investorProfitInput = document.querySelector('input[name="investor_profit[]"]');
    if (investorProfitInput) {
      investorProfitInput.dispatchEvent(new Event('input'));
    }
  }
  
  // Agregar listener para actualizar los valores de inversión
  document.getElementById('transfer_amount').addEventListener('input', updateInvestmentValues);
  
  // Agregar listener para agregar una fila de inversionista
  document.getElementById('add_investor_button_container').addEventListener('click', addInvestorRow);