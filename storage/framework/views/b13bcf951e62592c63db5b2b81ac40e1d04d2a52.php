<?php $__env->startSection('title',trans('Blog Details')); ?>

<?php $__env->startSection('content'); ?>
    <!-- blog details  -->
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    


    <!-- blog details  -->
    <section class="blog-section blog-details">
        <div class="container">
            <div class="row g-lg-5 g-4">
                <div class="col-lg-8">
                    <div class="blog-box">
                        <div class="img-box">
                            <img src="<?php echo e($singleItem['image']); ?>" class="img-fluid" alt="">
                        </div>
                        <div class="text-box">
                            <div class="date-author">
                                <span><?php echo app('translator')->get('Admin'); ?></span>
                                <span><?php echo e($singleItem['date']); ?></span>
                            </div>
                            <h4><?php echo app('translator')->get($singleItem['title']); ?></h4>
                            <p>
                                <?php echo app('translator')->get($singleItem['description']); ?>
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="side-bar">
                        <div class="side-box">
                            <h4><?php echo app('translator')->get('Recent Post'); ?></h4>
                            <?php $__currentLoopData = $popularContentDetails['blog']->sortDesc(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="side-blog-box">
                                    <div class="img-box">
                                        <img class="img-fluid" src="<?php echo e(getFile(config('location.content.path').'thumb_'.@$data->content->contentMedia->description->image)); ?>" alt="">
                                    </div>
                                    <div class="text-box">
                                        <a href="<?php echo e(route('blogDetails',[slug($data->description->title), $data->content_id])); ?>" class="title"> <?php echo e(\Str::limit($data->description->title,40)); ?> </a>
                                        <span class="date"><?php echo e(dateTime($data->created_at)); ?></span>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($theme.'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xammp\htdocs\hyip8\project\resources\views/themes/dodgerblue/blogDetails.blade.php ENDPATH**/ ?>