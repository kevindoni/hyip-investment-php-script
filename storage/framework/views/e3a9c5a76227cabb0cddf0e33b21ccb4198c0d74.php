<?php $__env->startSection('title', trans('FAQ')); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make($theme.'sections.faq', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($theme.'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xammp\htdocs\hyip8\project\resources\views/themes/dodgerblue/faq.blade.php ENDPATH**/ ?>