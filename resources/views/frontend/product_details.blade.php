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
                        <li><a href="product.html">Product</a></li>
                        <li>Product Single</li>
                    </ol>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end page-title -->

  <!-- product-single-section  start-->
  <div class="product-single-section section-padding">
    <div class="container">
        <div class="product-details">
            <form action="{{ route('add.cart') }}" method="POST">
                @csrf
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="product-single-img">
                            <div class="product-active owl-carousel">
                                @foreach ($product_gallery as $product_gal)
                                    <div class="item">
                                        <img height="400" src="{{ asset($product_gal->gallery) }}" alt="">
                                    </div>
                                @endforeach
                            </div>
                            <div class="product-thumbnil-active  owl-carousel">
                                @foreach ($product_gallery as $product_gal)
                                    <div class="item">
                                        <img height="100" src="{{ asset($product_gal->gallery) }}" alt="">
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    @php
                        $avg = '';
                        if ($total_review == 0){
                            $ave = 0;
                        }
                        else {
                            $avg = round($total_star/$total_review);
                        }

                    @endphp
                    <div class="col-lg-7">
                        <div class="product-single-content">
                            <h2>{{ $product_info->product_name }}</h2>
                            <div class="price">
                                <span class="present-price">&#2547;{{ $product_info->after_discount }}</span>
                                @if ($product_info->discount)
                                    <del class="old-price">&#2547;{{ $product_info->price }}</del>
                                @endif
                            </div>
                            <div class="rating-product">
                                @for($i = 1; $i <=$avg; $i++)
                                     <i class="fa fa-star"></i>
                                @endfor

                                @for($i=$avg;$i<=4; $i++)
                                    <i class="fa fa-star-o"></i>
                                @endfor
                                <span>{{ $total_review }}</span>
                            </div>
                            <p>{{ $product_info->short_desc }} </p>
                            <div class="product-filter-item color">
                                <div class="color-name">
                                    <span>Color :</span>
                                    <ul>
                                        @foreach ($varient_color as $colors)
                                        @if ($colors->rel_color->color_name)
                                            <li class="color"><input class="color_id" checked id="color{{ $colors->color_id }}" type="radio" name="color_id" value="{{ $colors->color_id }}">
                                                <label for="color{{ $colors->color_id }}" style="background: {{ $colors->rel_color->color_code }}"></label>
                                            </li>
                                        @else
                                            <li class="color"><input class="color_id" id="color{{ $colors->color_id }}" type="radio" name="color_id" value="{{ $colors->color_id }}">
                                                <label for="color{{ $colors->color_id }}" style="background: {{ $colors->rel_color->color_code }}">NA</label>
                                            </li>
                                        @endif

                                        @endforeach
                                    </ul>
                                    @error('color_id')
                                        <strong class="text-danger">Color is required</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="product-filter-item color filter-size">
                                <div class="color-name">
                                    <span>Sizes:</span>
                                    <ul class="size_aval">
                                        @foreach ($varient_sizes as $size)
                                        @if ($size->relt_size->size_name == 'NA')
                                            <li class="color"><input class="size_id" checked id="size{{$size->size_id}}" type="radio" name="size_id" value="{{$size->size_id}}">
                                                <label for="size{{$size->size_id}}">{{ $size->relt_size->size_name }}</label>
                                            </li>
                                        @else
                                            <li class="color"><input class="size_id"  id="size{{$size->size_id}}" type="radio" name="size_id" value="{{$size->size_id}}">
                                                <label for="size{{$size->size_id}}">{{ $size->relt_size->size_name }}</label>
                                            </li>
                                        @endif

                                        @endforeach
                                    </ul>
                                    @error('size_id')
                                        <strong class="text-danger">Size is required</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="pro-single-btn">
                                <div class="quantity cart-plus-minus">
                                    <input class="text-value" name="quantity" type="text" value="1">
                                </div>
                                @auth('customer')
                                    <button type="submit" class="btn btn-primary">Add to cart</button>
                                @else
                                    <a href="{{ route('customer.login') }}" class="theme-btn-s2">Add to cart</a>
                                @endauth
                                <a href="#" class="wl-btn"><i class="fi flaticon-heart"></i></a>
                            </div>
                            <input type="hidden" name="product_id" value="{{ $product_info->id }}">
                            <ul class="important-text">
                                <li><span>SKU:</span>FTE569P</li>
                                <li><span>Quantity:</span></li>
                                <li><span>Categories : </span>{{ $product_info->rel_to_cat->category_name }}</li>
                                @php
                                    $after_explode = explode(" ", $product_info->tags)
                                @endphp
                                <li>
                                    <span>Tags : </span>
                                    @foreach ($after_explode as $tags)
                                    <a href="" class="badge bg-warning text-dark">{{ App\Models\Tag::find($tags)->tag_name }}</a>
                                    @endforeach
                                </li>

                                <li><span id="quan"></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="product-tab-area">
            <ul class="nav nav-mb-3 main-tab" id="tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="descripton-tab" data-bs-toggle="pill"
                        data-bs-target="#descripton" type="button" role="tab" aria-controls="descripton"
                        aria-selected="true">Description</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="Ratings-tab" data-bs-toggle="pill" data-bs-target="#Ratings"
                        type="button" role="tab" aria-controls="Ratings" aria-selected="false">Reviews
                        (3)</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="Information-tab" data-bs-toggle="pill"
                        data-bs-target="#Information" type="button" role="tab" aria-controls="Information"
                        aria-selected="false">Additional info</button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="descripton" role="tabpanel"
                    aria-labelledby="descripton-tab">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="Descriptions-item">
                                   {!! $product_info->long_desc !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="Ratings" role="tabpanel" aria-labelledby="Ratings-tab">
                    <div class="container">
                        <div class="rating-section">
                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <div class="comments-area">
                                        <div class="comments-section">
                                            <h3 class="comments-title">3 reviews for Stylish Pink Coat</h3>
                                            <ol class="comments">
                                                @foreach ($reviews as $review)
                                                    <li class="comment even thread-even depth-1" id="comment-1">
                                                        <div id="div-comment-1">
                                                            <div class="comment-theme">
                                                                <div class="comment-image">
                                                                    @if ($review->rel_to_customer->photo == null)
                                                                        <img src="#" alt="custome image">
                                                                    @else
                                                                        <img src="{{asset($review->rel_to_customer->photo)  }}" alt="">
                                                                    @endif
                                                                    <img src="assets/images/blog-details/comments-author/img-1.jpg"
                                                                        alt>
                                                                </div>
                                                            </div>
                                                            <div class="comment-main-area">
                                                                <div class="comment-wrapper">
                                                                    <div class="comments-meta">
                                                                        <h4>{{ $review->rel_to_customer->fname.' '.$review->rel_to_customer->lname }}</h4>
                                                                        <span class="comments-date">{{ $review->created_at->diffforHumans() }}</span>
                                                                        <div class="rating-product">
                                                                            @for($i = 1; $i <= $review->star; $i++)
                                                                                <i class="fa fa-star"></i>
                                                                            @endfor
                                                                            @for($i=$review->star; $i<=4; $i++)
                                                                                <i class="fa fa-star-o "></i>
                                                                            @endfor
                                                                        </div>
                                                                    </div>
                                                                    <div class="comment-area">
                                                                        <p>{{ $review->review }} </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </div> <!-- end comments-section -->
                                        @auth('customer')
                                            @if (App\Models\OrderProduct::where('customer_id', Auth::guard('customer')->id())->where('product_id',$product_info->id)->exists())
                                                @if (App\Models\OrderProduct::where('customer_id', Auth::guard('customer')->id())->whereNotNull('review')->first() == false )
                                                    <div class="col col-lg-10 col-12 review-form-wrapper">
                                                        <div class="review-form">
                                                            <h4>Add a review</h4>
                                                            <form action="{{ route('review.store',$product_info->id) }}" method="POST">
                                                                @csrf
                                                                <div class="give-rat-sec">
                                                                    <div class="give-rating">
                                                                        <label>
                                                                            <input type="radio" name="stars" value="1">
                                                                            <span class="icon">★</span>
                                                                        </label>
                                                                        <label>
                                                                            <input type="radio" name="stars" value="2">
                                                                            <span class="icon">★</span>
                                                                            <span class="icon">★</span>
                                                                        </label>
                                                                        <label>
                                                                            <input type="radio" name="stars" value="3">
                                                                            <span class="icon">★</span>
                                                                            <span class="icon">★</span>
                                                                            <span class="icon">★</span>
                                                                        </label>
                                                                        <label>
                                                                            <input type="radio" name="stars" value="4">
                                                                            <span class="icon">★</span>
                                                                            <span class="icon">★</span>
                                                                            <span class="icon">★</span>
                                                                            <span class="icon">★</span>
                                                                        </label>
                                                                        <label>
                                                                            <input type="radio" name="stars" value="5">
                                                                            <span class="icon">★</span>
                                                                            <span class="icon">★</span>
                                                                            <span class="icon">★</span>
                                                                            <span class="icon">★</span>
                                                                            <span class="icon">★</span>
                                                                        </label>
                                                                    @error('stars')
                                                                        <strong class="text-danger">{{ $message }}</strong>
                                                                    @enderror
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <textarea name="review" class="form-control"
                                                                        placeholder="Write Comment..."></textarea>
                                                                    @error('review')
                                                                        <strong class="text-danger">{{ $message }}</strong>
                                                                    @enderror
                                                                </div>
                                                                <div class="name-input">
                                                                    <input name="name" type="text" class="form-control" placeholder="Name"
                                                                        required value="{{ Auth::guard('customer')->user()->fname }}">
                                                                </div>
                                                                <div class="name-email">
                                                                    <input name="email" type="email" class="form-control" placeholder="Email"
                                                                        required value="{{ Auth::guard('customer')->user()->email }}">
                                                                </div>
                                                                <div class="rating-wrapper">
                                                                    <div class="submit">
                                                                        <button type="submit" class="theme-btn-s2">Post
                                                                            review</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @else
                                                    <h3 class="alert alert-success">You Alreday Reviewed This Product</h3>
                                                @endif
                                            @else
                                                <h3 class="alert alert-warning">You Did Not Purchae This Product Yet</h3>
                                            @endif
                                        @endauth
                                    </div> <!-- end comments-area -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="Information" role="tabpanel" aria-labelledby="Information-tab">
                    <div class="container">
                        <div class="Additional-wrap">
                            <div class="row">
                                <div class="col-12">
                                    {!! $product_info->addi_info!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="related-product">
    </div>
</div>
<!-- product-single-section  end-->
@endsection

@section('footer_script')
<script>
    $('.color_id').click(function(){
       var color_id = $(this).val();
       var product_id = '{{ $product_info->id }}';

       $.ajaxSetup({
                headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

        $.ajax({
            url:'/getSize',
            type:'POST',
            data:{'color_id':color_id, 'product_id':product_id},
            success: function (data){
                $('.size_aval').html(data);


                $('size_id').click(function(){
                    var size_id = $(this).val();

                    $.ajaxSetup({
                            headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url:'/getQuantity',
                        type:'post',
                        data:{'color_id':color_id, 'product_id':product_id, 'size_id':size_id}
                        success: function(data){
                            alert()
                        }
                    })


                });

            }
        });
    })
</script>

@if (session('cart_add'))
    <script>
        Swal.fire({
        position: "top-end",
        icon: "success",
        title: "{{ session('cart_add') }}",
        showConfirmButton: false,
        timer: 1500
    });

    </script>

@endif
@endsection
