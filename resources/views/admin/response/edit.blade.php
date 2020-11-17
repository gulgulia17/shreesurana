@extends('layouts.main',['name' => 'home'])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                        @can('response.index')
                        <li class="nav-item">
                            <a class="nav-link" href="{!!  route('response.index') !!}">
                                <i class="fa fa-list mr-2"></i>{{ __('Response List') }}</a>
                        </li>
                        @endcan
                        @can('response.create')
                        <li class="nav-item">
                            <a class="nav-link" href="{!!  route('response.create') !!}">
                                <i class="fa fa-plus mr-2"></i>{{ __('Create') }}</a>
                        </li>
                        @endcan
                        @can('response.edit')
                        <li class="nav-item">
                            <a class="nav-link active" href="{!!  route('response.edit', $response->id) !!}">
                                <i class="fa fa-pencil-alt mr-2"></i>{{ __('Edit') }}</a>
                        </li>
                        @endcan
                    </ul>
                </div>
                <div class="card-body">
                    <form action="{{ route('response.update', $response->id) }}" method="post">
                        @csrf @method('patch')
                        @include('admin.response.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
