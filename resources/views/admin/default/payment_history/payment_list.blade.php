@extends('admin.default.layouts.app')

@section('content')
@php  
$search = (isset($_GET['search'])) ? $_GET['search'] : ''; 
$transaction = (isset($_GET['transaction'])) ? $_GET['transaction'] : ''; 
@endphp
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <form class="" id="project_payments" action="" method="GET">
                <div class="card-header row gutters-5">
                    <div class="col text-center text-md-left">
                        <h5 class="mb-md-0 h6">{{translate('Payments')}}</h5>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            @if(!empty($transaction))
                            <input type="hidden" class="transaction" name="transaction"  value="{{ $transaction }}">
                            @endif
                            <input type="text" class="form-control" placeholder="Search name" name="search" @isset($sort_search) value="{{ $sort_search }}" @endisset>
                            <div class="input-group-append">
                                <button class="btn btn-light" type="submit">
                                    <i class="las la-search la-rotate-270"></i>
                                </button>
                            </div>
                        </div>
                    </div> 
                </div>
            </form>
            <div class="card-body">
                <ul class="nav nav-tabs">
                    <li class="nav-item ">
                        <a class="nav-link @if(!isset($_GET['transaction'])) active @endif" href="{{url('/admin/all-payments')}}">Wallet Recharge</a></li>
                    <li class="nav-item"> 
                        <a class="nav-link @if(isset($_GET['transaction']) && $_GET['transaction'])  active @endif"  href="{{url('/admin/all-payments?transaction=1')}}">Transaction</a></li>
                </ul>
                <table class="table aiz-table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ translate('Users') }}</th>
                            <th>{{ translate('User Type') }}</th>
                            <th>{{ translate('Campaign') }}</th>
                            <th>{{ translate('Amount') }}</th>
                            <th>{{ translate('Service Fee / Commission Fee') }}</th>
                            <th>{{ translate('Type') }}</th>
                            <th>{{ translate('Date') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_payments as $key => $payment)
                            @php  
                                $type=admin_transaction_type($payment);
                            @endphp
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{(isset($payment->name)) ? $payment->name : ''}}</td>
                                <td>{{(isset($payment->user_type)) ? $payment->user_type : ''}}</td>
                                <td>{{(isset($payment->project_name)) ? $payment->project_name : '--'}}</td>
                                <td>{{$payment->amount}}</td>
                                <td>{{$payment->commission_fee}}</td>
                                <td>{{$type}}</td>
                                <td>{{$payment->created_at}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination aiz-pagination-center">
                    {{ $all_payments->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')

@endsection
