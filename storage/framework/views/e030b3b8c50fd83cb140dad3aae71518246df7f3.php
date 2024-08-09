


<?php $__env->startSection('content'); ?>
<?php
    $type = isset($_GET['type']) ? $_GET['type'] : '';  
    $search = isset($_GET['search']) ? $_GET['search'] : '';  
    $project = isset($_GET['project']) ? $_GET['project'] : '';  
    $ethnicity = isset($_GET['ethnicity']) ? $_GET['ethnicity'] : '';  
    $gender = isset($_GET['gender']) ? $_GET['gender'] : '';  
    $religion = isset($_GET['religion']) ? $_GET['religion'] : '';  
    $type = isset($_GET['type']) ? $_GET['type'] : '';  
    $age = isset($_GET['age']) ? $_GET['age'] : '0';  
    $state_id = isset($_GET['state_id']) ? $_GET['state_id'] : '';  
    $follower = isset($_GET['follower']) ? $_GET['follower'] : '';  
    $fb = isset($_GET['fb']) ? $_GET['fb'] : '';  

    $min = isset($_GET['min_age']) ? $_GET['min_age'] : '18';  
    $max = isset($_GET['max_age']) ? $_GET['max_age'] : '65';  

    $country=\App\Models\Country::where('code','US')->first();
	$country_id=(isset($country->id)) ? $country->id : '';
    $location=get_city_by_country($country_id);
?>
<section class="find-job-section">
		<div class="aiz-user-panel find-influencer">
			<div class="container">
				<div class="find-job-heading">
					<div class="title mt-3 mt-md-5">

					</div>


					<div class="sub-title mb-3">
						<h3 class="font-weight-bold mb-0"> <?php echo e($users->total()); ?> Potential Influencers</h3>
					</div>
				</div>

				<div class="row position-relative filter_row">
				<button type="button" class="position-absolute btn filter_btn" onclick="myFunc()"> <i class="bi bi-funnel-fill"></i></button>
				<div id="filter_job" class="col-lg-3 filter-job">
					<button type="button" class="position-absolute btn filter_close" onclick="myFunc()"><i class="bi bi-x-lg"></i></button>	
					<div class="col-md-12 p-0 text-left">
						<a  onclick="Filter_clear()" class="btn text-danger h5 px-0 mb-1"><i class="bi h4 font-weight-bold bi-x"></i> Clear </a>
					</div>
					<form class="" id="sort_projects" action="" method="GET">
							<div class="">
								<div class="search-job mb-3 mb-md-0">
									<div class="input-group">
										<div class="input-group-append">
											<button class="btn" type="submit">
												<i class="bi bi-search h4 text-grey"></i>
											</button>
										</div>
										<input type="text" class="form-control h5" placeholder="Search by name" name="search" <?php if(isset($sort_search)): ?> value="<?php echo e($sort_search); ?>" <?php endif; ?>>
									</div>
								</div>
								<div class="col-md-12 p-0">

								<div class="sort-job client-side px-0 my-3">

									<h6 class="p-0 mt-0">Ethnicity:</h6>

									<select class="form-control aiz-selectpicker mb-2 mb-md-0" name="ethnicity" id="ethnicity">
											<option value=""><?php echo e(translate('Select')); ?></option>
											<option value="1" <?php if(isset($ethnicity)): ?> <?php if($ethnicity == '1'): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo e(translate('White')); ?></option>
											<option value="2" <?php if(isset($ethnicity)): ?> <?php if($ethnicity == '2'): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo e(translate('African American')); ?></option>
											<option value="3" <?php if(isset($ethnicity)): ?> <?php if($ethnicity == '3'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Hispanic')); ?></option>
											<option value="4" <?php if(isset($ethnicity)): ?> <?php if($ethnicity == '4'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Asian')); ?></option>
											<option value="5" <?php if(isset($ethnicity)): ?> <?php if($ethnicity == '5'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Native American')); ?></option>
											<option value="6" <?php if(isset($ethnicity)): ?> <?php if($ethnicity == '6'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Other')); ?></option>
											<option value="7" <?php if(isset($ethnicity)): ?> <?php if($ethnicity == '7'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate("Didn't Specify")); ?></option>		
									</select>
								</div>

								</div>

								<div class="col-md-12 p-0">
									<div class=" sort-job client-side px-0 my-3">
										<h6 class="p-0 mt-0">Gender:</h6>
										<select name="gender" class="form-control aiz-selectpicker mb-2 mb-md-0">
											<option class="text-grey" value=""><?php echo e(translate('Select')); ?></option>
											<option value="male"  <?php if(isset($gender)): ?> <?php if($gender == 'male'): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo e(translate('Male')); ?></option>
											<option value="female"  <?php if(isset($gender)): ?> <?php if($gender == 'female'): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo e(translate('Female')); ?></option>
											<option value="other"  <?php if(isset($gender)): ?> <?php if($gender == 'other'): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo e(translate('Other')); ?></option>
										</select>
									</div>
								</div>
								<div class="col-md-12 p-0">
									<div class="sort-job client-side px-0 my-3">
										<h6 class="p-0 mt-0">Religion:</h6>
										<select name="religion" class="form-control aiz-selectpicker mb-2 mb-md-0" name="religion" id="religion">
												<option value=""><?php echo e(translate('Select')); ?></option>
												<option value="1"  <?php if(isset($religion)): ?> <?php if($religion == '1'): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo e(translate('Christian')); ?></option>
												<option value="2" <?php if(isset($religion)): ?> <?php if($religion == '2'): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo e(translate('Muslim')); ?></option>
												<option value="3" <?php if(isset($religion)): ?> <?php if($religion == '3'): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo e(translate('Buddhist')); ?></option>
												<option value="4" <?php if(isset($religion)): ?> <?php if($religion == '4'): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo e(translate('Other')); ?></option>
												<option value="5" <?php if(isset($religion)): ?> <?php if($religion == '5'): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo e(translate("Didn't Specify")); ?></option>
										</select>	
									</div>
								</div>
								<div class="col-md-12 p-0">
									<div class="sort-job client-side px-0 my-3">
										<h6 class="p-0 mt-0">Social Media:</h6>
										<select class="form-control aiz-selectpicker mb-2 mb-md-0" name="type" id="type">
											<option value=""><?php echo e(translate('Choose Social Media')); ?></option>
											<option value="facebook" <?php if(isset($col_name)): ?> <?php if($col_name == 'facebook'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Facebook')); ?></option>
											<option value="instagram" <?php if(isset($col_name)): ?> <?php if($col_name == 'instagram'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Instagram')); ?></option>
											<option value="tiktok" <?php if(isset($col_name)): ?> <?php if($col_name == 'tiktok'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('TikTok')); ?></option>
											<option value="twitter" <?php if(isset($col_name)): ?> <?php if($col_name == 'twitter'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('Twitter')); ?></option>
											<option value="youtube" <?php if(isset($col_name)): ?> <?php if($col_name == 'youtube'): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e(translate('YouTube')); ?></option>
										</select>
									</div>
								</div>
								<div class="col-md-12 p-0">
									<div class="sort-job client-side px-0 my-3">
										<h6 class="p-0 mt-0 social_heading_yt" <?php if($type=='youtube'): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>Subscribers:</h6>
										<h6 class="p-0 mt-0 social_heading"  <?php if( !empty($type) && $type!='youtube'): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>Followers:</h6>
							                
											<div class="fb_follower" <?php if($type=='facebook'): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>
												<div class="form-check">
													<label class="form-check-label" for="fb1">
														<input class="form-check-input" type="radio" id="fb1" name="fb" value="1-100"  <?php if($fb == '1-100'): ?> checked <?php endif; ?>>1-100
													</label>
												</div>
												<div class="form-check">
													<label class="form-check-label" for="fb2">
												  		<input class="form-check-input" type="radio" name="fb" id="fb2" value="100-2500"<?php if($fb == '100-2500'): ?> checked <?php endif; ?>>100-2500
												  	</label>
												</div>
												<div class="form-check">
													<label class="form-check-label" for="fb3">
												  		<input class="form-check-input" type="radio" id="fb3" name="fb" value="2500-50000" <?php if($fb == '2500-50000'): ?> checked <?php endif; ?>>2500-50000
												  	</label>
												</div>
											</div>
								
											<div class="other_follower" <?php if( !empty($type) && $type!='facebook'): ?> style="display: block;" <?php else: ?> style="display: none;" <?php endif; ?>>
												<div class="form-check">
													<label class="form-check-label" for="follower1">
														<input class="form-check-input" type="radio" name="follower" id="follower1" value="1-100" <?php if($follower == '1-100'): ?> checked <?php endif; ?> >1-100
													</label>
												</div>
												<div class="form-check">
													<label class="form-check-label" for="follower2">
												  		<input class="form-check-input" type="radio" name="follower" id="follower2" value="100-2500" <?php if($follower == '100-2500'): ?> checked <?php endif; ?> >
												  	100-2500</label>
												</div>
												<div class="form-check">
													<label class="form-check-label" for="follower3">
												  		<input class="form-check-input" type="radio" name="follower" id="follower3" value="2500-10k" <?php if($follower == '2500-10k'): ?> checked <?php endif; ?>> 2500-10k
												  	</label>
												</div>
												<div class="form-check">
													<label class="form-check-label" for="follower4">
												  		<input class="form-check-input" type="radio" name="follower" id="follower4" value="10k+" <?php if($follower == '10k+'): ?> checked <?php endif; ?>>10k+
												  	</label>
												</div>
											</div>
								
									</div>
								</div>

							</div>


							<div class="col-md-12 p-0">
								<div class="sort-job client-side px-0 my-3">
									<h6 class="p-0 mt-0 mb-3">Age:</h6>
									<div id="slider-range" data-price-min="18" data-price-max="65" data-set-min="<?php if(!empty($min)): ?><?php echo e($min); ?><?php endif; ?>" data-set-max="<?php if(!empty($max)): ?><?php echo e($max); ?><?php endif; ?>"></div>
									<p class="price-filters mb-0 mt-3 d-flex justify-content-between">
										<input type="number" class="border-0" id="price-filter-min" name="min_age" placeholder=18 aria-label="Minimum price for filtering products" value="<?php echo e($min); ?>" readonly>
										<input type="number" class="border-0" id="price-filter-max" placeholder=65 name="max_age" value="<?php echo e($max); ?>" style="margin-left: 57px;" readonly>
										<span class="age_span"><?php if($max==65): ?>+<?php endif; ?></span>
									</p>

								</div>
								<div class="col-md-12 p-0">
									<div class="sort-job client-side px-0 my-3">
										<h6 class="p-0 mt-0">Location:</h6>
										<select class="form-control aiz-selectpicker <?php $__errorArgs = ['state_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="state_id" data-live-search="true" id="state_id">
											<option value=""><?php echo e(translate ('Select')); ?></option>
											<?php $__currentLoopData = $location; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($value->id); ?>" <?php if($value->id == $state_id): ?> selected <?php endif; ?>><?php echo e($value->name); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                                    </select>	
									</div>
								</div>
								<div class="col-md-12 p-0">
									<div class="sort-job client-side px-0 my-4">
										<button class="btn btn-green-lg" type="button" onclick="sort_projects()">Apply</button>											
									</div>
								</div>
							</div>
						</form>
					</div>

					<div class="col-lg-9">
						<div class="find-jobs-cards">
					<div class="row">
						<?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
						<div class="find-jobs-cards-main p-sm-0 col-12">
							<div class="card job-card shadow-none border-0 bg-transparent">
								<div class="card-body row p-2">

									<div class="list-img p-0 col-md-2 col-sm-4">
										<?php if(custom_asset($user->photo)): ?>
											<a href="<?php echo e(route('influencer.detail', $user->user_name)); ?>"> <img class="img-fluid radius-10" src="<?php echo e(custom_asset($user->photo)); ?>"></a>
										<?php else: ?>
											<a href="<?php echo e(route('influencer.detail', $user->user_name)); ?> "> <img class="img-fluid radius-10" src="<?php echo e(my_asset('assets/frontend/default/img/avatar-place.png')); ?>"></a>
										<?php endif; ?>
									</div>

									<div class="col-md-10 col-sm-8">
										<div class="card-main d-flex justify-content-between align-items-center mt-3 mt-sm-0">
											<div>
												<h3 class="font-weight-bold">
													<a class="text-dark" href="<?php echo e(route('influencer.detail', $user->user_name)); ?>"><?php echo e($user->name); ?>

													<?php if((isset($user->profile->gender)) && $user->profile->gender== 'male'): ?>
														<span class="male-icon"><i class="bi bi-gender-male"></i></span>
													<?php elseif((isset($user->profile->gender)) && $user->profile->gender == 'female'): ?>
														<span class="female-icon"><i class="bi bi-gender-female"></i></span>
													<?php elseif((isset($user->profile->gender)) && $user->profile->gender == 'other'): ?>
														<span class="transgender-icon">
														<i class='bi bi-gender-trans text-danger'></i>
														</span>
													<?php endif; ?>
													</a>
												</h3>
												<h6 class="text-grey age"><i class="bi bi-person"></i><?php echo user_age($user->date_of_birth); ?></h6>
												
												<?php if(get_setting('set_bid_price')!=null): ?>
													<h4 class="credits">Credits : <span class="font-weight-bold"><?php echo e(get_setting('set_bid_price')); ?></span></h4>
												<?php endif; ?>
											</div>
											<a href="javascript:void(0)" class="btn btn-green-lg" onclick="hire_modal(<?php echo e($user->id); ?>)"><?php echo e(translate('

											Hire')); ?></a>

										</div>
										<div class="social-img-list mt-sm-4 mt-3">
											<ul class="p-0 ">
												
												<?php if(isset($user->socialprofile->facebook_url) && $user->socialprofile->facebook_url !=null): ?>
													<li> 
														<a href="#" data-href="facebook" class="facebook h4" title="Facebook"><img class="img-fluid rounded-circle" width="18" height="18" src="<?php echo e(my_asset('uploads/all/facebook.svg')); ?>"><?php echo e($user->socialprofile->facebook_follower); ?></a>
													</li>
												<?php endif; ?>
												<?php if(isset($user->socialprofile->instagram_url) && $user->socialprofile->instagram_url !=null): ?>
												<li> 
													<a href="#" data-href="instagram" class="instagram h4" title="instagram"><img class="img-fluid rounded-circle" width="18" height="18" src="<?php echo e(my_asset('uploads/all/insta.svg')); ?>"><?php echo e($user->socialprofile->instagram_follower); ?></a>
												</li>
												<?php endif; ?>
												<?php if(isset($user->socialprofile->tiktok_url) && $user->socialprofile->tiktok_url !=null): ?>
												<li>
													<a href="#" data-href="tiktok" class="tiktok h4" title="tiktok"><img class="img-fluid rounded-circle" width="18" height="18" src="<?php echo e(my_asset('uploads/all/tiktok.svg')); ?>"><?php echo e($user->socialprofile->tiktok_follower); ?></a>

												</li>
												<?php endif; ?>
												<?php if(isset($user->socialprofile->twitter_url) && $user->socialprofile->twitter_url !=null): ?>
												<li>
													<a href="#" data-href="twitter" class="twitter h4" title="twitter"><img class="img-fluid rounded-circle" width="18" height="18" src="<?php echo e(my_asset('uploads/all/twitter.svg')); ?>"><?php echo e($user->socialprofile->twitter_follower); ?></a>
												</li>
												<?php endif; ?>
												<?php if(isset($user->socialprofile->youtube_url) &&  $user->socialprofile->youtube_url !=null): ?>
												<li>
													<a href="#" data-href="youtube" class="youtube h4" title="youtube"><img class="img-fluid rounded-circle" width="18" height="18" src="<?php echo e(my_asset('uploads/all/play.svg')); ?>"><?php echo e($user->socialprofile->youtube_follower); ?></a>
												</li>
												<?php endif; ?>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
	                     	<div class="card mx-auto">
	                          <div class="card-body text-center">
	                              <i class="las la-frown la-4x mb-4 opacity-40"></i>
	                              <h4><?php echo e(translate('Nothing Found')); ?></h4>
	                          </div>
	                    	</div>
						<?php endif; ?>
					</div>
				</div>
					</div>
					</div>
				</div>
				
				<div class="aiz-pagination aiz-pagination-center">

					<?php echo e($users->appends(['type'=> $type,'search'=>$search,'project'=>$project,'ethnicity'=>$ethnicity,'gender'=>$gender,'religion'=>$religion,'type'=>$type,'min_age'=>$min,'max_age'=>$max,'state_id'=>$state_id,'follower'=>$follower,'fb'=>$fb])->links()); ?>


				</div>
			</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<link rel='stylesheet' href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>
<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> -->
<script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
<script>
	$(function() {
   var $slider = $("#slider-range");
    var setMin = $slider.attr("data-set-min"),
    setMax = $slider.attr("data-set-max");
    var priceMi = $slider.attr("data-price-min"),
    priceMa = $slider.attr("data-price-max");
    
   var priceMin =isset_check(setMin,priceMi),
    priceMax = isset_check(setMax,priceMa);
   $("#price-filter-min, #price-filter-max").map(function(){
		$(this).attr({"min": priceMin,"max": priceMax});
	});
	$("#price-filter-min").attr({"placeholder":priceMin,"value": priceMin});
	$("#price-filter-max").attr({"placeholder":priceMax,"value": priceMax});
    
   	$slider.slider({
      range: true,
      min: Math.max(priceMi, 0),
      max: priceMa,
      values: [priceMin, priceMax],
      slide: function(event, ui) {
         $("#price-filter-min").val(ui.values[0]);
         $("#price-filter-max").val(ui.values[1]);
        if(ui.values[1]==65){
         	$('.age_span').text('+');
        }else{
        	$('.age_span').text(' ');
        }
      }
   });
	$("#price-filter-min, #price-filter-max").map(function(){
		$(this).on("input", function() {
			updateSlider();
		});
	});
	function updateSlider(){
		$slider.slider("values", [$("#price-filter-min").val(), $("#price-filter-max").val()]);
	}
	
	$('#type').on('change',function(e){
		var option=$("select#type option").filter(":selected").val();
		if(option != ''){
			social_heading(option);
			if(option=='facebook'){
				$('.fb_follower').show();
				$('.other_follower').hide();
			}else{
				$('.other_follower').show();
				$('.fb_follower').hide();
			}
		}else{
			$('.fb_follower').hide();
			$('.other_follower').hide();
			$('.social_heading_yt').hide();
			$('.social_heading').hide();
		}
	});
	function social_heading(val){
		if(val=='youtube'){
			$('.social_heading_yt').show();
			$('.social_heading').hide();
		}else{
			$('.social_heading').show();
			$('.social_heading_yt').hide();
		}
	}
	//Only once on load, add classes to checklists
	$( ".checklist" ).map(function(){
		let $list = $(this);
		if($list.children().length > 3){
			$list.addClass('collapsed');
		}
		//function to remove class (once) when more is clicked
		function handleMore(e){
			if($(e.target).is('ul')){
				$(this).removeClass('collapsed');
				$(this).addClass('revealed');
				
				//make it two columns if items are not long and there's many
				if($(this).hasClass("short") && $(this).children().length >= 5){
					$(this).addClass('columns');
				}
				//remove event handler 		
				$(this).off('click.moreButton');
			}
		}
		//and attached event handler to ul
		$list.on('click.moreButton', handleMore);
	});
});
</script>
<script type="text/javascript">
    function sort_projects(el){
        $('#sort_projects').submit();
    }
	function updateValue(val,max){ 
	 	if (val == max) {
			val= val+'+';
	 		alert(val);
			$("#price-filter-min").attr({"placeholder":val,"value": val});
	 	}else{   
		  	$("#price-filter-min").attr({"placeholder":val,"value": val});
		}
	}

    function hire_modal(id){
        $.post('<?php echo e(route('get_hire_for_project_modal')); ?>', { _token: '<?php echo e(csrf_token()); ?>', id:id,project_slug:"<?php echo e($project_slug); ?>" }, function(data){
            $('#hire_for_project').modal('show');
            $('#hire_for_modal_body').html(data);
        })
    }

    function Filter_clear(){
    	var url = window.location.href;
        url = url.split('?')[0];
        window.location.href=url;
    }

    function isset_check(value,extra){
    	if(value==null || value != ''){
 			return value;
	    }else{
	    	return extra;
	    }
    }

</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('modal'); ?>
<div class="modal my-hire-modal fade" id="hire_for_project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content hire-modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title h3 fw-600" id="exampleModalLabel"><?php echo e(translate('Hire Influencer')); ?></h5>
                <button type="button" class="close m-0" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body" id="hire_for_modal_body">

            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('frontend.default.partials.bookmark_remove_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.default.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/frontend/default/user/client/projects/my_find_Influencer.blade.php ENDPATH**/ ?>