<?php $__currentLoopData = $chats->reverse(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($chat->sender_user_id == Auth::user()->id): ?>
        <?php if($chat->message != null): ?>

            <div class="chat-coversation right d-flex align-items-end flex-column influencer-side chat-text text-grey <?php echo e(($chat->as_proof)?'proof':''); ?>">
                <div class="d-flex">
                    <div class="influencer-chat radius-10"><?php echo e($chat->message); ?></div>
                    <span class="avatar avatar-xs flex-shrink-0 ">
                        <img <?php if($chat->sender->photo != null): ?> src="<?php echo e(custom_asset(($chat->sender->photo))); ?>" <?php endif; ?>>
                    </span>
                </div>
                <div class="time"><?php echo e(Carbon\Carbon::parse($chat->created_at)->diffForHumans()); ?></div>
            </div>
        <?php endif; ?>
        <?php if($chat->attachment != null): ?>
            <div class="chat-coversation right <?php echo e(($chat->as_proof)?'proof':''); ?>">
                <div class="media">
                    <div class="media-body">
                        <div class="file-preview box sm">
                            <?php $__currentLoopData = json_decode($chat->attachment); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attachment_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $attachment = \App\Upload::find($attachment_id);
                                ?>
                                <?php if($attachment != null): ?>
                                    <?php if($attachment->type == 'image'): ?>
                                        <div class="mb-2 file-preview-item" title="<?php echo e($attachment->file_name); ?>">
                                            <a href="<?php echo e(route('download_attachment', $attachment->id)); ?>" target="_blank" class="d-block">
                                                <div class="thumb">
                                                    <img src="<?php echo e(my_asset($attachment->file_name)); ?>" class="img-fit">
                                                </div>
                                                <div class="body">
                                                    <h6 class="d-flex">
                                                        <span class="text-truncate title"><?php echo e($attachment->file_original_name); ?></span>
                                                        <span class="ext">.<?php echo e($attachment->extension); ?></span>
                                                    </h6>
                                                    <p><?php echo e(formatBytes($attachment->file_size)); ?></p>
                                                </div>
                                            </a>
                                        </div>
                                    <?php else: ?>
                                        <div class="mb-2 file-preview-item" title="<?php echo e($attachment->file_name); ?>">
                                            <a href="<?php echo e(route('download_attachment', $attachment->id)); ?>" target="_blank" class="d-block">
                                                <div class="thumb">
                                                    <i class="la la-file-text"></i>
                                                </div>
                                                <div class="body">
                                                    <h6 class="d-flex">
                                                        <span class="text-truncate title"><?php echo e($attachment->file_original_name); ?></span>
                                                        <span class="ext">.<?php echo e($attachment->extension); ?></span>
                                                    </h6>
                                                    <p><?php echo e(formatBytes($attachment->file_size)); ?></p>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <div class="alert alert-secondary" role="alert">
                                        <?php echo e(translate('No attachment')); ?>

                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <span class="time"><?php echo e(Carbon\Carbon::parse($chat->created_at)->diffForHumans()); ?></span>
                    </div>
                    <span class="avatar avatar-xs flex-shrink-0">
                        <img <?php if($chat->sender->photo != null): ?> src="<?php echo e(custom_asset(($chat->sender->photo))); ?>" <?php endif; ?>>
                    </span>
                </div>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <?php if($chat->message != null): ?>
            <div class="chat-coversation d-flex align-items-start flex-column chat-text client-side text-grey">
                <div class="d-flex">
                    <span class="avatar avatar-xs flex-shrink-0">
                        <img <?php if($chat->sender->photo != null): ?> src="<?php echo e(custom_asset(($chat->sender->photo))); ?>" <?php endif; ?>>
                    </span>
                    <div class="radius-10 client-chat">

                        <?php echo e($chat->message); ?>

                    </div>
                </div>
                <div class="time"><?php echo e(Carbon\Carbon::parse($chat->created_at)->diffForHumans()); ?></div>
            </div>
        <?php endif; ?>
        <?php if($chat->attachment != null): ?>
            <div class="chat-coversation">
                <div class="media">
                    <span class="avatar avatar-xs flex-shrink-0">
                        <img <?php if($chat->sender->photo != null): ?> src="<?php echo e(custom_asset(($chat->sender->photo))); ?>" <?php endif; ?>>
                    </span>
                    <div class="media-body">
                        <div class="file-preview box sm">
                            <?php $__currentLoopData = json_decode($chat->attachment); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attachment_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $attachment = \App\Upload::find($attachment_id);
                                ?>
                                <?php if($attachment != null): ?>
                                    <?php if($attachment->type == 'image'): ?>
                                        <div class="mb-2 file-preview-item" title="<?php echo e($attachment->file_name); ?>">
                                            <a href="<?php echo e(route('download_attachment', $attachment->id)); ?>" target="_blank" class="d-block">
                                                <div class="thumb">
                                                    <img src="<?php echo e(my_asset($attachment->file_name)); ?>" class="img-fit">
                                                </div>
                                                <div class="body">
                                                    <h6 class="d-flex">
                                                        <span class="text-truncate title"><?php echo e($attachment->file_original_name); ?></span>
                                                        <span class="ext">.<?php echo e($attachment->extension); ?></span>
                                                    </h6>
                                                    <p><?php echo e(formatBytes($attachment->file_size)); ?></p>
                                                </div>
                                            </a>
                                        </div>
                                    <?php else: ?>
                                        <div class="mb-2 file-preview-item" title="<?php echo e($attachment->file_name); ?>">
                                            <a href="<?php echo e(route('download_attachment', $attachment->id)); ?>" target="_blank" class="d-block">
                                                <div class="thumb">
                                                    <i class="la la-file-text"></i>
                                                </div>
                                                <div class="body">
                                                    <h6 class="d-flex">
                                                        <span class="text-truncate title"><?php echo e($attachment->file_original_name); ?></span>
                                                        <span class="ext">.<?php echo e($attachment->extension); ?></span>
                                                    </h6>
                                                    <p><?php echo e(formatBytes($attachment->file_size)); ?></p>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <div class="alert alert-secondary" role="alert">
                                        <?php echo e(translate('No attachment')); ?>

                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <span class="time"><?php echo e(Carbon\Carbon::parse($chat->created_at)->diffForHumans()); ?></span>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/frontend/default/partials/chat-messages-part.blade.php ENDPATH**/ ?>