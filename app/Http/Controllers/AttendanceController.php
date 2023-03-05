<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Proyect;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AttendanceImport;
use App\Models\Employee;
use DateTime;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = date('Y-m-d');
        $proyects = Proyect::all();
        $attendances = Attendance::whereDate('created_at', $date)->orderBy('created_at','desc')->with('employees')->get();
        return view('attendance.index',compact('proyects','attendances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        $proyects = Proyect::all();
        $employees = Employee::all();
        return view('attendance.edit',compact('proyects','attendance','employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        $validate = $request->validate([
            'proyect_id' => 'required',
            'employee_id' => 'required',
            'date' => 'required',
            'type' => 'required'
        ],[
            'proyect_id.required' => 'El campo proyecto es obligatorio',
            'employee_id.required' => 'El campo empleado es obligatorio',
            'date.required' => 'El campo fecha es obligatorio',
            'type.required' => 'El campo tipo es obligatorio'
        ]);

        if(!$validate){
            return redirect()->back()->withErrors($validate);
        }

        $date = new DateTime($request->date);
        $date = $date->format('Y-m-d H:i:s');

        $attendance->proyect_id = $request->proyect_id;
        $attendance->employee_id = $request->employee_id;
        $attendance->date = $date;
        $attendance->type = $request->type;
        $attendance->save();

        return redirect()->back()->with('success','Asistencia actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return response('Asistencia eliminada correctamente',200);
    }

    public function getData(Request $request){

        $validate = $request->validate([
            'proyect_id' => 'required',
            'planilla' => 'required'
        ],[
            'proyect_id.required' => 'El campo proyecto es obligatorio',
            'planilla.required' => 'El campo planilla es obligatorio'
        ]);

        if(!$validate){
            return redirect()->back()->withErrors($validate);
        }

        if($request->hasFile('planilla')){
            $path = $request->file('planilla')->getRealPath();
            $datos = Excel::import(new AttendanceImport, $path);

            return redirect()->back()->with('success','Datos importados correctamente');
        }
    }
}
