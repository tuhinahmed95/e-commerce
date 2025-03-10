@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h1>Update Contact</h1>
                </div>
                @if (session('sucess_update'))
                <div class="alert alert-success">{{ session('sucess_update') }}</div>
                @endif
                <div class="card-body">
                    <form action="{{ route('general.contact.update',$contact->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $contact->email }}">
                            @error('email')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Phone</label>
                            <input type="number" name="phone" class="form-control" value="{{ $contact->phone }}">
                            @error('phone')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" value="{{ $contact->address }}">
                            @error('address')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update Contact</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
