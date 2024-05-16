<?php

namespace App\Http\Requests\CreditNote;

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
            'investor_id' => 'required|numeric|exists:investors,id',
            'creditNote_date' => 'required|date_format:Y-m-d\TH:i:s',
            'creditNote_amount' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'creditNote_code' => 'required|string|min:16|max:16|regex:/^[a-zA-Z0-9]+$/|unique:credit_notes,creditNote_code',
            'creditNote_description' => 'required|string|min:3|max:255',
        ];
    }

    public function messages()
    {
        return [
            // Transfer code messages
            'creditNote_code.required' => 'El código de la nota de crédito es obligatorio.',
            'creditNote_code.unique' => 'El código de la nota de crédito ya existe.',
            'creditNote_code.string' => 'El código de la nota de crédito solo debe contener letras y/o números.',
            'creditNote_code.regex' => 'El código de la nota de crédito no puede contener símbolos.',
            'creditNote_code.min' => 'El código de la nota de crédito debe contener al menos 16 letras.',
            'creditNote_code.max' => 'El código de la nota de crédito no puede exceder 16 letras.',

            // Investor id messages
            'investor_id.required' => 'El inversionista es obligatorio.',
            'investor_id.numeric' => 'El id del inversionista solo debe contener números.',
            'investor_id.exists' => 'El inversionista no existe en la base de datos.',

            // Credit note date messages
            'creditNote_date.required' => 'La fecha de la nota crédito es obligatoria.',
            'creditNote_date.date' => 'Debe ingresar un formato de fecha válido para la nota crédito.',

            // Credit note name messages
            'creditNote_amount.required' => 'EL monto de la nota crédito es obligatoria.',
            'creditNote_amount.numeric' => 'El monto de la nota crédito solo debe contener números.',
            'creditNote_amount.regex' => 'El monto de la nota crédito no puede contener letras ni símbolos.',
            'creditNote_amount.min' => 'El monto de la nota crédito debe ser mayor a 0 lps.',

            // Credit note status messages
            'creditNote_description.required' => 'Los comentarios de la nota crédito es obligatoria.',
            'creditNote_description.min' => 'Los comentarios de la nota crédito debe contener al menos 3 letras.',
            'creditNote_description.max' => 'Los comentarios de la nota crédito no puede exceder 255 letras.',
            'creditNote_description.string' => 'Los comentarios de la nota crédito solo debe contener letras, números y/o símbolos.',
        ];
    }
}
