@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h1>Social Media List</h1>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('general.socialmedia.create') }}" class="btn btn-primary mr-3">Add New SocialMedia</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Social Media Name</th>
                                <th>Icon</th>
                                <th>Color</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($socialmedias as $key => $socialmedia)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $socialmedia->icon_name }}</td>
                                <td>{{ $socialmedia->social_icon }}</td>
                                <td>{{ $socialmedia->color }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('general.socialmedia.edit',$socialmedia->id) }}"><i class="fa fa-pencil btn btn-warning mr-2"></i></a>
                                    <form action="{{ route('general.socialmedia.delete',$socialmedia->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
