@extends('frontend.default.layouts.app')

@section('content')

    @php
        $profile = \App\Models\UserProfile::where('user_id', $project->client_user_id)->where('user_role_id', 3)->first();
        $brand_name=get_brand_name($project->client_user_id);
        $due_date=date('d/m/Y', strtotime($project->end_date));
        $extra_url=$project->extra_url;
        $description=$project->description;
        $image_id=ProjectCategory($project->project_category_id)->photo;
        $project_name=ProjectCategory($project->project_category_id)->name;
        $client_photo = user_profile_pic($project->client_user_id);
        $content_type=$project->content_type;
        $extra_url=$project->extra_url;
    @endphp
    <div class="find-job-detail py-5">
        <section class="offer-detai-section">
            <div class="container">
                <div class="row my-border position-relative">
                    <div class="col-md-8">
                        <div class="offer-detail-para">
                            <div class="container p-0">
                                
                                <div class="para-1">
                                    <h2 class="font-weight-bold mb-3">{{$project->name}}</h2>
                                    <h4 href="{{$project->excerpt}}" class="d-flex align-items-center text-grey" >
                                        <div class="px-1">
                                            
                                            @if(custom_asset($client_photo))
                                                <img src="{{ custom_asset($client_photo) }}" width="50" height="50" alt="">
                                            @else
                                                <img src="{{ my_asset('assets/frontend/default/img/campaign.jpeg') }}" width="50" height="50" alt="">
                                            @endif
                                        </div>
                                        <div>
                                        <h3 class="mb-0 font-weight-bold">Caption</h3>
                                        <span class="project_caption">{{$project->excerpt}}</span>
                                        </div>
                                    </h4>
                                    

                                    <h6 class="text-grey mt-3"> {!!$description!!}</h6>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="offer-content">
                            <h3 class="heading fw-600">Offer Details</h3>
                            <ul class="detail-list p-0">
                                <li class="point-1">
                                    <div class="points-detail pb-4">
                                        <h6 class="fw-600">Brand Name</h6>
                                        <h6 class="title text-grey"><span><i class="bi bi-box-seam"></i></span> {{$brand_name}}</h6>
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
                            @if (!Auth::check())
                                <div class="alert alert-info" role="alert">
                                    {{ translate('You need to login as a freelancer to bid the project.') }}
                                </div>
                            @elseif (Auth::check() && auth()->user()->user_type == 'admin')
                                <div class="alert alert-info" role="alert">
                                    {{ translate('You are visiting this details as an Admin. For place a bid you need to have a freelancer account.') }}
                                </div>
                            @elseif (Auth::check() && isFreelancer() && !$project->private)
                                @php
                                    $allow_for_bid = \App\Models\ProjectBid::where('project_id', $project->id)->where('bid_by_user_id', Auth::user()->id)->where('status','!=','2')->first();
                                    $invitation = \App\Models\HireInvitation::where('project_id', $project->id)->where('sent_to_user_id', Auth::user()->id)->first();
                                    $ProjectUser = \App\Models\ProjectUser::where('project_id', $project->id)->where('user_id', Auth::user()->id)->first();
                                @endphp
                                @if(!empty(Auth::user()->profile->stripe_account))
                                    @if ($allow_for_bid == null)
                                        @if(empty($ProjectUser) && $invitation!=null)
                                            <a href="javascript:void(0)" class="btn btn-block btn-green-lg mt-4 hhhh" onclick="bid_modal({{ $project->id }})">
                                                @if(getInvitationforProjectCount($project->id))
                                                    {{ translate('Apply') }} 
                                                @else
                                                    {{ translate('Apply') }} 
                                                @endif
                                            </a>
                                        @elseif($project->deleted_at==null)
                                            <a href="javascript:void(0)" class="btn btn-block btn-green-lg mt-4 eee" onclick="bid_modal({{ $project->id }})">
                                                    {{ translate('Apply') }}
                                                </a>
                                        @else
                                            @if($invitation!=null)
                                                <a href="javascript:void(0)" class="btn btn-block btn-green-lg mt-4 asd" onclick="bid_modal({{ $project->id }})">
                                                    {{ translate('Apply') }}
                                                </a>
                                            @endif
                                        @endif
                                    @else
                                        <div class="alert alert-info m-2" role="alert">
                                            {{ translate('You have already submitted a bid for this campaign.') }}
                                        </div>
                                    @endif
                                @else
                                    <a href="{{ route('stripe.bank_account')}}" class="btn btn-block btn-green-lg mt-4 hhhh">{{ translate('Apply') }}</a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
@section('script')
    <script type="text/javascript">
        function bid_modal(id){
            $.post('{{ route('get_bid_for_project_modal') }}', { _token: '{{ csrf_token() }}', id:id }, function(data){
                $('#bid_for_project').modal('show');
                $('#bid_for_modal_body').html(data);
            })
        }
    </script>
@endsection
@section('modal')
    <div class="modal fade" id="bid_for_project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content apply-model">
                <div class="modal-header">
                    <h3 class="modal-title fw-600" id="exampleModalLabel">{{ translate('Place Your Bid') }}</h3>
                    <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" id="bid_for_modal_body">

                </div>
            </div>
        </div>
    </div>

@include('frontend.default.partials.video_modal')
@endsection



