@extends('layouts.admin')
@section('content')
    <div class="row">

        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h2>General Setting & Logo Update</h2>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('general.logo') }}" class="btn btn-primary mr-3 p-2">General Logo Manage</a>
                </div>
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                <div class="card-body">
                    <form action="{{ route('general.logo.update',$general->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Header Logo</label>
                            <input type="file" name="header_logo" class="form-control">
                            <img width="70" src="{{ asset($general->header_logo) }}" alt="">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Footer Logo</label>
                            <input type="file" name="footer_logo" class="form-control">
                            <img width="70" src="{{ asset($general->footer_logo) }}" alt="">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update Logo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

