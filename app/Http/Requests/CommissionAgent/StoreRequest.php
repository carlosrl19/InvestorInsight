<?php

namespace App\Http\Requests\CommissionAgent;

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
            'commissioner_name' => 'required|string|min:3|max:55|regex:/^[^\d]+$/|unique:commission_agents',
            'commissioner_dni' => 'required|string|min:13|max:13|regex:/^[0-9]+$/|unique:commission_agents',
            'commissioner_phone' => 'required|string|min:8|max:8|regex:/^[0-9]+$/|unique:commission_agents',
            'commissioner_reference' => 'string|min:3|max:55|regex:/^[^\d]+$/',
        ];
    }

    public function messages()
    {
        return [
            // Commissioner agent name messages
            'commissioner_name.required' => 'El nombre es obligatorio.',
            'commissioner_name.unique' => 'El nombre ya existe.',
            'commissioner_name.string' => 'El nombre solo debe contener letras.',
            'commissioner_name.regex' => 'El nombre no puede contener números ni símbolos.',
            'commissioner_name.min' => 'El nombre debe contener al menos 3 letras.',
            'commissioner_name.max' => 'El nombre no puede exceder 55 letras.',

            // Commissioner agent dni messages
            'commissioner_dni.required' => 'El DNI es obligatorio.',
            'commissioner_dni.unique' => 'El DNI ya existe.',
            'commissioner_dni.string' => 'El DNI solo debe contener números.',
            'commissioner_dni.regex' => 'El DNI no puede contener letras ni símbolos.',
            'commissioner_dni.min' => 'El DNI debe contener al menos 13 digitos.',
            'commissioner_dni.max' => 'El DNI no puede exceder 13 digitos.',

            // Commissioner agent phone messages
            'commissioner_phone.required' => 'El número de teléfono es obligatorio.',
            'commissioner_phone.unique' => 'El número de teléfono ya existe.',
            'commissioner_phone.string' => 'El número de teléfono solo debe contener números.',
            'commissioner_phone.regex' => 'El número de teléfono no puede contener letras ni símbolos.',
            'commissioner_phone.min' => 'El número de teléfono debe contener al menos 8 digitos.',
            'commissioner_phone.max' => 'El número de teléfono no puede exceder 8 digitos.',

            // Commissioner agent name messages
            'commissioner_reference.string' => 'El recomendante solo debe contener letras.',
            'commissioner_reference.regex' => 'El recomendante no puede contener números ni símbolos.',
            'commissioner_reference.min' => 'El recomendante debe contener al menos 3 letras.',
            'commissioner_reference.max' => 'El recomendante no puede exceder 55 letras.',
        ];
    }
}
