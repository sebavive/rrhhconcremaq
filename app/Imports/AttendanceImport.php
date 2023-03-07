<?php

namespace App\Imports;

use App\Models\Attendance;
use App\Models\Employee;
use DateTime;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AttendanceImport implements ToModel , WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        $employee = Employee::where('legal_id',$row['cedula'])->first();
        if(!$employee){
            $employee = Employee::create([
                'legal_id' => $row['cedula'],
                'name' => $row['name'],
            ]);
        }
        $employee->proyects()->sync(request()->proyect_id);

        $fecha = explode(' ', $row['time']);
        $partes = explode('/', $fecha[0]);
        $date = $partes[2] . '-' . $partes[1] . '-' . $partes[0];

        $hora = explode(':', $fecha[1]);
        $date = $date . ' ' . $hora[0] . ':' . $hora[1] . ':00';
        $fecha = new DateTime($date);

        return new Attendance([
            'employee_id'  => $employee->id,
            'proyect_id'   => request()->proyect_id,
            'date' => $fecha,
            'type' => $row['out'] == '' ? 'entrada' : 'salida',
            'hours' => '0'
        ]);
    }
}
