@extends('admin.default.layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <form class="" id="sort_clients" action="" method="GET">
                <div class="card-header row gutters-5">
                    <div class="col text-center text-md-left">
                        <h5 class="mb-md-0 h6">{{translate('Brand Lists')}}</h5>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search by Name" name="search" @isset($sort_search) value="{{ $sort_search }}" @endisset>
                            <div class="input-group-append">
                                <button class="btn btn-light" type="submit">
                                    <i class="las la-search la-rotate-270"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('client.create') }}" class="btn btn-primary">{{ translate('Add New Brand') }}</a>
                </div>
            </form>
            <div class="card-body">
                <table class="table aiz-table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{translate('Name')}}</th>
                            <th data-breakpoints="md">{{translate('Email')}}</th>
                            <th data-breakpoints="md">{{translate('Email Verification')}}</th>
                            <th>{{translate('Total Wallet Amount')}}</th>
                            <th class="text-right">{{translate('Options')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $key => $client)
                            @if ($client != null)
                            @php  
                                $userprofile=getUserProfile($client->id);
                                $balance=(isset($userprofile->balance)) ? $userprofile->balance : 0;
                            @endphp
                                <tr>
                                    <td>{{ ($key+1) + ($clients->currentPage() - 1)*$clients->perPage() }}</td>
                                    <td>
                                        {{$client->name}}
                                    </td>
                                    <td>
                                        {{$client->email}}
                                    </td>
                                    <td>
                                        @if ($client->email_verified_at != null)
                                            <span class="badge badge-inline badge-success">{{ translate('Verified') }}</span>
                                        @else
                                            <span class="badge badge-inline badge-danger">{{ translate('Not Recieved Yet') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ single_price($balance) }}
                                    </td>
                                    <td class="text-right">
                                        @if ($client != null && $client->banned== 0)
                                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm btn icon" href="{{ route('client_info_show', $client->user_name) }}" title="{{translate('View Details')}}">
                                                <i class="las la-eye"></i>
                                            </a>
                                        @endif
                                        @can ('freelancer_delete')
                                            @if ($client->banned == 1)
                                                <a href="javascript:void(0)" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-alert" data-target="#unban-modal" data-href="{{ route('user.login_action_ban', $client->id) }}" title="{{translate('Unban')}}">
                                                    <i class="las la-ban"></i>
                                                </a>
                                            @else
                                                <a href="javascript:void(0)" class="btn btn-soft-success btn-icon btn-circle btn-sm confirm-alert" data-target="#ban-modal" data-href="{{ route('user.login_action_ban', $client->id) }}" title="{{translate('Ban')}}">
                                                    <i class="las la-ban"></i>
                                                </a>
                                            @endif
                                        @endcan
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination aiz-pagination-center">
                    {{ $clients->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')
    @include('admin.default.partials.ban_modal')
    @include('admin.default.partials.unban_modal')
@endsection
@section('script')
<script type="text/javascript">
    function sort_clients(el){
        $('#sort_clients').submit();
    }
</script>
@endsection
