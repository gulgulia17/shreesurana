@extends('layouts.main',['name' => 'home'])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                        @can('user.index')
                        <li class="nav-item">
                            <a class="nav-link active" href="{!! route('user.index') !!}"><i
                                    class="fa fa-list mr-2"></i>{{__('User List')}}</a>
                        </li>
                        @endcan
                        @can('user.create')
                        <li class="nav-item">
                            <a class="nav-link" href="{!! route('user.create') !!}"><i
                                    class="fa fa-plus mr-2"></i>{{__('Create')}}</a>
                        </li>
                        @endcan
                    </ul>
                </div>
                <div class="card-body table-responsive">
                    <table class="table text-center" id="table">
                        <thead>
                            <tr>
                                <th class="w-25 text-left">User Name</th>
                                @foreach ($roles as $role)
                                <th>{{$role->name}}</th>
                                @endforeach
                                <th>Number</th>
                                <th>Login</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $srn => $user)
                            <tr>
                                <td  class="w-25 text-left">{{$user->name}}</td>
                                @foreach ($roles as $role)
                                <td>
                                    <form method="post">
                                        @csrf
                                        <input type="hidden" name="user" value="{{$user->id}}">
                                        <input type="hidden" name="roles" value="{{$role->id}}">
                                        <input type="checkbox" onchange="submit();" class="form-check-input" name="role" value="{{$role->id}}" @if ($user->hasRole($role)) checked @endif>
                                    </form>
                                </td>
                                @endforeach
                                <td>{{$user->number ?? 'Not Available'}}</td>
                                <td>
                                    <a href="{{route('user.show',$user->id)}}"><i class="fa fa-key" aria-hidden="true"></i></a>
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
