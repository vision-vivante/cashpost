<?php $__env->startComponent('mail::layout'); ?>

<?php $__env->slot('header'); ?>
<?php $__env->startComponent('mail::header', ['url' => config('app.url')]); ?>
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<th class="column" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td class="img m-center" style=" font-size:0pt; line-height:0pt; text-align:left;"><img src="<?php echo e(email_logo('other')); ?>" style="max-width: 150px; width:100%; object-fit:cover;  " border="0" alt="" /></td>
				</tr>
			</table>
		</th>
		<th class="column-empty" width="1" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal;"></th>
		<th class="column" width="120" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal;">
			
		</th>
	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td class="separator" style="padding-top: 40px; border-bottom:4px solid #000000; font-size:0pt; line-height:0pt;">&nbsp;</td>
	</tr>
</table>
<?php echo $__env->renderComponent(); ?>
<?php $__env->endSlot(); ?>


<?php echo e($slot); ?>


<?php if(isset($subcopy)): ?>
<?php $__env->slot('subcopy'); ?>
<?php $__env->startComponent('mail::subcopy'); ?>
<?php echo e($subcopy); ?>

<?php echo $__env->renderComponent(); ?>
<?php $__env->endSlot(); ?>
<?php endif; ?>


<?php $__env->slot('footer'); ?>
<?php $__env->startComponent('mail::footer'); ?>
© <?php echo e(date('Y')); ?> <?php echo e(config('app.name')); ?>. <?php echo app('translator')->get('All rights reserved.'); ?>
<?php echo $__env->renderComponent(); ?>
<?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/vendor/mail/html/message.blade.php ENDPATH**/ ?>