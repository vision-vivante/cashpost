@extends('frontend.default.layouts.app')

@section('content')
@php 
$header_logo=get_setting('other_header_logo'); 
@endphp
<div class="sign-up-section min-vh-100 overflow-auto">
    <div class="container-fluid px-0">
        <div class="card border-0 rounded-0 text-sm-right mb-0">
            <div class="row no-gutters justify-content-start">

                @include('frontend.default.inc.user_sidebar')

                <div class="col-sm-9 form-card overflow-auto" style="height:100vh;">
                    <div>@include('flash::message')</div>
                    <div class="card-body form-section">
                        <div class="form-head">
                            <!-- <h1 class="h3 text-primary mb-0">{{ translate('Welcome back') }}</h1>
                            <p>{{ translate('Login to manage your account') }}.</p> -->
                            <a href="{{url('/')}}"><img src="{{custom_asset($header_logo)}}" alt="" class="img-fluid"></a>
                            <h2 class="font-weight-bold mt-5 mb-4">Come On In</h2>
                        </div>
                        @if(Session::has('email_link'))
                        <div class="alert alert-danger">
                            <p>You must verify your email before using CashPost <a href="{{url(Session::get('email_link'))}}">Resend Email</a></p>
                        </div>
                        @endif
                        @if(Session::has('message'))
                        <div class="alert alert-success">
                            <p>{{Session::get('message')}}</p>
                        </div>
                        @endif
                        <form class="" method="POST" id="login-form" action="{{ route('login') }}">
                        @csrf

                            <div class="form-group mb-4">
                                <label class="form-label h5 text-dark" for="email">{{ translate('Email address*') }}</label>
                                <input type="email" class="form-control radius-10 @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter email address" required >
                                @error('email')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label h5 text-dark" for="password">{{ translate('Password*') }}</label>
                                <input type="password" class="form-control radius-10 @error('password') is-invalid @enderror" name="password" id="password" placeholder="Enter password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_SITE_KEY') }}"></div>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-block btn-green-lg h6">{{ translate('Login') }}</button>
                            </div>
                            
                            <div class="mb-5 h5 text-center">
                                <a class="text-capitalize font-weight-bold link-color" href="{{ route('password.request') }}">{{ translate('Forgot Password?') }}</a>
                            </div>


                            <!-- @if(\App\Utility\SettingsUtility::get_settings_value('facebook_login_activation_checkbox') == 1 || \App\Utility\SettingsUtility::get_settings_value('twitter_login_activation_checkbox') == 1 || \App\Utility\SettingsUtility::get_settings_value('google_login_activation_checkbox') == 1 || \App\Utility\SettingsUtility::get_settings_value('linkedin_login_activation_checkbox') == 1)
                            <div class="mb-5">
                                <div class="separator mb-3">
                                    <span class="bg-white px-3">Or Login With</span>
                                </div>

                                <ul class="list-inline social colored text-center">
                                    @if (\App\Utility\SettingsUtility::get_settings_value('facebook_login_activation_checkbox') == 1)
                                        <li class="list-inline-item">
                                            <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook" title="Facebook"><i class="lab la-facebook-f"></i></a>
                                        </li>
                                    @endif
                                    @if (\App\Utility\SettingsUtility::get_settings_value('twitter_login_activation_checkbox') == 1)
                                        <li class="list-inline-item">
                                            <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter" title="Twitter"><i class="lab la-twitter"></i></a>
                                        </li>
                                    @endif
                                    @if (\App\Utility\SettingsUtility::get_settings_value('google_login_activation_checkbox') == 1)
                                        <li class="list-inline-item">
                                            <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google" title="Google"><i class="lab la-google"></i></a>
                                        </li>
                                    @endif
                                    @if (\App\Utility\SettingsUtility::get_settings_value('linkedin_login_activation_checkbox') == 1)
                                        <li class="list-inline-item">
                                            <a href="{{ route('social.login', ['provider' => 'linkedin']) }}" class="linkedin" title="Linkedin"><i class="lab la-linkedin-in"></i></a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            @endif -->

                                <div class="d-flex aligns-items-center justify-content-center h5">
                                    <p class="text-grey mb-0">{{ translate("Don't have an account?") }}</p>
                                    <a href="{{ route('register') }}" class="font-weight-bold px-1 text-decoration-underline link-color">{{ translate('SignUp') }}</a>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if (env('DEMO_MODE') == 'On')
            <div class="card">
                <div class="card-body">
                    <table class="table table-centered mb-0 table-responsive">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Password</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>freelancer@example.com</td>
                                <td>123456</td>
                                <td class="text-right">
                                    <button class="btn btn-outline-info btn-xs" onclick="autoFill()">copy</button>
                                </td >
                            </tr>
                            <tr>
                                <td>client@example.com</td>
                                <td>123456</td>
                                <td class="text-right">
                                    <button class="btn btn-outline-info btn-xs" onclick="autoFill2()">copy</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>
 

@endsection
@section('script')
    <script type="text/javascript">
        function autoFill(){
            $('#email').val('freelancer@example.com');
            $('#password').val('123456');
        }
        function autoFill2(){
            $('#email').val('client@example.com');
            $('#password').val('123456');
        }
    </script>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#login-form").on("submit", function(evt)
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
                $("#login-form").submit();
            });
        });
    </script>

@endsection
