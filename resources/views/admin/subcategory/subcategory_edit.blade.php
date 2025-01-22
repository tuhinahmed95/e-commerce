@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Add New Subcategory</h3>
            </div>
            
            <div class="card-body">
                <form action="{{ route('sub.category.update',$subcategory->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <select name="category" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($categories as $categorie)
                            <option {{ $subcategory->category_id == $categorie->id?'selected':'' }} value="{{ $categorie->id }}">{{ $categorie->category_name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sub_category" class="form-label">Subcategory Name</label>
                        <input type="text" class="form-control" name="sub_category" value="{{ $subcategory->subcategory_name }}">
                        @error('sub_category')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror

                    </div>

                    <div class="mb-3">
                        <label for="sub_image" class="form-label">Subcategory Image</label>
                        <input type="file" name="sub_image" class="form-control">
                        <img src="{{asset ($subcategory->sub_image) }}" alt="" width="100">
                        @error('sub_image')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary">Add Subcategory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
