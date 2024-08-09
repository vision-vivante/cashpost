@extends('frontend.default.layouts.app')

@section('content')

<section class="">
    <div class="container">
        <div class="my-campaigns-status">
            <div class="aiz-user-panel p-0">
                <div class="aiz-titlebar mt-2 mb-4">
                    <h2 class="font-weight-bold my-campus-title pt-5 border-top">{{ translate('Applied Campaigns') }}</h2>
                    @include('frontend.default.user.freelancer.inc.dashboard_sidebar')
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table aiz-table mb-0">
                                        <thead>
                                            <tr>
                                                <th width="10%">{{translate('Sr no.')}}</th>
                                                <th>{{translate('Image')}}</th>
                                                <th>{{translate('Campaign title')}}</th>
                                                <th>{{translate('Brand name')}}</th>
                                                <th>{{translate('Credits')}}</th>
                                                <th>{{translate('Status')}}</th>
                                                <th>{{translate('Action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($bidded_projects as $key => $bidded_project)
                                            @if ($bidded_project->id != null)
                                                @php 
                                                    $client_photo = user_profile_pic($bidded_project->client_user_id);
                                                    $brand_name=get_brand_name($bidded_project->client_user_id);
                                                    $status=get_all_projects($bidded_project);
                                                    $existing_messge=CheckFirstMessageClient($bidded_project->id);
                                                @endphp  
                                                <tr>
                                                    <td>{{$key + $bidded_projects->firstItem()}}</td>
                                                    <td>
                                                        @if($client_photo != null)
                                                        <img src="{{ custom_asset($client_photo) }}" width="70" height="50" alt="" class="img-fluid radius-10">
                                                        @else
                                                            <img class="img-fluid radius-10" src="{{ my_asset('assets/frontend/default/img/avatar-place.png') }}" width="70" height="50" alt="">
                                                        @endif
                                                    </td>
                                                    <td><a href="{{ route('project.details', $bidded_project->slug) }}" class="text-inherit"> {{ $bidded_project->name }} </a></td>
                                                    <td>{{ $brand_name }}</td>
                                                    <td>{{ $bidded_project->amount }} credits</td>
                                                    <td>
                                                        {!! $status !!}
                                                    </td>
                                                    <td>
                                                        @if($bidded_project->status==2)
                                                         <a  href="javascript:void(0)"  class="btn btn-danger btn-sm">{{ translate('Bid Rejected') }}</a> 
                                                          <a href="javascript:void(0)" class="btn btn-primary  btn-sm" onclick="bid_modal('{{ $bidded_project->project_id }}')">{{ translate('New Bid') }}</a>
                                                        @else
                                                            @if($existing_messge==true)
                                                            <a  href="{{ url('chat?project='.$bidded_project->slug) }}"  class="btn btn-primary btn-sm">{{ translate('Chat With Client') }}</a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="aiz-pagination aiz-pagination-center">
                                    <h5>Showing 1 to {{$items}} entries {{ $bidded_projects->total()}}</h5>
                                    {{ $bidded_projects->links() }}
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
    function sort_projects(el){
        $('#sort_projects').submit();
    }

    function bid_modal(id){
        $.post('{{ route('get_bid_for_project_modal') }}', { _token: '{{ csrf_token() }}', id:id }, function(data){
            $('#bid_for_project').modal('show');
            $('#bid_for_modal_body').html(data);
        })
    }
</script>
@endsection
@section('modal')
<div class="modal fade" id="bid_for_project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ translate('Place Your Bid') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body" id="bid_for_modal_body">

            </div>
        </div>
    </div>
</div>
@include('frontend.default.partials.bookmark_remove_modal')
@endsection