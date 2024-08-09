@extends('frontend.default.layouts.app')

@section('content')
<style>
    .invalid-feedback{
        display: block;
    }
</style>
    <section class="py-5 client-profile-section fdfsgdf">
        <div class="container">

            <div class="d-flex align-items-start">
                <!-- @include('frontend.default.user.client.inc.sidebar') -->

                <div class="aiz-user-panel p-0">
                     @include('flash::message')
                    <div class="aiz-titlebar mt-2 mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h1 class="h3">{{ translate('Profile Setting') }}</h1>
                            </div>
                        </div>
                    </div>
                    @if ($verification == null)
                        <div class="card">
                            <div class="card-header px-0">
                                <h4 class="h2 font-weight-bold mb-0">{{ translate('Identity Verification') }}</h4>
                            </div>
                        </div>
                    @elseif ($verification != null && $verification->verified == 0)
                        <div class="card">
                            <div class="card-header px-0">
                                <h4 class="h3 font-weight-bold mb-0">{{ translate('Identity Verification') }}</h4>
                            </div>
                            <div class="card-body px-0">
                                <div class="alert alert-info" role="alert">
                                    {{ translate('Your identity verification has not been approved yet.') }}
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-header px-0">
                                <h4 class="h2 font-weight-bold mb-0">{{ translate('Identity Verification') }}</h4>
                            </div>
                            <div class="card-body px-0">
                                <div class="alert alert-success radius-10" role="alert">
                                    {{ translate('Your identity verifed successfully.') }}
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header px-0">
                            <h4 class="h3 font-weight-bold mb-0">{{ translate('Account Info') }}</h4>
                        </div>
                        <div class="card-body px-0">
                            <!-- Personal Info Form -->
                            <form class="js-validate" action="{{ route('user_profile.bio_update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="js-form-message">
                                            <label id="usernameLabel" class="form-label h5 text-dark">{{ translate('Username') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="form-group mb-4 mb-md-0">
                                                <input type="text" class="form-control radius-10" name="username" @if ($user_profile->user->user_name != null) value="{{ $user_profile->user->user_name }}" @endif placeholder="Enter your username" aria-label="Enter your username" required aria-describedby="usernameLabel" data-msg="Please enter your username." data-error-class="u-has-error" data-success-class="u-has-success" readonly>
                                                <small class="form-text text-muted">{{ translate('Only a-z, numbers, hypen allowed') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4 mb-md-0">
                                            <label id="emailLabel" class="form-label h5 text-dark">{{ translate('Email address') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group radius-10 overflow-hidden border">
                                                <input type="email" class="form-control radius-10" name="email" @if ($user_profile->user->email != null) value="{{ $user_profile->user->email }}" @endif placeholder="Enter your email address" aria-label="Enter your email address" required aria-describedby="emailLabel" disabled>
                                                <div class="input-group-append">
                                                    @if ($user_profile->user->email_verified_at == null)
                                                        <a class="btn btn-secondary send_verification"  href="{{ route('email.verification') }}">
                                                            {{ translate('Send Verification Link') }}
                                                        </a>
                                                    @else
                                                        <span class="btn btn-green-lg">
                                                            {{ translate('Verified') }}
                                                            <i class="las la-check"></i>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            @if ($user_profile->user->email_verified_at == null)
                                                <span class="alert alert-danger d-block py-1 mt-1">{{ translate('Verify your email address') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header px-0">
                                        <h4 class="h3 font-weight-bold mb-0">{{ translate('Change Password') }}</h4>
                                    </div>
                                    <div class="card-body px-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-4 mb-md-0">
                                                    <label id="emailLabel" class="form-label h5 text-dark">{{ translate('New Password') }}</label>
                                                     <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" placeholder="{{translate('New Password')}}" >
                                                </div>
                                                @error('new_password')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-4 mb-md-0">
                                                    <label id="nameLabel" class="form-label h5 text-dark">{{ translate('Confirm Password') }}</label>
                                                    <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" placeholder="{{translate('Confirm Password')}}">
                                                </div>
                                                @error('confirm_password')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="text-right mt-4">
                                            <!-- Buttons -->
                                            <button type="submit" class="btn btn-green-lg ">{{ translate('Save Changes') }}</button>
                                            <!-- End Buttons -->
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- End Personal Info Form -->
                        </div>
                    </div>
                   
                    <div class="card">
                        <div class="card-header px-0">
                            <h4 class="h3 font-weight-bold mb-0">{{ translate('Basic Info') }}</h4>
                        </div>
                        <div class="card-body px-0">
                            <!-- Personal Info Form -->
                        <form action="{{ route('user_profile.basic_info_update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div div class="row">
                                    <div class="form-group mb-4 col-md-6">
                                        <label id="nameLabel" class="form-label h5 text-dark">
                                            {{ translate('Name') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control radius-10 @error('name') is-invalid @enderror" name="name" value="{{ $user_profile->user->name }}" placeholder="Enter your name">
                                        <small class="form-text text-muted">{{ translate('Displayed on your public profile, notifications and other places') }}.</small>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                     <div class="form-group mb-4 col-md-6">
                                        <label class="form-label h5 text-dark">
                                            {{ translate('Company Name') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <!-- Input -->
                                         <input type="text" class="form-control radius-10 @error('company_name') is-invalid @enderror" name="company_name" value="{{ $user_profile->company_name }}" placeholder="Enter your name">
                                        <!-- End Input -->
                                        @error('company_name')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-right mt-4">
                                    <!-- Buttons -->
                                    <button type="submit" class="btn btn-green-lg">{{ translate('Save Changes') }}</button>
                                    <!-- End Buttons -->
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header px-0">
                            <h4 class="h3 font-weight-bold mb-0">{{ translate('Profile Images') }}</h4>
                        </div>
                        <form class="js-validate" action="{{ route('user_profile.photo_update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body px-0">
                                <div class="form-group mb-4 mb-md-0">
                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                        </div>
                                        <div class="form-control radius-10 file-amount">{{ translate('Choose File') }}</div>
                                        <input type="hidden" name="profile_photo" class="selected-files" value="{{ $user_profile->user->photo }}">
                                    </div>
                                    <div class="file-preview box">
                                    </div>
                                </div>
                                <div class="text-right mt-4">
                                    <!-- Buttons -->
                                    <button type="submit" class="btn btn-green-lg ">{{ translate('Save Changes') }}</button>
                                    <!-- End Buttons -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection

@section('script')

<script type="text/javascript">
   
    function get_state_by_country(){
        var country_id = $('#country_id').val();
        $.post('{{ route('cities.get_city_by_country') }}',{_token:'{{ csrf_token() }}', country_id:country_id}, function(data){
            $('#state_id').html(null);
            for (var i = 0; i < data.length; i++) {
                $('#state_id').append($('<option>', {
                    value: data[i].id,
                    text: data[i].name
                }));
            }
            $("#state_id > option").each(function() {
                @if(isset($user_profile->user->address->state_id) && !empty($user_profile->user->address->state_id))
                  var st_id = "{{ $user_profile->user->address->state_id}}";
                @else
                   var st_id = '__y';
                @endif
                if(this.value == st_id){
                    $("#state_id").val(this.value).change();
                }
            });

        });
    }

    $(document).ready(function(){
        //get_state_by_city();
    });

    $('#country_id').on('change', function() {
        //get_state_by_city();
    });
    var verify_clicked = 0;
$('.send_verification').on('click',function(e){
    if(verify_clicked==1){ 
        e.preventDefault();
    }
    verify_clicked = 1;
})
</script>

@endsection
