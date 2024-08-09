<?php $__env->startSection('content'); ?>
<div class="sign-up-section step-3">
    <div class="container-fluid px-0">
        <div class="card mb-0 border-0 rounded-0 text-sm-right ">
            <div class="row no-gutters justify-content-start">

                <?php echo $__env->make('frontend.default.inc.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

				<div class="col-sm-9 form-side" style="height:100vh; overflow:auto;">
					<div class="card-body">

						<div class="mb-4">
							<h2 class="font-weight-bold">Get your project done today</h2>
							<p class="text-grey mb-5">70,000+ Nano-Influencers are is waiting for your project.</p>
						</div>
						<div class="alert alert-danger __errorDiv" style="display:none">
					        <ul></ul>
					    </div>
						<form class="" name="reg-form" id="reg-form" method="POST" action="<?php echo e(route('register')); ?>" enctype="multipart/form-data">
							<?php echo csrf_field(); ?>
            				<fieldset>
            					<div class="row">
            						<div class="col-lg-6">
										<div class="form-group">
											<input type="hidden" name="user_types[]" value="first_name">
											<label class="form-label h5" for="first_name"><?php echo e(translate('First Name*')); ?></label>
											<input type="text" class="form-control <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="first_name" id="first_name" placeholder="Enter first name"  >
			                                <?php $__errorArgs = ['first_name'];
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
									</div>
									<div class="col-lg-6">
										<div class="form-group mb-4">
											<input type="hidden" name="user_types[]" value="last_name">
											<label class="form-label h5" for="last_name"><?php echo e(translate('Last Name*')); ?></label>
											<input type="text" class="form-control <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="last_name" id="last_name" placeholder="Enter last name"  >
			                                <?php $__errorArgs = ['last_name'];
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
									</div>
								</div>
                                <div class="form-group mb-4">
									<input type="hidden" name="user_types[]" value="company_name">
									<label class="form-label h5" for="company_name"><?php echo e(translate('Brand/Company Name*')); ?></label>
									<input type="text" class="form-control <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="company_name" id="company_name" placeholder="Enter brand/company name"  >
	                                <?php $__errorArgs = ['company_name'];
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
									<label class="form-label text-dark h5 h5 mb-3">Your Logo/Photo*</label>
									<div class="input-group flex-column image-upload ">
										<div><i class="bi bi-image-fill h3 mb-2 text-grey"></i></div>
										<div class="fw-600 text-dark h5">
											<label for="chooseFile" class="custom-file-upload">
												<i class="fa fa-cloud-upload"></i> Upload Image
											</label>
											<input type="file" name="user_avatar" class="user_avatar"  id="chooseFile" style="visibility:hidden;">
										</div>
									</div>
									<label id="chooseFile-error" class="error" for="chooseFile"></label>
									<?php $__errorArgs = ['user_avatar'];
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
									<label class="form-label h5" for="email"><?php echo e(translate('Business Email*')); ?></label>
									<input type="text" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" id="signinSrEmail" placeholder="Enter business email"  >

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
									<label class="form-label h5" for="password"><?php echo e(translate('Password*')); ?></label>
									<input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" id="password" placeholder="Enter password" aria-label="********">

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
									<label class="form-label h5" for="password-confirm"><?php echo e(translate('Confirm Password*')); ?></label>
									<input type="password" class="form-control" name="password_confirmation" id="password-confirm" placeholder="Enter confirm password">
								</div>
								<div class="form-group"> 
									<div class="aiz-checkbox-list d-flex align-items-center position-relative">
										<input type="checkbox" name="condition">
										<!-- <span class="fs-15"><?php echo e(translate('By signing up you agree to our terms and conditions')); ?>.</span> -->
										<label class="fs-15 text-grey px-2 form-check-label">"I accept the <a href="<?php echo e(asset('terms-conditions')); ?>" style="color:#1492E6;" class="text-decoration-underline">Terms of Service</a> and <a href="<?php echo e(asset('/privacy-policy')); ?>" style="color:#1492E6;" class="text-decoration-underline">Privacy Policy</a>".</label>
									</div>
								</div>

                            	<?php if(get_setting('google_recaptcha_activation_checkbox') == 1): ?>
                                <div class="form-group">
                                    <div class="g-recaptcha" data-sitekey="<?php echo e(env('CAPTCHA_KEY')); ?>"></div>
                                </div>
	                            <?php endif; ?>
	                            <div class="mb-5">

	                            	<input type="hidden" name="user_types[]" value="client">
	                                <button type="submit" data-step= "1" id="send_form" class="next-step btn-block btn mt-5 btn-green-lg"><?php echo e(translate('Done')); ?></button>

	                            </div>
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
                            <?php endif; ?>

                            <div class="text-center">
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<?php if(get_setting('google_recaptcha_activation_checkbox') == 1): ?>
	<script src="https://www.google.com/recaptcha/api.js" async defer>
		$(document).ready(function(){
			$("#reg-form").on("submit", function(evt)
			{
				var response = grecaptcha.getResponse();
				if(response.length == 0)
				{
				//reCaptcha not verified
					alert("please verify you are humann!");
					evt.preventDefault();
					return false;
				}
				//captcha verified
				//do the rest of your validations here
				$("#reg-form").submit();
			});
		});
	</script>
<?php endif; ?>

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
	            user_avatar: {
		            required: "Please upload brand logo",
		            extension: "jpeg,png,jpg,gif,svg"
		        },
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.default.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/frontend/default/brand_user_sign-bk.blade.php ENDPATH**/ ?>