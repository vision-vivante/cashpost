


<?php $__env->startSection('content'); ?>
<style>
    .invalid-feedback{
        display: block;
    }
</style>
    <section class="py-5 client-profile-section">
        <div class="container">
            <div class="d-flex align-items-start">             
                <div class="aiz-user-panel">
                    <div class="aiz-titlebar mt-2 mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h1 class="h3"><?php echo e(translate('Profile Settings')); ?></h1>
                            </div>
                        </div>
                    </div>
                    <?php if($verification == null): ?>
                        <div class="card">
                            <div class="card-header px-0">
                                <h4 class="h2 font-weight-bold mb-0"><?php echo e(translate('Identity Verification')); ?></h4>
                            </div>
                        </div>
                    <?php elseif($verification != null && $verification->verified == 0): ?>
                        <div class="card">
                            <div class="card-header px-0">
                                <h4 class="h3 font-weight-bold mb-0"><?php echo e(translate('Identity Verification')); ?></h4>
                            </div>
                            <div class="card-body px-0">
                                <div class="alert alert-info" role="alert">
                                    <?php echo e(translate('Your identity verification has not been approved yet.')); ?>

                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="card">
                            <div class="card-header px-0">
                                <h4 class="h2 font-weight-bold mb-0"><?php echo e(translate('Identity Verification')); ?></h4>
                            </div>
                            <div class="card-body px-0">
                                <div class="alert alert-success radius-10" role="alert">
                                    <?php echo e(translate('Your identity verifed successfully.')); ?>

                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="h3 font-weight-bold mb-0"><?php echo e(translate('Account Info')); ?></h4>
                        </div>
                        <div class="card-body">
                            <!-- Personal Info Form -->
                            <form class="js-validate" action="<?php echo e(route('user_profile.bio_update')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="js-form-message">
                                            <label id="usernameLabel" class="form-label h5 text-dark">
                                                <?php echo e(translate('Username')); ?>

                                                <span class="text-danger">*</span>
                                            </label>

                                            <div id="uname_response"></div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="username" name="username" <?php if(isset($user_profile->user->user_name) && $user_profile->user->user_name != null): ?> value="<?php echo e($user_profile->user->user_name); ?>" <?php endif; ?> placeholder="Enter your username" aria-label="Enter your username" required aria-describedby="usernameLabel" data-msg="Please enter your username." data-error-class="u-has-error" data-success-class="u-has-success" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Input -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="emailLabel" class="form-label h5 text-dark"><?php echo e(translate('Email address')); ?>

                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <input type="email" class="form-control" name="email" <?php if(isset($user_profile->user->email) && $user_profile->user->email != null): ?> value="<?php echo e($user_profile->user->email); ?>" <?php endif; ?> placeholder="Enter your email address" aria-label="Enter your email address" required aria-describedby="emailLabel" disabled>
                                                <div class="input-group-append">
                                                    <?php if(isset($user_profile->user->email_verified_at) && $user_profile->user->email_verified_at == null): ?>
                                                        <a class="btn btn-secondary send_verification" href="<?php echo e(route('email.verification')); ?>">
                                                            <?php echo e(translate('Send Verification Link')); ?>

                                                        </a>
                                                    <?php else: ?>
                                                        <span class="btn btn-success">
                                                            <?php echo e(translate('Verified')); ?>

                                                            <i class="las la-check"></i>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php if(isset($user_profile->user->email_verified_at) && $user_profile->user->email_verified_at == null): ?>
                                                <span class="alert alert-danger d-block py-1 mt-1"><?php echo e(translate('Verify your email address')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="js-form-message">
                                            <div class="form-group">
                                                <label id="nameLabel" class="form-label h5 text-dark"><?php echo e(translate('New Password')); ?></label>
                                                <input type="password" class="form-control <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="new_password" placeholder="<?php echo e(translate('New Password')); ?>" >
                                            </div>
                                        </div>
                                        <?php $__errorArgs = ['new_password'];
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
                                    <div class="col-md-6">
                                        <div class="js-form-message">
                                            <div class="form-group">
                                                <label id="nameLabel" class="form-label h5 text-dark"><?php echo e(translate('Confirm Password')); ?></label>
                                                <input type="password" class="form-control <?php $__errorArgs = ['confirm_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="confirm_password" placeholder="<?php echo e(translate('Confirm Password')); ?>">
                                            </div>
                                        </div>
                                        <?php $__errorArgs = ['confirm_password'];
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
                                <!-- End Input -->
                                <div class="text-right mt-4">
                                    <!-- Buttons -->
                                    <button type="submit" class="btn btn-green-lg"><?php echo e(translate('Save Changes')); ?></button>
                                    <!-- End Buttons -->
                                </div>

                            </form>
                            <!-- End Personal Info Form -->
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="h3 font-weight-bold mb-0"><?php echo e(translate('Basic Info')); ?></h4>
                        </div>
                        <div class="card-body">
                            <!-- Personal Info Form -->

                            <form class="js-validate" action="<?php echo e(route('user_profile.basic_info_update')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="js-form-message">
                                            <div class="form-group">
                                                <label id="nameLabel" class="form-label h5 text-dark">
                                                    <?php echo e(translate('Name')); ?>

                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control  <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e(isset($user_profile->user->name) ? $user_profile->user->name : ''); ?>" placeholder="Enter your name" aria-label="Enter your name" required aria-describedby="nameLabel" data-msg="Please enter your name." data-error-class="u-has-error" data-success-class="u-has-success">
                                                <small class="form-text text-muted"><?php echo e(translate('Displayed on your public profile, notifications and other places')); ?>.</small>
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
                                        </div>
                                    </div>
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label h5 text-dark">
                                                <?php echo e(translate('Gender')); ?>

                                                <span class="text-danger">*</span>
                                            </label>
                                            <!-- Input -->
                                            <select class="form-control aiz-selectpicker" name="gender" required data-minimum-results-for-search="Infinity" data-msg="Please select your gender." data-error-class="u-has-error" data-success-class="u-has-success">
                                                <option value="male" <?php if( isset($user_profile->gender) && $user_profile->gender == 'male'): ?> selected <?php endif; ?>>Male</option>
                                                <option value="female" <?php if( isset($user_profile->gender) && $user_profile->gender == 'female'): ?> selected <?php endif; ?>>Female</option>
                                                <option value="other" <?php if( isset($user_profile->gender) && $user_profile->gender == 'other'): ?> selected <?php endif; ?>>Other</option>
                                            </select>
                                            <!-- End Input -->
                                        </div>
                                    </div>
                                </div>
                                <?php  
                                $country=\App\Models\Country::where('code','US')->first();
                                $country_id=(isset($country->id)) ? $country->id : '';
                                ?>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label id="nameLabel" class="form-label h5 text-dark">
                                            <?php echo e(translate('ethnicity')); ?>

                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="ethnicity" class="form-control radius-10 coustom-select cloned <?php $__errorArgs = ['ethnicity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                            <option value="">Select </option>
                                            <option value="1"  <?php if(isset($user_profile->ethnicity) && $user_profile->ethnicity == 1): ?> selected <?php endif; ?> >White</option>
                                            <option value="2"  <?php if( isset($user_profile->ethnicity) && $user_profile->ethnicity == 2): ?> selected <?php endif; ?> >African American</option>
                                            <option value="3"  <?php if(isset($user_profile->ethnicity) && $user_profile->ethnicity == 3): ?> selected <?php endif; ?> >Hispanic</option>
                                            <option value="4"  <?php if(isset($user_profile->ethnicity) && $user_profile->ethnicity == 4): ?> selected <?php endif; ?>>Asian</option>
                                            <option value="5"  <?php if(isset($user_profile->ethnicity) && $user_profile->ethnicity == 5): ?> selected <?php endif; ?> >Native American</option>
                                            <option value="6"  <?php if(isset($user_profile->ethnicity) && $user_profile->ethnicity == 6): ?> selected <?php endif; ?>>Other</option>
                                            <option value="7"  <?php if(isset($user_profile->ethnicity) && $user_profile->ethnicity == 7): ?> selected <?php endif; ?>>Didn't Specify</option>
                                        </select>
                                        <?php $__errorArgs = ['ethnicity'];
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
                                    <div class="form-group col-lg-4">
                                        <label class="form-label text-dark h5">
                                            <?php echo e(translate('Religion')); ?>

                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="religion" class="form-control radius-10 coustom-select cloned <?php $__errorArgs = ['religion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                            <option>Select</option>
                                            <option value="1" <?php if( isset($user_profile->nationality) && $user_profile->nationality == 1): ?> selected <?php endif; ?>>Christian</option>
                                            <option value="2" <?php if( isset($user_profile->nationality) && $user_profile->nationality == 2): ?> selected <?php endif; ?> >Muslim</option>
                                            <option value="3" <?php if( isset($user_profile->nationality) && $user_profile->nationality == 3): ?> selected <?php endif; ?>>Buddist</option>
                                            <option value="4" <?php if( isset($user_profile->nationality) && $user_profile->nationality == 4): ?> selected <?php endif; ?>>Other</option>
                                            <option value="5" <?php if( isset($user_profile->nationality) && $user_profile->nationality == 5): ?> selected <?php endif; ?>>Didn't Specify</option>
                                        </select>  
                                        <?php $__errorArgs = ['religion'];
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
                                    <div class="col-lg-4">
                                        <input type="hidden" name="country_id" id="country_id" value="<?php echo e($country_id); ?>"> 
                                        <label for="state_id" class="form-label h5 text-dark" ><?php echo e(translate('State')); ?></label>
                                        <select class="form-control aiz-selectpicker" name="state_id" id="state_id" data-live-search="true" required>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label for="city_name" class="form-label h5 text-dark"><?php echo e(translate('City Name')); ?>

                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" id="city_name" name="city_name" <?php if(isset($user_profile->user->address->city_name) && $user_profile->user->address->city_name != null): ?> value="<?php echo e($user_profile->user->address->city_name); ?>" <?php endif; ?> required placeholder="<?php echo e(translate('City Name')); ?>" class="form-control <?php $__errorArgs = ['city_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    </div>
                                    <?php $__errorArgs = ['city_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <div class="col-lg-4">
                                        <label id="nameLabel" class="form-label h5 text-dark">
                                            <?php echo e(translate('Address')); ?>

                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="address" <?php if(isset($user_profile->user->address->street) && $user_profile->user->address->street != null): ?> value="<?php echo e($user_profile->user->address->street); ?>" <?php endif; ?> placeholder="Enter your street address" required aria-describedby="nameLabel">
                                        <?php $__errorArgs = ['address'];
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
                                    <div class="col-lg-4">
                                        <label for="city_name" class="form-label h5 text-dark"><?php echo e(translate('Zipcode')); ?>

                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" id="postal_code" name="zipcode" <?php if(isset($user_profile->user->address->postal_code) && $user_profile->user->address->postal_code != null): ?> value="<?php echo e($user_profile->user->address->postal_code); ?>" <?php endif; ?> required placeholder="<?php echo e(translate('Zip Code')); ?>" class="form-control <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    </div>
                                    <?php $__errorArgs = ['postal_code'];
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
                                <div class="text-right">
                                    <!-- Buttons -->
                                    <button type="submit" class="btn btn-green-lg"><?php echo e(translate('Save Changes')); ?></button>
                                    <!-- End Buttons -->
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="h3 font-weight-bold mb-0"><?php echo e(translate('Profile Images')); ?></h4>
                        </div>
                        <form class="js-validate" action="<?php echo e(route('user_profile.photo_update')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label"><?php echo e(translate('Profile Image')); ?></label>
                                    <div class="input-group " data-toggle="aizuploader" data-type="image">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium"><?php echo e(translate('Browse')); ?></div>
                                        </div>
                                        <div class="form-control file-amount"><?php echo e(translate('Choose File')); ?></div>
                                        <input type="hidden" name="profile_photo" class="selected-files" value="<?php echo e(isset($user_profile->user->photo) ? $user_profile->user->photo : ''); ?>">
                                    </div>
                                    <div class="file-preview"></div>
                                </div>
                                <div class="text-right mt-4">
                                    <!-- Buttons -->
                                    <button type="submit" class="btn btn-green-lg"><?php echo e(translate('Save Changes')); ?></button>
                                    <!-- End Buttons -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script type="text/javascript">

    function get_state_by_country(){
        var country_id = $('#country_id').val();
        $.post('<?php echo e(route('cities.get_city_by_country')); ?>',{_token:'<?php echo e(csrf_token()); ?>', country_id:country_id}, function(data){
            $('#state_id').html(null);
            for (var i = 0; i < data.length; i++) {
                $('#state_id').append($('<option>', {
                    value: data[i].id,
                    text: data[i].name
                }));
            }
            $("#state_id > option").each(function() {
                <?php if(isset($user_profile->user->address->state_id) && !empty($user_profile->user->address->state_id)): ?>
                  var st_id = "<?php echo e($user_profile->user->address->state_id); ?>";
                <?php else: ?>
                   var st_id = '__y';
                <?php endif; ?>
                if(this.value == st_id){
                    $("#state_id").val(this.value).change();
                }
            });

        });
    }

    $(document).ready(function(){
        get_state_by_country();
    });

    $('#country_id').on('change', function() {
        get_state_by_country();
    });

   /* $("#username").keyup(function(){
        var username = $("#username").val().trim();
        if(username != '')
        {
            $.post('<?php echo e(route('user_name_check')); ?>',{_token:'<?php echo e(csrf_token()); ?>', username:username}, function(data){
                $('#uname_response').html(data);
            });
        }
    });*/
    var verify_clicked = 0;
$('.send_verification').on('click',function(e){
    if(verify_clicked==1){ 
        e.preventDefault();
    }
    verify_clicked = 1;
})
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.default.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/frontend/default/user/freelancer/settings/profile.blade.php ENDPATH**/ ?>