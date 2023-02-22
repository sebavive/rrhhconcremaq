<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\EmployeeStoreRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(EmployeeStoreRequest $request)
    {
        $employee = Employee::create($request->validated());

        return redirect()->route('employee.edit',compact('employee'))
            ->with('success', 'Registro creado con éxito');
    }

    public function show(Employee $employee)
    {
        $payroll = $employee->payroll;
        return view('employee.edit', compact('data'));
    }

    public function edit(Employee $employee)
    {
        $payroll = $employee->payroll;
        return view('employee.edit', compact('employee', 'payroll'));
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response('Registro eliminado con éxito');
    }
}
