    
<?php
    $project_name=ProjectCategory($project->project_category_id)->name;
?>
    <div class="col-md-4">
        <div class="offer-content">
            <h3 class="heading fw-600">Offer Details</h3>
            <ul class="detail-list p-0">
                <li class="point-1">
                    <div class="points-detail pb-4">
                        <h6 class="fw-600">Brand Name</h6>
                        <h6 class="title text-grey"><span><i class="bi bi-box-seam"></i></span> <?php echo get_brand_name($project->client_user_id); ?> </h6>
                    </div>
                </li>
                <li class="point-1">
                    <div class="points-detail pb-4">
                        <h6 class="fw-600">Platform</h6>
                        <h6 class="title text-grey"><span><i class="bi bi-box-seam"></i></span> <?php echo e($project_name); ?></h6>
                    </div>
                </li>
                <?php if($project->content_type==1): ?>
                    <li class="point-3">
                        <div class="points-detail pb-3">
                            <h6 class="fw-600">Content</h6>
                            <h6 class="title text-grey"><span><i class="bi bi-box"></i></span><?php echo e($project->extra_url); ?></h6>
                        </div>
                    </li>
                <?php elseif(is_numeric($project->extra_url) && $project->content_type==2): ?>
                    <?php  
                        $content_src="Image";
                        $url=custom_asset($project->extra_url);
                        $extension = pathinfo($url, PATHINFO_EXTENSION);
                        $video_ext=array("mp4","mov","wmv","avi","flv","mkv","webm","3gp","MOV");
                        if(in_array($extension,$video_ext)){
                            $content_src="Video";
                        }
                    ?>
                     <li class="point-3">
                        <div class="points-detail pb-3">
                            <h6 class="fw-600">Content <a href="<?php echo e($url); ?>" download><i class="bi bi-download" style="margin-left:15px; color:black"></i></a></h6>
                            <h6 class="title text-grey video-btn" data-bs-toggle="modal" data-type="<?php echo e($content_src); ?>" data-src="<?php echo e($url); ?>" data-bs-target="#myModal" style="cursor:pointer;"><span><i class="bi bi-box"></i></span> <?php echo e($content_src); ?> </h6>
                        </div>
                     
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="mb-5">
            <?php if(Auth::check() && isClient()): ?>
                <a href="<?php echo e(route('private_projects')); ?>" class="btn btn-green-lg btn-block"><?php echo e(translate('Invites')); ?> (<?php echo e(getInvitationforProjectCount($project->id)); ?>)</a>

                <a href="<?php echo e(route('projects.my_running_project', 'project='.$project->slug)); ?>" class="btn btn-green-lg btn-block"><?php echo e(translate('Hired')); ?> (<?php echo e(ProjectGetHired($project->slug)); ?>) </a>

               <!--  <a href="<?php echo e(route('hiring.reject', $project->id)); ?>" class="btn btn-green-lg bg-danger btn-block"><?php echo e(translate('Reject')); ?> -->
                <a href="<?php echo e(route('project.bids', 'project='.$project->slug)); ?>" class="btn btn-green-lg bg-danger btn-block"><?php echo e(translate('Bids')); ?>  (<?php echo e(ProjectGetBids($project->slug)); ?>) </a>
                </a>
            <?php elseif(Auth::check() && isFreelancer()): ?>
                <?php if(getCompletedProjects($project)): ?>
                   <div class="alert alert-info m-2" role="alert">
                        <?php echo e(translate('You have already comnplete this Project.')); ?>

                    </div>
                <?php else: ?>
                    <?php if(ProjectGetHired($project->slug)==0): ?>
                        <?php 
                            $invited_project = \App\Models\HireInvitation::where('project_id',$project->id)->where('sent_to_user_id',Auth::user()->id)->where('status','pending')->first();
                        ?>
                        <?php if($invited_project != null): ?>
                            <a href="javascript:void(0)" class="btn btn-block btn-green-lg mt-4" onclick="bid_modal(<?php echo e($project->id); ?>)"><?php echo e(translate('Invite / Accept')); ?></a>
                        <?php else: ?>
                            <?php
                                $allow_for_bid = \App\Models\ProjectBid::where('project_id', $project->id)->where('bid_by_user_id', Auth::user()->id)->where('status','!=','2')->first();
                            ?>
                            <?php if($allow_for_bid == null): ?>
                                <a href="javascript:void(0)" class="btn btn-block btn-green-lg mt-4" onclick="bid_modal(<?php echo e($project->id); ?>)"><?php echo e(translate('Bid')); ?></a>
                            <?php else: ?>
                                <div class="alert alert-info m-2" role="alert">
                                    <?php echo e(translate('You have already submitted a bid for this campaign.')); ?>

                                </div>
                            <?php endif; ?>
                        <?php endif; ?> 
                    <?php else: ?>
                        <a href="javascript:void(0)" class="btn btn-block btn-green-lg mt-4"><?php echo e(translate('Hired')); ?></a>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <?php $__env->startSection('script'); ?>
        <script type="text/javascript">
            function bid_modal(id){
                $.post('<?php echo e(route('get_bid_for_project_modal')); ?>', { _token: '<?php echo e(csrf_token()); ?>', id:id }, function(data){
                    $('#bid_for_project').modal('show');
                    $('#bid_for_modal_body').html(data);
                })
            }
            $(document).ready(function() {
                var $videoSrc;  
                $('.video-btn').click(function() {
                    $videoSrc = $(this).data( "src");
                    $('#myModal').modal('show');
                    var type = $(this).data( "type");
                    if(type=='Video'){
                        //$("#video").attr('src',$videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0" ); 
                        var src=$videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0";
                        $("#content_for_modal_body").html('<iframe class="embed-responsive-item" src="'+src+'" id="video"  allowscriptaccess="always" allow="autoplay" style="width:100%; height:300px;" ></iframe>'); 
                    }else{
                        $('#content_for_modal_body').html('<img class="document" src="'+$videoSrc+'" style="width:100%; height:300px;"/>')
                    }
                });
            });
        </script>
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('modal'); ?>
    <div class="modal fade" id="bid_for_project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(translate('Bid For Project')); ?></h5>
                    <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" id="bid_for_modal_body">

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content apply-model">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" id="content_for_modal_body">
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('frontend.default.partials.bookmark_remove_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php $__env->stopSection(); ?>
<?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/frontend/default/inc/chat_sidebar.blade.php ENDPATH**/ ?>