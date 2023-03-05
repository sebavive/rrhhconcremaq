<x-layouts.panel>

    <div class="row">
        <div class="col-8">
            <h2>Editar Asistencia</h2>
        </div>
        <div class="col-4 text-end">
            <a href="{{route('attendance.index')}}" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Volver</a>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="card col-6">
            <div class="card-body">
                <form action="{{route('attendance.update',$attendance)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="my-3">
                        <label for="">Obrero:</label>
                        <select name="employee_id" id="employee_id" class="form-select">
                            <option value="">Seleccione un Obrero</option>
                            @foreach ($employees as $e)
                                <option value="{{ $e->id }}" {{$attendance->employee_id == $e->id ? "selected" : ""}}>{{ $e->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="my-3">
                        <label for="">Proyecto:</label>
                        <select name="proyect_id" id="proyect_id" class="form-select">
                            <option value="">Seleccione una Obra</option>
                            @foreach ($proyects as $p)
                                <option value="{{ $p->id }}" {{$attendance->proyect_id == $p->id ? "selected" : ""}}>{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="my-3">
                        <label for="">Marca:</label>
                        <input type="datetime-local" class="form-control" name="date" value="{{$attendance->date}}">
                    </div>
                    <div class="my-3">
                        <label for="type">Tipo</label>
                        <select name="type" id="type" class="form-select">
                            <option value="entrada" {{$attendance->type == 'entrada' ? 'selected' : ''}}>Entrada</option>
                            <option value="salida" {{$attendance->type == 'salida' ? 'selected' : ''}}>Salida</option>
                        </select>
                    </div>
                    <div class="my-3 row">
                        <div class="col-6 text-center">
                            <button class="btn btn-danger" type="button" id="btnEliminar">Eliminar</button>
                        </div>
                        <div class="col-6 text-center">
                            <button class="btn btn-primary" type="submit">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            $("#btnEliminar").click(function(){
                confirmar = confirm("¿Está seguro de eliminar el registro?");
                if(confirmar){
                    $.ajax({
                        url: "{{route('attendance.destroy',$attendance)}}",
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(result) {
                            alert(result)
                            window.location.href = "{{route('attendance.index')}}";
                        }
                    })
                }
            })
        </script>
    @endsection


</x-layouts.panel>
