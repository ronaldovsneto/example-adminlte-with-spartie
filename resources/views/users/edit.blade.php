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

        });
    </script>
@endpush
