<?php

namespace App\Http\Requests\ProviderFunds;

use Illuminate\Foundation\Http\FormRequest;

class StoreProviderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'provider_id' => 'numeric|exists:providers,id',
            'provider_change_date' => 'required|date:Y-m-d H:i:s',
            'provider_old_funds' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'provider_new_funds' => 'required|numeric|',
            'provider_new_funds_comment' => 'required|string|min:3|max:255',
            'provider_balance' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
        ];
    }

    public function messages()
    {
        return [            
            // Investor id messages
            'investor_id.required' => 'El inversionista del fondo es obligatorio.',
            'investor_id.numeric' => 'El id del inversionista del fondo solo debe contener números.',
            'investor_id.exists' => 'El inversionista del fondo no existe en la base de datos.',

            // Investor change date
            'investor_change_date.required' => 'La fecha del cambio en el fondo del inversionista es obligatoria.',
            'investor_change_date.date' => 'El formato de fecha del cambio en el fondo del inversionista debe ser Y-m-d H:i:s.',

            // Investor old funds messages
            'investor_old_funds.required' => 'El fondo actual del inversionista es obligatorio.',
            'investor_old_funds.numeric' => 'El fondo actual del inversionista solo debe contener números.',
            'investor_old_funds.regex' => 'El fondo actual de la cuenta no puede contener letras ni símbolos.',
            'investor_old_funds.min' => 'El fondo actual de la cuenta debe ser mayor a 0.',

            // Investor new funds comment messages
            'investor_new_funds_comment.required' => 'Los comentarios del nuevo fondo del inversionista son obligatorios.',
            'investor_new_funds_comment.string' => 'Los comentarios del nuevo fondo del inversionista solo deben contener letras, números y/o símbolos.',
            'investor_new_funds_comment.min' => 'Los comentarios del nuevo fondo del inversionista deben tener al menos 3 caracteres.',
            'investor_new_funds_comment.max' => 'Los comentarios del nuevo fondo del inversionista no pueden tener más de 255 caracteres.',

            // Investor new funds messages
            'investor_new_funds.numeric' => 'El nuevo fondo del inversionista solo debe contener números.',
            'investor_new_funds.regex' => 'El nuevo fondo del inversionista no puede contener letras ni símbolos.',
            'investor_new_funds.min' => 'El nuevo fondo del inversioinsta debe ser mayor a 0.',
        ];
    }
}
