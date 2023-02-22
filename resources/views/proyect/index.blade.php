<x-layouts.panel>

    <div class="row">
        <div class="col-8">
            <h2>Proyectos</h2>
        </div>
        <div class="col-4 text-end">
            <a href="{{route('proyect.create')}}" class="btn btn-secondary">Nuevo</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <table class="table striped" id="listado">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Obreros</th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proyects as $proyect)
                            <tr>
                                <td>{{ $proyect->id }}</td>
                                <td>{{ $proyect->name }}</td>
                                <td>{{ $proyect->status }}</td>
                                <td>{{ "0" }}</td>
                                <td>
                                    <a href="{{ route('proyect.edit', $proyect) }}" class="btn btn-primary btn-sm">
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
