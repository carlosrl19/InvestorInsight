document.addEventListener('DOMContentLoaded', function () {
    // Listen for the DOMContentLoaded event to ensure all elements are loaded
    // Find all elements with the data-auto-dismiss attribute
    document.querySelectorAll('[data-auto-dismiss]').forEach(function (alert) {
        // Get the auto-dismiss time from the data-auto-dismiss attribute
        var autoDismissTime = parseInt(alert.getAttribute('data-auto-dismiss'));

        // Set a timeout to hide and then remove the alert after the specified time
        setTimeout(function () {
            // Apply fade-out transition
            alert.style.transition = "opacity 1s ease-in-out";
            alert.style.opacity = 0;

            // After the fade-out transition, remove the alert from the DOM
            setTimeout(function () {
                alert.remove();
            }, 1000); // 1000ms = 1 second, matching the transition duration
        }, autoDismissTime);
    });
});