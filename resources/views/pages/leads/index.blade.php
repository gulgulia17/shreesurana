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
                            <a class="nav-link active" href="{!!  route('leads.index') !!}">
                                <i class="fa fa-list mr-2"></i>{{ __('Leads List') }}
                            </a>
                        </li>
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
            window.LaravelDataTables["leads-table"].column($(this).data('column'))
                .search($(this).val()).draw();
        });

    </script>
@endsection
