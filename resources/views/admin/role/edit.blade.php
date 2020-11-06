@extends('layouts.main',['name' => 'home'])
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                    @can('role.index')
                    <li class="nav-item">
                        <a class="nav-link" href="{!! route('role.index') !!}"><i
                                class="fa fa-list mr-2"></i>{{__('Role List')}}</a>
                    </li>
                    @endcan
                    @can('role.create')
                    <li class="nav-item">
                        <a class="nav-link" href="{!! route('role.create') !!}"><i
                                class="fa fa-plus mr-2"></i>{{__('Create')}}</a>
                    </li>
                    @endcan
                    @can('role.edit')
                    <li class="nav-item">
                        <a class="nav-link active" href="{!! url()->current() !!}"><i
                                class="fas fa-pencil-alt mr-2"></i>{{__('Edit')}}</a>
                    </li>
                    @endcan
                </ul>
            </div>
            <div class="card-body table-responsive">
                <form action="{{route('role.update',$role->id)}}" method="post">
                    @csrf @method('patch')
                    <div class="form-group">
                        <label for="name">Role Name</label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Enter Role Name"
                            value="{{old('name') ?? $role->name}}">
                        @error('name')
                        <div class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="guard_name">Role Middleware</label>
                        <input type="text" name="guard_name" id="guard_name"
                            class="form-control @error('guard_name') is-invalid @enderror"
                            placeholder="Enter Role Guard Name" value="{{old('guard_name') ?? $role->guard_name}}">
                        @error('guard_name')
                        <div class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </div>
                        @enderror
                    </div>
                    <button class="btn btn-primary w-100 btn-lg">UPDATE</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop