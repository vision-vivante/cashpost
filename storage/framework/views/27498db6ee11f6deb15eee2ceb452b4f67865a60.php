<?php $__env->startSection('content'); ?>
<section class="py-5 transaction_page">
    <div class="container">
        <div class="d-flex align-items-start">
            <div class="aiz-user-panel p-0">
                <div class="aiz-titlebar mt-2 mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <?php if(isClient()): ?>
                                <h2 class="font-weight-bold"><?php echo e(translate('Wallet')); ?></h2>
                            <?php else: ?>
                                <h2 class="font-weight-bold"><?php echo e(translate('Transactions')); ?></h2>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php if(isClient()): ?>
                   
                    <div class="row wallet-balance-sec">
                        <div class="col-lg-4 col-sm-6 mb-4 mb-sm-0">
                          <div class="text-dark rounded-lg overflow-hidden">
                            <div class="row credits">
                                <div class="col-sm-3 col-4 img-balance">
                                    <img src="<?php echo e(my_asset('assets/frontend/default/img/wallet1.png')); ?>">
                                </div>
                                <div class="col-sm-7 col-8 my-credits">
                                    <div class="my-border">
                                        <div class="h2 fw-700"><?php echo e(single_price(Auth::user()->profile->balance)); ?>

                                        </div>
                                        <div class="h6 text-grey"><?php echo e(translate('Credits')); ?></div>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-4 col-lg-5 col-sm-6" >
                     
                        <form class="" action="<?php echo e(route('wallet.recharge')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="modal-body gry-bg p-0">
                                <div class="row add-ammount-sec">
                                    <div class="col-12 h6">
                                        <label class="mb-0"><?php echo e(translate('$1.00 = 1 credit')); ?></label>
                                    </div>
                                    <div class="col-12">
                                        <div class="row add-fund align-items-center">
                                            <div class="col-6">
                                                <div class="input-group my-input radius-10 overflow-hidden border px-3">
                                                    <span class="input-group-text p-0 bg-transparent border-0" id="basic-addon1">$</span>
                                                    <input type="number" lang="en" class="form-control" min="<?php echo e(get_setting('minimum_wallet_amount')); ?>" name="amount" placeholder="<?php echo e(translate('Amount')); ?>" required>
                                                    <input type="hidden" name="service_fee" value="<?php echo e(get_setting('service_fees')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-6"><button type="submit" class="btn btn-green transition-3d-hover mr-1"><?php echo e(translate('Add Funds')); ?></button></div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <h6 class="text-danger mt-2">Service fee $<?php echo e(get_setting('service_fees')); ?>*</h6>
                                        <h6 class="text-danger mt-2">Min $<?php echo e(get_setting('minimum_wallet_amount')); ?>*</h6>
                                    </div>
                                </div>
                                <input value="stripe" id="payment_option" type="hidden" name="payment_option" checked>
                                
                              <div class="form-group text-right">
                                  
                              </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header">
                        <?php if(isClient()): ?>
                            <h2 class="font-weight-bold"><?php echo e(translate('My Wallet')); ?></h2>
                        <?php else: ?>
                            <h5 class="mb-0 h6"><?php echo e(translate('My Transactions')); ?></h5>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <table class="table aiz-table mb-0 table-responsive">
                            <thead>
                                <tr>
                                    <th><?php echo e(translate('Sr no.')); ?></th>
                                    <th data-breakpoints="lg"><?php echo e(translate('Date')); ?></th>
                                    <th><?php echo e(translate('Campaign Name')); ?></th>
                                    <?php if(Auth::user()->user_type == 'client'): ?>
                                        <th data-breakpoints="lg"><?php echo e(translate('Influencer Name')); ?></th>
                                    <?php elseif(Auth::user()->user_type == 'freelancer'): ?>
                                        <th data-breakpoints="lg"><?php echo e(translate('Client Name')); ?></th>
                                    <?php endif; ?>
                                    <th><?php echo e(translate('Amount')); ?></th>
                                    <th><?php echo e(translate('Commission / Fee')); ?></th>
                                    <!-- <th data-breakpoints="lg"><?php echo e(translate('Payment Method')); ?></th> -->
                                    <th><?php echo e(translate('Status')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $wallets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $wallet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key + $wallets->firstItem()); ?></td>
                                        <td><?php echo e(date('d-m-Y', strtotime($wallet->created_at))); ?></td>
                                        <td><?php echo e(ucfirst($wallet->name)); ?></td>
                                        <?php if(Auth::user()->user_type == 'client'): ?>
                                            <td><?php echo e(ucfirst(getInviteUser($wallet->receiver_id))); ?></td>
                                        <?php elseif(Auth::user()->user_type == 'freelancer'): ?>
                                            <td><?php echo e(ucfirst(getInviteUser($wallet->client_user_id))); ?></td>
                                        <?php endif; ?>
                                        <td><?php echo e(single_price($wallet->amount)); ?></td>
                                        <td><?php echo e($wallet->commission_fee); ?></td>
                                        <td><?php echo e(($wallet->send_to_user)?payment_status($wallet->send_to_user):'-'); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                        <div class="aiz-pagination">
                            <?php echo e($wallets->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>

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
                        <div class="row">
                            <div class="col-md-3">
                                <label><?php echo e(translate('Amount')); ?> <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" lang="en" class="form-control mb-3" min="1" name="amount" placeholder="<?php echo e(translate('Amount')); ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <!-- <?php if(get_setting('paypal_activation_checkbox')): ?>
                                <div class="col-6 col-md-4">
                                    <label class="aiz-megabox d-block mb-3">
                                        <input value="paypal" id="payment_option" type="radio" name="payment_option" checked>
                                        <span class="d-block p-3 aiz-megabox-elem">
                                            <img src="<?php echo e(my_asset('assets/frontend/default/img/paypal.png')); ?>" class="img-fluid mb-2">
                                            <span class="d-block text-center">
                                                <span class="d-block fw-600 fs-15"><?php echo e(translate('Paypal')); ?></span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            <?php endif; ?> -->
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
                            <!-- <?php if(get_setting('sslcommerz_activation_checkbox')): ?>
                                <div class="col-6 col-md-4">
                                    <label class="aiz-megabox d-block mb-3">
                                        <input value="sslcommerz" id="payment_option" type="radio" name="payment_option" checked>
                                        <span class="d-block p-3 aiz-megabox-elem">
                                            <img src="<?php echo e(my_asset('assets/frontend/default/img/sslcommerz.png')); ?>" class="img-fluid mb-2">
                                            <span class="d-block text-center">
                                                <span class="d-block fw-600 fs-15"><?php echo e(translate('sslcommerz')); ?></span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            <?php endif; ?>
                            <?php if(get_setting('paystack_activation_checkbox')): ?>
                                <div class="col-6 col-md-4">
                                    <label class="aiz-megabox d-block mb-3">
                                        <input value="paystack" id="payment_option" type="radio" name="payment_option" checked>
                                        <span class="d-block p-3 aiz-megabox-elem">
                                            <img src="<?php echo e(my_asset('assets/frontend/default/img/paystack.png')); ?>" class="img-fluid mb-2">
                                            <span class="d-block text-center">
                                                <span class="d-block fw-600 fs-15"><?php echo e(translate('Paystack')); ?></span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            <?php endif; ?>
                            <?php if(get_setting('instamojo_activation_checkbox')): ?>
                                <div class="col-6 col-md-4">
                                    <label class="aiz-megabox d-block mb-3">
                                        <input value="instamojo" id="payment_option" type="radio" name="payment_option" checked>
                                        <span class="d-block p-3 aiz-megabox-elem">
                                            <img src="<?php echo e(my_asset('assets/frontend/default/img/instamojo.png')); ?>" class="img-fluid mb-2">
                                            <span class="d-block text-center">
                                                <span class="d-block fw-600 fs-15"><?php echo e(translate('Instamojo')); ?></span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            <?php endif; ?>
                            <?php if(get_setting('paytm_activation_checkbox')): ?>
                                <div class="col-6 col-md-4">
                                    <label class="aiz-megabox d-block mb-3">
                                        <input value="paytm" id="payment_option" type="radio" name="payment_option" checked>
                                        <span class="d-block p-3 aiz-megabox-elem">
                                            <img src="<?php echo e(my_asset('assets/frontend/default/img/paytm.png')); ?>" class="img-fluid mb-2">
                                            <span class="d-block text-center">
                                                <span class="d-block fw-600 fs-15"><?php echo e(translate('Paytm')); ?></span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            <?php endif; ?> -->
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

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        function show_wallet_modal(){
            $('#wallet_modal').modal('show');
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.default.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/frontend/default/user/wallet/index.blade.php ENDPATH**/ ?>