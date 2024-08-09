@extends('frontend.default.layouts.app')

@section('content')
@php
    $type = isset($_GET['type']) ? $_GET['type'] : '';  
    $search = isset($_GET['search']) ? $_GET['search'] : '';  
    $project = isset($_GET['project']) ? $_GET['project'] : '';  
@endphp
<section class="py-5">
    <div class="container">
        <div class="d-flex align-items-start my-campaigns-status">
            <div class="aiz-user-panel">
                <div class="aiz-titlebar pt-5 border-top mb-4">
                    <div class="add-new-campaign d-flex justify-content-between flex-column flex-sm-row align-items-sm-center align-items-start">
                        
                        <h2 class="font-weight-bold my-campus-title">{{ translate('Bidded Projects') }}</h2>
                        <a href="{{ route('projects.create') }}" class="btn btn-green-lg">
                            <i class="las la-plus"></i>
                            <span>{{ translate('Add New Project') }}</span>
                        </a>
                    </div>
                    @include('frontend.default.user.client.inc.dashboard_sidebar')
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table h6 aiz-table mb-0">
                                        <thead class="font-weight-bold">
                                            <tr>
                                                <th class="h6" width="10%">{{translate('Sr no.')}}</th>
                                                <th class="h6">{{translate('Image')}}</th>
                                                <th class="h6">{{translate('Campaign title')}}</th>
                                                <th class="h6">{{translate('Influencer Name')}}</th>
                                                <th class="h6">{{translate('Brand name')}}</th>
                                                <th class="h6">{{translate('Credits')}}</th>
                                                <th class="h6">{{translate('Action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($bid_users as $key => $bid_user)
                                          
                                            @php 
                                                $client_photo = user_profile_pic($bid_user->bid_by_user_id);
                                                $brand_name=get_brand_name($bid_user->client_user_id);
                                                $status=get_all_projects($bid_user);
                                            @endphp  
                                                <tr>
                                                    <td class="h6">{{$key + $bid_users->firstItem()}}</td>
                                                    <td class="h6">
                                                        @if(custom_asset($client_photo))
                                                            <img src="{{ custom_asset($client_photo) }}" width="70" height="50" alt="" class="img-fluid radius-10 radius-10">
                                                        @else
                                                            <img class="img-fluid radius-10" src="{{ my_asset('assets/frontend/default/img/avatar-place.png') }}" width="70" height="50" alt="">
                                                        @endif
                                                    </td>
                                                    <td class="h6"><a href="{{ route('project.details', $bid_user->slug) }}" class="text-inherit"> {{$bid_user->name}}</a></td>
                                                    <td class="h6">{{get_userdata($bid_user->bid_by_user_id)->name}}</td>
                                                    <td class="h6">{{$brand_name}}</td>
                                                    <td class="h6">{{$bid_user->amount}} Credits</td>
                                                    <td class="h6">
                                                        @if($bid_user->banned_project == null)
                                                            <a href="{{ url('chat?receiver='.$bid_user->bid_by_user_id.'&project='.$bid_user->slug) }}" class="btn btn-primary btn-sm">Chat</a>
                                                            @php
                                                                $w = Auth::user()->profile->balance;
                                                                
                                                            @endphp 
                                                            
                                                            @if ( $w >= (int)$bid_user->amount )
                                                           <a href="javascript:void(0)" class="btn btn-success btn-sm" onclick="hiring_modal({{ $bid_user->project_id }}, {{ $bid_user->bid_by_user_id}} ,{{$bid_user->amount}})">{{ translate('Accept') }}
                                                            </a>
                                                            @else
                                                            @php 
                                                                $am = ($bid_user->amount) - (Auth::user()->profile->balance);
                                                                if($am < 25){
                                                                    $am = 25;
                                                                }
                                                            @endphp
                                                            <a href="javascript:void(0)" class="btn btn-success btn-sm" onclick="show_wallet_modal( {{ $am }} )">{{ translate('Accept') }}
                                                            </a>
                                                            @endif

                                                            <a href="{{ url('hiring-invitation/reject'.$bid_user->bid_by_user_id.'?bid_by_user_id='.$bid_user->bid_by_user_id.'&project='.$bid_user->slug)}}" class="btn btn-danger btn-sm">{{ translate('Reject') }}
                                                            </a>
                                                        @else
                                                            <p>Campaign Banned by Admin</p>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="aiz-pagination aiz-pagination-right">
                                    <h6 class="m-0 text-grey">Showing 1 to {{$items}} entries {{ $bid_users->total()}}</h6>
                                    {{$bid_users->appends(['type'=> $type,'search'=>$search,'project'=>$project])->links()}}
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

@section('script')
<script type="text/javascript">
    submitted = false;
    function sort_projects(el){
        $('#sort_projects').submit();
    }
</script>
   <script type="text/javascript">
        function hiring_modal(project_id, user_id,amount){
            $('input[name=project_id]').val(project_id);
            $('input[name=bid_by_user_id]').val(user_id);
            $('input[name=amount]').val(amount);
            $('.message h4').remove();
            $('.message').append('<h4 class="text-center">Hiring Amount: '+amount+' <span>Credits</span></h4>');
            $('#hiring_modal').modal('show');
        }
        function show_wallet_modal(amount){
            $('#wallet_modal').modal('show');
            $('input[name=amount]').val(amount);

        }
    </script>
@endsection

@section('modal')
<div class="modal fade" id="hiring_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ translate('Confirm Hiring') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body" id="hiring_modal_body">
                
                <form class="form-horizontal" onsubmit="if(submitted) return false; submitted = true; return true" action="{{ route('hiring_confirmation_store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="bid_by_user_id" value="" required>
                    <input type="hidden" name="project_id" value="" required>
                    <input type="hidden" name="amount" value="" required>
                    <div class="form-group">
                        <div class="form-group">
                            <div class="message"></div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-sm btn-primary transition-3d-hover mr-1">{{ translate('Hire Now') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
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
                    <p> you have not sufficiant balance, please recharge your wallet and come back for hiring. </p>
                        <div class="row">
                            <div class="col-md-3">
                                <label>{{ translate('Amount')}} <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" lang="en" class="form-control mb-3" min="{{ get_setting('minimum_wallet_amount') }}" name="amount" placeholder="{{ translate('Amount')}}" required>
                                <input type="hidden" name="service_fee" value="{{ get_setting('service_fees') }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <h6 class="text-danger mt-2">Service fee ${{ get_setting('service_fees') }}*</h6>
                            <h6 class="text-danger mt-2">Min ${{ get_setting('minimum_wallet_amount') }}*</h6>
                        </div>
                        <div class="row">                           
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
