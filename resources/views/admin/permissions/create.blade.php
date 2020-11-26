@extends('layouts.main',['name' => 'home'])
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                    @can('permission.index')
                    <li class="nav-item">
                        <a class="nav-link" href="{!! route('permission.index') !!}"><i
                                class="fa fa-list mr-2"></i>{{__('Permission List')}}</a>
                    </li>
                    @endcan
                    @can('permission.create')
                    <li class="nav-item">
                        <a class="nav-link active" href="{!! route('permission.create') !!}"><i
                                class="fa fa-plus mr-2"></i>{{__('Create')}}</a>
                    </li>
                    @endcan
                </ul>
            </div>
            <div class="card-body table-responsive">
                <form action="{{route('permission.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Permission Name</label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" placeholder="Enter Permission Name"
                            value="{{old('name')}}">
                        @error('name')
                        <div class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group d-none">
                        <label for="guard_name">Permission Middleware</label>
                        <input type="text" name="guard_name" id="guard_name" hidden
                            class="form-control @error('guard_name') is-invalid @enderror"
                            placeholder="Enter Permission Middleware Name" value="{{old('guard_name') ?? 'web'}}">
                        @error('guard_name')
                        <div class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </div>
                        @enderror
                    </div>
                    
                    <button class="btn btn-primary w-100 btn-lg">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop