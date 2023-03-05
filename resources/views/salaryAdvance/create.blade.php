<x-layouts.panel>

    <div class="row">
        <div class="col-8">
            <h2>Nuevo Adelanto</h2>
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
    <div class="row justify-content-center">
        <div class="card col-11 col-md-6">
            <div class="card-body">
                <form action="{{ route('salary-advances.store') }}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="my-3">
                        <label for="">Nombre</label>
                        <select name="employee_id" id="employee_id" class="form-select">
                            <option value="">Seleccione el trabajador</option>
                            @foreach ($employees as $e)
                                <option value="{{ $e->id }}">{{ $e->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="my-3">
                        <label for="">Descripcion</label>
                        <input type="text" class="form-control" id="detalle" name="detalle">
                    </div>
                    <div class="my-3">
                        <label for="">Tipo</label>
                        <select name="type" id="type" class="form-select">
                            <option value="adelanto">Adelanto</option>
                            <option value="credito">Crédito</option>
                        </select>
                    </div>
                    <div class="my-3">
                        <label for="">Importe</label>
                        <input type="text" class="form-control number" id="amount" name="amount">
                    </div>
                    <div class="my-3">
                        <label for="">Estado</label>
                        <select name="status" id="status" class="form-select">
                            <option value="pending">Pendiente</option>
                            <option value="paid">Pagado</option>
                        </select>
                    </div>
                    <div class="my-3">
                        <label for="">Documento de Pago</label>
                        <input type="text" class="form-control" id="payment_document">
                    </div>
                    <div class="my-3">
                        <label for="">Vencimiento</label>
                        <input type="date" name="due_date" id="due_date" class="form-control">
                    </div>
                    <div class="my-3 text-end">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.panel>
