<?php

namespace App\Http\Requests\Transfer;

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
            'transfer_code' => 'required|string|min:3|max:35|regex:/^[a-zA-Z0-9]+$/|unique:transfer',
            'transfer_bank' => 'required|string|min:3|max:30|regex:/^[^\d]+$/',
            'investor_id' => 'required|numeric|exists:investors,id',
            'transfer_date' => 'required|date_format:Y-m-d\TH:i:s',
            'transfer_amount' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'transfer_description' => 'required|string|min:3|max:255',
        ];
    }

    public function messages()
    {
        return [
            // Transfer code messages
            'transfer_code.required' => 'El código de transferencia es obligatorio.',
            'transfer_code.unique' => 'El código de transferencia ya existe.',
            'transfer_code.string' => 'El código de transferencia solo debe contener letras y/o números.',
            'transfer_code.regex' => 'El código de transferencia no puede contener símbolos.',
            'transfer_code.min' => 'El código de transferencia debe contener al menos 3 letras.',
            'transfer_code.max' => 'El código de transferencia no puede exceder 35 letras.',

            // Transfer bank messages
            'transfer_bank.required' => 'El banco/modo utilizado es obligatorio.',
            'transfer_bank.string' => 'El banco/modo utilizado solo debe contener letras.',
            'transfer_bank.regex' => 'El banco/modo utilizado no puede contener números ni símbolos.',
            'transfer_bank.min' => 'El banco/modo utilizado debe contener al menos 13 digitos.',
            'transfer_bank.max' => 'El banco/modo utilizado no puede exceder 13 digitos.',

            // Investor id messages
            'investor_id.required' => 'El inversionista es obligatorio.',
            'investor_id.numeric' => 'El id del inversionista solo debe contener números.',
            'investor_id.exists' => 'El inversionista no existe en la base de datos.',

            // Transfer date messages
            'transfer_date.required' => 'La fecha de transferencia es obligatoria.',
            'transfer_date.date' => 'Debe ingresar un formato de fecha válido para la transferencia.',

            // Transfer amount messages
            'transfer_amount.numeric' => 'El monto de la transferencia solo debe contener números.',
            'transfer_amount.regex' => 'El monto de la transferencia no puede contener letras ni símbolos.',
            'transfer_amount.min' => 'El monto de la transferencia debe ser mayor a 0 lps.',

            // Transfer description messages
            'transfer_description.required' => 'Los comentarios de la transferencia es obligatoria.',
            'transfer_description.min' => 'Los comentarios de la transferencia debe contener al menos 3 letras.',
            'transfer_description.max' => 'Los comentarios de la transferencia no puede exceder 255 letras.',
            'transfer_description.string' => 'Los comentarios de la transferencia solo debe contener letras, números y/o símbolos.',
        ];
    }
}