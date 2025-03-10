@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h1>Contact List</h1>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($contacts as $key => $contact)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->address }}</td>
                            <td class="d-flex">
                                <a href="{{ route('general.contact.edit',$contact->id) }}" class="mr-1"><i class="fa fa-pencil btn btn-warning"></i></a>
                                <form action="{{ route('general.contact.delete',$contact->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h1>Add Contact</h1>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="card-body">
                    <form action="{{ route('general.contact.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control">
                            @error('email')
                             <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Phone</label>
                            <input type="number" name="phone" class="form-control">
                            @error('phone')
                             <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Address</label>
                            <input type="text" name="address" class="form-control">
                            @error('address')
                             <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                           <button type="submit" class="btn btn-primary">Add Contact</button>
                        </div>
                    </form>
                </div>
            </div>

            
        </div>
    </div>
@endsection
