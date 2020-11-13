@extends('layouts.main',['name' => 'home'])
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="card-title">{{ $data->name }}'s Details</div>
        </div>
        <div class="card-body">
            <form action="" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name"
                        value="{{ $data->name }}">
                </div>
                <div class="form-group">
                    <label for="number">Number</label>
                    <input type="tel" name="number" id="number" class="form-control" placeholder="Number"
                        value="{{ $data->number }}">
                </div>
                <button class="btn btn-primary w-100">Update</button>
            </form>
        </div>
    </div>
@endsection
