<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

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
            'project_name' => 'required|string|min:3|max:55|regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚ\s]+$/',
            'project_code' => 'required|string|min:12|max:12|regex:/^[a-zA-Z0-9]+$/|unique:projects,project_code',
            'project_start_date' => 'required|date_format:Y-m-d',
            'project_end_date' => 'required|date_format:Y-m-d|after:project_start_date',
            'project_work_days' => 'required|numeric|min:1|regex:/^\d+$/',
            'project_investment' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'project_status' => 'required|in:0,1',
            'project_comment' => 'required|string|min:3|max:255',
            'project_proof_transfer_img' => 'string',
            'project_close_comment' => 'string|min:3|max:255',
            'investor_balance_history' => 'required|min:0|regex:/^\d+(\.\d{1,2})?$/',

            // Investor rules
            'investor_id' => 'required|numeric|exists:investors,id',
            'investor_investment' => 'required|numeric|min:1|regex:/^\d+(\.\d{1,2})?$/',
            'investor_profit' => 'required|numeric|min:1|regex:/^\d+(\.\d{1,2})?$/',
            'investor_final_profit' => 'required|numeric|min:1|regex:/^\d+(\.\d{1,2})?$/',

            // Commissioner rules
            'commissioner_id.*' => 'required|numeric|exists:commission_agents,id',
            'commissioner_commission.*' => 'required|numeric|min:1|regex:/^\d+(\.\d{1,2})?$/',

            // Transfer rules
            'transfer_code' => 'required|string|min:12|max:12|regex:/^[a-zA-Z0-9]+$/|unique:transfers,transfer_code',
            'transfer_bank' => 'required|string|min:6|max:36|regex:/^[^\d]+$/',
            'transfer_date' => 'required|date:Y-m-d H:i:s',
            'transfer_amount' => 'required|numeric|min:1|regex:/^\d+(\.\d{1,2})?$/',
            'transfer_img'=> 'string',
            'transfer_comment' => 'required|string|min:3|max:255',
        ];
    }

    public function messages()
    {
        return [
            // Project name messages
            'project_name.required' => 'El nombre del proyecto es obligatorio.',
            'project_name.string' => 'El nombre del proyecto solo debe contener letras y/o números.',
            'project_name.min' => 'El nombre del proyecto debe tener al menos 3 caracteres.',
            'project_name.max' => 'El nombre del proyecto no puede tener más de 55 caracteres.',
            'project_name.regex' => 'El nombre del proyecto no puede contener símbolos.',

            // Project code messages
            'project_code.required' => 'El código del proyecto es obligatorio.',
            'project_code.string' => 'El código del proyecto solo debe contener letras.',
            'project_code.min' => 'El código del proyecto debe tener al menos 12 caracteres.',
            'project_code.max' => 'El código del proyecto no puede exceder 12 caracteres.',
            'project_code.regex' => 'El código del proyecto solo puede contener letras y números.',
            'project_code.unique' => 'El código del proyecto ya existe.',
            
            // Project start date messages
            'project_start_date.required' => 'La fecha de inicio del proyecto es obligatoria.',
            'project_start_date.date_format' => 'La fecha de inicio del proyecto debe tener el formato Y-m-d.',
            
            // Project end date messages
            'project_end_date.required' => 'La fecha de fin del proyecto es obligatoria.',
            'project_end_date.date_format' => 'La fecha de fin del proyecto debe tener el formato Y-m-d.',
            'project_end_date.after' => 'La fecha de fin del proyecto debe ser mayor a la fecha de inicio del mismo.',

            // Project investment messages
            'project_work_days.required' => 'Los días de trabajo del proyecto son obligatorios.',
            'project_work_days.numeric' => 'Los días de trabajo del proyecto solo debe contener números.',
            'project_work_days.min' => 'El total de días de trabajo del proyecto no puede ser menor a 1.',
            'project_work_days.regex' => 'Los días de trabajo del proyecto no puede contener letras ni símbolos.',
            
            // Project investment messages
            'project_investment.required' => 'La inversión del proyecto es obligatoria.',
            'project_investment.numeric' => 'La inversión del proyecto debe ser un número.',
            'project_investment.min' => 'La inversión del proyecto no puede ser negativa.',
            'project_investment.regex' => 'La inversión del proyecto debe tener hasta dos decimales.',

            // Project investment messages
            'investor_balance_history.required' => 'El fondo del inversionista del proyecto es obligatoria.',
            'investor_balance_history.numeric' => 'El fondo del inversionista del proyecto debe ser un número.',
            'investor_balance_history.min' => 'El fondo del inversionista del proyecto no puede ser menor a 0.',
            'investor_balance_history.regex' => 'El fondo del inversionista del proyecto debe tener hasta dos decimales.',
            
            // Project status messages
            'project_status.required' => 'El estado del proyecto es obligatorio.',
            'project_status.in' => 'El estado del proyecto no es válido.',
            
            // Project description messages
            'project_comment.string' => 'Los comentarios adicionales del proyecto solo deben contener letras, números y/o símbolos.',
            'project_comment.min' => 'Los comentarios adicionales del proyecto deben tener al menos 3 caracteres.',
            'project_comment.max' => 'Los comentarios adicionales del proyecto no pueden tener más de 255 caracteres.',

            // Project proof transfer img messages
            'project_proof_transfer_img.string' => 'El comprobante de pago de transferencia del proyecto debe ser una imagen válida.',

            // Project description messages
            'project_close_comment.required' => 'El motivo de cierre del proyecto son obligatorios.',
            'project_close_comment.string' => 'El motivo de cierre del proyecto solo deben contener letras, números y/o símbolos.',
            'project_close_comment.min' => 'El motivo de cierre del proyecto deben tener al menos 3 caracteres.',
            'project_close_comment.max' => 'El motivo de cierre del proyecto no pueden tener más de 255 caracteres.',

            // Investor array id messages
            'investor_id.required' => 'El ID del inversionista es obligatorio.',
            'investor_id.numeric' => 'El ID del inversionista debe ser un número.',
            'investor_id.exists' => 'El inversionista seleccionado no existe.',
            
            // Investor array investment messages
            'investor_investment.required' => 'La inversión del inversionista es obligatoria.',
            'investor_investment.numeric' => 'La inversión del inversionista debe ser un número.',
            'investor_investment.min' => 'La inversión del inversionista debe ser al menos 1.',
            'investor_investment.regex' => 'La inversión del inversionista debe tener hasta dos decimales.',
            
            // Investor array profit messages
            'investor_profit.required' => 'La ganancia total del proyecto es obligatorio.',
            'investor_profit.numeric' => 'La ganancia total del proyecto debe ser un número.',
            'investor_profit.min' => 'La ganancia total del proyecto debe ser al menos 1.',
            'investor_profit.regex' => 'La ganancia total del proyecto debe tener hasta dos decimales.',

            // Investor array profit messages
            'investor_final_profit.required' => 'La ganancia del inversionista principal es obligatoria.',
            'investor_final_profit.numeric' => 'La ganancia del inversionista principal debe ser un número.',
            'investor_final_profit.min' => 'La ganancia del inversionista principal debe ser al menos 1.',
            'investor_final_profit.regex' => 'La ganancia del inversionista principal debe tener hasta dos decimales.',

            // Commissioner array id messages
            'commissioner_id.*.required' => 'El ID del comisionista es obligatorio.',
            'commissioner_id.*.numeric' => 'El ID del comisionista debe ser un número.',
            'commissioner_id.*.exists' => 'El comisionista seleccionado no existe.',
            
            // Commissioner array commissions messages
            'commissioner_commission.0.required' => 'La comisión del primer comisionista es obligatoria.',
            'commissioner_commission.0.numeric' => 'La comisión del primer comisionista debe ser un número.',
            'commissioner_commission.0.min' => 'La comisión del primer comisionista debe ser al menos 1.',
            'commissioner_commission.0.regex' => 'La comisión del primer comisionista debe tener hasta dos decimales.',

            'commissioner_commission.1.required' => 'La comisión del segundo comisionista es obligatoria.',
            'commissioner_commission.1.numeric' => 'La comisión del segundo comisionista debe ser un número.',
            'commissioner_commission.1.min' => 'La comisión del segundo comisionista debe ser al menos 1.',
            'commissioner_commission.1.regex' => 'La comisión del segundo comisionista debe tener hasta dos decimales.',

            // Transfer code messages
            'transfer_code.required' => 'El código de transferencia es obligatorio.',
            'transfer_code.string' => 'El código de transferencia solo debe contener letras.',
            'transfer_code.min' => 'El código de transferencia debe tener 12 caracteres.',
            'transfer_code.max' => 'El código de transferencia debe tener 12 caracteres.',
            'transfer_code.regex' => 'El código de transferencia solo puede contener letras y números.',
            'transfer_code.unique' => 'El código de transferencia ya existe.',
            
            // Transfer bank messages
            'transfer_bank.required' => 'El banco de transferencia es obligatorio.',
            'transfer_bank.string' => 'El banco de transferencia solo debe contener letras y espacios.',
            'transfer_bank.min' => 'El banco de transferencia debe tener al menos 6 caracteres.',
            'transfer_bank.max' => 'El banco de transferencia no puede tener más de 36 caracteres.',
            'transfer_bank.regex' => 'El banco de transferencia no puede contener números ni símbolos.',
            
            // Transfer date messages
            'transfer_date.required' => 'La fecha de transferencia es obligatoria.',
            'transfer_date.date' => 'Debe ingresar un formato de fecha válido para el depçosito del proyecto (Y-m-d H:i:s).',
            
            // Transfer amount messages
            'transfer_amount.required' => 'El monto de transferencia es obligatorio.',
            'transfer_amount.numeric' => 'El monto de transferencia debe ser un número.',
            'transfer_amount.min' => 'El monto de transferencia debe ser igual o mayor a 1',
            'transfer_amount.regex' => 'El monto de transferencia debe tener máximo hasta dos decimales.',
            
            // Project proof transfer img messages
            'transfer_img.string' => 'El comprobante de pago de transferencia de inversión para el proyecto debe ser una imagen válida.',

            // Transfer description messages
            'transfer_comment.required' => 'Los comentarios de la transferencia son obligatorios.',
            'transfer_comment.string' => 'Los comentarios de la transferencia solo deben contener letras, números y/o símbolos.',
            'transfer_comment.min' => 'Los comentarios de la transferencia debe tener al menos 3 caracteres.',
            'transfer_comment.max' => 'Los comentarios de la transferencia no puede tener más de 255 caracteres.',
        ];
    }

    // Custom Laravel validation rules
    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $investorProfit = $this->input('investor_profit');
            $investorFinalProfit = $this->input('investor_final_profit');
            $commissionerCommissions = $this->input('commissioner_commission', []);
            $investorInvestment = $this->input('investor_investment');
    
            // Validar si investor_final_profit es igual al 50% de investor_investment
            if ($investorFinalProfit != $investorProfit * 0.5) {
                $validator->errors()->add('investor_final_profit', 'La ganancia del inversionista principal debe ser el 50% de la ganancia total del proyecto.');
            }
    
            // Contar el número de comisionistas
            $numCommissioners = count($commissionerCommissions);
    
            // Si solo hay un comisionista
            if ($numCommissioners == 1) {
                // Validar que su comisión sea el 50% del investor_profit
                if ($commissionerCommissions[0] != $investorProfit * 0.5) {
                    $validator->errors()->add('commissioner_commission.0', 'El comisionista debe recibir el 50% de la ganancia total del proyecto.');
                }
            } elseif ($numCommissioners == 2) {
                // Si hay dos comisionistas, el primero recibe el 90% de juniorCommission y el segundo el 10%
                $juniorCommission = $investorProfit * 0.5; // Calcula juniorCommission como el 50% de investorProfit
                $commissioner1Commission = $commissionerCommissions[0];
                $commissioner2Commission = $commissionerCommissions[1];
    
                if ($commissioner1Commission != $juniorCommission * 0.9) {
                    $validator->errors()->add('commissioner_commission.0', 'El primer comisionista debe recibir el 40% de la ganancia total para los comisionistas.');
                }
    
                if ($commissioner2Commission != $juniorCommission * 0.1) {
                    $validator->errors()->add('commissioner_commission.1', 'El segundo comisionista debe recibir el 10% de la ganancia total para los comisionistas.');
                }
            } elseif ($numCommissioners > 2) {
                // Si hay más de dos comisionistas, agregar un error de validación
                $validator->errors()->add('commissioner_commission', 'No se permiten más de dos comisionistas en el proyecto.');
            }
    
            // Validar que investor_profit no sea mayor que investor_investment
            if ($investorProfit > $investorInvestment) {
                $validator->errors()->add('investor_profit', 'La ganancia del inversionista no puede ser mayor que la inversión.');
            }
        });
    }
}