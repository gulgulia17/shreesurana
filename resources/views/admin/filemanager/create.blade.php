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
                    @if (session('data'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>
                            <ul>
                                @foreach (session('data') as $item)
                                    <li>{{$item}}</li>
                                @endforeach
                            </ul>
                        </strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <form action={{route('files.store')}} enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required>
                            @error('name') {{$message}} @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                rows="3">{{ old('description') }}</textarea>
                                @error('description') {{$message}} @enderror
                        </div>
                        <div class="form-group">
                            <label for="file">Choose Excle only</label>
                            <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror" required>
                            @error('file') {{$message}} @enderror
                        </div>
                        <div class="form-group">
                            <label for="extracted">Upload and extract</label><br>
                            <input type="checkbox" name="extracted" id="extracted" checked data-bootstrap-switch data-on-color="success" value="1">
                        </div>
                        <button class="btn btn-primary btn-sm w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('assets/js/bootstrap-switch.js')}}"></script>
    <script>
        $(function () {
            $("input[data-bootstrap-switch]").each(function(){
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });
        });
    </script>
@endsection