// Calcular la diferencia en días entre startDate y endDate para el project_work_days
function calcularDiferencia() {
    var startDate = new Date(
        document.getElementById("project_start_date").value
    );
    var endDate = new Date(document.getElementById("project_end_date").value);

    // Verificar si las fechas son válidas
    if (isNaN(startDate) || isNaN(endDate)) {
        document.getElementById("project_work_days").value = "";
        return;
    }

    // Calcular la diferencia en milisegundos
    var diffInMs = endDate - startDate;

    // Convertir a días (sumando 1 para incluir ambos extremos)
    var diffInDays = Math.floor(diffInMs / (1000 * 60 * 60 * 24));

    document.getElementById("project_work_days").value = diffInDays;
}

// Escuchar cambios en las fechas
document
    .getElementById("project_start_date")
    .addEventListener("change", calcularDiferencia);
document
    .getElementById("project_end_date")
    .addEventListener("change", calcularDiferencia);

// Disable dates before start date in project_end_date
document
    .getElementById("project_start_date")
    .addEventListener("change", function () {
        var startDate = new Date(this.value);
        var minEndDate = new Date(startDate.getTime() + 24 * 60 * 60 * 1000);

        var minEndDateStr = minEndDate.toISOString().split("T")[0]; // Formatear la fecha mínima

        document.getElementById("project_end_date").min = minEndDateStr;
    });
