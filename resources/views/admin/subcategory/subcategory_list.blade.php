@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>SubCategory List</h3>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('sub.create.category') }}" class="btn btn-success mr-3">Add New Subcategory</a>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>Sl</th>
                        <th>Subcategory Name</th>
                        <th>Subcategory Image</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
