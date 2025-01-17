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

                <form method="POST" action="{{ route('user.info.update') }}" class="form-sample" >
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
    {{-- passwor section --}}
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title"> Password Update</h6>
                @if (session('success'))
                    <div class="alert alert-success">{{session('success')  }}</div>
                @endif
                <form method="POST" action="{{ route('password_update') }}" class="form-sample" >
                    @csrf
                    <div class="fomr-group">
                        <label for="exampleInputName">Current Password</label>
                        <input type="password" class="form-control" name="current_password">
                        @error('current_password')
                         <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="fomr-group">
                        <label for="exampleInputName">New Password</label>
                        <input type="password" class="form-control" name="password">
                        @error('password')
                         <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        @if (session('invalid'))
                        <div class="alert alert-danger">{{ session('invalid') }}</div>

                        @endif
                    </div>

                    <div class="fomr-group">
                        <label for="exampleInputName">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation">
                        @error('password_confirmation')
                        <strong class="text-danger">{{ $message }}</strong>

                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Update</button>
                </form>
            </div>
        </div>
    </div>

    {{-- image section --}}

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title"> Update Photo</h6>
                @if (session('photo'))
                    <div class="alert alert-success">{{session('photo')  }}</div>
                @endif
                <form method="POST" action="{{ route('photo.update') }}" class="form-sample" enctype="multipart/form-data">
                    @csrf
                    <div class="fomr-group">
                        <label for="exampleInputName">Upload Photo</label>
                        <input type="file" class="form-control" name="photo">
                        @error('photo')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-primary mt-2">Update</button>
                </form>
            </div>
        </div>
    </div>


</div>
@endsection
