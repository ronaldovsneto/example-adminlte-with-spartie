@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="row justify-content-md-center">
        <div class="col-8 align-self-center">
            <form class="form-horizontal" action="#" method="POST">
                {!! method_field('PUT') !!}
                {!! csrf_field() !!}
                <div class="form-group">
                    <label class="control-label" for="name">Name</label>
                    <input type="text" class="form-control form-control-sm" id="name"
                           name="name" value="{{ $data->name }}" required>
                    @if($errors->has('name'))
                        <p class="text-danger">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                    <br/>
                    <label class="control-label" for="email">E-mail</label>
                    <input type="text" class="form-control form-control-sm" id="email"
                           name="email" value="{{ $data->email }}" required>
                    @if($errors->has('email'))
                        <p class="text-danger">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                    <br/>
                    <label class="control-label" for="role">Role</label>
                    <select class="form-control form-control-sm select2" name="role" id="role">
                        @foreach(\Spatie\Permission\Models\Role::all()->sortBy("name") as $role)
                                <option value="{{ $role->id }}" {!! $data->hasRole($role->name) ? "checked" : "" !!}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>
@stop
@push('js')
    <script>
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('users.index') !!}',
                hover: true,
                columns: [
                    { data: 'actions', name: 'actions', orderable: false, searchable: false, className: 'text-center', targets: '_all'},
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' }
                ],
                order: [[1, "asc"]],
                "oLanguage": {
                    "sProcessing": "Buscando as informações",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "Não foram encontrados resultados",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando de 0 até 0 de 0 registros",
                    "sInfoFiltered": "",
                    "sInfoPostFix": "",
                    "sSearch": "Procurar:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "Primeiro",
                        "sPrevious": "Anterior",
                        "sNext": "Seguinte",
                        "sLast": "Último"
                    },
                    "responsive": true,
                },
            });
        });
    </script>
@endpush
