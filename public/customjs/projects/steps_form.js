$(document).ready(function(){
    var currentStep = 0;
    var steps = $("fieldset");
    var prevBtn = $("#prevBtn");
    var nextBtn = $("#nextBtn");
    var submitBtn = $("#submitBtn");

    showStep(currentStep);

    nextBtn.click(function(){
        if(validateStep(currentStep)){
            currentStep++;
            showStep(currentStep);
        }
    });

    prevBtn.click(function(){
        currentStep--;
        showStep(currentStep);
    });

    function showStep(stepIndex){
        steps.hide();
        $(steps[stepIndex]).show();

        if(stepIndex === 0){
            prevBtn.hide();
        } else {
            prevBtn.show();
        }

        if(stepIndex === steps.length - 1){
            nextBtn.hide();
            submitBtn.show();
        } else {
            nextBtn.show();
            submitBtn.hide();
        }
    }

    function validateStep(stepIndex){
        // Add your validation logic here
        return true;
    }
});