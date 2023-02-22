<x-layouts.panel>

    <div class="row">
        <div class="col-8">
            <h2>Nuevo Proyecto</h2>
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
    <div class="row justify-content-center">
        <div class="card col-11 col-md-6">
            <div class="card-body">
                <form action="{{ route('proyect.store') }}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="my-3">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control form-control-sm" id="name" name="name">
                    </div>
                    <div class="my-3">
                        <label for="">Descripcion</label>
                        <input type="text" class="form-control form-control-sm" id="description" name="description">
                    </div>
                    <div class="my-3">
                        <label for="">Estado</label>
                        <select name="status" id="status" class="form-select">
                            <option value="active">En proceso</option>
                            <option value="finish">Finalizado</option>
                        </select>
                    </div>
                    <div class="my-3 text-end">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.panel>
