<?php $__env->startSection('content'); ?>
<?php
    $type = isset($_GET['type']) ? $_GET['type'] : '';  
    $search = isset($_GET['search']) ? $_GET['search'] : '';  
    $project = isset($_GET['project']) ? $_GET['project'] : '';  
?>
<section class="find-job-section">
		<div class="aiz-user-panel">
			<div class="container">
				<div class="find-job-heading">
					<div class="title mt-3 mt-md-5">
						<h2 class="font-weight-bold">Opportunities</h2>
					</div>
					<div class="sub-title mb-3">
						<h3 class="font-weight-bold mb-0"> <?php echo $find_all_project->total(); ?> Campaigns Found</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-12 filter-job">
						<form class="" id="sort_projects" action="" method="GET">
							<div class="row justify-content-between">
								<div class="col-md-5 search-job mb-3 mb-md-0">
									<div class="input-group">
										<div class="input-group-append">
											<button class="btn" type="submit">
												<i class="bi bi-search text-grey"></i>
											</button>
										</div>
										<input type="text" class="form-control" placeholder="Search by Campaign" name="search" <?php if(isset($sort_search)): ?> value="<?php echo e($sort_search); ?>" <?php endif; ?>>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="find-jobs-cards">
					<div class="row">
						<?php $__currentLoopData = $find_all_project; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php
							$image_id=ProjectCategory($project->project_category_id)->photo;
							$client_photo = user_profile_pic($project->client_user_id);
						?>
						<div class="col-lg-4 col-sm-6 mb-5">
						<a href="<?php echo e(route('project.details', $project->slug)); ?>" class="text-inherit"> 
							<div class="card job-card">
								<div class="row align-items-center">
									<div class="col-4 card-img">
										<?php if(custom_asset($client_photo)): ?>
										<div class="brand-img position-relative">
											<img src="<?php echo e(custom_asset($client_photo)); ?>" width="21" height="21" alt="" class="img-fluid">
										</div>
										<?php else: ?>
										<div class="brand-img position-relative">
											<img src="<?php echo e(my_asset('assets/frontend/default/img/campaign.jpeg')); ?>" width="21" height="21" alt="" class="img-fluid">
										</div>
										<?php endif; ?>
									</div>
									<div class="col-8">
										<div class="card-body p-0">
											<div class="list-header d-flex align-items-center h6">
												<h4 class="font-weight-bold"><?php echo e($project->name); ?></h4>
											</div>
											<div class="card-main d-flex flex-column justify-content-between">
												<div class="list-footer d-flex">
													<h6 class="text-grey text-sm">
														<!-- <i class="bi bi-building with-icon"></i><?php echo e((\App\Models\UserProfile::Where('user_id',$project->client_user_id)->first()->company_name)); ?> -->

													</h6>
												</div>
											</div>
										</div>
									</div>
								</div>
								</div>
							</a>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
				<div class="aiz-pagination aiz-pagination-center">
					<?php echo e($find_all_project->appends(['type'=> $type,'search'=>$search,'project'=>$project])->links()); ?>

				</div>
			</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    function sort_projects(el){
        $('#sort_projects').submit();
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.default.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/frontend/default/user/freelancer/projects/my_find_project.blade.php ENDPATH**/ ?>