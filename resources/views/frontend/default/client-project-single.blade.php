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
    @endphp

    <div class="find-job-detail chat-section">
        <section class="offer-detai-section">
            <div class="container">
                <div class="row border-top pt-4 position-relative">
                    <!-- <div class="col-md-8">
                        <div class="offer-image">
                            <img src="{{ custom_asset($client_photo) }}" alt="" class="img-fluid radius-10">
                            <h6 class="text-grey d-flex align-items-center py-3"><span class="px-1"><img src="{{ custom_asset($image_id) }}" width="25" height="25" alt=""></span>{{$project->excerpt}}</h6>
                        </div>
                        <div class="offer-detail-para">
                            <div class="container">
                                <div class="para-1">
                                    <h2 class="font-weight-bold mb-3">{{$project->name}}</h2>
                                    <h6 class="text-grey mb-5"> {!!$description!!}</h6>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-md-8">
                        <div class="offer-detail-para">
                            <div class="container p-0">
                                <div class="para-1">
                                    <h2 class="font-weight-bold mb-3">{{$project->name}}</h2>
                                    <h4 href="{{$project->excerpt}}" class="d-flex align-items-center text-grey">
                                        <div class="px-1">
                                            
                                            @if(custom_asset($client_photo))
                                                <img src="{{ custom_asset($client_photo) }}" width="50" height="50" alt="">
                                            @else
                                                <img src="{{ my_asset('assets/frontend/default/img/campaign.jpeg') }}" width="50" height="50" alt="">
                                            @endif
                                        </div>
                                        <div>
                                            <h3 class="mb-0 font-weight-bold"><b>Caption</b></h3><span class="project_caption">{{$project->excerpt}}</span>
                                        </div>
                                    </h4>

                                    <h6 class="text-grey mt-3"> {!!$description!!}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('frontend.default.inc.chat_sidebar')
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
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ translate('Place Your Bid') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body" id="bid_for_modal_body">

            </div>
        </div>
    </div>
</div>
@include('frontend.default.partials.bookmark_remove_modal')
@endsection
