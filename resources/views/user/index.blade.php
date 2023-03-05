<x-layouts.panel>

    <div class="row">
        <div class="col-8">
            <h2>Usuarios</h2>
        </div>
        <div class="col-4 text-end">
            <a href="{{route('user.create')}}" class="btn btn-secondary">Nuevo</a>
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
                            <th>Role</th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <a href="{{ route('user.edit', $user) }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
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
                    "targets": 3
                }],
            });
        });
    </script>
@endsection
</x-layouts.panel>
