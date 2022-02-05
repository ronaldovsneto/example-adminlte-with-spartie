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
                </div>
                <div class="form-group">
                    <label class="control-label" for="guard_name">Guard Name</label>
                    <input type="text" class="form-control form-control-sm" id="guard_name"
                           name="name" value="{{ $data->guard_name }}" required>
                    @if($errors->has('guard_name'))
                        <p class="text-danger">
                            {{ $errors->first('guard_name') }}
                        </p>
                    @endif
                    <br/>
                </div>
                <hr/>
                <h3>Permissions</h3>
                <hr/>


                <select class="duallistbox" multiple="multiple" size="10" name="permissions[]" title="permissions[]">
                    <option value="option1">Option 1</option>
                    <option value="option2">Option 2</option>
                    <option value="option3" selected="selected">Option 3</option>
                    <option value="option4">Option 4</option>
                    <option value="option5">Option 5</option>
                    <option value="option6" selected="selected">Option 6</option>
                    <option value="option7">Option 7</option>
                    <option value="option8">Option 8</option>
                    <option value="option9">Option 9</option>
                    <option value="option0">Option 10</option>
                </select>


            </form>
        </div>
    </div>
@stop
@push('js')
    <script>
        $(function(){

        });
    </script>
@endpush
