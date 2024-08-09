@extends('frontend.default.layouts.app')

@section('content')
@php 
$header_logo=get_setting('other_header_logo'); 
$google_map_key=get_setting('google_map_key'); 
@endphp
 <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{$google_map_key}}&libraries=places&callback=initialize"></script>
<div class="sign-up-section min-vh-100 overflow-auto">
    <div class="container-fluid px-0">
        <div class="card mb-0 border-0 rounded-0 text-sm-right ">
            <div class="row no-gutters justify-content-start">

                @include('frontend.default.inc.user_sidebar')

                <div class="col-sm-9 form-card" style="height:100vh; overflow:auto;">
                    <div class="card-body form-section">
                        <div class="form-head ">
                            <!-- <h1 class="h3 text-primary mb-0">{{ translate('Welcome back') }}</h1>
                            <p>{{ translate('Login to manage your account') }}.</p> -->
                            <a href="{{url('/')}}">
                            	<img src="{{custom_asset($header_logo)}}" alt="" class="img-fluid">
                            </a>
                            <h2 class="font-weight-bold mt-5 mb-4">Sign Up</h2>
                        </div>
                        <form class="" id="reg-form" method="POST" action="{{ route('register') }}">
                        	@csrf
							<div class="row">
								<div class="col-sm-6">
									<a href="javascript:void(0)" data-toggle="modal" data-target="#requestModal">
										<div class="card text-center">
											<div class="img-top">
												<img src="{{asset('public/uploads/all/card.png')}}" alt="" class="img-fluid">
											</div>
											<h3 class="card-heading text-dark font-weight-bold mt-4">I am a Brand</h3>
										</div>
									</a>
								</div>
								<!-- Modal -->
								<div class="modal my-hire-modal fade" id="requestModal" tabindex="-1" aria-labelledby="requestModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content hire-modal-content">
											<div class="modal-header d-flex align-items-center justify-content-between">
												<h5 class="modal-title h3 fw-600" id="requestModalLabel">Application</h5>
												<button type="button" class="close m-0" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form action="" method="POST" id="request-form"> 
													<div class="row request-form">
														<div class="col-md-6">
															<div class="form-group firstname">
																<label class="h5" for="firstName">First Name*</label>
																<input type="text" class="form-control radius-10" name="firstName" id="firstname" placeholder="First name">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group lastname">
																<label class="h5" for="lastName">Last Name*</label>
																<input type="text" class="form-control radius-10" name="lastName" id="lastname" placeholder="Last name">
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group company_name">
																<label class="h5" for="company_name">Company Name*</label>
																<input type="text" class="form-control radius-10" name="company_name" id="company_name" placeholder="Company name">
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group email">
																<label class="h5" for="email">Email*</label>
																<input type="email" class="form-control radius-10" name="email" id="email" placeholder="Email">
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group myaddress">
													            <label class="h5" for="myAddress">Address*</label>
													            <input type="text" name="autocomplete" id="autocomplete" class="form-control" placeholder="Choose Location">
													            <input type="hidden" class="form-control radius-10" name="myAddress" id="myaddress" placeholder="Address">
													        </div>
													    </div>
													</div>
												</form>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary rounded-pill" data-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-green request_send">Save changes</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-6 mt-5 mt-sm-0 m-auto">
									<a href="{{ url('register/freelancer')}}">
										<div class="card text-center">
											<div class="img-top">
												<img src="{{asset('public/uploads/all/card-2.png')}}" alt="" class="img-fluid">
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
<div class="py-4 py-lg-5">
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
@section('script')
	<script>	
	    google.maps.event.addDomListener(window, 'load', initialize);
        function initialize() {
            var input = document.getElementById('autocomplete');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                var address = place.formatted_address;
                $('#myaddress').val(address);

            });
        }
		$(document).on('click','.request_send',function(e){
			e.preventDefault();
	        var formData={
	        	_token: '{{ csrf_token() }}',
	        	'first_name': $('#firstname').val(),
	        	'last_name': $('#lastname').val(),
	        	'company_name': $('#company_name').val(),
	        	'email': $('#email').val(),
	        	'address': $('#myaddress').val(),
	        }
	        $(".form-group").removeClass("has-error");
    		$(".alert-danger").remove();
	        $('.request_send').prop( "disabled", true );
	        $.ajax({
	            url:"{{ route('create.request') }}",  
	            type: "POST",
	            data:formData ,
	            dataType: 'JSON',
	            success: function( data ) {
	                if(data.status==false){
	                    $('.request_send').prop( "disabled",false);
	                    if (data.errors.firstname) {
	                    	$("#form-group").addClass("has-error");
				          	$(".firstname").append('<div class="alert alert-danger">' +data.errors.firstname+ "</div>");
				        }
				        if (data.errors.lastname) {
	                    	$("#lastname").addClass("has-error");
				          	$(".lastname").append('<div class="alert alert-danger">' + data.errors.lastname + "</div>");
				        } 
				        if (data.errors.company_name) {
	                    	$("#company_name").addClass("has-error");
				          	$(".company_name").append('<div class="alert alert-danger">' + data.errors.company_name + "</div>");
				        }
				        if (data.errors.email) {
	                    	$("#email").addClass("has-error");
				          	$(".email").append('<div class="alert alert-danger">' + data.errors.email + "</div>");
				        }
				        if (data.errors.address) {
	                    	$("#myaddress").addClass("has-error");
				          	$(".myaddress").append('<div class="alert alert-danger">' + data.errors.address + "</div>");
				        }
	                }else{
	                    window.location.reload();
	                }
	            }
	        });
		});
	</script>
@endsection
