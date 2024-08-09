@extends('frontend.default.layouts.app')


@section('content') 

<section class="bank-detail-section">
        <div class="container">
            <div class="d-flex align-items-start">
                <div class="aiz-user-panel p-0">
                    @include('flash::message')
                    <div class="aiz-titlebar total-earning border-top py-5">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <h2 class="font-weight-bold heading mb-3">{{ translate('Payouts') }}</h2>
                                <a href="/wallet">
                                <div class="payment-card">
                                    <div class="card my-card p-4 mb-0 h-100">
                                        <div class="row no-gutters">
                                        <div class="col-4 px-2">
                                            <img src="../public/uploads/all/money.png" alt="..." class="img-fluid">
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body p-0">
                                            <h2 class="text-dark font-weight-bold">{{ isset(Auth::user()->profile->balance) ? Auth::user()->profile->balance : 0 }}</h2>
                                            <p class="text-grey mb-0">{{translate('Total earnings')}}</p>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    @if( !isset($user_profile->stripe_account) || (isset($user_profile->stripe_account) && $user_profile->stripe_account == null) )
                        <div class="card bank-detail py-4 mb-0 border-top add-account-button">
                            <div class="card-header border-0 px-0 align-items-start flex-column flex-sm-row">
                                <div class="order-last order-sm-first">
                                    <h3 class="heading font-weight-bold">Bank Account</h3>
                                    <h6 class="subtitle text-grey mb-4">Add a bank account to receive payments.</h6>
                                </div>
                                <h3 class="powred-by mb-sm-0 mb-4"> Powered by<span class="fw-800"> stripe</span></h3>
                            </div>
                            <div class="add-btn"><button class="btn btn-green-lg add-account">Add Account</button></div>
                        </div> 
                                          
                            <div class="card bank-detail py-4 border-top add-bank-detail" style="display:none">
                            <div class="card-header border-0 px-0 align-items-start flex-column flex-sm-row">
                                <div class="order-last order-sm-first">
                                    <h3 class="heading font-weight-bold">{{ translate('Bank Account') }}</h3>
                                    <h6 class="subtitle text-grey">Add your bank account for receiving payment.</h6>
                                    <!-- <div class="process-point d-inline-flex position-relative mt-5">
                                        <div class="first-point d-flex align-items-center flex-column">
                                            <h6 class="text-white bg position-relative d-flex align-items-center justify-content-center z-99 fw-600">1</h6>
                                            <h6 class="mt-2 fw-600">Bank Details</h6>
                                        </div>  
                                        <div class="second-point d-flex align-items-center flex-column">
                                            <h6 class="text-grey bg position-relative d-flex align-items-center justify-content-center z-99 fw-600">2</h6>
                                            <h6 class="text-grey mt-2">Upload ID</h6>
                                        </div>  
                                    </div> -->
                                </div>
                                <h3 class="powred-by mb-sm-0 mb-4"> Powered by<span class="fw-800"> stripe</span></h3>
                            </div>
                            <div class="card-body my-bank-body px-0">
                                <form class="form-horizontal"  method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="js-form-message">
                                            <div class="form-group mb-4">
                                                <label id="nameLabel" class="form-label h5">
                                                    {{ translate('First Name') }}
                                                </label>
                                                <input type="text" class="form-control radius-10 @error('first_name') is-invalid @enderror" name="first_name" placeholder="Enter first name" value="{{ old('first_name',$account_data['first_name']) }}" >
                                                @error('first_name')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="js-form-message">
                                            <div class="form-group mb-4">
                                                <label id="nameLabel" class="form-label h5">
                                                    {{ translate('Last Name') }}
                                                </label>
                                                <input type="text" class="form-control radius-10 @error('last_name') is-invalid @enderror" name="last_name" placeholder="Enter last name" value="{{ old('last_name',$account_data['last_name']) }}" >
                                                @error('last_name')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="js-form-message">
                                            <div class="form-group col-8 p-0 mb-4">
                                                <label id="nameLabel" class="form-label h5">
                                                    {{ translate('Gender') }}
                                                </label>
                                                 <div class="d-flex justify-content-between py-1">
                                                    <label for="male" class="m-0 form-label h5">Male</label>

                                                    <input id="male" type="radio" class="@error('gender') is-invalid @enderror" name="gender" value="male" placeholder="Enter account holder name" @if('male'==old('gender')) checked @endif >
                                                </div>
                                                <div class="d-flex justify-content-between py-1">
                                                    <label for="female" class="m-0 form-label h5">Female</label>
                                                    <input id="female" type="radio" class="@error('gender') is-invalid @enderror" name="gender" value="female" placeholder="Enter account holder name" @if('female'==old('gender')) checked @endif>
                                                </div>
                                                @error('gender')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="js-form-message">
                                            <div class="form-group mb-4">
                                                <label id="nameLabel" class="form-label h5">
                                                    {{ translate('Date of Birth') }}
                                                </label>
                                                <input type="text" class="aiz-date-range form-control radius-10  @error('dob') is-invalid @enderror" data-format="MM-DD-YYYY" name="dob" placeholder="MM-DD-YYYY" data-future-disable="true" data-single="true"  data-show-dropdown="true" data-last-date="{{$max_date}}" autocomplete="off"  value="{{ old('dob',$account_data['dob']) }}" readonly/><i class="bi bi-calendar my-calender position-absolute"></i></span>
                                                @error('dob')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="js-form-message">
                                            <div class="form-group mb-4">
                                                <label id="nameLabel" class="form-label h5">
                                                    {{ translate('City') }}
                                                </label>
                                                <input type="text" class="form-control radius-10 @error('city') is-invalid @enderror" name="city" placeholder="Enter city name" value="{{ old('city', $account_data['city']) }}" >
                                                @error('city')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @php  
                                    $country=\App\Models\Country::where('code','US')->first();
                                    $country_id=(isset($country->id)) ? $country->id : '';
                                    @endphp
                                   
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="js-form-message">
                                            <div class="form-group mb-4">
                                                <label id="nameLabel" class="form-label h5">
                                                    {{ translate('State') }}
                                                </label>
                                                <input type="hidden" name="country_id" id="country_id" value="{{$country_id}}"> 
                                               

                                                <select class="form-control aiz-selectpicker @error('state') is-invalid @enderror" name="state" id="state_id" data-live-search="true" required>

                                                </select>
                                                @error('state')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="js-form-message">
                                            <div class="form-group mb-4">
                                                <label id="nameLabel" class="form-label h5">
                                                    {{ translate('Address 1') }}
                                                </label>
                                                <input type="text" class="form-control radius-10 @error('address') is-invalid @enderror" name="address" placeholder="Enter address" value="{{ old('address',$account_data['address']) }}" >
                                                @error('address')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                                                        
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="js-form-message">
                                            <div class="form-group mb-4">
                                                <label id="nameLabel" class="form-label h5">
                                                    {{ translate('Zip Code') }}
                                                </label>
                                                <input type="text" class="form-control radius-10 @error('postal_code') is-invalid @enderror" name="postal_code" placeholder="Enter zip code" value="{{ old('postal_code', $account_data['postal_code']) }}" >
                                                @error('postal_code')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="js-form-message">
                                            <div class="form-group mb-4">
                                                <label id="nameLabel" class="form-label h5">
                                                    {{ translate('Phone number') }}
                                                </label>
                                                <input type="text" class="form-control radius-10 @error('phone') is-invalid @enderror" name="phone" placeholder="Enter Phone number" value="{{ old('phone',$account_data['phone']) }}" >
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="js-form-message">
                                            <div class="form-group mb-4">
                                                <label id="nameLabel" class="form-label h5">
                                                    {{ translate('Account Holder Name') }}
                                                </label>                                                
                                                <input type="text" class="form-control radius-10 @error('account_holder_name') is-invalid @enderror" name="account_holder_name" placeholder="Enter account holder name" value="{{ old( 'account_holder_name', $account_data['account_holder_name'] ) }}" >
                                                @error('account_holder_name')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="js-form-message">
                                            <div class="form-group mb-4">
                                                <label id="nameLabel" class="form-label h5">
                                                    {{ translate('Bank Account Number') }}
                                                </label>                                                
                                                <input type="text" class="form-control radius-10 @error('account_number') is-invalid @enderror" name="account_number" placeholder="Enter account number" value="{{ old('account_number') }}" >
                                                @error('account_number')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="js-form-message">
                                            <div class="form-group mb-4">
                                                <label id="nameLabel" class="form-label h5">
                                                    {{ translate('Routing Number') }}
                                                </label>
                                                <input type="text" class="form-control radius-10 @error('routing_number') is-invalid @enderror" name="routing_number" placeholder="Enter routing number" value="{{ old('routing_number', $account_data['routing_number']) }}" >
                                                @error('routing_number')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="js-form-message">
                                            <div class="form-group mb-4">
                                                <label id="nameLabel" class="form-label h5">
                                                    {{ translate('Enter SSN') }}
                                                </label>
                                                <input type="text" class="form-control radius-10 @error('ssn') is-invalid @enderror" name="ssn" placeholder="Enter SSN" value="{{ old('ssn', $account_data['ssn']) }}" >
                                                @error('ssn')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-green-lg transition-3d-hover">{{ translate('Continue') }}</button>
                                    </div> -->
                                </div>  
                                
                                <div class="row bank-detail-section page-2">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label text-dark h5 h5 mb-3">Front Identification*</label>
                                            <div class="input-group flex-column image-upload ">
                                                <div><i class="bi bi-cloud-upload h3 font-weight-bold mb-2 text-grey"></i></div>
                                                <div class="fw-600 text-dark h5">
                                                    <!-- <label for="chooseFile" class="custom-file-upload">
                                                        <i class="fa fa-cloud-upload"></i> Browse
                                                    </label> -->
                                                    <input type="file" class="form-control bg-transparent border-0 radius-10 @error('front_image') is-invalid @enderror" name="front_image"  >
                                                    @error('front_image')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="form-label text-dark h5 h5 mb-3">Back Identification*</label>
                                            <div class="input-group flex-column image-upload ">
                                                <div><i class="bi bi-cloud-upload h3 font-weight-bold mb-2 text-grey"></i></div>
                                                <div class="fw-600 text-dark h5">
                                                    <!-- <label for="chooseFile" class="custom-file-upload">
                                                        <i class="fa fa-cloud-upload"></i> Browse
                                                    </label> -->
                                                    <input type="file" class="form-control bg-transparent border-0 radius-10 @error('back_image') is-invalid @enderror" name="back_image">
                                                    @error('back_image')
                                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-green-lg transition-3d-hover">{{ translate('Add') }}</button>
                                    </div>
                                </div>  
                                </form>                       
                            </div>
                        </div>
                    @else
                    <div class="row add-bank">
                        <div class="col-12">
                            <div class="card p-3 mb-3">
                                <div class="row no-gutters">
                                  <div class="col-2">
                                    <img src="../public/uploads/all/jpm.png" class="img-fluid" alt="...">
                                  </div>
                                  <div class="col-10 d-flex justify-content-between align-items-center">
                                        <div class="card-body p-lg-0 py-0">
                                            <h3 class="fw-600">Stripe</h3>
                                            <h6 class="text-grey">{{ $user_profile->stripe_account }}</h6>
                                        </div>
                                        <div class="body-left">
                                            <a href="{{ url('/stripe/delete-account') }}" onclick="return confirm('Are you sure want to delete this?');" >
                                                <h6 class="text-danger font-weight-bold"><i class="bi px-2 bi-trash"></i>Delete</h6>
                                            </a>
                                        </div>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
</section>
@endsection
@push('script')
@if(old())
    <script> 
        $('.add-account-button').hide();
        $('.add-bank-detail').show();
    </script>
@endif
<script>
    $('.add-account').click(function(){
        $('.add-bank-detail').show();
        $('.add-account-button').hide();
    })
</script>



<script type="text/javascript">

    function get_state_by_country(){
        var country_id = $('#country_id').val();
        $.post('{{ route('cities.get_city_by_country') }}',{_token:'{{ csrf_token() }}', country_id:country_id}, function(data){
            $('#state_id').html(null);
            for (var i = 0; i < data.length; i++) {
                $('#state_id').append($('<option>', {
                    value: data[i].name,
                    text: data[i].name
                }));
            }
            $("#state_id > option").each(function() {
               
                  var st_id = "{{ old('state', $account_data['state']) }}";
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

   
</script>
@endpush