

<?php $__env->startSection('content'); ?>
<section class="pt-7 pb-6">
	<div class="container text-center">
		<div class="row">
			<div class="col-lg-6 mx-auto">
				<img src="<?php echo e(my_asset('assets/frontend/default/img/404.svg')); ?>" class="img-fluid mb-5 w-75">
				<h1 class="display-1 fw-700 text-danger"><?php echo e(translate('404')); ?></h1>
				<h2 class="h1 fw-600"><?php echo e(translate('Looks like you\'re lost')); ?>.</h2>
				<p class="lead mb-5"><?php echo e(translate('The page you\'re looking for is not available')); ?></p>
				<a href="<?php echo e(route('home')); ?>" class="btn btn-primary">
					<i class="la la-arrow-left mr-2"></i>
					<span><?php echo e(translate('Back to Homepage')); ?></span>
				</a>
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.default.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/errors/404.blade.php ENDPATH**/ ?>