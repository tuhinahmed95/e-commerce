@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Add New Subcategory</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('sub.store.category') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <select name="category_id" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}">{{ $categorie->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="sub_category" class="form-label">Subcategory Name</label>
                        <input type="text" class="form-control" name="sub_category">
                    </div>

                    <div class="mb-3">
                        <label for="sub_image" class="form-label">Subcategory Image</label>
                        <input type="file" name="sub_image" class="form-control">
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
