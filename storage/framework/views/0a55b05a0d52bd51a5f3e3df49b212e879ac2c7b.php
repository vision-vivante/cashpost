<?php echo $__env->make('emails.header_email', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<!-- Intro -->
		<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
			<tr>
				<td class="p30-15" style="padding: 70px 30px 70px 30px;">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td class="h2 center pb10" style="color:#000000; font-family:'Ubuntu', Arial,sans-serif; font-size:32px; line-height:60px; text-align:center; padding-bottom:10px;"><?php echo e($array['subject']); ?></td>
						</tr>
						<tr>
							<td class="h5 center blue pb30" style="font-family:'Ubuntu', Arial,sans-serif; font-size:20px; line-height:26px; text-align:center; color:#2e57ae; padding-bottom:30px;"><?php echo e($array['content']); ?> </td>
						</tr>
						<?php if(!empty( $array['link'])): ?>
							
							<tr>
								<td class="h5 center blue pb30" style="font-family:'Ubuntu', Arial,sans-serif; font-size:20px; line-height:26px; text-align:center; color:#2e57ae; padding-bottom:30px;">
									<a href="<?php echo e($array['link']); ?>" style="background: #007bff;padding: 0.9rem 2rem;font-size: 0.875rem;color:#fff;border-radius: .2rem;" target="_blank"><?php if(!empty($array['title'])): ?> <?php echo e($array['title']); ?> <?php else: ?> <?php echo e(translate("Go to link")); ?> <?php endif; ?></a>
								</td>
							</tr>
							
						<?php endif; ?>
					</table>
				</td>
			</tr>
		</table>
		<!-- END Intro -->
									
	<?php echo $__env->make('emails.footer_email', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/emails/template.blade.php ENDPATH**/ ?>