
<div class="chat-box-wrap h-100">

    <div class="chat-list-wrap position-relative c-scrollbar-light scroll-to-btm" id="parentDiv">
        <div class="attached-top position-absolute bg-white chat-header d-flex justify-content-between align-items-center p-3">
            <div class="media">
                <h3 class="mb-0 font-weight-bold"><?php echo e(translate('Message')); ?></h3>
            </div>
        </div>
        <?php if(count($chats) > 0): ?>
            <div class="chat-coversation-load text-center">
                <button class="btn btn-link load-more-btn" data-first="<?php echo e($chats->last()->id); ?>" type="button"><?php echo e(translate('Load More')); ?></button>
            </div>
        <?php endif; ?>
        <div class="main-chat chat-list px-4" id="chat-messages">
            <?php echo $__env->make('frontend.default.partials.chat-messages-part',['chats' => $chats], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    <div class="chat-footer p-3 mt-5 bg-white">
        <form id="send-mesaage">
            <div class="send-body border radius-10">
                <input type="hidden" id="chat_thread_id" name="chat_thread_id" value="<?php echo e($chat_thread->id); ?>">
                <input type="hidden" class="" name="attachment" id="attachment">
                <textarea placeholder="Write your message" class="textarea mb-0 radius-10 h6 border-0" name="message" id="message" autocomplete="off"></textarea>
                <div class="attachment d-flex align-items-center justify-content-between">
                    <div class="icons">
                        <!-- <input type="checkbox" class="" value="1" name="proof" id="proof"> -->
                        <span class="attach-icons"><i class="bi bi-emoji-smile"></i></span>
                        <!-- <span class="attach-icons"><i class="bi bi-image-fill"></i></span> -->
                        <button class="btn btn-circle btn-icon chat-attachment" type="button" data-toggle="aizuploader" data-type="image">
                            <i class="bi bi-paperclip"></i>
                        </button>
                    </div>
                    <div class="send-btn">
                        <button type="submit" class="btn"  type="button">Send</button>
                    </div>
                </div>
            </div>
            <div class="dispute work d-flex justify-content-end">
                <?php    
                    $project_data=get_submitted_disbute($chat_thread->project_id,$chat_thread->receiver_user_id);
                ?>
                <?php if($project_data!=null): ?>
                    <?php if(isClient()): ?>
                        <?php if(empty($project_data->closed) &&  !empty($project_data->submitted) && empty($project_data->disputed)): ?>
                            <a href="javascript:void(0)" onclick="disputed_modal()" class="btn btn-danger btn-sm text-white">Dispute</a>
                        <?php else: ?>
                            <?php if(!empty($project_data->closed)): ?>
                                <!-- <a href="javascript:void(0)" class="btn text-grey py-0 px-3">Campaign Completed</a> -->
                                <p>Campaign Completed</p>
                            <?php elseif(!empty($project_data->disputed)): ?>
                               <!--  <a href="javascript:void(0)" class="btn text-grey py-0 px-3">Already Disputed</a> -->
                                <p>Already Disputed</p>
                            <?php endif; ?>   
                        <?php endif; ?>
                    <?php elseif(isFreelancer()): ?>
                        <?php if(empty($project_data->closed) &&  empty($project_data->submitted)): ?>
                            <a href="javascript:void(0)" onclick="show_modal()" class="btn text-green text-decoration-underline p-0"><?php echo e(translate('Submit Proof')); ?></a>
                        <?php else: ?>
                            <?php if(!empty($project_data->closed)): ?>
                                <!-- <a href="javascript:void(0)" class="btn text-grey py-0 px-3">Campaign Completed</a> -->
                                <p>Campaign Completed</p>
                            <?php elseif(!empty($project_data->disputed)): ?>
                               <!-- <a href="javascript:void(0)" class="btn text-grey py-0 px-3">Already Disputed</a> -->
                               <p>Already Disputed</p>
                            <?php elseif(!empty($project_data->submitted) &&  empty($project_data->closed)): ?>
                                <a href="javascript:void(0)" onclick="disputed_modal()" class="btn btn-danger btn-sm text-white">Dispute</a>
                            <?php else: ?>  
                                <!-- <a href="javascript:void(0)" class="btn text-grey py-0 px-3">Already campaign complete</a> -->
                                <p>Already campaign complete</p>
                            <?php endif; ?>
                        <?php endif; ?> 
                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </form>
    </div> 
    <div class="chat-info-wrap">
        <div class="overlay dark c-pointer" data-toggle="class-toggle" data-target=".chat-info-wrap" data-same=".chat-info"></div>
        <?php if(isClient()): ?>
            <div class="chat-info c-scrollbar-light p-4 z-1">
                <div class="px-4 text-center mb-3">
                    <span class="avatar avatar-md mb-3">
                        <?php if($chat_thread->receiver->photo != null): ?>
                            <img src="<?php echo e(custom_asset($chat_thread->receiver->photo)); ?>">
                        <?php else: ?>
                            <img src="<?php echo e(my_asset('assets/frontend/default/img/avatar-place.png')); ?>">
                        <?php endif; ?>
                        <span class="badge badge-dot badge-success badge-circle badge-status"></span>
                    </span>
                    <div class="text-secondary fs-10 mb-1">
                        <i class="las la-star text-warning"></i>
                        <span class="fw-600">
                            <?php echo e(formatRating(getAverageRating($chat_thread->receiver->id))); ?>

                        </span>
                        <span>
                            (<?php echo e(getNumberOfReview($chat_thread->receiver->id)); ?> <?php echo e(translate('Reviews')); ?>)
                        </span>
                    </div>
                    <h4 class="h5 mb-2 fw-600"><?php echo e($chat_thread->receiver->name); ?></h4>
                    <div class="text-center">
                        <?php $__currentLoopData = $chat_thread->receiver->badges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user_badge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($user_badge->badge != null): ?>
                                <span class="avatar avatar-square avatar-xxs" title="<?php echo e($user_badge->badge->name); ?>"><img src="<?php echo e(my_asset($user_badge->badge->icon)); ?>"></span>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="separator my-4"><span class="bg-white px-3 text-black-50"><?php echo e(translate('Running Projects With You')); ?></span></div>
                <div class="">
                    <ul class="list-group">
                        <?php
                            $running_projects = DB::table('projects')
                                                ->where('projects.client_user_id', auth()->user()->id)
                                                ->where('projects.biddable', 0)
                                                ->where('projects.closed', 0)
                                                ->where('projects.cancel_status', 0)
                                                ->join('project_users', 'projects.id', '=', 'project_users.project_id')
                                                ->where('project_users.user_id', $chat_thread->receiver_user_id)
                                                ->select('project_users.id')
                                                ->get();
                        ?>
                        <?php $__currentLoopData = $running_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $running_project_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $project_user = \App\Models\ProjectUser::find($running_project_id->id);
                            ?>
                            <?php if($project_user->project != null): ?>
                                <li class="list-group-item">
                                    <a href="<?php echo e(route('project.details', $project_user->project->slug)); ?>" target="_blank" class="text-body"><?php echo e($project_user->project->name); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <div class="separator my-4"><span class="bg-white px-3 text-black-50"><?php echo e(translate('Completed Campaigns With You')); ?></span></div>
                <div class="">
                    <ul class="list-group">
                        <?php
                            $completed_projects = DB::table('projects')
                                                ->where('projects.client_user_id', auth()->user()->id)
                                                ->where('projects.biddable', 0)
                                                ->where('projects.closed', 1)
                                                ->where('projects.cancel_status', 0)
                                                ->join('project_users', 'projects.id', '=', 'project_users.project_id')
                                                ->where('project_users.user_id', $chat_thread->receiver_user_id)
                                                ->select('project_users.id')
                                                ->get();
                        ?>
                        <?php $__currentLoopData = $completed_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $completed_project_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $project_user = \App\Models\ProjectUser::find($completed_project_id->id);
                            ?>
                            <?php if($project_user->project != null): ?>
                                <li class="list-group-item">
                                    <a href="<?php echo e(route('project.details', $project_user->project->slug)); ?>" target="_blank" class="text-body"><?php echo e($project_user->project->name); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        <?php else: ?>
            <div class="chat-info c-scrollbar-light p-4 z-1">
                <div class="px-4 text-center mb-3">
                    <span class="avatar avatar-md mb-3">
                        <?php if($chat_thread->sender->photo != null): ?>
                            <img src="<?php echo e(custom_asset($chat_thread->sender->photo)); ?>">
                        <?php else: ?>
                            <img src="<?php echo e(my_asset('assets/frontend/default/img/avatar-place.png')); ?>">
                        <?php endif; ?>
                        <span class="badge badge-dot badge-success badge-circle badge-status"></span>
                    </span>
                    <div class="text-secondary fs-10 mb-1">
                        <i class="las la-star text-warning"></i>
                        <span class="fw-600">
                            <?php echo e(formatRating(getAverageRating($chat_thread->sender->id))); ?>

                        </span>
                        <span>
                            (<?php echo e(getNumberOfReview($chat_thread->receiver->id)); ?> <?php echo e(translate('Reviews')); ?>)
                        </span>
                    </div>
                    <h4 class="h5 mb-2 fw-600"><?php echo e($chat_thread->sender->name); ?></h4>
                    <div class="text-center">
                        <?php $__currentLoopData = $chat_thread->sender->badges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user_badge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($user_badge->badge != null): ?>
                                <span class="avatar avatar-square avatar-xxs" title="<?php echo e($user_badge->badge->name); ?>"><img src="<?php echo e(my_asset($user_badge->badge->icon)); ?>"></span>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="separator my-4"><span class="bg-white px-3 text-black-50"><?php echo e(translate('Running Projects With You')); ?></span></div>
                <div class="">
                    <ul class="list-group">
                        <?php
                            $running_projects = DB::table('projects')
                                                ->where('projects.client_user_id', $chat_thread->sender_user_id)
                                                ->where('projects.biddable', 0)
                                                ->where('projects.closed', 0)
                                                ->where('projects.cancel_status', 0)
                                                ->join('project_users', 'projects.id', '=', 'project_users.project_id')
                                                ->where('project_users.user_id', auth()->user()->id)
                                                ->select('project_users.id')
                                                ->get();
                        ?>
                        <?php $__currentLoopData = $running_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $running_project_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $project_user = \App\Models\ProjectUser::find($running_project_id->id);
                            ?>
                            <?php if($project_user->project != null): ?>
                                <li class="list-group-item">
                                    <a href="<?php echo e(route('project.details', $project_user->project->slug)); ?>" target="_blank" class="text-body"><?php echo e($project_user->project->name); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <div class="separator my-4"><span class="bg-white px-3 text-black-50"><?php echo e(translate('Completed Campaigns With You')); ?></span></div>
                <div class="">
                    <ul class="list-group">
                        <?php
                            $completed_projects = DB::table('projects')
                                                ->where('projects.client_user_id', $chat_thread->sender_user_id)
                                                ->where('projects.biddable', 0)
                                                ->where('projects.closed', 1)
                                                ->where('projects.cancel_status', 0)
                                                ->join('project_users', 'projects.id', '=', 'project_users.project_id')
                                                ->where('project_users.user_id', auth()->user()->id)
                                                ->select('project_users.id')
                                                ->get();
                        ?>
                        <?php $__currentLoopData = $completed_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $completed_project_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $project_user = \App\Models\ProjectUser::find($completed_project_id->id);
                            ?>
                            <?php if($project_user->project != null): ?>
                                <li class="list-group-item">
                                    <a href="<?php echo e(route('project.details', $project_user->project->slug)); ?>" target="_blank" class="text-body"><?php echo e($project_user->project->name); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="modal fade" id="project_submit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(translate('Submit Proof')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <div class="modal-body" id="hiring_modal_body"> 
                    
                    <label class="form-label text-sm">               
                        In order to get paid, you have to provide a link to the social media post you created with your client's content.
                    </label>
                    <form class="project-form" action="" method="post">
                    <?php echo csrf_field(); ?> 
                    <div class="message text-danger"></div>
                    <div class="form-group row">
                        <div class="col-lg-11">
                        <input type="url" name="social_link" class="form-control form-control-sm radius-10 social_link"  id="social_link" placeholder="https://example.com" pattern="https://">
                        </div>
                        <div class="col-lg-1 p-0 text-center">
                            <i  data-toggle="tooltip" data-placement="top" title="You can usually find a link to the post by clicking on the picture/video details of the post and copying the link" class="bi bi-info-circle"></i>
                        </div>
                        
                    </div>
                        <input type="hidden" name="project_id" id="project_id" value="<?php echo e($chat_thread->project_id); ?>">
                        <button type="button"  class="btn btn-green transition-3d-hover mr-1 final_submit" ><?php echo e(translate('Submit')); ?></button>
                        <span style="display:none" id="loading"><img src="<?php echo e(my_asset('/uploads/images/loading.gif')); ?>" height="100" width="100" /></span>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="disputed_for_project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo e(translate('Confirm Dispute')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body" id="disputed-modal-content">
                <h4>Are you sure you want to file this dispute?</h4>
                <form class="form-horizontal" action="<?php echo e(route('get_disputed_project_modal')); ?>" method="POST" enctype="multipart/form-data" id="disputed_form">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="project_id" value="<?php echo e($chat_thread->project_id); ?>">
                    <input type="hidden" name="receiver_user_id" value="<?php echo e($chat_thread->receiver_user_id); ?>">
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-sm btn-primary transition-3d-hover mr-1"><?php echo e(translate('Dispute Now')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
    });

    $(document).on('click','.final_submit',function(e){
        e.preventDefault();
        var project_id=$('#project_id').val();
        var url=$('#social_link').val();
        var message=$('#message').val();
        $('.message').text(' ');
        $('.final_submit').prop( "disabled", true );
        $("#loading").show();
        $.ajax({
            url:"<?php echo e(route('projects.submit')); ?>",  
            type: "POST",
            data: { _token: '<?php echo e(csrf_token()); ?>',message:message,project_id:project_id,url:url},
            dataType: 'JSON',
            success: function( response ) {
                if(response.status==false){
                    $('.final_submit').prop( "disabled",false);
                    $("#loading").hide();
                    $('.message').text(response.msg);
                }else{
                    window.location.reload();
                }
            }
        });
    });
</script><?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/frontend/default/partials/chat-messages.blade.php ENDPATH**/ ?>