<?php

namespace App\Http\Controllers;

use App\Http\Requests\Payroll\PayrollStoreRequest;
use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function store(PayrollStoreRequest $request)
    {
        $employee = Employee::find($request->employee_id);
        $payroll = $employee->payroll()->create($request->validated());

        return redirect()->route('employee.edit',compact('employee','payroll'))
            ->with('success', 'Registro creado con éxito');
    }

    public function update(PayrollStoreRequest $request, Payroll $payroll)
    {
        $employee = Employee::find($request->employee_id);
        $payroll = $employee->payroll->update($request->validated());

        return redirect()->route('employee.edit',compact('employee','payroll'))
            ->with('success', 'Registro actualizado con éxito');
    }
}
