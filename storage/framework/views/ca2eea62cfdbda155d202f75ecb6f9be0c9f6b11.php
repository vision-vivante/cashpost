
<div class="aiz-user-sidenav-wrap border-0  d-block c-scrollbar-light position-relative z-1 shadow-none pt-3 pt-md-5">
    <ul class="aiz-side-nav-list border-bottom level-2">
        <li class="aiz-side-nav-item">
            
            <a href="<?php echo e(route('projects.all_project')); ?>" class="aiz-side-nav-link m-0 text-grey fw-500 h6 position-relative <?php echo e(areActiveRoutes(['projects.all_project'])); ?>">
                <span class="aiz-side-nav-text"><?php echo e(translate('All')); ?> ( <?php echo e($data['all']); ?> )</span>
            </a>
        </li>
        <li class="aiz-side-nav-item">
            <a href="<?php echo e(route('projects.my_running_project')); ?>" class="aiz-side-nav-link m-0 text-grey fw-500 h6 position-relative <?php echo e(areActiveRoutes(['projects.my_running_project'])); ?>">
                <span class="aiz-side-nav-text"><?php echo e(translate('In-Progress')); ?> ( <?php echo e($data['inprogress']); ?> )</span>
            </a>
        </li>
        <li class="aiz-side-nav-item">
            <a href="<?php echo e(route('private_projects')); ?>" class="aiz-side-nav-link m-0 text-grey fw-500 h6 position-relative <?php echo e(areActiveRoutes(['private_projects'])); ?>">
                <span class="aiz-side-nav-text"><?php echo e(translate('Pending Offers')); ?> ( <?php echo e($data['invitations']); ?> )</span>
            </a>
        </li>
        <li class="aiz-side-nav-item">
            <a href="<?php echo e(route('projects.my_completed_project')); ?>" class="aiz-side-nav-link m-0 text-grey fw-500 h6 position-relative <?php echo e(areActiveRoutes(['projects.my_completed_project'])); ?>">
                <span class="aiz-side-nav-text"><?php echo e(translate('Closed')); ?> ( <?php echo e($data['completed']); ?> )</span>
            </a>
        </li> 
        <li class="aiz-side-nav-item">
            <a href="<?php echo e(route('project.bids')); ?>" class="aiz-side-nav-link m-0 text-grey fw-500 h6 position-relative <?php echo e(areActiveRoutes(['project.bids'])); ?>">
                <span class="aiz-side-nav-text"><?php echo e(translate('Bids')); ?> ( <?php echo e($data['applied']); ?> )</span>
            </a>
        </li>
       
    </ul>
</div>
<div class="view-campaigns-entries">
    <div class="filter-job justify-content-between">
        <form class="" id="sort_projects" action="" method="GET">
            <div class="row justify-content-between">
                <div class="col-xl-2 col-lg-3 col-sm-5 col-9 mb-3 mb-sm-0">
                    <div class="entries-filter row align-items-center">
                        <div class="col-4 entries text-grey m-0">Show</div>
                        <div class="col-5 p-0 sort-job">
                            <select class="form-control coustom-select compaign-select radius-10 aiz-selectpicker mb-2 mb-md-0" name="items" id="type" onchange="sort_projects()">
                                <option value="10" <?php if($items == 10): ?> selected <?php endif; ?> >10</option>
                                <option value="50" <?php if($items == 50): ?> selected <?php endif; ?> >50</option>
                                <option value="100" <?php if($items == 100): ?> selected <?php endif; ?> >100</option>
                                <option value="500" <?php if($items == 500): ?> selected <?php endif; ?> >500</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-3 entries text-grey m-0">entries</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 search-status col-sm-6 col-7 search-job">
                    <input type="text" class="form-control radius-10" placeholder="Campaign Search" name="search" <?php if(isset($sort_search)): ?> value="<?php echo e($sort_search); ?>" <?php endif; ?>>
                </div>
            </div>
        </form>
    </div>
</div>
<?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/frontend/default/user/client/inc/dashboard_sidebar.blade.php ENDPATH**/ ?>