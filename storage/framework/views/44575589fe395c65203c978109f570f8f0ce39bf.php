<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('Manage Theme'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">
            <div class="row">

                <?php $__currentLoopData = $theme; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header bg-dark p-3 text-white my-1 font-weight-bold">
                              <?php echo e($data['title']); ?>

                            </div>
                            <div class="card-body m-0 p-0">
                                <img class="w-100" src="<?php echo e(asset($data['path'])); ?>" alt="<?php echo app('translator')->get('theme-image'); ?>" >
                            </div>
                            <div class="card-footer">
                                <?php if($basic->theme == $key): ?>
                                    <button
                                        type="button"
                                        disabled
                                        class="btn waves-effect waves-light btn-rounded btn-dark btn-block mt-3">
                                        <span><i class="fas fa-check-circle pr-2"></i> <?php echo app('translator')->get('Selected'); ?></span>
                                    </button>
                                <?php else: ?>
                                    <button
                                        type="button"
                                        class="btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3 activateBtn"
                                        data-toggle="modal" data-target="#activateModal"
                                        data-route="<?php echo e(route('admin.activate.themeUpdate', $key)); ?>">
                                        <span><i class="fas fa-save pr-2"></i> <?php echo app('translator')->get('Select As Active'); ?></span>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

        </div>
    </div>


    <!-- Primary Header Modal -->
    <div id="activateModal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel"><?php echo app('translator')->get('Theme Activate Confirmation'); ?>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <p><?php echo app('translator')->get('Are you sure to activate this theme?'); ?></p>
                </div>

                <form action="" method="post" class="actionForm">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('put'); ?>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                                data-dismiss="modal"><?php echo app('translator')->get('Close'); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('Activate'); ?></button>
                    </div>

                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('js'); ?>
    <script>
        "use strict";
        $(document).ready(function () {

            $('.activateBtn').on('click', function () {
                $('.actionForm').attr('action', $(this).data('route'));
            })

            $('select').select2({
                selectOnClose: true
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xammp\htdocs\hyip8\project\resources\views/admin/manage-theme.blade.php ENDPATH**/ ?>