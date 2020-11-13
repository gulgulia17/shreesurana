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
    <script>
        function deleteData(event, param) {
            event.preventDefault();
            if (!confirm(`Are your sure?`)) {
                return false;
            }
            $(`#${$(param).data(`id`)}`).submit();
        }
    </script>
@endsection
