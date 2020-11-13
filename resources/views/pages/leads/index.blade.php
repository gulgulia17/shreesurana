@extends('layouts.main',['name' => 'home'])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                        <li class="nav-item">
                            <a class="nav-link active" href="{!!  route('leads.index') !!}">
                                <i class="fa fa-list mr-2"></i>{{ __('Leads List') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body table-responsive">
                    {{$dataTable->table()}}
                </div>
            </div>
            
            
        </div>
    </div>
@endsection
@section('script')
{{$dataTable->scripts()}}
@endsection