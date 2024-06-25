// Get investor_balance to investor selected in select
document.getElementById("investor_id").addEventListener("change", function () {
    const selectedOption = this.options[this.selectedIndex];
    const balance = selectedOption.getAttribute("data-balance");

    document.getElementById("investor_balance").value = balance;
    document.getElementById("investor_balance_history").value = balance;
});