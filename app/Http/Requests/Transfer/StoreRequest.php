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
            'investor_id' => 'required|numeric|exists:investors,id',
            'transfer_code' => 'required|string|min:12|max:12|regex:/^[a-zA-Z0-9]+$/|unique:transfers,transfer_code',
            'transfer_img' => 'image|max:2048',
            'transfer_bank' => 'required|string|min:6|max:36|regex:/^[^\d]+$/',
            'transfer_date' => 'required|date_format:Y-m-d\TH:i:s',
            'transfer_amount' => 'required|numeric|min:1|regex:/^\d+(\.\d{1,2})?$/',
            'transfer_comment' => 'required|string|min:3|max:255',
        ];
    }

    public function messages()
    {
        return [
            // Investor id messages
            'investor_id.required' => 'El inversionista es obligatorio.',
            'investor_id.numeric' => 'El id del inversionista solo debe contener números.',
            'investor_id.exists' => 'El inversionista no existe en la base de datos.',
            
            // Transfer code messages
            'transfer_code.required' => 'El código de transferencia es obligatorio.',
            'transfer_code.string' => 'El código de transferencia solo debe contener letras.',
            'transfer_code.min' => 'El código de transferencia debe tener 12 caracteres.',
            'transfer_code.max' => 'El código de transferencia debe tener 12 caracteres.',
            'transfer_code.regex' => 'El código de transferencia solo puede contener letras y números.',
            'transfer_code.unique' => 'El código de transferencia ya existe.',
            
            // Transfer img messages
            'transfer_img.image' => 'El comprobante de pago de transferencia debe ser una imagen válida.',
            'transfer_img.max' => 'El comprobante de pago de transferencia no debe exceder los 2 MB.',

            // Transfer bank messages
            'transfer_bank.required' => 'El banco de transferencia es obligatorio.',
            'transfer_bank.string' => 'El banco de transferencia solo debe contener letras.',
            'transfer_bank.min' => 'El banco de transferencia debe tener al menos 6 caracteres.',
            'transfer_bank.max' => 'El banco de transferencia no puede tener más de 36 caracteres.',
            'transfer_bank.regex' => 'El banco de transferencia no puede contener números.',
            
            // Transfer date messages
            'transfer_date.required' => 'La fecha de transferencia es obligatoria.',
            'transfer_date.date_format' => 'La fecha de transferencia debe tener el formato Y-m-d\TH:i:s.',
            
            // Transfer amount messages
            'transfer_amount.required' => 'El monto de transferencia es obligatorio.',
            'transfer_amount.numeric' => 'El monto de transferencia debe ser un número.',
            'transfer_amount.min' => 'El monto de transferencia debe ser igual o mayor a 1',
            'transfer_amount.regex' => 'El monto de transferencia debe tener máximo hasta dos decimales.',
            
            // Transfer description messages
            'transfer_comment.required' => 'Los comentarios de la transferencia son obligatorios.',
            'transfer_comment.string' => 'Los comentarios de la transferencia solo deben contener letras, números y/o símbolos.',
            'transfer_comment.min' => 'Los comentarios de la transferencia debe tener al menos 3 caracteres.',
            'transfer_comment.max' => 'Los comentarios de la transferencia no puede tener más de 255 caracteres.',
        ];
    }
}
