<?php if(isset($templates['faq'][0]) && $faq = $templates['faq'][0]): ?>
    <?php if(0 < count($contentDetails['faq'])): ?>
        <!-- faq section -->
        <section class="faq-section">
            <div class="container">
                <div class="row g-4 g-lg-5">
                    <div class="col-lg-4">
                        <div class="header-text">
                            <h3><?php echo app('translator')->get(wordSplice($faq->description->title)['withoutLastWord']); ?> <span
                                    class="text-stroke"><?php echo app('translator')->get(wordSplice($faq->description->title)['lastWord']); ?></span>
                            </h3>
                            <p class="mt-4 mb-5">
                                <?php echo app('translator')->get(@$faq->description->sub_title); ?>
                            </p>
                            <div class="mail-to">
                                <?php echo app('translator')->get(@$faq->description->short_details); ?>
                            </div>
                        </div>
                    </div>
                    <?php if(isset($contentDetails['faq'])): ?>
                        <div class="col-lg-8 ps-lg-5">
                            <div class="accordion" id="accordionExample">
                                <?php $__currentLoopData = $contentDetails['faq']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="accordion-item">
                                        <h4 class="accordion-header <?php echo e((session()->get('rtl') == 1) ? 'isRtl': ''); ?>" id="heading<?php echo e($k++); ?>">

                                            <button
                                                class="accordion-button <?php echo e(($k != 1) ? 'collapsed': ''); ?>"
                                                type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#collapse<?php echo e($k); ?>"
                                                aria-expanded="<?php echo e(($k == 1) ? 'true' : 'false'); ?>"
                                                aria-controls="collapse<?php echo e($k); ?>"
                                            >

                                                <?php echo app('translator')->get(@$data->description->title); ?><span class="index"><?php echo e($k < 10 ? '0'.$k : $k); ?></span>
                                            </button>
                                        </h4>
                                        <div
                                            id="collapse<?php echo e($k); ?>"
                                            class="accordion-collapse collapse <?php echo e(($k == 1) ? 'show' : ''); ?>"
                                            aria-labelledby="heading<?php echo e($k); ?>"
                                            data-bs-parent="#accordionExample"
                                        >
                                            <div class="accordion-body">
                                                <?php echo app('translator')->get(@$data->description->description); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH D:\xammp\htdocs\hyip8\project\resources\views/themes/dodgerblue/sections/faq.blade.php ENDPATH**/ ?>