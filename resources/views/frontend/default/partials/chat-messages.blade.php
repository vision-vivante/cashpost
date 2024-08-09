
<div class="chat-box-wrap h-100">

    <div class="chat-list-wrap position-relative c-scrollbar-light scroll-to-btm" id="parentDiv">
        <div class="attached-top position-absolute bg-white chat-header d-flex justify-content-between align-items-center p-3">
            <div class="media">
                <h3 class="mb-0 font-weight-bold">{{ translate('Message')}}</h3>
            </div>
        </div>
        @if (count($chats) > 0)
            <div class="chat-coversation-load text-center">
                <button class="btn btn-link load-more-btn" data-first="{{ $chats->last()->id }}" type="button">{{ translate('Load More') }}</button>
            </div>
        @endif
        <div class="main-chat chat-list px-4" id="chat-messages">
            @include('frontend.default.partials.chat-messages-part',['chats' => $chats])
        </div>
    </div>
    <div class="chat-footer p-3 mt-5 bg-white">
        <form id="send-mesaage">
            <div class="send-body border radius-10">
                <input type="hidden" id="chat_thread_id" name="chat_thread_id" value="{{ $chat_thread->id }}">
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
                @php    
                    $project_data=get_submitted_disbute($chat_thread->project_id,$chat_thread->receiver_user_id);
                @endphp
                @if($project_data!=null)
                    @if(isClient())
                        @if(empty($project_data->closed) &&  !empty($project_data->submitted) && empty($project_data->disputed))
                            <a href="javascript:void(0)" onclick="disputed_modal()" class="btn btn-danger btn-sm text-white">Dispute</a>
                        @else
                            @if(!empty($project_data->closed))
                                <!-- <a href="javascript:void(0)" class="btn text-grey py-0 px-3">Campaign Completed</a> -->
                                <p>Campaign Completed</p>
                            @elseif(!empty($project_data->disputed))
                               <!--  <a href="javascript:void(0)" class="btn text-grey py-0 px-3">Already Disputed</a> -->
                                <p>Already Disputed</p>
                            @endif   
                        @endif
                    @elseif(isFreelancer())
                        @if(empty($project_data->closed) &&  empty($project_data->submitted))
                            <a href="javascript:void(0)" onclick="show_modal()" class="btn text-green text-decoration-underline p-0">{{ translate('Submit Proof') }}</a>
                        @else
                            @if(!empty($project_data->closed))
                                <!-- <a href="javascript:void(0)" class="btn text-grey py-0 px-3">Campaign Completed</a> -->
                                <p>Campaign Completed</p>
                            @elseif(!empty($project_data->disputed))
                               <!-- <a href="javascript:void(0)" class="btn text-grey py-0 px-3">Already Disputed</a> -->
                               <p>Already Disputed</p>
                            @elseif(!empty($project_data->submitted) &&  empty($project_data->closed))
                                <a href="javascript:void(0)" onclick="disputed_modal()" class="btn btn-danger btn-sm text-white">Dispute</a>
                            @else  
                                <!-- <a href="javascript:void(0)" class="btn text-grey py-0 px-3">Already campaign complete</a> -->
                                <p>Already campaign complete</p>
                            @endif
                        @endif 
                    @endif
                @endif

            </div>
        </form>
    </div> 
    <div class="chat-info-wrap">
        <div class="overlay dark c-pointer" data-toggle="class-toggle" data-target=".chat-info-wrap" data-same=".chat-info"></div>
        @if (isClient())
            <div class="chat-info c-scrollbar-light p-4 z-1">
                <div class="px-4 text-center mb-3">
                    <span class="avatar avatar-md mb-3">
                        @if ($chat_thread->receiver->photo != null)
                            <img src="{{ custom_asset($chat_thread->receiver->photo) }}">
                        @else
                            <img src="{{ my_asset('assets/frontend/default/img/avatar-place.png') }}">
                        @endif
                        <span class="badge badge-dot badge-success badge-circle badge-status"></span>
                    </span>
                    <div class="text-secondary fs-10 mb-1">
                        <i class="las la-star text-warning"></i>
                        <span class="fw-600">
                            {{ formatRating(getAverageRating($chat_thread->receiver->id)) }}
                        </span>
                        <span>
                            ({{ getNumberOfReview($chat_thread->receiver->id) }} {{ translate('Reviews') }})
                        </span>
                    </div>
                    <h4 class="h5 mb-2 fw-600">{{ $chat_thread->receiver->name }}</h4>
                    <div class="text-center">
                        @foreach ($chat_thread->receiver->badges as $key => $user_badge)
                            @if ($user_badge->badge != null)
                                <span class="avatar avatar-square avatar-xxs" title="{{ $user_badge->badge->name }}"><img src="{{ my_asset($user_badge->badge->icon) }}"></span>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="separator my-4"><span class="bg-white px-3 text-black-50">{{ translate('Running Projects With You') }}</span></div>
                <div class="">
                    <ul class="list-group">
                        @php
                            $running_projects = DB::table('projects')
                                                ->where('projects.client_user_id', auth()->user()->id)
                                                ->where('projects.biddable', 0)
                                                ->where('projects.closed', 0)
                                                ->where('projects.cancel_status', 0)
                                                ->join('project_users', 'projects.id', '=', 'project_users.project_id')
                                                ->where('project_users.user_id', $chat_thread->receiver_user_id)
                                                ->select('project_users.id')
                                                ->get();
                        @endphp
                        @foreach ($running_projects as $key => $running_project_id)
                            @php
                                $project_user = \App\Models\ProjectUser::find($running_project_id->id);
                            @endphp
                            @if ($project_user->project != null)
                                <li class="list-group-item">
                                    <a href="{{ route('project.details', $project_user->project->slug) }}" target="_blank" class="text-body">{{ $project_user->project->name }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="separator my-4"><span class="bg-white px-3 text-black-50">{{ translate('Completed Campaigns With You') }}</span></div>
                <div class="">
                    <ul class="list-group">
                        @php
                            $completed_projects = DB::table('projects')
                                                ->where('projects.client_user_id', auth()->user()->id)
                                                ->where('projects.biddable', 0)
                                                ->where('projects.closed', 1)
                                                ->where('projects.cancel_status', 0)
                                                ->join('project_users', 'projects.id', '=', 'project_users.project_id')
                                                ->where('project_users.user_id', $chat_thread->receiver_user_id)
                                                ->select('project_users.id')
                                                ->get();
                        @endphp
                        @foreach ($completed_projects as $key => $completed_project_id)
                            @php
                                $project_user = \App\Models\ProjectUser::find($completed_project_id->id);
                            @endphp
                            @if ($project_user->project != null)
                                <li class="list-group-item">
                                    <a href="{{ route('project.details', $project_user->project->slug) }}" target="_blank" class="text-body">{{ $project_user->project->name }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        @else
            <div class="chat-info c-scrollbar-light p-4 z-1">
                <div class="px-4 text-center mb-3">
                    <span class="avatar avatar-md mb-3">
                        @if ($chat_thread->sender->photo != null)
                            <img src="{{ custom_asset($chat_thread->sender->photo) }}">
                        @else
                            <img src="{{ my_asset('assets/frontend/default/img/avatar-place.png') }}">
                        @endif
                        <span class="badge badge-dot badge-success badge-circle badge-status"></span>
                    </span>
                    <div class="text-secondary fs-10 mb-1">
                        <i class="las la-star text-warning"></i>
                        <span class="fw-600">
                            {{ formatRating(getAverageRating($chat_thread->sender->id)) }}
                        </span>
                        <span>
                            ({{ getNumberOfReview($chat_thread->receiver->id) }} {{ translate('Reviews') }})
                        </span>
                    </div>
                    <h4 class="h5 mb-2 fw-600">{{ $chat_thread->sender->name }}</h4>
                    <div class="text-center">
                        @foreach ($chat_thread->sender->badges as $key => $user_badge)
                            @if ($user_badge->badge != null)
                                <span class="avatar avatar-square avatar-xxs" title="{{ $user_badge->badge->name }}"><img src="{{ my_asset($user_badge->badge->icon) }}"></span>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="separator my-4"><span class="bg-white px-3 text-black-50">{{ translate('Running Projects With You') }}</span></div>
                <div class="">
                    <ul class="list-group">
                        @php
                            $running_projects = DB::table('projects')
                                                ->where('projects.client_user_id', $chat_thread->sender_user_id)
                                                ->where('projects.biddable', 0)
                                                ->where('projects.closed', 0)
                                                ->where('projects.cancel_status', 0)
                                                ->join('project_users', 'projects.id', '=', 'project_users.project_id')
                                                ->where('project_users.user_id', auth()->user()->id)
                                                ->select('project_users.id')
                                                ->get();
                        @endphp
                        @foreach ($running_projects as $key => $running_project_id)
                            @php
                                $project_user = \App\Models\ProjectUser::find($running_project_id->id);
                            @endphp
                            @if ($project_user->project != null)
                                <li class="list-group-item">
                                    <a href="{{ route('project.details', $project_user->project->slug) }}" target="_blank" class="text-body">{{ $project_user->project->name }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="separator my-4"><span class="bg-white px-3 text-black-50">{{ translate('Completed Campaigns With You') }}</span></div>
                <div class="">
                    <ul class="list-group">
                        @php
                            $completed_projects = DB::table('projects')
                                                ->where('projects.client_user_id', $chat_thread->sender_user_id)
                                                ->where('projects.biddable', 0)
                                                ->where('projects.closed', 1)
                                                ->where('projects.cancel_status', 0)
                                                ->join('project_users', 'projects.id', '=', 'project_users.project_id')
                                                ->where('project_users.user_id', auth()->user()->id)
                                                ->select('project_users.id')
                                                ->get();
                        @endphp
                        @foreach ($completed_projects as $key => $completed_project_id)
                            @php
                                $project_user = \App\Models\ProjectUser::find($completed_project_id->id);
                            @endphp
                            @if ($project_user->project != null)
                                <li class="list-group-item">
                                    <a href="{{ route('project.details', $project_user->project->slug) }}" target="_blank" class="text-body">{{ $project_user->project->name }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
    <div class="modal fade" id="project_submit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ translate('Submit Proof') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <div class="modal-body" id="hiring_modal_body"> 
                    
                    <label class="form-label text-sm">               
                        In order to get paid, you have to provide a link to the social media post you created with your client's content.
                    </label>
                    <form class="project-form" action="" method="post">
                    @csrf 
                    <div class="message text-danger"></div>
                    <div class="form-group row">
                        <div class="col-lg-11">
                        <input type="url" name="social_link" class="form-control form-control-sm radius-10 social_link"  id="social_link" placeholder="https://example.com" pattern="https://">
                        </div>
                        <div class="col-lg-1 p-0 text-center">
                            <i  data-toggle="tooltip" data-placement="top" title="You can usually find a link to the post by clicking on the picture/video details of the post and copying the link" class="bi bi-info-circle"></i>
                        </div>
                        
                    </div>
                        <input type="hidden" name="project_id" id="project_id" value="{{ $chat_thread->project_id }}">
                        <button type="button"  class="btn btn-green transition-3d-hover mr-1 final_submit" >{{ translate('Submit') }}</button>
                        <span style="display:none" id="loading"><img src="{{my_asset('/uploads/images/loading.gif')}}" height="100" width="100" /></span>

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
                <h5 class="modal-title" id="exampleModalLabel">{{ translate('Confirm Dispute') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body" id="disputed-modal-content">
                <h4>Are you sure you want to file this dispute?</h4>
                <form class="form-horizontal" action="{{ route('get_disputed_project_modal') }}" method="POST" enctype="multipart/form-data" id="disputed_form">
                    @csrf
                    <input type="hidden" name="project_id" value="{{$chat_thread->project_id}}">
                    <input type="hidden" name="receiver_user_id" value="{{$chat_thread->receiver_user_id}}">
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-sm btn-primary transition-3d-hover mr-1">{{ translate('Dispute Now') }}</button>
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
            url:"{{ route('projects.submit') }}",  
            type: "POST",
            data: { _token: '{{ csrf_token() }}',message:message,project_id:project_id,url:url},
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
</script>