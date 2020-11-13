@extends('layouts.main',['name' => 'home'])
@section('content')
    <div class="row">
        @can('files.index')
        <div class="col-12 col-sm-6 col-md-3">
            <a class="link-info-box" href="{{route('files.index')}}">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="far fa-file-excel"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">@lang('admin.files')</span>
                        <span class="info-box-number">{{\App\Models\File::count()}}</span>
                    </div>
                </div>
            </a>
        </div>
        @endcan
    </div>
@endsection
