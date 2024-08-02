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
            'moneylender_id' => 'numeric|exists:moneylenders,id',
            'investor_id' => 'numeric|exists:investors,id',
            'loan_invoice_code' => 'required|string|min:12|max:12|regex:/^[a-zA-Z0-9]+$/|unique:moneylender_loans,loan_invoice_code',
            'loan_amount' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'loan_date' => 'required|date:Y-m-d',
            'loan_paydate' => 'required|date:Y-m-d',
        ];
    }

    public function messages()
    {
        return [
            // Moneylender id messages
            'moneylender_id.required' => 'El prestamista es obligatorio.',
            'moneylender_id.numeric' => 'El id del prestamista del fondo solo debe contener números.',
            'moneylender_id.exists' => 'El prestamista seleccionado no existe en la base de datos.',
            
            // Investor id messages
            'investor_id.required' => 'El inversionista es obligatorio.',
            'investor_id.numeric' => 'El id del inversionista del fondo solo debe contener números.',
            'investor_id.exists' => 'El inversionista seleccionado no existe en la base de datos.',

            // Loan invoice code messages
            'loan_invoice_code.required' => 'El código del préstamo es obligatorio.',
            'loan_invoice_code.unique' => 'El código del préstamo ya existe.',
            'loan_invoice_code.string' => 'El código del préstamo solo debe contener letras y/o números.',
            'loan_invoice_code.regex' => 'El código del préstamo no puede contener símbolos.',
            'loan_invoice_code.min' => 'El código del préstamo debe contener al menos 12 letras.',
            'loan_invoice_code.max' => 'El código del préstamo no puede exceder 12 letras.',

            // Loan amount messages
            'loan_amount.required' => 'El monto del préstamo es obligatorio.',
            'loan_amount.numeric' => 'El monto del préstamo solo debe contener números.',
            'loan_amount.regex' => 'El monto del préstamo no puede contener letras ni símbolos.',
            'loan_amount.min' => 'El monto del préstamo debe ser mayor a 0 lps.',
            
            // Loan date
            'loan_date.required' => 'La fecha de emisión del préstamo es obligatoria.',
            'loan_date.date' => 'El formato de fecha de emisión del préstamo debe ser Y-m-d.',
              
            // Loan date
            'loan_paydate.required' => 'La fecha de pago del préstamo es obligatoria.',
            'loan_paydate.date' => 'El formato de fecha de pago del préstamo debe ser Y-m-d.',
        ];
    }
}
