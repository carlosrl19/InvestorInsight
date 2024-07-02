<?php

namespace App\Http\Requests\InvestorLiquidations;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvestorLiquidationsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'investor_id' => 'numeric|exists:investors,id',
            'investor_liquidation_date' => 'required|date:Y-m-d H:i:s',
            'investor_liquidation_amount' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
        ];
    }

    public function messages()
    {
        return [            
            // Investor id messages
            'investor_id.required' => 'El inversionista a liquidar es obligatorio.',
            'investor_id.numeric' => 'El id del inversionista a liquidar solo debe contener números.',
            'investor_id.exists' => 'El inversionista a liquidar no existe en la base de datos.',

            // Investor change date
            'investor_liquidation_date.required' => 'La fecha de liquidación del inversionista es obligatoria.',
            'investor_liquidation_date.date' => 'El formato de fecha de liquidación del inversionista debe ser Y-m-d H:i:s.',

            // Investor old funds messages
            'investor_liquidation_amount.required' => 'El total a liquidar del inversionista es obligatorio.',
            'investor_liquidation_amount.numeric' => 'El total a liquidar del inversionista solo debe contener números.',
            'investor_liquidation_amount.regex' => 'El total a liquidar de la cuenta no puede contener letras ni símbolos.',
            'investor_liquidation_amount.min' => 'El total a liquidar de la cuenta debe ser mayor a 0.',
        ];
    }
}
