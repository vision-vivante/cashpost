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
                <div class="">
                    <div class="aiz-user-panel p-0">
                        <div class="aiz-titlebar pt-5 border-top mb-4">
                            <div class="add-new-campaign d-flex justify-content-between flex-column flex-sm-row align-items-sm-center align-items-start">
                                <h2 class="font-weight-bold my-campus-title">{{ translate('All') }}</h2>
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
                                                        <th class="h6">{{translate('Campaign title')}}</th>
                                                        <th class="h6">{{translate('Brand name')}}</th>
                                                        <th class="h6">{{translate('Status')}}</th>
                                                        <th class="h6">{{translate('Action')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($all_projects as $key => $project)
                                                    @php 
                                                    $brand_name=get_brand_name($project->client_user_id);
                                                    $project = \App\Models\Project::find($project->id);
                                                    $status=get_all_projects($project);
                                                    @endphp  
                                                        <tr>
                                                            <td class="h6">{{$key + $all_projects->firstItem()}}</td>
                                                            <td class="h6"><a href="{{ route('project.details', $project->slug) }}" class="text-inherit"> {{$project->name}}</a></td>
                                                            <td class="h6">{{$brand_name}}</td>
                                                            <td class="h6">{!!$status!!}</td>
                                                            <td class="h6">
                                                                @if(ProjectGetHired($project->slug)==0)
                                                                <a href="{{ route('projects.edit',encrypt($project->id)) }}" class="btn btn-primary btn-sm fw-500">{{ translate('Edit') }}</a>
                                                                <a onclick="return confirm('Are you sure?')" href="{{ route('projects.destroy',encrypt($project->id)) }}" class="btn btn-danger btn-sm fw-500">{{ translate('Delete') }}</a>
                                                                @else
                                                                    <a href="javascript:void(0)" class="btn btn-secondary btn-sm fw-500">{{ translate('Hired') }}</a>
                                                                @endif
                                                                <!-- <a href="{{ route('project.bids', $project->slug) }}" class="btn btn-primary btn-sm fw-500">{{translate('See All Bidders')}}</a> -->
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="aiz-pagination aiz-pagination-right">
                                            <h6 class="m-0 text-grey">Showing 1 to {{$items}} of {{ $all_projects->total()}} entries</h6>

                                            {{$all_projects->appends(['type'=> $type,'search'=>$search,'project'=>$project])->links()}}
                                            </div>
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
    function sort_projects(el){
        $('#sort_projects').submit();
    }
</script>
    <script type="text/javascript">
        function milestone_payment_request_modal(project_id , client_id){
            $.post('{{ route('milestone_payment_request.modal') }}',{_token:'{{ csrf_token() }}', project_id:project_id, client_id:client_id}, function(data){
                $('#milestone_payment_request_modal').modal('show');
                $('#milestone_payment_request_modal_body').html(data);
    		});
        }
    </script>
@endsection

@section('modal')
<div class="modal fade" id="milestone_payment_request_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ translate('Send Milestone Request') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="milestone_payment_request_modal_body">

            </div>
        </div>
    </div>
</div>
@endsection
