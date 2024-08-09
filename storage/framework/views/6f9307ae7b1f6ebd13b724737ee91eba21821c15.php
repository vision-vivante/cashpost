

<?php $__env->startSection('content'); ?>
    <section class="py-4 py-lg-5">
        <div class="container">
            <?php if($keyword != null): ?>
                <div class="row">
                    <div class="col-xl-8 offset-xl-2 text-center">
                        <h1 class="h5 mt-3 mt-lg-0 mb-5 fw-400"><?php echo e(translate('Total')); ?> <span class="fw-600"><?php echo e($total); ?></span> <?php echo e(translate('projects found for')); ?> <span class="fw-600"><?php echo e($keyword); ?></span></h1>
                    </div>
                </div>
            <?php endif; ?>
            <form id="project-filter-form" action="" method="GET">
                <div class="row gutters-10">
                    <div class="col-xl-3 col-lg-4">
                        <div class="aiz-filter-sidebar collapse-sidebar-wrap sidebar-lg z-1035">
                            <div class="card rounded-0 rounded-lg collapse-sidebar c-scrollbar-light">
                                <div class="card-header">
                                    <h5 class="mb-0 h6"><?php echo e(translate('Filter By')); ?></h5>
                                    <button class="btn btn-sm p-2 d-lg-none filter-sidebar-thumb" data-toggle="class-toggle" data-target=".aiz-filter-sidebar" type="button">
                                        <i class="las la-times la-2x"></i>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="mb-5">
                                        <h6 class="separator text-left mb-3 fs-12 text-uppercase text-secondary">
                                            <span class="bg-white pr-3"><?php echo e(translate('Categories')); ?></span>
                                        </h6>
                                        <div class="category-filter fs-14">
                                            <ul class="list-unstyled mb-0">
                                                <?php if(!isset($category_id)): ?>
                                                    <?php $__currentLoopData = \App\Models\ProjectCategory::where('parent_id', 0)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li><a href="<?php echo e(route('projects.category', $category->slug)); ?>"><?php echo e($category->name); ?></a></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <li class="go-back"><a href="<?php echo e(route('search')); ?>"><?php echo e(translate('All Categories')); ?></a></li>
                                                    <?php if(\App\Models\ProjectCategory::find($category_id)->parent_id != 0): ?>
                                                        <li class="go-back"><a href="<?php echo e(route('projects.category', \App\Models\ProjectCategory::find(\App\Models\ProjectCategory::find($category_id)->parent_id)->slug)); ?>"><?php echo e(\App\Models\ProjectCategory::find(\App\Models\ProjectCategory::find($category_id)->parent_id)->name); ?></a></li>
                                                    <?php endif; ?>
                                                    <li class="go-back"><a href="<?php echo e(route('projects.category', \App\Models\ProjectCategory::find($category_id)->slug)); ?>"><?php echo e(\App\Models\ProjectCategory::find($category_id)->name); ?></a></li>
                                                    <?php $__currentLoopData = \App\Utility\CategoryUtility::get_immediate_children_ids($category_id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li><a href="<?php echo e(route('projects.category', \App\Models\ProjectCategory::find($id)->slug)); ?>"><?php echo e(\App\Models\ProjectCategory::find($id)->name); ?></a></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mb-5">
                                        <h6 class="separator text-left mb-3 fs-12 text-uppercase text-secondary">
                                            <span class="bg-white pr-3"><?php echo e(translate('Project Type')); ?></span>
                                        </h6>
                                        <div class="aiz-checkbox-list">
                                            <label class="aiz-checkbox">
                                                <input type="checkbox" name="projectType[]" value="Fixed" <?php if(in_array('Fixed', $projectType)): ?>
                                                    checked
                                                <?php endif; ?> onchange="applyFilter()"> <?php echo e(translate('Fixed Price')); ?>

                                                <span class="aiz-square-check"></span>
                                                <span class="float-right text-secondary fs-12"></span>
                                            </label>
                                            <label class="aiz-checkbox">
                                                <input type="checkbox"  name="projectType[]" value="Long Term" <?php if(in_array('Long Term', $projectType)): ?>
                                                    checked
                                                <?php endif; ?> onchange="applyFilter()"> <?php echo e(translate('Long Term')); ?>

                                                <span class="aiz-square-check"></span>
                                                <span class="float-right text-secondary fs-12"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mb-5">
                                        <h6 class="separator text-left mb-3 fs-12 text-uppercase text-secondary">
                                            <span class="bg-white pr-3"><?php echo e(translate('Numbers of Bids')); ?></span>
                                        </h6>
                                        <div class="aiz-radio-list">
                                            <label class="aiz-radio">
                                                <input type="radio" name="bids" value="" onchange="applyFilter()" <?php if($bids == ""): ?>
                                                    checked
                                                <?php endif; ?>> <?php echo e(translate('Any Number of bids')); ?>

                                                <span class="aiz-rounded-check"></span>
                                                <span class="float-right text-secondary fs-12"></span>
                                            </label>
                                            <label class="aiz-radio">
                                                <input type="radio" name="bids" value="0-5" onchange="applyFilter()" <?php if($bids == "0-5"): ?>
                                                    checked
                                                <?php endif; ?>> <?php echo e(translate('0 to 5')); ?>

                                                <span class="aiz-rounded-check"></span>
                                                <span class="float-right text-secondary fs-12"></span>
                                            </label>
                                            <label class="aiz-radio">
                                                <input type="radio" name="bids" value="5-10" onchange="applyFilter()" <?php if($bids == "5-10"): ?>
                                                    checked
                                                <?php endif; ?>> <?php echo e(translate('5 to 10')); ?>

                                                <span class="aiz-rounded-check"></span>
                                                <span class="float-right text-secondary fs-12"></span>
                                            </label>
                                            <label class="aiz-radio">
                                                <input type="radio" name="bids" value="10-20" onchange="applyFilter()" <?php if($bids == "10-20"): ?>
                                                    checked
                                                <?php endif; ?>> <?php echo e(translate('10 to 20')); ?>

                                                <span class="aiz-rounded-check"></span>
                                                <span class="float-right text-secondary fs-12"></span>
                                            </label>
                                            <label class="aiz-radio">
                                                <input type="radio" name="bids" value="20-30" onchange="applyFilter()" <?php if($bids == "20-30"): ?>
                                                    checked
                                                <?php endif; ?>> <?php echo e(translate('20 to 30')); ?>

                                                <span class="aiz-rounded-check"></span>
                                                <span class="float-right text-secondary fs-12"></span>
                                            </label>
                                            <label class="aiz-radio">
                                                <input type="radio" name="bids" value="30+" onchange="applyFilter()" <?php if($bids == "30+"): ?>
                                                    checked
                                                <?php endif; ?>> <?php echo e(translate('30+')); ?>

                                                <span class="aiz-rounded-check"></span>
                                                <span class="float-right text-secondary fs-12"></span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="overlay overlay-fixed dark c-pointer" data-toggle="class-toggle" data-target=".aiz-filter-sidebar" data-same=".filter-sidebar-thumb"></div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8">
                        <div class="card mb-lg-0">
                            <input type="hidden" name="type" value="project">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-sm btn-icon btn-soft-secondary d-lg-none flex-shrink-0 mr-2" data-toggle="class-toggle" data-target=".aiz-filter-sidebar" type="button">
                                        <i class="las la-filter"></i>
                                    </button>
                                    <input type="text" class="form-control form-control-sm" placeholder="Search Keyword" value="<?php echo e($keyword); ?>" name="keyword">
                                </div>

                                <div class="w-200px">
                                    <select class="form-control form-control-sm aiz-selectpicker" name="sort" onchange="applyFilter()">
                                        <option value="1" <?php if($sort == '1'): ?> selected <?php endif; ?>><?php echo e(translate('Newest first')); ?></option>
                                        <option value="2" <?php if($sort == '2'): ?> selected <?php endif; ?>><?php echo e(translate('Lowest budget first')); ?></option>
                                        <option value="3" <?php if($sort == '3'): ?> selected <?php endif; ?>><?php echo e(translate('Highest budget first')); ?></option>
                                        <option value="4" <?php if($sort == '4'): ?> selected <?php endif; ?>><?php echo e(translate('Lowest bids first')); ?></option>
                                        <option value="5" <?php if($sort == '5'): ?> selected <?php endif; ?>><?php echo e(translate('Highest bids first')); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-body p-0">

                                <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('project.details', $project->slug)); ?>" class="d-block d-xl-flex card-project text-inherit px-3 py-4">
                                        <div class="flex-grow-1">
                                            <h5 class="h6 fw-600 lh-1-5"><?php echo e($project->name); ?></h5>
                                            <div class="text-muted lh-1-8">
                                                <p><?php echo e($project->excerpt); ?></p>
                                            </div>
                                            <ul class="list-inline opacity-70 fs-12">
                                                <li class="list-inline-item">
                                                    <i class="las la-clock opacity-40"></i>
                                                    <span><?php echo e(Carbon\Carbon::parse($project->created_at)->diffForHumans()); ?></span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class="las la-stream opacity-40"></i>
                                                    <span><?php echo e(translate('Project Category')); ?></span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <i class="las la-handshake"></i>
                                                    <span><?php if($project->project_category != null): ?> <?php echo e($project->project_category->name); ?> <?php else: ?> <?php echo e(translate('Removed Category')); ?> <?php endif; ?></span>
                                                </li>
                                            </ul>
                                            <div>
                                                <?php $__currentLoopData = json_decode($project->skills); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $skill_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $skill = \App\Models\Skill::find($skill_id);
                                                    ?>
                                                    <?php if($skill != null): ?>
                                                        <span class="btn btn-light btn-xs mb-1"><?php echo e($skill->name); ?></span>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0 pt-4 pt-xl-0 pl-xl-4 d-flex flex-row-reverse flex-xl-column justify-content-between align-items-center">
                                            <div class="text-right">
                                                <span class="small text-secondary"><?php echo e(translate('Budget')); ?></span>
                                                <h4 class="mb-0"><?php echo e(single_price($project->price)); ?></h4>
                                                <div class="mt-xl-2 small text-secondary">
                                                    <?php if($project->bids > 0): ?>
                                                        <span class="text-body mr-1"><?php echo e($project->bids); ?>+</span>
                                                    <?php else: ?>
                                                        <span class="text-body mr-1"><?php echo e($project->bids); ?></span>
                                                    <?php endif; ?>
                                                    <span>Bids</span>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="d-flex align-items-center">
                                                    <span class="avatar avatar-xs">
                                                        <?php if($project->client->photo != null): ?>
                                                            <img src="<?php echo e(custom_asset($project->client->photo)); ?>">
                                                        <?php else: ?>
                                                            <img src="<?php echo e(my_asset('assets/frontend/default/img/avatar-place.png')); ?>">
                                                        <?php endif; ?>
                                                    </span>
                                                    <div class="pl-2">
                                                        <h4 class="fs-14 mb-1"><?php if( $project->client != null ): ?> <?php echo e($project->client->name); ?> <?php endif; ?></h4>
                                                        <div class="text-secondary fs-10">
                                                            <i class="las la-star text-warning"></i>
                                                            <span class="fw-600"><?php echo e(formatRating(getAverageRating($project->client->id))); ?></span>
                                                            <span>(<?php echo e(getNumberOfReview($project->client->id)); ?> <?php echo e(translate('reviews')); ?>)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                            <div class="card-footer">
                                <div class="aiz-pagination aiz-pagination-center flex-grow-1">
                                    <ul class="pagination">
                                        <?php echo e($projects->links()); ?>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        function applyFilter(){
            $('#project-filter-form').submit();
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.default.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/frontend/default/projects-listing.blade.php ENDPATH**/ ?>