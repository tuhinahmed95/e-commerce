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
                            <li><a href="product.html">Customer Profile</a></li>
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->
    <div class="container">
        <div class="row py-5">
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
                        <li class="list-group-item bg-light"><a href="{{ route('customer.order') }}" class="text-dark">My Order</a></li>
                        <li class="list-group-item bg-light"><a href="" class="text-dark">My Wishlist</a></li>
                        <li class="list-group-item bg-light"><a href="{{ route('customer.logout') }}" class="text-dark">Logout</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h3>Customer Information Update</h3>
                    </div>
                    @if (session('cus_update'))
                         <div class="alert alert-success">{{ session('cus_update') }}</div>
                    @endif
                    <div class="card-body">
                        <form action="{{ route('customer.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">First Name</label>
                                        <input type="text" class="form-control" name="fname" value="{{ Auth::guard('customer')->user()->fname }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" name="lname" value="{{ Auth::guard('customer')->user()->lname }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Email</label>
                                        <input type="email" class="form-control" disabled value="{{ Auth::guard('customer')->user()->email }}">
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Phone</label>
                                        <input type="text" class="form-control" name="phone" value="{{ Auth::guard('customer')->user()->phone }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Zip</label>
                                        <input type="number" class="form-control" name="zip" value="{{ Auth::guard('customer')->user()->zip }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Address</label>
                                        <input type="text" class="form-control" name="address" value="{{ Auth::guard('customer')->user()->address }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Image</label>
                                        <input type="file" class="form-control" name="photo">
                                        <img width="100" src="{{ asset(Auth::guard('customer')->user()->photo) }}" alt="">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                  <div class="mb-3 mt-3">
                                     <button type="submit" class="btn btn-primary">Update</button>
                                  </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
