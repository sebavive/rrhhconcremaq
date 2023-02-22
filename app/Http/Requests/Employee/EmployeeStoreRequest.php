<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
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
            'name' => 'required',
            'legal_id'=> 'string',
            'email' => 'nullable|email|unique:employees,email',
            'phone' => 'required',
            'address' => 'required',
            'position' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'email.required' => 'Email es requerido',
            'email.email' => 'Email no es valido',
            'email.unique' => 'Email ya existe en la base de datos',
            'phone.required' => 'El nro de telefono es requerido',
            'address.required' => 'La direccion es requerida',
            'position.required' => 'El cargo es requerido',
        ];
    }
}
