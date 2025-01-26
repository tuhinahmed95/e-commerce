@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>Create Inventory</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('inventory.store',$product->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Product</label>
                        <input type="text" class="form-control" value="{{ $product->product_name }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Color</label>
                        <select name="color_id" class="form-control">
                            <option value="">Select Color</option>
                            @foreach ($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Size</label>
                        <select name="size_id" class="form-control">
                            <option value="">Select Size</option>
                            @foreach (App\Models\Size::where('category_id',$product->category_id)->get() as $size)
                                <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Quantity</label>
                        <input type="text" class="form-control" name="quantity" >
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add Inventory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
