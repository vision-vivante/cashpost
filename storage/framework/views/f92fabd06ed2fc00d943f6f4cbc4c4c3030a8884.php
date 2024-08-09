<!-- cancel Modal -->
<div class="modal fade" id="bookmark-remove-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title h6"><?php echo e(translate('Bookmark Remove Confirmation')); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body text-center">
                <p class="lead"><?php echo e(translate('Are you sure to remove from bookmark?')); ?></p>
                <button type="button" class="btn btn-link mt-2" data-dismiss="modal"><?php echo e(translate('Cancel')); ?></button>
                <a href="" id="comfirm-link" class="btn btn-primary mt-2"><?php echo e(translate('Confirm')); ?></a>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /www/wwwroot/public_html/cashpost.visionvivante.com/resources/views/frontend/default/partials/bookmark_remove_modal.blade.php ENDPATH**/ ?>