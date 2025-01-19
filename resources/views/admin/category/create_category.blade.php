@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
       <div class="card">
        <div class="card-header">
            <h3>Create Category</h3>
            @if (session('status'))
             <strong class="text-success">{{ session('status') }}</strong>
            @endif
        </div>
        <div class="card-body">
            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="category_name" class="form-label">Category Name</label>
                    <input type="text" name="category_name" class="form-control">
                    @error('category_name')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="icon" class="form-label">Icon</label>
                    <input type="file" name="icon" class="form-control">
                    @error('icon')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <button class="btn btn-success">Createt Category</button>
                </div>
            </form>
        </div>
       </div>
    </div>
</div>

@endsection
