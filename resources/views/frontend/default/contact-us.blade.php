@extends('frontend.default.layouts.app')

@section('meta_title'){{ $page->meta_title }}@stop

@section('meta_description'){{ $page->meta_description }}@stop

@section('meta_keywords'){{ $page->keywords }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $page->meta_title }}">
    <meta itemprop="description" content="{{ $page->meta_description }}">
    <meta itemprop="image" content="{{ custom_asset($page->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $page->meta_title }}">
    <meta name="twitter:description" content="{{ $page->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ custom_asset($page->meta_img) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $page->meta_title }}" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="{{ route('custom-pages.show_custom_page', $page->slug) }}" />
    <meta property="og:image" content="{{ custom_asset($page->meta_img) }}" />
    <meta property="og:description" content="{{ $page->meta_description }}" />
    <meta property="og:site_name" content="{{ $page->title }}" />
@endsection

@section('content')
<section class="contact-us-section py-6 mb-5">
    <div class="container">
        <div class="contact-heading">
            <h2 class="font-weight-bold">{{ $page->title }}</h2>
            <p class="text-grey">{{ $page->content }}</p>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
        @endif
        <div class="row justify-content-between">
            <div class="col-sm-6">
                <form method="POST" id="contact_form" action="{{ route('contactPost') }}">
                    @csrf
                        <div class="form-row">
                            <div class="form-group mb-md-0 col-md-6">
                                <label class="h5" for="first_name">First name*</label>
                                <input type="text" class="form-control radius-10 @error('first_name') is-invalid @enderror" id="first_name" placeholder="Enter First name" name="first_name">
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-md-0 col-md-6">
                                <label class="h5" for="last_name">Last name*</label>
                                <input type="text" class="form-control radius-10 @error('last_name') is-invalid @enderror" id="last_name" name="last_name"  placeholder="Enter Last name">
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-0 mt-sm-4">
                            <label class="h5" for="inputemailAddress">Email address*</label>
                            <input type="email" class="form-control radius-10 @error('email') is-invalid @enderror" id="inputemailAddress" placeholder="Enter email address" name="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-0 mt-sm-4">
                            <label class="h5" for="phone_number">Mobile number</label>
                            <input type="number" class="form-control radius-10 @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" placeholder="Enter mobile number">
                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                            <div class="form-group mt-0 mt-sm-4">
                            <label class="h5" for="company_name">Company</label>
                            <input type="text" class="form-control radius-10" id="company_name" name="company_name" placeholder="Enter Company name">
                            @error('company_name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                            </div>
                            <div class="form-group mt-0 mt-sm-4">
                                <label class="h5" for="heLp">How can we help?</label>
                                <select id="help"  name="help" class="form-control radius-10 coustom-select">
                                    <option value="" selected>Select</option>
                                    <option value='Technical Support'>Technical Support</option>
                                    <option value='Payments/Deposits'>Payments/Deposits</option>
                                    <option value='Advertising'>Advertising</option>
                                    <option value='Other'>Other</option>
                                </select>
                                @error('help')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mt-0 mt-sm-4">
                                <label class="h5" for="message">Message</label>
                                <textarea class="form-control radius-10" name="message" id="message" style="height:130px;" placeholder="Enter message"></textarea>
                                @error('message')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                             <div class="form-group mt-0 mt-sm-4">
                                <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_SITE_KEY') }}"></div>
                            </div>

                    <button type="submit" class="btn btn-green-lg mt-4">Submit</button>
                </form>
            </div> 
            <div class="col-sm-5 d-sm-block d-none "> 
                <div class="contact-image">
                    <img src="public/uploads/all/contact-img.png" alt="" class="img-fluid">
                </div>  
            </div>                
        </div>        
    </div>
</section>
@endsection 
@section('script')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#contact_form").on("submit", function(evt)
        {
            var response = grecaptcha.getResponse();
            if(response.length == 0)
            {
            //reCaptcha not verified
                alert("Please verify you are a human.");
                evt.preventDefault();
                return false;
            }
            //captcha verified
            //do the rest of your validations here
            $("#contact_form").submit();
        });
    });
</script>
@endsection