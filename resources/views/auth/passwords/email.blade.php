@extends('frontend.default.layouts.app')

@section('content')
<style>
    .aiz-header-other, .aiz-footer{
        display: none;
    }
</style>
<div class="sign-up-section forgot-password min-vh-100 overflow-auto">
    <div class="container-fluid px-0">
        <div class="card mb-0 border-0 rounded-0 text-sm-right ">
            <div class="row no-gutters justify-content-start">
                <div class="col-sm-3 d-none d-sm-block" style="height:100vh;">
                    <span class="overlay-gradient"></span>
                    <img src="{{asset('public/uploads/all/img-side.png')}}" alt="..." class="overlay">
                    <div class="content position-relative">
                    <a href="{{url('/')}}"><img src="{{asset('public/uploads/all/icon-cash.png')}}" alt="" class="img-fluid mx-auto p-3"></a>
                        <h3 class="text-white pt-7 px-4 text-24">"World's most affordable influencer marketing platform."</h3>
                    </div>
                </div>
                <div class="col-sm-9 form-card" style="height:100vh; overflow:auto;">
                    <div class="card-body">
                        <div class="mb-5 text-center">
                            <h1 class="h3 text-primary mb-0">Forgot password?</h1>
                        </div>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group">
                                <label class="form-label h5 text-dark" for="signinSrEmail">Email address</label>
                                <input id="email" type="email" class="form-control radius-10 @error('email') is-invalid @enderror" placeholder="Your Email address" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <button type="submit" class="btn mt-4 btn-green-lg btn-block">{{ translate('Reset Password') }}</button>
                            </div>

                            <div class="text-center mb-3">
                                <p class="text-grey mb-2">Remember your password?</p>
                                <a class="link-color h5 text-decoration-underline fw-600" href="{{ route('login') }}">Login to your account</a>
                            </div>

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
