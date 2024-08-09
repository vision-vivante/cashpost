<?php $__env->startSection('content'); ?>
<style>
    .aiz-header-other, .aiz-footer{
        display: none;
    }

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

<div class="sign-up-section step-2">
    <div class="container-fluid px-0">
        <div class="card mb-0 border-0 rounded-0 text-sm-right ">
            <div class="row no-gutters justify-content-start">

                <?php echo $__env->make('frontend.default.inc.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

				<div class="col-sm-9 form-side" style="height:100vh; overflow:auto;">
                    <div class="card-body form-section">
						<form class="" id="reg-form" method="POST" action="<?php echo e(route('register')); ?>" enctype="multipart/form-data">
							<?php echo csrf_field(); ?>
            				<fieldset>
								<div class="mb-5">
									<h2 class="font-weight-bold">Everyone's An Influencer</h2>
									<p class="text-grey mb-5">It doesnt matter if you have 50 followers, or 50 million followers. You can make tons of money as a CashPost Influencer.</p>
								</div>
								<div class="alert alert-danger __errorDiv" style="display:none">
									<ul></ul>
								</div>
								<div class="form-group mb-4">
									<input type="hidden" name="user_types[]" value="name">
									<label class="form-label text-dark h5" for="name"><?php echo e(translate('Name*')); ?></label>
									<input type="text" class="form-control radius-10 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" id="name" placeholder="Enter name"  >
	                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
	                                    <span class="invalid-feedback" role="alert"><?php echo e($message); ?></span>
	                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div>


								<div class="form-group mb-4">
									<input type="hidden" name="user_types[]" value="email">
									<label class="form-label text-dark h5" for="email"><?php echo e(translate('Email address*')); ?></label>
									<input type="text" class="form-control radius-10 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" id="signinSrEmail" placeholder="Enter email address"  >
	                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
	                                    <span class="invalid-feedback" role="alert"><?php echo e($message); ?></span>
	                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div>

								<div class="form-group mb-4">
									<label class="form-label text-dark h5" for="password"><?php echo e(translate('Password*')); ?></label>
									<input type="password" class="form-control radius-10 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" id="password" placeholder="Enter password" aria-label="********" required>
									<?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
	                                    <span class="invalid-feedback" role="alert"><?php echo e($message); ?></span>
	                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div>

								<div class="form-group mb-4">
									<label class="form-label text-dark h5" for="password-confirm"><?php echo e(translate('Confirm Password*')); ?></label>
									<input type="password" class="form-control radius-10" name="password_confirmation" id="password-confirm" placeholder="Enter confirm password" required>
								</div>
								<div class="form-check aiz-checkbox-list p-0">
									<div class="form-check">
										
										<!-- <span class="fs-15"><?php echo e(translate('By signing up you agree to our terms and conditions')); ?>.</span> -->
										<label class="fs-15 text-grey form-check-label"><input type="checkbox" class="form-check-input" style="margin-right:8px;" name="condition" required>
											"I accept the <a href="	<?php echo e(asset('terms-conditions')); ?>" style="color:#1492E6;" class="text-decoration-underline">Terms of Service</a> and <a href="<?php echo e(asset('privacy-policy')); ?>" style="color:#1492E6;" class="text-decoration-underline">Privacy Policy</a>".</label>
									</div>
								</div>
								<a href="javascript:void(0)"  data-step= "1" class="btn-block next-step text-center mt-5 btn-green-lg" >Continue</a>
							</fieldset>
							<fieldset>
								<div class="mb-5">
									<h2 class="font-weight-bold">Let's see that beautiful smile.</h2>
								</div>
								<div class="alert alert-danger __errorDiv" style="display:none">
									<ul></ul>
								</div>
								<div class="form-group">
									<label class="form-label text-dark h5 h5 mb-3">Add a profile picture*</label>
									<div class="input-group flex-column image-upload ">
										<div><i class="bi bi-image-fill h3 mb-2 text-grey"></i></div>
										<div class="fw-600 text-dark h5">
											<label for="chooseFile" class="custom-file-upload">
												<i class="fa fa-cloud-upload"></i> Upload Image
											</label>
											<input type="file" name="user_avatar" class="user_avatar"  id="chooseFile" style="visibility: hidden;" >
											 
										</div>
									</div>
									<?php $__errorArgs = ['user_avatar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
	                                    <span class="invalid-feedback" role="alert">Please add a profile picture</span>
	                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
					            </div>
								<a href="javascript:void(0)" data-step= "2" class="next-step btn-block btn-green-lg mt-5" >Continue</a>
								<!-- <a href="javascript:void(0)" class="previous-step btn"><i class="bi bi-chevron-left font-weight-bold"></i>Back</a> -->
	                        </fieldset>
	                        <fieldset>
								<div class="mb-5">
									<h2 class="font-weight-bold">Help our brands get to know you</h2>
									<p class="text-grey mb-5">This will better help them send you personalized $$$ opportunities.</p>
								</div>
	                        	<div class="alert alert-danger __errorDiv" style="display:none">
									<ul></ul>
								</div>
								<div class="row">
									<div class="form-group col-lg-6">
										<label class="form-label text-dark h5"><?php echo e(translate('Gender*')); ?></label>
										<select name="gender" class="form-control radius-10 coustom-select cloned">
											<option class="text-grey" value="">Select</option>
											<option value="male">Male</option>
											<option value="female">Female</option>
											<option value="other">Other</option>
										</select>
									</div>
									 
									<div class="form-group col-lg-6">
										<input type="hidden" name="user_types[]" value="date_of_birth">
										<label class="form-label text-dark h5"><?php echo e(translate('Birthday*')); ?></label>
										<span class="my-calender-picker"><input type="text"id="datepicker" class="aiz-date-range form-control dob_birth radius-10  <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="date_of_birth" placeholder="MM-DD-YYYY" data-future-disable="true" data-last-date="<?php echo e($max_date); ?>" data-single="true" data-show-dropdown="true" data-format="MM-DD-YYYY" autocomplete="off" readonly/><i class="bi bi-calendar my-calender position-absolute"></i></span>
									</div>

								</div>	
								<div class="row">
									<div class="form-group col-lg-6">
										<input type="hidden" name="user_types[]" value="ethnicity">
										<label class="form-label text-dark h5"><?php echo e(translate('Ethnicity')); ?></label>
										<select name="ethnicity" class="form-control radius-10 coustom-select cloned" required>
											<option>Select </option>
											<option value="1">White</option>
											<option value="2">African American</option>
											<option value="3">Hispanic</option>
											<option value="4">Asian</option>
											<option value="5">Native American</option>
											<option value="6">Other</option>
											<option value="7">Didn't Specify</option>
										</select>										
									</div>
									<div class="form-group col-lg-6">
										<input type="hidden" name="user_types[]" value="religion">
										<label class="form-label text-dark h5"><?php echo e(translate('Religion')); ?></label>
										<select name="religion" class="form-control radius-10 coustom-select cloned" required>
											<option>Select</option>
											<option value="1">Christian</option>
											<option value="2">Muslim</option>
											<option value="3">Buddhist</option>
											<option value="4">Other</option>
											<option value="5">Didn't Specify</option>
										</select>									
									</div>
								</div>
								<?php  
								$country=\App\Models\Country::where('code','US')->first();
								$country_id=(isset($country->id)) ? $country->id : '';
								?>
								<div class="row js-form-message">
									<div class="form-group col-lg-6">
                                        <input type="hidden" name="country_id" id="country_id" value="<?php echo e($country_id); ?>">							
										<input type="hidden" name="user_types[]" value="city_id">
										<label for="country" class="form-label h5 text-dark" ><?php echo e(translate('State*')); ?>

										</label> 
                                        <select class="form-control radius-10 aiz-selectpicker" name="city_id" id="city_id" required data-msg="Please select your city." data-live-search="true">
                                        </select>									
									</div>
									<div class="form-group col-lg-6">
										<input type="hidden" name="user_types[]" value="city_name">
										<label class="form-label text-dark h5"><?php echo e(translate('City*')); ?></label>
										<input type="text" class="form-control radius-10" name="city_name" value="<?php echo e(old('city_name')); ?>"  required>						
									</div>
								</div>
								<div class="row">
									<div class="form-group col-lg-6">
										<input type="hidden" name="user_types[]" value="address">
										<label id="nameLabel" class="form-label h5 text-dark">
                                            <?php echo e(translate('Address*')); ?>

                                        </label>
                                        <input type="text" class="form-control radius-10" name="address" value="<?php echo e(old('address')); ?>"  required>
									</div>
									<div class="form-group col-lg-6">
										<input type="hidden" name="user_types[]" value="zipcode">
										<label class="form-label text-dark h5"><?php echo e(translate('ZipCode*')); ?></label>
										<input type="text" class="form-control radius-10" name="zipcode" value="<?php echo e(old('zipcode')); ?>"  required>						
									</div>
								</div>
								<div class="form-group">
									<label class="form-label text-dark h5"><?php echo e(translate('What are you interested in?')); ?></label>
								</div>

								<div class="form-group interested">
									<div class="row px-3 justify-content-between justify-content-sm-start">
										<div class="col-xxl-3 col-xl-4 col-6 p-0">
											<span><input id="funny_video" class="className" name="user_cate_id[]" value="1" type="checkbox">
											<label for="funny_video"><?php echo e(translate ('Funny Videos')); ?></label></span>
										</div>
										<div class="col-xxl-3 col-xl-4 col-6 p-0">
											<span><input id="memes" class="className" name="user_cate_id[]" value="2" type="checkbox">
											<label for="memes"><?php echo e(translate ('Memes')); ?></label></span>
										</div>
										<div class="col-xxl-3 col-xl-4 col-6 p-0">
											<span><input id="you_tube" class="className" name="user_cate_id[]" value="3" type="checkbox">
											<label for="you_tube"><?php echo e(translate ('YouTube')); ?></label></span>
										</div>
										<div class="col-xxl-3 col-xl-4 col-6 p-0">
											<span><input id="netflix" class="className" name="user_cate_id[]" value="4" type="checkbox">
											<label for="netflix"><?php echo e(translate ('Netflix')); ?></label></span>
										</div>
										<div class="col-xxl-3 col-xl-4 col-6 p-0">
											<span><input id="gaming" class="className" name="user_cate_id[]" value="5" type="checkbox">
											<label for="gaming"><?php echo e(translate ('Gaming')); ?></label></span>
										</div>
										<div class="col-xxl-3 col-xl-4 col-6 p-0">
											<span><input id="beauty" class="className" name="user_cate_id[]" value="6" type="checkbox">
											<label for="beauty"><?php echo e(translate ('Beauty')); ?></label></span>
										</div>
										<div class="col-xxl-3 col-xl-4 col-6 p-0">
											<span><input id="sports" class="className" name="user_cate_id[]" value="7" type="checkbox">
											<label for="sports"><?php echo e(translate ('Sports')); ?></label></span>
										</div>
										<div class="col-xxl-3 col-xl-4 col-6 p-0">
											<span><input id="college" class="className" name="user_cate_id[]" value="8" type="checkbox">
											<label for="college"><?php echo e(translate ('College')); ?></label></span>
										</div>
										<div class="col-xxl-3 col-xl-4 col-6 p-0">
											<span><input id="technology" class="className" name="user_cate_id[]" value="9" type="checkbox">
											<label for="technology"><?php echo e(translate ('Technology')); ?></label></span>
										</div>
										<div class="col-xxl-3 col-xl-4 col-6 p-0">
											<span><input id="Beer" class="className" name="user_cate_id[]" value="10" type="checkbox">
											<label for="Beer"><?php echo e(translate ('Beer/Alcohol')); ?></label></span>
										</div>
										<div class="col-xxl-3 col-xl-4 col-6 p-0">
											<span><input id="Healthcare" class="className" name="user_cate_id[]" value="11" type="checkbox">
											<label for="Healthcare"><?php echo e(translate ('Healthcare')); ?></label></span>
										</div>
										<div class="col-xxl-3 col-xl-4 col-6 p-0">
											<span><input id="Rap-Music" class="className" name="user_cate_id[]" value="12" type="checkbox">
											<label for="Rap-Music"><?php echo e(translate ('Rap Music')); ?></label></span>
										</div>
										<div class="col-xxl-3 col-xl-4 col-6 p-0">
											<span><input id="Pop-Music" class="className" name="user_cate_id[]" value="13" type="checkbox">
											<label for="Pop-Music"><?php echo e(translate ('Pop Music')); ?></label></span>
										</div>
										<div class="col-xxl-3 col-xl-4 col-6 p-0">
											<span><input id="Rock-Music" class="className" name="user_cate_id[]" value="14" type="checkbox">
											<label for="Rock-Music"><?php echo e(translate ('Rock Music')); ?></label></span>
										</div>
										<div class="col-xxl-3 col-xl-4 col-6 p-0">
											<span><input id="Country-Music" class="className" name="user_cate_id[]" value="15" type="checkbox">
											<label for="Country-Music"><?php echo e(translate ('Country Music')); ?></label></span>
										</div>
										
									</div>
									
								</div>
								<a href="javascript:void(0)" data-step= "3" class="next-step mt-4 btn-block btn-green-lg" >Continue</a>
								<a href="javascript:void(0)" class="previous-step btn"><i class="bi font-weight-bold bi-chevron-left"></i>Back</a>
	                        </fieldset>
	                        <fieldset>
								<div class="mb-5">
									<h2 class="font-weight-bold">Geesh, that was a lot huh?</h2>
									<p class="text-grey mb-5">Tell our brands about your social media presence.</p>
								</div>
								<div class="mb-5">
									<p>Which social media accounts do you use?</p>
	                                <ul class="list-inline social colored text-center"> 
			                        	<li> 
			                        		<a href="#" data-href="facebook" class="facebook h3" title="Facebook"><i class="lab la-facebook-f rounded-circle"></i></a>
			                        	</li>
			                        	<li> 

											<a href="#" data-href="instagram" class="instagram h3" title="instagram"><i class="bi bi-instagram rounded-circle"></i></a>
			                        	</li>
			                        	<li>
											<a href="#" data-href="tiktok" class="tiktok h3" title="tiktok"><i class="bi rounded-circle bi-tiktok"></i></a>

			                        	</li>
										<li>
											<a href="#" data-href="twitter" class="twitter h3" title="twitter"><i class="lab la-twitter rounded-circle"></i></a>
										</li>
										<li>
											<a href="#" data-href="youtube" class="youtube h3" title="youtube"><i class="bi bi-youtube rounded-circle"></i></a>
										</li>
	                                </ul>
	                            </div>
	                            <div class="form-group">
	                            	<div class="error_show text-danger"></div>
	                            	<div id="facebook">
	                            		<h3 class="font-weigt-bold">Facebook</h3>
	                            		<div class="form-group">
	                            			<input type="hidden" name="user_types[]" value="facebook_url">
		                            		<label class="form-label text-dark h5"><?php echo e(translate('Profile URL')); ?></label>
											<input type="url" class="form-control radius-10" placeholder="https://www.facebook.com/myname" name="facebook_url" >
										</div>
										<div class="form-group">
											<input type="hidden" name="user_types[]" value="facebook_follower">
										</div>
										<div class="form-group range-wrap">
											<label class="h5"><?php echo e(translate ('How many followers do you have?')); ?></label>
											<ul class="data-list">
												<li>1-100</li>
												<li>100-2500</li>
												<li>2500-5000</li>
											</ul>
											<input type="range" id="input-range" step="1" min="1" max="3" value="0"  class="p-0 form-control range radius-10 facebook_follower" name="facebook_follower" list="ranGe">
											<!-- <output id="bubble" class="bubble"></output> -->
											<div class="honest-text d-flex justify-content-end text-sm">*Be honest, our brands check</div>
										</div>
	                            	</div>

									<div id="instagram">
	                            		<h3>Instagram</h3>
	                            		<div class="form-group">
	                            			<input type="hidden" name="user_types[]" value="instagram_url">
		                            		<label class="form-label text-dark h5"><?php echo e(translate('Profile URL')); ?></label>
											<input type="url" class="form-control radius-10" placeholder="https://www.instagram.com/myname" name="instagram_url" >
										</div>
										<div class="form-group">
											<input type="hidden" name="user_types[]" value="instagram_follower">
										</div>
										<div class="form-group range-wrap">
											<label class="h5"><?php echo e(translate ('How many followers do you have?')); ?></label>
											<ul class="data-list">
												<li>1-100</li>
												<li>100-2500</li>
												<li>2500-10k</li>
												<li>10k+</li>
											</ul>
											<input type="range" id="input-range" min="1" step="1" max="4" class="form-control radius-10 range instagram_follower p-0" list="ranGe2" name="instagram_follower">
											<!-- <output class="bubble"></output> -->
											<div class="honest-text d-flex justify-content-end">*Be honest, our brands check</div>
										</div>
	                            	</div>
									<div id="tiktok">
	                            		<h3>Tik Tok</h3>
	                            		<div class="form-group">
	                            			<input type="hidden" name="user_types[]" value="tiktok_url">
		                            		<label class="form-label text-dark h5"><?php echo e(translate('Profile URL')); ?></label>
											<input type="url" class="form-control radius-10" placeholder="https://www.tiktok.com/myname" name="tiktok_url" >
										</div>
										<div class="form-group">
											<input type="hidden" name="user_types[]" value="tiktok_follower">
										</div>
										<div class="form-group range-wrap">
											<label class="h5"><?php echo e(translate ('How many followers do you have?')); ?></label>
											<ul class="data-list">
												<li>1-100</li>
												<li>100-2500</li>
												<li>2500-10k</li>
												<li>10k+</li>
											</ul>
											<input type="range" id="input-range" min="1" step="1" max="4" class="form-control radius-10 range tiktok_follower p-0" list="ranGe2" name="tiktok_follower">
											<!-- <output class="bubble"></output> -->
											<div class="honest-text d-flex justify-content-end">*Be honest, our brands check</div>
										</div>
	                            	</div>
									<div id="twitter">
	                            		<h3 class="font-weigt-bold">Twitter</h3>
	                            		<div class="form-group">
	                            			<input type="hidden" name="user_types[]" value="twitter_url">
		                            		<label class="form-label text-dark h5"><?php echo e(translate('Profile URL')); ?></label>
											<input type="url" class="form-control radius-10" placeholder="https://www.twitter.com/myname" name="twitter_url" >
										</div>
										<div class="form-group">
											<input type="hidden" name="user_types[]" value="twitter_follower">
										</div>
										<div class="form-group range-wrap">
											<label class="h5"><?php echo e(translate ('How many followers do you have?')); ?></label>
											<ul class="data-list">
												<li>1-100</li>
												<li>100-2500</li>
												<li>2500-10k</li>
												<li>10k+</li>
											</ul>
											<input type="range" id="input-range" min="1" step="1" max="4" class="form-control radius-10 range twitter_follower p-0" list="ranGe2" name="twitter_follower">
											<!-- <output class="bubble"></output> -->
											<div class="honest-text d-flex justify-content-end">*Be honest, our brands check</div>
											
										</div>
	                            	</div>
									<div id="youtube">
	                            		<h3 class="font-weigt-bold">Youtube</h3>
	                            		<div class="form-group">
	                            			<input type="hidden" name="user_types[]" value="youtube_url">
		                            		<label class="form-label text-dark h5"><?php echo e(translate('Profile URL')); ?></label>
											<input type="url" class="form-control radius-10" placeholder="https://www.youtube.com/myname" name="youtube_url" >
										</div>
										<div class="form-group">
											<input type="hidden" name="user_types[]" value="youtube_follower">
										</div>
										<div class="form-group range-wrap">
											<label class="h5"><?php echo e(translate ('How many subscribers do you have?')); ?></label>
											<ul class="data-list">
												<li>1-100</li>
												<li>100-2500</li>
												<li>2500-10k</li>
												<li>10k+</li>
											</ul>
											<input type="range" id="input-range" min="1" step="1" max="4" class="form-control radius-10 range youtube_follower p-0" list="ranGe2" name="youtube_follower">
											<!-- <output class="bubble"></output> -->
											<div class="honest-text d-flex justify-content-end">*Be honest, our brands check</div>
											
										</div>
	                            	</div>
	                            </div>
                        
                                <div class="form-group">
                                    <div class="g-recaptcha" data-sitekey="<?php echo e(env('GOOGLE_RECAPTCHA_SITE_KEY')); ?>"></div>
                                </div>
	                            <div class="mb-5">
	                            	<input type="hidden" name="user_types[]" value="freelancer">
	                                <button type="submit" id="send_form" data-step="4" class="next-step btn-block btn-green-lg btn"><?php echo e(translate('Done')); ?></button>
	                               <!--   <a href="javascript:void(0)" data-step="4" class="next-step btn-block btn-green-lg btn" ><i class="bi font-weight-bold bi-chevron-left"></i><?php echo e(translate('Done')); ?></a> -->
	                            </div>
	                            <div id="loader"style="display:none" role="status">
	                            <a href="javascript:void(0)" class="previous-step btn" ><i class="bi font-weight-bold bi-chevron-left"></i>Back</a>
	                        </fieldset>
							<!-- <?php if(\App\Utility\SettingsUtility::get_settings_value('facebook_login_activation_checkbox') == 1 || \App\Utility\SettingsUtility::get_settings_value('twitter_login_activation_checkbox') == 1 || \App\Utility\SettingsUtility::get_settings_value('google_login_activation_checkbox') == 1 || \App\Utility\SettingsUtility::get_settings_value('linkedin_login_activation_checkbox') == 1): ?>
                            <div class="mb-5">
                                <div class="separator mb-3">
                                    <span class="bg-white px-3">Or Login With</span>
                                </div>

                                <ul class="list-inline social colored text-center">
                                    <?php if(\App\Utility\SettingsUtility::get_settings_value('facebook_login_activation_checkbox') == 1): ?>
                                        <li class="list-inline-item">
                                            <a href="<?php echo e(route('social.login', ['provider' => 'facebook'])); ?>" class="facebook" title="Facebook"><i class="lab la-facebook-f"></i></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(\App\Utility\SettingsUtility::get_settings_value('twitter_login_activation_checkbox') == 1): ?>
                                        <li class="list-inline-item">
                                            <a href="<?php echo e(route('social.login', ['provider' => 'twitter'])); ?>" class="twitter" title="Twitter"><i class="lab la-twitter"></i></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(\App\Utility\SettingsUtility::get_settings_value('google_login_activation_checkbox') == 1): ?>
                                        <li class="list-inline-item">
                                            <a href="<?php echo e(route('social.login', ['provider' => 'google'])); ?>" class="google" title="Google"><i class="lab la-google"></i></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(\App\Utility\SettingsUtility::get_settings_value('linkedin_login_activation_checkbox') == 1): ?>
                                        <li class="list-inline-item">
                                            <a href="<?php echo e(route('social.login', ['provider' => 'linkedin'])); ?>" class="linkedin" title="Linkedin"><i class="lab la-linkedin-in"></i></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <?php endif; ?> -->

								<!-- <div class="text-center">
									<p class="text-muted mb-0"><?php echo e(translate("Already have an account?")); ?></p>
									<a href="<?php echo e(route('login')); ?>"><?php echo e(translate('Login to your account')); ?></a>
								</div> -->
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<!-- <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	

	<script>
		$(document).ready(function(){
			$("#reg-form").on("submit", function(evt)
			{
				var facebook_url= $("input[name^= 'facebook_url']").val();
				var tiktok_url= $("input[name^= 'tiktok_url']").val();
				var instagram_url= $("input[name^= 'instagram_url']").val();
				var twitter_url= $("input[name^= 'twitter_url']").val();
				var youtube_url= $("input[name^= 'youtube_url']").val();
				if(facebook_url.length === 0 && tiktok_url.length === 0 && instagram_url.length==0 &&  twitter_url.length==0 &&  youtube_url.length==0) {

					$('.error_show').empty();
					$('.error_show').append('<span>One URL required</span>');
					evt.preventDefault();
					return false;
				}else{
					$('.error_show').remove();
					$("#reg-form").submit();
				}
			});
		});
	</script>


<script>
  $(document).ready(function () {
    var currentGfgStep, nextGfgStep, previousGfgStep;
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;
    $(".next-step").click(function (e) {
        var step = $(this).attr('data-step');
        if(step == 1){
            $('#reg-form').submit();
            if(!$("[name='name']").valid() || !$("[name='email']").valid() || !$("[name='password']").valid() || !$("[name='password_confirmation']").valid() || !$("[name='condition']").valid() ){
              	e.preventDefault();
              	return;
            }else{
            	ajax_data(e,step,$(this));
            }
        }
        else if(step == 2){
            $('#reg-form').submit();
            if(!$("[name='user_avatar']").valid()){
              e.preventDefault();
              return;
            }else{
            	ajax_data(e,step,$(this));
            }
        }else if(step == 3){
            $('#reg-form').submit();
            if(!$("[name='gender']").valid() || !$("[name='date_of_birth']").valid() || !$("[name='ethnicity']").valid() || !$("[name='religion']").valid()){
              e.preventDefault();
              return;
            }else{
            	ajax_data(e,step,$(this));
            }
        }else if (step == 4){

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
			$("#reg-form").submit();

        }
    });
   	$(".previous-step").click(function () {
		currentGfgStep = $(this).parent();
		previousGfgStep = $(this).parent().prev();
		$("#progressbar li").eq($("fieldset").index(currentGfgStep)).removeClass("active");
		previousGfgStep.show();
		currentGfgStep.animate({ opacity: 0 }, {
			step: function (now) {
			  opacity = 1 - now;
			  currentGfgStep.css({
			    'display': 'none',
			    'position': 'relative'
			  });
			  previousGfgStep.css({ 'opacity': opacity });
			},
			duration: 500
		});
    });
	$(".facebook").click(function() {
	  	$("#facebook").toggle();
	});
	$(".twitter").click(function() {
	  	$("#twitter").toggle();
	});
	$(".instagram").click(function() {
	  	$("#instagram").toggle();
	});
	$(".tiktok").click(function() {
	  	$("#tiktok").toggle();
	});
	$(".youtube").click(function() {
	  	$("#youtube").toggle();
	});

	
     
});
	$(".next-step").click(function (e) {
		var step = $(this).attr('data-step');
	    var firstStep = $("#reg-form").validate({  
	        rules: {
	          	name: {
	                required: true,
	                maxlength: 50
	            },
	            email: {
	                required: true,
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
		      	gender: {
		            required: true,
		      	},
		      	date_of_birth: {
		            required: true,
		      	},
	        },
	        messages: {
	            name: {
	                required: "Please enter name",
	            },
	            email: {
	                required: "Please enter valid email",
	                email: "Please enter valid email",
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
	    })
	});
    /*ajax function*/
	function ajax_data(e,step,element){
		let myForm = document.getElementById('reg-form');

		var formdata = new FormData(myForm);
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });
		$.ajax({
	        url:"<?php echo e(url('validate')); ?>/"+step,  
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
                  	currentGfgStep = element.parent();
					nextGfgStep = element.parent().next();
					$("#progressbar li").eq($("fieldset").index(nextGfgStep)).addClass("active");
					nextGfgStep.show();
					currentGfgStep.animate({ opacity: 0 }, {
						step: function (now) {
						  opacity = 1 - now;
						  currentGfgStep.css({
						    'display': 'none',
						    'position': 'relative'
						  });
						  nextGfgStep.css({ 'opacity': opacity });
						},
						duration: 500
					});
				}
	        }
	    });
	    function printErrorMsg (msg) {
            $(".__errorDiv").find("ul").html('');
            $(".__errorDiv").css('display','block');
			console.log(msg);
            $.each( msg, function( key, value ) {
                $(".__errorDiv").find("ul").append('<li>'+value+'</li>');
            });
        }
	}

    function get_state_by_city(){
        var country_id = $('#country_id').val();
        console.log(country_id);
        $.post('<?php echo e(route('cities.get_city_by_country')); ?>',{_token:'<?php echo e(csrf_token()); ?>', country_id:country_id}, function(data){
            $('#city_id').html(null);
            for (var i = 0; i < data.length; i++) {
                $('#city_id').append($('<option>', {
                    value: data[i].id,
                    text: data[i].name
                }));
            }
            AIZ.plugins.bootstrapSelect('refresh');
        });
    }

    $(document).ready(function(){
        get_state_by_city();
    });

    $('#country_id').on('change', function() {
        get_state_by_city();
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.default.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/frontend/default/influencer_user_sign.blade.php ENDPATH**/ ?>