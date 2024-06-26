<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        $promissoryId = $this->route('payments_investor');

        return [
            'payment_code' => 'required|string|min:12|max:12|regex:/^[a-zA-Z0-9]+$/|unique:payment_investors,payment_code,' . $promissoryId . '',
            'payment_amount' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'payment_date' => 'required|date:Y-m-d H:i:s',
            'promissoryNoteInvestor_id' => 'required|numeric|exists:promissory_notes,id',
        ];
    }

    public function messages()
    {
        return [
            // Promissory note date messages
            'promissoryNote_final_date.required' => 'La fecha de pago del pagaré es obligatoria.',
            'promissoryNote_final_date.date' => 'Debe ingresar un formato de fecha válido para el pagaré.',

            // Promissory note date messages
            'promissoryNote_emission_date.required' => 'La fecha de emisión del pagaré es obligatoria.',
            'promissoryNote_emission_date.date' => 'Debe ingresar un formato de fecha válido para la fecha de emisión del pagaré.',

            // Promissory note name messages
            'payment_amount.required' => 'EL monto del pago es obligatoria.',
            'payment_amount.numeric' => 'El monto del pago solo debe contener números.',
            'payment_amount.regex' => 'El monto del pago no puede contener letras ni símbolos.',
            'payment_amount.min' => 'El monto del pago debe ser mayor a 0 lps.',

            // Promissory note code messages
            'payment_code.required' => 'El código del pago es obligatorio.',
            'payment_code.unique' => 'El código del pago ya existe.',
            'payment_code.string' => 'El código del pago solo debe contener letras y/o números.',
            'payment_code.regex' => 'El código del pago no puede contener símbolos.',
            'payment_code.min' => 'El código del pago debe contener al menos 12 letras.',
            'payment_code.max' => 'El código del pago no puede exceder 12 letras.',

            // Investor id messages
            'promissoryNoteInvestor_id.required' => 'El pagaré a pagar es obligatorio.',
            'promissoryNoteInvestor_id.numeric' => 'El id del pagaré seleccionado solo debe contener números.',
            'promissoryNoteInvestor_id.exists' => 'El pagaré seleccionado no existe en la base de datos.',
        ];
    }
}
