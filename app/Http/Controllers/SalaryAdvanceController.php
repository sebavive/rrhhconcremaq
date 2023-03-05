<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\SalaryAdvance;
use Illuminate\Http\Request;

class SalaryAdvanceController extends Controller
{

    public function index(){
        $salaryAdvances = SalaryAdvance::with('employees')->get();
        return view('salaryAdvance.index', compact('salaryAdvances'));
    }

    public function create(){
        $employees = Employee::all();
        return view('salaryAdvance.create', compact('employees'));
    }

    public function store(Request $request){

        $validate = $request->validate([
            'employee_id' => 'required',
            'amount' => 'required',
            'detalle' => 'required',
            'due_date' => 'required'
        ],[
            'employee_id.required' => 'El campo empleado es obligatorio',
            'amount.required' => 'El campo monto es obligatorio',
            'detalle.required' => 'El campo detalle es obligatorio',
            'due_date.required' => 'El campo fecha es obligatorio'
        ]);
        if(!$validate){
            return response()->json($validate, 400);
        }
        $salaryAdvance = SalaryAdvance::create($request->all());
        $employees = Employee::all();
        return redirect()->route('salary-advances.edit', $salaryAdvance)->with('success', 'Adelanto guardado con éxito')->with('employees', $employees);
    }

    public function edit(SalaryAdvance $salaryAdvance){
        $employees = Employee::all();
        return view('salaryAdvance.edit', compact('salaryAdvance', 'employees'));
    }

    public function update(Request $request, SalaryAdvance $salaryAdvance){
        $validate = $request->validate([
            'employee_id' => 'required',
            'amount' => 'required',
            'detalle' => 'required',
            'due_date' => 'required'
        ],[
            'employee_id.required' => 'El campo empleado es obligatorio',
            'amount.required' => 'El campo monto es obligatorio',
            'detalle.required' => 'El campo detalle es obligatorio',
            'due_date.required' => 'El campo fecha es obligatorio'
        ]);
        if(!$validate){
            return response()->json($validate, 400);
        }
        $salaryAdvance->update($request->all());
        return redirect()->back()->with('success', 'Adelanto actualizado con éxito');
    }

    public function destroy(SalaryAdvance $salaryAdvance){
        $salaryAdvance->delete();
        return response('Adelanto eliminado con éxito');
    }
}
