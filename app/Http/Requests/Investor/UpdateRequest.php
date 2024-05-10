<?php

namespace App\Http\Requests\Investor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        $investorId = $this->route("investor")->id;

        return [
            'investor_name' => 'required|string|min:3|max:55|regex:/^[^\d]+$/|unique:investors,investor_name,' . $investorId . '',
            'investor_dni' => 'required|string|min:13|max:13|regex:/^[0-9]+$/|unique:investors,investor_dni,' . $investorId . '',
            'investor_phone' => 'required|string|min:8|max:8|regex:/^[0-9]+$/|unique:investors,investor_phone,' . $investorId . '',
            'investor_reference' => 'string|min:3|max:55|regex:/^[^\d]+$/',
            'investor_balance' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'investor_status' => 'required|min:0|max:1',
        ];
    }

    public function messages()
    {
        return [
            // Investor name messages
            'investor_name.required' => 'El nombre es obligatorio.',
            'investor_name.unique' => 'El nombre ya existe.',
            'investor_name.string' => 'El nombre solo debe contener letras.',
            'investor_name.regex' => 'El nombre no puede contener números ni símbolos.',
            'investor_name.min' => 'El nombre debe contener al menos 3 letras.',
            'investor_name.max' => 'El nombre no puede exceder 55 letras.',

            // Investor dni messages
            'investor_dni.required' => 'El DNI es obligatorio.',
            'investor_dni.unique' => 'El DNI ya existe.',
            'investor_dni.string' => 'El DNI solo debe contener números.',
            'investor_dni.regex' => 'El DNI no puede contener letras ni símbolos.',
            'investor_dni.min' => 'El DNI debe contener al menos 13 digitos.',
            'investor_dni.max' => 'El DNI no puede exceder 13 digitos.',

            // Investor phone messages
            'investor_phone.required' => 'El número de teléfono es obligatorio.',
            'investor_phone.unique' => 'El número de teléfono ya existe.',
            'investor_phone.string' => 'El número de teléfono solo debe contener números.',
            'investor_phone.regex' => 'El número de teléfono no puede contener letras ni símbolos.',
            'investor_phone.min' => 'El número de teléfono debe contener al menos 8 digitos.',
            'investor_phone.max' => 'El número de teléfono no puede exceder 8 digitos.',

            // Investor name messages
            'investor_reference.string' => 'El recomendante solo debe contener letras.',
            'investor_reference.regex' => 'El recomendante no puede contener números ni símbolos.',
            'investor_reference.min' => 'El recomendante debe contener al menos 3 letras.',
            'investor_reference.max' => 'El recomendante no puede exceder 55 letras.',

            // Investor balance messages
            'investor_balance.required' => 'El saldo de la cuenta es obligatorio.',
            'investor_balance.numeric' => 'El saldo de la cuenta solo debe contener números.',
            'investor_balance.regex' => 'El saldo de la cuenta no puede contener letras ni símbolos.',
            'investor_balance.min' => 'El saldo de la cuenta debe ser mayor o igual a 0.',

            // Investor status messages
            'investor_status.required' => 'El estado de disponibilidad del inversionista es obligatorio.',
            'investor_status.min' => 'El estado de disponibilidad del inversionista debe ser "1" para Disponible',
            'investor_status.max' => 'El estado de disponibilidad del inversionista debe ser "0" para No disponible',
        ];
    }
}
