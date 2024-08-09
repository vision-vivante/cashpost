@extends('frontend.default.layouts.app')

@section('content')
<section class="py-5 transaction_page">
    <div class="container">
        <div class="d-flex align-items-start">
            <div class="aiz-user-panel p-0">
                <div class="aiz-titlebar mt-2 mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            @if(isClient())
                                <h2 class="font-weight-bold">{{ translate('Wallet') }}</h2>
                            @else
                                <h2 class="font-weight-bold">{{ translate('Transactions') }}</h2>
                            @endif
                        </div>
                    </div>
                </div>
                @if(isClient())
                   
                    <div class="row wallet-balance-sec">
                        <div class="col-lg-4 col-sm-6 mb-4 mb-sm-0">
                          <div class="text-dark rounded-lg overflow-hidden">
                            <div class="row credits">
                                <div class="col-sm-3 col-4 img-balance">
                                    <img src="{{ my_asset('assets/frontend/default/img/wallet1.png') }}">
                                </div>
                                <div class="col-sm-7 col-8 my-credits">
                                    <div class="my-border">
                                        <div class="h2 fw-700">{{ single_price(Auth::user()->profile->balance) }}
                                        </div>
                                        <div class="h6 text-grey">{{ translate('Credits') }}</div>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-4 col-lg-5 col-sm-6" >
                     
                        <form class="" action="{{ route('wallet.recharge') }}" method="post">
                            @csrf
                            <div class="modal-body gry-bg p-0">
                                <div class="row add-ammount-sec">
                                    <div class="col-12 h6">
                                        <label class="mb-0">{{ translate('$1.00 = 1 credit')}}</label>
                                    </div>
                                    <div class="col-12">
                                        <div class="row add-fund align-items-center">
                                            <div class="col-6">
                                                <div class="input-group my-input radius-10 overflow-hidden border px-3">
                                                    <span class="input-group-text p-0 bg-transparent border-0" id="basic-addon1">$</span>
                                                    <input type="number" lang="en" class="form-control" min="{{ get_setting('minimum_wallet_amount') }}" name="amount" placeholder="{{ translate('Amount')}}" required>
                                                    <input type="hidden" name="service_fee" value="{{ get_setting('service_fees') }}">
                                                </div>
                                            </div>
                                            <div class="col-6"><button type="submit" class="btn btn-green transition-3d-hover mr-1">{{translate('Add Funds')}}</button></div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <h6 class="text-danger mt-2">Service fee ${{ get_setting('service_fees') }}*</h6>
                                        <h6 class="text-danger mt-2">Min ${{ get_setting('minimum_wallet_amount') }}*</h6>
                                    </div>
                                </div>
                                <input value="stripe" id="payment_option" type="hidden" name="payment_option" checked>
                                
                              <div class="form-group text-right">
                                  
                              </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        @if(isClient())
                            <h2 class="font-weight-bold">{{ translate('My Wallet') }}</h2>
                        @else
                            <h5 class="mb-0 h6">{{ translate('My Transactions') }}</h5>
                        @endif
                    </div>
                    <div class="card-body">
                        <table class="table aiz-table mb-0 table-responsive">
                            <thead>
                                <tr>
                                    <th>{{translate('Sr no.')}}</th>
                                    <th data-breakpoints="lg">{{  translate('Date') }}</th>
                                    <th>{{ translate('Campaign Name') }}</th>
                                    @if(Auth::user()->user_type == 'client')
                                        <th data-breakpoints="lg">{{ translate('Influencer Name') }}</th>
                                    @elseif(Auth::user()->user_type == 'freelancer')
                                        <th data-breakpoints="lg">{{ translate('Client Name') }}</th>
                                    @endif
                                    <th>{{ translate('Amount')}}</th>
                                    <th>{{ translate('Commission / Fee') }}</th>
                                    <!-- <th data-breakpoints="lg">{{ translate('Payment Method')}}</th> -->
                                    <th>{{ translate('Status')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wallets as $key => $wallet)
                                    <tr>
                                        <td>{{$key + $wallets->firstItem()}}</td>
                                        <td>{{ date('d-m-Y', strtotime($wallet->created_at)) }}</td>
                                        <td>{{ ucfirst($wallet->name) }}</td>
                                        @if(Auth::user()->user_type == 'client')
                                            <td>{{ ucfirst(getInviteUser($wallet->receiver_id)) }}</td>
                                        @elseif(Auth::user()->user_type == 'freelancer')
                                            <td>{{ ucfirst(getInviteUser($wallet->client_user_id)) }}</td>
                                        @endif
                                        <td>{{ single_price($wallet->amount) }}</td>
                                        <td>{{ $wallet->commission_fee }}</td>
                                        <td>{{ ($wallet->send_to_user)?payment_status($wallet->send_to_user):'-'}}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="aiz-pagination">
                            {{ $wallets->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('modal')

  <div class="modal fade" id="wallet_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ translate('Recharge Wallet') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
              </div>
              <form class="" action="{{ route('wallet.recharge') }}" method="post">
                  @csrf
                  <div class="modal-body gry-bg px-3 pt-3">
                        <div class="row">
                            <div class="col-md-3">
                                <label>{{ translate('Amount')}} <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" lang="en" class="form-control mb-3" min="1" name="amount" placeholder="{{ translate('Amount')}}" required>
                            </div>
                        </div>
                        <div class="row">
                            <!-- @if(get_setting('paypal_activation_checkbox'))
                                <div class="col-6 col-md-4">
                                    <label class="aiz-megabox d-block mb-3">
                                        <input value="paypal" id="payment_option" type="radio" name="payment_option" checked>
                                        <span class="d-block p-3 aiz-megabox-elem">
                                            <img src="{{ my_asset('assets/frontend/default/img/paypal.png') }}" class="img-fluid mb-2">
                                            <span class="d-block text-center">
                                                <span class="d-block fw-600 fs-15">{{ translate('Paypal') }}</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            @endif -->
                            @if(get_setting('stripe_activation_checkbox'))
                                <div class="col-6 col-md-4">
                                    <label class="aiz-megabox d-block mb-3">
                                        <input value="stripe" id="payment_option" type="radio" name="payment_option" checked>
                                        <span class="d-block p-3 aiz-megabox-elem">
                                            <img src="{{ my_asset('assets/frontend/default/img/stripe.png') }}" class="img-fluid mb-2">
                                            <span class="d-block text-center">
                                                <span class="d-block fw-600 fs-15">{{ translate('Stripe') }}</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            @endif
                            <!-- @if(get_setting('sslcommerz_activation_checkbox'))
                                <div class="col-6 col-md-4">
                                    <label class="aiz-megabox d-block mb-3">
                                        <input value="sslcommerz" id="payment_option" type="radio" name="payment_option" checked>
                                        <span class="d-block p-3 aiz-megabox-elem">
                                            <img src="{{ my_asset('assets/frontend/default/img/sslcommerz.png') }}" class="img-fluid mb-2">
                                            <span class="d-block text-center">
                                                <span class="d-block fw-600 fs-15">{{ translate('sslcommerz') }}</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            @endif
                            @if(get_setting('paystack_activation_checkbox'))
                                <div class="col-6 col-md-4">
                                    <label class="aiz-megabox d-block mb-3">
                                        <input value="paystack" id="payment_option" type="radio" name="payment_option" checked>
                                        <span class="d-block p-3 aiz-megabox-elem">
                                            <img src="{{ my_asset('assets/frontend/default/img/paystack.png') }}" class="img-fluid mb-2">
                                            <span class="d-block text-center">
                                                <span class="d-block fw-600 fs-15">{{ translate('Paystack') }}</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            @endif
                            @if(get_setting('instamojo_activation_checkbox'))
                                <div class="col-6 col-md-4">
                                    <label class="aiz-megabox d-block mb-3">
                                        <input value="instamojo" id="payment_option" type="radio" name="payment_option" checked>
                                        <span class="d-block p-3 aiz-megabox-elem">
                                            <img src="{{ my_asset('assets/frontend/default/img/instamojo.png') }}" class="img-fluid mb-2">
                                            <span class="d-block text-center">
                                                <span class="d-block fw-600 fs-15">{{ translate('Instamojo') }}</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            @endif
                            @if(get_setting('paytm_activation_checkbox'))
                                <div class="col-6 col-md-4">
                                    <label class="aiz-megabox d-block mb-3">
                                        <input value="paytm" id="payment_option" type="radio" name="payment_option" checked>
                                        <span class="d-block p-3 aiz-megabox-elem">
                                            <img src="{{ my_asset('assets/frontend/default/img/paytm.png') }}" class="img-fluid mb-2">
                                            <span class="d-block text-center">
                                                <span class="d-block fw-600 fs-15">{{ translate('Paytm') }}</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            @endif -->
                        </div>
                      <div class="form-group text-right">
                          <button type="submit" class="btn btn-sm btn-primary transition-3d-hover mr-1">{{translate('Confirm')}}</button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>

@endsection

@section('script')
    <script type="text/javascript">
        function show_wallet_modal(){
            $('#wallet_modal').modal('show');
        }
    </script>
@endsection
