

<?php $__env->startSection('content'); ?>
<?php
    $type = isset($_GET['type']) ? $_GET['type'] : '';  
    $search = isset($_GET['search']) ? $_GET['search'] : '';  
    $project = isset($_GET['project']) ? $_GET['project'] : '';  
?>
    <section class="">
        <div class="container">
            <div class="my-campaigns-status">
                <div class="">
                    <div class="aiz-user-panel p-0">
                        <div class="aiz-titlebar pt-5 border-top mb-4">
                            <div class="add-new-campaign d-flex justify-content-between flex-column flex-sm-row align-items-sm-center align-items-start">
                                <h2 class="font-weight-bold my-campus-title"><?php echo e(translate('All')); ?></h2>
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
                                                        <th class="h6"><?php echo e(translate('Campaign title')); ?></th>
                                                        <th class="h6"><?php echo e(translate('Brand name')); ?></th>
                                                        <th class="h6"><?php echo e(translate('Status')); ?></th>
                                                        <th class="h6"><?php echo e(translate('Action')); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $all_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php 
                                                    $brand_name=get_brand_name($project->client_user_id);
                                                    $project = \App\Models\Project::find($project->id);
                                                    $status=get_all_projects($project);
                                                    ?>  
                                                        <tr>
                                                            <td class="h6"><?php echo e($key + $all_projects->firstItem()); ?></td>
                                                            <td class="h6"><a href="<?php echo e(route('project.details', $project->slug)); ?>" class="text-inherit"> <?php echo e($project->name); ?></a></td>
                                                            <td class="h6"><?php echo e($brand_name); ?></td>
                                                            <td class="h6"><?php echo $status; ?></td>
                                                            <td class="h6">
                                                                <?php if(ProjectGetHired($project->slug)==0): ?>
                                                                <a href="<?php echo e(route('projects.edit',encrypt($project->id))); ?>" class="btn btn-primary btn-sm fw-500"><?php echo e(translate('Edit')); ?></a>
                                                                <a onclick="return confirm('Are you sure?')" href="<?php echo e(route('projects.destroy',encrypt($project->id))); ?>" class="btn btn-danger btn-sm fw-500"><?php echo e(translate('Delete')); ?></a>
                                                                <?php else: ?>
                                                                    <a href="javascript:void(0)" class="btn btn-secondary btn-sm fw-500"><?php echo e(translate('Hired')); ?></a>
                                                                <?php endif; ?>
                                                                <!-- <a href="<?php echo e(route('project.bids', $project->slug)); ?>" class="btn btn-primary btn-sm fw-500"><?php echo e(translate('See All Bidders')); ?></a> -->
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                            <div class="aiz-pagination aiz-pagination-right">
                                            <h6 class="m-0 text-grey">Showing 1 to <?php echo e($items); ?> of <?php echo e($all_projects->total()); ?> entries</h6>

                                            <?php echo e($all_projects->appends(['type'=> $type,'search'=>$search,'project'=>$project])->links()); ?>

                                            </div>
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
    function sort_projects(el){
        $('#sort_projects').submit();
    }
</script>
    <script type="text/javascript">
        function milestone_payment_request_modal(project_id , client_id){
            $.post('<?php echo e(route('milestone_payment_request.modal')); ?>',{_token:'<?php echo e(csrf_token()); ?>', project_id:project_id, client_id:client_id}, function(data){
                $('#milestone_payment_request_modal').modal('show');
                $('#milestone_payment_request_modal_body').html(data);
    		});
        }
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
<div class="modal fade" id="milestone_payment_request_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo e(translate('Send Milestone Request')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="milestone_payment_request_modal_body">

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.default.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/frontend/default/user/client/projects/my_all_projects.blade.php ENDPATH**/ ?>