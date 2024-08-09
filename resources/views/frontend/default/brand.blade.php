@extends('frontend.default.layouts.app')

@section('content')
    @if ( get_setting('brand_slider_section_show') == 'on')
        <section class="banner banner-cloned pt-lg-7 pt-md-1 overflow-hidden  position-relative">
        	<div class="container">
        		<div class="row">
        			<div class="col-sm-6 banner-content p-sm-0">
						<!-- <h1 class="font-weight-bold mb-3 fs-56 text-white">Make money sharing stuff on social media.</h1> -->
    		    		<h1 class="font-weight-xx-bold mb-lg-3 mb-1 brand-heading text-white">{{ get_setting('brand_slider_section_title') }}</h1>
    		    		<p class="lead section-subtitle mb-lg-4 mb-3">
                            @php
                                echo get_setting('brand_slider_section_subtitle');
                            @endphp
                        </p>
    		    		<div>
    		    			<a href="{{ route('register') }}" class="btn btn-green-lg h6">{{ translate('Discover Influencers') }}</a>

    		    			<!-- <a href="{{ route('register') }}" class="btn btn-outline-primary">{{ translate('I want to Work') }}</a> -->
    		    		</div>

						<div class="d-flex align-items-center flex-lg-row know-more" id="HOW_TO_WORK">
							<a href="#" class="btn text-white pr-0 h5">Want to know more?</a>
							<a href="#" class="btn pop-up h5 d-flex align-items-center text-green"  data-toggle="modal" data-target="#exampleModal"><span class="play-btn-border position-relative d-flex align-items-center justify-content-center"><span class="play-btn-bg align-items-center d-flex justify-content-center"><i class="bi bi-play-fill h3 mb-0 text-white"></i></span></span>How it works</a>
							<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog">
								  <div class="modal-content">
									<div class="modal-header border-0 py-3 d-flex justify-content-end">
									  <button type="button" class="close m-0 py-0" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									  </button>
									</div>
									<div class="modal-body p-0">
									<iframe class="w-100" height="340" src="https://www.youtube.com/embed/6HHmYOa_6sk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"  allowfullscreen></iframe>
									</div>
								  </div>
								</div>
							  </div>
						</div>
        			</div>
					<div class="col-sm-6 banner-image">
                            @if (get_setting('brand_sliders') != null)
                            @foreach (explode(',', get_setting('brand_sliders')) as $key => $value)
                                <img class="img-fluid" src="{{ custom_asset($value) }}">
                            @endforeach
                        @endif							
					</div>
        		</div>
        	</div>
        </section>
	</div>
    @endif
    @if( get_setting('brand_client_logo_show') == 'on')
        <section class="py-3 brand-section position-relative">
        	<div class="container">
        		<div class="row align-items-center">
					<div class="col-md-1 p-0">
						<h6 class="text-grey text-center">Trusted by</h6>
					</div>
					<div class="col-md-11">
						<div class="aiz-carousel gutters-5" data-autoplay='true' data-items="7" data-xl-items="6" data-lg-items="5" data-md-items="4" data-sm-items="3" data-xs-items="2" data-infinite='true'>
                                @if (get_setting('brand_client_logos') != null)
                                @foreach (explode(',', get_setting('brand_client_logos')) as $key => $value)
                                    <div class="caorusel-box">
                                        <img class="img-fluid" src="{{ custom_asset($value) }}">
                                    </div>
                                @endforeach
                            @endif
						</div>
					</div>
        		</div>
        	</div>
        </section>
    @endif
    @if( get_setting('brand_how_it_works_show') == 'on')
    <section class="pt-7 pb-4 get-started bg-white position-relative overflow-hidden">
		<span class="position-absolute design-1"><img src="{{asset('public/uploads/all/Group530.png')}}"></span>
    	<div class="container">
    		<div class="mb-5 w-xl-50 w-lg-75 mx-auto text-center">
    			<h2 class="font-weight-bold">{{ get_setting('brand_how_it_works_title') }}</h2>

    			<h3 class="text-grey coustom-text">@php echo get_setting('brand_how_it_works_subtitle') @endphp</h3>

    		</div>
    		<div class="row justify-content-center">
    			<div class="col-sm-4">
    				<div class="mb-4 px-xl-4 px-md-3">
    					<div class="text-center text-sm-right"><img src="{{ custom_asset( get_setting('brand_how_it_works_banner_1') ) }}" class="img-fluid mx-auto"></div>
    					<div class="py-4 my-card-body">
    						@php
                                echo get_setting('brand_how_it_works_description_1')
                            @endphp
    					</div>
    				</div>
    			</div>
    			<div class="col-sm-4">
    				<div class="mb-4 px-xl-4 px-md-3">
                        <div class="text-center text-sm-right"><img src="{{ custom_asset( get_setting('brand_how_it_works_banner_2') ) }}" class="img-fluid mx-auto"></div>
    					<div class="py-4 my-card-body">
                            @php
                                echo get_setting('brand_how_it_works_description_2')
                            @endphp
    					</div>
    				</div>
    			</div>
    			<div class="col-sm-4">
    				<div class="mb-4 px-xl-4 px-md-3">
                        <div class="text-center text-sm-right"><img src="{{ custom_asset( get_setting('brand_how_it_works_banner_3') ) }}" class="img-fluid mx-auto"></div>
    					<div class="py-4 my-card-body">
                            @php
                                echo get_setting('brand_how_it_works_description_3')
                            @endphp
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>
	@endif
    @if ( get_setting('brand_featured_category_show') == 'on')
        
		<section class="importance-section clone-section position-relative overflow-hidden">
			<span class="position-absolute design-1"><img src="{{asset('public/uploads/all/Ellipse222.png')}}"></span>
			<span class="position-absolute design-2"><img src="{{asset('public/uploads/all/Group777.png')}}"></span>
                <div class="influencer-power overflow-hidden py-5">
                    <div class="container">
                        <div class="row align-items-center justify-content-start">
                            <div class="col-lg-5 p-lg-0">
                                <div class="importance-content">
                                    <h2 class="font-weight-bold mb-3">{{ get_setting('brand_featured_category_title') }}</h2>
                                    <!-- <p class=" text-grey">{{ get_setting('brand_featured_category_description') }}</p> -->
                                    <h3 class="text-grey">
                                        CashPost incentivizes regular, everyday people to post your content to their social media accounts (in exchange for cash) It's an effective marketing strategy that costs less than traditional influencer campaigns.
									</h3>
                                </div>
                            </div>	
                            <div class="col-lg-6">
                                <div class="importance-image text-center">
                                    <img src="{{ custom_asset( get_setting('brand_featured_category_left_banner')) }}" class="img-fluid">
                                </div>
                            </div>	
                        </div>
                    </div>   
                </div>     
                <div class="social-engagement py-7">
                    <div class="container">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-lg-5 order-last  mt-5 mt-lg-0 p-lg-0">
                                <div class="importance-content">
                                    <h2 class="font-weight-bold mb-3">{{ get_setting('brand_featured_category_title_1') }}</h2>
                                    <h3 class=" text-grey">{{ get_setting('brand_featured_category_description_1') }}</h3>
                                </div>
                            </div>	
                            <div class="col-lg-5 order-first">
                                <div class="importance-image text-center">
                                    <img src="{{ custom_asset( get_setting('brand_featured_category_left_banner_1')) }}" class="img-fluid">
                                </div>
                            </div>	
                        </div>
                    </div>
                </div>
		</section>
    @endif
	@if( get_setting('brand_testimonial_show') == 'on')
	<section class="testimonial-section position-relative py-5 overflow-hidden">
		<span class="position-absolute design-1"><img src="{{asset('public/uploads/all/Group530.png')}}" class="img-fluid"></span>
		<span class="position-absolute design-2"><img src="{{asset('public/uploads/all/Group435.png')}}" class="img-fluid"></span>
		<div class="container">
			<div class="row justify-content-center">

				<div class="col-md-12 text-center mb-5">
					<h2 class="font-weight-bold testimonial-heading">
                        @php
                            echo get_setting('brand_testimonial_title')
                        @endphp
                    </h2>
                    </div>

				<div class="col-md-8">
					<div class="card testimonial-card mb-3 border-0 shadow-none position-relative">
						<span class="d-flex quotes position-absolute align-items-center justify-content-center"><i class="bi bi-quote h2 mb-0 text-white"></i></span>
						<div class="slick">
							@if(get_setting('brand_testimonial_name_1') && get_setting('brand_testimonial_description_1'))
							<div class="row d-flex no-gutters align-items-center">				
								<div class="col-lg-4 col-6 testimonial-img">
									<img src="{{ custom_asset( get_setting('brand_testimonial_banner_1') ) }}" alt="..." class="img-fluid">
								</div>
								<div class="col-lg-8 col-6">
									<div class="card-body">
									<h5 class="card-title mb-4">
										@php
                                            echo get_setting('brand_testimonial_description_1')
                                        @endphp
									</h5>
									<p class="card-text text-green">
										@php
                                            echo get_setting('brand_testimonial_name_1')
                                        @endphp</p>
									</div>
								</div>
							</div>
							@endif
						    @if(get_setting('brand_testimonial_name_2') && get_setting('brand_testimonial_description_2'))
							<div class="row d-flex no-gutters align-items-center">				
								<div class="col-lg-4 col-6 testimonial-img">
									<img src="{{ custom_asset( get_setting('brand_testimonial_banner_2') ) }}" alt="..." class="img-fluid">
								</div>
								<div class="col-lg-8 col-6">
									<div class="card-body">
									<h5 class="card-title mb-4">
										@php
                                            echo get_setting('brand_testimonial_description_2')
                                        @endphp
									</h5>
									<p class="card-text text-green">
										@php
                                            echo get_setting('brand_testimonial_name_2')
                                        @endphp</p>
									</div>
								</div>
							</div>
							@endif
							@if(get_setting('brand_testimonial_name_3') && get_setting('brand_testimonial_description_3'))
							<div class="row d-flex no-gutters align-items-center">				
								<div class="col-lg-4 col-6 testimonial-img">
									<img src="{{ custom_asset( get_setting('brand_testimonial_banner_3') ) }}" alt="..." class="img-fluid">
								</div>
								<div class="col-lg-8 col-6">
									<div class="card-body">
									<h5 class="card-title mb-4">
										@php
                                            echo get_setting('brand_testimonial_description_3')
                                        @endphp
									</h5>
									<p class="card-text text-green">
										@php
                                            echo get_setting('brand_testimonial_name_3')
                                        @endphp</p>
									</div>
								</div>
							</div>
							@endif
							@if(get_setting('brand_testimonial_name_4') && get_setting('brand_testimonial_description_4'))
							<div class="row d-flex no-gutters align-items-center">				
								<div class="col-lg-4 col-6 testimonial-img">
									<img src="{{ custom_asset( get_setting('brand_testimonial_banner_4') ) }}" alt="..." class="img-fluid">
								</div>
								<div class="col-lg-8 col-6">
									<div class="card-body">
									<h5 class="card-title mb-4">
										@php
                                            echo get_setting('brand_testimonial_description_4')
                                        @endphp
									</h5>
									<p class="card-text text-green">
										@php
                                            echo get_setting('brand_testimonial_name_4')
                                        @endphp</p>
									</div>
								</div>
							</div>
							@endif
							@if(get_setting('brand_testimonial_name_5') && get_setting('brand_testimonial_description_5'))
							<div class="row d-flex no-gutters align-items-center">				
								<div class="col-lg-4 col-6 testimonial-img">
									<img src="{{ custom_asset( get_setting('brand_testimonial_banner_5') ) }}" alt="..." class="img-fluid">
								</div>
								<div class="col-lg-8 col-6">
									<div class="card-body">
									<h5 class="card-title mb-4">
										@php
                                            echo get_setting('brand_testimonial_description_5')
                                        @endphp
									</h5>
									<p class="card-text text-green">
										@php
                                            echo get_setting('brand_testimonial_name_5')
                                        @endphp</p>
									</div>
								</div>
							</div>
							@endif
						</div>	
					</div>
				</div>
			</div>
		</div>
	</section>
	@endif
    @if( get_setting('brand_faq_show') == 'on')
	<section class="faq-section py-7">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<div class="faq-heading text-center mb-5">
						<h2 class="font-weight-bold">
							@php
                                echo get_setting('brand_faq_title');
                            @endphp
						</h2>
					</div>
					<div class="faq-question">
						<div class="accordion accordion-flush" id="accordionExample">
							@foreach($faqs as $key =>$val)
                                @php
                                    $class="text-center text-sm-right";
                                    $expanded="false";
                                    $collapsed="collapsed";
                                    if($key==0){
                                      $class="show";
                                      $expanded="true";
                                      $collapsed="";
                                    }
                                @endphp
                                <div class="accordion-item">
								  <h3 class="accordion-header" id="heading{{$key}}">
									<button class="accordion-button h3 {{$collapsed}}" type="button" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="{{$expanded}}" aria-controls="collapse{{$key}}">
                                        {{$val->title}}
                                    </button>
								  </h3>
                                  <div id="collapse{{$key}}" class="accordion-collapse collapse {{$class}}" aria-labelledby="heading{{$key}}" data-parent="#accordionExample">
                                    <div class="accordion-body h5 text-grey">
                                        {{$val->description}}
                                    </div>
                                  </div>
								</div>
							@endforeach
						</div>
				</div>
			</div>
		</div>
	</section>
    @endif
@endsection

@section('modal')
	@if((Session::has('new_user') && Session::get('new_user') == true) || (auth()->check() && auth()->user()->user_type == null))
		<div class="modal fade" id="show_new_user_modal">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">{{ translate('Choose your account Type') }}</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body" id="show_modal_body">
						<form action="{{ route('user.account.type') }}" method="POST">
							@csrf
							<div class="form-group">
								<label for="user_type">User Type</label>
								<select name="user_type" id="user_type" class="form-control aiz-selectpicker">
									<option value="client">Client</option>
									<option value="freelancer">Freelancer</option>
								</select>
							</div>

							<div class="form-group text-right">
								<button type="submit" class="btn btn-primary">{{ translate('Proceed') }}</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
@endif

@endsection

@section('script')
	<script>
		@if((Session::has('new_user') && Session::get('new_user') == true) || (auth()->check() && auth()->user()->user_type == null))
			$('#show_new_user_modal').modal({show:true});
		@endif


		
		$(document).on('click','.request_send',function(e){
			e.preventDefault();
	        var formData={
	        	_token: '{{ csrf_token() }}',
	        	'first_name': $('#firstname').val(),
	        	'last_name': $('#lastname').val(),
	        	'email': $('#email').val(),
	        	'address': $('#myaddress').val(),
	        	'description': $('#description').val()
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
				        if (data.errors.email) {
	                    	$("#email").addClass("has-error");
				          	$(".email").append('<div class="alert alert-danger">' + data.errors.email + "</div>");
				        }
				        if (data.errors.address) {
	                    	$("#myaddress").addClass("has-error");
				          	$(".myaddress").append('<div class="alert alert-danger">' + data.errors.address + "</div>");
				        }
				        if (data.errors.description) {
	                    	$("#description").addClass("has-error");
				          	$(".description").append('<div class="alert alert-danger">' + data.errors.description + "</div>");
				        }
	                }else{
	                    window.location.reload();
	                }
	            }
	        });
		});
	</script>
@endsection
