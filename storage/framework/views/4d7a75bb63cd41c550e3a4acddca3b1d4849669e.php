
<?php echo $__env->make('emails.header_email', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- Intro -->
  <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
    <tr>
      <th  style="font-family:'Ubuntu', Arial,sans-serif; font-size:50px; line-height:26px;padding-top: 12px; margin-top: 12px;"><?php echo e($array['subject']); ?><br><br></th>
    </tr>
    <tr>
      <td class="p30-15" style="padding: 40px 30px 70px 30px;">
        <table style="white-space: nowrap;" width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <th  style="font-family:'Ubuntu', Arial,sans-serif; font-size:15px; line-height:26px; text-align:left; color:#000000; padding-bottom:30px;">Name:</th>
            <td class="h2 center pb10" style="color:#000000; font-family:'Ubuntu', Arial,sans-serif; font-size:15px; text-align:left; padding-bottom:30px;"><?php echo e($array['name']); ?></td>
          </tr>
          <tr>
            <th  style="font-family:'Ubuntu', Arial,sans-serif; font-size:15px; line-height:26px; text-align:left; color:#000000; padding-bottom:30px;">username:</th>
            <td class="h2 center pb10" style="color:#000000; font-family:'Ubuntu', Arial,sans-serif; font-size:15px; text-align:left; padding-bottom:30px;"><?php echo e($array['username']); ?></td>
          </tr>
          <tr>
            <th  style="font-family:'Ubuntu', Arial,sans-serif; font-size:15px; line-height:26px; text-align:left; color:#000000; padding-bottom:30px;">Email:</th>
            <td class="h5 center blue pb30" style="font-family:'Ubuntu', Arial,sans-serif; font-size:15px; line-height:26px; text-align:left; color:#2e57ae; padding-bottom:30px;"><?php echo e($array['email']); ?> </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <!-- END Intro -->

<?php echo $__env->make('emails.footer_email', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/emails/welcome_email.blade.php ENDPATH**/ ?>