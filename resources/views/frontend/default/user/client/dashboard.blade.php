@extends('frontend.default.layouts.app')

@section('content')
<section class="dashboard-section">
	<div class="">
	@include('frontend.default.user.client.inc.sidebar')
	<div class="aiz-user-panel col-12">
			<div class="container">
				<div class="row">
					<div class="col-md-6 mb-5 mb-lg-0">
						<div class="profile-status">
							<div class="heading p-3 d-flex justify-content-between border-bottom align-items-center">
								<div class="d-flex align-items-center">
									<h3 class="font-weight-bold mb-0">{{translate('Completed Campaigns')}}</h3>
								</div>
								<a href="{{ url('/projects/completed-project') }}" class="btn h5 mb-0 font-weight-bold p-0">View all</a>
							</div>

							<div class="card-body my-card-body p-0">
								<ul class="list-group list-group-flush">
								@forelse ($completed_project as $key => $project)
	                                        @php  
	                                        	$client_photo = user_profile_pic($project->client_user_id);
	                                        	$cat_id=$project->project_category_id;
										$image_id=ProjectCategory($cat_id)->photo;
	                                        @endphp
		            					<li class="list-group-item p-4">
		            						<a href="{{ route('project.details', $project->slug) }}" class="text-inherit">
											<div class="card my-card border-0 p-0 mb-0">
												<div class="row no-gutters align-items-center">
													<div class="col-lg-3 list-image mb-2 mb-lg-0">
														@if(custom_asset($image_id))
														<span class="social-icon">
															<img src="{{ custom_asset($image_id) }}" alt="" class="img-fluid">
														</span>
														@else
														<span class="social-icon">
															<img src="{{ my_asset('assets/frontend/default/img/campaign.jpeg') }}" alt="" class="img-fluid">
														</span>
														@endif
													</div>
													<div class="col-lg-9">
														<div class="card-body p-0">
															<div class="list-title mb-2 d-flex justify-content-between font-weight-bold">
																<h4 class="font-weight-bold">{{ $project->name }}</h4>
															</div>
															<div class="list-footer d-flex">
																<h6 class="text-grey text-sm">
																	<!-- <i class="bi bi-building with-icon"></i>{{ (\App\Models\UserProfile::Where('user_id',$project->client_user_id)->first()->company_name) }} -->
																</h6>
															</div>
														</div>
													</div>
												</div>
											</div>
										</a>
									</li>
                                    	@empty
	                                     	<div class="card">
				                              <div class="card-body text-center">
				                                  <i class="las la-frown la-4x mb-4 opacity-40"></i>
				                                  <h4>{{ translate('Nothing Found') }}</h4>
				                              </div>
			                            	</div>
                                  		@endforelse
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="profile-status">
							<div class="heading p-3 d-flex justify-content-between border-bottom align-items-center">
								<div class="d-flex align-items-center aa"><h3 class="font-weight-bold mb-0">{{translate('Active Campaigns')}}</h3>
								</div>
								<a href="{{ url('/projects/running-project') }}" class="btn h5 mb-0 font-weight-bold p-0">View all</a>
							</div>
							<div class="card-body my-card-body p-0">
								<ul class="list-group list-group-flush">
                                   	@forelse ($running_project as $key => $project)
	                                        @php  
	                                        	$client_photo = user_profile_pic($project->client_user_id);
	                                        	$cat_id=$project->project_category_id;
												$image_id=ProjectCategory($cat_id)->photo;
	                                        @endphp
		            					<li class="list-group-item p-4">
		            						<a href="{{ route('project.details', $project->slug) }}" class="text-inherit">
												<div class="card my-card border-0 p-0 mb-0">
													<div class="row no-gutters align-items-center">
														<div class="col-lg-3 list-image mb-2 mb-lg-0">
															@if(custom_asset($image_id))
															<span class="social-icon">
																<img src="{{ custom_asset($image_id) }}"  alt="" class="img-fluid">
															</span>
															@else
															<span class="social-icon">
																<img src="{{ my_asset('assets/frontend/default/img/campaign.jpeg') }}"  alt="" class="img-fluid">
															</span>
															@endif
														</div>
														<div class="col-lg-9">
															<div class="card-body p-0">
																<div class="list-title mb-2 d-flex justify-content-between font-weight-bold">
																	<h4 class="font-weight-bold">{{ $project->name }}</h4>
																</div>
																<div class="list-footer d-flex">
																	<h6 class="text-grey text-sm">
																		<!-- <i class="bi bi-building with-icon"></i>{{ (\App\Models\UserProfile::Where('user_id',$project->client_user_id)->first()->company_name) }} -->
																	</h6>
																</div>
															</div>
														</div>
													</div>
												</div>
											</a>
										</li>
                                    		@empty
		                                        <div class="card">
					                              <div class="card-body text-center">
					                                  <i class="las la-frown la-4x mb-4 opacity-40"></i>
					                                  <h4>{{ translate('Nothing Found') }}</h4>
					                              </div>
				                            	</div>
                                   		@endforelse
								</ul>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')

@endsection
