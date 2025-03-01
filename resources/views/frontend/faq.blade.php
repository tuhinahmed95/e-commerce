@extends('frontend.master')
@section('content')
<!-- start wpo-faq-section -->
<section class="wpo-faq-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 offset-lg-2">
                <div class="wpo-section-title">
                    <h2>Frequently Asked Question</h2>
                </div>
            </div>
            <div class="col-lg-8 offset-lg-2">
                <div class="wpo-faq-wrap">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="wpo-benefits-item">
                                <div class="accordion" id="accordionExample">
                                    @foreach ($faqs as $faq)
                                        <div class="accordion-item">
                                            <h3 class="accordion-header" id="aa{{ $faq->id }}">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#bb{{ $faq->id }}"
                                                    aria-expanded="false" aria-controls="bb{{ $faq->id }}">
                                                   {{$faq->question}}
                                                </button>
                                            </h3>
                                            <div id="bb{{ $faq->id }}" class="accordion-collapse collapse show"
                                                aria-labelledby="aa{{ $faq->id }}" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>{{ $faq->answer }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end container -->
</section>
<!-- end faq-section -->

<div class="question-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="wpo-section-title">
                    <h2>Do You Have Any Question?</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="question-touch">
                    <h2>Get In Touch</h2>
                    <form method="post" class="contact-validation-active" id="contact-form"
                        novalidate="novalidate">
                        <div class="half-col">
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Your Name">
                        </div>
                        <div class="half-col">
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Email Address">
                        </div>
                        <div class="half-col">
                            <input type="text" name="phone" id="phone" class="form-control"
                                placeholder="Subject">
                        </div>
                        <div>
                            <textarea class="form-control" name="note" id="note"
                                placeholder="Your Question"></textarea>
                        </div>
                        <div class="submit-btn-wrapper">
                            <button type="submit" class="theme-btn color-9">Submit Now</button>
                            <div id="loader">
                                <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
                            </div>
                        </div>
                        <div class="clearfix error-handling-messages">
                            <div id="success">Thank you</div>
                            <div id="error"> Error occurred while sending email. Please try again later. </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
