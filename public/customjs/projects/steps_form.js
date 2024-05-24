$(document).ready(function() {
    var currentStep = 0;
    var steps = $("fieldset");
    var prevBtn = $("#prevBtn");
    var nextBtn = $("#nextBtn");
    var submitBtn = $("#submitBtn");

    showStep(currentStep);

    nextBtn.click(function() {
        if (validateStep(currentStep, steps)) {
            currentStep++;
            showStep(currentStep);
        }
    });

    prevBtn.click(function() {
        currentStep--;
        showStep(currentStep);
    });

    function showStep(stepIndex) {
        steps.hide();
        $(steps[stepIndex]).show();

        if (stepIndex === 0) {
            prevBtn.hide();
        } else {
            prevBtn.show();
        }

        if (stepIndex === steps.length - 1) {
            nextBtn.hide();
            submitBtn.show();
        } else {
            nextBtn.show();
            submitBtn.hide();
        }
    }

    function validateStep(stepIndex, steps) {
        if (!steps || steps.length == 0) {
            console.error("Steps array is undefined or empty");
            return false;
        }

        var isValid = true;
        var currentFieldset = $(steps[stepIndex]);

        switch (stepIndex) {
            case 0:
                isValid = validateStep1(currentFieldset) && isValid;
                break;
            case 1:
                isValid = validateStep2(currentFieldset) && isValid;
                break;
        }

        return isValid;
    }

    function validateStep1(currentFieldset) {
        var isValid = true;

        // Validaciones del primer paso
        var startDate = currentFieldset.find('#project_start_date').val();
        var endDate = currentFieldset.find('#project_end_date').val();
        var startDateInput = currentFieldset.find('#project_start_date');
        var startDateError = currentFieldset.find('#start-date-error strong');
        var endDateInput = currentFieldset.find('#project_end_date');
        var endDateError = currentFieldset.find('#end-date-error strong');
        var workDays = currentFieldset.find('#project_work_days').val();
        var workDaysInput = currentFieldset.find('#project_work_days');
        var workDaysError = currentFieldset.find('#work-days-error strong');

        startDateError.text('');
        endDateError.text('');
        workDaysError.text('');

        if (!startDate) {
            isValid = false;
            startDateInput.addClass("is-invalid");
            startDateError.text('La fecha de inicio del proyecto es obligatoria.');
            $('#start-date-error').show();
        } else {
            var now = new Date();
            now.setDate(now.getDate() - 10);
            var tenDaysAgo = now.toISOString().split('T')[0];

            if (new Date(startDate) < new Date(tenDaysAgo)) {
                isValid = false;
                startDateInput.addClass("is-invalid");
                startDateError.text('La fecha de inicio del proyecto no puede ser anterior a 10 días desde la fecha actual.');
                $('#start-date-error').show();
            } else if (startDate && endDate) {
                if (new Date(startDate) >= new Date(endDate)) {
                    isValid = false;
                    startDateInput.addClass("is-invalid");
                    startDateError.text('La fecha de inicio del proyecto debe ser menor a la fecha de cierre del mismo.');
                    $('#start-date-error').show();
                } else {
                    startDateInput.removeClass("is-invalid");
                    $('#start-date-error').hide();
                }
            } else {
                startDateInput.removeClass("is-invalid");
                $('#start-date-error').hide();
            }
        }

        if (!endDate) {
            isValid = false;
            endDateInput.addClass("is-invalid");
            endDateError.text('La fecha de cierre del proyecto es obligatoria.');
            $('#end-date-error').show();
        } else if (startDate && endDate) {
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

        if (!workDays) {
            isValid = false;
            workDaysInput.addClass("is-invalid");
            workDaysError.text('El total de días de trabajo es obligatorio.');
            $('#work-days-error').show();
        } else {
            var workDaysNumber = Number(workDays);
            if (isNaN(workDaysNumber) || workDaysNumber <= 0) {
                isValid = false;
                workDaysInput.addClass("is-invalid");
                workDaysError.text('El total de días de trabajo del proyecto no puede ser menor a 1.');
                $('#work-days-error').show();
            } else {
                workDaysInput.removeClass("is-invalid");
                $('#work-days-error').hide();
            }
        }

        return isValid;
    }

    function validateStep2(currentFieldset) {
        var isValid = true;
    
        // Validaciones del segundo paso
        var transferDate = currentFieldset.find('#transfer_date').val();
        var transferDateInput = currentFieldset.find('#transfer_date');
        var transferDateError = currentFieldset.find('#transfer-date-error strong');
    
        var transferBank = currentFieldset.find('#transfer_bank').val();
        var transferBankInput = currentFieldset.find('#transfer_bank');
        var transferBankError = currentFieldset.find('#transfer-bank-error strong');
    
        var transferAmount = currentFieldset.find('#transfer_amount').val();
        var transferAmountInput = currentFieldset.find('#transfer_amount');
        var transferAmountError = currentFieldset.find('#transfer-amount-error strong');
    
        var transferComment = currentFieldset.find('#transfer_comment').val();
        var transferCommentInput = currentFieldset.find('#transfer_comment');
        var transferCommentError = currentFieldset.find('#transfer-comment-error strong');
    
        transferDateError.text('');
        transferBankError.text('');
        transferAmountError.text('');
        transferCommentError.text('');
    
        if (!transferDate) {
            isValid = false;
            transferDateInput.addClass("is-invalid");
            transferDateError.text('La fecha de transferencia es obligatoria.');
            $('#transfer-date-error').show();
        }

        if (!transferBank) {
            isValid = false;
            transferBankInput.addClass("is-invalid");
            transferBankError.text('El banco de transferencia es obligatorio.');
            $('#transfer-bank-error').show();
        } else if (transferBank.length < 6) {
            isValid = false;
            transferBankInput.addClass("is-invalid");
            transferBankError.text('El banco de transferencia debe tener al menos 6 caracteres');
            $('#transfer-bank-error').show();
        } else if (transferBank.length > 36) {
            isValid = false;
            transferBankInput.addClass("is-invalid");
            transferBankError.text('El banco de transferencia no puede tener más de 36 caracteres.');
            $('#transfer-bank-error').show();
        } else if (!/^[^\d]+$/.test(transferBank)) {
            isValid = false;
            transferBankInput.addClass("is-invalid");
            transferBankError.text('El banco de transferencia no puede contener números ni símbolos.');
            $('#transfer-bank-error').show();
        } else {
            transferBankInput.removeClass("is-invalid");
            transferBankError.text('');
            $('#transfer-bank-error').hide();
        }        
    
        if (!transferAmount) {
            isValid = false;
            transferAmountInput.addClass("is-invalid");
            transferAmountError.text('El monto de transferencia es obligatorio.');
            $('#transfer-amount-error').show();
        } else {
            var transferAmountNumber = parseFloat(transferAmount);
            if (isNaN(transferAmountNumber) || transferAmountNumber <= 0) {
                isValid = false;
                transferAmountInput.addClass("is-invalid");
                transferAmountError.text('El monto de transferencia debe ser igual o mayor a 1.');
                $('#transfer-amount-error').show();
            }
        }
    
        if (!transferComment) {
            isValid = false;
            transferCommentInput.addClass("is-invalid");
            transferCommentError.text('El comentario de la transferencia es obligatorio.');
            $('#transfer-comment-error').show();
        } else {
            if (transferComment.length > 255) {
                isValid = false;
                transferCommentInput.addClass("is-invalid");
                transferCommentError.text('El comentario no puede exceder los 255 caracteres.');
                $('#transfer-comment-error').show();
            }
        }

        return isValid;
    }
});