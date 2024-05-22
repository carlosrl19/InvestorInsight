<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // Project rules
            'project_name' => 'required|string|min:3|max:55|regex:/^[^\d]+$/|unique:projects,project_name',
            'project_code' => 'required|string|min:12|max:12|regex:/^[a-zA-Z0-9]+$/|unique:projects,project_code',
            'project_start_date' => 'required|date_format:Y-m-d',
            'project_end_date' => 'required|date_format:Y-m-d',
            'project_investment' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'project_status' => 'required|in:0,1',
            'project_description' => 'required|string|min:3|max:255',

            // Investor rules
            'investor_id.*' => 'required|numeric|exists:investors,id',
            'investor_investment.*' => 'required|numeric|min:1|regex:/^\d+(\.\d{1,2})?$/',
            'investor_profit.*' => 'required|numeric|min:10|regex:/^\d+(\.\d{1,2})?$/',

            // Commissioner rules
            'commissioner_id.*' => 'required|numeric|exists:commission_agents,id',
            'commissioner_commission.*' => 'required|numeric|min:1|regex:/^\d+(\.\d{1,2})?$/',

            // Transfer rules
            'transfer_code' => 'required|string|min:12|max:12|regex:/^[a-zA-Z0-9]+$/|unique:transfers,transfer_code',
            'transfer_bank' => 'required|string|min:6|max:36|regex:/^[^\d]+$/',
            'transfer_date' => 'required|date_format:Y-m-d\TH:i:s',
            'transfer_amount' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'transfer_description' => 'required|string|min:3|max:255',
        ];
    }

    public function messages()
    {
        return [
            // Project messages
            'project_name.required' => 'El nombre del proyecto es obligatorio.',
            'project_name.string' => 'El nombre del proyecto debe ser una cadena de caracteres.',
            'project_name.min' => 'El nombre del proyecto debe tener al menos 3 caracteres.',
            'project_name.max' => 'El nombre del proyecto no puede tener más de 55 caracteres.',
            'project_name.regex' => 'El nombre del proyecto no puede contener números.',
            'project_name.unique' => 'El nombre del proyecto ya existe.',
            'project_code.required' => 'El código del proyecto es obligatorio.',
            'project_code.string' => 'El código del proyecto debe ser una cadena de caracteres.',
            'project_code.min' => 'El código del proyecto debe tener 12 caracteres.',
            'project_code.max' => 'El código del proyecto debe tener 12 caracteres.',
            'project_code.regex' => 'El código del proyecto solo puede contener letras y números.',
            'project_code.unique' => 'El código del proyecto ya existe.',
            'project_start_date.required' => 'La fecha de inicio del proyecto es obligatoria.',
            'project_start_date.date_format' => 'La fecha de inicio del proyecto debe tener el formato Y-m-d.',
            'project_end_date.required' => 'La fecha de fin del proyecto es obligatoria.',
            'project_end_date.date_format' => 'La fecha de fin del proyecto debe tener el formato Y-m-d.',
            'project_investment.required' => 'La inversión del proyecto es obligatoria.',
            'project_investment.numeric' => 'La inversión del proyecto debe ser un número.',
            'project_investment.min' => 'La inversión del proyecto no puede ser negativa.',
            'project_investment.regex' => 'La inversión del proyecto debe tener hasta dos decimales.',
            'project_status.required' => 'El estado del proyecto es obligatorio.',
            'project_status.in' => 'El estado del proyecto no es válido.',
            'project_description.required' => 'La descripción del proyecto es obligatoria.',
            'project_description.string' => 'La descripción del proyecto debe ser una cadena de caracteres.',
            'project_description.min' => 'La descripción del proyecto debe tener al menos 3 caracteres.',
            'project_description.max' => 'La descripción del proyecto no puede tener más de 255 caracteres.',

            // Investor messages
            'investor_id.*.required' => 'El ID del inversionista es obligatorio.',
            'investor_id.*.numeric' => 'El ID del inversionista debe ser un número.',
            'investor_id.*.exists' => 'El inversionista seleccionado no existe.',
            'investor_investment.*.required' => 'La inversión del inversionista es obligatoria.',
            'investor_investment.*.numeric' => 'La inversión del inversionista debe ser un número.',
            'investor_investment.*.min' => 'La inversión del inversionista debe ser al menos 1.',
            'investor_investment.*.regex' => 'La inversión del inversionista debe tener hasta dos decimales.',
            'investor_profit.*.required' => 'El beneficio del inversionista es obligatorio.',
            'investor_profit.*.numeric' => 'El beneficio del inversionista debe ser un número.',
            'investor_profit.*.min' => 'El beneficio del inversionista debe ser al menos 10.',
            'investor_profit.*.regex' => 'El beneficio del inversionista debe tener hasta dos decimales.',

            // Commissioner messages
            'commissioner_id.*.required' => 'El ID del comisionista es obligatorio.',
            'commissioner_id.*.numeric' => 'El ID del comisionista debe ser un número.',
            'commissioner_id.*.exists' => 'El comisionista seleccionado no existe.',
            'commissioner_commission.*.required' => 'La comisión del comisionista es obligatoria.',
            'commissioner_commission.*.numeric' => 'La comisión del comisionista debe ser un número.',
            'commissioner_commission.*.min' => 'La comisión del comisionista debe ser al menos 1.',
            'commissioner_commission.*.regex' => 'La comisión del comisionista debe tener hasta dos decimales.',

            // Transfer messages
            'transfer_code.required' => 'El código de transferencia es obligatorio.',
            'transfer_code.string' => 'El código de transferencia debe ser una cadena de caracteres.',
            'transfer_code.min' => 'El código de transferencia debe tener 12 caracteres.',
            'transfer_code.max' => 'El código de transferencia debe tener 12 caracteres.',
            'transfer_code.regex' => 'El código de transferencia solo puede contener letras y números.',
            'transfer_code.unique' => 'El código de transferencia ya existe.',
            'transfer_bank.required' => 'El banco de transferencia es obligatorio.',
            'transfer_bank.string' => 'El banco de transferencia debe ser una cadena de caracteres.',
            'transfer_bank.min' => 'El banco de transferencia debe tener al menos 6 caracteres.',
            'transfer_bank.max' => 'El banco de transferencia no puede tener más de 36 caracteres.',
            'transfer_bank.regex' => 'El banco de transferencia no puede contener números.',
            'transfer_date.required' => 'La fecha de transferencia es obligatoria.',
            'transfer_date.date_format' => 'La fecha de transferencia debe tener el formato Y-m-d\TH:i:s.',
            'transfer_amount.required' => 'El monto de transferencia es obligatorio.',
            'transfer_amount.numeric' => 'El monto de transferencia debe ser un número.',
            'transfer_amount.min' => 'El monto de transferencia no puede ser negativo.',
            'transfer_amount.regex' => 'El monto de transferencia debe tener hasta dos decimales.',
            'transfer_description.required' => 'La descripción de la transferencia es obligatoria.',
            'transfer_description.string' => 'La descripción de la transferencia debe ser una cadena de caracteres.',
            'transfer_description.min' => 'La descripción de la transferencia debe tener al menos 3 caracteres.',
            'transfer_description.max' => 'La descripción de la transferencia no puede tener más de 255 caracteres.',
        ];
    }
}
