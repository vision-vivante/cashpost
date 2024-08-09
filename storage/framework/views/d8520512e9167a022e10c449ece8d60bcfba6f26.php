<?php $__env->startSection('content'); ?> 

<section class="bank-detail-section">
        <div class="container">
            <div class="d-flex align-items-start">
                <div class="aiz-user-panel p-0">
                    <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="aiz-titlebar total-earning border-top py-5">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <h2 class="font-weight-bold heading mb-3"><?php echo e(translate('Payouts')); ?></h2>
                                <a href="/wallet">
                                <div class="payment-card">
                                    <div class="card my-card p-4 mb-0 h-100">
                                        <div class="row no-gutters">
                                        <div class="col-4 px-2">
                                            <img src="../public/uploads/all/money.png" alt="..." class="img-fluid">
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body p-0">
                                            <h2 class="text-dark font-weight-bold"><?php echo e(isset(Auth::user()->profile->balance) ? Auth::user()->profile->balance : 0); ?></h2>
                                            <p class="text-grey mb-0"><?php echo e(translate('Total earnings')); ?></p>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php if( !isset($user_profile->stripe_account) || (isset($user_profile->stripe_account) && $user_profile->stripe_account == null) ): ?>
                        <div class="card bank-detail py-4 mb-0 border-top add-account-button">
                            <div class="card-header border-0 px-0 align-items-start flex-column flex-sm-row">
                                <div class="order-last order-sm-first">
                                    <h3 class="heading font-weight-bold">Bank Account</h3>
                                    <h6 class="subtitle text-grey mb-4">Add a bank account to receive payments.</h6>
                                </div>
                                <h3 class="powred-by mb-sm-0 mb-4"> Powered by<span class="fw-800"> stripe</span></h3>
                            </div>
                            <div class="add-btn"><button class="btn btn-green-lg add-account">Add Account</button></div>
                        </div> 
                                          
                            <div class="card bank-detail py-4 border-top add-bank-detail" style="display:none">
                            <div class="card-header border-0 px-0 align-items-start flex-column flex-sm-row">
                                <div class="order-last order-sm-first">
                                    <h3 class="heading font-weight-bold"><?php echo e(translate('Bank Account')); ?></h3>
                                    <h6 class="subtitle text-grey">Add your bank account for receiving payment.</h6>
                                    <!-- <div class="process-point d-inline-flex position-relative mt-5">
                                        <div class="first-point d-flex align-items-center flex-column">
                                            <h6 class="text-white bg position-relative d-flex align-items-center justify-content-center z-99 fw-600">1</h6>
                                            <h6 class="mt-2 fw-600">Bank Details</h6>
                                        </div>  
                                        <div class="second-point d-flex align-items-center flex-column">
                                            <h6 class="text-grey bg position-relative d-flex align-items-center justify-content-center z-99 fw-600">2</h6>
                                            <h6 class="text-grey mt-2">Upload ID</h6>
                                        </div>  
                                    </div> -->
                                </div>
                                <h3 class="powred-by mb-sm-0 mb-4"> Powered by<span class="fw-800"> stripe</span></h3>
                            </div>
                            <div class="card-body my-bank-body px-0">
                                <form class="form-horizontal"  method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="js-form-message">
                                            <div class="form-group mb-4">
                                                <label id="nameLabel" class="form-label h5">
                                                    <?php echo e(translate('First Name')); ?>

                                                </label>
                                                <input type="text" class="form-control radius-10 <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="first_name" placeholder="Enter first name" value="<?php echo e(old('first_name',$account_data['first_name'])); ?>" >
                                                <?php $__errorArgs = ['first_name'];
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
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="js-form-message">
                                            <div class="form-group mb-4">
                                                <label id="nameLabel" class="form-label h5">
                                                    <?php echo e(translate('Last Name')); ?>

                                                </label>
                                                <input type="text" class="form-control radius-10 <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="last_name" placeholder="Enter last name" value="<?php echo e(old('last_name',$account_data['last_name'])); ?>" >
                                                <?php $__errorArgs = ['last_name'];
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
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="js-form-message">
                                            <div class="form-group col-8 p-0 mb-4">
                                                <label id="nameLabel" class="form-label h5">
                                                    <?php echo e(translate('Gender')); ?>

                                                </label>
                                                 <div class="d-flex justify-content-between py-1">
                                                    <label for="male" class="m-0 form-label h5">Male</label>

                                                    <input id="male" type="radio" class="<?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="gender" value="male" placeholder="Enter account holder name" <?php if('male'==old('gender')): ?> checked <?php endif; ?> >
                                                </div>
                                                <div class="d-flex justify-content-between py-1">
                                                    <label for="female" class="m-0 form-label h5">Female</label>
                                                    <input id="female" type="radio" class="<?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="gender" value="female" placeholder="Enter account holder name" <?php if('female'==old('gender')): ?> checked <?php endif; ?>>
                                                </div>
                                                <?php $__errorArgs = ['gender'];
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
                                    </div>
                                    
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="js-form-message">
                                            <div class="form-group mb-4">
                                                <label id="nameLabel" class="form-label h5">
                                                    <?php echo e(translate('Date of Birth')); ?>

                                                </label>
                                                <input type="text" class="aiz-date-range form-control radius-10  <?php $__errorArgs = ['dob'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" data-format="MM-DD-YYYY" name="dob" placeholder="MM-DD-YYYY" data-future-disable="true" data-single="true"  data-show-dropdown="true" data-last-date="<?php echo e($max_date); ?>" autocomplete="off"  value="<?php echo e(old('dob',$account_data['dob'])); ?>" readonly/><i class="bi bi-calendar my-calender position-absolute"></i></span>
                                                <?php $__errorArgs = ['dob'];
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
                                    </div>                                    
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="js-form-message">
                                            <div class="form-group mb-4">
                                                <label id="nameLabel" class="form-label h5">
                                                    <?php echo e(translate('City')); ?>

                                                </label>
                                                <input type="text" class="form-control radius-10 <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="city" placeholder="Enter city name" value="<?php echo e(old('city', $account_data['city'])); ?>" >
                                                <?php $__errorArgs = ['city'];
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
                                    </div>
                                    <?php  
                                    $country=\App\Models\Country::where('code','US')->first();
                                    $country_id=(isset($country->id)) ? $country->id : '';
                                    ?>
                                   
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="js-form-message">
                                            <div class="form-group mb-4">
                                                <label id="nameLabel" class="form-label h5">
                                                    <?php echo e(translate('State')); ?>

                                                </label>
                                                <input type="hidden" name="country_id" id="country_id" value="<?php echo e($country_id); ?>"> 
                                               

                                                <select class="form-control aiz-selectpicker <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="state" id="state_id" data-live-search="true" required>

                                                </select>
                                                <?php $__errorArgs = ['state'];
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
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="js-form-message">
                                            <div class="form-group mb-4">
                                                <label id="nameLabel" class="form-label h5">
                                                    <?php echo e(translate('Address 1')); ?>

                                                </label>
                                                <input type="text" class="form-control radius-10 <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="address" placeholder="Enter address" value="<?php echo e(old('address',$account_data['address'])); ?>" >
                                                <?php $__errorArgs = ['address'];
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
                                    </div>
                                                                        
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="js-form-message">
                                            <div class="form-group mb-4">
                                                <label id="nameLabel" class="form-label h5">
                                                    <?php echo e(translate('Zip Code')); ?>

                                                </label>
                                                <input type="text" class="form-control radius-10 <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="postal_code" placeholder="Enter zip code" value="<?php echo e(old('postal_code', $account_data['postal_code'])); ?>" >
                                                <?php $__errorArgs = ['postal_code'];
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
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="js-form-message">
                                            <div class="form-group mb-4">
                                                <label id="nameLabel" class="form-label h5">
                                                    <?php echo e(translate('Phone number')); ?>

                                                </label>
                                                <input type="text" class="form-control radius-10 <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="phone" placeholder="Enter Phone number" value="<?php echo e(old('phone',$account_data['phone'])); ?>" >
                                                <?php $__errorArgs = ['phone'];
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
                                    </div>
                                    
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="js-form-message">
                                            <div class="form-group mb-4">
                                                <label id="nameLabel" class="form-label h5">
                                                    <?php echo e(translate('Account Holder Name')); ?>

                                                </label>                                                
                                                <input type="text" class="form-control radius-10 <?php $__errorArgs = ['account_holder_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="account_holder_name" placeholder="Enter account holder name" value="<?php echo e(old( 'account_holder_name', $account_data['account_holder_name'] )); ?>" >
                                                <?php $__errorArgs = ['account_holder_name'];
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
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="js-form-message">
                                            <div class="form-group mb-4">
                                                <label id="nameLabel" class="form-label h5">
                                                    <?php echo e(translate('Bank Account Number')); ?>

                                                </label>                                                
                                                <input type="text" class="form-control radius-10 <?php $__errorArgs = ['account_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="account_number" placeholder="Enter account number" value="<?php echo e(old('account_number')); ?>" >
                                                <?php $__errorArgs = ['account_number'];
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
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="js-form-message">
                                            <div class="form-group mb-4">
                                                <label id="nameLabel" class="form-label h5">
                                                    <?php echo e(translate('Routing Number')); ?>

                                                </label>
                                                <input type="text" class="form-control radius-10 <?php $__errorArgs = ['routing_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="routing_number" placeholder="Enter routing number" value="<?php echo e(old('routing_number', $account_data['routing_number'])); ?>" >
                                                <?php $__errorArgs = ['routing_number'];
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
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="js-form-message">
                                            <div class="form-group mb-4">
                                                <label id="nameLabel" class="form-label h5">
                                                    <?php echo e(translate('Enter SSN')); ?>

                                                </label>
                                                <input type="text" class="form-control radius-10 <?php $__errorArgs = ['ssn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="ssn" placeholder="Enter SSN" value="<?php echo e(old('ssn', $account_data['ssn'])); ?>" >
                                                <?php $__errorArgs = ['ssn'];
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
                                    </div>
                                    
                                    <!-- <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-green-lg transition-3d-hover"><?php echo e(translate('Continue')); ?></button>
                                    </div> -->
                                </div>  
                                
                                <div class="row bank-detail-section page-2">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label text-dark h5 h5 mb-3">Front Identification*</label>
                                            <div class="input-group flex-column image-upload ">
                                                <div><i class="bi bi-cloud-upload h3 font-weight-bold mb-2 text-grey"></i></div>
                                                <div class="fw-600 text-dark h5">
                                                    <!-- <label for="chooseFile" class="custom-file-upload">
                                                        <i class="fa fa-cloud-upload"></i> Browse
                                                    </label> -->
                                                    <input type="file" class="form-control bg-transparent border-0 radius-10 <?php $__errorArgs = ['front_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="front_image"  >
                                                    <?php $__errorArgs = ['front_image'];
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
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label text-dark h5 h5 mb-3">Back Identification*</label>
                                            <div class="input-group flex-column image-upload ">
                                                <div><i class="bi bi-cloud-upload h3 font-weight-bold mb-2 text-grey"></i></div>
                                                <div class="fw-600 text-dark h5">
                                                    <!-- <label for="chooseFile" class="custom-file-upload">
                                                        <i class="fa fa-cloud-upload"></i> Browse
                                                    </label> -->
                                                    <input type="file" class="form-control bg-transparent border-0 radius-10 <?php $__errorArgs = ['back_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="back_image">
                                                    <?php $__errorArgs = ['back_image'];
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
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-green-lg transition-3d-hover"><?php echo e(translate('Add')); ?></button>
                                    </div>
                                </div>  
                                </form>                       
                            </div>
                        </div>
                    <?php else: ?>
                    <div class="row add-bank">
                        <div class="col-12">
                            <div class="card p-3 mb-3">
                                <div class="row no-gutters">
                                  <div class="col-2">
                                    <img src="../public/uploads/all/jpm.png" class="img-fluid" alt="...">
                                  </div>
                                  <div class="col-10 d-flex justify-content-between align-items-center">
                                        <div class="card-body p-lg-0 py-0">
                                            <h3 class="fw-600">Stripe</h3>
                                            <h6 class="text-grey"><?php echo e($user_profile->stripe_account); ?></h6>
                                        </div>
                                        <div class="body-left">
                                            <a href="<?php echo e(url('/stripe/delete-account')); ?>" onclick="return confirm('Are you sure want to delete this?');" >
                                                <h6 class="text-danger font-weight-bold"><i class="bi px-2 bi-trash"></i>Delete</h6>
                                            </a>
                                        </div>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<?php if(old()): ?>
    <script> 
        $('.add-account-button').hide();
        $('.add-bank-detail').show();
    </script>
<?php endif; ?>
<script>
    $('.add-account').click(function(){
        $('.add-bank-detail').show();
        $('.add-account-button').hide();
    })
</script>



<script type="text/javascript">

    function get_state_by_country(){
        var country_id = $('#country_id').val();
        $.post('<?php echo e(route('cities.get_city_by_country')); ?>',{_token:'<?php echo e(csrf_token()); ?>', country_id:country_id}, function(data){
            $('#state_id').html(null);
            for (var i = 0; i < data.length; i++) {
                $('#state_id').append($('<option>', {
                    value: data[i].name,
                    text: data[i].name
                }));
            }
            $("#state_id > option").each(function() {
               
                  var st_id = "<?php echo e(old('state', $account_data['state'])); ?>";
                if(this.value == st_id){
                    $("#state_id").val(this.value).change();
                }
            });

        }); 
    }

    $(document).ready(function(){
        get_state_by_country();
    });

    $('#country_id').on('change', function() {
        get_state_by_country();
    });

   
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.default.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/frontend/default/user/stripe.blade.php ENDPATH**/ ?>