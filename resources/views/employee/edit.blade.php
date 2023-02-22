<x-layouts.panel>
    <div class="row">
        <div class="col-8">
            <h2>Editar Obrero</h2>
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
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="card col-11 col-md-6">
            <div class="card-body">
                <form action="{{route('employee.update',$employee)}}" method="POST">
                    @csrf
                    <div class="my-2">
                        <label for="name">Nombre</label>
                        <input type="text" id="name" class="form-control form-control-sm" name="name" value="{{isset($employee) ? $employee->name : old('name')}}">
                    </div>
                    <div class="my-2">
                        <label for="letal_id">Documento</label>
                        <input type="text" id="legal_id" class="form-control form-control-sm" name="legal_id" value="{{isset($employee) ? $employee->legal_id : old('legal_id')}}">
                    </div>
                    <div class="my-2">
                        <label for="email">Email</label>
                        <input type="text" id="email" class="form-control form-control-sm" name="email" value="{{isset($employee) ? $employee->email : old('email')}}">
                    </div>
                    <div class="my-2">
                        <label for="phone">Teléfono</label>
                        <input type="text" id="phone" class="form-control form-control-sm" name="phone" value="{{isset($employee) ? $employee->phone : old('phone')}}">
                    </div>
                    <div class="my-2">
                        <label for="address">Dirección</label>
                        <input type="text" id="address" class="form-control form-control-sm" name="address" value="{{isset($employee) ? $employee->address : old('address')}}">
                    </div>
                    <div class="my-2">
                        <label for="position">Cargo</label>
                        <input type="text" id="position" class="form-control form-control-sm" name="position" value="{{isset($employee) ? $employee->position : old('position')}}">
                    </div>
                    <hr>
                    <div class="my-3 row">
                        <div class="col text-start">
                            <button class="btn btn-danger" type="button" onclick="eliminarRegistro()">Eliminar</button>
                        </div>
                        <div class="col text-end">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card col-11 col-md-5">
            <div class="card-body">
                <h2>Nomina</h2>
                @php $form_action = isset($payroll) ? route('payroll.update',$payroll) : route('payroll.store') @endphp
                <form action="{{$form_action}}" method="POST">
                    @csrf
                    @if(isset($payroll))
                        @method('PUT')
                    @endif
                    <div class="my-3">
                        <label for="">Seguro N°</label>
                        <input type="text" id="insurance_number" class="form-control form-control-sm" name="insurance_number" value="{{$payroll ? $payroll->insurance_number : ""}}">
                        <input type="hidden" value="{{$employee->id}}" name="employee_id">
                    </div>
                    <div class="my-3">
                        <label for="">Periodo de pago</label>
                        <select name="pay_period" id="pay_period" class="form-select form-select-sm">
                            <option value="daily" {{$payroll ? $payroll->pay_period=="daily" ? "selected" : "" : ""}}>Diario</option>
                            <option value="weekly" {{$payroll ? $payroll->pay_period=="weekly" ? "selected" : "" : ""}}>Semanal</option>
                            <option value="monthly" {{$payroll ? $payroll->pay_period=="monthly" ? "selected" : "" : ""}}>Mensual</option>
                            <option value="piecework" {{$payroll ? $payroll->pay_period=="piecework" ? "selected" : "" : ""}}>A destajo</option>
                        </select>
                    </div>
                    <div class="my-3">
                        <label for="">Tipo de Pago</label>
                        <select name="pay_type" id="pay_type" class="form-select form-select-sm">
                            <option value="hourly" {{$payroll ? $payroll->pay_type=="hourly" ? "selected" : "" : ""}}>Hora</option>
                            <option value="daily" {{$payroll ? $payroll->pay_type=="daily" ? "selected" : "" : ""}}>Día</option>
                            <option value="monthly" {{$payroll ? $payroll->pay_type=="monthly" ? "selected" : "" : ""}}>Mes</option>
                            <option value="piecework" {{$payroll ? $payroll->pay_type=="piecework" ? "selected" : "" : ""}}>A destajo</option>
                        </select>
                    </div>
                    <div class="my-3">
                        <label for="">Salario</label>
                        <input type="text" id="pay_rate" class="form-control form-control-sm" name="pay_rate" value="{{$payroll->pay_rate ?? "0"}}">
                    </div>
                    <div class="my-3 row">
                        <div class="col text-end">
                            <button class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            function eliminarRegistro() {
                confirmar = confirm("¿Está seguro de eliminar el registro?");
                if(confirmar){
                    $.ajax({
                        url: "{{route('employee.destroy',$employee)}}",
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(result) {
                            alert(result)
                            window.location.href = "{{route('employee.index')}}";
                        }
                    })
                }
            }
        </script>
    @endsection

</x-layouts.panel>
