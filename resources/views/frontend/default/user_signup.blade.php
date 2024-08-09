@extends('frontend.default.layouts.app')

@section('content')
<div class="sign-up-section min-vh-100 overflow-auto">
    <div class="container-fluid px-0">
        <div class="card mb-0 border-0 rounded-0 text-sm-right ">
            <div class="row no-gutters justify-content-start">

                @include('frontend.default.inc.user_sidebar')

                <div class="col-sm-9 form-card" style="height:100vh; overflow:auto;">
                    <div class="card-body form-section">
                        <div class="form-head">
                            <!-- <h1 class="h3 text-primary mb-0">{{ translate('Welcome back') }}</h1>
                            <p>{{ translate('Login to manage your account') }}.</p> -->
                            <img src="public/uploads/all/CashPost-opa.png" alt="" class="img-fluid">
                            <h2 class="font-weight-bold mt-5 mb-4">Sign Up</h2>
                        </div>
                        <form class="" id="reg-form" method="POST" action="{{ route('register') }}">
                        	@csrf
							<div class="row">
								<div class="col-sm-6">
									<a href="{{ url('register/brand')}}">
										<div class="card text-center">
											<div class="img-top">
												<img src="{{my_asset('uploads/all/card.png') }}" alt="" class="img-fluid">
											</div>
											<h3 class="card-heading text-dark font-weight-bold mt-4">I am a Brand</h3>
										</div>
									</a>
								</div>	
								<div class="col-sm-6 mt-5 mt-sm-0">
									<a href="{{ url('register/influencer')}}">
										<div class="card text-center">
											<div class="img-top">
												<img src="{{my_asset('uploads/all/card-2.png') }}" alt="" class="img-fluid">
											</div>
											<h3 class="card-heading text-dark font-weight-bold mt-4">I am an Influencer</h3>
										</div>
									</a>
								</div>
							</div>	
						</form>
                        <form class="" method="POST" action="{{ route('login') }}">
                        @csrf
							<div class="d-flex aligns-items-center mt-5 justify-content-center h5">
								<p class="text-grey mb-0">{{ translate("Already have an account?") }}</p>
                                <a href="{{ route('login') }}" class="font-weight-bold px-1 text-decoration-underline" style="color:#1492E6;">{{ translate('Login') }}</a>
							</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <div class="py-4 py-lg-5">
	<div class="container">
		<div class="row">
			<div class="col-xxl-4 col-xl-5 col-md-7 mx-auto">
				<div class="card">
					<div class="card-body">
						<div class="mb-5 text-center">
							<h1 class="h3 text-primary mb-0">{{ translate('Sign up') }}</h1>
						</div>
						<form class="" id="reg-form" method="POST" action="{{ route('register') }}">
							@csrf
							<fieldset>
	                            <div class="form-group mb-4">
									<div class="aiz-radio-inline">
										<label class="aiz-radio">
											<a href="{{ url('register/freelancer')}}"> {{ translate('As A Freelancer') }} </a>
										</label>
										<label class="aiz-radio">
											<a href="{{ url('register/client')}}"> {{ translate('As A Client') }}</a>
										</label>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>						

@endsection