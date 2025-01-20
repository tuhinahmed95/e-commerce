@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
       <div class="card">
        <div class="card-header">
            <h3>Update Category</h3>
            @if (session('status'))
             <strong class="text-success">{{ session('status') }}</strong>
            @endif

            @if(session('update'))
             <div class="alert alert-success">{{ session('update') }}</div>
            @else

            @endif
        </div>
        <div class="card-body">
            <form action="{{ route('category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="category_name" class="form-label">Category Name</label>
                    <input type="text" name="category_name" class="form-control" value="{{ $category->category_name }}">
                    @error('category_name')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="icon" class="form-label">Icon</label>
                    <input type="file" name="icon" class="form-control">
                    <img src="{{ asset('uploads/category') }}/{{ $category->icon }}" alt="" width="70">
                    @error('icon')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <button class="btn btn-success">Update Category</button>
                </div>
            </form>
        </div>
       </div>
    </div>
</div>

@endsection
