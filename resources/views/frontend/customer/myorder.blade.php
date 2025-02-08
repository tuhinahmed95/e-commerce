@extends('frontend.master')
@section('content')
<!-- start wpo-page-title -->
<section class="wpo-page-title">
    <h2 class="d-none">Hide</h2>
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <div class="wpo-breadcumb-wrap">
                    <ol class="wpo-breadcumb-wrap">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="product.html">My Orders</a></li>
                    </ol>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end page-title -->

<div class="container">
    <div class="row mb-3 py-3">
        <div class="col-lg-3">
            <div class="card text-center" style="width: 18rem;">
                @if (Auth::guard('customer')->user()->photo == null)
                 {{ Auth::guard('customer')->user()->fname.' '.Auth::guard('customer')->user()->lname }}
                @else
                    <img width="70" src="{{ asset(Auth::guard('customer')->user()->photo) }}" alt="">
                @endif
                {{-- <img src="..." class="card-img-top" alt="..."> --}}
                <div class="card-body">
                    <h5 class="card-title">{{ Auth::guard('customer')->user()->fname.' '.Auth::guard('customer')->user()->lname }}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item bg-light"><a href="" class="text-dark">Profile</a></li>
                    <li class="list-group-item bg-light"><a href="" class="text-dark">My Order</a></li>
                    <li class="list-group-item bg-light"><a href="" class="text-dark">My Wishlist</a></li>
                    <li class="list-group-item bg-light"><a href="{{ route('customer.logout') }}" class="text-dark">Logout</a></li>
                </ul>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h3>My Order List</h3>
                </div>
                <div class="card-header">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Order Id</th>
                            <th>Total</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($my_orders as $sl=>$my_order )
                        <tr>
                            <td>{{ $sl+1 }}</td>
                            <td>{{ $my_order->order_id }}</td>
                            <td>{{ $my_order->total }}</td>
                            <td>{{ $my_order->created_at->format('d-m-y') }}</td>
                            <td>
                                @if ($my_order->status == 0)
                                    <span class="badge bg-secondary">Placed</span>
                                @elseif($my_order->status == 1)
                                    <span class="badge bg-primary">Proccesing</span>
                                @elseif($my_order->status == 2)
                                    <span class="badge bg-warning">shipping</span>
                                @elseif($my_order->status == 3)
                                    <span class="badge bg-info">Ready For Delivery</span>
                                @elseif($my_order->status == 4)
                                    <span class="badge bg-success">Recieved</span>
                                @elseif($my_order->status == 5)
                                    <span class="badge bg-danger">Cancel</span>
                                @endif

                            </td>
                            <td>
                                <a href="{{ route('download.invoice',$my_order->id) }}" class="btn btn-warning">Download</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
