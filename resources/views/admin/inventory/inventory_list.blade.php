@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Inventory List</h3>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('inventory.create',['id' => $product->id])}}" class="btn btn-primary mr-3">Add Inventory</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
