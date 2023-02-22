<x-layouts.panel>
    <div class="row">
        <div class="col-8">
            <h2>Nuevo Obrero</h2>
        </div>
        <div class="col-4 text-end">
            <a href="{{route('employee.index')}}" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Volver</a>
        </div>
        <hr>
    </div>
    <div class="row justify-content-center">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card col-11 col-md-6">
            <div class="card-body">
                <form action="{{route('employee.store')}}" method="POST">
                    @csrf
                    <div class="my-2">
                        <label for="name">Nombre</label>
                        <input type="text" id="name" class="form-control form-control-sm" name="name" value="{{old('name')}}">
                    </div>
                    <div class="my-2">
                        <label for="letal_id">Documento</label>
                        <input type="text" id="legal_id" class="form-control form-control-sm" name="legal_id" value="{{old('legal_id')}}">
                    </div>
                    <div class="my-2">
                        <label for="email">Email</label>
                        <input type="text" id="email" class="form-control form-control-sm" name="email" value="{{old('email')}}">
                    </div>
                    <div class="my-2">
                        <label for="phone">Teléfono</label>
                        <input type="text" id="phone" class="form-control form-control-sm" name="phone" value="{{old('phone')}}">
                    </div>
                    <div class="my-2">
                        <label for="address">Dirección</label>
                        <input type="text" id="address" class="form-control form-control-sm" name="address" value="{{old('address')}}">
                    </div>
                    <div class="my-2">
                        <label for="position">Cargo</label>
                        <input type="text" id="position" class="form-control form-control-sm" name="position" value="{{old('position')}}">
                    </div>
                    <hr>
                    <div class="my-3 text-end">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-layouts.panel>
