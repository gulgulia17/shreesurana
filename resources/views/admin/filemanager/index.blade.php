@extends('layouts.main',['name' => 'home'])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                        {{-- @can('files.index') --}}
                        <li class="nav-item">
                            <a class="nav-link active" href="{!!  route('files.index') !!}">
                                <i class="fa fa-list mr-2"></i>{{ __('Files List') }}</a>
                        </li>
                        {{-- @endcan --}}
                        {{-- @can('files.create') --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{!!  route('files.create') !!}">
                                <i class="fa fa-plus mr-2"></i>{{ __('Create') }}</a>
                        </li>
                        {{-- @endcan --}}
                    </ul>
                </div>
                <div class="card-body table-responsive">
                    <table class="table text-center" id="table">
                        <thead>
                            <tr>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
