@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3>Product List</h3>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('prduct.create') }}" class="btn btn-primary mr-3"><i data-feather="plus"></i>Add New Product</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>After Discount</th>
                        <th>Preview</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->discount }}</td>
                        <td>{{ $product->after_discount }}</td>
                        <td>
                            <img src="{{ asset('uploads/product/preview')}}/{{ $product->preview }}" alt="product-image">
                        </td>
                        <td>
                            <input type="checkbox" {{ $product->status == 1?'checked':'' }} data-id="{{ $product->id }}" class="status"  data-toggle="toggle" value="{{ $product->status }}">

                        </td>
                        <td>
                            <a href="{{ route('product.eidt',$product->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>

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
@section('footer_script')
<script>
    $('.status').change(function(){

        if($(this).val()!=1){
            $(this).attr('value',1)
        }
        else{
            $(this).attr('value',0)
        }
        var product_id = $(this).attr('data-id');
        var status = $(this).val();

        $.ajaxSetup({
                headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            $.ajax({
                url:'/getStatus',
                type:'POST',
                data:{'product_id':product_id,'status':status},
                success: function (data){

                }
            });

    })
</script>
@endsection
