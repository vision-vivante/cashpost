

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<footer class="aiz-footer fs-13 mt-auto">
    <div class="aiz-footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 text-xl-right text-center">
                    <div class="aiz-front-widget mb-5">
                        <img src="<?php echo e(custom_asset( get_setting('footer_logo') )); ?>" height="34" class="mb-lg-4 img-fluid mb-0">
                        <p class="opacity-80 lh-1-9">
                            <?php
                                echo get_setting('about_description_footer');
                            ?>
                        </p>
                    </div>
                </div>
                <div class="col-xl-2 ml-auto col-lg-4">
                    <div class="aiz-front-widget mb-5">
                        <h3 class="title text-white font-weight-bold"><?php echo e(get_setting('widget_one')); ?></h3>
                        <ul class="menu">
                            <?php if( !empty(get_setting('widget_one_labels')) ): ?>
                                <?php $__currentLoopData = json_decode( get_setting('widget_one_labels'), true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(json_decode( get_setting('widget_one_links'), true)[$key]); ?>"><?php echo e($value); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="aiz-front-widget mb-5">
                        <h3 class="title text-white font-weight-bold"><?php echo e(get_setting('widget_two')); ?></h3>
                        <ul class="menu">
                            <?php if( !empty(get_setting('widget_two_labels')) ): ?>
                                <?php $__currentLoopData = json_decode( get_setting('widget_two_labels'), true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(json_decode( get_setting('widget_two_links'), true)[$key]); ?>"><?php echo e($value); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-sm-6 newsletter">
                    <div class="aiz-front-widget mb-5">
                        <h3 class="title text-white font-weight-bold">Stay up to date</h3>                        
                        <h6 class="text-white">Get CashPost updates and offers delivered to your inbox.</h6>
                        <div class="message" id ="message" style="display:none"></div>
                        <form method="POST" id="sub_form"> 
                            <div class="input-group position-relative mt-4">
                                <input type="email" class="form-control  rounded-pill" placeholder="Email address" aria-label="Recipient's username" aria-describedby="button-addon2" id="subscribe_email" required>
                                <div class="input-group-append position-absolute rounded-circle">
                                    <button class="btn d-flex align-items-center justify-content-center w-100 p-0" type="submit" id="subscribe_form"><span><i class="bi bi-send-fill rocket-icon text-white"></i></span></button>
                                </div>
                          </div>
                        </form>
                    </div>
                </div>

                <!-- <div class="col-xl-3 col-lg-4">
                    <div class="aiz-front-widget mb-5">
                        <h4 class="title"><?php echo e(get_setting('social_widget_title')); ?></h4>
                        <ul class="list-inline social colored">

                            <?php if( !empty(get_setting('facebook_link')) ): ?>
                                <li class="list-inline-item">
                                    <a href="<?php echo e(get_setting('facebook_link')); ?>" target="_blank" class="facebook"><i class="lab la-facebook-f"></i></a>
                                </li>
                            <?php endif; ?>
                            <?php if( !empty(get_setting('twitter_link')) ): ?>
                            <li class="list-inline-item">
                                <a href="<?php echo e(get_setting('twitter_link')); ?>" target="_blank" class="twitter"><i class="lab la-twitter"></i></a>
                            </li>
                            <?php endif; ?>
                            <?php if( !empty(get_setting('instagram_link')) ): ?>
                            <li class="list-inline-item">
                                <a href="<?php echo e(get_setting('instagram_link')); ?>" target="_blank" class="instagram"><i class="lab la-instagram"></i></a>
                            </li>
                            <?php endif; ?>
                            <?php if( !empty(get_setting('youtube_link')) ): ?>
                            <li class="list-inline-item">
                                <a href="<?php echo e(get_setting('youtube_link')); ?>" target="_blank" class="youtube"><i class="lab la-youtube"></i></a>
                            </li>
                            <?php endif; ?>
                            <?php if( !empty(get_setting('linkedin_link')) ): ?>
                            <li class="list-inline-item">
                                <a href="<?php echo e(get_setting('linkedin_link')); ?>" target="_blank" class="linkedin"><i class="lab la-linkedin-in"></i></a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div> -->
            </div>
        </div>
    </div><!-- .aiz-footer-widget -->
    <div class="aiz-footer-copyright text-sm py-3">
        <div class="container">
            <div class="row align-items-center">
                <?php if( get_setting('language_switcher') == 'on'): ?>
                    <div class="col-6">
                        <div class="dropdown dropup d-inline-block ml-auto">
                            <?php
                                if(Session::has('locale')){
                                    $locale = Session::get('locale', Config::get('app.locale'));
                                }
                                else{
                                    $locale = env('DEFAULT_LANGUAGE');
                                }
                                $lang = \App\Models\Language::where('code', $locale)->first();
                            ?>
                            <?php if($lang != null): ?>
                                <a class="hidehover dropdown-toggle py-2 text-secondary no-arrow" data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="<?php echo e(my_asset('assets/frontend/default/img/flags/'.$lang->code.'.png')); ?>" height="11">
                                    <span class="ml-2"><?php echo e($lang->name); ?></span>
                                </a>
                            <?php endif; ?>
                            <div class="dropdown-menu" style="">
                                <?php $__currentLoopData = \App\Models\Language::where('enable',1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('language.change',$language->code)); ?>" class="dropdown-item">
                                        <img src="<?php echo e(my_asset('assets/frontend/default/img/flags/'.$language->code.'.png')); ?>" height="11">
                                        <span class="ml-2"><?php echo e($language->name); ?></span>
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 text-right text-secondary">
                        <?php
                            echo get_setting('copyright_text');
                        ?>
                    </div>
                <?php else: ?>
                    <div class="col d-flex justify-content-between text-secondary">
                        <?php
                            echo get_setting('copyright_text');
                        ?>
                        <div class="important-link d-flex flex-column flex-sm-row">
                            <a href="<?php echo e(url('/privacy-policy')); ?>" class="link">Privacy Policy</a>
                            <span class="break px-2 h6 d-none d-sm-inline-flex mt-1 m-0">I</span>
                            <a href="<?php echo e(url('/terms-conditions')); ?>" class="link">Terms & Conditions</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>
<div class="aiz-mobile-bottom-nav d-none fixed-bottom bg-white shadow-lg border-top">
    <div class="d-flex justify-content-around align-items-center">
        <a href="<?php echo e(route('home')); ?>" class="text-reset flex-grow-1 text-center py-3 border-right <?php echo e(areActiveRoutes(['home'])); ?>">
            <i class="las la-home la-2x"></i>
        </a>
        <a href="<?php echo e(route('frontend.notifications')); ?>" class="text-reset flex-grow-1 text-center py-3 border-right">
            <span class="d-inline-block position-relative px-2">
                <i class="las la-bell la-2x"></i>
                <?php $noti_num = \App\Utility\NotificationUtility::get_my_notifications(10,true,true); ?>
                <?php if($noti_num > 0): ?>
                    <span class="badge badge-circle badge-primary position-absolute absolute-top-right"><?php echo e($noti_num); ?></span>
                <?php endif; ?>
            </span>
        </a>
        <a href="<?php echo e(route('all.messages')); ?>" class="text-reset flex-grow-1 text-center py-3 border-right <?php echo e(areActiveRoutes(['all.messages'])); ?>">
            <span class="d-inline-block position-relative px-2">
                <i class="las la-comment-dots la-2x"></i>
                <?php
                    $unseen_chat_threads = chat_threads();
                    $unseen_chat_thread_count = count($unseen_chat_threads);
                ?>
                <?php if($unseen_chat_thread_count > 0): ?>
                    <span class="badge badge-circle badge-primary position-absolute absolute-top-right"><?php echo e($unseen_chat_thread_count); ?></span>
                <?php endif; ?>
            </span>
        </a>
        <?php if(Auth::check()): ?>
            <?php if(isClient() || isFreelancer()): ?>
                <?php if(isClient()): ?>
                    <a href="<?php echo e(url('/profile-settings')); ?>" class="text-reset flex-grow-1 text-center py-2 mobile-side-nav-thumb" data-toggle="class-toggle" data-target=".aiz-mobile-side-nav">
                    <span class="avatar avatar-sm d-block mx-auto"><?php echo e(translate('Profile')); ?>

                <?php elseif(isFreelancer()): ?>
                    <a href="<?php echo e(url('/profile')); ?>" class="text-reset flex-grow-1 text-center py-2 mobile-side-nav-thumb" data-toggle="class-toggle" data-target=".aiz-mobile-side-nav">
                    <span class="avatar avatar-sm d-block mx-auto">
                        <?php echo e(translate('Profile')); ?>


                <?php endif; ?>
                        <?php if(Auth::user()->photo != null): ?>
                            <img src="<?php echo e(custom_asset(Auth::user()->photo)); ?>">
                        <?php else: ?>
                            <img src="<?php echo e(my_asset('assets/frontend/default/img/avatar-place.png')); ?>">
                        <?php endif; ?>
                        <?php if(Cache::has('user-is-online-' . Auth::user()->id)): ?>
                            <span class="badge badge-dot badge-success badge-circle badge-status"></span>
                        <?php else: ?>
                            <span class="badge badge-dot badge-secondary badge-circle badge-status"></span>
                        <?php endif; ?>
                    </span>
                </a>
            <?php else: ?>
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-reset flex-grow-1 text-center py-2">
                    <span class="avatar avatar-sm d-block mx-auto">
                        <?php if(Auth::user()->photo != null): ?>
                            <img src="<?php echo e(custom_asset(Auth::user()->photo)); ?>">
                        <?php else: ?>
                            <img src="<?php echo e(my_asset('assets/frontend/default/img/avatar-place.png')); ?>">
                        <?php endif; ?>
                    </span>
                </a>
            <?php endif; ?>
        <?php else: ?>
            <a href="<?php echo e(route('login')); ?>" class="text-reset flex-grow-1 text-center py-2">
                <span class="avatar avatar-sm d-block mx-auto">
                    <img src="<?php echo e(my_asset('assets/frontend/default/img/avatar-place.png')); ?>">
                </span>
            </a>
        <?php endif; ?>
    </div>
</div>
<script type="text/javascript">
    $(function(){
           $("a.hidehover").each(function (index, element){
               var href = $(this).attr("href");
               $(this).attr("hiddenhref", href);
               $(this).removeAttr("href");
           });
           $("a.hidehover").click(function(){
               url = $(this).attr("hiddenhref");
               window.location.href = url;
           })
       });
</script>
<?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/frontend/default/inc/footer.blade.php ENDPATH**/ ?>