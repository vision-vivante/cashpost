    
@php
    $project_name=ProjectCategory($project->project_category_id)->name;
@endphp
    <div class="col-md-4">
        <div class="offer-content">
            <h3 class="heading fw-600">Offer Details</h3>
            <ul class="detail-list p-0">
                <li class="point-1">
                    <div class="points-detail pb-4">
                        <h6 class="fw-600">Brand Name</h6>
                        <h6 class="title text-grey"><span><i class="bi bi-box-seam"></i></span> {!!get_brand_name($project->client_user_id)!!} </h6>
                    </div>
                </li>
                <li class="point-1">
                    <div class="points-detail pb-4">
                        <h6 class="fw-600">Platform</h6>
                        <h6 class="title text-grey"><span><i class="bi bi-box-seam"></i></span> {{$project_name}}</h6>
                    </div>
                </li>
                @if($project->content_type==1)
                    <li class="point-3">
                        <div class="points-detail pb-3">
                            <h6 class="fw-600">Content</h6>
                            <h6 class="title text-grey"><span><i class="bi bi-box"></i></span>{{$project->extra_url}}</h6>
                        </div>
                    </li>
                @elseif(is_numeric($project->extra_url) && $project->content_type==2)
                    @php  
                        $content_src="Image";
                        $url=custom_asset($project->extra_url);
                        $extension = pathinfo($url, PATHINFO_EXTENSION);
                        $video_ext=array("mp4","mov","wmv","avi","flv","mkv","webm","3gp","MOV");
                        if(in_array($extension,$video_ext)){
                            $content_src="Video";
                        }
                    @endphp
                     <li class="point-3">
                        <div class="points-detail pb-3">
                            <h6 class="fw-600">Content <a href="{{$url}}" download><i class="bi bi-download" style="margin-left:15px; color:black"></i></a></h6>
                            <h6 class="title text-grey video-btn" data-bs-toggle="modal" data-type="{{$content_src}}" data-src="{{$url}}" data-bs-target="#myModal" style="cursor:pointer;"><span><i class="bi bi-box"></i></span> {{$content_src}} </h6>
                        </div>
                     
                    </li>
                @endif
            </ul>
        </div>
        <div class="mb-5">
            @if(Auth::check() && isClient())
                <a href="{{ route('private_projects') }}" class="btn btn-green-lg btn-block">{{ translate('Invites') }} ({{getInvitationforProjectCount($project->id)}})</a>

                <a href="{{route('projects.my_running_project', 'project='.$project->slug)}}" class="btn btn-green-lg btn-block">{{ translate('Hired') }} ({{ProjectGetHired($project->slug)}}) </a>

               <!--  <a href="{{ route('hiring.reject', $project->id) }}" class="btn btn-green-lg bg-danger btn-block">{{ translate('Reject') }} -->
                <a href="{{ route('project.bids', 'project='.$project->slug) }}" class="btn btn-green-lg bg-danger btn-block">{{ translate('Bids') }}  ({{ProjectGetBids($project->slug)}}) </a>
                </a>
            @elseif(Auth::check() && isFreelancer())
                @if(getCompletedProjects($project))
                   <div class="alert alert-info m-2" role="alert">
                        {{ translate('You have already comnplete this Project.') }}
                    </div>
                @else
                    @if(ProjectGetHired($project->slug)==0)
                        @php 
                            $invited_project = \App\Models\HireInvitation::where('project_id',$project->id)->where('sent_to_user_id',Auth::user()->id)->where('status','pending')->first();
                        @endphp
                        @if($invited_project != null)
                            <a href="javascript:void(0)" class="btn btn-block btn-green-lg mt-4" onclick="bid_modal({{ $project->id }})">{{ translate('Invite / Accept') }}</a>
                        @else
                            @php
                                $allow_for_bid = \App\Models\ProjectBid::where('project_id', $project->id)->where('bid_by_user_id', Auth::user()->id)->where('status','!=','2')->first();
                            @endphp
                            @if ($allow_for_bid == null)
                                <a href="javascript:void(0)" class="btn btn-block btn-green-lg mt-4" onclick="bid_modal({{ $project->id }})">{{ translate('Bid') }}</a>
                            @else
                                <div class="alert alert-info m-2" role="alert">
                                    {{ translate('You have already submitted a bid for this campaign.') }}
                                </div>
                            @endif
                        @endif 
                    @else
                        <a href="javascript:void(0)" class="btn btn-block btn-green-lg mt-4">{{ translate('Hired') }}</a>
                    @endif
                @endif
            @endif
        </div>
    </div>
    @section('script')
        <script type="text/javascript">
            function bid_modal(id){
                $.post('{{ route('get_bid_for_project_modal') }}', { _token: '{{ csrf_token() }}', id:id }, function(data){
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
    @endsection
    @section('modal')
    <div class="modal fade" id="bid_for_project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ translate('Bid For Project') }}</h5>
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
    @include('frontend.default.partials.bookmark_remove_modal')
    @endsection
