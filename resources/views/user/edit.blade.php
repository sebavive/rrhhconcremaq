<x-layouts.panel>

    <div class="row">
        <div class="col-8">
            <h2>Editar Usuario</h2>
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
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="card col-11 col-md-6">
            <div class="card-body">
                <form action="{{ route('user.update',$user) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="my-3">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control form-control-sm" id="name" name="name" value="{{$user->name}}">
                        <input type="hidden" name="id" value="{{$user->id}}">
                    </div>
                    <div class="my-3">
                        <label for="">Email</label>
                        <input type="email" class="form-control form-control-sm" id="email" name="email" value="{{$user->email}}">
                    </div>
                    @if(auth()->user()->role == 'admin')
                        <div class="my-3">
                            <label for="">Role</label>
                            <select name="role" id="role" class="form-select">
                                <option value="admin" {{$user->role == 'admin' ? "selected":""}}>Administrador</option>
                                <option value="user" {{$user->role == 'user' ? "selected":""}}>Usuario</option>
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
            function verPass() {
                var x = document.getElementById("password");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
            $("#btnEliminar").click(function(){
                if(confirm("¿Está seguro de eliminar este registro?")){
                    $.ajax({
                        url: "{{ route('user.destroy', $user) }}",
                        type: "POST",
                        data: {
                            _method: "DELETE",
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response){
                            alert(response)
                            window.location.href = "{{ route('user.index') }}";
                        }
                    });
                }
            })
        </script>
    @endsection
</x-layouts.panel>
