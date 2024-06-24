<?php

namespace App\Http\Requests\InvestorFunds;

use Illuminate\Foundation\Http\FormRequest;

class StoreInverstorFundsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'investor_id' => 'numeric|exists:investors,id',
            'investor_old_funds' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'investor_new_funds' => 'required|numeric|gte:investor_old_funds',
            'investor_new_funds_comment' => 'required|string|min:3|max:255',
            'investor_balance' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
        ];
    }

    public function messages()
    {
        return [            
            // Investor id messages
            'investor_id.required' => 'El inversionista del fondo es obligatorio.',
            'investor_id.numeric' => 'El id del inversionista del fondo solo debe contener números.',
            'investor_id.exists' => 'El inversionista del fondo no existe en la base de datos.',

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
            'investor_new_funds.regex' => 'El nuevo fondo del inversionista no puede contener letras ni sím0bolos.',
            'investor_new_funds.min' => 'El nuevo fondo del inversioinsta debe ser mayor a 0.',
            'investor_new_funds.gte' => 'El nuevo fondo del inversionista debe ser mayor o igual al fondo actual.',
        ];
    }
}
