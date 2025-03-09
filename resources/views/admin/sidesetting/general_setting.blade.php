@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h2>General Setting & Logo List</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>HeaderLogo</th>
                                <th>FooterLogo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($generals as $key => $general)
                            <tr>
                                <td>{{$key+1  }}</td>
                                <td>
                                    <img src="{{ asset( $general->header_logo  )}}" alt="">
                                </td>
                                <td>
                                    <img src="{{ asset( $general->footer_logo )}}" alt="">
                                </td>
                                <td class="d-flex gap-1">
                                    <a href="{{ route('general.logo.edit',$general->id) }}" class="btn btn-warning mr-2"><i class="fa-solid fa-pen"></i></a>
                                    <form action="{{ route('general.logo.delete',$general->id) }}" method="POST">
                                        @csrf
                                       <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash "></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h2>General Setting & Logo Add</h2>
                </div>
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                <div class="card-body">
                    <form action="{{ route('general.logo.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Header Logo</label>
                            <input type="file" name="header_logo" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Footer Logo</label>
                            <input type="file" name="footer_logo" class="form-control">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add Logo</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection
