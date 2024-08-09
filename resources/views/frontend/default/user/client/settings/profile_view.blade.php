
@extends('frontend.default.layouts.app')

@section('content')

    <section class="profile-section">
        <div class="container">
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
                                            <h2 class="card-title mb-2 font-weight-bold">{{ Auth::user()->name}}</h2>
                                            <h6 class="card-text mb-2">{{Auth::user()->email}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-7 col-sm-4">
                        <div class="edit-profile text-center text-sm-left">
                            <a href="{{url('/profile-settings')}}" class="btn-green-lg btn">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')

<script type="text/javascript">

    function get_city_by_country(){
        var country_id = $('#country_id').val();
        $.post('{{ route('cities.get_city_by_country') }}',{_token:'{{ csrf_token() }}', country_id:country_id}, function(data){
            $('#city_id').html(null);
            for (var i = 0; i < data.length; i++) {
                $('#city_id').append($('<option>', {
                    value: data[i].id,
                    text: data[i].name
                }));
            }
		    $("#city_id > option").each(function() {
		        if(this.value == '{{$user_profile->user->address->city_id}}'){
		            $("#city_id").val(this.value).change();
		        }
            });

        });
    }

    $(document).ready(function(){
        get_city_by_country();
    });

    $('#country_id').on('change', function() {
        get_city_by_country();
    });

    /*$("#username").keyup(function(){
        var username = $("#username").val().trim();
        if(username != '')
        {
            $.post('{{ route('user_name_check') }}',{_token:'{{ csrf_token() }}', username:username}, function(data){
                $('#uname_response').html(data);
            });
        }
    });*/


</script>

@endsection
