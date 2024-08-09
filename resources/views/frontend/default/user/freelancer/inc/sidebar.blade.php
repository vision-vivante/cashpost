<div class="aiz-user-sidenav-wrap d-block border-0 c-scrollbar-light position-relative z-1">
    <!-- <div class="absolute-top-left d-xl-none">
        <button class="btn btn-sm p-2" data-toggle="class-toggle" data-target=".aiz-mobile-side-nav" data-same=".mobile-side-nav-thumb">
            <i class="las la-times la-2x"></i>
        </button>
    </div> -->
    <div class="aiz-user-sidenav">
        <div class="container">
            <div class="dashboard-heading">
                <h2 class="font-weight-bold text-white">Hello, {{  Str::ucfirst(Auth::user()->name )}}</h2>
                <p class="text-white">Welcome to CashPost</p>
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
                            <img src="public/uploads/all/rocket.png" alt="..." class="img-fluid">
                        </div>
                        <div class="col-8">
                            <a href="{{route('projects.my_completed_project')}}">
                                <div class="card-body p-0">
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
                                   <h2 class="text-dark font-weight-bold">{{ single_price( ( isset(Auth::user()->profile->balance) ? Auth::user()->profile->balance : 0 ) ) }}</h2>
                                    <p class="text-grey">Total earnings</p>
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
                                <a href="{{route('private_projects')}}">
                                    <h2 class="text-dark font-weight-bold">{{ $data['invitations'] }}</h2>
                                    <p class="text-grey">Pending offers</p>
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
