@if (Request::is('/') || Request::is('brand') || Request::is('influencer'))
    @php 
      $class="aiz-header-home"; 
      $header_logo=get_setting('header_logo');
    @endphp
@else
    @php 
        $class="aiz-header-other";
        $header_logo=get_setting('other_header_logo');
    @endphp
@endif
<header class="aiz-header position-relative @if(get_setting('header_stikcy') == 'on') sticky-top @endif {{$class}}">
    <div class="aiz-navbar py-10px fs-14 position-relative">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="{{ route('brand') }}" class="d-inline-block">
                        <!-- <img src="https://server.visionvivante.com:8040/activeworkdesk/public/uploads/all/CashPost.png"> -->
                        <img src="{{ custom_asset($header_logo) }}" height="32">
                    </a>
                </div>
                <!-- <div class="search ml-lg-5 ml-auto mr-lg-auto">
                    <div class="front-header-search d-flex align-items-center bg-white px-3 px-lg-0">
                        <form action="{{ route('search') }}" method="GET" class="flex-grow-1">
                            <div class="input-group">
                                <a class="text-reset bg-soft-secondary fs-12 rounded-left d-lg-none p-2" href="javascript:void(0);" data-toggle="class-toggle" data-target=".front-header-search">
                                    <i class="las la-arrow-left la-2x"></i>
                                </a>
                                <div class="input-group-prepend flex-grow-1 d-none d-sm-block">
                                    <input type="text" class="form-control" placeholder="I'm looking for" name="keyword">
                                </div>
                                <select class="form-control aiz-selectpicker" name="type">
                                    <option value="freelancer" @isset($type)
                                        @if ($type == 'freelancer')
                                            selected
                                        @endif
                                    @endisset>{{ translate('Freelancers') }}</option>
                                    <option value="project" @isset($type)
                                        @if ($type == 'project')
                                            selected
                                        @endif
                                    @endisset>{{ translate('Projects') }}</option>
                                    <option value="service" @isset($type)
                                        @if ($type == 'service')
                                            selected
                                        @endif
                                    @endisset>{{ translate('Services') }}</option>
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
                                        <a href="{{url('/dashboard')}}" class="nav-link text-white mb-0 h6 {{ areActiveRoutes(['dashboard'])}}">Dashboard</a>
                                    </li>
                                    @if(isFreelancer())
                                    <li class="nav-item">
                                        <a href="{{url('/projects/find-project')}}" class="nav-link mb-0 text-white h6 {{ areActiveRoutes(['projects.find_project'])}}">Opportunities</a>
                                    </li>
                                    @endif
                                    @if(isClient())
                                        <li class="nav-item">
                                            <a href="{{url('/find-influencer')}}" class="nav-link mb-0 text-white h6 {{ areActiveRoutes(['projects.find_influencer'])}}">{{ translate('Potential Influencers') }}</a>
                                        </li>
                                    @endif
                                    <li class="nav-item">
                                        <a href="{{url('/project-listing')}}" class="nav-link mb-0 text-white h6 {{ areActiveRoutes(['projects.all_project'])}}">My Campaigns</a>
                                    </li>
                                    @if(Auth::check())
                                        <li class="nav-item d-xl-none d-md-none">
                                            <a class="nav-link mb-0 text-white h6" href="{{ route('logout') }}">
                                                {{ translate('Log Out') }}
                                            </a>
                                        </li>
                                    @else
                                    <li class="nav-item  d-xl-none d-md-none">
                                        <a class="nav-link mb-0 text-white h6 " href="{{ route('register') }}">
                                            {{ translate('Sign up') }}
                                        </a>
                                    </li>
                                    <li class="nav-item  d-xl-none d-md-none">
                                        <a class="nav-link mb-0 text-white h6 " href="{{ route('login') }}">
                                            {{ translate('Login') }}
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="navbar-right align-items-center d-none d-md-flex">
                                <a href="{{url('/')}}#help" class="btn px-3 text-white h6 mb-0">Help <i class="bi bi-headphones"></i></a>
                                <!-- <button class="btn btn-green" type="button">Login</button> -->
                                @if(!Auth::user())
                                <a class="nav-link btn btn-green text-white h6" href="{{ route('login') }}">{{ translate('Log In') }}</a>
                                @endif
                            </div>
                            @if(!Auth::user())
                                <div class="navbar-right align-items-center order-first d-md-none align-items-center d-flex">
                                <a class="nav-link text-white btn h3 mb-0" href="{{ route('login') }}"><!--{{ translate('Log In') }}--><i class="bi sm-icon-p bi-person-circle"></i></a>
                            </div>
                            @else
                                <div class="navbar-right align-items-center order-first d-md-none align-items-center d-flex">
                                @if(isClient())
                                    <a class="nav-link text-white btn h3 mb-0" href="{{ route('user.profile') }}">
                                        <i class="bi sm-icon-p bi-person-circle"></i>
                                    </a>
                                @elseif(isFreelancer())
                                    <a class="nav-link text-white btn h3 mb-0" href="{{ route('user.profile_view') }}">
                                        <i class="bi sm-icon-p bi-person-circle"></i>
                                    </a>
                                @endif
                                <a href="{{ route('frontend.notifications') }}" class="nav-link text-white btn h4 mb-0">
                                    <span class="d-inline-block position-relative px-2">
                                        <i class="las la-bell la-2x"></i>
                                        @php $noti_num = \App\Utility\NotificationUtility::get_my_notifications(10,true,true); @endphp
                                        @if($noti_num > 0)
                                            <span class="badge badge-circle badge-primary position-absolute absolute-top-right">{{ $noti_num }}</span>
                                        @endif
                                    </span>
                                </a>
                                @php
                                    $unseen_chat_threads = chat_threads();
                                    $unseen_chat_thread_count = count($unseen_chat_threads);
                                @endphp
                                <a class="dropdown-toggle no-arrow position-relative p-0 text-white" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                                    <span class="d-inline-block position-relative px-1">
                                    <i class="las la-comment-dots la-2x"></i>
                                    @if($unseen_chat_thread_count > 0)
                                        <span class="badge badge-circle badge-primary position-absolute absolute-top-right">{{ $unseen_chat_thread_count }}</span>
                                    @endif
                                     </span>
                                
                                <div class="dropdown-menu text-right dropdown-menu-right dropdown-menu-animated dropdown-menu-lg py-0 position-absolute">
                                    <div class="p-3 bg-light border-bottom">
                                        <h6 class="mb-0">{{ translate('Messages') }}</h6>
                                    </div>

                                    <div class="c-scrollbar-light" style="overflow-y:auto;max-height:300px;">
                                        @forelse ($unseen_chat_threads as $key => $chat_thread_id)
                                            @php
                                                $chat = \App\Models\Chat::where('chat_thread_id', $chat_thread_id)->latest()->first();
                                                $chatThread = \App\Models\ChatThread::where('id', $chat_thread_id)->latest()->first();
                                                $project = \App\Models\Project::withTrashed()->where('id', $chatThread->project_id)->latest()->first();
                                            @endphp
                                            @if ($chat != null)
                                                <a href="{{ url('chat?receiver='.$chat->chatThread->receiver_user_id.'&project='.$project->slug) }}" class="chat-user-item p-3 d-block text-inherit hov-bg-soft-primary">
                                                    <div class="media">
                                                        <span class="avatar avatar-sm mr-3 flex-shrink-0">
                                                            @if (isClient())
                                                                @if ($chat->chatThread->receiver->photo != null)
                                                                <img src="{{ custom_asset($chat->chatThread->receiver->photo) }}">
                                                                @else
                                                                <img src="{{ my_asset('assets/frontend/default/img/avatar-place.png') }}">
                                                                @endif
                                                                @if(Cache::has('user-is-online-' . $chat->chatThread->receiver->id))
                                                                    <span class="badge badge-dot badge-circle badge-success badge-status badge-md"></span>
                                                                @else
                                                                    <span class="badge badge-dot badge-circle badge-secondary badge-status badge-md"></span>
                                                                @endif
                                                            @else
                                                                @if ($chat->chatThread->sender->photo != null)
                                                                <img src="{{ custom_asset($chat->chatThread->sender->photo) }}">
                                                                @else
                                                                <img src="{{ my_asset('assets/frontend/default/img/avatar-place.png') }}">
                                                                @endif
                                                                @if(Cache::has('user-is-online-' . $chat->chatThread->sender->id))
                                                                    <span class="badge badge-dot badge-circle badge-success badge-status badge-md"></span>
                                                                @else
                                                                    <span class="badge badge-dot badge-circle badge-secondary badge-status badge-md"></span>
                                                                @endif
                                                            @endif
                                                        </span>
                                                        <div class="media-body minw-0">
                                                            @if (isClient())
                                                                <h6 class="mt-0 mb-1 fs-14 text-truncate">{{ $chat->chatThread->receiver->name }}</h6>
                                                            @else
                                                                <h6 class="mt-0 mb-1 fs-14 text-truncate">{{ $chat->chatThread->sender->name }}</h6>
                                                            @endif
                                                            @if ($chat->message != null)
                                                                <div class="fs-12 text-truncate opacity-60">{{ $chat->message }}</div>
                                                            @else
                                                                <div class="fs-12 text-truncate opacity-60">{{ translate('Attachments') }}</div>
                                                            @endif
                                                        </div>
                                                        <div class="ml-2 text-right">
                                                            <div class="opacity-60 fs-10 mb-1">{{ Carbon\Carbon::parse($chat->created_at)->diffForHumans() }}</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endif
                                        @empty
                                            <div class="text-center">
                                                <i class="las la-frown la-4x mb-4 opacity-40"></i>
                                                <h4 class="h5">{{ translate('No New Messages') }}</h4>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                                </a>
                            </div>
                            @endif
                           
                            @if (!Auth::check())
                                <!-- <li class="nav-item d-none d-lg-block">
                                    <a class="nav-link" href="{{ route('login') }}">{{ translate('Log In') }}</a>
                                </li> -->
                                <!-- <li class="nav-item ml-xl-3">
                                    <a class="btn btn-primary" href="{{ route('register') }}">{{ translate('Get Started') }}</a>
                                </li> -->
                            @elseif (isClient() || isFreelancer())
                                <li class="dropdown d-none d-lg-block">
                                    <a class="dropdown-toggle no-arrow position-relative p-2 text-white" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                                        <i class="las la-bell la-2x"></i>

                                        @php $noti_num = \App\Utility\NotificationUtility::get_my_notifications(10,true,true); @endphp
                                        @if($noti_num != 0)
                                            <span class="badge badge-circle badge-primary position-absolute absolute-top-right">
                                                {{--get numbers of unseen notification --}}
                                                {{  $noti_num }}
                                            </span>
                                        @endif

                                    </a>
                                    <div class="dropdown-menu text-right dropdown-menu-right dropdown-menu-animated dropdown-menu-lg py-0">
                                        <div class="p-3 bg-light border-bottom">
                                            <h6 class="mb-0">{{ translate('Notifications') }}</h6>
                                        </div>
                                        <ul class="list-group list-group-raw c-scrollbar-light" style="overflow-y:auto;max-height:300px;">
                                            {{--get 10 unseen notifications as array --}}
                                            @php $notification_list = \App\Utility\NotificationUtility::get_my_notifications(10,false,false,false); @endphp

                                            @forelse ($notification_list as $notification_item)

                                                 

                                                <li class="list-group-item d-flex justify-content-between align-items-start hov-bg-soft-primary">
                                                    <a  id ="update_noti" href="javascript:void(0)" class="media text-inherit update_noti">
                                                         <input type="hidden" class="noti_id" name="noti_id" value="{{ $notification_item['id'] }}" />
                                                         <input type="hidden" class="noti_link" name="noti_link" value="{{ $notification_item['link'] }}" />
                                                        <span class="avatar avatar-sm mr-3">
                                                            <img src="{{ $notification_item['sender_photo'] }}">
                                                        </span>
                                                        <div class="media-body">
                                                            <p class="mb-1">{{ $notification_item['message'].' '.$notification_item['sender_name'] }}</p>
                                                            <small class="text-muted">{{ $notification_item['date']  }}</small>
                                                        </div>
                                                    </a>
                                                    @if($notification_item['seen'] == false)

                                                    <button class="btn p-0" data-toggle="tooltip" data-title="{{ translate('New') }} ">
                                                        <span class="badge badge-md  badge-dot badge-circle badge-primary"></span>
                                                    </button>
                                                    @endif
                                                </li>
                                            @empty
                                                <li class="list-group-item">
                                                    <div class="text-center">
                                                        <i class="las la-frown la-4x mb-4 opacity-40"></i>
                                                        <h4 class="h5">{{ translate('No Notifications') }}</h4>
                                                    </div>
                                                </li>
                                            @endforelse
                                        </ul>
                                        <div class="border-top">
                                            <a href="{{ route('frontend.notifications') }}" class="btn btn-link btn-block">{{ translate('View All Notifications') }}</a>
                                        </div>
                                    </div>
                                </li>
                                @php
                                    $unseen_chat_threads = chat_threads();
                                    $unseen_chat_thread_count = count($unseen_chat_threads);
                                @endphp
                                <li class="dropdown d-none d-lg-block">
                                    <a class="dropdown-toggle no-arrow position-relative p-2 text-white" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                                        <i class="las la-comment-dots la-2x"></i>
                                        @if($unseen_chat_thread_count > 0)
                                            <span class="badge badge-circle badge-primary position-absolute absolute-top-right">{{ $unseen_chat_thread_count }}</span>
                                        @endif
                                    </a>
                                    <div class="dropdown-menu text-right dropdown-menu-right dropdown-menu-animated dropdown-menu-lg py-0">
                                        <div class="p-3 bg-light border-bottom">
                                            <h6 class="mb-0">{{ translate('Messages') }}</h6>
                                        </div>

                                        <div class="c-scrollbar-light" style="overflow-y:auto;max-height:300px;">
                                            @forelse ($unseen_chat_threads as $key => $chat_thread_id)
                                                @php
                                                    $chat = \App\Models\Chat::where('chat_thread_id', $chat_thread_id)->latest()->first();
                                                    $chatThread = \App\Models\ChatThread::where('id', $chat_thread_id)->latest()->first();
                                                    $project = \App\Models\Project::withTrashed()->where('id', $chatThread->project_id)->latest()->first();
                                                @endphp
                                                @if ($chat != null)
                                                    <a href="{{ url('chat?receiver='.$chat->chatThread->receiver_user_id.'&project='.$project->slug) }}" class="chat-user-item p-3 d-block text-inherit hov-bg-soft-primary">
                                                        <div class="media">
                                                            <span class="avatar avatar-sm mr-3 flex-shrink-0">
                                                                @if (isClient())
                                                                    @if ($chat->chatThread->receiver->photo != null)
                                                                    <img src="{{ custom_asset($chat->chatThread->receiver->photo) }}">
                                                                    @else
                                                                    <img src="{{ my_asset('assets/frontend/default/img/avatar-place.png') }}">
                                                                    @endif
                                                                    @if(Cache::has('user-is-online-' . $chat->chatThread->receiver->id))
                                                                        <span class="badge badge-dot badge-circle badge-success badge-status badge-md"></span>
                                                                    @else
                                                                        <span class="badge badge-dot badge-circle badge-secondary badge-status badge-md"></span>
                                                                    @endif
                                                                @else
                                                                    @if ($chat->chatThread->sender->photo != null)
                                                                    <img src="{{ custom_asset($chat->chatThread->sender->photo) }}">
                                                                    @else
                                                                    <img src="{{ my_asset('assets/frontend/default/img/avatar-place.png') }}">
                                                                    @endif
                                                                    @if(Cache::has('user-is-online-' . $chat->chatThread->sender->id))
                                                                        <span class="badge badge-dot badge-circle badge-success badge-status badge-md"></span>
                                                                    @else
                                                                        <span class="badge badge-dot badge-circle badge-secondary badge-status badge-md"></span>
                                                                    @endif
                                                                @endif
                                                            </span>
                                                            <div class="media-body minw-0">
                                                                @if (isClient())
                                                                    <h6 class="mt-0 mb-1 fs-14 text-truncate">{{ $chat->chatThread->receiver->name }}</h6>
                                                                @else
                                                                    <h6 class="mt-0 mb-1 fs-14 text-truncate">{{ $chat->chatThread->sender->name }}</h6>
                                                                @endif
                                                                @if ($chat->message != null)
                                                                    <div class="fs-12 text-truncate opacity-60">{{ $chat->message }}</div>
                                                                @else
                                                                    <div class="fs-12 text-truncate opacity-60">{{ translate('Attachments') }}</div>
                                                                @endif
                                                            </div>
                                                            <div class="ml-2 text-right">
                                                                <div class="opacity-60 fs-10 mb-1">{{ Carbon\Carbon::parse($chat->created_at)->diffForHumans() }}</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                @endif
                                            @empty
                                                <div class="text-center">
                                                    <i class="las la-frown la-4x mb-4 opacity-40"></i>
                                                    <h4 class="h5">{{ translate('No New Messages') }}</h4>
                                                </div>
                                            @endforelse
                                        </div>
                                        <!-- <div class="border-top">
                                            <a href="{{ route('all.messages') }}" class="btn btn-link btn-block">{{ translate('View All Messages') }}</a>
                                        </div> -->
                                    </div>
                                </li>
                                <li class="dropdown ml-3 d-none d-lg-block d-md-block">
                                    <button class="btn p-0 dropdown-toggle no-arrow" type="button" data-toggle="dropdown">
                                        <span class="avatar avatar-sm border">
                                            @if (Auth::user()->photo != null)
                                                <img src="{{ custom_asset(Auth::user()->photo)}}">
                                            @else
                                                <img src="{{ my_asset('assets/frontend/default/img/avatar-place.png') }}">
                                            @endif
                                        </span>
                                        <span class="ml-2 text-left d-none d-xl-inline-block">
                                            <span class="h6 d-block mb-0 text-white notifications">{{ Auth::user()->name }}<i class="bi bi-chevron-down text-white notifications px-2 fw-600"></i></span>
                                            @if (Auth::check() && isFreelancer() && !empty(Auth::user()->profile->balance))
                                            <span class="small fw-500 text-muted">{{ single_price( isset(Auth::user()->profile->balance) ? (Auth::user()->profile->balance) : 0 ) }}</span>
                                            @endif
                                        </span>
                                    </button>
                                    <div class="dropdown-menu my-profile-menu text-right dropdown-menu-animated dropdown-menu-right p-0" aria-labelledby="dropdownMenuButton">
                                       <!--  <div class="px-3 py-2">
                                            <span class="h6 d-block mb-0">{{ Auth::user()->name }}</span>
                                            <span class="small text-muted d-block text-truncate">{{ Auth::user()->email }}</span>
                                        </div>
                                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                                            {{ translate('Transactions') }}
                                        </a>-->
                                        @if(isClient())
                                            <a class="dropdown-item" href="{{ url('/profile-settings') }}">
                                                {{ translate('Profile') }}
                                            </a>
                                        @elseif(isFreelancer())
                                            <a class="dropdown-item" href="{{ url('/profile') }}">
                                                {{ translate('Profile') }}
                                            </a>
                                        @endif
                                       <!--  <a class="dropdown-item" href="{{ route('projects.all_project') }}">
                                            {{ translate('Payments') }}
                                        </a> -->
                                        <a class="dropdown-item" href="{{ route('logout') }}">
                                            {{ translate('Log Out') }}
                                        </a>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
