

<?php $__env->startSection('content'); ?>

    <section class="">
        <div class="container">
            <div class="my-campaigns-status">
                <div class="aiz-user-panel p-0">
                <div class="aiz-titlebar pt-5 border-top mb-4">
                        <div class="add-new-campaign d-flex justify-content-between flex-column flex-sm-row align-items-sm-center align-items-start">
                            <h2 class="font-weight-bold my-campus-title"><?php echo e(translate('Completed Campaigns')); ?></h2>
                            <a href="<?php echo e(route('projects.create')); ?>" class="btn btn-green-lg">
                                <i class="las la-plus"></i>
                                <span><?php echo e(translate('Add New Campaign')); ?></span>
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
                                            <thead>
                                                <tr>
                                                    <th width="10%"><?php echo e(translate('Sr no.')); ?></th>
                                                    <th><?php echo e(translate('Image')); ?></th>
                                                    <th><?php echo e(translate('Campaign title')); ?></th>
                                                    <th><?php echo e(translate('Influencer Name')); ?></th>
                                                    <th><?php echo e(translate('Status')); ?></th>
                                                    <th><?php echo e(translate('Action')); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $completed_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $completed_project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <?php 
                                                    $project = \App\Models\Project::find($completed_project->project_id);
                                                    $image_id=ProjectCategory($project->project_category_id)->photo;
                                                    $freelance_photo = user_profile_pic($completed_project->user_id);
                                                    $brand_name=get_brand_name($project->client_user_id);
                                                    $status=get_all_projects($project,$completed_project->user_id);
                                                    $user_details=get_userdata($completed_project->user_id);
                                                    $name=(isset($user_details->name)) ? $user_details->name : '';
                                                ?>  
                                                    <tr>
                                                        <td> <?php echo e($key + $completed_projects->firstItem()); ?> </td>
                                                        <td><?php if(custom_asset($freelance_photo)): ?>
                                                            <img src="<?php echo e(custom_asset($freelance_photo)); ?>" width="70" height="50" alt="" class="img-fluid radius-10">
                                                            <?php else: ?>
                                                                <img class="img-fluid radius-10" src="<?php echo e(my_asset('assets/frontend/default/img/avatar-place.png')); ?>" width="70" height="50" alt="">
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><a href="<?php echo e(route('project.details', $project->slug)); ?>" class="text-inherit"> <?php echo e($project->name); ?></a></td>
                                                        <td><?php echo e($name); ?></td>
                                                        <td><?php echo $status; ?></td>
                                                        <td> 
                                                            <a href="<?php echo e(url('chat?receiver='.$completed_project->user_id.'&project='.$project->slug)); ?>" class="btn btn-primary btn-sm">Chat</a> 
                                                            <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="hire_modal(<?php echo e($completed_project->user_id); ?>)">Hire</a> 
                                                        </td>

                                                    </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php if($completed_projects->total() > 10): ?>
                                    <div class="aiz-pagination aiz-pagination-center">
                                        <h5>Showing 1 to <?php echo e($items); ?> entries <?php echo e($completed_projects->total()); ?></h5>
                                        <?php echo e($completed_projects->links()); ?>

                                    </div>
                                    <?php endif; ?>
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
    function showRatingModal(id){
        $('input[name=project_id]').val(id);
        $('#rate-modal').modal('show');
    }
</script>
<script type="text/javascript">
        function sort_projects(el){
            $('#sort_projects').submit();
        }
</script>

<script type="text/javascript">
    function hire_modal(id){
        $.post('<?php echo e(route('get_hire_for_project_modal')); ?>', { _token: '<?php echo e(csrf_token()); ?>', id:id,project_slug:"<?php echo e(isset($project->slug) ? $project->slug : ''); ?>" }, function(data){
            $('#hire_for_project').modal('show');
            $('#hire_for_modal_body').html(data);
        })
    }
</script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('modal'); ?>
    <div class="modal fade" id="rate-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="<?php echo e(route('reviews.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header">
                        <h4 class="h6 mb-0"><?php echo e(translate('Rate This Freelancer')); ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="project_id" value="">
                        <div class="form-group">
                            <div class="rating rating-input rating-lg">
        						<label>
        							<input type="radio" name="rating" value="1">
        							<i class="las la-star active"></i>
        						</label>
        						<label>
        							<input type="radio" name="rating" value="2">
        							<i class="las la-star active"></i>
        						</label>
        						<label>
        							<input type="radio" name="rating" value="3" >
        							<i class="las la-star active"></i>
        						</label>
        						<label>
        							<input type="radio" name="rating" value="4">
        							<i class="las la-star"></i>
        						</label>
        						<label>
        							<input type="radio" name="rating" value="5" checked="">
        							<i class="las la-star"></i>
        						</label>
        					</div>
    					</div>
                        <div class="form-group">
    						<label><?php echo e(translate('Comment')); ?></label>
    						<textarea class="form-control" rows="5" name="review" required></textarea>
    					</div>
                    </div>
                    <div class="modal-footer">
        				<button type="button" class="btn btn-light" data-dismiss="modal"><?php echo e(translate('Close')); ?></button>
        				<button type="submit" class="btn btn-primary"><?php echo e(translate('Rate This Freelancer')); ?></button>
        			</div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal my-hire-modal fade" id="hire_for_project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content hire-modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title h3 fw-600" id="exampleModalLabel"><?php echo e(translate('Hire Influencer')); ?></h5>
                    <button type="button" class="close m-0" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" id="hire_for_modal_body">

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.default.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/frontend/default/user/client/projects/my_completed_project.blade.php ENDPATH**/ ?>