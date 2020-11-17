@extends('layouts.main',['name' => 'home'])
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    @foreach ($errors->all() as $error)
                        <span class="d-block">{{ $error }}</span>
                    @endforeach
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fa fa-list mr-2"></i>{{ __('Pending Leads List') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body table-responsive">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Number</th>
                                <th>Previous Response</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leads ?? [] as $lead)
                                <tr>
                                    <td>{{ $lead->data->name }}</td>
                                    <td>{{ $lead->data->number }}</td>
                                    <td>{{ $lead->remark }}</td>
                                    <td>@include('pages.leads.action',['data'=>$lead->data,'responses' => \App\Models\Response::all()])</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
