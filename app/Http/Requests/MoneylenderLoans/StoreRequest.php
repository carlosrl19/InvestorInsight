<?php

namespace App\Http\Requests\MoneylenderLoans;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'loan_code' => 'required|string|min:12|max:12|regex:/^[a-zA-Z0-9]+$/|unique:moneylender_loans,loan_code',
            'moneylender_id' => 'required|numeric|exists:moneylenders,id',
            'commissioner_id' => 'required|numeric|exists:commission_agents,id',
            'loan_emission_date' => 'required|date:Y-m-d|date_equals:today',
            'loan_first_paydate' => 'required|date:Y-m-d|after:loan_emission_date',
            'loan_amount' => 'required|numeric|min:1|regex:/^\d+(\.\d{1,2})?$/',
            'loan_tax' => 'required|integer|min:1|max:100',
            'loan_quotas' => 'required|integer|min:1',
            'loan_quota_amount' => 'required|numeric|min:1|regex:/^\d+(\.\d{1,2})?$/',
            'loan_total_amount' => 'required|numeric|min:1|regex:/^\d+(\.\d{1,2})?$/',
            'loan_description' => 'required|string|min:3|max:255',
        ];
    }

    public function messages()
    {
        return [
            // Loan code messages
            'loan_code.required' => 'El código del préstamo es obligatorio.',
            'loan_code.unique' => 'El código del préstamo ya existe.',
            'loan_code.string' => 'El código del préstamo solo debe contener letras y/o números.',
            'loan_code.regex' => 'El código del préstamo no puede contener símbolos.',
            'loan_code.min' => 'El código del préstamo debe contener al menos 12 letras.',
            'loan_code.max' => 'El código del préstamo no puede exceder 12 letras.',

            // Moneylender id messages
            'moneylender_id.required' => 'El prestamista es obligatorio.',
            'moneylender_id.numeric' => 'El id del prestamista solo debe contener números.',
            'moneylender_id.exists' => 'El prestamista no existe en la base de datos.',

            // Commissioner id messages
            'commissioner_id.required' => 'El prestatario es obligatorio.',
            'commissioner_id.numeric' => 'El id del prestatario solo debe contener números.',
            'commissioner_id.exists' => 'El prestatario no existe en la base de datos.',

            // Loan emission date messages
            'loan_emission_date.required' => 'La fecha de emisión del préstamo es obligatoria.',
            'loan_emission_date.date' => 'Debe ingresar un formato de fecha válido para el préstamo (Y-m-d).',
            'loan_emission_date.date_equals' => 'La fecha de emisión del préstamo debe ser la fecha actual.',

            // Loan emission date messages
            'loan_first_paydate.required' => 'La fecha que se hará el primer pago al préstamo es obligatoria.',
            'loan_first_paydate.date' => 'Debe ingresar un formato de fecha válido para el primer pago al préstamo (Y-m-d).',
            'loan_first_paydate.after' => 'La fecha para el primer pago al préstamo debe ser mayor a la fecha de emisión.',

            // Loan amount messages
            'loan_amount.required' => 'El monto del préstamo es obligatorio.',
            'loan_amount.numeric' => 'El monto del préstamo solo debe contener números.',
            'loan_amount.regex' => 'El monto del préstamo no puede contener letras ni símbolos.',
            'loan_amount.min' => 'El monto del préstamo debe ser mayor a 0 lps.',

            // Loan tax messages
            'loan_tax.required' => 'El valor del interés del préstamo es obligatorio.',
            'loan_tax.integer' => 'El valor del interés del préstamo no debe contener decimales.',
            'loan_tax.min' => 'El valor del interés del préstamo debe ser mayor a 0%.',
            'loan_tax.max' => 'El valor del interés del préstamo debe ser menor a 100%.',

            // Loan tax messages
            'loan_quotas.required' => 'El número de cuotas a pagar es obligatorio.',
            'loan_quotas.integer' => 'El número de cuotas a pagar no debe contener decimales.',
            'loan_quotas.min' => 'El número de cuotas del préstamo debe ser mayor a 0.',

            // Loan amount messages
            'loan_quota_amount.required' => 'El monto a pagar por cuota es obligatorio.',
            'loan_quota_amount.numeric' => 'El monto a pagar por cuota solo debe contener números.',
            'loan_quota_amount.regex' => 'El monto a pagar por cuota no puede contener letras ni símbolos.',
            'loan_quota_amount.min' => 'El monto a pagar por cuota debe ser mayor a 0 lps.',

            // Loan amount messages
            'loan_total_amount.required' => 'El monto final a pagar es obligatorio.',
            'loan_total_amount.numeric' => 'El monto final a pagar solo debe contener números.',
            'loan_total_amount.regex' => 'El monto final a pagar no puede contener letras ni símbolos.',
            'loan_total_amount.min' => 'El monto final a pagar debe ser mayor a 0 lps.',

            // Loan description messages
            'loan_description.required' => 'La descripción del préstamo es obligatoria.',
            'loan_description.min' => 'La descripción del préstamo debe contener al menos 3 letras.',
            'loan_description.max' => 'La descripción del préstamo no puede exceder 255 letras.',
            'loan_description.string' => 'La descripción del préstamo solo debe contener letras, números y/o símbolos.',
        ];
    }

    // Custom Laravel validation rules
    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $loanAmount = $this->input('loan_amount');
            $loanTax = $this->input('loan_tax');
            $loanTotalAmount = $this->input('loan_total_amount');

            // Calcular el total esperado
            $expectedTotal = $loanAmount * ($loanTax / 100) + $loanAmount;

            // Validar si el total ingresado es correcto
            if ($loanTotalAmount != $expectedTotal) {
                $validator->errors()->add('loan_total_amount', 'El monto total a pagar debe ser igual a ' . number_format($expectedTotal, 2) . '.');
            }
        });
    }
}
