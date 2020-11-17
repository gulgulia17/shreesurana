@extends('layouts.main',['name' => 'home'])
@section('content')
    <div class="card">
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>
@endsection
@section('script')
    {{ $dataTable->scripts() }}
@endsection
