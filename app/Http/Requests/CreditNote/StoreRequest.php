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
            'creditNote_description' => 'required|string|min:3|max:255',
        ];
    }

    public function messages()
    {
        return [
            // Investor id messages
            'investor_id.required' => 'El inversionista es obligatorio.',
            'investor_id.numeric' => 'El id del inversionista solo debe contener números.',
            'investor_id.exists' => 'El inversionista no existe en la base de datos.',

            // Credit note date messages
            'creditNote_date.required' => 'La fecha de la nota crédito es obligatoria.',
            'creditNote_date.date' => 'Debe ingresar un formato de fecha válido para la nota crédito.',

            // Credit note name messages
            'transfer_amount.numeric' => 'El monto de la transferencia solo debe contener números.',
            'transfer_amount.regex' => 'El monto de la transferencia no puede contener letras ni símbolos.',
            'transfer_amount.min' => 'El monto de la transferencia debe ser mayor a 0 lps.',

            // Credit note status messages
            'creditNote_description.required' => 'Los comentarios de la transferencia es obligatoria.',
            'creditNote_description.min' => 'Los comentarios de la transferencia debe contener al menos 3 letras.',
            'creditNote_description.max' => 'Los comentarios de la transferencia no puede exceder 255 letras.',
            'creditNote_description.string' => 'Los comentarios de la transferencia solo debe contener letras, números y/o símbolos.',
        ];
    }
}
