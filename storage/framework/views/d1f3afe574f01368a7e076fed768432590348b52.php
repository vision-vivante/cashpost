

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
                    <div class="aiz-titlebar mt-2 mb-4">
                       <h2 class="font-weight-bold my-campus-title pt-5 border-top"><?php echo e(translate('Running Projects')); ?></h2>
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
                                                    <th><?php echo e(translate('Client name')); ?></th>
                                                    <th><?php echo e(translate('Brand name')); ?></th>
                                                    <th><?php echo e(translate('Proof URL')); ?></th>
                                                    <th><?php echo e(translate('Status')); ?></th>
                                                    <th><?php echo e(translate('Action')); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $running_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $running_project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <?php
                                                $project = \App\Models\Project::withTrashed()->find($running_project->id);
                                                $client_photo = user_profile_pic($project->client_user_id);
                                                $brand_name=get_brand_name($project->client_user_id);
                                                $status=get_all_projects($project);
                                                $user_details=get_userdata($running_project->client_user_id);
                                                $name=(isset($user_details->name)) ? $user_details->name : '';
                                            ?>
                                            <tr>
                                                <td><?php echo e($key + $running_projects->firstItem()); ?></td>
                                                <td>
                                                    <?php if($client_photo != null): ?>
                                                    <img src="<?php echo e(custom_asset($client_photo)); ?>" width="70" height="50" alt="" class="img-fluid radius-10">
                                                    <?php else: ?>
                                                        <img class="img-fluid radius-10" src="<?php echo e(my_asset('assets/frontend/default/img/avatar-place.png')); ?>" width="70" height="50" alt="">
                                                    <?php endif; ?>
                                                </td>
                                                <td><a href="<?php echo e(route('project.details', $project->slug)); ?>" class="text-inherit"> <?php echo e($project->name); ?></a></td>
                                                <td><?php echo e($name); ?></td>
                                                <td><?php echo e($brand_name); ?></td>
                                                <td id-check="<?php echo e($running_project->id); ?>">
                                                    <?php if($running_project->submitted): ?>
                                                        <a href="<?php echo e($running_project->social_url); ?>" target="_blank"><?php echo e(translate('Proof')); ?></a>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($running_project->submitted): ?>
                                                        <?php if(!empty($running_project->disputed)): ?>
                                                            <span class="progress-text">Disputed</span>
                                                        <?php else: ?> 
                                                            <span class="progress-text">Submitted</span>
                                                        <?php endif; ?>
                                                    <?php else: ?>    
                                                        <?php echo $status; ?>

                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($project->deleted_at == null): ?>
                                                        <a href="<?php echo e(url('chat?receiver='.Auth::user()->id.'&project='.$project->slug)); ?>" class="btn btn-primary btn-sm"><?php echo e(translate('Chat With Client')); ?></a>
                                                        <?php if(empty($running_project->submitted)): ?>
                                                            <?php if(!empty(Auth::user()->profile->stripe_account)): ?>
                                                                <a href="javascript:void(0)" onclick="show_modal(<?php echo e($project->id); ?>)" class="btn btn-success btn-sm"><?php echo e(translate('Submit Proof')); ?></a>
                                                                <?php else: ?>
                                                                <a href="<?php echo e(route('stripe.bank_account')); ?>" class="btn btn-success btn-sm"><?php echo e(translate('Submit Proof')); ?></a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    <?php else: ?> 
                                                        <p>Campaign banned by Admin</p>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <div class="aiz-pagination aiz-pagination-center">
                                    <?php echo e($running_projects->appends(['type'=> $type,'search'=>$search,'project'=>$project])->links()); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
    <div class="modal fade" id="project_submit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(translate('Submit Proof')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" id="submit_for_modal_body"> 

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        function show_modal(id){
            $.post('<?php echo e(route('submit_proof_for_project_modal')); ?>', { _token: '<?php echo e(csrf_token()); ?>', project_id:id }, function(data){
                $('#project_submit').modal('show');
                $('#submit_for_modal_body').html(data);
            })
        }        
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.default.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/frontend/default/user/freelancer/projects/my_running_project.blade.php ENDPATH**/ ?>