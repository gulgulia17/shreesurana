@extends('layouts.main',['name' => 'home'])
@section('content')
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                @can('company.index')
                    <li class="nav-item">
                        <a class="nav-link" href="{!!  route('company.index') !!}">
                            <i class="fa fa-list mr-2"></i>{{ __('Company List') }}
                        </a>
                    </li>
                @endcan
                @can('company.create')
                    <li class="nav-item">
                        <a class="nav-link active" href="{!!  route('company.create') !!}">
                            <i class="fa fa-plus mr-2"></i>{{ __('Create') }}
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
        <div class="card-body">
            <form action="{{ route('company.store') }}" method="post">
                @csrf
                @include('admin.company.form')
            </form>
        </div>
    </div>
@endsection
@section('script')
@endsection
