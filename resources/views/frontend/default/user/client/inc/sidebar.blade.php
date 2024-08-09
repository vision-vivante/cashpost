<div class="aiz-user-sidenav-wrap d-block border-0 c-scrollbar-light position-relative z-1">
    <div class="aiz-user-sidenav">
        <div class="container">
            <div class="dashboard-heading d-flex align-items-center justify-content-between row">
                <div class="col-sm-6">    
                    <h2 class="font-weight-bold text-white">Hello, {{  Str::ucfirst(Auth::user()->name )}}</h2>
                    <p class="text-white">Welcome to CashPost</p>
                </div>
                <div class="col-sm-6 text-sm-left">
                    <a href="{{ route('projects.create') }}" class="btn btn-green lg">
                        <i class="las la-plus"></i>
                        <span>Add New Campaign</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container position-relative">
        <div class="cards-group position-absolute">
            <div class="row">
                @php
                    $data = getAllCampaign();
                    
                @endphp
                <div class="col-lg-4 col-sm-6 mb-3">
                    <div class="card my-card p-4 mb-0 h-100">
                        <div class="row no-gutters">
                        <div class="col-4 px-2">
                            <img src="{{my_asset('/uploads/all/rocket.png')}}" alt="..." class="img-fluid">
                        </div>
                        <div class="col-8">
                            <div class="card-body p-0">
                                <a href="{{route('projects.my_completed_project')}}">
                                    <h2 class="text-dark font-weight-bold">{{ $data['completed'] }}</h2>
                                    <p class="text-grey">Completed campaigns</p>
                                </a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-3">
                    <div class="card my-card p-4 mb-0 h-100">
                        <div class="row no-gutters">
                        <div class="col-4 px-2">
                            <img src="{{my_asset('/uploads/all/infinity.png')}}" alt="..." class="img-fluid">
                        </div>
                        <div class="col-8">
                            <div class="card-body p-0">
                                <a href="{{route('projects.my_running_project')}}">
                                    <h2 class="text-dark font-weight-bold">{{ $data['inprogress'] }}</h2>
                                    <p class="text-grey">In progress</p>
                                </a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-3">
                    <div class="card my-card p-4 mb-0 h-100">
                        <div class="row no-gutters">
                            <div class="col-4 px-2">
                                <img src="{{my_asset('/uploads/all/money.png')}}" alt="..." class="img-fluid">
                            </div>
                            <div class="col-8">
                                <div class="card-body p-0">
                                <a href="wallet">
                                    <h2 class="text-dark font-weight-bold">{{ single_price(Auth::user()->profile->balance) }}</h2>
                                    <p class="text-grey">Wallet Amount</p>
                                </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-3">
                    <div class="card my-card p-4 mb-0 h-100">
                        <div class="row no-gutters">
                        <div class="col-4 px-2">
                            <img src="{{my_asset('/uploads/all/invitation.png')}}" alt="..." class="img-fluid">
                        </div>
                        <div class="col-8">
                            <div class="card-body p-0">
                                <a href="{{route('project.bids')}}">
                                    <h2 class="text-dark font-weight-bold">{{ $data['bids'] }}</h2>
                                    <p class="text-grey">Pending Bids</p>
                                </a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
