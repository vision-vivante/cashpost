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
                    <div class="aiz-titlebar mt-2 mb-4">
                        <h2 class="font-weight-bold my-campus-title pt-5 border-top">{{ translate('Completed Campaigns') }}</h2>
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
                                                    <!-- <th>{{translate('Client name')}}</th> -->
                                                    <th>{{translate('Brand name')}}</th>
                                                    <th>{{translate('Status')}}</th>
                                                    <th>{{translate('Action')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @forelse ($completed_projects as $key => $completed_project)
                                                @php 
                                                    $project = \App\Models\Project::withTrashed()->find($completed_project->project_id);
                                                    $image_id=ProjectCategory($project->project_category_id)->photo;
                                                    $client_photo = user_profile_pic($project->client_user_id);
                                                    $brand_name=get_brand_name($project->client_user_id);
                                                    $status=get_all_projects($project);
                                                    $user_details=get_userdata($completed_project->client_user_id);
                                                    $name=(isset($user_details->name)) ? $user_details->name : '';
                                                @endphp  
                                                <tr>
                                                    <td>{{$key + $completed_projects->firstItem()}}</td>
                                                    <td>@if($client_photo != null)
                                                        <img src="{{ custom_asset($client_photo) }}" width="70" height="50" alt="" class="img-fluid radius-10">
                                                        @else
                                                            <img class="img-fluid radius-10" src="{{ my_asset('assets/frontend/default/img/avatar-place.png') }}" width="70" height="50" alt="">
                                                        @endif
                                                    </td>
                                                    <td><a href="{{ route('project.details', $project->slug) }}" class="text-inherit"> {{$project->name}}</a></td>
                                                    <td>{{ $brand_name }}</td>
                                                    <td>{!! $status !!}</td>
                                                    <td><a href="{{ url('chat?receiver='.Auth::user()->id.'&project='.$project->slug) }}" class="btn btn-primary btn-sm">{{ translate('Chat With Client') }}</a></td>
                                                </tr>
                                            @empty
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="aiz-pagination aiz-pagination-center">
                                        <h5>Showing 1 to {{$items}} entries {{ $completed_projects->total()}}</h5>
                                        {{ $completed_projects->appends(['type'=> $type,'search'=>$search,'project'=>$project])->links() }}
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
@endsection
@section('modal')
    <div class="modal fade" id="rate-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="h6 mb-0">{{translate('Rate This Freelancer')}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="project_id" value="">
                        <div class="form-group">
                            <label>{{ translate('Rating') }}</label>
                            <div class="rating rating-input rating-lg">
                                <label>
                                    <input type="radio" name="rating" value="1">
                                    <i class="las la-star active"></i>
                                </label>
                                <label>
                                    <input type="radio" name="rating" value="2">
                                    <i class="las la-star active"></i>
                                </label>
                                <label>
                                    <input type="radio" name="rating" value="3" >
                                    <i class="las la-star active"></i>
                                </label>
                                <label>
                                    <input type="radio" name="rating" value="4">
                                    <i class="las la-star"></i>
                                </label>
                                <label>
                                    <input type="radio" name="rating" value="5" checked="">
                                    <i class="las la-star"></i>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ translate('Comment') }}</label>
                            <textarea class="form-control" rows="5" name="review" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">{{ translate('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ translate('Rate This Client') }}</button>
                    </div>
                </form
            </div>
        </div>
    </div>

@endsection
