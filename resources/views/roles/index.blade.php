@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <table class="table tbl table-bordered table-hover table-striped nowrap" style="width: 100%"id="users-table">
                <thead>
                <tr>
                    <th>Actions</th>
                    <th>Name</th>
                    <th>Guard</th>
                    <th>Permissions</th>
                    <th>Module</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@stop
@push('js')
    <script>
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('roles.index') !!}',
                hover: true,
                columns: [
                    { data: 'actions', name: 'actions', orderable: false, searchable: false, className: 'text-center', targets: '_all'},
                    { data: 'name', name: 'name' },
                    { data: 'guard_name', name: 'guard_name' },
                    { data: 'permissions', name: 'permissions' },
                    { data: 'module', name: 'module' },
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
