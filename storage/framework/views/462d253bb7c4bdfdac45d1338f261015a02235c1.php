

<?php $__env->startSection('content'); ?>
<style>
    .invalid-feedback{
        display: block;
    }
</style>
    <section class="py-5 client-profile-section fdfsgdf">
        <div class="container">

            <div class="d-flex align-items-start">
                <!-- <?php echo $__env->make('frontend.default.user.client.inc.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> -->

                <div class="aiz-user-panel p-0">
                     <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="aiz-titlebar mt-2 mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h1 class="h3"><?php echo e(translate('Profile Setting')); ?></h1>
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
                        <div class="card-header px-0">
                            <h4 class="h3 font-weight-bold mb-0"><?php echo e(translate('Account Info')); ?></h4>
                        </div>
                        <div class="card-body px-0">
                            <!-- Personal Info Form -->
                            <form class="js-validate" action="<?php echo e(route('user_profile.bio_update')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="js-form-message">
                                            <label id="usernameLabel" class="form-label h5 text-dark"><?php echo e(translate('Username')); ?>

                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="form-group mb-4 mb-md-0">
                                                <input type="text" class="form-control radius-10" name="username" <?php if($user_profile->user->user_name != null): ?> value="<?php echo e($user_profile->user->user_name); ?>" <?php endif; ?> placeholder="Enter your username" aria-label="Enter your username" required aria-describedby="usernameLabel" data-msg="Please enter your username." data-error-class="u-has-error" data-success-class="u-has-success" readonly>
                                                <small class="form-text text-muted"><?php echo e(translate('Only a-z, numbers, hypen allowed')); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4 mb-md-0">
                                            <label id="emailLabel" class="form-label h5 text-dark"><?php echo e(translate('Email address')); ?>

                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group radius-10 overflow-hidden border">
                                                <input type="email" class="form-control radius-10" name="email" <?php if($user_profile->user->email != null): ?> value="<?php echo e($user_profile->user->email); ?>" <?php endif; ?> placeholder="Enter your email address" aria-label="Enter your email address" required aria-describedby="emailLabel" disabled>
                                                <div class="input-group-append">
                                                    <?php if($user_profile->user->email_verified_at == null): ?>
                                                        <a class="btn btn-secondary send_verification"  href="<?php echo e(route('email.verification')); ?>">
                                                            <?php echo e(translate('Send Verification Link')); ?>

                                                        </a>
                                                    <?php else: ?>
                                                        <span class="btn btn-green-lg">
                                                            <?php echo e(translate('Verified')); ?>

                                                            <i class="las la-check"></i>
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php if($user_profile->user->email_verified_at == null): ?>
                                                <span class="alert alert-danger d-block py-1 mt-1"><?php echo e(translate('Verify your email address')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header px-0">
                                        <h4 class="h3 font-weight-bold mb-0"><?php echo e(translate('Change Password')); ?></h4>
                                    </div>
                                    <div class="card-body px-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-4 mb-md-0">
                                                    <label id="emailLabel" class="form-label h5 text-dark"><?php echo e(translate('New Password')); ?></label>
                                                     <input type="password" class="form-control <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="new_password" placeholder="<?php echo e(translate('New Password')); ?>" >
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
                                                <div class="form-group mb-4 mb-md-0">
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
                                        </div>
                                        <div class="text-right mt-4">
                                            <!-- Buttons -->
                                            <button type="submit" class="btn btn-green-lg "><?php echo e(translate('Save Changes')); ?></button>
                                            <!-- End Buttons -->
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- End Personal Info Form -->
                        </div>
                    </div>
                   
                    <div class="card">
                        <div class="card-header px-0">
                            <h4 class="h3 font-weight-bold mb-0"><?php echo e(translate('Basic Info')); ?></h4>
                        </div>
                        <div class="card-body px-0">
                            <!-- Personal Info Form -->
                        <form action="<?php echo e(route('user_profile.basic_info_update')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div div class="row">
                                    <div class="form-group mb-4 col-md-6">
                                        <label id="nameLabel" class="form-label h5 text-dark">
                                            <?php echo e(translate('Name')); ?>

                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control radius-10 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e($user_profile->user->name); ?>" placeholder="Enter your name">
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
                                     <div class="form-group mb-4 col-md-6">
                                        <label class="form-label h5 text-dark">
                                            <?php echo e(translate('Company Name')); ?>

                                            <span class="text-danger">*</span>
                                        </label>
                                        <!-- Input -->
                                         <input type="text" class="form-control radius-10 <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="company_name" value="<?php echo e($user_profile->company_name); ?>" placeholder="Enter your name">
                                        <!-- End Input -->
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
                                </div>
                                <div class="text-right mt-4">
                                    <!-- Buttons -->
                                    <button type="submit" class="btn btn-green-lg"><?php echo e(translate('Save Changes')); ?></button>
                                    <!-- End Buttons -->
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header px-0">
                            <h4 class="h3 font-weight-bold mb-0"><?php echo e(translate('Profile Images')); ?></h4>
                        </div>
                        <form class="js-validate" action="<?php echo e(route('user_profile.photo_update')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="card-body px-0">
                                <div class="form-group mb-4 mb-md-0">
                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium"><?php echo e(translate('Browse')); ?></div>
                                        </div>
                                        <div class="form-control radius-10 file-amount"><?php echo e(translate('Choose File')); ?></div>
                                        <input type="hidden" name="profile_photo" class="selected-files" value="<?php echo e($user_profile->user->photo); ?>">
                                    </div>
                                    <div class="file-preview box">
                                    </div>
                                </div>
                                <div class="text-right mt-4">
                                    <!-- Buttons -->
                                    <button type="submit" class="btn btn-green-lg "><?php echo e(translate('Save Changes')); ?></button>
                                    <!-- End Buttons -->
                                </div>
                            </div>
                        </form>
                    </div>
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
        //get_state_by_city();
    });

    $('#country_id').on('change', function() {
        //get_state_by_city();
    });
    var verify_clicked = 0;
$('.send_verification').on('click',function(e){
    if(verify_clicked==1){ 
        e.preventDefault();
    }
    verify_clicked = 1;
})
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.default.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/frontend/default/user/client/settings/profile.blade.php ENDPATH**/ ?>