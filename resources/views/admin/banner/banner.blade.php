@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Banner List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($banners as $banner)
                        <tr>
                            <td>
                                <img src="{{ asset('uploads/banner') }}/{{ $banner->image }}" alt="">
                            </td>
                            <td>{{ $banner->title }}</td>
                            <td>
                                <a href="{{ route('banner.delete',$banner->id) }}" class="btn btn-danger icon"><i data-feather="trash"></i></a>
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
                    <h3>Add Banner</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-lable">Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-lable">Banner Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-lable">Page Link</label>
                            <select name="id" class="form-control">
                               @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                               @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                           <button type="submit" class="btn btn-primary">Add Banner</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
