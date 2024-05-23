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

    function validateStep(stepIndex) {
        var isValid = true;
        var currentFieldset = $(steps[stepIndex]);
    
        currentFieldset.find("input, textarea, select").each(function () {
            var field = $(this);
            var value = field.val();
            var fieldName = field.attr('name');
            var errorSpan = $("#" + fieldName.replace('_', '-') + "-error strong");
    
            field.removeClass("is-invalid is-valid");
            errorSpan.text('');
    
            if (value === "") {
                isValid = false;
                field.addClass("is-invalid");
                errorSpan.text('Este campo es obligatorio.');
                $("#" + fieldName.replace('_', '-') + "-error").show();
            } else {
                field.addClass("is-valid");
                $("#" + fieldName.replace('_', '-') + "-error").hide();
    
                // Validaciones específicas para campos individuales
                if (fieldName === 'project_name') {
                    if (value.length < 3) {
                        isValid = false;
                        field.addClass("is-invalid");
                        errorSpan.text('El nombre del proyecto debe tener al menos 3 caracteres.');
                        $("#" + fieldName.replace('_', '-') + "-error").show();
                    } else if (value.length > 55) {
                        isValid = false;
                        field.addClass("is-invalid");
                        errorSpan.text('El nombre del proyecto no puede tener más de 55 caracteres.');
                        $("#" + fieldName.replace('_', '-') + "-error").show();
                    } else if (!/^[a-zA-Z\s]*$/.test(value)) {
                        isValid = false;
                        field.addClass("is-invalid");
                        errorSpan.text('El nombre del proyecto no puede contener números ni símbolos.');
                        $("#" + fieldName.replace('_', '-') + "-error").show();
                    } else {
                        field.addClass("is-valid");
                        $("#" + fieldName.replace('_', '-') + "-error").hide();
                    }
                }
            }
        });
    
        // Validación específica para las fechas
        var startDate = currentFieldset.find('#project_start_date').val();
        var endDate = currentFieldset.find('#project_end_date').val();

        var startDateInput = currentFieldset.find('#project_start_date');
        var startDateError = currentFieldset.find('#start-date-error strong');

        var endDateInput = currentFieldset.find('#project_end_date');
        var endDateError = currentFieldset.find('#end-date-error strong');

        // Validación específica para los días de trabajo
        var workDays = currentFieldset.find('#project_work_days').val();
        var workDaysInput = currentFieldset.find('#project_work_days');
        var workDaysError = currentFieldset.find('#work-days-error strong');
    
        // Limpiar mensajes de error anteriores
        startDateError.text('');
        endDateError.text('');
        workDaysError.text('');
    
        // Validar fecha de inicio
        if (startDate) {
            var now = new Date().toISOString().split('T')[0];
            if (new Date(startDate) < new Date(now)) {
                isValid = false;
                startDateInput.addClass("is-invalid");
                startDateError.text('La fecha de inicio del proyecto no puede ser anterior a la fecha actual.');
                $('#start-date-error').show();
            } else {
                startDateInput.removeClass("is-invalid");
                $('#start-date-error').hide();
            }
        }
    
        // Validar fecha de fin
        if (startDate && endDate) {
            if (new Date(endDate) <= new Date(startDate)) {
                isValid = false;
                endDateInput.addClass("is-invalid");
                endDateError.text('La fecha de cierre del proyecto debe ser mayor a la fecha inicial del mismo.');
                $('#end-date-error').show();
            } else {
                endDateInput.removeClass("is-invalid");
                $('#end-date-error').hide();
            }
        }

        // Validar días de trabajo
        if (workDays) {
            if (new Number(workDays) <= 0) {
                isValid = false;
                workDaysInput.addClass("is-invalid");
                workDaysError.text('El total de días de trabajo del proyecto no puede ser menor o igual a 0.');
                $('#work-days-error').show();
            } else {
                workDaysInput.removeClass("is-invalid");
                $('#work-days-error').hide();
            }
        }
    
        return isValid;
    }    
})