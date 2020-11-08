@extends('layouts.main',['name' => 'home'])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                        {{-- @can('files.index') --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{!!  route('files.index') !!}">
                                <i class="fa fa-list mr-2"></i>{{ __('Files List') }}</a>
                        </li>
                        {{-- @endcan --}}
                        {{-- @can('files.create') --}}
                        <li class="nav-item">
                            <a class="nav-link active" href="{!!  route('files.create') !!}">
                                <i class="fa fa-plus mr-2"></i>{{ __('Create') }}</a>
                        </li>
                        {{-- @endcan --}}
                    </ul>
                </div>
                <div class="card-body">
                    <form action={{route('files.store')}} enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description"
                                rows="3">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="file">Choose Excle only</label>
                            <input type="file" name="file" id="file" class="form-control" required>
                        </div>
                        <button class="btn btn-primary btn-sm w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
