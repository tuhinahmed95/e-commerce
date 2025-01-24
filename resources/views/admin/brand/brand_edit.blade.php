@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Update A Brand</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('brand.update',$brands->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="brand_name" class="form-label">Brand Name</label>
                        <input type="text" name="brand_name" class="form-control" value="{{ $brands->brand_name }}">
                    </div>

                    <div class="mb-3">
                        <label for="brand_logo" class="form-label">Brand Name</label>
                        <input type="file" name="brand_logo" class="form-control">
                        <img src="{{ asset($brands->brand_logo) }}" alt="">
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update Brand</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
