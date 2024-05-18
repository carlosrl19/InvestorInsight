// Function to calculate the total investment amount
function calculateTotalInvestment() {
    let totalInvestment = 0;
    document.querySelectorAll('input[name="investor_investment[]"]').forEach(function(input) {
        totalInvestment += parseFloat(input.value) || 0;
    });
    document.getElementById('project_investment').value = totalInvestment.toFixed(2);
}

// Function to add new inputs with a button
function addInvestor() {
    const investorTableBody = document.querySelector('#project_investors_table tbody');
    const investorSelect = document.getElementById('investor_select');
    const selectedInvestorOption = investorSelect.options[investorSelect.selectedIndex];
    const investorId = selectedInvestorOption.value;

    // Verificar si se ha seleccionado un inversor
    if (!investorId) {
        alert("¡Por favor, selecciona un inversor!");
        return; // Salir de la función si no se ha seleccionado un inversor
    }

    // Verificar si el inversor ya ha sido seleccionado
    const isAlreadySelected = document.querySelector(`input[name="investor_id[]"][value="${investorId}"]`);
    if (isAlreadySelected) {
        alert("¡Este inversor ya ha sido seleccionado!");
        return; // Salir de la función si el inversor ya ha sido seleccionado
    }

    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>${selectedInvestorOption.text}</td>
        <td>
            <input type="number" name="investor_investment[]" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" placeholder="Inversión" min="0" class="form-control" required">
            <input type="hidden" name="investor_id[]" value="${investorId}">
        </td>
        <td>
        <button type="button" class="btn btn-md btn-danger" style="border: none; padding: 5px 0px 5px 10px" onclick="removeInvestorRow(this)" data-investor-id="${investorId}">
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
        </button>
        </td>`;
    investorTableBody.appendChild(newRow);

    // Deshabilitar la opción seleccionada en el select de inversores
    selectedInvestorOption.disabled = true;

    // Total investment calculate
    calculateTotalInvestment();
}

// Function to remove a selected investor row
function removeInvestorRow(button) {
    const investorId = button.getAttribute('data-investor-id');
    const rowToRemove = button.closest('tr');

    // Habilitar nuevamente la opción en el select de inversores
    document.getElementById('investor_select').querySelector(`option[value="${investorId}"]`).disabled = false;

    // Eliminar la fila del inversor
    rowToRemove.remove();

    // Total investment calculate
    calculateTotalInvestment();
}

// Event listener to control visibility and functionality of the add button based on investor selection
document.getElementById('investor_select').addEventListener('change', function() {
    const addButton = document.getElementById('add_investor_btn');
    addButton.style.display = this.value ? 'block' : 'none'; // Mostrar u ocultar el botón de agregar
    addButton.disabled = !this.value; // Desactivar el botón de agregar si no se ha seleccionado un inversor
});

// Add event listener to investor investment inputs
document.querySelectorAll('input[name="investor_investment[]"]').forEach(function(input) {
    input.addEventListener('input', calculateTotalInvestment);
});