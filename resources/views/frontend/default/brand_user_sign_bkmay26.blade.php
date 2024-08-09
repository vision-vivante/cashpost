@extends('frontend.default.layouts.app')
<style>
#loader {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  background: rgba(0,0,0,0.75) url(https://cashpost.net/public/uploads/images/loader1.gif) no-repeat center center;
  z-index: 10000;
}
</style>

@section('content')
@php 
$header_logo=get_setting('other_header_logo'); 
$google_map_key=get_setting('google_map_key'); 
@endphp

<div class="sign-up-section step-3">
    <div class="container-fluid px-0">
        <div class="card mb-0 border-0 rounded-0 text-sm-right ">
            <div class="row no-gutters justify-content-start">

                @include('frontend.default.inc.user_sidebar')

				<div class="col-sm-9 form-side" style="height:100vh; overflow:auto;">
					<div class="card-body">

						<div class="mb-4">
							<!-- <h2 class="font-weight-bold">Get your project done today</h2> -->
							<p class="mb-5 font-weight-bold">If you are interested in advertising your Brand on CashPost, contact us so that we can discuss your advertising goals.</p>
						</div>
						<div class="alert alert-danger __errorDiv" style="display:none">
					        <ul></ul>
					    </div>
							<form action="" method="POST" id="request-form"> 
								 @csrf
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
											<label class="h5" for="company_name">Brand Name*</label>
											<input type="text" class="form-control radius-10" name="company_name" id="company_name" placeholder="Brand name">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group email">
											<label class="h5" for="email">Email*</label>
											<input type="email" class="form-control radius-10" name="email" id="email" placeholder="Email">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group phone">
											<label class="h5" for="phone_no">Phone*</label>
											<input type="number" class="form-control radius-10" name="phone_no" id="phone_no" placeholder="phone number" required>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group myaddress">
								            <label class="h5" for="myAddress">Address*</label>
								            <input type="text" name="autocomplete" id="autocomplete" class="form-control" placeholder="Choose Location">
								            <input type="hidden" class="form-control radius-10" name="myAddress" id="myaddress" placeholder="Address">
								        </div>
								    </div>
								    <div class="col-md-12">
										<div class="form-group message">
											<label class="h5" for="message">Message*</label>
											<textarea class="form-control radius-10" name="message" id="message" placeholder="Enter message"></textarea>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
						                   <div class=" g-recaptcha"  data-sitekey="{{ env('GOOGLE_RECAPTCHA_SITE_KEY') }}" ></div>
					                	</div>
					                	<div id="r_captcha" class="captcha"></div>
					                </div>
								</div>	
							</form>
							<div class="modal-footer">
								<!-- <button type="button" class="btn btn-secondary rounded-pill" data-dismiss="modal">Close</button> -->
								<button type="submit" class="btn btn-green request_send" id="request_send">Submit</button>
							</div>
							<div id="loader"style="display:none" role="status">
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
                            @endif

                            <div class="text-center">
                                <p class="text-muted mb-0">{{ translate("Already have an account?") }}</p>
                                <a href="{{ route('login') }}">{{ translate('Login to your account') }}</a>
                            </div> -->
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')

<script src="https://www.google.com/recaptcha/api.js" async defer>
	// $(document).ready(function(){
	// 	$("#request_send").on("submit", function(evt)
	// 	{
	// 		var response = grecaptcha.getResponse();
	// 		if(response.length == 0)
	// 		{
	// 		//reCaptcha not verified
	// 			alert("please verify you are humann!");
	// 			evt.preventDefault();
	// 			return false;
	// 		}
	// 		//captcha verified
	// 		//do the rest of your validations here
	// 		$("#request_send").submit();
	// 	});
	// });


</script>




<script>
	$("#send_form").click(function (e) {
		var step = $(this).attr('data-step');
	    var firstStep = $("#reg-form").validate({  
	        rules: {
	            first_name: {
	                required: true,
	                maxlength: 50
	            }, 
	            last_name: {
	                required: true,
	                maxlength: 50
	            },
	            company_name: {
	                required: true,
	                maxlength: 50
	            },
	            user_avatar: {
		            required: true,
		            //extension: "jpeg,png,jpg,gif,svg"
		        },
	            email: {
	                required: true,
	                maxlength: 50,
	                email: true,
	            },
	            password: {
			        required: true,
			        minlength: 6
		      	},
		      	password_confirmation: {
		            required: true,
		            minlength: 6,
		            equalTo: '[name="password"]'
		      	},
		      	condition: {
		            required: true,
		      	},
	        },
	        messages: {
	            first_name: {
	                required: "Please enter first name",
	            },
	            last_name: {
	                required: "Please enter last name",
	            },  
	            company_name: {
	                required: "Please enter brand company name",
	            },
	            /*user_avatar: {
		            required: "Please upload brand logo",
		            extension: "jpeg,png,jpg,gif,svg"
		        },*/
	            email: {
	                required: "Please enter valid email",
	                email: "Please enter valid email",
	                maxlength: "The email name should less than or equal to 50 characters",
	            },
	            password: {
	                required: "Please enter password",
	                minlength: "Minimun 6 characters",
	                maxlength: "Please enter min 6 characters",
	            },
	            password_confirmation: {
	                required: "Please enter password",
	                minlength: "Minimun 6 characters",
	                maxlength: "Enter Confirm Password Same as Password",
	            },

	        },
	        submitHandler: function(form) {
	        	ajax_data(e,step,$(this));
	        }
	    })
	});
	
    /*ajax function*/
    $(document).on('submit','#reg-form',function(e){
    	e.preventDefault();
    	return;
    })
	function ajax_data(e,step,element){
		let myForm = document.getElementById('reg-form');
		var formdata = new FormData(myForm);
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
		$.ajax({
	        url:"{{url('validate')}}/"+step,  
	        type: "POST",
	        data: formdata,
	        contentType: false,
            cache: false,
            processData:false,
	        success: function( response ) {
	        	if(response.status == false){
	        		printErrorMsg(response.success);
	        		e.preventDefault();
                    return;
	        	}else{
	        		$(".__errorDiv").css('display','none');
	        		document.forms["reg-form"].submit();
				}
	        }
	    });
	    function printErrorMsg (msg) {
            $(".__errorDiv").find("ul").html('');
            $(".__errorDiv").css('display','block');
            $.each( msg, function( key, value ) {
                $(".__errorDiv").find("ul").append('<li>'+value+'</li>');
            });
        }
	}


	
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{$google_map_key}}&libraries=places"></script>
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
			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });
	        var formData={
	        	_token: '{{ csrf_token() }}',
	        	'first_name': $('#firstname').val(),
	        	'last_name': $('#lastname').val(),
	        	'company_name': $('#company_name').val(),
	        	'email': $('#email').val(),
	        	'address': $('#myaddress').val(),
	        	'phone_no': $('#phone_no').val(),
	        	'message': $('#message').val(),
	        	'r_captcha': grecaptcha.getResponse()
	        	
	        }
	        $(".form-group").removeClass("has-error");
    		$(".alert-danger").remove();
	        $('.request_send').prop( "disabled", true );
	        // document.getElementById("panel").style.display = "block";
	        $('#loader').show();
	        $.ajax({
	            url:"{{ route('create.request') }}",  
	            type: "POST",
	            data:formData ,
	            dataType: 'JSON',
	            success: function( data ) {
	            	
	            	console.log(data,'responsedata');
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
				        if (data.errors.phone_no) {
	                    	$("#phone_no").addClass("has-error");
				          	$(".phone").append('<div class="alert alert-danger">' + data.errors.phone_no + "</div>");
				        }
				        if (data.errors.message) {
	                    	$("#message").addClass("has-error");
				          	$(".message").append('<div class="alert alert-danger">' + data.errors.message + "</div>");
				        }
				        if (data.errors.r_captcha) {
				        	
	                    	$("#r_captcha").addClass("has-error");
				          	$(".captcha").append('<div class="alert alert-danger">' + data.errors.r_captcha + "</div>");
				        }
	                }
	                else{

	                	alert('Thanks for contacting us. We will get back to you soon.');
	                	document.getElementById("request-form").reset();
	                }
	               // $("#request-form")[0].reset();
	               $('.request_send').prop( "disabled", false );
	            },
	            complete: function(){
		            $('#loader').hide();
		        },
	            error: function (jqXHR, exception) {
	            	var msg = '';
	            	 if (jqXHR.status === 0) {
			            alert('Not connect.\n Verify Network.') ;
			        } else if (jqXHR.status == 404) {
			            alert('Something wrong please try again after some time [404]');
			        } else if (jqXHR.status == 500) {
			            alert('Something wrong please try again after some time [500].');
			        } else if (exception === 'parsererror') {
			            alert('Requested JSON parse failed.');
			        }  else if (exception === 'abort') {
			            alert('Ajax request aborted.');
			        } else {
			            alert('Uncaught Error.\n' + jqXHR.responseText);
			        }
	            }
	        });
		});
		
	</script>
	
@endsection