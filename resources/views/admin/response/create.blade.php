@extends('layouts.main',['name' => 'home'])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                        {{-- @can('response.index') --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{!!  route('response.index') !!}">
                                <i class="fa fa-list mr-2"></i>{{ __('response List') }}</a>
                        </li>
                        {{-- @endcan --}}
                        {{-- @can('response.create') --}}
                        <li class="nav-item">
                            <a class="nav-link active" href="{!!  route('response.create') !!}">
                                <i class="fa fa-plus mr-2"></i>{{ __('Create') }}</a>
                        </li>
                        {{-- @endcan --}}
                    </ul>
                </div>
                <div class="card-body">
                    <form action="{{ route('response.store') }}" method="post">
                        @csrf
                        @include('admin.response.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
