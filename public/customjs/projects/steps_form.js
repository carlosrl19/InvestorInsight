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
        var isValid = true;
        var currentFieldset = $(steps[stepIndex]);
    
        // Valida cada campo del paso actual
        currentFieldset.find("input, textarea, select").each(function(){
            if($(this).val() === ""){
                isValid = false;
                $(this).addClass("is-invalid");
            } else {
                $(this).removeClass("is-invalid");
                $(this).addClass("is-valid");
            }
        });
        
        return isValid;
    }
})