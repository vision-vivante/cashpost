
@extends('frontend.default.layouts.app')

@section('content')
<style>
    .invalid-feedback{
        display: block;
    }
</style>
    <section class="py-5 client-profile-section">
        <div class="container">
            <div class="d-flex align-items-start">             
                <div class="aiz-user-panel">
                    <div class="aiz-titlebar mt-2 mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h1 class="h3">{{ translate('Profile Settings') }}</h1>
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
                        <div class="card-header">
                            <h4 class="h3 font-weight-bold mb-0">{{ translate('Account Info') }}</h4>
                        </div>
                        <div class="card-body">
                            <!-- Personal Info Form -->
                            <form class="js-validate" action="{{ route('user_profile.bio_update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="js-form-message">
                                            <label id="usernameLabel" class="form-label h5 text-dark">
                                                {{ translate('Username') }}
                                                <span class="text-danger">*</span>
                                            </label>

                                            <div id="uname_response"></div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="username" name="username" @if (isset($user_profile->user->user_name) && $user_profile->user->user_name != null) value="{{ $user_profile->user->user_name }}" @endif placeholder="Enter your username" aria-label="Enter your username" required aria-describedby="usernameLabel" data-msg="Please enter your username." data-error-class="u-has-error" data-success-class="u-has-success" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Input -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="emailLabel" class="form-label h5 text-dark">{{ translate('Email address') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <input type="email" class="form-control" name="email" @if (isset($user_profile->user->email) && $user_profile->user->email != null) value="{{ $user_profile->user->email }}" @endif placeholder="Enter your email address" aria-label="Enter your email address" required aria-describedby="emailLabel" disabled>
                                                <div class="input-group-append">
                                                    @if (isset($user_profile->user->email_verified_at) && $user_profile->user->email_verified_at == null)
                                                        <a class="btn btn-secondary send_verification" href="{{ route('email.verification') }}">
                                                            {{ translate('Send Verification Link') }}
                                                        </a>
                                                    @else
                                                        <span class="btn btn-success">
                                                            {{ translate('Verified') }}
                                                            <i class="las la-check"></i>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            @if (isset($user_profile->user->email_verified_at) && $user_profile->user->email_verified_at == null)
                                                <span class="alert alert-danger d-block py-1 mt-1">{{ translate('Verify your email address') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="js-form-message">
                                            <div class="form-group">
                                                <label id="nameLabel" class="form-label h5 text-dark">{{ translate('New Password') }}</label>
                                                <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" placeholder="{{translate('New Password')}}" >
                                            </div>
                                        </div>
                                        @error('new_password')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="js-form-message">
                                            <div class="form-group">
                                                <label id="nameLabel" class="form-label h5 text-dark">{{ translate('Confirm Password') }}</label>
                                                <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" placeholder="{{translate('Confirm Password')}}">
                                            </div>
                                        </div>
                                        @error('confirm_password')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                <!-- End Input -->
                                <div class="text-right mt-4">
                                    <!-- Buttons -->
                                    <button type="submit" class="btn btn-green-lg">{{ translate('Save Changes') }}</button>
                                    <!-- End Buttons -->
                                </div>

                            </form>
                            <!-- End Personal Info Form -->
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="h3 font-weight-bold mb-0">{{ translate('Basic Info') }}</h4>
                        </div>
                        <div class="card-body">
                            <!-- Personal Info Form -->

                            <form class="js-validate" action="{{ route('user_profile.basic_info_update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="js-form-message">
                                            <div class="form-group">
                                                <label id="nameLabel" class="form-label h5 text-dark">
                                                    {{ translate('Name') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ isset($user_profile->user->name) ? $user_profile->user->name : '' }}" placeholder="Enter your name" aria-label="Enter your name" required aria-describedby="nameLabel" data-msg="Please enter your name." data-error-class="u-has-error" data-success-class="u-has-success">
                                                <small class="form-text text-muted">{{ translate('Displayed on your public profile, notifications and other places') }}.</small>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label h5 text-dark">
                                                {{ translate('Gender') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <!-- Input -->
                                            <select class="form-control aiz-selectpicker" name="gender" required data-minimum-results-for-search="Infinity" data-msg="Please select your gender." data-error-class="u-has-error" data-success-class="u-has-success">
                                                <option value="male" @if ( isset($user_profile->gender) && $user_profile->gender == 'male') selected @endif>Male</option>
                                                <option value="female" @if ( isset($user_profile->gender) && $user_profile->gender == 'female') selected @endif>Female</option>
                                                <option value="other" @if ( isset($user_profile->gender) && $user_profile->gender == 'other') selected @endif>Other</option>
                                            </select>
                                            <!-- End Input -->
                                        </div>
                                    </div>
                                </div>
                                @php  
                                $country=\App\Models\Country::where('code','US')->first();
                                $country_id=(isset($country->id)) ? $country->id : '';
                                @endphp
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label id="nameLabel" class="form-label h5 text-dark">
                                            {{ translate('ethnicity') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="ethnicity" class="form-control radius-10 coustom-select cloned @error('ethnicity') is-invalid @enderror" required>
                                            <option value="">Select </option>
                                            <option value="1"  @if (isset($user_profile->ethnicity) && $user_profile->ethnicity == 1) selected @endif >White</option>
                                            <option value="2"  @if ( isset($user_profile->ethnicity) && $user_profile->ethnicity == 2) selected @endif >African American</option>
                                            <option value="3"  @if (isset($user_profile->ethnicity) && $user_profile->ethnicity == 3) selected @endif >Hispanic</option>
                                            <option value="4"  @if (isset($user_profile->ethnicity) && $user_profile->ethnicity == 4) selected @endif>Asian</option>
                                            <option value="5"  @if (isset($user_profile->ethnicity) && $user_profile->ethnicity == 5) selected @endif >Native American</option>
                                            <option value="6"  @if (isset($user_profile->ethnicity) && $user_profile->ethnicity == 6) selected @endif>Other</option>
                                            <option value="7"  @if (isset($user_profile->ethnicity) && $user_profile->ethnicity == 7) selected @endif>Didn't Specify</option>
                                        </select>
                                        @error('ethnicity')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label class="form-label text-dark h5">
                                            {{ translate('Religion') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="religion" class="form-control radius-10 coustom-select cloned @error('religion') is-invalid @enderror" required>
                                            <option>Select</option>
                                            <option value="1" @if ( isset($user_profile->nationality) && $user_profile->nationality == 1) selected @endif>Christian</option>
                                            <option value="2" @if ( isset($user_profile->nationality) && $user_profile->nationality == 2) selected @endif >Muslim</option>
                                            <option value="3" @if ( isset($user_profile->nationality) && $user_profile->nationality == 3) selected @endif>Buddist</option>
                                            <option value="4" @if ( isset($user_profile->nationality) && $user_profile->nationality == 4) selected @endif>Other</option>
                                            <option value="5" @if ( isset($user_profile->nationality) && $user_profile->nationality == 5) selected @endif>Didn't Specify</option>
                                        </select>  
                                        @error('religion')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror                                 
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="hidden" name="country_id" id="country_id" value="{{$country_id}}"> 
                                        <label for="state_id" class="form-label h5 text-dark" >{{translate('State')}}</label>
                                        <select class="form-control aiz-selectpicker" name="state_id" id="state_id" data-live-search="true" required>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label for="city_name" class="form-label h5 text-dark">{{translate('City Name')}}
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" id="city_name" name="city_name" @if (isset($user_profile->user->address->city_name) && $user_profile->user->address->city_name != null) value="{{ $user_profile->user->address->city_name }}" @endif required placeholder="{{ translate('City Name') }}" class="form-control @error('city_name') is-invalid @enderror">
                                    </div>
                                    @error('city_name')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                    <div class="col-lg-4">
                                        <label id="nameLabel" class="form-label h5 text-dark">
                                            {{ translate('Address') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" @if (isset($user_profile->user->address->street) && $user_profile->user->address->street != null) value="{{ $user_profile->user->address->street }}" @endif placeholder="Enter your street address" required aria-describedby="nameLabel">
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="city_name" class="form-label h5 text-dark">{{translate('Zipcode')}}
                                            <span class="text-danger">*</span>
                                        </label>

                                        <input type="text" id="postal_code" name="zipcode" @if (isset($user_profile->user->address->postal_code) && $user_profile->user->address->postal_code != null) value="{{ $user_profile->user->address->postal_code }}" @endif required placeholder="{{ translate('Zip Code') }}" class="form-control @error('postal_code') is-invalid @enderror">
                                    </div>
                                    @error('postal_code')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="text-right">
                                    <!-- Buttons -->
                                    <button type="submit" class="btn btn-green-lg">{{ translate('Save Changes') }}</button>
                                    <!-- End Buttons -->
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="h3 font-weight-bold mb-0">{{ translate('Profile Images') }}</h4>
                        </div>
                        <form class="js-validate" action="{{ route('user_profile.photo_update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">{{ translate('Profile Image') }}</label>
                                    <div class="input-group " data-toggle="aizuploader" data-type="image">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                        </div>
                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                        <input type="hidden" name="profile_photo" class="selected-files" value="{{ isset($user_profile->user->photo) ? $user_profile->user->photo : '' }}">
                                    </div>
                                    <div class="file-preview"></div>
                                </div>
                                <div class="text-right mt-4">
                                    <!-- Buttons -->
                                    <button type="submit" class="btn btn-green-lg">{{ translate('Save Changes') }}</button>
                                    <!-- End Buttons -->
                                </div>
                            </div>
                        </form>
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
        get_state_by_country();
    });

    $('#country_id').on('change', function() {
        get_state_by_country();
    });

   /* $("#username").keyup(function(){
        var username = $("#username").val().trim();
        if(username != '')
        {
            $.post('{{ route('user_name_check') }}',{_token:'{{ csrf_token() }}', username:username}, function(data){
                $('#uname_response').html(data);
            });
        }
    });*/
    var verify_clicked = 0;
$('.send_verification').on('click',function(e){
    if(verify_clicked==1){ 
        e.preventDefault();
    }
    verify_clicked = 1;
})
</script>

@endsection
