@extends('frontend.default.layouts.app')

@section('content')

    <section class="">
        <div class="container">
            <div class="my-campaigns-status history">
                @include('frontend.default.user.freelancer.inc.earning_sidebar')

                <div class="aiz-user-panel p-0">
                    <div class="view-campaigns-entries">
                        <div class="filter-job justify-content-between">
                            <form class="" id="sort_projects" action="" method="GET">
                                <div class="row justify-content-between">
                                    <div class="col-lg-3 col-sm-5 col-9 mb-3 mb-sm-0">
                                        <div class="entries-filter row align-items-center">
                                            <div class="col-sm-3 col-4 entries text-grey m-0">Show</div>
                                            <div class="col-4  p-0 sort-job">
                                                <select class="form-control coustom-select compaign-select radius-10 aiz-selectpicker mb-2 mb-md-0" name="items" id="type" onchange="sort_projects()">
                                                    <option value="10" selected>10</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                    <option value="500">500</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-3 col-3 entries text-grey m-0">entries</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 search-status col-sm-6 col-7 search-job">
                                        <!-- <div class="input-group-append">
                                            <button class="btn" type="submit">
                                                <i class="bi bi-search text-grey"></i>
                                            </button>
                                        </div> -->
                                        <input type="text" class="form-control radius-10" placeholder="Search" name="search">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card px-0">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table aiz-table h6 mb-0">
                                        <thead class="fw-600">
                                            <tr>
                                                <th width="10%">{{ translate('Sr no.') }}</th>
                                                <th>{{ translate('Campaign title') }}</th>
                                                <th>{{ translate('Date') }}</th>
                                                <th>{{ translate('Amount') }}</th>
                                                <th>{{ translate('Status') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($milestones as $key => $milestone)
                                               @php 
                                               $class='';
                                                if($key==1){
                                                   $class="pending-text-custom";
                                                }else{
                                                    $class="complete";
                                                }
                                                @endphp
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td><a href="#" class="text-dark">{{ $milestone->project->name }}</a></td>
                                                    <td>{{ $milestone->created_at }}</td>
                                                    <td class="font-weight-bold  {{$class}}">{{ single_price($milestone->amount) }}</td>
                                                    <td class="{{$class}}">{{'Status'}}</td>
                                                    <!-- <td>{{ single_price($milestone->freelancer_profit) }}</td> -->
                                                    <!-- <td>{{ single_price($milestone->admin_profit) }}</td> -->
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ $milestones->links() }}
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>

@endsection
