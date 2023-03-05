<x-layouts.panel>

    <div class="row">
        <div class="col-8">
            <h2>{{ $proyect->name }}</h2>
        </div>
        <div class="col-4 text-end">
            <a href="{{ route('proyect.index') }}" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Volver</a>
        </div>
    </div>
    <hr>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="card col-11 col-md-6">
            <div class="card-body">
                <form action="{{ route('proyect.update', $proyect) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="my-3">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control form-control-sm" id="name" name="name"
                            value="{{ $proyect->name ?? old('name') }}">
                    </div>
                    <div class="my-3">
                        <label for="">Descripcion</label>
                        <input type="text" class="form-control form-control-sm" id="description" name="description"
                            value="{{ $proyect->description ?? old('description') }}">
                    </div>
                    <div class="my-3">
                        <label for="">Estado</label>
                        <select name="status" id="status" class="form-select">
                            <option value="active" {{ $proyect->status == 'active' ? 'select' : '' }}>En proceso</option>
                            <option value="finish" {{ $proyect->status == 'finish' ? 'select' : '' }}>Finalizado</option>
                        </select>
                    </div>
                    <div class="my-3 row">
                        <div class="col text-start">
                            <button class="btn btn-danger" type="button" onclick="eliminarRegistro()">
                                Eliminar
                            </button>
                        </div>
                        <div class="col text-end">
                            <button class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row my-5">
        <div class="col-12">
            <h2>Lista de Obreros</h2>
        </div>
        <div class="card col-12">
            <div class="my-3">
                <form action="{{route('employee.add_employee',[$proyect])}}" method="post">
                    @csrf
                    <label for="">Agregar Obrero por N° de cédula</label>
                    <input type="text" class="form-control form-control-sm" id="legal_id" name="legal_id" placeholder="introduzca el número de cédula">
                    <button class="btn btn-primary btn-sm mt-3" type="submit">Agregar</button>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="listado">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Telefono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proyect->employees as $worker)
                            <tr>
                                <td>{{ $worker->name }}</td>
                                <td>{{ $worker->lastname }}</td>
                                <td>{{ $worker->phone }}</td>
                                <td>
                                    <a href="{{ route('employee.edit', $worker) }}" class="btn btn-sm btn-warning"><i
                                            class="fas fa-edit"></i></a>
                                    <form action="{{ route('employee.remove_employee',[$worker,$proyect]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
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
            function eliminarRegistro() {
                confirmar = confirm("¿Está seguro de eliminar el registro?");
                if(confirmar){
                    $.ajax({
                        url: "{{route('proyect.destroy',$proyect)}}",
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(result) {
                            alert(result)
                            window.location.href = "{{route('proyect.index')}}";
                        }
                    })
                }
            }
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
