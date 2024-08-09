<?php if(Request::is('/') || Request::is('brand') || Request::is('influencer')): ?>
    <?php 
      $class="aiz-header-home"; 
      $header_logo=get_setting('header_logo');
    ?>
<?php else: ?>
    <?php 
        $class="aiz-header-other";
        $header_logo=get_setting('other_header_logo');
    ?>
<?php endif; ?>
<header class="aiz-header position-relative <?php if(get_setting('header_stikcy') == 'on'): ?> sticky-top <?php endif; ?> <?php echo e($class); ?>">
    <div class="aiz-navbar py-10px fs-14 position-relative">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="<?php echo e(route('brand')); ?>" class="d-inline-block">
                        <!-- <img src="https://server.visionvivante.com:8040/activeworkdesk/public/uploads/all/CashPost.png"> -->
                        <img src="<?php echo e(custom_asset($header_logo)); ?>" height="32">
                    </a>
                </div>
                <!-- <div class="search ml-lg-5 ml-auto mr-lg-auto">
                    <div class="front-header-search d-flex align-items-center bg-white px-3 px-lg-0">
                        <form action="<?php echo e(route('search')); ?>" method="GET" class="flex-grow-1">
                            <div class="input-group">
                                <a class="text-reset bg-soft-secondary fs-12 rounded-left d-lg-none p-2" href="javascript:void(0);" data-toggle="class-toggle" data-target=".front-header-search">
                                    <i class="las la-arrow-left la-2x"></i>
                                </a>
                                <div class="input-group-prepend flex-grow-1 d-none d-sm-block">
                                    <input type="text" class="form-control" placeholder="I'm looking for" name="keyword">
                                </div>
                                <select class="form-control aiz-selectpicker" name="type">
                                    <option value="freelancer" <?php if(isset($type)): ?>
                                        <?php if($type == 'freelancer'): ?>
                                            selected
                                        <?php endif; ?>
                                    <?php endif; ?>><?php echo e(translate('Freelancers')); ?></option>
                                    <option value="project" <?php if(isset($type)): ?>
                                        <?php if($type == 'project'): ?>
                                            selected
                                        <?php endif; ?>
                                    <?php endif; ?>><?php echo e(translate('Projects')); ?></option>
                                    <option value="service" <?php if(isset($type)): ?>
                                        <?php if($type == 'service'): ?>
                                            selected
                                        <?php endif; ?>
                                    <?php endif; ?>><?php echo e(translate('Services')); ?></option>
                                </select>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-icon btn-primary">
                                        <i class="las la-search la-rotate-270"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> -->
                <div class="menu w-100">
                    <nav class="navbar-expand-md navbar-light">
                        <ul class="navbar-nav flex-row ml-auto justify-content-end align-items-center">
                            <!-- <li class="nav-item d-lg-none">
                                <a class="p-2 d-inline-block" href="javascript:void(0);" data-toggle="class-toggle" data-target=".front-header-search">
                                    <i class="las la-search la-flip-horizontal la-2x"></i>
                                </a>
                            </li> -->
                            <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                              </button>
                            <div class="ml-md-4 collapse my-navbar navbar-collapse justify-content-between" id="navbarToggler">
                                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                                    <li class="nav-item">
                                        <a href="<?php echo e(url('/dashboard')); ?>" class="nav-link text-white mb-0 h6 <?php echo e(areActiveRoutes(['dashboard'])); ?>">Dashboard</a>
                                    </li>
                                    <?php if(isFreelancer()): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(url('/projects/find-project')); ?>" class="nav-link mb-0 text-white h6 <?php echo e(areActiveRoutes(['projects.find_project'])); ?>">Opportunities</a>
                                    </li>
                                    <?php endif; ?>
                                    <?php if(isClient()): ?>
                                        <li class="nav-item">
                                            <a href="<?php echo e(url('/find-influencer')); ?>" class="nav-link mb-0 text-white h6 <?php echo e(areActiveRoutes(['projects.find_influencer'])); ?>"><?php echo e(translate('Potential Influencers')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <li class="nav-item">
                                        <a href="<?php echo e(url('/project-listing')); ?>" class="nav-link mb-0 text-white h6 <?php echo e(areActiveRoutes(['projects.all_project'])); ?>">My Campaigns</a>
                                    </li>
                                    <?php if(Auth::check()): ?>
                                        <li class="nav-item d-xl-none d-md-none">
                                            <a class="nav-link mb-0 text-white h6" href="<?php echo e(route('logout')); ?>">
                                                <?php echo e(translate('Log Out')); ?>

                                            </a>
                                        </li>
                                    <?php else: ?>
                                    <li class="nav-item  d-xl-none d-md-none">
                                        <a class="nav-link mb-0 text-white h6 " href="<?php echo e(route('register')); ?>">
                                            <?php echo e(translate('Sign up')); ?>

                                        </a>
                                    </li>
                                    <li class="nav-item  d-xl-none d-md-none">
                                        <a class="nav-link mb-0 text-white h6 " href="<?php echo e(route('login')); ?>">
                                            <?php echo e(translate('Login')); ?>

                                        </a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="navbar-right align-items-center d-none d-md-flex">
                                <a href="<?php echo e(url('/')); ?>#help" class="btn px-3 text-white h6 mb-0">Help <i class="bi bi-headphones"></i></a>
                                <!-- <button class="btn btn-green" type="button">Login</button> -->
                                <?php if(!Auth::user()): ?>
                                <a class="nav-link btn btn-green text-white h6" href="<?php echo e(route('login')); ?>"><?php echo e(translate('Log In')); ?></a>
                                <?php endif; ?>
                            </div>
                            <?php if(!Auth::user()): ?>
                                <div class="navbar-right align-items-center order-first d-md-none align-items-center d-flex">
                                <a class="nav-link text-white btn h3 mb-0" href="<?php echo e(route('login')); ?>"><!--<?php echo e(translate('Log In')); ?>--><i class="bi sm-icon-p bi-person-circle"></i></a>
                            </div>
                            <?php else: ?>
                                <div class="navbar-right align-items-center order-first d-md-none align-items-center d-flex">
                                <?php if(isClient()): ?>
                                    <a class="nav-link text-white btn h3 mb-0" href="<?php echo e(route('user.profile')); ?>">
                                        <i class="bi sm-icon-p bi-person-circle"></i>
                                    </a>
                                <?php elseif(isFreelancer()): ?>
                                    <a class="nav-link text-white btn h3 mb-0" href="<?php echo e(route('user.profile_view')); ?>">
                                        <i class="bi sm-icon-p bi-person-circle"></i>
                                    </a>
                                <?php endif; ?>
                                <a href="<?php echo e(route('frontend.notifications')); ?>" class="nav-link text-white btn h4 mb-0">
                                    <span class="d-inline-block position-relative px-2">
                                        <i class="las la-bell la-2x"></i>
                                        <?php $noti_num = \App\Utility\NotificationUtility::get_my_notifications(10,true,true); ?>
                                        <?php if($noti_num > 0): ?>
                                            <span class="badge badge-circle badge-primary position-absolute absolute-top-right"><?php echo e($noti_num); ?></span>
                                        <?php endif; ?>
                                    </span>
                                </a>
                                <?php
                                    $unseen_chat_threads = chat_threads();
                                    $unseen_chat_thread_count = count($unseen_chat_threads);
                                ?>
                                <a class="dropdown-toggle no-arrow position-relative p-0 text-white" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                                    <span class="d-inline-block position-relative px-1">
                                    <i class="las la-comment-dots la-2x"></i>
                                    <?php if($unseen_chat_thread_count > 0): ?>
                                        <span class="badge badge-circle badge-primary position-absolute absolute-top-right"><?php echo e($unseen_chat_thread_count); ?></span>
                                    <?php endif; ?>
                                     </span>
                                
                                <div class="dropdown-menu text-right dropdown-menu-right dropdown-menu-animated dropdown-menu-lg py-0 position-absolute">
                                    <div class="p-3 bg-light border-bottom">
                                        <h6 class="mb-0"><?php echo e(translate('Messages')); ?></h6>
                                    </div>

                                    <div class="c-scrollbar-light" style="overflow-y:auto;max-height:300px;">
                                        <?php $__empty_1 = true; $__currentLoopData = $unseen_chat_threads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $chat_thread_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <?php
                                                $chat = \App\Models\Chat::where('chat_thread_id', $chat_thread_id)->latest()->first();
                                                $chatThread = \App\Models\ChatThread::where('id', $chat_thread_id)->latest()->first();
                                                $project = \App\Models\Project::withTrashed()->where('id', $chatThread->project_id)->latest()->first();
                                            ?>
                                            <?php if($chat != null): ?>
                                                <a href="<?php echo e(url('chat?receiver='.$chat->chatThread->receiver_user_id.'&project='.$project->slug)); ?>" class="chat-user-item p-3 d-block text-inherit hov-bg-soft-primary">
                                                    <div class="media">
                                                        <span class="avatar avatar-sm mr-3 flex-shrink-0">
                                                            <?php if(isClient()): ?>
                                                                <?php if($chat->chatThread->receiver->photo != null): ?>
                                                                <img src="<?php echo e(custom_asset($chat->chatThread->receiver->photo)); ?>">
                                                                <?php else: ?>
                                                                <img src="<?php echo e(my_asset('assets/frontend/default/img/avatar-place.png')); ?>">
                                                                <?php endif; ?>
                                                                <?php if(Cache::has('user-is-online-' . $chat->chatThread->receiver->id)): ?>
                                                                    <span class="badge badge-dot badge-circle badge-success badge-status badge-md"></span>
                                                                <?php else: ?>
                                                                    <span class="badge badge-dot badge-circle badge-secondary badge-status badge-md"></span>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <?php if($chat->chatThread->sender->photo != null): ?>
                                                                <img src="<?php echo e(custom_asset($chat->chatThread->sender->photo)); ?>">
                                                                <?php else: ?>
                                                                <img src="<?php echo e(my_asset('assets/frontend/default/img/avatar-place.png')); ?>">
                                                                <?php endif; ?>
                                                                <?php if(Cache::has('user-is-online-' . $chat->chatThread->sender->id)): ?>
                                                                    <span class="badge badge-dot badge-circle badge-success badge-status badge-md"></span>
                                                                <?php else: ?>
                                                                    <span class="badge badge-dot badge-circle badge-secondary badge-status badge-md"></span>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </span>
                                                        <div class="media-body minw-0">
                                                            <?php if(isClient()): ?>
                                                                <h6 class="mt-0 mb-1 fs-14 text-truncate"><?php echo e($chat->chatThread->receiver->name); ?></h6>
                                                            <?php else: ?>
                                                                <h6 class="mt-0 mb-1 fs-14 text-truncate"><?php echo e($chat->chatThread->sender->name); ?></h6>
                                                            <?php endif; ?>
                                                            <?php if($chat->message != null): ?>
                                                                <div class="fs-12 text-truncate opacity-60"><?php echo e($chat->message); ?></div>
                                                            <?php else: ?>
                                                                <div class="fs-12 text-truncate opacity-60"><?php echo e(translate('Attachments')); ?></div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="ml-2 text-right">
                                                            <div class="opacity-60 fs-10 mb-1"><?php echo e(Carbon\Carbon::parse($chat->created_at)->diffForHumans()); ?></div>
                                                        </div>
                                                    </div>
                                                </a>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <div class="text-center">
                                                <i class="las la-frown la-4x mb-4 opacity-40"></i>
                                                <h4 class="h5"><?php echo e(translate('No New Messages')); ?></h4>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                </a>
                            </div>
                            <?php endif; ?>
                           
                            <?php if(!Auth::check()): ?>
                                <!-- <li class="nav-item d-none d-lg-block">
                                    <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(translate('Log In')); ?></a>
                                </li> -->
                                <!-- <li class="nav-item ml-xl-3">
                                    <a class="btn btn-primary" href="<?php echo e(route('register')); ?>"><?php echo e(translate('Get Started')); ?></a>
                                </li> -->
                            <?php elseif(isClient() || isFreelancer()): ?>
                                <li class="dropdown d-none d-lg-block">
                                    <a class="dropdown-toggle no-arrow position-relative p-2 text-white" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                                        <i class="las la-bell la-2x"></i>

                                        <?php $noti_num = \App\Utility\NotificationUtility::get_my_notifications(10,true,true); ?>
                                        <?php if($noti_num != 0): ?>
                                            <span class="badge badge-circle badge-primary position-absolute absolute-top-right">
                                                
                                                <?php echo e($noti_num); ?>

                                            </span>
                                        <?php endif; ?>

                                    </a>
                                    <div class="dropdown-menu text-right dropdown-menu-right dropdown-menu-animated dropdown-menu-lg py-0">
                                        <div class="p-3 bg-light border-bottom">
                                            <h6 class="mb-0"><?php echo e(translate('Notifications')); ?></h6>
                                        </div>
                                        <ul class="list-group list-group-raw c-scrollbar-light" style="overflow-y:auto;max-height:300px;">
                                            
                                            <?php $notification_list = \App\Utility\NotificationUtility::get_my_notifications(10,false,false,false); ?>

                                            <?php $__empty_1 = true; $__currentLoopData = $notification_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                                 

                                                <li class="list-group-item d-flex justify-content-between align-items-start hov-bg-soft-primary">
                                                    <a  id ="update_noti" href="javascript:void(0)" class="media text-inherit update_noti">
                                                         <input type="hidden" class="noti_id" name="noti_id" value="<?php echo e($notification_item['id']); ?>" />
                                                         <input type="hidden" class="noti_link" name="noti_link" value="<?php echo e($notification_item['link']); ?>" />
                                                        <span class="avatar avatar-sm mr-3">
                                                            <img src="<?php echo e($notification_item['sender_photo']); ?>">
                                                        </span>
                                                        <div class="media-body">
                                                            <p class="mb-1"><?php echo e($notification_item['message'].' '.$notification_item['sender_name']); ?></p>
                                                            <small class="text-muted"><?php echo e($notification_item['date']); ?></small>
                                                        </div>
                                                    </a>
                                                    <?php if($notification_item['seen'] == false): ?>

                                                    <button class="btn p-0" data-toggle="tooltip" data-title="<?php echo e(translate('New')); ?> ">
                                                        <span class="badge badge-md  badge-dot badge-circle badge-primary"></span>
                                                    </button>
                                                    <?php endif; ?>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <li class="list-group-item">
                                                    <div class="text-center">
                                                        <i class="las la-frown la-4x mb-4 opacity-40"></i>
                                                        <h4 class="h5"><?php echo e(translate('No Notifications')); ?></h4>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                        <div class="border-top">
                                            <a href="<?php echo e(route('frontend.notifications')); ?>" class="btn btn-link btn-block"><?php echo e(translate('View All Notifications')); ?></a>
                                        </div>
                                    </div>
                                </li>
                                <?php
                                    $unseen_chat_threads = chat_threads();
                                    $unseen_chat_thread_count = count($unseen_chat_threads);
                                ?>
                                <li class="dropdown d-none d-lg-block">
                                    <a class="dropdown-toggle no-arrow position-relative p-2 text-white" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                                        <i class="las la-comment-dots la-2x"></i>
                                        <?php if($unseen_chat_thread_count > 0): ?>
                                            <span class="badge badge-circle badge-primary position-absolute absolute-top-right"><?php echo e($unseen_chat_thread_count); ?></span>
                                        <?php endif; ?>
                                    </a>
                                    <div class="dropdown-menu text-right dropdown-menu-right dropdown-menu-animated dropdown-menu-lg py-0">
                                        <div class="p-3 bg-light border-bottom">
                                            <h6 class="mb-0"><?php echo e(translate('Messages')); ?></h6>
                                        </div>

                                        <div class="c-scrollbar-light" style="overflow-y:auto;max-height:300px;">
                                            <?php $__empty_1 = true; $__currentLoopData = $unseen_chat_threads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $chat_thread_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <?php
                                                    $chat = \App\Models\Chat::where('chat_thread_id', $chat_thread_id)->latest()->first();
                                                    $chatThread = \App\Models\ChatThread::where('id', $chat_thread_id)->latest()->first();
                                                    $project = \App\Models\Project::withTrashed()->where('id', $chatThread->project_id)->latest()->first();
                                                ?>
                                                <?php if($chat != null): ?>
                                                    <a href="<?php echo e(url('chat?receiver='.$chat->chatThread->receiver_user_id.'&project='.$project->slug)); ?>" class="chat-user-item p-3 d-block text-inherit hov-bg-soft-primary">
                                                        <div class="media">
                                                            <span class="avatar avatar-sm mr-3 flex-shrink-0">
                                                                <?php if(isClient()): ?>
                                                                    <?php if($chat->chatThread->receiver->photo != null): ?>
                                                                    <img src="<?php echo e(custom_asset($chat->chatThread->receiver->photo)); ?>">
                                                                    <?php else: ?>
                                                                    <img src="<?php echo e(my_asset('assets/frontend/default/img/avatar-place.png')); ?>">
                                                                    <?php endif; ?>
                                                                    <?php if(Cache::has('user-is-online-' . $chat->chatThread->receiver->id)): ?>
                                                                        <span class="badge badge-dot badge-circle badge-success badge-status badge-md"></span>
                                                                    <?php else: ?>
                                                                        <span class="badge badge-dot badge-circle badge-secondary badge-status badge-md"></span>
                                                                    <?php endif; ?>
                                                                <?php else: ?>
                                                                    <?php if($chat->chatThread->sender->photo != null): ?>
                                                                    <img src="<?php echo e(custom_asset($chat->chatThread->sender->photo)); ?>">
                                                                    <?php else: ?>
                                                                    <img src="<?php echo e(my_asset('assets/frontend/default/img/avatar-place.png')); ?>">
                                                                    <?php endif; ?>
                                                                    <?php if(Cache::has('user-is-online-' . $chat->chatThread->sender->id)): ?>
                                                                        <span class="badge badge-dot badge-circle badge-success badge-status badge-md"></span>
                                                                    <?php else: ?>
                                                                        <span class="badge badge-dot badge-circle badge-secondary badge-status badge-md"></span>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </span>
                                                            <div class="media-body minw-0">
                                                                <?php if(isClient()): ?>
                                                                    <h6 class="mt-0 mb-1 fs-14 text-truncate"><?php echo e($chat->chatThread->receiver->name); ?></h6>
                                                                <?php else: ?>
                                                                    <h6 class="mt-0 mb-1 fs-14 text-truncate"><?php echo e($chat->chatThread->sender->name); ?></h6>
                                                                <?php endif; ?>
                                                                <?php if($chat->message != null): ?>
                                                                    <div class="fs-12 text-truncate opacity-60"><?php echo e($chat->message); ?></div>
                                                                <?php else: ?>
                                                                    <div class="fs-12 text-truncate opacity-60"><?php echo e(translate('Attachments')); ?></div>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="ml-2 text-right">
                                                                <div class="opacity-60 fs-10 mb-1"><?php echo e(Carbon\Carbon::parse($chat->created_at)->diffForHumans()); ?></div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <div class="text-center">
                                                    <i class="las la-frown la-4x mb-4 opacity-40"></i>
                                                    <h4 class="h5"><?php echo e(translate('No New Messages')); ?></h4>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <!-- <div class="border-top">
                                            <a href="<?php echo e(route('all.messages')); ?>" class="btn btn-link btn-block"><?php echo e(translate('View All Messages')); ?></a>
                                        </div> -->
                                    </div>
                                </li>
                                <li class="dropdown ml-3 d-none d-lg-block d-md-block">
                                    <button class="btn p-0 dropdown-toggle no-arrow" type="button" data-toggle="dropdown">
                                        <span class="avatar avatar-sm border">
                                            <?php if(Auth::user()->photo != null): ?>
                                                <img src="<?php echo e(custom_asset(Auth::user()->photo)); ?>">
                                            <?php else: ?>
                                                <img src="<?php echo e(my_asset('assets/frontend/default/img/avatar-place.png')); ?>">
                                            <?php endif; ?>
                                        </span>
                                        <span class="ml-2 text-left d-none d-xl-inline-block">
                                            <span class="h6 d-block mb-0 text-white notifications"><?php echo e(Auth::user()->name); ?><i class="bi bi-chevron-down text-white notifications px-2 fw-600"></i></span>
                                            <?php if(Auth::check() && isFreelancer() && !empty(Auth::user()->profile->balance)): ?>
                                            <span class="small fw-500 text-muted"><?php echo e(single_price( isset(Auth::user()->profile->balance) ? (Auth::user()->profile->balance) : 0 )); ?></span>
                                            <?php endif; ?>
                                        </span>
                                    </button>
                                    <div class="dropdown-menu my-profile-menu text-right dropdown-menu-animated dropdown-menu-right p-0" aria-labelledby="dropdownMenuButton">
                                       <!--  <div class="px-3 py-2">
                                            <span class="h6 d-block mb-0"><?php echo e(Auth::user()->name); ?></span>
                                            <span class="small text-muted d-block text-truncate"><?php echo e(Auth::user()->email); ?></span>
                                        </div>
                                        <a class="dropdown-item" href="<?php echo e(route('dashboard')); ?>">
                                            <?php echo e(translate('Transactions')); ?>

                                        </a>-->
                                        <?php if(isClient()): ?>
                                            <a class="dropdown-item" href="<?php echo e(url('/profile-settings')); ?>">
                                                <?php echo e(translate('Profile')); ?>

                                            </a>
                                        <?php elseif(isFreelancer()): ?>
                                            <a class="dropdown-item" href="<?php echo e(url('/profile')); ?>">
                                                <?php echo e(translate('Profile')); ?>

                                            </a>
                                        <?php endif; ?>
                                       <!--  <a class="dropdown-item" href="<?php echo e(route('projects.all_project')); ?>">
                                            <?php echo e(translate('Payments')); ?>

                                        </a> -->
                                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>">
                                            <?php echo e(translate('Log Out')); ?>

                                        </a>
                                    </div>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/frontend/default/inc/header.blade.php ENDPATH**/ ?>