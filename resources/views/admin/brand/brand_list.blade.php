@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>Brand List</h3>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('brand.create') }}" class="btn btn-primary mr-3"><i data-feather="plus"></i>Add New Brand</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Sl</th>
                        <th>Brand Name</th>
                        <th>Brand Logo</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($brands as $brand)
                    <tr>
                        <td>{{ $brand->id }}</td>
                        <td>{{ $brand->brand_name }}</td>
                        <td>
                            <img src="{{asset( $brand->brand_logo) }}" alt="">
                        </td>
                        <td>
                            <a href="{{ route('brand.edit',$brand->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>

                            <a href="{{ route('brand.delete',$brand->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>

                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
