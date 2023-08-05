<?php $__env->startSection('title', trans($title)); ?>

<?php $__env->startSection('content'); ?>
    <?php if(isset($templates['blog'][0]) && $blog = $templates['blog'][0]): ?>
        <?php if(0 < count($contentDetails['blog'])): ?>
            <!-- blog section  -->
















































            <!-- blog section  -->
            <?php if(isset($contentDetails['blog'])): ?>

            <?php else: ?>
                <h2><?php echo app('translator')->get('No blog found'); ?></h2>
            <?php endif; ?>
            <section class="blog-section blog-details">
                <div class="container">
                    <div class="row g-lg-5 gy-5">
                        <div class="col-lg-8">
                            <div class="row g-4">
                                <?php $__currentLoopData = $contentDetails['blog']->sortDesc(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-12">
                                        <div class="blog-box">
                                            <div class="img-box">
                                                <img src="<?php echo e(getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)); ?>" class="img-fluid" alt="">
                                            </div>
                                            <div class="text-box">
                                                <div class="date-author">
                                                    <span><?php echo app('translator')->get('Admin'); ?></span>
                                                    <span><?php echo e(dateTime(@$data->created_at,'d M, Y')); ?></span>
                                                </div>
                                                <h4>
                                                    <a href="<?php echo e(route('blogDetails',[slug(@$data->description->title), $data->content_id])); ?>" class="blog-title"
                                                    ><?php echo e(\Illuminate\Support\Str::limit(@$data->description->title,60)); ?></a
                                                    >
                                                </h4>
                                                <p><?php echo e(Illuminate\Support\Str::limit(strip_tags(@$data->description->description),120)); ?></p>
                                                <a href="<?php echo e(route('blogDetails',[slug(@$data->description->title), $data->content_id])); ?>" class="read-more"><?php echo app('translator')->get('read more'); ?>
                                                    <i class="fal fa-long-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="side-bar">
                                <div class="side-box">
                                    <h4><?php echo app('translator')->get('Recent Post'); ?></h4>
                                    <?php $__currentLoopData = $contentDetails['blog']->shuffle()->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="side-blog-box">
                                            <div class="img-box">
                                                <img class="img-fluid" src="<?php echo e(getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)); ?>" alt="">
                                            </div>
                                            <div class="text-box">
                                                <a href="<?php echo e(route('blogDetails',[slug(@$data->description->title), $data->content_id])); ?>" class="title"><?php echo e(\Illuminate\Support\Str::limit(@$data->description->title,20)); ?> </a>
                                                <span class="date"><?php echo e(dateTime(@$data->created_at,'d M, Y')); ?></span>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make($theme.'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xammp\htdocs\hyip8\project\resources\views/themes/dodgerblue/blog.blade.php ENDPATH**/ ?>