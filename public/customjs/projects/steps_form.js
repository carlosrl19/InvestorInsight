$(document).ready(function () {
    var currentStep = 0;
    var steps = $("fieldset");
    var prevBtn = $("#prevBtn");
    var nextBtn = $("#nextBtn");
    var submitBtn = $("#submitBtn");

    // Mostrar el primer paso al cargar la página
    showStep(currentStep);

    // Inicialmente deshabilitar el botón submit
    submitBtn.prop("disabled", true);

    // Controlador del botón Siguiente
    nextBtn.click(function () {
        if (validateStep(currentStep, steps)) {
            currentStep++;
            showStep(currentStep);
        }
    });

    // Controlador del botón Anterior
    prevBtn.click(function () {
        currentStep--;
        showStep(currentStep);
    });

    // Función para mostrar el paso actual
    function showStep(stepIndex) {
        steps.hide();
        $(steps[stepIndex]).show();
    
        // Ocultar o mostrar botones según el paso actual
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

    // Call to validations
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
            case 2:
                isValid = validateStep3(currentFieldset) && isValid;
                break;
            case 3:
                isValid = validateStep4(currentFieldset) && isValid;
                break;
        }

        // Habilitar o deshabilitar el botón de submit según la validez del paso actual
        if (stepIndex == steps.length - 1) {
            submitBtn.prop("disabled", !isValid);
        }

        return isValid;
    }

    // Validations to step 1
    function validateStep1(currentFieldset) {
        var isValid = true;

        // Validaciones del primer paso
        var projectName = currentFieldset.find("#project_name").val();
        var startDate = currentFieldset.find("#project_start_date").val();
        var endDate = currentFieldset.find("#project_end_date").val();

        var projectNameInput = currentFieldset.find("#project_name");
        var projectNameError = currentFieldset.find(
            "#project-name-error strong"
        );
        var startDateInput = currentFieldset.find("#project_start_date");

        var startDateError = currentFieldset.find("#start-date-error strong");
        var endDateInput = currentFieldset.find("#project_end_date");
        var endDateError = currentFieldset.find("#end-date-error strong");
        var workDays = currentFieldset.find("#project_work_days").val();
        var workDaysInput = currentFieldset.find("#project_work_days");
        var workDaysError = currentFieldset.find("#work-days-error strong");

        projectNameError.text("");
        startDateError.text("");
        endDateError.text("");
        workDaysError.text("");

        if (!projectName) {
            isValid = false;
            projectNameInput.addClass("is-invalid");
            projectNameError.text("El nombre del proyecto es obligatorio.");
            $("#project-name-error").show();
        } else if (projectName.trim().length === 0) {
            isValid = false;
            projectNameInput.addClass("is-invalid");
            projectNameError.text(
                "El nombre del proyecto no puede contener solo espacios."
            );
            $("#project-name-error").show();
        } else if (projectName.length > 55) {
            isValid = false;
            projectNameInput.addClass("is-invalid");
            projectNameError.text(
                "El nombre del proyecto no puede exceder 55 caracteres."
            );
            $("#project-name-error").show();
        } else if (projectName.length < 3) {
            isValid = false;
            projectNameInput.addClass("is-invalid");
            projectNameError.text(
                "El nombre del proyecto debe contener al menos 3 caracteres."
            );
            $("#project-name-error").show();
        } else if (!/^[a-zA-Z0-9\s]+$/.test(projectName)) {
            isValid = false;
            projectNameInput.addClass("is-invalid");
            projectNameError.text(
                "El nombre del proyecto solo puede contener letras, números y espacios."
            );
            $("#project-name-error").show();
        } else {
            projectNameInput.removeClass("is-invalid");
            projectNameInput.addClass("is-valid");
            $("#project-name-error").hide();
        }

        if (!startDate) {
            isValid = false;
            startDateInput.addClass("is-invalid");
            startDateError.text(
                "La fecha de inicio del proyecto es obligatoria."
            );
            $("#start-date-error").show();
        } else {
            var now = new Date();
            now.setDate(now.getDate() - 730);

            if (new Date(startDate) < now) {
                isValid = false;
                startDateInput.addClass("is-invalid");
                startDateError.text(
                    "La fecha de inicio del proyecto no puede ser anterior a 2 año desde la fecha actual."
                );
                $("#start-date-error").show();
            } else if (endDate && new Date(startDate) >= new Date(endDate)) {
                isValid = false;
                startDateInput.addClass("is-invalid");
                startDateError.text(
                    "La fecha de inicio del proyecto debe ser menor a la fecha de cierre del mismo."
                );
                $("#start-date-error").show();
            } else {
                startDateInput.removeClass("is-invalid");
                startDateInput.addClass("is-valid");
                $("#start-date-error").hide();
            }
        }

        if (!endDate) {
            isValid = false;
            endDateInput.addClass("is-invalid");
            endDateError.text(
                "La fecha de cierre del proyecto es obligatoria."
            );
            $("#end-date-error").show();
        } else if (startDate && endDate) {
            if (new Date(endDate) <= new Date(startDate)) {
                isValid = false;
                endDateInput.addClass("is-invalid");
                endDateError.text(
                    "La fecha de cierre del proyecto debe ser mayor a la fecha inicial del mismo."
                );
                $("#end-date-error").show();
            } else {
                endDateInput.removeClass("is-invalid");
                endDateInput.addClass("is-valid");
                $("#end-date-error").hide();
            }
        }

        if (!workDays) {
            isValid = false;
            workDaysInput.addClass("is-invalid");
            workDaysError.text("El total de días de trabajo es obligatorio.");
            $("#work-days-error").show();
        } else {
            var workDaysNumber = Number(workDays);
            if (isNaN(workDaysNumber) || workDaysNumber <= 0) {
                isValid = false;
                workDaysInput.addClass("is-invalid");
                workDaysError.text(
                    "El total de días de trabajo del proyecto no puede ser menor a 1."
                );
                $("#work-days-error").show();
            } else {
                workDaysInput.removeClass("is-invalid");
                workDaysInput.addClass("is-valid");
                $("#work-days-error").hide();
            }
        }

        return isValid;
    }

    // Validations to step 2
    function validateStep2(currentFieldset) {
        var isValid = true;

        // Validaciones del segundo paso
        var transferDate = currentFieldset.find("#transfer_date").val();
        var transferBank = currentFieldset.find("#transfer_bank").val();
        var transferAmount = currentFieldset.find("#transfer_amount").val();
        var transferComment = currentFieldset.find("#transfer_comment").val();

        var investorInput = currentFieldset.find("#investor_id");
        var transferDateInput = currentFieldset.find("#transfer_date");
        var transferBankInput = currentFieldset.find("#transfer_bank");
        var transferAmountInput = currentFieldset.find("#transfer_amount");
        var transferCommentInput = currentFieldset.find("#transfer_comment");

        var investorError = currentFieldset.find("#investor-id-error strong");
        var transferDateError = currentFieldset.find(
            "#transfer-date-error strong"
        );
        var transferBankError = currentFieldset.find(
            "#transfer-bank-error strong"
        );
        var transferAmountError = currentFieldset.find(
            "#transfer-amount-error strong"
        );
        var transferCommentError = currentFieldset.find(
            "#transfer-comment-error strong"
        );

        investorError.text("");
        transferDateError.text("");
        transferBankError.text("");
        transferAmountError.text("");
        transferCommentError.text("");

        // investor_id select
        var isValidInvestor = false;
        $("#investor_id option").each(function () {
            if ($(this).is(":selected") && $(this).val() !== "") {
                isValidInvestor = true;
            }
        });

        if (!isValidInvestor) {
            isValid = false;
            investorInput.addClass("is-invalid");
            investorError.text("Por favor, seleccione un inversionista.");
            $("#investor-id-error").show();
        } else {
            investorInput.removeClass("is-invalid");
            investorInput.addClass("is-valid");
            $("#investor-id-error").hide();
        }
        // ivestor_id: La razón del por qué es distinto a las demás validaciones es debido a que el select es nu búcle for each de investors

        if (!transferDate) {
            isValid = false;
            transferDateInput.addClass("is-invalid");
            transferDateError.text("La fecha de transferencia es obligatoria.");
            $("#transfer-date-error").show();
        } else {
            transferDateInput.removeClass("is-invalid");
            transferDateInput.addClass("is-valid");
            $("#transfer-date-error").hide();
        }

        if (!transferBank) {
            isValid = false;
            transferBankInput.addClass("is-invalid");
            transferBankError.text("El banco de transferencia es obligatorio.");
            $("#transfer-bank-error").show();
        } else if (transferBank.length < 6) {
            isValid = false;
            transferBankInput.addClass("is-invalid");
            transferBankError.text(
                "El banco de transferencia debe tener al menos 6 caracteres"
            );
            $("#transfer-bank-error").show();
        } else if (transferBank.length > 36) {
            isValid = false;
            transferBankInput.addClass("is-invalid");
            transferBankError.text(
                "El banco de transferencia no puede tener más de 36 caracteres."
            );
            $("#transfer-bank-error").show();
        } else if (!/^[^\d]+$/.test(transferBank)) {
            isValid = false;
            transferBankInput.addClass("is-invalid");
            transferBankError.text(
                "El banco de transferencia no puede contener números ni símbolos."
            );
            $("#transfer-bank-error").show();
        } else {
            transferBankInput.removeClass("is-invalid");
            transferBankInput.addClass("is-valid");
            $("#transfer-bank-error").hide();
        }

        if (!transferAmount) {
            isValid = false;
            transferAmountInput.addClass("is-invalid");
            transferAmountError.text(
                "El monto de transferencia es obligatorio."
            );
            $("#transfer-amount-error").show();
        } else {
            var transferAmountNumber = parseFloat(transferAmount);
            if (isNaN(transferAmountNumber) || transferAmountNumber <= 0) {
                isValid = false;
                transferAmountInput.addClass("is-invalid");
                transferAmountError.text(
                    "El monto de transferencia debe ser un número válido y mayor a 0."
                );
                $("#transfer-amount-error").show();
            } else {
                transferAmountInput.removeClass("is-invalid");
                transferAmountInput.addClass("is-valid");
                $("#transfer-amount-error").hide();
            }
        }

        if (!transferComment) {
            isValid = false;
            transferCommentInput.addClass("is-invalid");
            transferCommentError.text(
                "El comentario de la transferencia es obligatorio."
            );
            $("#transfer-comment-error").show();
        } else if (transferComment.length > 255) {
            isValid = false;
            transferCommentInput.addClass("is-invalid");
            transferCommentError.text(
                "El comentario no puede exceder 255 caracteres."
            );
            $("#transfer-comment-error").show();
        } else if (transferComment.length < 3) {
            isValid = false;
            transferCommentInput.addClass("is-invalid");
            transferCommentError.text(
                "El comentario debe contener al menos 3 caracteres."
            );
            $("#transfer-comment-error").show();
        } else {
            transferCommentInput.removeClass("is-invalid");
            transferCommentInput.addClass("is-valid");
            $("#transfer-comment-error").hide();
        }

        return isValid;
    }

    // Validations to step 3
    function validateStep3(currentFieldset) {
        var isValid = true;
    
        var investorInvestment = currentFieldset.find("#investor_investment").val();
        var investorInvestmentInput = currentFieldset.find("#investor_investment");
        var investorInvestmentError = currentFieldset.find("#investor-investment-error strong");
    
        var investorProfit = currentFieldset.find("#investor_profit").val();
        var investorProfitInput = currentFieldset.find("#investor_profit");
        var investorProfitError = currentFieldset.find("#investor-profit-error strong");
    
        var investorFinalProfit = currentFieldset.find("#investor_final_profit").val();
        var investorFinalProfitInput = currentFieldset.find("#investor_final_profit");
        var investorFinalProfitError = currentFieldset.find("#investor-final-profit-error strong");
    
        var commissionerCommissionJr = currentFieldset.find("#commissioner_commission_jr").val();
        var commissionerCommissionJrInput = currentFieldset.find("#commissioner_commission_jr");
        var commissionerCommissionJrError = currentFieldset.find("#commissioner-commission-jr-error strong");
    
        var commissionerCommissions = currentFieldset.find("input[name='commissioner_commission[]']").not("#commissioner_commission_jr");
        var commissionerCommissionsValid = true;
    
        investorInvestmentError.text("");
        investorProfitError.text("");
        investorFinalProfitError.text("");
        commissionerCommissionJrError.text("");
        commissionerCommissions.each(function() {
            $(this).next("span.invalid-feedback").find("strong").text("");
        });
    
        if (!investorInvestment) {
            isValid = false;
            investorInvestmentInput.addClass("is-invalid");
            investorInvestmentError.text("El capital de inversión es obligatorio.");
            $("#investor-investment-error").show();
        } else {
            var investorInvestmentAmountNumber = parseFloat(investorInvestment);
            if (isNaN(investorInvestmentAmountNumber) || investorInvestmentAmountNumber <= 0) {
                isValid = false;
                investorInvestmentInput.addClass("is-invalid");
                investorInvestmentError.text("El capital de inversión debe ser un número válido y mayor a 0.");
                $("#investor-investment-error").show();
            } else {
                investorInvestmentInput.removeClass("is-invalid");
                investorInvestmentInput.addClass("is-valid");
                $("#investor-investment-error").hide();
            }
        }
    
        if (!investorProfit) {
            isValid = false;
            investorProfitInput.addClass("is-invalid");
            investorProfitError.text("La ganancia total del proyecto es obligatoria.");
            $("#investor-profit-error").show();
        } else {
            investorProfitInput.removeClass("is-invalid");
            investorProfitInput.addClass("is-valid");
            $("#investor-profit-error").hide();
        }
    
        if (!investorFinalProfit) {
            isValid = false;
            investorFinalProfitInput.addClass("is-invalid");
            investorFinalProfitError.text("La ganancia final del inversionista es obligatoria.");
            $("#investor-final-profit-error").show();
        } else {
            var InvestorFinalProfitAmountNumber = parseFloat(investorFinalProfit);
            if (isNaN(InvestorFinalProfitAmountNumber) || InvestorFinalProfitAmountNumber <= 0) {
                isValid = false;
                investorFinalProfitInput.addClass("is-invalid");
                investorFinalProfitError.text("La ganancia final del proyecto debe ser un número válido y mayor a 0.");
                $("#investor-final-profit-error").show();
            } else {
                investorFinalProfitInput.removeClass("is-invalid");
                investorFinalProfitInput.addClass("is-valid");
                $("#investor-final-profit-error").hide();
            }
        }
    
        if (!commissionerCommissionJr) {
            isValid = false;
            commissionerCommissionJrInput.addClass("is-invalid");
            commissionerCommissionJrError.text("La comisión del comisionista Junior Ayala es obligatoria.");
            $("#commissioner-commission-jr-error").show();
        } else {
            var commissionerCommissionJrAmountNumber = parseFloat(commissionerCommissionJr);
            if (isNaN(commissionerCommissionJrAmountNumber) || commissionerCommissionJrAmountNumber <= 0) {
                isValid = false;
                commissionerCommissionJrInput.addClass("is-invalid");
                commissionerCommissionJrError.text("La comisión del comisionista debe ser mayor a 0.");
                $("#commissioner-commission-jr-error").show();
            } else {
                commissionerCommissionJrInput.removeClass("is-invalid");
                commissionerCommissionJrInput.addClass("is-valid");
                $("#commissioner-commission-jr-error").hide();
            }
        }
    
        commissionerCommissions.each(function() {
            var commissionerCommissionInput = $(this);
            var commissionerCommissionError = commissionerCommissionInput.next("span.invalid-feedback").find("strong");
            var commissionerCommission = commissionerCommissionInput.val();
    
            if (!commissionerCommission) {
                commissionerCommissionsValid = false;
                commissionerCommissionInput.addClass("is-invalid");
                commissionerCommissionError.text("La comisión del comisionista es obligatoria.");
                commissionerCommissionInput.next("span.invalid-feedback").show();
            } else {
                var commissionerCommissionAmountNumber = parseFloat(commissionerCommission);
                if (isNaN(commissionerCommissionAmountNumber) || commissionerCommissionAmountNumber <= 0) {
                    commissionerCommissionsValid = false;
                    commissionerCommissionInput.addClass("is-invalid");
                    commissionerCommissionError.text("La comisión del comisionista debe ser un número válido y mayor a 0.");
                    commissionerCommissionInput.next("span.invalid-feedback").show();
                } else {
                    commissionerCommissionInput.removeClass("is-invalid");
                    commissionerCommissionInput.addClass("is-valid");
                    commissionerCommissionInput.next("span.invalid-feedback").hide();
                }
            }
        });
    
        isValid = isValid && commissionerCommissionsValid;
    
        return isValid;
    }

    // Validations to step 4
    function validateStep4(currentFieldset) {
        var isValid = true;
    
        var projectComment = currentFieldset.find('#project_comment').val();
        var projectCommentInput = currentFieldset.find('#project_comment');
        var projectCommentError = currentFieldset.find('#project-comment-error strong');
    
        projectCommentError.text("");
        
        if (!projectComment) {
            isValid = false;
            projectCommentInput.addClass('is-invalid');
            projectCommentError.text("Los comentarios adicionales del proyecto son obligatorios.");
            $('#project-comment-error').show();
        } else if (projectComment.trim().length === 0) {
            isValid = false;
            projectCommentInput.addClass('is-invalid');
            projectCommentError.text("Los comentarios adicionales del proyecto no pueden contener solo espacios.");
            $('$project-comment-error').show();
        } else if (project_comment.length > 255) {
            isValid = false;
            projectCommentInput.addClass('is-invalid');
            projectCommentError.text("Los comentarios adicionales del proyecto no pueden exceder 255 caracteres.");
            $('$project-comment-error').show();
        } else if (project_comment.length < 3) {
            isValid = false;
            projectCommentInput.addClass('is-invalid');
            projectCommentError.text("Los comentarios adicionales del proyecto deben contener al menos 3 caracteres.");
            $('$project-comment-error').show();
        } else {
            projectCommentInput.removeClass('is-invalid');
            projectCommentInput.addClass('is-valid');
            $('$project-comment-error').hide();
        }

        // Llamar a checkCommentInput() para asegurar que el botón submit se actualice correctamente
        checkCommentInput();

        return isValid;
    }

    // Función para verificar la entrada en el campo de comentarios del proyecto
    $('#project_comment').on('input', function() {
        checkCommentInput();
    });

    function checkCommentInput() {
        var projectComment = $('#project_comment').val().trim();
        submitBtn.prop('disabled', projectComment.length == 0);
    }
});