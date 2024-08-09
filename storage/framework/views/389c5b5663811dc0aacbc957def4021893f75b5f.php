

<?php $__env->startSection('content'); ?>

<section class="">
    <div class="container">
        <div class="my-campaigns-status">
            <div class="aiz-user-panel p-0">
                <div class="aiz-titlebar mt-2 mb-4">
                    <h2 class="font-weight-bold my-campus-title pt-5 border-top"><?php echo e(translate('Applied Campaigns')); ?></h2>
                    <?php echo $__env->make('frontend.default.user.freelancer.inc.dashboard_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table aiz-table mb-0">
                                        <thead>
                                            <tr>
                                                <th width="10%"><?php echo e(translate('Sr no.')); ?></th>
                                                <th><?php echo e(translate('Image')); ?></th>
                                                <th><?php echo e(translate('Campaign title')); ?></th>
                                                <th><?php echo e(translate('Brand name')); ?></th>
                                                <th><?php echo e(translate('Credits')); ?></th>
                                                <th><?php echo e(translate('Status')); ?></th>
                                                <th><?php echo e(translate('Action')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $bidded_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bidded_project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($bidded_project->id != null): ?>
                                                <?php 
                                                    $client_photo = user_profile_pic($bidded_project->client_user_id);
                                                    $brand_name=get_brand_name($bidded_project->client_user_id);
                                                    $status=get_all_projects($bidded_project);
                                                    $existing_messge=CheckFirstMessageClient($bidded_project->id);
                                                ?>  
                                                <tr>
                                                    <td><?php echo e($key + $bidded_projects->firstItem()); ?></td>
                                                    <td>
                                                        <?php if($client_photo != null): ?>
                                                        <img src="<?php echo e(custom_asset($client_photo)); ?>" width="70" height="50" alt="" class="img-fluid radius-10">
                                                        <?php else: ?>
                                                            <img class="img-fluid radius-10" src="<?php echo e(my_asset('assets/frontend/default/img/avatar-place.png')); ?>" width="70" height="50" alt="">
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><a href="<?php echo e(route('project.details', $bidded_project->slug)); ?>" class="text-inherit"> <?php echo e($bidded_project->name); ?> </a></td>
                                                    <td><?php echo e($brand_name); ?></td>
                                                    <td><?php echo e($bidded_project->amount); ?> credits</td>
                                                    <td>
                                                        <?php echo $status; ?>

                                                    </td>
                                                    <td>
                                                        <?php if($bidded_project->status==2): ?>
                                                         <a  href="javascript:void(0)"  class="btn btn-danger btn-sm"><?php echo e(translate('Bid Rejected')); ?></a> 
                                                          <a href="javascript:void(0)" class="btn btn-primary  btn-sm" onclick="bid_modal('<?php echo e($bidded_project->project_id); ?>')"><?php echo e(translate('New Bid')); ?></a>
                                                        <?php else: ?>
                                                            <?php if($existing_messge==true): ?>
                                                            <a  href="<?php echo e(url('chat?project='.$bidded_project->slug)); ?>"  class="btn btn-primary btn-sm"><?php echo e(translate('Chat With Client')); ?></a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="aiz-pagination aiz-pagination-center">
                                    <h5>Showing 1 to <?php echo e($items); ?> entries <?php echo e($bidded_projects->total()); ?></h5>
                                    <?php echo e($bidded_projects->links()); ?>

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

    function bid_modal(id){
        $.post('<?php echo e(route('get_bid_for_project_modal')); ?>', { _token: '<?php echo e(csrf_token()); ?>', id:id }, function(data){
            $('#bid_for_project').modal('show');
            $('#bid_for_modal_body').html(data);
        })
    }
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('modal'); ?>
<div class="modal fade" id="bid_for_project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo e(translate('Place Your Bid')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body" id="bid_for_modal_body">

            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('frontend.default.partials.bookmark_remove_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.default.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/frontend/default/user/freelancer/projects/bidded.blade.php ENDPATH**/ ?>