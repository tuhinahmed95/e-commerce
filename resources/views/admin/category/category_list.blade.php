@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-10">
       <form action="{{ route('checked.delete') }}" method="POST">
        @csrf
            <div class="card">
                    <div class="card-header">
                        <h3>Category List</h3>
                    </div>
                <div class="d-flex justify-content-end mx-3">
                    <a href="{{ route('category.create') }}" class="btn btn-success"><i data-feather="plus"></i>Add New Category</a>
                </div>
                    <div class="card-body">
                        @if(session('soft_delete'))
                        <div class="alert alert-danger">{{ session('soft_delete') }}</div>
                        @endif
                        <table class="table table-bordered">
                            <tr class="fw-bold ">
                                <th>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" id="chkSelectAll" class="form-check-input">
                                            Check All
                                            <i class="input-frame"></i>
                                        </label>
                                    </div>
                                </th>
                                <th>Sl</th>
                                <th>Category Name</th>
                                <th>Category Icon</th>
                                <th>Action</th>
                            </tr>

                            @foreach ($categories as $key => $categorie)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="category_id[]" class="form-check-input chkDel" value="{{ $categorie->id }}">
                                          <i class="input-frame"></i>
                                        </label>
                                    </div>
                                </td>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $categorie->category_name }}</td>
                                <td>
                                    <img src="{{ asset('uploads/category')}}/{{ $categorie->icon }}" alt="category-image">
                                </td>
                                <td>
                                    <a href="{{ route('category.edit',$categorie->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>

                                    <a href="{{ route('category.soft.delete',$categorie->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-danger">Delete Checked</button>
                        </div>
                    </div>
            </div>
       </form>
    </div>
</div>
@endsection

@section('footer_script')
<script>
    $("#chkSelectAll").on('click', function(){
        this.checked ? $(".chkDel").prop("checked",true) : $(".chkDel").prop("checked",false);
    })
</script>
@endsection
