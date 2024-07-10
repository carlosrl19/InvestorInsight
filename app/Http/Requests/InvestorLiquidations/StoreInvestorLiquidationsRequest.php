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
            'liquidation_code' => 'required|string|min:12|max:12|regex:/^[a-zA-Z0-9]+$/|unique:investor_liquidations,liquidation_code',
            'liquidation_payment_amount' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'liquidation_payment_mode' => 'required|string|min:3|max:55|regex:/^[a-zA-Z0-9\s\/áéíóúÁÉÍÓÚ]+$/',
            'liquidation_payment_comment' => 'required|string|min:3|max:255',
            'liquidation_payment_imgs' => 'required'
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
            
            // Liquidation code messages
            'liquidation_code.required' => 'El código de liquidación es obligatorio.',
            'liquidation_code.unique' => 'El código de liquidación ya existe.',
            'liquidation_code.string' => 'El código de liquidación solo debe contener letras y/o números.',
            'liquidation_code.regex' => 'El código de liquidación no puede contener símbolos.',
            'liquidation_code.min' => 'El código de liquidación debe contener al menos 12 letras.',
            'liquidation_code.max' => 'El código de liquidación no puede exceder 12 letras.',

            // Investor old funds messages
            'liquidation_payment_amount.required' => 'El monto de liquidación es obligatorio.',
            'liquidation_payment_amount.numeric' => 'El monto de liquidación solo debe contener números.',
            'liquidation_payment_amount.regex' => 'El monto de liquidación no puede contener letras ni símbolos.',
            'liquidation_payment_amount.min' => 'El monto de liquidación debe ser igual que el total del fondo del inversionista',

            // Credit note code messages
            'liquidation_payment_mode.required' => 'El método de pago utilizado para la liquidación es obligatorio.',
            'liquidation_payment_mode.string' => 'El método de pago utilizado para la liquidación solo debe contener letras y/o números.',
            'liquidation_payment_mode.regex' => 'El método de pago utilizado para la liquidación no puede contener símbolos.',
            'liquidation_payment_mode.min' => 'El método de pago utilizado para la liquidación debe contener al menos 3 letras.',
            'liquidation_payment_mode.max' => 'El método de pago utilizado para la liquidación no puede exceder 55 letras.',

            // Liquidation payment comment messages
            'liquidation_payment_comment.required' => 'Los comentarios de la liquidación son obligatorios.',
            'liquidation_payment_comment.string' => 'Los comentarios de la liquidación solo deben contener letras, números y/o símbolos.',
            'liquidation_payment_comment.min' => 'Los comentarios de la liquidación debe tener al menos 3 caracteres.',
            'liquidation_payment_comment.max' => 'Los comentarios de la liquidación no puede tener más de 255 caracteres.',

            // Liquidation payment imgs messages
            'liquidation_payment_imgs.required' => 'Los comprobantes de pago de la liquidación son obligatorios.',
        ];
    }
}
