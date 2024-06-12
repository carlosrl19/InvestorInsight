// Get investor_balance to investor selected in select
document.getElementById("investor_id").addEventListener("change", function () {
    var selectedOption = this.options[this.selectedIndex];
    var balance = selectedOption.getAttribute("data-balance");
    document.getElementById("investor_balance").value = formatNumber(balance);
});

// Add commas to investor_balance
function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
}
