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
                <img style="filter: brightness(0) saturate(100%) invert(100%) sepia(100%) saturate(0%) hue-rotate(288deg) brightness(102%) contrast(102%); padding-right: 10px" src="../static/svg/trash.svg" width="26" height="20" alt="">
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
