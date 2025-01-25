@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <h3>Variation List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Color Name</th>
                        <th>Color Code</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($colors as $key=>$color )
                    <tr>
                        <td>{{ $color->id }}</td>
                        <td>{{ $color->color_name }}</td>
                        <td>
                            <i style="display:inline-block; width: 35px; height: 35px; background:{{ $color->color_name =='NA'?'':$color->color_code}}; color:{{ $color->color_name =='NA'?:'transparent'}}">{{ $color->color_name =='NA'?$color->color_name:'color'}}</i>
                        </td>
                        <td>
                            <a href="{{ route('variation.delete',$color->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>

                    @endforeach
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Size List</h3>
            </div>
            <div class="card-body">
               <div class="row">
                @foreach ($categories as $category)
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ $category->category_name }}</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Size Name</th>
                                    <th>Action</th>
                                </tr>
                                @foreach (App\Models\Size::where('category_id',$category->id)->get() as $size)
                                <tr>
                                    <td>{{ $size->size_name }}</td>
                                    <td>
                                        <a href="{{ route('size.delete',$size->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

                @endforeach
               </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <h3>Add Color</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('variation.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Color Name</label>
                        <input type="text" name="color_name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Color Code</label>
                        <input type="text" name="color_code" class="form-control">
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add Color</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h3>Add Size</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('size.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <select name="category_id" class="form-control">
                            <option value="">Selelct Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Size Nmae</label>
                        <input type="text" name="size_name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add Color</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
@endsection
