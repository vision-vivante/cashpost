<div class="aiz-user-sidenav-wrap border-0 d-block c-scrollbar-light position-relative z-1 shadow-none pt-3 pt-md-5">
<h2 class="font-weight-bold my-campus-title">{{ translate('All') }}</h2>
    <ul class="aiz-side-nav-list level-2">
        <li class="aiz-side-nav-item">
            <a href="{{ route('projects.all_project') }}" class="aiz-side-nav-link m-0 text-grey fw-500 h6 position-relative {{ areActiveRoutes(['bidded_projects'])}}">
                <span class="aiz-side-nav-text">{{ translate('All') }}</span>
            </a>
        </li>
        <li class="aiz-side-nav-item">
            <a href="{{ route('private_projects') }}" class="aiz-side-nav-link m-0 text-grey fw-500 h6 position-relative {{ areActiveRoutes(['private_projects'])}}">
                <span class="aiz-side-nav-text">{{ translate('Pending') }}</span>
            </a>
        </li>
        <li class="aiz-side-nav-item">
            <a href="{{ route('projects.my_completed_project') }}" class="aiz-side-nav-link m-0 text-grey fw-500 h6 position-relative {{ areActiveRoutes(['projects.my_completed_project'])}}">
                <span class="aiz-side-nav-text">{{ translate('Received') }}</span>
            </a>
        </li>
    </ul>
</div>
