document.addEventListener('DOMContentLoaded', function() {
    const startDateInput = document.getElementById('project_start_date');
    const estimatedTimeInput = document.getElementById('project_estimated_time');
    const endDateInput = document.getElementById('project_end_date');

    startDateInput.addEventListener('change', updateEndDate);
    estimatedTimeInput.addEventListener('input', updateEndDate);

    function updateEndDate() {
        const startDate = new Date(startDateInput.value);
        const estimatedTime = parseInt(estimatedTimeInput.value) || 0;
        const endDate = new Date(startDate.getTime() + estimatedTime * 7 * 24 * 60 * 60 * 1000); // Calculating end date in milliseconds

        endDateInput.value = endDate.toISOString().split('T')[0]; // Setting the calculated end date in the input field
    }
});