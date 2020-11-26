@extends('layouts.main',['name' => 'home'])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                        @can('files.index')
                            <li class="nav-item">
                                <a class="nav-link" href="{!!  route('files.index') !!}">
                                    <i class="fa fa-list mr-2"></i>{{ __('Files List') }}</a>
                            </li>
                        @endcan
                        @can('files.create')
                            <li class="nav-item">
                                <a class="nav-link" href="{!!  route('files.create') !!}">
                                    <i class="fa fa-plus mr-2"></i>{{ __('Create') }}</a>
                            </li>
                        @endcan
                        @can('files.edit')
                            <li class="nav-item">
                                <a class="nav-link active" href="{!!  route('files.edit', $file->id) !!}">
                                    <i class="fas fa-pencil-alt mr-2"></i>{{ __('Edit') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
                <div class="card-body">
                    @if (session('data'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>
                                <ul>
                                    @foreach (session('data') as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form action={{ route('files.update', $file->id) }} enctype="multipart/form-data" method="post">
                        @csrf @method('patch')
                        @include('admin.filemanager.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
