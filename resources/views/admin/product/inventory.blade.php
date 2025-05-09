@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Inventory for, <strong> {{ $product->product_name }}</strong></h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($inventories as $inventory)
                        <tr>
                            <td>{{ $inventory->rel_color->color_name }}</td>
                            <td>{{ $inventory->relt_size->size_name }}</td>
                            <td>{{ $inventory->quantity }}</td>
                            <td>
                                <a href="{{ route('inventory.delete',$inventory->id) }}" class="btn btn-danger icon"><i data-feather="trash"></i></a>
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
                    <h3>Add Inventory</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('inventory.store',$product->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Product</label>
                            <input type="text" disabled class="form-control" value="{{ $product->product_name }}">
                        </div>

                        <div class="mb-3">
                            <select name="color_id">
                                <option value="">Select Color</option>
                                @foreach ($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <select name="size_id">
                                <option value="">Select Size</option>
                            @foreach (App\Models\Size::where('category_id',$product->category_id)->get() as $size)
                             <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Quantity</label>
                            <input type="text" name="quantity" class="form-control">
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
