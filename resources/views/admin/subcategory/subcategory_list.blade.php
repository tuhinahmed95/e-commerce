@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>SubCategory List</h3>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('sub.category.create') }}" class="btn btn-success mr-3">Add New Subcategory</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Sl</th>
                        <th>Category Name</th>
                        <th>Subcategory Name</th>
                        <th>Subcategory Image</th>
                        <th>Action</th>
                    </tr>
                   @foreach ($subcategories as $subcategory)
                   <tr>
                     <td>{{ $loop->index+1 }}</td>
                     <td>{{ App\Models\Category::find($subcategory->category_id)->category_name }}</td>
                     <td>{{ $subcategory->subcategory_name }}</td>
                     <td>
                        <img src="{{ asset($subcategory->sub_image) }}" alt="">
                     </td>
                     <td>
                        <a href="{{ route('sub.category.edit',$subcategory->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>

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
