<?php

namespace App\Http\Requests\CommissionAgent;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $commissionerId = $this->route("commission_agent")->id;

        return [
            'commissioner_name' => 'required|string|min:3|max:55|regex:/^[^\d]+$/|unique:commission_agents,commissioner_name,' . $commissionerId . '',
            'commissioner_dni' => 'required|string|min:13|max:13|regex:/^[0-9]+$/|unique:commission_agents,commissioner_dni,' . $commissionerId . '',
            'commissioner_phone' => 'required|string|min:8|max:8|regex:/^[0-9]+$/|unique:commission_agents,commissioner_phone,' . $commissionerId . '',
            'investor_balance' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
        ];
    }

    public function messages()
    {
        return [
            // Commissioner agent name messages
            'commissioner_name.required' => 'El nombre es obligatorio.',
            'commissioner_name.unique' => 'El nombre ya existe.',
            'commissioner_name.string' => 'El nombre solo debe contener letras.',
            'commissioner_name.regex' => 'El nombre del comisionista no puede contener números ni símbolos.',
            'commissioner_name.min' => 'El nombre del comisionista debe contener al menos 3 letras.',
            'commissioner_name.max' => 'El nombre del comisionista no puede exceder 55 letras.',

            // Commissioner agent dni messages
            'commissioner_dni.required' => 'El DNI del comisionista es obligatorio.',
            'commissioner_dni.unique' => 'El DNI del comisionista ya existe.',
            'commissioner_dni.string' => 'El DNI del comisionista solo debe contener números.',
            'commissioner_dni.regex' => 'El DNI del comisionista no puede contener letras ni símbolos.',
            'commissioner_dni.min' => 'El DNI del comisionista debe contener al menos 13 digitos.',
            'commissioner_dni.max' => 'El DNI del comisionista no puede exceder 13 digitos.',

            // Commissioner agent phone messages
            'commissioner_phone.required' => 'El número de teléfono del comisionista es obligatorio.',
            'commissioner_phone.unique' => 'El número de teléfono del comisionista ya existe.',
            'commissioner_phone.string' => 'El número de teléfono del comisionista solo debe contener números.',
            'commissioner_phone.regex' => 'El número de teléfono del comisionista no puede contener letras ni símbolos.',
            'commissioner_phone.min' => 'El número de teléfono del comisionista debe contener al menos 8 digitos.',
            'commissioner_phone.max' => 'El número de teléfono del comisionista no puede exceder 8 digitos.',

            // commissioner balance messages
            'commissioner_balance.required' => 'El saldo de la cuenta del comisionista es obligatorio.',
            'commissioner_balance.numeric' => 'El saldo de la cuenta del comisionista solo debe contener números.',
            'commissioner_balance.regex' => 'El saldo de la cuenta del comisionista no puede contener letras ni símbolos.',
            'commissioner_balance.min' => 'El saldo de la cuenta del comisionista debe ser mayor o igual a 0.',
        ];
    }
}
