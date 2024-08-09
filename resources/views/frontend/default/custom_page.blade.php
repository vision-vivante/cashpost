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
    <section class="why-cashpost position-relative">
        <span class="position-absolute design-1"><img src="{{asset('public/uploads/all/Group530.png') }}" class="img-fluid"></span>
            <div class="why-cashpost-card position-absolute">
                <div class="container">
                     <div class="card-img">
                        <img src="{{asset('public/uploads/all/group-img.png')}}" class="img-fluid">
                     </div>
                </div> 
            </div>
        <div class="heading position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 mx-auto text-center">
                        <h1 class="font-weight-bold mb-3 mt-3">{{ $page->title }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-9 px-xl-4 mx-auto text-center">
                    <h3 class="text-grey why-cashpost-title">CashPost is the world's most affordable influencer marketing platform. Connect with thousands of nano-influencers for as little as $1.00 per post.</h3>
                </div>
            </div>
        </div>
    </section>
        @php echo $page->content; @endphp
@endsection