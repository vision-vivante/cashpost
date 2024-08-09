@extends('frontend.default.layouts.app')

@section('content')

    <section class="bank-detail-section">
        <div class="container">
            <div class="d-flex align-items-start">
                <div class="aiz-user-panel p-0">
                    <div class="aiz-titlebar total-earning border-top py-5">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <h2 class="font-weight-bold heading mb-3">{{ translate('Payment') }}</h2>
                                <div class="payment-card">
                                    <div class="card my-card p-4 mb-0 h-100">
                                        <div class="row no-gutters">
                                        <div class="col-4 px-2">
                                            <img src="public/uploads/all/money.png" alt="..." class="img-fluid">
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body p-0">
                                            <h2 class="text-dark font-weight-bold">{{translate('$1,15,200')}}</h2>
                                            <p class="text-grey mb-0">{{translate('Total earnings')}}</p>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card bank-detail py-4 mb-0 border-top">
                        <div class="card-header border-0 px-0 align-items-start flex-column flex-sm-row">
                            <div class="order-last order-sm-first">
                                <h3 class="heading font-weight-bold">Bank Account</h3>
                                <h6 class="subtitle text-grey mb-4">Add your bank account for receiving payment.</h6>
                            </div>
                            <h3 class="powred-by mb-sm-0 mb-4"> Powered by<span class="fw-800"> stripe</span></h3>
                        </div>
                        <div class="add-btn"><a href="" class="btn btn-green-lg">Add Account</a></div>
                    </div>
                    <div class="card bank-detail py-4 border-top">
                        <div class="card-header border-0 px-0 align-items-start flex-column flex-sm-row">
                            <div class="order-last order-sm-first">
                                <h3 class="heading font-weight-bold">{{ translate('Bank Account') }}</h3>
                                <h6 class="subtitle text-grey">Add your bank account for receiving payment.</h6>
                                <div class="process-point d-inline-flex position-relative mt-5">
                                    <div class="first-point d-flex align-items-center flex-column">
                                        <h6 class="text-white bg position-relative d-flex align-items-center justify-content-center z-99 fw-600">1</h6>
                                        <h6 class="mt-2 fw-600">Bank Details</h6>
                                    </div>  
                                    <div class="second-point d-flex align-items-center flex-column">
                                        <h6 class="text-grey bg position-relative d-flex align-items-center justify-content-center z-99 fw-600">2</h6>
                                        <h6 class="text-grey mt-2">Upload ID</h6>
                                    </div>  
                                </div>
                            </div>
                            <h3 class="powred-by mb-sm-0 mb-4"> Powered by<span class="fw-800"> stripe</span></h3>
                        </div>
                        <div class="card-body my-bank-body px-0">
                            <div class="row">
                                <div class="col-lg-4 col-sm-6">
                                    <div class="js-form-message">
                                        <div class="form-group mb-4">
                                            <label id="nameLabel" class="form-label h5">
                                                {{ translate('First Name') }}
                                            </label>
                                            <input type="text" class="form-control radius-10" placeholder="Enter first name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="js-form-message">
                                        <div class="form-group mb-4">
                                            <label id="nameLabel" class="form-label h5">
                                                {{ translate('Last Name') }}
                                            </label>
                                            <input type="text" class="form-control radius-10" placeholder="Enter last name" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="js-form-message">
                                        <div class="form-group mb-4">
                                            <label id="nameLabel" class="form-label h5">
                                                {{ translate('Date of Birth') }}
                                            </label>
                                            <input type="text" class="form-control radius-10" placeholder="XXXX-XX-XX" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="js-form-message">
                                        <div class="form-group mb-4">
                                            <label id="nameLabel" class="form-label h5">
                                                {{ translate('Country') }}
                                            </label>
                                            <select name="coUntry" id="coUntry" class="coustom-select form-control radius-10 h5">
                                                <option selected value="United states of America">United states of America</option>
                                                <option value="Japan">Japan</option>
                                                <option value="China">China</option>
                                                <option value="India">India</option>
                                                <option value="Korea">Korea</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="js-form-message">
                                        <div class="form-group mb-4">
                                            <label id="nameLabel" class="form-label h5">
                                                {{ translate('Address 1') }}
                                            </label>
                                            <input type="text" class="form-control radius-10" placeholder="Enter address" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="js-form-message">
                                        <div class="form-group mb-4">
                                            <label id="nameLabel" class="form-label h5">
                                                {{ translate('Address 2') }}
                                            </label>
                                            <input type="text" class="form-control radius-10" placeholder="Enter address" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="js-form-message">
                                        <div class="form-group mb-4">
                                            <label id="nameLabel" class="form-label h5">
                                                {{ translate('Account number (IBAN)') }}
                                            </label>
                                            <input type="text" class="form-control radius-10" placeholder="Enter IBAN number" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="js-form-message">
                                        <div class="form-group mb-4">
                                            <label id="nameLabel" class="form-label h5">
                                                {{ translate('Zip Code') }}
                                            </label>
                                            <input type="number" class="form-control radius-10" placeholder="Enter zip code" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="js-form-message">
                                        <div class="form-group mb-4">
                                            <label id="nameLabel" class="form-label h5">
                                                {{ translate('Phone number') }}
                                            </label>
                                            <input type="number" class="form-control radius-10" placeholder="Enter Phone number" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="js-form-message">
                                        <div class="form-group mb-4">
                                            <label id="nameLabel" class="form-label h5">
                                                {{ translate('Routing Number') }}
                                            </label>
                                            <input type="number" class="form-control radius-10" placeholder="Enter routing number" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-green-lg transition-3d-hover">{{ translate('Continue') }}</button>
                                </div>
                            </div>
                           <!--  @if ($freelancer_account != null)
                                <form class="js-validate" action="{{ route('freelancer_account.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="js-form-message">
                                        <div class="form-group">
                                            <label id="nameLabel" class="form-label">
                                                {{ translate('Bank Name') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control " name="bank_name" value="{{ $freelancer_account->bank_name }}"  placeholder="Enter Bank Name" aria-label="Enter Bank Name" required aria-describedby="nameLabel" data-msg="Please Enter Bank Name." data-error-class="u-has-error" data-success-class="u-has-success">

                                        </div>
                                    </div>
                                    <div class="js-form-message">
                                        <div class="form-group">
                                            <label id="nameLabel" class="form-label">
                                                {{ translate('Bank Account Name') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control " name="bank_account_name" value="{{ $freelancer_account->bank_account_name }}"  placeholder="Enter Bank Account Name" aria-label="Enter Bank Account Name" required aria-describedby="nameLabel" data-msg="Please Enter Bank Account Name." data-error-class="u-has-error" data-success-class="u-has-success">

                                        </div>
                                    </div>
                                    <div class="js-form-message">
                                        <div class="form-group">
                                            <label id="nameLabel" class="form-label">
                                                {{ translate('Bank Account Number') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control " name="bank_account_number" value="{{ $freelancer_account->bank_account_number }}" placeholder="Enter Bank Account Number" aria-label="Enter Bank Account Number" required aria-describedby="nameLabel" data-msg="Please Enter Bank Account Number." data-error-class="u-has-error" data-success-class="u-has-success">

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label id="nameLabel" class="form-label">
                                            {{ translate('Routing/IBAN/SWIFT/BIC number') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control " name="bank_routing_number" value="{{ $freelancer_account->bank_routing_number }}" placeholder="Enter Routing/IBAN/SWIFT/BIC number" aria-label="Enter Bank Account Number" required aria-describedby="nameLabel" data-msg="Please Enter Bank Account Number." data-error-class="u-has-error" data-success-class="u-has-success">

                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary transition-3d-hover">{{ translate('Save Changes') }}</button>
                                   
                                </form>
                            @else
                                <form class="js-validate" action="{{ route('freelancer_account.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="js-form-message">
                                        <div class="form-group">
                                            <label id="nameLabel" class="form-label">
                                                {{ translate('Bank Name') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control " name="bank_name" placeholder="Enter your Bank name" aria-label="Enter your Bank name" required aria-describedby="nameLabel" data-msg="Please Enter your Bank name." data-error-class="u-has-error" data-success-class="u-has-success">

                                        </div>
                                    </div>
                                    <div class="js-form-message">
                                        <div class="form-group">
                                            <label id="nameLabel" class="form-label">
                                                {{ translate('Bank Account Name') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control " name="bank_account_name" placeholder="Enter Bank Account Name" aria-label="Enter Bank Account Name" required aria-describedby="nameLabel" data-msg="Please Enter Bank Account Name." data-error-class="u-has-error" data-success-class="u-has-success">

                                        </div>
                                    </div>
                                    <div class="js-form-message">
                                        <div class="form-group">
                                            <label id="nameLabel" class="form-label">
                                                {{ translate('Bank Account Number') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control " name="bank_account_number" placeholder="Enter Bank Account Number" aria-label="Enter Bank Account Number" required aria-describedby="nameLabel" data-msg="Please Enter Bank Account Number." data-error-class="u-has-error" data-success-class="u-has-success">

                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-sm btn-primary transition-3d-hover">{{ translate('Save Changes') }}</button>
                                   
                                </form>
                            @endif-->
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <section class="bank-detail-section page-2">
        <div class="container">
            <div class="d-flex align-items-start">
                <div class="aiz-user-panel p-0">
                    <div class="aiz-titlebar total-earning border-top py-5">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <h2 class="font-weight-bold heading mb-3">{{ translate('Payment') }}</h2>
                                <div class="payment-card">
                                    <div class="card my-card p-4 mb-0 h-100">
                                        <div class="row no-gutters">
                                        <div class="col-4 px-2">
                                            <img src="public/uploads/all/money.png" alt="..." class="img-fluid">
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body p-0">
                                            <h2 class="text-dark font-weight-bold">{{translate('$1,15,200')}}</h2>
                                            <p class="text-grey mb-0">{{translate('Total earnings')}}</p>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card bank-detail py-4 border-top">
                        <div class="card-header border-0 px-0 align-items-start flex-column flex-sm-row">
                            <div class="order-last order-sm-first">
                                <h3 class="heading font-weight-bold">{{ translate('Bank Account') }}</h3>
                                <h6 class="subtitle text-grey">Add your bank account for receiving payment.</h6>
                                <div class="process-point d-inline-flex position-relative mt-5">
                                    <div class="first-point d-flex align-items-center flex-column">
                                        <h6 class="text-white bg position-relative d-flex align-items-center justify-content-center z-99 fw-600"><i class="bi bi-check2"></i></h6>
                                        <h6 class="mt-2 fw-600">Bank Details</h6>
                                    </div>  
                                    <div class="second-point d-flex align-items-center flex-column">
                                        <h6 class="text-grey bg position-relative d-flex align-items-center justify-content-center z-99 fw-600">2</h6>
                                        <h6 class="text-grey mt-2">Upload ID</h6>
                                    </div>  
                                </div>
                            </div>
                            <h3 class="powred-by mb-sm-0 mb-4"> Powered by<span class="fw-800"> stripe</span></h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label class="form-label text-dark h5 h5 mb-3">Front Identification*</label>
                                <div class="input-group flex-column image-upload ">
                                    <div><i class="bi bi-cloud-upload h3 font-weight-bold mb-2 text-grey"></i></div>
                                    <div class="fw-600 text-dark h5">
                                        <label for="chooseFile" class="custom-file-upload">
                                            <i class="fa fa-cloud-upload"></i> Browse
                                        </label>
                                        <input type="file" name="user_avatar" class="user_avatar" id="chooseFile" style="visibility: hidden;">
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
                                        <label for="chooseFile" class="custom-file-upload">
                                            <i class="fa fa-cloud-upload"></i> Browse
                                        </label>
                                        <input type="file" name="user_avatar" class="user_avatar" id="chooseFile" style="visibility: hidden;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-green-lg transition-3d-hover">{{ translate('Add') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bank-detail-section page-3">
        <div class="container">
            <div class="d-flex align-items-start">
                <div class="aiz-user-panel p-0">
                    <div class="aiz-titlebar total-earning border-top py-5">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <h2 class="font-weight-bold heading mb-3">{{ translate('Payment') }}</h2>
                                <div class="payment-card">
                                    <div class="card my-card p-4 mb-0 h-100">
                                        <div class="row no-gutters">
                                        <div class="col-4 px-2">
                                            <img src="public/uploads/all/money.png" alt="..." class="img-fluid">
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body p-0">
                                            <h2 class="text-dark font-weight-bold">{{translate('$1,15,200')}}</h2>
                                            <p class="text-grey mb-0">{{translate('Total earnings')}}</p>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card bank-detail py-4 mb-0 border-top">
                        <div class="card-header border-0 px-0 align-items-start flex-column flex-sm-row">
                            <div class="order-last order-sm-first">
                                <h3 class="heading font-weight-bold">{{ translate('Bank Account') }}</h3>
                                <h6 class="subtitle text-grey">Add your bank account for receiving payment.</h6>
                            </div>
                            <h3 class="powred-by mb-sm-0 mb-4"> Powered by<span class="fw-800"> stripe</span></h3>
                        </div>
                    </div>
                    <div class="row add-bank">
                        <div class="col-12">
                            <div class="card p-3 mb-3">
                                <div class="row no-gutters">
                                  <div class="col-2">
                                    <img src="public/uploads/all/jpm.png" class="img-fluid" alt="...">
                                  </div>
                                  <div class="col-10 d-flex justify-content-between align-items-center">
                                        <div class="card-body p-lg-0 py-0">
                                            <h3 class="fw-600">JPMorgan Chase</h3>
                                            <h6 class="text-grey">XXXX XXXX XXXX 0125</h6>
                                        </div>
                                        <div class="body-left">
                                            <a href="#">
                                                <h6 class="text-danger font-weight-bold"><i class="bi px-2 bi-trash"></i>Delete</h6>
                                            </a>
                                        </div>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
