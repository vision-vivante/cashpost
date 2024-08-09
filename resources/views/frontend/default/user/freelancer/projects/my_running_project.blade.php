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
                    <div class="aiz-titlebar mt-2 mb-4">
                       <h2 class="font-weight-bold my-campus-title pt-5 border-top">{{ translate('Running Projects') }}</h2>
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
                                                    <th>{{translate('Proof URL')}}</th>
                                                    <th>{{translate('Status')}}</th>
                                                    <th>{{translate('Action')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @forelse ($running_projects as $key => $running_project)
                                            @php
                                                $project = \App\Models\Project::withTrashed()->find($running_project->id);
                                                $client_photo = user_profile_pic($project->client_user_id);
                                                $brand_name=get_brand_name($project->client_user_id);
                                                $status=get_all_projects($project);
                                                $user_details=get_userdata($running_project->client_user_id);
                                                $name=(isset($user_details->name)) ? $user_details->name : '';
                                            @endphp
                                            <tr>
                                                <td>{{$key + $running_projects->firstItem()}}</td>
                                                <td>
                                                    @if($client_photo != null)
                                                    <img src="{{ custom_asset($client_photo) }}" width="70" height="50" alt="" class="img-fluid radius-10">
                                                    @else
                                                        <img class="img-fluid radius-10" src="{{ my_asset('assets/frontend/default/img/avatar-place.png') }}" width="70" height="50" alt="">
                                                    @endif
                                                </td>
                                                <td><a href="{{ route('project.details', $project->slug) }}" class="text-inherit"> {{$project->name}}</a></td>
                                                <td>{{$name}}</td>
                                                <td>{{$brand_name}}</td>
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
                                                    @if($project->deleted_at == null)
                                                        <a href="{{ url('chat?receiver='.Auth::user()->id.'&project='.$project->slug) }}" class="btn btn-primary btn-sm">{{ translate('Chat With Client') }}</a>
                                                        @if(empty($running_project->submitted))
                                                            @if(!empty(Auth::user()->profile->stripe_account))
                                                                <a href="javascript:void(0)" onclick="show_modal({{$project->id}})" class="btn btn-success btn-sm">{{ translate('Submit Proof') }}</a>
                                                                @else
                                                                <a href="{{ route('stripe.bank_account')}}" class="btn btn-success btn-sm">{{ translate('Submit Proof') }}</a>
                                                            @endif
                                                        @endif
                                                    @else 
                                                        <p>Campaign banned by Admin</p>
                                                    @endif
                                                </td>
                                            </tr>
                                            @empty
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                <div class="aiz-pagination aiz-pagination-center">
                                    {{ $running_projects->appends(['type'=> $type,'search'=>$search,'project'=>$project])->links() }}
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
    <div class="modal fade" id="project_submit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ translate('Submit Proof') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" id="submit_for_modal_body"> 

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function show_modal(id){
            $.post('{{ route('submit_proof_for_project_modal') }}', { _token: '{{ csrf_token() }}', project_id:id }, function(data){
                $('#project_submit').modal('show');
                $('#submit_for_modal_body').html(data);
            })
        }        
    </script>
@endsection