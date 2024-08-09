

<?php $__env->startSection('content'); ?>
<style>
    .aiz-header-other, .aiz-footer{
        display: none;
    }
</style>
<div class="sign-up-section forgot-password min-vh-100 overflow-auto">
    <div class="container-fluid px-0">
        <div class="card mb-0 border-0 rounded-0 text-sm-right ">
            <div class="row no-gutters justify-content-start">
                <div class="col-sm-3 d-none d-sm-block" style="height:100vh;">
                    <span class="overlay-gradient"></span>
                    <img src="<?php echo e(asset('public/uploads/all/img-side.png')); ?>" alt="..." class="overlay">
                    <div class="content position-relative">
                    <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset('public/uploads/all/icon-cash.png')); ?>" alt="" class="img-fluid mx-auto p-3"></a>
                        <h3 class="text-white pt-7 px-4 text-24">"World's most affordable influencer marketing platform."</h3>
                    </div>
                </div>
                <div class="col-sm-9 form-card" style="height:100vh; overflow:auto;">
                    <div class="card-body">
                        <div class="mb-5 text-center">
                            <h1 class="h3 text-primary mb-0">Forgot password?</h1>
                        </div>
                        <form method="POST" action="<?php echo e(route('password.email')); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="form-group">
                                <label class="form-label h5 text-dark" for="signinSrEmail">Email address</label>
                                <input id="email" type="email" class="form-control radius-10 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Your Email address" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="off" autofocus>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="mb-4">
                                <button type="submit" class="btn mt-4 btn-green-lg btn-block"><?php echo e(translate('Reset Password')); ?></button>
                            </div>

                            <div class="text-center mb-3">
                                <p class="text-grey mb-2">Remember your password?</p>
                                <a class="link-color h5 text-decoration-underline fw-600" href="<?php echo e(route('login')); ?>">Login to your account</a>
                            </div>

                            <?php if(session('status')): ?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo e(session('status')); ?>

                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.default.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/auth/passwords/email.blade.php ENDPATH**/ ?>