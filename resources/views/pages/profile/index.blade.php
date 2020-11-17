@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center">{{ $user->name }}</h3>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Username</b> <a class="float-right">{{ $user->username }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Number</b> <a class="float-right">{{ $user->number }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Role</b> <a class="float-right">
                                @foreach ($user->roles->pluck('name') ?? [] as $item)
                                    <span class="badge badge-primary">{{ $item }}</span>
                                @endforeach
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Password</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="profile">
                            <form class="form-horizontal" method="POST" action="{{ route('profile.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" placeholder="Name" name="name" value="{{ $user->name ?? '' }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="username" placeholder="Username"
                                            disabled value="{{ $user->username ?? '' }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" placeholder="Email" disabled
                                            value="{{ $user->email ?? '' }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="number" class="col-sm-2 col-form-label">Number</label>
                                    <div class="col-sm-10">
                                        <input type="tel" class="form-control @error('number') is-invalid @enderror"
                                            id="number" placeholder="Number" name="number"
                                            value="{{ $user->number ?? '' }}">
                                        @error('number')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="role" class="col-sm-2 col-form-label">Role</label>
                                    <div class="col-sm-10">
                                        <span class="form-control disabled">
                                            @foreach ($user->roles->pluck('name') ?? [] as $item)
                                                <span class="badge badge-primary">{{ $item }}</span>
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="password">
                            <form class="form-horizontal" method="POST" action="{{ route('user.password.update') }}">
                                @csrf @method('patch')
                                <div class="form-group row">
                                    <label for="old_password" class="col-sm-2 col-form-label">Old Password</label>
                                    <div class="col-sm-10">
                                        <input type="password"
                                            class="form-control @error('old_password') is-invalid @enderror"
                                            name="old_password" id="old_password" placeholder="Old Password">
                                        @error('old_password')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" id="password" placeholder="New Password">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password_confirmation" class="col-sm-2 col-form-label">Confirm
                                        Password</label>
                                    <div class="col-sm-10">
                                        <input type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation" id="password_confirmation"
                                            placeholder="Confirm Password">
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-info">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $.each($(".tab-content").find('.is-invalid'), function(index, value) {
            $(".tab-content").children('.tab-pane').removeClass('active');
            $(this).closest('.tab-pane').addClass('active');
            let id = `#${$(this).closest('.tab-pane').attr('id')}`;
            $('.nav-tabs').children('li').each(function(index, element) {
                $(this).children('a').removeClass('active');
                console.log(id, $(this).children('a').attr('href'));
                if (id === $(this).children('a').attr('href')) {
                    $(this).children('a').addClass('active');
                }
            });
        });

    </script>
@endsection
