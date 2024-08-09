

<?php $__env->startSection('meta_title'); ?><?php echo e($page->meta_title); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('meta_description'); ?><?php echo e($page->meta_description); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('meta_keywords'); ?><?php echo e($page->keywords); ?><?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?>
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="<?php echo e($page->meta_title); ?>">
    <meta itemprop="description" content="<?php echo e($page->meta_description); ?>">
    <meta itemprop="image" content="<?php echo e(custom_asset($page->meta_img)); ?>">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="<?php echo e($page->meta_title); ?>">
    <meta name="twitter:description" content="<?php echo e($page->meta_description); ?>">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="<?php echo e(custom_asset($page->meta_img)); ?>">

    <!-- Open Graph data -->
    <meta property="og:title" content="<?php echo e($page->meta_title); ?>" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="<?php echo e(route('custom-pages.show_custom_page', $page->slug)); ?>" />
    <meta property="og:image" content="<?php echo e(custom_asset($page->meta_img)); ?>" />
    <meta property="og:description" content="<?php echo e($page->meta_description); ?>" />
    <meta property="og:site_name" content="<?php echo e($page->title); ?>" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $page->content; ?>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('frontend.default.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/frontend/default/privacy-policy.blade.php ENDPATH**/ ?>