<?php

namespace App\Http\Requests\PromissoryNote;

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
            'promissoryNote_final_date' => 'required|date_format:Y-m-d',
            'promissoryNote_emission_date' => 'required|date_format:Y-m-d',
            'promissoryNote_amount' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'promissoryNote_code' => 'required|string|min:16|max:16|regex:/^[a-zA-Z0-9]+$/|unique:promissory_notes,promissoryNote_code',
        ];
    }

    public function messages()
    {
        return [
            // Investor id messages
            'investor_id.required' => 'El inversionista es obligatorio.',
            'investor_id.numeric' => 'El id del inversionista solo debe contener números.',
            'investor_id.exists' => 'El inversionista no existe en la base de datos.',

            // Promissory note date messages
            'promissoryNote_final_date.required' => 'La fecha de pago del pagaré es obligatoria.',
            'promissoryNote_final_date.date' => 'Debe ingresar un formato de fecha válido para el pagaré.',

            // Promissory note date messages
            'promissoryNote_emission_date.required' => 'La fecha de emisión del pagaré es obligatoria.',
            'promissoryNote_emission_date.date' => 'Debe ingresar un formato de fecha válido para la fecha de emisión del pagaré.',

            // Promissory note name messages
            'promissoryNote_amount.required' => 'EL monto del pagaré es obligatoria.',
            'promissoryNote_amount.numeric' => 'El monto del pagaré solo debe contener números.',
            'promissoryNote_amount.regex' => 'El monto del pagaré no puede contener letras ni símbolos.',
            'promissoryNote_amount.min' => 'El monto del pagaré debe ser mayor a 0 lps.',
        ];
    }
}
