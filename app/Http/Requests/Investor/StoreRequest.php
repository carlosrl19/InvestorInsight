<?php

namespace App\Http\Requests\Investor;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'investor_name' => 'required|string|min:3|max:55|regex:/^[^\d]+$/|unique:investors',
            'investor_company_name' => 'required|string|min:3|max:55|regex:/^[^\d]+$/',
            'investor_dni' => 'required|string|min:8|max:13|regex:/^[a-zA-Z0-9]+$/',
            'investor_phone' => 'required|string|min:8|max:11|regex:/^[0-9]+$/',
            'investor_reference_id' => 'numeric|exists:investors,id',
            'investor_balance' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'investor_status' => 'required|min:0|max:1',
        ];
    }

    public function messages()
    {
        return [
            // Investor name messages
            'investor_name.required' => 'El nombre del inversionista es obligatorio.',
            'investor_name.unique' => 'El nombre del inversionista ya existe.',
            'investor_name.string' => 'El nombre del inversionista solo debe contener letras.',
            'investor_name.regex' => 'El nombre del inversionista no puede contener números ni símbolos.',
            'investor_name.min' => 'El nombre del inversionista debe contener al menos 3 letras.',
            'investor_name.max' => 'El nombre del inversionista no puede exceder 55 letras.',

            // Company name messages
            'investor_company_name.required' => 'El nombre de la empresa afiliada es obligatorio.',
            'investor_company_name.string' => 'El nombre de la empresa afiliada solo debe contener letras.',
            'investor_company_name.regex' => 'El nombre de la empresa afiliada no puede contener números ni símbolos.',
            'investor_company_name.min' => 'El nombre de la empresa afiliada debe contener al menos 3 letras.',
            'investor_company_name.max' => 'El nombre de la empresa afiliada no puede exceder 55 letras.',

            // Investor dni messages
            'investor_dni.required' => 'El DNI del inversionista es obligatorio.',
            'investor_dni.unique' => 'El DNI del inversionista ya existe.',
            'investor_dni.string' => 'El DNI del inversionista solo debe contener números y letras.',
            'investor_dni.regex' => 'El DNI del inversionista no puede contener símbolos ni espacios.',
            'investor_dni.min' => 'El DNI del inversionista debe contener al menos 8 digitos.',
            'investor_dni.max' => 'El DNI del inversionista no puede exceder 13 digitos.',

            // Investor phone messages
            'investor_phone.required' => 'El número de teléfono del inversionista es obligatorio.',
            'investor_phone.string' => 'El número de teléfono del inversionista solo debe contener números.',
            'investor_phone.regex' => 'El número de teléfono del inversionista no puede contener letras ni símbolos.',
            'investor_phone.min' => 'El número de teléfono del inversionista debe contener al menos 8 digitos.',
            'investor_phone.max' => 'El número de teléfono del inversionista no puede exceder 11 digitos.',
            
            // Investor id messages
            'investor_reference_id.required' => 'El inversionista recomendante es obligatorio.',
            'investor_reference_id.numeric' => 'El id del inversionista recomendante solo debe contener números.',
            'investor_reference_id.exists' => 'El inversionista recomendante no existe en la base de datos.',

            // Investor balance messages
            //'investor_balance.required' => 'El saldo de la cuenta es obligatorio.',
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
