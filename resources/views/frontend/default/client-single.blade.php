@extends('frontend.default.layouts.app')

@section('content')
<div class="influencer-detail-page">
    <div class="main-influencer">
        <div class="container">
            <div class="border-bottom border-top card influencer-main-card pt-4 pb-5 ">
                <div class="card-body p-0">
                    <div class="media d-block">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="influencer-img">
                                    @if(custom_asset($client->photo))
                                        <img class="img-fluid radius-10" src="{{ custom_asset($client->photo) }}">
                                    @else
                                        <img class="img-fluid radius-10" src="{{ my_asset('assets/frontend/default/img/avatar-place.png') }}">
                                    @endif
                                    <!-- <span class="badge badge-dot badge-circle badge-success badge-status badge-md"></span> -->
                                </div>
                            </div>
                            <div class="media-body col-lg-9 mt-3">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h2 class="mb-2 font-weight-bold">{{ $client->name }}
                                           <!--  @if ((isset($client->profile->gender)) && $client->profile->gender== 'male')
                                                <span class="male-icon"><i class="bi bi-gender-male"></i></span>
                                            @elseif((isset($client->profile->gender)) && $client->profile->gender == 'female')
                                                <span class="female-icon"><i class="bi bi-gender-female"></i></span>
                                            @elseif((isset($client->profile->gender)) && $client->profile->gender == 'other')
                                                <span class="transgender-icon">
                                                <i class='bi bi-gender-trans text-danger'></i>
                                                </span>
                                            @endif -->
                                        </h2>
                                        <h6 class="text-grey age"><i class="bi bi-person"></i>{!!user_age($user_profile->date_of_birth)!!}</h6>

                                        <div class="followers-list mb-3 mt-4">
                                            <h1 class="h3 fw-600 mb-2">{{ translate('Followers') }}</h1>
                                            <div class="social-icon h4 text-grey">
                                                @if(isset($client->socialprofile->facebook_url) && $client->socialprofile->facebook_url !=null)
                                                <span><img class="img-fluid rounded-circle" width="18" height="18" src="{{ my_asset('uploads/all/facebook.svg') }}">{{ $client->socialprofile->facebook_follower }}</span>
                                                @endif

                                                @if(isset($client->socialprofile->instagram_url) && $client->socialprofile->instagram_url !=null)
                                                <span><img class="img-fluid rounded-circle" width="18" height="18" src="{{ my_asset('uploads/all/insta.svg') }}">{{ $client->socialprofile->instagram_follower }}</span>
                                                @endif

                                                @if(isset($client->socialprofile->twitter_url) && $client->socialprofile->twitter_url !=null)
                                                <span><img class="img-fluid rounded-circle" width="18" height="18" src="{{ my_asset('uploads/all/twitter.svg') }}">
                                                {{ $client->socialprofile->twitter_follower }}</span>
                                                @endif

                                                @if(isset($client->socialprofile->youtube_url) && $client->socialprofile->youtube_url !=null)
                                                <span><img class="img-fluid rounded-circle" width="18" height="18" src="{{ my_asset('uploads/all/play.svg') }}">
                                                {{ $client->socialprofile->youtube_follower }}</span>
                                                @endif

                                                @if(isset($client->socialprofile->tiktok_url) && $client->socialprofile->tiktok_url !=null)
                                                <span><img class="img-fluid rounded-circle" width="18" height="18" src="{{ my_asset('uploads/all/tiktok.svg') }}">
                                                    {{ $client->socialprofile->tiktok_follower }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                @if(isset($client->profile->nationality) && $client->profile->nationality)
                                                    <div class="interested-in">
                                                        <h3 class="mb-2 fw-600">{{ translate('Religion') }}</h3>
                                                        <div class="interested-fields mt-2">
                                                         
                                                            @if ($client->profile->nationality == 1) Christian @endif 
                                                            @if ($client->profile->nationality== 2) Muslim @endif 
                                                            @if ($client->profile->nationality== 3) Buddhist @endif 
                                                            @if ($client->profile->nationality == 4) Other @endif
                                                            @if ($client->profile->nationality == 5) Rather Not Say @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                @if(isset($client->profile->ethnicity) && $client->profile->ethnicity)
                                                    <div class="interested-in">
                                                        <h3 class="mb-2 fw-600">{{ translate('Ethnicity') }}</h3>
                                                        <div class="interested-fields mt-2">
                                                            @if ($client->profile->ethnicity == 1) White @endif 
                                                            @if ($client->profile->ethnicity== 2) African American @endif 
                                                            @if ($client->profile->ethnicity== 3) Hispanic @endif 
                                                            @if ($client->profile->ethnicity == 4) Asian @endif
                                                            @if ($client->profile->ethnicity == 5) Native American @endif
                                                            @if ($client->profile->ethnicity == 6) Other @endif
                                                            @if ($client->profile->ethnicity == 7) Rather Not Say @endif
                                                        </div>
                                                    </div>
                                                @endif 
                                            </div>
                                            <div class="col-md-4">
                                                @if(isset($client->address->state_id) && $client->address->state_id)
                                                    <div class="interested-in">
                                                        <h3 class="mb-2 fw-600">{{ translate('State') }}</h3>
                                                        <div class="interested-fields mt-2">
                                                          {!!get_states($client->address->state_id)!!}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        @if(isset($client->profile->interested_category_id) && $client->profile->interested_category_id)
                                            <div class="interested-in">
                                                <h3 class="mb-2 fw-600">{{ translate('Interested In') }}</h3>
                                                <div class="interested-fields mt-2">
                                                    {!! get_provide_service($client->profile->interested_category_id,'span') !!}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-3 mt-3 d-flex justify-content-md-end align-items-center">
                                        <a href="javascript:void(0)" class="btn btn-green-lg" onclick="hire_modal({{$client->id}})">{{ translate('
                                        Hire Now') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

                                                                                    
    <div class="hire-influencer-cards">
        <div class="container">
            <h2 class="font-weight-bold mb-4 mt-5">{{translate('Other Influencers you may like')}}</h2>
            <div class="row">
                @foreach($influencer_users as $key => $user)
                <div class="col-lg-6 p-sm-0 col-sm-6 hire-influencer-card-main">
                        <div class="card job-card">
                            <div class="card-body row p-2">
                                <div class="list-img p-0 col-md-4 col-sm-12 col-4">
                                    @if(custom_asset($user->photo))
                                        <img class="img-fluid radius-10" src="{{ custom_asset($user->photo) }}">
                                    @else
                                        <img class="img-fluid radius-10" src="{{ my_asset('assets/frontend/default/img/avatar-place.png') }}">
                                    @endif
                                </div>
                                <div class="col-md-8 col-sm-12 col-8">
                                    <div class="card-main d-flex align-items-center justify-content-between mt-lg-0 mt-sm-2 mt-3">
                                        <h3 class="font-weight-bold">
                                            <a class="text-dark" href="{{ route('influencer.detail', $user->user_name) }}">{{$user->name}}
                                                @if ((isset($user->profile->gender)) && $user->profile->gender== 'male')
                                                        <span class="male-icon"><i class="bi bi-gender-male"></i></span>
                                                    @elseif((isset($user->profile->gender)) && $user->profile->gender == 'female')
                                                        <span class="female-icon"><i class="bi bi-gender-female"></i></span>
                                                    @elseif((isset($user->profile->gender)) && $user->profile->gender == 'other')
                                                        <span class="transgender-icon">
                                                        <i class='bi bi-gender-trans text-danger'></i>
                                                        </span>
                                                    @endif
                                            </a></h3>
                                        
                                        <a href="javascript:void(0)" class="btn-green-lg" onclick="hire_modal({{ $user->id }})">{{ translate('Hire') }}</a>
                                    </div>
                                    <div class="social-img-list mt-4">
                                        <ul class="p-0">
                                            @if(isset($user->facebook_follower) &&  $user->facebook_follower!=null)
                                                <li> 
                                                    <a href="#" data-href="facebook" class="facebook h4" title="Facebook"><img class="img-fluid rounded-circle" width="18" height="18" src="{{ my_asset('uploads/all/facebook.svg') }}">{{ $user->facebook_follower }}</a>
                                                </li>
                                            @endif
                                            @if(isset($user->instagram_follower) && $user->instagram_follower!=null)
                                            <li> 
                                                <a href="#" data-href="instagram" class="instagram h4" title="instagram"><img class="img-fluid rounded-circle" width="18" height="18" src="{{ my_asset('uploads/all/facebook.svg') }}">{{$user->instagram_follower}}</a>
                                            </li>
                                            @endif
                                            @if(isset($user->tiktok_follower) && $user->tiktok_follower!=null)
                                            <li>
                                                <a href="#" data-href="tiktok" class="tiktok h4" title="tiktok"><img class="img-fluid rounded-circle" width="18" height="18" src="{{ my_asset('uploads/all/insta.svg') }}">{{$user->tiktok_follower}}</a>

                                            </li>
                                            @endif
                                            @if(isset($user->twitter_follower) &&  $user->twitter_follower!=null)
                                            <li>
                                                <a href="#" data-href="twitter" class="twitter h4" title="twitter"><img class="img-fluid rounded-circle" width="18" height="18" src="{{ my_asset('uploads/all/twitter.svg') }}">{{$user->twitter_follower}}</a>
                                            </li>
                                            @endif
                                            @if(isset($user->youtube_follower) && $user->youtube_follower!=null)
                                            <li>
                                                <a href="#" data-href="youtube" class="youtube h4" title="youtube"><img class="img-fluid rounded-circle" width="18" height="18" src="{{ my_asset('uploads/all/play.svg') }}">{{$user->youtube_follower}}</a>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach         
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
    function hire_modal(id){
        $.post('{{ route('get_hire_for_project_modal') }}', { _token: '{{ csrf_token() }}', id:id }, function(data){
            $('#hire_for_project').modal('show');
            $('#hire_for_modal_body').html(data);
        })
    }
</script> 
@endsection
@section('modal')
<div class="modal my-hire-modal fade" id="hire_for_project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content hire-modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ translate('Hire Influencer') }}</h5>
                <button type="button" class="close m-0" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body" id="hire_for_modal_body">

            </div>
        </div>
    </div>
</div>
@endsection

