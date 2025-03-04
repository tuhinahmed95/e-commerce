@extends('frontend.master')
@section('content')
    <div class="container">
        <div class="row mt-5 mb-3">
            <div class="card">
                <div class="card-header">
                    <h3>Product From Api</h3>
                </div>
                <div class="card-body">
                    {{-- <table class="table table-bordered">
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>After Discount</th>
                        </tr>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->discount }}</td>
                            <td>{{ $product->after_discount }}</td>
                        </tr>
                        @endforeach
                    </table> --}}
                    <div class="row">
                        @foreach ($categories as $category)
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        {{ $category->category_name }}
                                    </div>
                                    <div class="card-body">
                                        <img width="50" src="{{ env('CATEGORY_IMAGE') }}/{{ $category->icon }}" alt="">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
