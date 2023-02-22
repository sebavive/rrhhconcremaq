<x-layouts.panel>
    <div class="row">
        <div class="col-8">
            <h2>Obreros</h2>
        </div>
        <div class="col-4 text-end">
            <a href="{{route('employee.create')}}" class="btn btn-secondary">Nuevo</a>
        </div>
        <hr>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <table class="table striped" id="listado">
                    <thead>
                        <tr>
                            <th>Doc</th>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->legal_id }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>
                                    <a href="{{ route('employee.edit', $employee) }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#listado').DataTable({
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                    },
                    "columnDefs": [{
                        "orderable": false,
                        "targets": 4
                    }],
                });
            });
        </script>
    @endsection

</x-layouts.panel>
