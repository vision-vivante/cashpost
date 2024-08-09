@extends('frontend.default.layouts.app')

@section('content')
<style>
    .aiz-header-other, .aiz-footer{
        display: none;
    }
</style>
<div class="sign-up-section step-2">
    <div class="container-fluid px-0">
        <div class="card mb-0 border-0 rounded-0 text-sm-right ">
            <div class="row no-gutters justify-content-start">

                @include('frontend.default.inc.user_sidebar')
                <div class="col-sm-9 form-side" style="height:100vh; overflow:auto;">
                    <div class="card-body form-section">
                        <div class="mb-5 text-center">
                            <h2 class="font-weight-bold mb-0 ">{{ translate('Reset Password') }}</h2>
                            <p>Recover your account.</p>
                        </div>
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group ">
                                <label for="email" class="h5">{{ translate('E-Mail Address') }}</label>

                                <div class="">
                                    <input id="email" type="email" class="form-control radius-10 @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="password" class="h5">{{ translate('Password') }}</label>

                                <div class="">
                                    <input id="password" type="password" class="form-control radius-10 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="password-confirm" class="h5">{{ translate('Confirm Password') }}</label>

                                <div class="">
                                    <input id="password-confirm" type="password" class="form-control radius-10" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                                </div>
                            </div>

                            <div class="">
                                <button type="submit" class="btn btn-green-lg btn-block">
                                    {{ translate('Reset Password') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
