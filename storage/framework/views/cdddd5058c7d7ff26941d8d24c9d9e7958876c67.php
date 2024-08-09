

<?php $__env->startSection('content'); ?>
<section class="dashboard-section">
	<div class="">
	<?php echo $__env->make('frontend.default.user.client.inc.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="aiz-user-panel col-12">
			<div class="container">
				<div class="row">
					<div class="col-md-6 mb-5 mb-lg-0">
						<div class="profile-status">
							<div class="heading p-3 d-flex justify-content-between border-bottom align-items-center">
								<div class="d-flex align-items-center">
									<h3 class="font-weight-bold mb-0"><?php echo e(translate('Completed Campaigns')); ?></h3>
								</div>
								<a href="<?php echo e(url('/projects/completed-project')); ?>" class="btn h5 mb-0 font-weight-bold p-0">View all</a>
							</div>

							<div class="card-body my-card-body p-0">
								<ul class="list-group list-group-flush">
								<?php $__empty_1 = true; $__currentLoopData = $completed_project; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
	                                        <?php  
	                                        	$client_photo = user_profile_pic($project->client_user_id);
	                                        	$cat_id=$project->project_category_id;
										$image_id=ProjectCategory($cat_id)->photo;
	                                        ?>
		            					<li class="list-group-item p-4">
		            						<a href="<?php echo e(route('project.details', $project->slug)); ?>" class="text-inherit">
											<div class="card my-card border-0 p-0 mb-0">
												<div class="row no-gutters align-items-center">
													<div class="col-lg-3 list-image mb-2 mb-lg-0">
														<?php if(custom_asset($image_id)): ?>
														<span class="social-icon">
															<img src="<?php echo e(custom_asset($image_id)); ?>" alt="" class="img-fluid">
														</span>
														<?php else: ?>
														<span class="social-icon">
															<img src="<?php echo e(my_asset('assets/frontend/default/img/campaign.jpeg')); ?>" alt="" class="img-fluid">
														</span>
														<?php endif; ?>
													</div>
													<div class="col-lg-9">
														<div class="card-body p-0">
															<div class="list-title mb-2 d-flex justify-content-between font-weight-bold">
																<h4 class="font-weight-bold"><?php echo e($project->name); ?></h4>
															</div>
															<div class="list-footer d-flex">
																<h6 class="text-grey text-sm">
																	<!-- <i class="bi bi-building with-icon"></i><?php echo e((\App\Models\UserProfile::Where('user_id',$project->client_user_id)->first()->company_name)); ?> -->
																</h6>
															</div>
														</div>
													</div>
												</div>
											</div>
										</a>
									</li>
                                    	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
	                                     	<div class="card">
				                              <div class="card-body text-center">
				                                  <i class="las la-frown la-4x mb-4 opacity-40"></i>
				                                  <h4><?php echo e(translate('Nothing Found')); ?></h4>
				                              </div>
			                            	</div>
                                  		<?php endif; ?>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="profile-status">
							<div class="heading p-3 d-flex justify-content-between border-bottom align-items-center">
								<div class="d-flex align-items-center aa"><h3 class="font-weight-bold mb-0"><?php echo e(translate('Active Campaigns')); ?></h3>
								</div>
								<a href="<?php echo e(url('/projects/running-project')); ?>" class="btn h5 mb-0 font-weight-bold p-0">View all</a>
							</div>
							<div class="card-body my-card-body p-0">
								<ul class="list-group list-group-flush">
                                   	<?php $__empty_1 = true; $__currentLoopData = $running_project; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
	                                        <?php  
	                                        	$client_photo = user_profile_pic($project->client_user_id);
	                                        	$cat_id=$project->project_category_id;
												$image_id=ProjectCategory($cat_id)->photo;
	                                        ?>
		            					<li class="list-group-item p-4">
		            						<a href="<?php echo e(route('project.details', $project->slug)); ?>" class="text-inherit">
												<div class="card my-card border-0 p-0 mb-0">
													<div class="row no-gutters align-items-center">
														<div class="col-lg-3 list-image mb-2 mb-lg-0">
															<?php if(custom_asset($image_id)): ?>
															<span class="social-icon">
																<img src="<?php echo e(custom_asset($image_id)); ?>"  alt="" class="img-fluid">
															</span>
															<?php else: ?>
															<span class="social-icon">
																<img src="<?php echo e(my_asset('assets/frontend/default/img/campaign.jpeg')); ?>"  alt="" class="img-fluid">
															</span>
															<?php endif; ?>
														</div>
														<div class="col-lg-9">
															<div class="card-body p-0">
																<div class="list-title mb-2 d-flex justify-content-between font-weight-bold">
																	<h4 class="font-weight-bold"><?php echo e($project->name); ?></h4>
																</div>
																<div class="list-footer d-flex">
																	<h6 class="text-grey text-sm">
																		<!-- <i class="bi bi-building with-icon"></i><?php echo e((\App\Models\UserProfile::Where('user_id',$project->client_user_id)->first()->company_name)); ?> -->
																	</h6>
																</div>
															</div>
														</div>
													</div>
												</div>
											</a>
										</li>
                                    		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
		                                        <div class="card">
					                              <div class="card-body text-center">
					                                  <i class="las la-frown la-4x mb-4 opacity-40"></i>
					                                  <h4><?php echo e(translate('Nothing Found')); ?></h4>
					                              </div>
				                            	</div>
                                   		<?php endif; ?>
								</ul>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.default.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/frontend/default/user/client/dashboard.blade.php ENDPATH**/ ?>