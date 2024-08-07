<?php

namespace App\Http\Requests\Moneylender;

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
            'moneylender_name' => 'required|string|min:3|max:55|regex:/^[^\d]+$/|unique:moneylenders',
            'moneylender_dni' => 'required|string|min:13|max:13|regex:/^[0-9]+$/|unique:moneylenders',
            'moneylender_phone' => 'required|string|min:8|max:11|regex:/^[0-9]+$/|',
            'moneylender_company_name' => 'required|string|min:3|max:55|regex:/^[^\d]+$/',
        ];
    }

    public function messages()
    {
        return [
            // Moneylender name messages
            'moneylender_name.required' => 'El nombre del prestamista es obligatorio.',
            'moneylender_name.unique' => 'El nombre del prestamista ya existe.',
            'moneylender_name.string' => 'El nombre del prestamista solo debe contener letras.',
            'moneylender_name.regex' => 'El nombre del prestamista no puede contener números ni símbolos.',
            'moneylender_name.min' => 'El nombre del prestamista debe contener al menos 3 letras.',
            'moneylender_name.max' => 'El nombre del prestamista no puede exceder 55 letras.',

            // Moneylender dni messages
            'moneylender_dni.required' => 'El DNI del prestamista es obligatorio.',
            'moneylender_dni.unique' => 'El DNI del prestamista ya existe.',
            'moneylender_dni.string' => 'El DNI del prestamista solo debe contener números.',
            'moneylender_dni.regex' => 'El DNI del prestamista no puede contener letras ni símbolos.',
            'moneylender_dni.min' => 'El DNI del prestamista debe contener al menos 13 digitos.',
            'moneylender_dni.max' => 'El DNI del prestamista no puede exceder 13 digitos.',

            // Moneylender phone messages
            'moneylender_phone.required' => 'El número de teléfono del prestamista es obligatorio.',
            'moneylender_phone.unique' => 'El número de teléfono del prestamista ya existe.',
            'moneylender_phone.string' => 'El número de teléfono del prestamista solo debe contener números.',
            'moneylender_phone.regex' => 'El número de teléfono del prestamista no puede contener letras ni símbolos.',
            'moneylender_phone.min' => 'El número de teléfono del prestamista debe contener al menos 8 digitos.',
            'moneylender_phone.max' => 'El número de teléfono del prestamista no puede exceder 11 digitos.',

            // Company name messages
            'moneylender_company_name.required' => 'El nombre de la empresa afiliada es obligatorio.',
            'moneylender_company_name.string' => 'El nombre de la empresa afiliada solo debe contener letras.',
            'moneylender_company_name.regex' => 'El nombre de la empresa afiliada no puede contener números ni símbolos.',
            'moneylender_company_name.min' => 'El nombre de la empresa afiliada debe contener al menos 3 letras.',
            'moneylender_company_name.max' => 'El nombre de la empresa afiliada no puede exceder 55 letras.',
        ];
    }
}
