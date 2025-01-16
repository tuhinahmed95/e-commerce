@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Update Profile Info</h6>

                @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>

                @endif

                <form action="{{ route('user.info.update') }}" class="form-sample" method="POST">
                    @csrf
                    <div class="fomr-group">
                        <label for="exampleInputName">User Name</label>
                        <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                    </div>

                    <div class="fomr-group">
                        <label for="exampleInputEmail">User Email</label>
                        <input type="text" class="form-control" name="email" value="{{ Auth::user()->email }}">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Update</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title"> Profile Info</h6>

                <form action="{{ route('user.info.update') }}" class="form-sample" method="POST">
                    @csrf
                    <div class="fomr-group">
                        <label for="exampleInputName">Current Password</label>
                        <input type="password" class="form-control" name="current_password">
                    </div>

                    <div class="fomr-group">
                        <label for="exampleInputName">New Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>

                    <div class="fomr-group">
                        <label for="exampleInputName">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
