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
                @include('flash::message')
                <div class="aiz-titlebar pt-5 border-top mb-4">
                        <div class="add-new-campaign d-flex justify-content-between flex-column flex-sm-row align-items-sm-center align-items-start">
                            <h2 class="font-weight-bold my-campus-title">{{ translate('Campaign Proposals') }}</h2>
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
                                                    <th>{{translate('Invited user')}}</th>
                                                    <th>{{translate('Campaign title')}}</th>
                                                    <th>{{translate('Brand name')}}</th>
                                                    <th>{{translate('Status')}}</th>
                                                    <th>{{translate('Action')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @forelse ($private_projects as $key => $private_project)
                                                @php 
                                                    $client_photo = user_profile_pic($private_project->sent_to_user_id);
                                                    $brand_name=get_brand_name($private_project->client_user_id);
                                                    $inviteuser=getInviteUser($private_project->sent_to_user_id);
                                                @endphp
                                                @if ($private_project != null)  
                                                    <tr>
                                                        <td>
                                                        {{$key + $private_projects->firstItem()}} 
                                                        </td>
                                                        <td>@if(custom_asset($client_photo ))
                                                            <img src="{{ custom_asset($client_photo) }}" width="70" height="50" alt="" class="img-fluid radius-10">
                                                            @else
                                                                <img class="img-fluid radius-10" src="{{ my_asset('assets/frontend/default/img/avatar-place.png') }}" width="70" height="50" alt="">
                                                            @endif
                                                        </td>
                                                        <td>{{$inviteuser}}</td>
                                                        @php 
                                                        $project_id=$private_project->slug; 
                                                        $sent_to_user_id= $private_project->sent_to_user_id; 
                                                        @endphp
                                                        <td><a href="{{ route('project.details', $private_project->slug) }}" class="text-inherit">{{ $private_project->name }}</a></td>
                                                        <td>{{ $brand_name }}</td>
                                                        <td>
                                                            {!!$status!!}
                                                        </td> 
                                                        <td>
                                                            @if(ProjectGetHired($private_project->slug)==0)
                                                            <a href="{{ route('projects.edit',encrypt($private_project->id)) }}" class="btn btn-secondary btn-sm fw-500">{{ translate('Edit') }}</a>
                                                            @else
                                                                <a href="javascript:void(0)" class="btn btn-secondary btn-sm fw-500">{{ translate('Hired') }}</a>
                                                                
                                                                <a href="{{ url('chat?receiver='.$sent_to_user_id.'&project='.$project_id) }}" class="btn btn-primary btn-sm">Chat</a>
                                                            @endif
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
                        {{$private_projects->appends(['type'=> $type,'search'=>$search,'project'=>$project])->links()}}
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
       /* function hiring_modal(project_name,project_price, project_id, user_id){
            $('input[name=project_name]').val(project_name);
            $('input[name=amount]').val(project_price);
            $('input[name=project_id]').val(project_id);
            $('input[name=user_id]').val(user_id);
            $('#hiring_modal').modal('show');
        }*/
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
                <form class="form-horizontal" action="{{ route('hiring_confirmation_store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="user_id" value="" required>
                    <input type="hidden" name="project_id" value="" required>

                    <div class="form-group">
                        <label class="form-label">
                            {{translate('Project')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-sm" name="project_name" value="" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">
                            {{translate('Amount')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="form-group">
                            <input type="number" class="form-control form-control-sm" name="amount" value="" min="1" step="0.01" required>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-sm btn-primary transition-3d-hover mr-1">{{ translate('Confirm') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
