<x-layouts.panel>

    <div class="row">
        <div class="col-8">
            <h2>Planilla de Asistencias</h2>
        </div>
        <div class="col-4 text-end">

        </div>
    </div>
    <hr>
    <div class="row">
        <form action="{{route('attendance.planilla')}}">
            <div class="row">
                @csrf
                <div class="col-4">
                    <input type="date" name="desde" id="desde" class="form-control" value="{{date('Y-m-d') ?? old('desde')}}">
                </div>
                <div class="col-4">
                    <input type="date" name="hasta" id="hasta" class="form-control" value="{{date('Y-m-d') ?? old('hasta')}}">
                </div>
                <div class="col-4">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row mt-3">
        <div class="card col-12">
            <div class="card-body table-responsive">
                <h2>Planillas Cargadas</h2>
                <hr>
                <table class="table table-sm table-bordered table-hover" style="font-size:0.8rem">
                    <thead>
                        <tr>
                            <th>Obrero</th>
                            <th>Documento</th>
                            @php
                                $dates = array();
                                for ($i=0; $i < $dias; $i++) {
                                    $dates[] = date('Y-m-d', strtotime($desde . ' + ' . $i . ' day'));
                                }
                            @endphp
                            @foreach ($dates as $date)
                                <th>{{ date_format(date_create($date),'d-M') }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->legal_id }}</td>
                                @foreach($employee->total as $date)
                                        <td>{{ $date->horas }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-layouts.panel>
