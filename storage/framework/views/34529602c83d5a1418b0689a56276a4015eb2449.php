

<?php $__env->startSection('content'); ?>
<?php
    $type = isset($_GET['type']) ? $_GET['type'] : '';  
    $search = isset($_GET['search']) ? $_GET['search'] : '';  
    $project = isset($_GET['project']) ? $_GET['project'] : '';  
?>
    <section class="">
        <div class="container">
            <div class="my-campaigns-status">
                <div class="aiz-user-panel p-0">
                    <div class="aiz-titlebar mt-2 mb-4">
                        <h2 class="font-weight-bold my-campus-title pt-5 border-top"><?php echo e(translate('Completed Campaigns')); ?></h2>
                        <?php echo $__env->make('frontend.default.user.freelancer.inc.dashboard_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                                                    <!-- <th><?php echo e(translate('Client name')); ?></th> -->
                                                    <th><?php echo e(translate('Brand name')); ?></th>
                                                    <th><?php echo e(translate('Status')); ?></th>
                                                    <th><?php echo e(translate('Action')); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $completed_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $completed_project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <?php 
                                                    $project = \App\Models\Project::withTrashed()->find($completed_project->project_id);
                                                    $image_id=ProjectCategory($project->project_category_id)->photo;
                                                    $client_photo = user_profile_pic($project->client_user_id);
                                                    $brand_name=get_brand_name($project->client_user_id);
                                                    $status=get_all_projects($project);
                                                    $user_details=get_userdata($completed_project->client_user_id);
                                                    $name=(isset($user_details->name)) ? $user_details->name : '';
                                                ?>  
                                                <tr>
                                                    <td><?php echo e($key + $completed_projects->firstItem()); ?></td>
                                                    <td><?php if($client_photo != null): ?>
                                                        <img src="<?php echo e(custom_asset($client_photo)); ?>" width="70" height="50" alt="" class="img-fluid radius-10">
                                                        <?php else: ?>
                                                            <img class="img-fluid radius-10" src="<?php echo e(my_asset('assets/frontend/default/img/avatar-place.png')); ?>" width="70" height="50" alt="">
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><a href="<?php echo e(route('project.details', $project->slug)); ?>" class="text-inherit"> <?php echo e($project->name); ?></a></td>
                                                    <td><?php echo e($brand_name); ?></td>
                                                    <td><?php echo $status; ?></td>
                                                    <td><a href="<?php echo e(url('chat?receiver='.Auth::user()->id.'&project='.$project->slug)); ?>" class="btn btn-primary btn-sm"><?php echo e(translate('Chat With Client')); ?></a></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="aiz-pagination aiz-pagination-center">
                                        <h5>Showing 1 to <?php echo e($items); ?> entries <?php echo e($completed_projects->total()); ?></h5>
                                        <?php echo e($completed_projects->appends(['type'=> $type,'search'=>$search,'project'=>$project])->links()); ?>

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
    function sort_projects(el){
        $('#sort_projects').submit();
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
                            <label><?php echo e(translate('Rating')); ?></label>
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
                        <button type="submit" class="btn btn-primary"><?php echo e(translate('Rate This Client')); ?></button>
                    </div>
                </form
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.default.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/frontend/default/user/freelancer/projects/my_completed_project.blade.php ENDPATH**/ ?>