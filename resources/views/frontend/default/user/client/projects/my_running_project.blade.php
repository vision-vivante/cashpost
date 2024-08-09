@extends('frontend.default.layouts.app')

@section('content')
@php
    $type = isset($_GET['type']) ? $_GET['type'] : '';  
    $search = isset($_GET['search']) ? $_GET['search'] : '';  
    $project = isset($_GET['project']) ? $_GET['project'] : '';  
@endphp
    <section class="">
        <div class="container">
            <div class="my-campaigns-status">
                <div class="aiz-user-panel p-0">
                    <div class="aiz-titlebar pt-5 border-top mb-4">
                        <div class="add-new-campaign d-flex justify-content-between flex-column flex-sm-row align-items-sm-center align-items-start">
                            <h2 class="font-weight-bold my-campus-title">{{ translate('Running Projects') }}</h2>
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
                                            <thead>
                                                <tr>
                                                    <th width="10%">{{translate('Sr no.')}}</th>
                                                    <th>{{translate('Image')}}</th>
                                                    <th>{{translate('Campaign title')}}</th>
                                                    <th>{{translate('Influencer Name')}}</th>
                                                    <th>{{translate('Brand Name')}}</th>
                                                    <th>{{translate('Proof URL')}}</th>
                                                    <th>{{translate('Status')}}</th>
                                                    <th>{{translate('Action')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @forelse ($running_projects as $key => $running_project)
                                            @php
                                                $project = \App\Models\Project::withTrashed()->find($running_project->project_id);
                                                $freelance_photo = user_profile_pic($running_project->user_id);
                                                $brand_name=get_brand_name($project->client_user_id);
                                                $status= get_all_projects($project,$running_project->user_id);
                                                $user_details=get_userdata($running_project->user_id);
                                                $name=(isset($user_details->name)) ? $user_details->name : '';
                                            @endphp
                                            <tr>
                                                <td> {{$key + $running_projects->firstItem()}} </td>
                                                <td>
                                                    @if(custom_asset($freelance_photo))
                                                    <img src="{{ custom_asset($freelance_photo) }}" width="70" height="50" alt="" class="img-fluid radius-10">
                                                    @else
                                                        <img class="img-fluid radius-10" src="{{ my_asset('assets/frontend/default/img/avatar-place.png') }}" width="70" height="50" alt="">
                                                    @endif
                                                </td>
                                                <td><a href="{{ route('project.details', $project->slug) }}" class="text-inherit"> {{$project->name}}</a></td>

                                                <td>{{$name}}</td>

                                                <td id-check="{{$running_project->id}}">{{$brand_name}}</td>
                                                <td id-check="{{$running_project->id}}">
                                                    @if ($running_project->submitted)
                                                        <a href="{{$running_project->social_url}}" target="_blank">{{translate('Proof')}}</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($running_project->submitted)
                                                        @if(!empty($running_project->disputed))
                                                            <span class="progress-text">Disputed</span>
                                                        @else 
                                                            <span class="progress-text">Submitted</span>
                                                        @endif
                                                    @else    
                                                        {!! $status !!}
                                                    @endif
                                                </td>
                                                <td> 
                                                    @if($running_project->project_banned == null)
                                                        <a href="{{ url('chat?receiver='.$running_project->user_id.'&project='.$project->slug) }}" class="btn btn-primary btn-sm">Chat</a>
                                                        @if ($running_project->submitted)
                                                            @if(empty($running_project->disputed))
                                                                <form class="d-inline" action="{{ route('projects.mark_complete') }}" method="post">
                                                                @csrf
                                                                    <input type="hidden" name="project_id" value="{{ $project->slug }}">
                                                                    <input type="hidden" name="user_id" value="{{ $running_project->user_id }}">
                                                                    <button type="submit" class="btn btn-success btn-sm">{{ translate('Mark Complete') }}</button>
                                                                </form>
                                                                <a href="javascript:void(0)" onclick="dispute_modal({{$project->id}},{{$running_project->user_id}})" class="btn btn-danger btn-sm text-white">Dispute</a>
                                                            @endif
                                                        @endif
                                                    @else
                                                       <p>Campaign Banned by Admin</p> 
                                                    @endif
                                                </td>

                                            </tr>
                                            @empty
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                <div class="aiz-pagination aiz-pagination-center">
                                    {{$running_projects->appends(['type'=> $type,'search'=>$search,'project'=>$project])->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('modal')
<div class="modal fade" id="disputed_for_project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ translate('Confirm Dispute') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body" id="disputed_modal_content">
               
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script type="text/javascript">
        function sort_projects(el){
            $('#sort_projects').submit();
        }
        function dispute_modal(id,receiver_user_id){
            $.post('{{ route('dispute_for_project_modal') }}', { _token: '{{ csrf_token() }}', project_id:id,receiver_user_id:receiver_user_id }, function(data){
                $('#disputed_for_project').modal('show');
                $('#disputed_modal_content').html(data);
            }) 
        }
    </script>
@endsection