@extends('admin.default.layouts.app')

@section('content')
<div class="sign-up-section step-3">
    <div class="container-fluid px-0">
        <div class="card mb-0 border-0 rounded-0">
            <div class="row no-gutters justify-content-start">
                <div class="col-lg-12">
                    <div class="card-body">
                        <form class="" name="reg-form" id="reg-form" method="POST" action="{{ route('client.register') }}" enctype="multipart/form-data">
                            @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="hidden" name="user_types[]" value="first_name">
                                            <label class="form-label h6" for="first_name">{{ translate('First Name*') }}</label>
                                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" placeholder="Enter first name"  value="{{ old('first_name') }}">
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <input type="hidden" name="user_types[]" value="last_name">
                                            <label class="form-label h6" for="last_name">{{ translate('Last Name*') }}</label>
                                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" placeholder="Enter last name" value="{{ old('last_name') }}" >
                                            @error('last_name')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <input type="hidden" name="user_types[]" value="company_name">
                                            <label class="form-label h6" for="company_name">{{ translate('Brand/Company Name*') }}</label>
                                            <input type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" id="company_name" placeholder="Enter company name" value="{{ old('company_name') }}">
                                            @error('company_name')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-4">
                                            <input type="hidden" name="user_types[]" value="email">
                                            <label class="form-label h6" for="email">{{ translate('Email*') }}</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="signinSrEmail" placeholder="Enter business email" value="{{ old('email') }}" >

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <input type="hidden" name="user_types[]" value="email">
                                    <label class="form-label h6" for="email">{{ translate('Address*') }}</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="Address" placeholder="Enter address" value="{{ old('address') }}" >

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-5">
                                    <input type="hidden" name="user_types[]" value="client">
                                    <button type="submit" id="send_form" class="btn btn-primary">{{ translate('submit') }}</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
