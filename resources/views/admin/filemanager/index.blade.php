@extends('layouts.main',['name' => 'home'])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                        @can('files.index')
                            <li class="nav-item">
                                <a class="nav-link active" href="{!!  route('files.index') !!}">
                                    <i class="fa fa-list mr-2"></i>{{ __('Files List') }}
                                </a>
                            </li>
                        @endcan
                        @can('files.create')
                            <li class="nav-item">
                                <a class="nav-link" href="{!!  route('files.create') !!}">
                                    <i class="fa fa-plus mr-2"></i>{{ __('Create') }}
                                </a>
                            </li>
                        @endcan
                        <div class="ml-auto d-inline-flex">
                            <li class="nav-item">
                                <select name="company_id" class="form-control nav-link active" id="company-search"
                                    data-column="3">
                                    <option value="">Please select a company</option>
                                    @foreach (\App\Models\Company::all() as $companies)
                                        <option value="{{ $companies->id }}">{{ $companies->name }}</option>
                                    @endforeach
                                </select>
                            </li>
                        </div>
                    </ul>
                </div>
                <div class="card-body table-responsive">
                    {{ $dataTable->table() }}
                    <div class="modal fade" id="files-attach-modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body text-left">
                                    <form action="" method="post" id="file-attach-form">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="total">Total Data</label>
                                                    <input class="form-control total" type="number" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="start">From</label>
                                                    <input id="start" name="start" class="form-control" type="number"
                                                        value="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="end">To</label>
                                                    <input id="end" name="end" class="form-control" type="number" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="user">Choose user</label>
                                                    <input class="form-control total" type="number" value="0" name="total"
                                                        hidden>
                                                    <select class="form-control" name="user" id="user">
                                                        <option value="">Please choose the user you want to attach</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-sm btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{ $dataTable->scripts() }}
    <script>
        $('#company-search').change(function(e) {
            e.preventDefault();
            window.LaravelDataTables["files-table"].column($(this).data('column'))
                .search($(this).val()).draw();
        });

    </script>
@endsection
