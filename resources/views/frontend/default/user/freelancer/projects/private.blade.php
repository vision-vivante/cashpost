@extends('frontend.default.layouts.app')

@section('content')
@php
    $type = isset($_GET['type']) ? $_GET['type'] : '';  
    $search = isset($_GET['search']) ? $_GET['search'] : '';  
    $project = isset($_GET['project']) ? $_GET['project'] : '';  
@endphp
    <section class="py-5">
        <div class="container">
            <div class="my-campaigns-status">
                <div class="aiz-user-panel p-0">
                    @include('flash::message')
                    <div class="aiz-titlebar pt-5 border-top mb-4">
                        <div class="add-new-campaign d-flex justify-content-between flex-column flex-sm-row align-items-sm-center align-items-start">
                            <h2 class="font-weight-bold my-campus-title">{{ translate('Campaign Proposals') }}</h2>
                        </div>
                        @include('frontend.default.user.freelancer.inc.dashboard_sidebar')
                    </div>
                     <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table h6 aiz-table mb-0">
                                            <thead>
                                                <tr>
                                                    <th width="10%">{{translate('Sr no.')}}</th>
                                                    <th>{{translate('Image')}}</th>
                                                    <th>{{translate('Campaign title')}}</th>
                                                    <th>{{translate('Client name')}}</th>
                                                    <th>{{translate('Brand name')}}</th>
                                                    <th>{{translate('Status')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                            @forelse ($private_projects as $key => $private_project)
                                                @php 

                                                    $client_photo = user_profile_pic($private_project->project->client_user_id);
                                                    $brand_name=get_brand_name($private_project->project->client_user_id);
                                                    $user_details=get_userdata($private_project->sent_by_user_id);
                                                    $name=(isset($user_details->name)) ? $user_details->name : '';
                                                @endphp
                                                @if ($private_project->project != null)  
                                                    <tr>
                                                        <td>{{$key + $private_projects->firstItem()}}</td>
                                                        <td>@if($client_photo != null)
                                                            <img src="{{ custom_asset($client_photo) }}" width="70" height="50" alt="" class="img-fluid radius-10">
                                                            @else
                                                                <img class="img-fluid radius-10" src="{{ my_asset('assets/frontend/default/img/avatar-place.png') }}" width="70" height="50" alt="">
                                                            @endif
                                                        </td>
                                                        <td><a href="{{ route('project.details', $private_project->project->slug) }}" class="text-inherit">{{ $private_project->project->name }}</a></td>
                                                        <td>{{ $name }}</td>
                                                        <td>{{ $brand_name }}</td>
                                                        <!-- <td>{{single_price($private_project->project->price)}}</td>
                                                        <td>{{date('d-m-Y', strtotime($private_project->project->end_date))}}</td> -->
                                                        <td>
                                                            <div>
                                                               <a href="{{ route('hiring.reject', encrypt($private_project->id)) }}" class="btn btn-danger btn-sm">{{ translate('Reject') }}
                                                                </a>
                                                                @if(!empty(Auth::user()->profile->stripe_account))
                                                                    <a href="javascript:void(0)" class="btn btn-success btn-sm" onclick="bid_modal('{{ $private_project->project->id }}')">{{ translate('Accept') }}
                                                                    </a>
                                                                    @else
                                                                    <a href="{{ route('stripe.account')}}" class="btn btn-success btn-sm">{{ translate('Accept') }}</a>
                                                                @endif
                                                                @php 
                                                                    $project_id=$private_project->project->slug; 
                                                                @endphp
                                                                <a href="{{ url('chat?project='.$project_id) }}"  class="btn btn-primary btn-sm">{{ translate('Chat With Client') }}</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @empty
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="aiz-pagination">
                    {{ $private_projects->appends(['type'=> $type,'search'=>$search,'project'=>$project])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('script')
    <script type="text/javascript">
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