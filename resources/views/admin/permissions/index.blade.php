@extends('layouts.main',['name' => 'home'])

@section('content')
<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                    @can('permission.index')
                    <li class="nav-item">
                        <a class="nav-link active" href="{!! route('permission.index') !!}"><i
                                class="fa fa-list mr-2"></i>{{__('Permission List')}}</a>
                    </li>
                    @endcan
                    @can('permission.create')
                    <li class="nav-item">
                        <a class="nav-link" href="{!! route('permission.create') !!}"><i
                                class="fa fa-plus mr-2"></i>{{__('Create')}}</a>
                    </li>
                    @endcan
                </ul>
            </div>
            <div class="card-body table-responsive">
                <table class="table text-center" id="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            @foreach ($role as $item)
                            <th>{{$item->name}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permission as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            @foreach ($role as $roles)
                            <form action="{{route('permission.give')}}" method="post">
                                @csrf
                                <td>
                                    <input type="hidden" name="permission" value="{{$item->id}}">
                                    <input type="hidden" name="roles" value="{{$roles->id}}">
                                    <input type="checkbox" class="form-check-input" name="role" value="{{$roles->id}}"
                                        onchange="event.preventDefault();ajaxPermission(this.form);" 
                                        @if($roles->hasPermissionTo($item->name)) checked @endif>
                                </td>
                            </form>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div id="loading" class="d-none"
            style="position: fixed; top: 50%; left: 50%; z-index: 5000; transform: translate(-50%, -50%);">
            <img src="http://aps.schoolapp.info/image/driver/800.gif">
        </div>
    </div>
</div>
@stop

@section('script')
<script>
    function ajaxPermission(form) {
        $.ajax({
            type: $(form).attr('method'),
            url: $(form).attr('action'),
            data: $(form).serializeArray(),
            beforeSend: function () {
                $("#loading").removeClass('d-none');
            },
            complete: function () {
                $("#loading").addClass('d-none');
            },
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.error(error);
            }
        });
    }
</script>
@stop