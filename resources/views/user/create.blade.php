<x-layouts.panel>

    <div class="row">
        <div class="col-8">
            <h2>Nuevo Usuario</h2>
        </div>
        <div class="col-4 text-end">
            <a href="{{ route('user.index') }}" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Volver</a>
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
                <form action="{{ route('user.store') }}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="my-3">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control form-control-sm" id="name" name="name">
                    </div>
                    <div class="my-3">
                        <label for="">Email</label>
                        <input type="email" class="form-control form-control-sm" id="email" name="email">
                    </div>
                    @if(auth()->user()->role == 'admin')
                    <div class="my-3">
                        <label for="">Role</label>
                        <select name="role" id="role" class="form-select">
                            <option value="admin">Administrador</option>
                            <option value="user">Usuario</option>
                        </select>
                    </div>
                    @endif
                    <h2>Seguridad</h2>
                    <div class="my-3">
                        <div class="input-group">
                            <span class="input-group-text" onclick="verPass()"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-custom-class="custom-tooltip"
                                data-bs-title="Precione para ver el texto"
                            ><i class="fas fa-lock"></i></span>
                            <div class="form-floating">
                                <input type="password" class="form-control" id="password" placeholder="Contraseña" name="password">
                                <label for="">Contraseña</label>
                            </div>
                        </div>
                    </div>
                    <div class="my-3 text-end">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            function verPass() {
                var x = document.getElementById("password");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>
    @endsection
</x-layouts.panel>
