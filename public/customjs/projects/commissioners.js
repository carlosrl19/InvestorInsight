// Funciones relacionadas con los comisionistas

document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("commissioner_select").querySelector('option[value="1"]').disabled = true;
});

function addCommissioner() {
    const commissionerSelect = document.getElementById("commissioner_select");
    const selectedCommissioner = commissionerSelect.options[commissionerSelect.selectedIndex];
    const commissionerId = selectedCommissioner.value;

    if (!commissionerId || document.querySelector(`input[name="commissioner_id[]"][value="${commissionerId}"]`)) {
        showToast(commissionerId ? "Este comisionista ya ha sido seleccionado." : "Por favor, seleccione un comisionista.");
        return;
    }

    if (document.querySelectorAll("#project_commissioners_table tbody tr").length >= 2) {
        showToast("Solamente puede seleccionar dos comisionistas.");
        return;
    }

    addCommissionerRow(commissionerId, selectedCommissioner.text);
}

function addCommissionerRow(commissionerId, commissionerName) {
    const newRow = document.createElement("tr");
    newRow.innerHTML = `
        <td>${commissionerName}</td>
        <td>
            <input type="number" name="commissioner_commission[]" class="form-control" style="font-size: clamp(0.6rem, 6vh, 0.68rem)" placeholder="Comisión total del comisionista" min="1" required readonly>
            <input type="hidden" name="commissioner_id[]" value="${commissionerId}">
        </td>
        <td>
            <button type="button" class="btn btn-danger btn-md" style="border: none; padding: 5px 0px 5px 10px" onclick="removeCommissionerRow(this)" data-commissioner-id="${commissionerId}">
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

    document.querySelector("#project_commissioners_table tbody").appendChild(newRow);
    document.getElementById("commissioner_select").querySelector(`option[value="${commissionerId}"]`).disabled = true;

    const investorProfitInput = document.querySelector('input[name="investor_profit"]');
    if (investorProfitInput) {
        investorProfitInput.dispatchEvent(new Event("input"));
    }
}

function removeCommissionerRow(button) {
    const commissionerId = button.getAttribute("data-commissioner-id");
    document.getElementById("commissioner_select").querySelector(`option[value="${commissionerId}"]`).disabled = false;
    button.closest("tr").remove();

    const investorProfitInput = document.querySelector('input[name="investor_profit"]');
    if (investorProfitInput) {
        investorProfitInput.dispatchEvent(new Event("input"));
    }
}

function showToast(message) {
    new Toast({ message: message, type: "danger" });
}
