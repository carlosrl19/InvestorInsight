// Funciones de cálculo compartidas

function calculateTotalInvestment() {
    const investorInvestments = document.querySelectorAll('input[name="investor_investment"]');
    const totalInvestment = Array.from(investorInvestments).reduce((total, input) => total + parseFloat(input.value || 0), 0);
    document.getElementById('project_investment').value = totalInvestment.toFixed(2);
  }
  