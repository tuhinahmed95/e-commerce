<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from wpocean.com/html/tf/themart/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Jun 2023 08:56:28 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="wpOceans">
    <link rel="shortcut icon" type="image/png" href="{{asset('frontend')}}/images/favicon.png">
    <title>Themart - eCommerce HTML5 Template</title>
    <link href="{{asset('frontend')}}/css/themify-icons.css" rel="stylesheet">
    <link href="{{asset('frontend')}}/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{asset('frontend')}}/css/flaticon_ecommerce.css" rel="stylesheet">
    <link href="{{asset('frontend')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('frontend')}}/css/animate.css" rel="stylesheet">
    <link href="{{asset('frontend')}}/css/owl.carousel.css" rel="stylesheet">
    <link href="{{asset('frontend')}}/css/owl.theme.css" rel="stylesheet">
    <link href="{{asset('frontend')}}/css/slick.css" rel="stylesheet">
    <link href="{{asset('frontend')}}/css/slick-theme.css" rel="stylesheet">
    <link href="{{asset('frontend')}}/css/swiper.min.css" rel="stylesheet">
    <link href="{{asset('frontend')}}/css/owl.transitions.css" rel="stylesheet">
    <link href="{{asset('frontend')}}/css/jquery.fancybox.css" rel="stylesheet">
    <link href="{{asset('frontend')}}/css/odometer-theme-default.css" rel="stylesheet">
    <link href="{{asset('frontend')}}/sass/style.css" rel="stylesheet">
</head>

<body>

    <!-- start page-wrapper -->
    <div class="page-wrapper">
        <!-- start preloader -->
        <div class="preloader">
            <div class="vertical-centered-box">
                <div class="content">
                    <div class="loader-circle"></div>
                    <div class="loader-line-mask">
                        <div class="loader-line"></div>
                    </div>
                    <img src="{{asset('frontend')}}/images/preloader.png" alt="">
                </div>
            </div>
        </div>
        <!-- end preloader -->

        <div class="wpo-login-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="wpo-accountWrapper" action="{{ route('customer.logged') }}" method="POST">
                            @csrf
                            <div class="wpo-accountInfo">
                                <div class="wpo-accountInfoHeader">
                                    <a href="index.html"><img src="{{asset('frontend')}}/images/logo-2.svg" alt=""></a>
                                    <a class="wpo-accountBtn" href="{{ route('customer.register') }}">
                                        <span class="{{ route('customer.register') }}">Create Account</span>
                                    </a>
                                </div>
                                <div class="image">
                                    <img src="{{asset('frontend')}}/images/login.svg" alt="">
                                </div>
                                <div class="back-home">
                                    <a class="wpo-accountBtn" href="{{ route('index') }}">
                                        <span>Back To Home</span>
                                    </a>
                                </div>
                            </div>
                            <div class="wpo-accountForm form-style">
                                <div class="fromTitle">
                                    <h2>Login</h2>
                                    <p>Sign into your pages account</p>
                                </div>
                                <div class="my-2">
                                    @if (session('reset'))
                                        <div class="alert alert-success">{{ session('reset') }}</div>
                                    @endif
                                    @if (session('verify'))
                                        <div class="alert alert-success">{{ session('verify') }}</div>
                                    @endif
                                    @if (session('verify_email'))
                                        <div class="alert alert-success">
                                            <span>{{ session('verify_email') }}</span>
                                            <a href="{{ route('resend.email.verify') }}">Resend Verification Link</a>
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <label>Email</label>
                                        <input type="text" id="email" name="email" placeholder="demo@gmail.com">
                                        @error('email')
                                            <strong>{{ $message }}</strong>
                                        @enderror

                                        @if (session('exist'))
                                            <div class="alert alert-danger">{{ session('exist') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="pwd6" type="password" placeholder=""
                                                name="password">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default reveal6" type="button"><i
                                                        class="ti-eye"></i></button>
                                            </span>
                                            @error('password')
                                                 <strong>{{ $message }}</strong>
                                            @enderror

                                            @if (session('wrong'))
                                                <div class="alert alert-danger">{{ session('wrong') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="check-box-wrap">

                                            <div class="forget-btn">
                                                <a href="{{ route('forget.password') }}">Forgot Password?</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <button type="submit" class="wpo-accountBtn">Login</button>
                                    </div>
                                </div>
                                <h4 class="or"><span>OR</span></h4>
                                <ul class="wpo-socialLoginBtn">
                                    <li><a href="{{ route('googleredirect.login') }}" class="bg-danger" tabindex="0" type="button"><span><i
                                                    class="ti-google"></i></span></a></li>
                                    <li>
                                        <a href="{{ route('githubredirect.login') }}" class="bg-secondary" tabindex="0" type="button"><span><i
                                                    class="ti-github"></i></span></a>
                                    </li>
                                </ul>
                                <p class="subText">Don't have an account? <a href="{{ route('customer.register') }}">Create free
                                        account</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- end of page-wrapper -->

    <!-- All JavaScript files
    ================================================== -->
    <script src="{{asset('frontend')}}/js/jquery.min.js"></script>
    <script src="{{asset('frontend')}}/js/bootstrap.bundle.min.js"></script>
    <!-- Plugins for this template -->
    <script src="{{asset('frontend')}}/js/modernizr.custom.js"></script>
    <script src="{{asset('frontend')}}/js/jquery.dlmenu.js"></script>
    <script src="{{asset('frontend')}}/js/jquery-plugin-collection.js"></script>
    <!-- Custom script for this template -->
    <script src="{{asset('frontend')}}/js/script.js"></script>
</body>


<!-- Mirrored from wpocean.com/html/tf/themart/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Jun 2023 08:56:29 GMT -->
</html>
