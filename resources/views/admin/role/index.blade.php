@extends('layouts.main',['name' => 'home'])
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                    @can('role.index')
                    <li class="nav-item">
                        <a class="nav-link active" href="{!! route('role.index') !!}"><i class="fa fa-list mr-2"></i>{{__('Role List')}}</a>
                    </li>
                    @endcan
                    @can('role.create')
                    <li class="nav-item">
                        <a class="nav-link" href="{!! route('role.create') !!}"><i class="fa fa-plus mr-2"></i>{{__('Create')}}</a>
                    </li>
                    @endcan
                </ul>
            </div>
            <div class="card-body table-responsive">
                <table class="table text-center" id="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Permission Name</th>
                            <th>Guard Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($role as $key => $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->guard_name}}</td>
                            <td>
                                <a href="{{route('role.edit',$item->id)}}" class="text-warning"><i class="fas fa-pencil-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop