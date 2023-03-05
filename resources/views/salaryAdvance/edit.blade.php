<x-layouts.panel>

    <div class="row">
        <div class="col-8">
            <h2>Editar Adelanto</h2>
        </div>
        <div class="col-4 text-end">
            <a href="{{ route('salary-advances.index') }}" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Volver</a>
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
                <form action="{{ route('salary-advances.update', $salaryAdvance) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="my-3">
                        <label for="">Nombre</label>
                        <select name="employee_id" id="employee_id" class="form-select">
                            <option value="">Seleccione el trabajador</option>
                            @foreach ($employees as $e)
                                <option value="{{ $e->id }}" {{$salaryAdvance->employee_id == $e->id ? "selected" : old('employee_id')}}>{{ $e->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="my-3">
                        <label for="">Descripcion</label>
                        <input type="text" class="form-control" id="detalle" name="detalle" value="{{$salaryAdvance->detalle ?? old('detalle')}}">
                    </div>
                    <div class="my-3">
                        <label for="">Tipo</label>
                        <select name="type" id="type" class="form-select">
                            <option value="adelanto"
                            {{$salaryAdvance->type == 'adelanto' ? 'selected': ''}}>Adelanto</option>
                            <option value="credito"
                            {{$salaryAdvance->status == 'credito' ? 'selected': ''}}>Crédito</option>
                        </select>
                    </div>
                    <div class="my-3">
                        <label for="">Importe</label>
                        <input type="text" class="form-control number" id="amount" name="amount" value={{$salaryAdvance->amount ?? old('amount')}}>
                    </div>
                    <div class="my-3">
                        <label for="">Estado</label>
                        <select name="status" id="status" class="form-select">
                            <option value="pending" {{$salaryAdvance->status == 'pending' ? 'selected': ''}}>Pendiente</option>
                            <option value="paid" {{$salaryAdvance->status == 'paid' ? 'selected': ''}}>Pagado</option>
                        </select>
                    </div>
                    <div class="my-3">
                        <label for="">Documento de Pago</label>
                        <input type="text" class="form-control" id="payment_document" value="{{$salaryAdvance->payment_document ?? old('payment_document')}}" name="payment_document">
                    </div>
                    <div class="my-3">
                        <label for="">Vencimiento</label>
                        <input type="date" name="due_date" id="due_date" class="form-control" value="{{$salaryAdvance->due_date}}">
                    </div>
                    <div class="my-3 row">
                        <div class="col-6 text-center">
                            <button class="btn btn-danger" id="btnEliminar" type="button">Eliminar</button>
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
                if(confirm("¿Está seguro de eliminar este registro?")){
                    $.ajax({
                        url: "{{ route('salary-advances.destroy', $salaryAdvance) }}",
                        type: "POST",
                        data: {
                            _method: "DELETE",
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response){
                            alert(response)
                            window.location.href = "{{ route('salary-advances.index') }}";
                        }
                    });
                }
            })
        </script>
    @endsection
</x-layouts.panel>
