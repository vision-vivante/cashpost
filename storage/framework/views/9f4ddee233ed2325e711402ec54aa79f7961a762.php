

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
                <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="aiz-titlebar pt-5 border-top mb-4">
                        <div class="add-new-campaign d-flex justify-content-between flex-column flex-sm-row align-items-sm-center align-items-start">
                            <h2 class="font-weight-bold my-campus-title"><?php echo e(translate('Campaign Proposals')); ?></h2>
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
                                            <thead>
                                                <tr>
                                                    <th width="10%"><?php echo e(translate('Sr no.')); ?></th>
                                                    <th><?php echo e(translate('Image')); ?></th> 
                                                    <th><?php echo e(translate('Invited user')); ?></th>
                                                    <th><?php echo e(translate('Campaign title')); ?></th>
                                                    <th><?php echo e(translate('Brand name')); ?></th>
                                                    <th><?php echo e(translate('Status')); ?></th>
                                                    <th><?php echo e(translate('Action')); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $private_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $private_project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <?php 
                                                    $client_photo = user_profile_pic($private_project->sent_to_user_id);
                                                    $brand_name=get_brand_name($private_project->client_user_id);
                                                    $inviteuser=getInviteUser($private_project->sent_to_user_id);
                                                ?>
                                                <?php if($private_project != null): ?>  
                                                    <tr>
                                                        <td>
                                                        <?php echo e($key + $private_projects->firstItem()); ?> 
                                                        </td>
                                                        <td><?php if(custom_asset($client_photo )): ?>
                                                            <img src="<?php echo e(custom_asset($client_photo)); ?>" width="70" height="50" alt="" class="img-fluid radius-10">
                                                            <?php else: ?>
                                                                <img class="img-fluid radius-10" src="<?php echo e(my_asset('assets/frontend/default/img/avatar-place.png')); ?>" width="70" height="50" alt="">
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?php echo e($inviteuser); ?></td>
                                                        <?php 
                                                        $project_id=$private_project->slug; 
                                                        $sent_to_user_id= $private_project->sent_to_user_id; 
                                                        ?>
                                                        <td><a href="<?php echo e(route('project.details', $private_project->slug)); ?>" class="text-inherit"><?php echo e($private_project->name); ?></a></td>
                                                        <td><?php echo e($brand_name); ?></td>
                                                        <td>
                                                            <?php echo $status; ?>

                                                        </td> 
                                                        <td>
                                                            <?php if(ProjectGetHired($private_project->slug)==0): ?>
                                                            <a href="<?php echo e(route('projects.edit',encrypt($private_project->id))); ?>" class="btn btn-secondary btn-sm fw-500"><?php echo e(translate('Edit')); ?></a>
                                                            <?php else: ?>
                                                                <a href="javascript:void(0)" class="btn btn-secondary btn-sm fw-500"><?php echo e(translate('Hired')); ?></a>
                                                                
                                                                <a href="<?php echo e(url('chat?receiver='.$sent_to_user_id.'&project='.$project_id)); ?>" class="btn btn-primary btn-sm">Chat</a>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="aiz-pagination">
                        <?php echo e($private_projects->appends(['type'=> $type,'search'=>$search,'project'=>$project])->links()); ?>

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
       /* function hiring_modal(project_name,project_price, project_id, user_id){
            $('input[name=project_name]').val(project_name);
            $('input[name=amount]').val(project_price);
            $('input[name=project_id]').val(project_id);
            $('input[name=user_id]').val(user_id);
            $('#hiring_modal').modal('show');
        }*/
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
                <form class="form-horizontal" action="<?php echo e(route('hiring_confirmation_store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <input type="hidden" name="user_id" value="" required>
                    <input type="hidden" name="project_id" value="" required>

                    <div class="form-group">
                        <label class="form-label">
                            <?php echo e(translate('Project')); ?>

                            <span class="text-danger">*</span>
                        </label>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-sm" name="project_name" value="" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            <?php echo e(translate('Amount')); ?>

                            <span class="text-danger">*</span>
                        </label>
                        <div class="form-group">
                            <input type="number" class="form-control form-control-sm" name="amount" value="" min="1" step="0.01" required>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-sm btn-primary transition-3d-hover mr-1"><?php echo e(translate('Confirm')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.default.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/frontend/default/user/client/projects/private.blade.php ENDPATH**/ ?>