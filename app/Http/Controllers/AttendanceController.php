<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Proyect;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AttendanceImport;
use App\Models\Employee;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;
use stdClass;

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
        $attendances = Attendance::all();
        // $attendances = Attendance::whereDate('created_at', $date)->orderBy('created_at','desc')->with('employees')->get();
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

            $theArray = Excel::toArray(new stdClass(), $path);

            $newArray = [];

            for($i = 1; $i < count($theArray[0]); $i++){

                $employee = Employee::where('legal_id',$theArray[0][$i][0])->first();
                if(!$employee){
                    $employee = Employee::create([
                        'name' => $theArray[0][$i][2],
                        'legal_id' => $theArray[0][$i][0],
                    ]);
                }
                $fecha = explode(' ', $theArray[0][$i][3]);
                $partes = explode('/', $fecha[0]);
                $date = $partes[2] . '-' . $partes[1] . '-' . $partes[0];

                $hora = explode(':', $fecha[1]);
                $date = $date . ' ' . $hora[0] . ':' . $hora[1] . ':00';
                $fecha = new DateTime($date);

                $newArray[$i]['proyect_id'] = $request->proyect_id;
                $newArray[$i]['employee_id'] = $employee->id;
                $newArray[$i]['name'] = $theArray[0][$i][2];
                $newArray[$i]['date'] = $fecha->format('Y-m-d H:i:s');
                $newArray[$i]['type'] = $theArray[0][$i][5] =="" ? "entrada" : "salida";
            }

            $grouped_data = array();
            foreach ($newArray as $item) {
                $date = date('Y-m-d', strtotime($item['date']));
                $employee_id = $item['employee_id'];
                if (!isset($grouped_data[$employee_id][$date])) {
                    $grouped_data[$employee_id][$date]['entrada'] = null;
                    $grouped_data[$employee_id][$date]['salida'] = null;
                    $grouped_data[$employee_id][$date]['horas_trabajadas'] = 0;
                }
                if ($item['type'] == 'entrada') {
                    $grouped_data[$employee_id][$date]['entrada'] = $item['date'];
                } elseif ($item['type'] == 'salida') {
                    $grouped_data[$employee_id][$date]['salida'] = $item['date'];
                    $entrada = strtotime($grouped_data[$employee_id][$date]['entrada']);
                    $salida = strtotime($grouped_data[$employee_id][$date]['salida']);
                    $horas_trabajadas = 0;
                    if ($entrada && $salida) {
                        $horas_trabajadas = ($salida - $entrada) / 3600;
                    }
                    $grouped_data[$employee_id][$date]['horas_trabajadas'] += $horas_trabajadas;
                }
            }

            foreach ($grouped_data as $employee_id => $dates) {
                foreach ($dates as $fecha => $asistencia) {
                    DB::table('attendances')->insert([
                        'employee_id' => $employee_id,
                        'proyect_id' => $request->proyect_id,
                        'date' => $fecha,
                        'indate' => $asistencia['entrada'],
                        'outdate' => $asistencia['salida'],
                        'hours' => $asistencia['horas_trabajadas']
                    ]);
                }
            }

            $datos = Excel::import(new AttendanceImport, $path);

            return redirect()->back()->with('success','Datos importados correctamente');
        }
    }

    public function planilla(Request $request){

        $ini = Carbon::parse(request()->desde)->format('Y-m-d');
        $to = Carbon::parse(request()->hasta)->format('Y-m-d');

        $diff_dias = Carbon::parse($ini)->diffInDays($to);

        $employees = Employee::select('id','name','legal_id')->get();
        $employeeWork = $employees->map(function($employee) use ($ini, $to){
            $employee->total = Attendance::select('employee_id','date',DB::raw('sum(hours) as horas'))
                                ->where('employee_id',$employee->id)
                                ->whereBetween('date',[$ini,$to])
                                ->groupBy('employee_id','date')
                                ->get();
            return $employee;
        });

        $desde = $ini;
        $hasta = $to;
        $dias = $diff_dias;
        $employees = $employeeWork;

        // return $employees;

        return view('attendance.planilla',compact('desde','hasta','dias','employees'));

    }

}
