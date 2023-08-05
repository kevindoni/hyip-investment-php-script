<?php $__env->startSection('title',trans($title)); ?>

<?php $__env->startSection('content'); ?>
    <!-- CONTACT -->
    <!-- contact section -->
    <div class="contact-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="form-box">
                        <form action="<?php echo e(route('contact.send')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="row g-4">
                                <div class="input-box col-md-12">
                                    <input class="form-control" type="text" name="name" value="<?php echo e(old('name')); ?>" placeholder="<?php echo app('translator')->get('Full name'); ?>" />
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="input-box col-md-12">
                                    <input class="form-control" type="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo app('translator')->get('Email address'); ?>" />
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="input-box col-12">
                                    <input type="text" name="subject" value="<?php echo e(old('subject')); ?>" class="form-control" placeholder="<?php echo app('translator')->get('Subject'); ?>"/>
                                    <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="input-box col-12">
                                    <textarea class="form-control" name="message" cols="30" rows="3" placeholder="<?php echo app('translator')->get('Your message'); ?>"><?php echo e(old('message')); ?></textarea>
                                    <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="input-box col-12">
                                    <button class="btn-custom w-100"><?php echo app('translator')->get('Send Message'); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-1"></div>

                <div class="col-lg-6">
                    <div class="header-text">
                        <h5><?php echo app('translator')->get('Contact us'); ?></h5>
                        <h3><?php echo app('translator')->get(wordSplice($contact->heading)['withoutLastWord']); ?> <span class="text-stroke"><?php echo app('translator')->get(wordSplice($contact->heading)['lastWord']); ?></span></h3>
                        <p>
                            <?php echo app('translator')->get(@$contact->sub_heading); ?>
                        </p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-box">
                                <div class="icon"><img src="<?php echo e(asset($themeTrue.'img/icon/email.png')); ?>" alt="" /></div>
                                <div class="text">
                                    <h4><?php echo app('translator')->get('Email'); ?></h4>
                                    <p><?php echo app('translator')->get(@$contact->email); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <div class="icon"><img src="<?php echo e(asset($themeTrue.'img/icon/phone.png')); ?>" alt="" /></div>
                                <div class="text">
                                    <h4><?php echo app('translator')->get('Phone'); ?></h4>
                                    <p><?php echo app('translator')->get(@$contact->phone); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <div class="icon"><img src="<?php echo e(asset($themeTrue.'img/icon/location.png')); ?>" alt="" /></div>
                                <div class="text">
                                    <h4><?php echo app('translator')->get('Location'); ?></h4>
                                    <p><?php echo app('translator')->get(@$contact->address); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-box">
                                <?php if(isset($contentDetails['social'])): ?>
                                    <div class="social-links">
                                        <h5 class=""><?php echo app('translator')->get('Follow our social media'); ?></h5>
                                        <div>
                                            <?php $__currentLoopData = $contentDetails['social']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="<?php echo e(@$data->content->contentMedia->description->link); ?>" class="facebook">
                                                    <i class="<?php echo e(@$data->content->contentMedia->description->icon); ?>"></i>
                                                </a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- /CONTACT -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make($theme.'layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xammp\htdocs\hyip8\project\resources\views/themes/dodgerblue/contact.blade.php ENDPATH**/ ?>