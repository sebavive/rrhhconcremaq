<x-layouts.panel>

    <div class="row">
        <div class="col-8">
            <h2>Adelantos</h2>
        </div>
        <div class="col-4 text-end">
            <a href="{{route('salary-advances.create')}}" class="btn btn-secondary">Nuevo</a>
        </div>
    </div>
    <hr>

    <div class="row mt-3">
        <div class="card col-12">
            <div class="card-body">
                <table class="table table-sm table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Obrero</th>
                            <th>Documento</th>
                            <th>Venc</th>
                            <th>Importe</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salaryAdvances as $advance)
                            <tr>
                                <td>{{ $advance->employees->name }}</td>
                                <td>{{ $advance->employees->payment_document }}</td>
                                <td>{{ date_format(date_create($advance->due_date),'d-m-Y') }}</td>
                                <td>{{ number_format($advance->amount) }}</td>
                                <td><span class="badge bg-{{$advance->status == 'pending' ? 'danger' : 'success'}}">{{$advance->status == 'pending' ? 'Pendiente':'Pagado'}}</span></td>
                                <td>
                                    <a href="{{ route('salary-advances.edit', $advance->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
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
                $('.table').DataTable({
                    dom:'Qfrtip',
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                    },
                    searchBuilder:true,
                    "columnDefs": [{
                        "orderable": false,
                        "targets": 3
                    }],
                });
            });
        </script>
    @endsection
</x-layouts.panel>
