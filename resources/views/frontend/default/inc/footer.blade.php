

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<footer class="aiz-footer fs-13 mt-auto">
    <div class="aiz-footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 text-xl-right text-center">
                    <div class="aiz-front-widget mb-5">
                        <img src="{{ custom_asset( get_setting('footer_logo') ) }}" height="34" class="mb-lg-4 img-fluid mb-0">
                        <p class="opacity-80 lh-1-9">
                            @php
                                echo get_setting('about_description_footer');
                            @endphp
                        </p>
                    </div>
                </div>
                <div class="col-xl-2 ml-auto col-lg-4">
                    <div class="aiz-front-widget mb-5">
                        <h3 class="title text-white font-weight-bold">{{ get_setting('widget_one') }}</h3>
                        <ul class="menu">
                            @if ( !empty(get_setting('widget_one_labels')) )
                                @foreach (json_decode( get_setting('widget_one_labels'), true) as $key => $value)
                                    <li>
                                        <a href="{{ json_decode( get_setting('widget_one_links'), true)[$key] }}">{{ $value }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="aiz-front-widget mb-5">
                        <h3 class="title text-white font-weight-bold">{{ get_setting('widget_two') }}</h3>
                        <ul class="menu">
                            @if ( !empty(get_setting('widget_two_labels')) )
                                @foreach (json_decode( get_setting('widget_two_labels'), true) as $key => $value)
                                    <li>
                                        <a href="{{ json_decode( get_setting('widget_two_links'), true)[$key] }}">{{ $value }}</a>
                                    </li>
                                @endforeach
                            @endif
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
                        <h4 class="title">{{ get_setting('social_widget_title') }}</h4>
                        <ul class="list-inline social colored">

                            @if ( !empty(get_setting('facebook_link')) )
                                <li class="list-inline-item">
                                    <a href="{{ get_setting('facebook_link') }}" target="_blank" class="facebook"><i class="lab la-facebook-f"></i></a>
                                </li>
                            @endif
                            @if ( !empty(get_setting('twitter_link')) )
                            <li class="list-inline-item">
                                <a href="{{ get_setting('twitter_link') }}" target="_blank" class="twitter"><i class="lab la-twitter"></i></a>
                            </li>
                            @endif
                            @if ( !empty(get_setting('instagram_link')) )
                            <li class="list-inline-item">
                                <a href="{{ get_setting('instagram_link') }}" target="_blank" class="instagram"><i class="lab la-instagram"></i></a>
                            </li>
                            @endif
                            @if ( !empty(get_setting('youtube_link')) )
                            <li class="list-inline-item">
                                <a href="{{ get_setting('youtube_link') }}" target="_blank" class="youtube"><i class="lab la-youtube"></i></a>
                            </li>
                            @endif
                            @if ( !empty(get_setting('linkedin_link')) )
                            <li class="list-inline-item">
                                <a href="{{ get_setting('linkedin_link') }}" target="_blank" class="linkedin"><i class="lab la-linkedin-in"></i></a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div> -->
            </div>
        </div>
    </div><!-- .aiz-footer-widget -->
    <div class="aiz-footer-copyright text-sm py-3">
        <div class="container">
            <div class="row align-items-center">
                @if ( get_setting('language_switcher') == 'on')
                    <div class="col-6">
                        <div class="dropdown dropup d-inline-block ml-auto">
                            @php
                                if(Session::has('locale')){
                                    $locale = Session::get('locale', Config::get('app.locale'));
                                }
                                else{
                                    $locale = env('DEFAULT_LANGUAGE');
                                }
                                $lang = \App\Models\Language::where('code', $locale)->first();
                            @endphp
                            @if($lang != null)
                                <a class="hidehover dropdown-toggle py-2 text-secondary no-arrow" data-toggle="dropdown" href="javascript:void(0)" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="{{ my_asset('assets/frontend/default/img/flags/'.$lang->code.'.png') }}" height="11">
                                    <span class="ml-2">{{ $lang->name }}</span>
                                </a>
                            @endif
                            <div class="dropdown-menu" style="">
                                @foreach (\App\Models\Language::where('enable',1)->get() as $key => $language)
                                    <a href="{{ route('language.change',$language->code) }}" class="dropdown-item">
                                        <img src="{{ my_asset('assets/frontend/default/img/flags/'.$language->code.'.png') }}" height="11">
                                        <span class="ml-2">{{ $language->name }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-6 text-right text-secondary">
                        @php
                            echo get_setting('copyright_text');
                        @endphp
                    </div>
                @else
                    <div class="col d-flex justify-content-between text-secondary">
                        @php
                            echo get_setting('copyright_text');
                        @endphp
                        <div class="important-link d-flex flex-column flex-sm-row">
                            <a href="{{ url('/privacy-policy') }}" class="link">Privacy Policy</a>
                            <span class="break px-2 h6 d-none d-sm-inline-flex mt-1 m-0">I</span>
                            <a href="{{ url('/terms-conditions') }}" class="link">Terms & Conditions</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</footer>
<div class="aiz-mobile-bottom-nav d-none fixed-bottom bg-white shadow-lg border-top">
    <div class="d-flex justify-content-around align-items-center">
        <a href="{{ route('home') }}" class="text-reset flex-grow-1 text-center py-3 border-right {{ areActiveRoutes(['home'])}}">
            <i class="las la-home la-2x"></i>
        </a>
        <a href="{{ route('frontend.notifications') }}" class="text-reset flex-grow-1 text-center py-3 border-right">
            <span class="d-inline-block position-relative px-2">
                <i class="las la-bell la-2x"></i>
                @php $noti_num = \App\Utility\NotificationUtility::get_my_notifications(10,true,true); @endphp
                @if($noti_num > 0)
                    <span class="badge badge-circle badge-primary position-absolute absolute-top-right">{{ $noti_num }}</span>
                @endif
            </span>
        </a>
        <a href="{{ route('all.messages') }}" class="text-reset flex-grow-1 text-center py-3 border-right {{ areActiveRoutes(['all.messages'])}}">
            <span class="d-inline-block position-relative px-2">
                <i class="las la-comment-dots la-2x"></i>
                @php
                    $unseen_chat_threads = chat_threads();
                    $unseen_chat_thread_count = count($unseen_chat_threads);
                @endphp
                @if($unseen_chat_thread_count > 0)
                    <span class="badge badge-circle badge-primary position-absolute absolute-top-right">{{ $unseen_chat_thread_count }}</span>
                @endif
            </span>
        </a>
        @if (Auth::check())
            @if(isClient() || isFreelancer())
                @if(isClient())
                    <a href="{{ url('/profile-settings') }}" class="text-reset flex-grow-1 text-center py-2 mobile-side-nav-thumb" data-toggle="class-toggle" data-target=".aiz-mobile-side-nav">
                    <span class="avatar avatar-sm d-block mx-auto">{{ translate('Profile') }}
                @elseif(isFreelancer())
                    <a href="{{ url('/profile') }}" class="text-reset flex-grow-1 text-center py-2 mobile-side-nav-thumb" data-toggle="class-toggle" data-target=".aiz-mobile-side-nav">
                    <span class="avatar avatar-sm d-block mx-auto">
                        {{ translate('Profile') }}

                @endif
                        @if(Auth::user()->photo != null)
                            <img src="{{ custom_asset(Auth::user()->photo)}}">
                        @else
                            <img src="{{ my_asset('assets/frontend/default/img/avatar-place.png') }}">
                        @endif
                        @if(Cache::has('user-is-online-' . Auth::user()->id))
                            <span class="badge badge-dot badge-success badge-circle badge-status"></span>
                        @else
                            <span class="badge badge-dot badge-secondary badge-circle badge-status"></span>
                        @endif
                    </span>
                </a>
            @else
                <a href="{{ route('admin.dashboard') }}" class="text-reset flex-grow-1 text-center py-2">
                    <span class="avatar avatar-sm d-block mx-auto">
                        @if(Auth::user()->photo != null)
                            <img src="{{ custom_asset(Auth::user()->photo)}}">
                        @else
                            <img src="{{ my_asset('assets/frontend/default/img/avatar-place.png') }}">
                        @endif
                    </span>
                </a>
            @endif
        @else
            <a href="{{ route('login') }}" class="text-reset flex-grow-1 text-center py-2">
                <span class="avatar avatar-sm d-block mx-auto">
                    <img src="{{ my_asset('assets/frontend/default/img/avatar-place.png') }}">
                </span>
            </a>
        @endif
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
