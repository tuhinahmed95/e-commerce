@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>User List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>User</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($users as  $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td class="text-wrap">
                            @forelse ($user->getRoleNames() as $role)
                            <span class="badge badge-primary my-1">{{ $role }}</span>
                            @empty
                                <span class="bg-warning p-1">Not Assigned</span>
                            @endforelse
                        </td>
                        @can('user_access')
                        <td>
                            <a href="{{ route('remove.role',$user->id) }}" class="btn btn-danger">Remove Role</a>
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header">
                <h3>Role List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Role</th>
                        <th>Permissions</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($roles as  $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td class="text-wrap">
                            @foreach ($role->getPermissionNames() as $permission)
                            <span class="badge badge-primary my-1">{{ $permission }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('role.edit',$role->id) }}" class="btn btn-warning">Edit</a>
                            <a href="{{ route('role.delete',$role->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Roll Manage</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('permission.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Permission Name</label>
                        <input type="text" name="permission_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add Permission</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Add roll form  --}}
        <div class="card">
            <div class="card-header">
                <h3>Add New Role</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('role.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Roll Name</label>
                        <input type="text" name="roll_name" class="form-control">
                    </div>

                    <div class="mb-3">
                        @foreach ($permissions as $permission)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="permission[]" class="form-check-input" id="per{{ $permission->id }}" value="{{ $permission->name }}">
                                <label class="form-check-label ml-0" for="per{{ $permission->id }}">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add Roll</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Assign role form  --}}
        <div class="card">
            <div class="card-header">
                <h3>Assign Role</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('assign.role') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <select name="user_id" class="form-control">
                            <option value="">Select User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <select name="role" class="form-control">
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Assign Roll</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
