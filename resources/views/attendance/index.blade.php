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
        <div class="card col-11 col-md-8">
            <div class="card-body">
                <h2>Cargar planilla</h2>
                <hr>
                @if ($errors->any())
                    <div class="alert alert-danger my-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success my-3">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <form action="{{ route('attendance.getData') }}" enctype="multipart/form-data" id="planilla_form"
                    method="POST">
                    @csrf
                    <div class="my-3">
                        <label for="proyect_id">Proyecto</label>
                        <select name="proyect_id" id="proyect_id" class="form-select form-select-sm">
                            <option value="">Seleccione un proyecto</option>
                            @foreach ($proyects as $proyect)
                                <option value="{{ $proyect->id }}">{{ $proyect->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="my-3">
                        <label for="">Planilla de Asistencias</label>
                        <input type="file" name="planilla" id="planilla" class="form-control form-control-sm">
                    </div>
                    <div class="my-3">
                        <button type="submit" class="btn btn-primary">Cargar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="card col-12">
            <div class="card-body">
                <h2>Planillas Cargadas</h2>
                <hr>
                <table class="table table-sm table-striped table-hover" style="font-size:0.8rem">
                    <thead>
                        <tr>
                            <th>Obrero</th>
                            <th>Documento</th>
                            <th>Fecha de Carga</th>
                            <th>Entrada</th>
                            <th>Salida</th>
                            <th>Horas</th>
                            <th>Acc</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendances as $attendance)
                            <tr>
                                <td>{{ $attendance->employees->name }}</td>
                                <td>{{ $attendance->employees->legal_id }}</td>
                                <td>{{ date_format(date_create($attendance->date),'d-m-Y') }}</td>
                                <td>{{ $attendance->indate!=null ? date_format(date_create($attendance->indate),'H:i') : ""  }}</td>
                                <td>{{ $attendance->outdate!=null ? date_format(date_create($attendance->outdate),'H:i') : "" }}</td>
                                <td>{!! $attendance->hours == 0 ? "<span class='badge bg-danger'>error</span>" : $attendance->hours  !!}</td>
                                <td>
                                    <a href="{{ route('attendance.edit', $attendance->id) }}"
                                        class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @section('scripts')
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
    <script type='text/javascript' src='https://cdn.datatables.net/plug-ins/1.13.3/sorting/datetime-moment.js'></script>
        <script>
            $.fn.dataTable.moment( 'YYYY/MM/DD' );
            var hoy = moment().format('YYYY/MM/DD');
            $(document).ready(function() {
                $('.table').DataTable({
                    dom: 'QBfrtip',
                    buttons: [
                        'copy', 'excel', 'pdf'
                    ],
                    bLengthChange: false,
                    searchBuilder: true,
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.13.3/i18n/es-ES.json"
                    },
                    columnDefs: [{
                        "orderable": false,
                        "targets": 3
                    }],
                    searchBuilder:{
                        preDefined: {
                            criteria:[
                            {
                                title: 'Fecha',
                                columns: 2,
                                condition: 'between',
                                value: [hoy, hoy],
                                type: 'datetime'
                            }
                        ],
                        logic: 'AND'
                    },
                }
                });
            });
        </script>
    @endsection
</x-layouts.panel>
