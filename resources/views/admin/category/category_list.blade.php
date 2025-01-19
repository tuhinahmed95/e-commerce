@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-10">
        <div class="card">
            <div class="card-header">
                <h3>Category List</h3>
            </div>
           <div class="d-flex justify-content-end mx-3">
            <a href="{{ route('category.create') }}" class="btn btn-success">Add New Category</a>
           </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr class="fw-bold text-center">
                        <th>Sl</th>
                        <th>Category Name</th>
                        <th>Category Icon</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($categories as $key => $categorie)
                    <tr class="text-center">
                        <td>{{ $key+1 }}</td>
                        <td>{{ $categorie->category_name }}</td>
                        <td>
                            <img src="{{ asset('uploads/category')}}/{{ $categorie->icon }}" alt="">
                        </td>
                        <td>
                            <a href="{{ route('category.edit') }}" class="btn btn-warning"><i class="fa fa-pencil fs-1"></i></a>
                            <a href="" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
