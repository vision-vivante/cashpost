
@extends('frontend.default.layouts.app')

@section('content')
<style>
#loader {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  background: rgba(0,0,0,0.75) url(https://cashpost.net/public/uploads/images/loader1.gif) no-repeat center center;
  z-index: 10000;
}
</style>
@php $date_of_birth = ""; @endphp
@if(isset($user_profile->date_of_birth))
@php 
$date=str_replace('-','/',$user_profile->date_of_birth);
$new_date = strtotime($date);   
$date_of_birth = date ("d M, Y",$new_date); 
@endphp
@endif

    <section class="profile-section fdfsgdf">
        <div class="container">
            @include('flash::message')
            <div class="profile-details border-top">
                <div class="row py-5 justify-content-sm-between justify-content-center">
                    <div class="col-xl-5 col-md-6 col-sm-8 col-7 px-sm-0">
                        <div class="main-detail">
                            <div class="card border-0 shadow-none my-card mb-3">
                                <div class="row align-items-center no-gutters">
                                    <div class="col-sm-4 overflow-hidden mb-3 mb-sm-0">
                                         @if(Auth::user()->photo != null)
                                            <img class="rounded-circle img-fluid" src="{{ custom_asset(Auth::user()->photo) }}">
                                        @else
                                            <img class="rounded-circle img-fluid" src="{{ my_asset('assets/frontend/default/img/avatar-place.png') }}">
                                        @endif
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="card-body py-0">
                                            <h2 class="card-title mb-2 font-weight-bold">{!!ucwords(Auth::user()->name)!!}</h2>
                                            <h6 class="card-text mb-2">{!!Auth::user()->email!!}</h6>
                                            <div class="rating-profile mb-4">
                                                <!-- <span>4.5</span> -->
                                               <!--  <span><i class="bi bi-hand-thumbs-up-fill"></i></span>
                                                <h6 class="text-grey d-inline px-2 m-0">268 reviews</h6> -->
                                            </div>
                                            <div class="my-card-footer h6">
                                                <i class="bi bi-calendar-event"></i>
                                                {!!$date_of_birth!!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-7 col-sm-4">
                        <div class="edit-profile text-center text-sm-left">
                            <a href="{{url('/profile-settings')}}" class="btn-green-lg btn">Edit Profile</a>
                            <a href="{{url('/stripe/add-account')}}" class="btn-green-lg btn mt-2 mt-sm-0 mt-md-2 mt-lg-0">Stripe Connect</a>
                        </div>
                    </div>
                </div>
                <div class="interested-in pb-5 border-bottom">
                    <div class="row">
                        <h2 class="col-12 heading font-weight-bold mb-4">Interested In</h2>
                        <div class="col-12">
                            <div class="row px-3">
                                @if(isset($user_profile->interested_category_id))
                                {!! get_provide_service($user_profile->interested_category_id,'div') !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="text-left" style="padding-top: 10px;">
                    <button type="button" class="btn btn-green-lg" data-toggle="modal" data-target="#mediumModal">
                    {{ ('Edit Social Links') }}
                    </button>
                </div>
               
                <div class="social-link py-5" style=" padding-top: 0px !important;">
                    <h2 class="font-weight-bold mb-3">Social links</h2>
                    @if(isset($user->socialprofile->facebook_url) && $user->socialprofile->facebook_url !=null)
                        <div class="links">
                            <h3 class="font-weigh-bold">Facebook</h3>
                            <div class="row">
                                <div class="col-sm-6 h6"> <a href="{{$user->socialprofile->facebook_url}}" target="_blank" class="link-color">{!!$user->socialprofile->facebook_url!!}</a></div>
                                <div class="col-sm-6 h6 text-sm-left text-right"><span class="text-grey">Followers:</span>&nbsp;{!!$user->socialprofile->facebook_follower!!}</div>
                            </div>
                        </div>
                    @endif
                    @if(isset($user->socialprofile->instagram_url) && $user->socialprofile->instagram_url !=null)
                        <div class="links">
                            <h3 class="font-weigh-bold">Instagram</h3>
                            <div class="row">
                                <div class="col-sm-6 h6"> <a href="{{$user->socialprofile->instagram_url}}" target="_blank" class="link-color">{!!$user->socialprofile->instagram_url!!}</a></div>
                                <div class="col-sm-6 h6 text-sm-left text-right"><span class="text-grey">Followers:</span>&nbsp;{!!$user->socialprofile->instagram_follower!!}</div>
                            </div>
                        </div>
                    @endif
                    @if(isset($user->socialprofile->tiktok_url) && $user->socialprofile->tiktok_url !=null)
                    <div class="links">
                        <h3 class="font-weigh-bold">Tiktok</h3>
                        <div class="row">
                            <div class="col-sm-6 h6"> <a href="{{$user->socialprofile->tiktok_url}}" target="_blank" class="link-color">{!!$user->socialprofile->tiktok_url!!}</a></div>
                            <div class="col-sm-6 h6 text-sm-left text-right"><span class="text-grey">Followers:</span>&nbsp;{!!$user->socialprofile->tiktok_follower!!}</div>
                        </div>
                    </div>
                    @endif
                    @if(isset($user->socialprofile->twitter_url) && $user->socialprofile->twitter_url !=null)
                        <div class="links">
                            <h3 class="font-weigh-bold">Twitter</h3>
                            <div class="row">
                                <div class="col-sm-6 h6"> <a href="{{$user->socialprofile->twitter_url}}}" target="_blank" class="link-color">{!!$user->socialprofile->twitter_url!!}</a></div>
                                <div class="col-sm-6 h6 text-sm-left text-right"><span class="text-grey">Followers:</span>&nbsp;{!!$user->socialprofile->twitter_follower!!}</div>
                            </div>
                        </div>
                    @endif
                    @if(isset($user->socialprofile->youtube_url) &&  $user->socialprofile->youtube_url !=null)
                        <div class="links">
                            <h3 class="font-weigh-bold">You Tube</h3>
                            <div class="row">
                                <div class="col-sm-6 h6"> <a href="{{$user->socialprofile->youtube_url}}" target="_blank" class="link-color">{!!$user->socialprofile->youtube_url!!}</a></div>
                                <div class="col-sm-6 h6 text-sm-left text-right"><span class="text-grey">Subscribers:</span>&nbsp;{!!$user->socialprofile->youtube_follower!!}</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Add/Edit Social Links</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="mediumBody" style="overflow:auto; max-height: calc(80vh - 60px);">
                        <form id="reg-form" method="POST" action="">
                            <div class="form-group">
                                <input type="hidden" name="user_types[]" value="facebook_url">
                                <label class="form-label text-dark h5">{{ translate('Profile URL') }}</label>
                                @php $facebook_url = ""; @endphp
                                @if(isset($user->socialprofile->facebook_url))
                                @php $facebook_url = $user->socialprofile->facebook_url; @endphp
                                @endif
                                <input type="url" class="form-control radius-10" value="{!!$facebook_url!!}" placeholder="https://www.facebook.com/myname" name="facebook_url" >
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="user_types[]" value="facebook_follower">
                            </div>
                            <div class="form-group range-wrap">
                                <label class="h5">{{ translate ('How many followers do you have?') }}</label>
                                <ul class="data-list">
                                    <li>1-100</li>
                                    <li>100-2500</li>
                                    <li>2500-5000</li>
                                </ul>
                                @php $facebook_follower = "0"; @endphp
                                @if(isset($user->socialprofile->facebook_follower))
                                @php $facebook_follower = $user->socialprofile->facebook_follower; @endphp
                                @endif
                                <input type="range" id="input-range" step="1" min="1" max="3" class="p-0 form-control range radius-10 facebook_follower" name="facebook_follower" value="{!!$facebook_follower!!}" list="ranGe">
                                <!-- <output id="bubble" class="bubble"></output> -->
                                <div class="honest-text d-flex justify-content-end text-sm">*Be honest, our brands check</div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="user_types[]" value="instagram_url">
                                <label class="form-label text-dark h5">{{ translate('Profile URL') }}</label>
                                @php $instagram_url = ""; @endphp
                                @if(isset($user->socialprofile->instagram_url))
                                @php $instagram_url = $user->socialprofile->instagram_url; @endphp
                                @endif
                                <input type="url" class="form-control radius-10" value="{!!$instagram_url!!}" placeholder="https://www.instagram.com/myname" name="instagram_url" >
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="user_types[]" value="instagram_follower">
                            </div>
                            <div class="form-group range-wrap">
                                <label class="h5">{{ translate ('How many followers do you have?') }}</label>
                                <ul class="data-list">
                                    <li>1-100</li>
                                    <li>100-2500</li>
                                    <li>2500-10k</li>
                                    <li>10k+</li>
                                </ul>
                                @php $instagram_follower = "0"; @endphp
                                @if(isset($user->socialprofile->instagram_follower))
                                @php $instagram_follower = $user->socialprofile->instagram_follower; @endphp
                                @endif
                                <input type="range" id="input-range" min="1" step="1" max="4" class="form-control radius-10 range instagram_follower p-0" value="{!!$instagram_follower!!}" list="ranGe2" name="instagram_follower">
                                <!-- <output class="bubble"></output> -->
                                <div class="honest-text d-flex justify-content-end">*Be honest, our brands check</div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="user_types[]" value="tiktok_url">
                                <label class="form-label text-dark h5">{{ translate('Profile URL') }}</label>
                                @php $tiktok_url = ""; @endphp
                                @if(isset($user->socialprofile->tiktok_url))
                                @php $tiktok_url = $user->socialprofile->tiktok_url; @endphp
                                @endif
                                <input type="url" class="form-control radius-10" value="{!!$tiktok_url!!}" placeholder="https://www.tiktok.com/myname" name="tiktok_url" >
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="user_types[]" value="tiktok_follower">
                            </div>
                            <div class="form-group range-wrap">
                                <label class="h5">{{ translate ('How many followers do you have?') }}</label>
                                <ul class="data-list">
                                    <li>1-100</li>
                                    <li>100-2500</li>
                                    <li>2500-10k</li>
                                    <li>10k+</li>
                                </ul>
                                @php $tiktok_follower = "0"; @endphp
                                @if(isset($user->socialprofile->tiktok_follower))
                                @php $tiktok_follower = $user->socialprofile->tiktok_follower; @endphp
                                @endif
                                <input type="range" id="input-range" min="1" step="1" max="4" class="form-control radius-10 range tiktok_follower p-0" list="ranGe2" value="{!!$tiktok_follower!!}" name="tiktok_follower">
                                <!-- <output class="bubble"></output> -->
                                <div class="honest-text d-flex justify-content-end">*Be honest, our brands check</div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="user_types[]" value="twitter_url">
                                <label class="form-label text-dark h5">{{ translate('Profile URL') }}</label>
                                @php $twitter_url = ""; @endphp
                                @if(isset($user->socialprofile->twitter_url))
                                @php $twitter_url = $user->socialprofile->twitter_url; @endphp
                                @endif
                                <input type="url" class="form-control radius-10" value="{!!$twitter_url!!}" placeholder="https://www.twitter.com/myname" name="twitter_url" >
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="user_types[]" value="twitter_follower">
                            </div>
                            <div class="form-group range-wrap">
                                <label class="h5">{{ translate ('How many followers do you have?') }}</label>
                                <ul class="data-list">
                                    <li>1-100</li>
                                    <li>100-2500</li>
                                    <li>2500-10k</li>
                                    <li>10k+</li>
                                </ul>
                                @php $twitter_follower = "0"; @endphp
                                @if(isset($user->socialprofile->twitter_follower))
                                @php $twitter_follower = $user->socialprofile->twitter_follower; @endphp
                                @endif
                                <input type="range" id="input-range" min="1" step="1" max="4" class="form-control radius-10 range twitter_follower p-0" list="ranGe2" value="{!!$twitter_follower!!}" name="twitter_follower">
                                <!-- <output class="bubble"></output> -->
                                <div class="honest-text d-flex justify-content-end">*Be honest, our brands check</div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="user_types[]" value="youtube_url">
                                <label class="form-label text-dark h5">{{ translate('Profile URL') }}</label>
                                @php $youtube_url = ""; @endphp
                                @if(isset($user->socialprofile->youtube_url))
                                @php $youtube_url = $user->socialprofile->youtube_url; @endphp
                                @endif
                                <input type="url" class="form-control radius-10" value="{!!$youtube_url!!}" placeholder="https://www.youtube.com/myname" name="youtube_url" >
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="user_types[]" value="youtube_follower">
                            </div>
                            <div class="form-group range-wrap">
                                <label class="h5">{{ translate ('How many subscribers do you have?') }}</label>
                                <ul class="data-list">
                                    <li>1-100</li>
                                    <li>100-2500</li>
                                    <li>2500-10k</li>
                                    <li>10k+</li>
                                </ul>
                                @php $youtube_follower = "0"; @endphp
                                @if(isset($user->socialprofile->youtube_follower))
                                @php $youtube_follower = $user->socialprofile->youtube_follower; @endphp
                                @endif
                                <input type="range" id="input-range" min="1" step="1" max="4" class="form-control radius-10 range youtube_follower p-0" list="ranGe2" value="{!!$youtube_follower!!}" name="youtube_follower">
                                <!-- <output class="bubble"></output> -->
                                <div class="honest-text d-flex justify-content-end">*Be honest, our brands check</div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        @if(isset($user->id))
                        <button type="button" id= "mediumButton" class="btn btn-primary" data-attr="{{ route('edit.social_link', $user->id) }}" >Save changes</button>
                        @endif
                    </div>
                    <div id="loader"style="display:none" role="status">
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
<script>
    // function openMainPopUp(){
    //     let sociallink = $('#social_link').val();
    //     if($('#social_link').val != ''){
    //        // var doctor = select2Value2.value;
    //         console.log(sociallink,'sociallink');
    //         //  $('#myModal').modal('show');
    //             $.ajax({ 
    //             url: baseUrl+'/web/edit_social_link?link_id=' + sociallink,
    //             method: 'GET',
    //             dataType: 'json',
    //             success: function (data) {
    //                 if (data.status == true) {
    //                     $('#ajaxModelData').html(data.html);
    //                 }
    //             },
    //         });
    //     }
    // }

    $(document).on('click', '#mediumButton', function(event) {
        let myForm = document.getElementById('reg-form');
        var formdata = new FormData(myForm);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let sociallink = $('#mediumButton').val();
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href+sociallink,
                type: "POST",
                data: formdata,
                processData: false,
                contentType: false,

                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#mediumModal').modal("hide");
                    location.reload(true);
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page" +href+ "cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });
</script>
@endsection