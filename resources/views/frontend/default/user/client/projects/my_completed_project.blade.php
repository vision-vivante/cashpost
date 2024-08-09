@extends('frontend.default.layouts.app')

@section('content')

    <section class="">
        <div class="container">
            <div class="my-campaigns-status">
                <div class="aiz-user-panel p-0">
                <div class="aiz-titlebar pt-5 border-top mb-4">
                        <div class="add-new-campaign d-flex justify-content-between flex-column flex-sm-row align-items-sm-center align-items-start">
                            <h2 class="font-weight-bold my-campus-title">{{ translate('Completed Campaigns') }}</h2>
                            <a href="{{ route('projects.create') }}" class="btn btn-green-lg">
                                <i class="las la-plus"></i>
                                <span>{{ translate('Add New Campaign') }}</span>
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
                                                    <th>{{translate('Status')}}</th>
                                                    <th>{{translate('Action')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @forelse ($completed_projects as $key => $completed_project)
                                                @php 
                                                    $project = \App\Models\Project::find($completed_project->project_id);
                                                    $image_id=ProjectCategory($project->project_category_id)->photo;
                                                    $freelance_photo = user_profile_pic($completed_project->user_id);
                                                    $brand_name=get_brand_name($project->client_user_id);
                                                    $status=get_all_projects($project,$completed_project->user_id);
                                                    $user_details=get_userdata($completed_project->user_id);
                                                    $name=(isset($user_details->name)) ? $user_details->name : '';
                                                @endphp  
                                                    <tr>
                                                        <td> {{$key + $completed_projects->firstItem()}} </td>
                                                        <td>@if(custom_asset($freelance_photo))
                                                            <img src="{{ custom_asset($freelance_photo) }}" width="70" height="50" alt="" class="img-fluid radius-10">
                                                            @else
                                                                <img class="img-fluid radius-10" src="{{ my_asset('assets/frontend/default/img/avatar-place.png') }}" width="70" height="50" alt="">
                                                            @endif
                                                        </td>
                                                        <td><a href="{{ route('project.details', $project->slug) }}" class="text-inherit"> {{$project->name}}</a></td>
                                                        <td>{{ $name }}</td>
                                                        <td>{!! $status !!}</td>
                                                        <td> 
                                                            <a href="{{ url('chat?receiver='.$completed_project->user_id.'&project='.$project->slug) }}" class="btn btn-primary btn-sm">Chat</a> 
                                                            <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="hire_modal({{$completed_project->user_id}})">Hire</a> 
                                                        </td>

                                                    </tr>
                                            @empty
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    @if ($completed_projects->total() > 10)
                                    <div class="aiz-pagination aiz-pagination-center">
                                        <h5>Showing 1 to {{$items}} entries {{ $completed_projects->total()}}</h5>
                                        {{ $completed_projects->links() }}
                                    </div>
                                    @endif
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
    function showRatingModal(id){
        $('input[name=project_id]').val(id);
        $('#rate-modal').modal('show');
    }
</script>
<script type="text/javascript">
        function sort_projects(el){
            $('#sort_projects').submit();
        }
</script>

<script type="text/javascript">
    function hire_modal(id){
        $.post('{{ route('get_hire_for_project_modal') }}', { _token: '{{ csrf_token() }}', id:id,project_slug:"{{isset($project->slug) ? $project->slug : ''}}" }, function(data){
            $('#hire_for_project').modal('show');
            $('#hire_for_modal_body').html(data);
        })
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
        				<button type="submit" class="btn btn-primary">{{ translate('Rate This Freelancer') }}</button>
        			</div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal my-hire-modal fade" id="hire_for_project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content hire-modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title h3 fw-600" id="exampleModalLabel">{{ translate('Hire Influencer') }}</h5>
                    <button type="button" class="close m-0" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" id="hire_for_modal_body">

                </div>
            </div>
        </div>
    </div>
@endsection
