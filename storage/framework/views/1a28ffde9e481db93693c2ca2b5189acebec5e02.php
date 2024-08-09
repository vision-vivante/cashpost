

<?php $__env->startSection('content'); ?>
<?php
    $type = isset($_GET['type']) ? $_GET['type'] : '';  
    $search = isset($_GET['search']) ? $_GET['search'] : '';  
    $project = isset($_GET['project']) ? $_GET['project'] : '';  
?>
<section class="py-5">
    <div class="container">
        <div class="d-flex align-items-start my-campaigns-status">
            <div class="aiz-user-panel">
                <div class="aiz-titlebar pt-5 border-top mb-4">
                    <div class="add-new-campaign d-flex justify-content-between flex-column flex-sm-row align-items-sm-center align-items-start">
                        
                        <h2 class="font-weight-bold my-campus-title"><?php echo e(translate('Bidded Projects')); ?></h2>
                        <a href="<?php echo e(route('projects.create')); ?>" class="btn btn-green-lg">
                            <i class="las la-plus"></i>
                            <span><?php echo e(translate('Add New Project')); ?></span>
                        </a>
                    </div>
                    <?php echo $__env->make('frontend.default.user.client.inc.dashboard_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table h6 aiz-table mb-0">
                                        <thead class="font-weight-bold">
                                            <tr>
                                                <th class="h6" width="10%"><?php echo e(translate('Sr no.')); ?></th>
                                                <th class="h6"><?php echo e(translate('Image')); ?></th>
                                                <th class="h6"><?php echo e(translate('Campaign title')); ?></th>
                                                <th class="h6"><?php echo e(translate('Influencer Name')); ?></th>
                                                <th class="h6"><?php echo e(translate('Brand name')); ?></th>
                                                <th class="h6"><?php echo e(translate('Credits')); ?></th>
                                                <th class="h6"><?php echo e(translate('Action')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $bid_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bid_user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          
                                            <?php 
                                                $client_photo = user_profile_pic($bid_user->bid_by_user_id);
                                                $brand_name=get_brand_name($bid_user->client_user_id);
                                                $status=get_all_projects($bid_user);
                                            ?>  
                                                <tr>
                                                    <td class="h6"><?php echo e($key + $bid_users->firstItem()); ?></td>
                                                    <td class="h6">
                                                        <?php if(custom_asset($client_photo)): ?>
                                                            <img src="<?php echo e(custom_asset($client_photo)); ?>" width="70" height="50" alt="" class="img-fluid radius-10 radius-10">
                                                        <?php else: ?>
                                                            <img class="img-fluid radius-10" src="<?php echo e(my_asset('assets/frontend/default/img/avatar-place.png')); ?>" width="70" height="50" alt="">
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="h6"><a href="<?php echo e(route('project.details', $bid_user->slug)); ?>" class="text-inherit"> <?php echo e($bid_user->name); ?></a></td>
                                                    <td class="h6"><?php echo e(get_userdata($bid_user->bid_by_user_id)->name); ?></td>
                                                    <td class="h6"><?php echo e($brand_name); ?></td>
                                                    <td class="h6"><?php echo e($bid_user->amount); ?> Credits</td>
                                                    <td class="h6">
                                                        <?php if($bid_user->banned_project == null): ?>
                                                            <a href="<?php echo e(url('chat?receiver='.$bid_user->bid_by_user_id.'&project='.$bid_user->slug)); ?>" class="btn btn-primary btn-sm">Chat</a>
                                                            <?php
                                                                $w = Auth::user()->profile->balance;
                                                                
                                                            ?> 
                                                            
                                                            <?php if( $w >= (int)$bid_user->amount ): ?>
                                                           <a href="javascript:void(0)" class="btn btn-success btn-sm" onclick="hiring_modal(<?php echo e($bid_user->project_id); ?>, <?php echo e($bid_user->bid_by_user_id); ?> ,<?php echo e($bid_user->amount); ?>)"><?php echo e(translate('Accept')); ?>

                                                            </a>
                                                            <?php else: ?>
                                                            <?php 
                                                                $am = ($bid_user->amount) - (Auth::user()->profile->balance);
                                                                if($am < 25){
                                                                    $am = 25;
                                                                }
                                                            ?>
                                                            <a href="javascript:void(0)" class="btn btn-success btn-sm" onclick="show_wallet_modal( <?php echo e($am); ?> )"><?php echo e(translate('Accept')); ?>

                                                            </a>
                                                            <?php endif; ?>

                                                            <a href="<?php echo e(url('hiring-invitation/reject'.$bid_user->bid_by_user_id.'?bid_by_user_id='.$bid_user->bid_by_user_id.'&project='.$bid_user->slug)); ?>" class="btn btn-danger btn-sm"><?php echo e(translate('Reject')); ?>

                                                            </a>
                                                        <?php else: ?>
                                                            <p>Campaign Banned by Admin</p>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                    <div class="aiz-pagination aiz-pagination-right">
                                    <h6 class="m-0 text-grey">Showing 1 to <?php echo e($items); ?> entries <?php echo e($bid_users->total()); ?></h6>
                                    <?php echo e($bid_users->appends(['type'=> $type,'search'=>$search,'project'=>$project])->links()); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    submitted = false;
    function sort_projects(el){
        $('#sort_projects').submit();
    }
</script>
   <script type="text/javascript">
        function hiring_modal(project_id, user_id,amount){
            $('input[name=project_id]').val(project_id);
            $('input[name=bid_by_user_id]').val(user_id);
            $('input[name=amount]').val(amount);
            $('.message h4').remove();
            $('.message').append('<h4 class="text-center">Hiring Amount: '+amount+' <span>Credits</span></h4>');
            $('#hiring_modal').modal('show');
        }
        function show_wallet_modal(amount){
            $('#wallet_modal').modal('show');
            $('input[name=amount]').val(amount);

        }
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
<div class="modal fade" id="hiring_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo e(translate('Confirm Hiring')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body" id="hiring_modal_body">
                
                <form class="form-horizontal" onsubmit="if(submitted) return false; submitted = true; return true" action="<?php echo e(route('hiring_confirmation_store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="bid_by_user_id" value="" required>
                    <input type="hidden" name="project_id" value="" required>
                    <input type="hidden" name="amount" value="" required>
                    <div class="form-group">
                        <div class="form-group">
                            <div class="message"></div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-sm btn-primary transition-3d-hover mr-1"><?php echo e(translate('Hire Now')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="wallet_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo e(translate('Recharge Wallet')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="" action="<?php echo e(route('wallet.recharge')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-body gry-bg px-3 pt-3">
                    <p> you have not sufficiant balance, please recharge your wallet and come back for hiring. </p>
                        <div class="row">
                            <div class="col-md-3">
                                <label><?php echo e(translate('Amount')); ?> <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" lang="en" class="form-control mb-3" min="<?php echo e(get_setting('minimum_wallet_amount')); ?>" name="amount" placeholder="<?php echo e(translate('Amount')); ?>" required>
                                <input type="hidden" name="service_fee" value="<?php echo e(get_setting('service_fees')); ?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <h6 class="text-danger mt-2">Service fee $<?php echo e(get_setting('service_fees')); ?>*</h6>
                            <h6 class="text-danger mt-2">Min $<?php echo e(get_setting('minimum_wallet_amount')); ?>*</h6>
                        </div>
                        <div class="row">                           
                            <?php if(get_setting('stripe_activation_checkbox')): ?>
                                <div class="col-6 col-md-4">
                                    <label class="aiz-megabox d-block mb-3">
                                        <input value="stripe" id="payment_option" type="radio" name="payment_option" checked>
                                        <span class="d-block p-3 aiz-megabox-elem">
                                            <img src="<?php echo e(my_asset('assets/frontend/default/img/stripe.png')); ?>" class="img-fluid mb-2">
                                            <span class="d-block text-center">
                                                <span class="d-block fw-600 fs-15"><?php echo e(translate('Stripe')); ?></span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            <?php endif; ?>                            
                        </div>
                      <div class="form-group text-right">
                          <button type="submit" class="btn btn-sm btn-primary transition-3d-hover mr-1"><?php echo e(translate('Confirm')); ?></button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.default.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/frontend/default/user/client/projects/bids.blade.php ENDPATH**/ ?>