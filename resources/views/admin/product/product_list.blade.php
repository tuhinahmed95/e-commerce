@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Product List</h3>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('prduct.create') }}" class="btn btn-primary mr-3">Add New Product</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Sl</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
