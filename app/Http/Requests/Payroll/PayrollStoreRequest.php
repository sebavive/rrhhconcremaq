<?php

namespace App\Http\Requests\Payroll;

use Illuminate\Foundation\Http\FormRequest;

class PayrollStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'insurance_number' => 'nullable|max:30',
            'employee_id' => 'required|exists:employees,id',
            'pay_rate' => 'required|numeric',
            'pay_period' => 'required',
            'pay_type' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'insurance_number.max' => 'El campo número de seguro social no debe ser mayor a 30 caracteres',
            'employee_id.required' => 'El campo empleado es obligatorio',
            'employee_id.exists' => 'El empleado seleccionado no existe',
            'pay_rate.required' => 'El campo salario es obligatorio',
            'pay_rate.numeric' => 'El campo salario debe ser un número',
            'pay_period.required' => 'El campo periodo de pago es obligatorio',
            'pay_type.required' => 'El campo tipo de pago es obligatorio',
        ];
    }
}
