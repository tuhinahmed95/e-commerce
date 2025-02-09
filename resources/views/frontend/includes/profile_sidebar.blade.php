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
            <li class="list-group-item bg-light"><a href="{{ route('customer.profile') }}" class="text-dark">Profile</a></li>
            <li class="list-group-item bg-light"><a href="{{ route('customer.order') }}" class="text-dark">My Order</a></li>
            <li class="list-group-item bg-light"><a href="" class="text-dark">My Wishlist</a></li>
            <li class="list-group-item bg-light"><a href="{{ route('customer.logout') }}" class="text-dark">Logout</a></li>
        </ul>
    </div>
</div>
