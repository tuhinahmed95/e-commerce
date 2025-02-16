@extends('layouts.admin')
@section('content')
@can('user_access')
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-heder">
                    <h3>User List</h3>
                </div>
                <div class="card-body">
                    @if(session('delete'))
                        <div class="alert alert-success">{{ session('delete') }}</div>
                    @else

                    @endif
                    <table class="table table-bordered">
                        <tr>
                            <th>Sl</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($users as $sl => $user)
                        <tr>
                            <td>{{ $sl+1 }}</td>
                            <td>
                            @if($user->photo == null)
                                <img src="public/uploads/user/static_image.webp" alt="">
                            @else
                            <img src="{{ asset('uploads/user') }}/{{$user->photo }}" alt="">
                            @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @can('user_delete')
                                <a href="{{ route('user.delete',$user->id) }}" class="btn btn-danger btn-icon">
                                    <i data-feather="trash"></i>
                                </a>
                                @endcan
                            </td>
                        </tr>

                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        @can('user_add')
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add New User</h3>
                </div>
                @if (session('success'))
                    <strong class="text-success">{{ session('success') }}</strong>
                @endif
                <div class="card-body">
                    <form action="{{ route('user.add') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control">
                            @error('name')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control">
                            @error('email')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control">
                            @error('password')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                            @error('password_confirmation')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror

                            @if(session('match'))
                            <strong class="text-danger">{{ session('match') }}</strong>
                            @endif
                        </div>
                        <button class="btn btn-success">Add New</button>
                    </form>
                </div>
            </div>
        </div>
        @else
            <h3 class="text-light"> You dont have access to the user</h3>
        @endcan
    </div>
@else
 <h3 class="text-warning">You Dont Have Access This Pages</h3>
@endcan
@endsection
