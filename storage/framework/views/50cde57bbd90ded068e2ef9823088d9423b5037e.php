

<?php $__env->startSection('content'); ?>
<div class="h-100 bg-cover bg-center py-5 d-flex align-items-center" style="background-image: url(<?php echo e(custom_asset(\App\Utility\SettingsUtility::get_settings_value('admin_login_background'))); ?>)">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-xl-4 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-5 text-center">
                            <img src="<?php echo e(custom_asset(\App\Utility\SettingsUtility::get_settings_value('system_logo_black'))); ?>" class="mw-100 mb-4" height="40">
                            <!-- <h1 class="h3 text-primary mb-0"><?php echo e(translate('Welcome to')); ?> <?php echo e(env('APP_NAME')); ?></h1> -->
                            <p><?php echo e(translate('Login to your account.')); ?></p>
                        </div>
                        <form method="POST" action="<?php echo e(route('login')); ?>" class="needs-validation">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <input class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="email" placeholder="Email" id="email" name="email" autocomplete="off" required >
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
                            <div class="form-group">
                                <input class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="password" placeholder="********" id="password" name="password" autocomplete="off" required>
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
                            <!--begin::Action-->
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="<?php echo e(route('password.request')); ?>" class="text-secondary">
                                    <?php echo e(translate('Forgot Password')); ?> ?
                                </a>
                                <button type="submit" class="btn btn-primary"><?php echo e(translate('Sign In')); ?></button>
                            </div>
                            <!--end::Action-->
                        </form>
                        <?php if(env('DEMO_MODE') == 'On'): ?>
                            <div class="d-flex justify-content-between align-items-center mt-4 border p-3">
                                <a href="#" class="text-secondary">
                                    admin@example.com  -  123456
                                </a>
                                <button class="btn btn-sm btn-outline-info" onclick="autoFill()">copy</button>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer justify-content-center">
                        <p class="mb-0">&copy; <?php echo e(env('APP_NAME')); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        function autoFill(){
            $('#email').val('admin@example.com');
            $('#password').val('123456');
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.default.layouts.blank', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/auth/login.blade.php ENDPATH**/ ?>