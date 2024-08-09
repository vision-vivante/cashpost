@extends('admin.default.layouts.app')

@section('content')

<div class="aiz-titlebar mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h1 class="h3">{{translate('All Projects')}}</h1>
		</div>
	</div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <form class="" id="sort_projects" action="" method="GET">
                <div class="card-header row gutters-5">
        					<div class="col text-center text-md-left">
        						<h5 class="mb-md-0 h6">{{translate('All Projects')}}</h5>
        					</div>
                    <div class="col-md-3 ml-auto">
                        <select class="form-control aiz-selectpicker mb-2 mb-md-0" name="type" id="type" onchange="sort_projects()">
                                <option value="">{{ translate('Filter by') }}</option>
                                <option value="completed" @isset($type) @if($type == 'completed') selected @endif @endisset>{{translate('Completed')}}</option>
                                <option value="in-progress" @isset($type) @if($type == 'in-progress') selected @endif @endisset>{{translate('In-Progress')}}</option>
                                <option value="in-submitted" @isset($type) @if($type == 'in-submitted') selected @endif @endisset>{{translate('In-Submitted')}}</option>
                                <option value="in-completed" @isset($type) @if($type == 'in-completed') selected @endif @endisset>{{translate('In-Completed')}}</option>
                                <option value="disputed" @isset($type) @if($type == 'disputed') selected @endif @endisset>{{translate('Disputed')}}</option>
                        </select>
                    </div>
                   <div class="col-md-3 ml-auto">
                                <select class="form-control aiz-selectpicker mb-2 mb-md-0" name="user_id" id="user_id" data-live-search="true" onchange="sort_projects()">
                                    <option value="">{{ translate('Filter by Client') }}</option>
                                    @foreach (App\User::where('user_type', 'client')->get() as $key => $client)
                                        {{-- @if ($client->user != null) --}}
                                            <option value="{{ $client->id }}" @if ($client->id == $client_id) selected @endif>{{ $client->name }}</option>
                                        {{-- @endif --}}
                                    @endforeach
                                </select>
                   </div>
          			<div class="col-md-3">
          				<div class="input-group">
          					<input type="text" class="form-control" placeholder="Type and Hit Enter" name="search" @isset($sort_search) value="{{ $sort_search }}" @endisset>
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
                <table class="table aiz-table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th data-breakpoints="lg">{{translate('Campaigns')}}</th>
                            <th data-breakpoints="md">{{translate('Project Category')}}</th>
                            <th data-breakpoints="md">{{translate('Type')}}</th>
                            <th data-breakpoints="md">{{translate('Client')}}</th>
                            <th data-breakpoints="md">{{translate('Posted at')}}</th>
                            <th>{{translate('Options')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $key => $project)
                            <tr>
                                <td>{{ ($key+1) + ($projects->currentPage() - 1)*$projects->perPage() }}</td>
                                <td>
                                    {{ $project->name }}
                                    @php  
                                       $project_detail=get_admin_all_project($project->id);
                                    @endphp
                                    @foreach($project_detail as $key =>  $project_user)
                                        @php  
                                            $status = "";
                                            $resolve_dispute_btn='';
                                            $user_details=get_userdata($project_user->user_id);
                                            $name=(isset($user_details->name)) ? $user_details->name : '';
                                            $chat_threads_id=get_admin_chat_threads($project->client_user_id,$project_user->user_id,$project->id);
                                            $project_bid=get_bid_data($project->id,$project_user->user_id);
                                            $project_amount=(isset($project_bid->amount)) ? $project_bid->amount : '0';
                                            $project_status=get_submitted_disbute($project->id,$project_user->user_id);
                                            if(isset($project_status) && !empty($project_status)){

                                                if(empty($project_status->closed) && empty($project_status->dispute) &&  empty($project_status->disputed) && empty($project_status->submitted)){
                                                  $status="In-progress";
                                                }elseif(empty($project_status->closed) && empty($project_status->incomplete) &&  empty($project_status->disputed) && empty($project_status->submitted)){
                                                  $status="In-progress";
                                                }
                                                elseif(!empty($project_status->submitted) && empty($project_status->closed) && empty($project_status->incomplete) && empty($project_status->disputed)){
                                                  $status="Submitted";
                                                }
                                                elseif(!empty($project_status->incomplete)){
                                                  $status="In-Completed";
                                                }
                                                elseif(empty($project_status->closed) && empty($project_status->incomplete) &&  !empty($project_status->disputed) && !empty($project_status->submitted) && empty($project_status->resolved) &&  empty($project_status->faviour_by_user_id)){
                                                  $status="Disputed";
                                                  $resolve_dispute_btn='<a href="javascript:void(0)" class="btn btn-primary btn-sm mt-1" onclick="dispute_resolved('.$project->client_user_id.','.$project_user->user_id.','.$project->id.','.$project_user->id.')">Resolve</a>';
                                                }
                                                elseif(!empty($project_status->closed) && empty($project_status->incomplete) &&  !empty($project_status->disputed) && !empty($project_status->submitted) && !empty($project_status->resolved) && !empty($project_status->faviour_by_user_id)){
                                                    $selected_user=get_userdata($project_status->faviour_by_user_id);
                                                    if($selected_user->user_type=="client"){
                                                        $status="In-Completed";
                                                    }else{
                                                        $status="Completed";
                                                    }
                                                }
                                                elseif(!empty($project_status->closed) && empty($project_status->incomplete) &&  empty($project_status->disputed) && !empty($project_status->submitted) && empty($project_status->resolved) ){
                                                  $status="Completed";
                                                }
                                            }
                                        @endphp
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>{{$project_user->id}}</td>
                                                    <td>{{$name}}</td>
                                                    <td>{{$project_amount}}</td>
                                                    <td>{!! $status !!}</td>
                                                    <td>
                                                        {!! $resolve_dispute_btn !!}
                                                        <a href="{{ route('chat_details_for_admin', encrypt($chat_threads_id)) }}" class="btn btn-primary btn-sm mt-">See Chat</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @endforeach
                                </td>
                                <td>
                                  @if($project->project_category != null)
                                    {{$project->project_category->name}}
                                  @endif
                                </td>
                                <td>{{$project->type}}</td>
                                <td>
                                    @if ($project->client != null)
                                        {{$project->client->name}}
                                    @endif
                                </td>
                                <td>{{Carbon\Carbon::parse($project->created_at)->diffForHumans()}}</td>
                                <td>
                                    @can ('freelancer_delete')
                                        @if ($project->deleted_at)
                                            <a href="javascript:void(0)" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-alert" data-target="#unban-modal" data-href="{{ route('project.active_action', $project->id) }}" title="{{translate('Unban')}}">
                                                <i class="las la-ban"></i>
                                            </a>
                                        @else
                                            <a href="javascript:void(0)" class="btn btn-soft-success btn-icon btn-circle btn-sm confirm-alert" data-target="#ban-modal" data-href="{{ route('project.active_action', $project->id) }}" title="{{translate('Ban')}}">
                                                <i class="las la-ban"></i>
                                            </a>
                                        @endif
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination aiz-pagination-center">
                    {{ $projects->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')
    <div class="modal fade" id="dispute_for_project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ translate('Resolved Disputed') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" id="dispute_for_modal_body">

                </div>
            </div>
        </div>
    </div>
    @include('admin.default.partials.campaign_ban_modal');
    @include('admin.default.partials.campaign_unban_modal');
@endsection
@section('script')
<script type="text/javascript">
    function sort_projects(el){
        $('#sort_projects').submit();
    }
    function project_approval(el){
        if(el.checked){
            var status = 1;
        }
        else{
            var status = 0;
        }
        $.post('{{ route('project_approval') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
            if(data == 1){
                AIZ.plugins.notify('success', 'Project has been approved successfully.');
            }
            else{
                AIZ.plugins.notify('danger', 'Something went wrong');
            }
        });
    }
    $(document).ready(function() {
      $('.details-control').on('click', function() {
        
        $hide_box = $(this).closest('tr').next('tr');
        if ( $hide_box.hasClass("showdata") )  {
            $hide_box.remove();
            }
            else {
                alert('ASDAS');
            $(this).closest('tr').after('<tr class="showdata">'+
                                        '<td style="height:100px;">qqq</td>'+
                                        '<td>qqq</td>'+
                                        '<td>qqq</td>'+
                                        '<td>qqq</td>'+
                                        '</tr>');
        }
      });
    });
    function dispute_resolved(sender_id,receiver_id,id,projectuser_id){
        $.post('{{ route('get_dispute_resolve_modal') }}', { _token: '{{ csrf_token() }}', sender_id:sender_id,receiver_id:receiver_id,project_id:id,projectuser_id:projectuser_id}, function(data){
            $('#dispute_for_project').modal('show');
            $('#dispute_for_modal_body').html(data);
        })
    }
</script>
@endsection

