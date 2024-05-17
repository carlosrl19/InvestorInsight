<?php

namespace App\Http\Requests\Project;

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
            'project_name' => 'required|string|min:3|max:55|regex:/^[^\d]+$/|unique:projects,project_name',
            'project_code' => 'required|string|min:16|max:16|regex:/^[a-zA-Z0-9]+$/|unique:projects,project_code',
            'project_estimated_time' => 'required|numeric',
            
            'project_start_date' => 'required|date_format:Y-m-d',
            'project_end_date' => 'required|date_format:Y-m-d',

            'project_investment' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'investor_investment' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'investor_id' => 'required|numeric|exists:investors,id',
            
            'project_status' => 'required|min:0|max:1',
            'project_total_worked_days' => 'required|numeric|min:0',
            'project_description' => 'required|string|min:3|max:255',
        ];
    }

    public function messages()
    {
        return [
            // Project name messages
            'project_name.required' => 'El nombre del proyecto es obligatorio.',
            'project_name.unique' => 'El nombre del proyecto ya existe.',
            'project_name.string' => 'El nombre del proyecto solo debe contener letras.',
            'project_name.regex' => 'El nombre del proyecto no puede contener números ni símbolos.',
            'project_name.min' => 'El nombre del proyecto debe contener al menos 3 letras.',
            'project_name.max' => 'El nombre del proyecto no puede exceder 55 letras.',

            // Project code messages
            'project_code.required' => 'El código del proyecto es obligatorio.',
            'project_code.unique' => 'El código del proyecto ya existe.',
            'project_code.string' => 'El código del proyecto solo debe contener letras y/o números.',
            'project_code.regex' => 'El código del proyecto no puede contener símbolos.',
            'project_code.min' => 'El código del proyecto debe contener al menos 16 letras.',
            'project_code.max' => 'El código del proyecto no puede exceder 16 letras.',

            // Project estimated time messages
            'project_estimated_time.required' => 'El total de semanas estimadas para finalizar del proyecto es obligatoria.',
            'project_estimated_time.numeric' => 'Debe ingresar un valor numérico para el total de semanas estimadas para finalizar el proyecto',

            // Project start date messages
            'project_start_date.required' => 'La fecha de inicio estimada del proyecto es obligatoria.',
            'project_start_date.date' => 'Debe ingresar un formato de fecha válido para la fecha de inicio estimada del proyecto.',

            // Project end date messages
            'project_end_date.required' => 'La fecha de cierre estimada del proyecto es obligatoria.',
            'project_end_date.date' => 'Debe ingresar un formato de fecha válido para la fecha de cierre estimada del proyecto.',

            // Project investment messages
            'project_investment.required' => 'El monto de inversión total del proyecto es obligatoria.',
            'project_investment.numeric' => 'El monto de inversión total del proyecto solo debe contener números.',
            'project_investment.regex' => 'El monto de inversión total del proyecto no puede contener letras ni símbolos.',
            'project_investment.min' => 'El monto de inversión total del proyecto debe ser mayor a 0 lps.',

            // Investor investment messages
            'investor_investment.required' => 'El monto de inversión del inversionista es obligatoria.',
            'investor_investment.numeric' => 'El monto de inversión del inversionista solo debe contener números.',
            'investor_investment.regex' => 'El monto de inversión del inversionista no puede contener letras ni símbolos.',
            'investor_investment.min' => 'El monto de inversión del inversionistao debe ser mayor a 0 lps.',

            // Investor id messages
            'investor_id.required' => 'El inversionista es obligatorio.',
            'investor_id.numeric' => 'El id del inversionista solo debe contener números.',
            'investor_id.exists' => 'El inversionista no existe en la base de datos.',

            // Project status messages
            'project_status.required' => 'El estado del proyecto es obligatorio.',
            'project_status.min' => 'El estado del proyecto debe ser "1" para En proceso / trabajando',
            'project_status.max' => 'El estado del proyecto debe ser "0" para Finalizado / cerrado',
            
            // Project total worked days messages
            'project_total_worked_days.required' => 'El total de días trabajados en el proyecto es obligatorio.',
            'project_total_worked_days.numeric' => 'El total de días trabajados en el proyecto solo debe contener números.',
            'project_total_worked_days.min' => 'El mínimo de días trabajados en el proyecto es 0.',

            // Project code messages
            'project_description.required' => 'La descripción del proyecto es obligatorio.',
            'project_description.string' => 'La descripción del proyecto solo debe contener letras.',
            'project_description.min' => 'La descripción del proyecto debe contener al menos 3 letras.',
            'project_description.max' => 'La descripción del proyecto no puede exceder 255 letras.',
        ];
    }
}
