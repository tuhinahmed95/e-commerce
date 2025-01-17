@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-heder">
                <h3>User List</h3>
            </div>
            <div class="card-body">
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
                            <img src="{{ asset('uploads/user') }}/{{$user->photo }}" alt="">
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            {{-- <a href=""><i class="fa fa-pencil bg-success fw-1"></i></a>
                            <a href=""><i class="fa fa-trash"></i></a> --}}
                            <button class="btn btn-danger btn-icon">
                                <i data-feather="trash"></i>
                            </button>
                        </td>
                    </tr>

                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
