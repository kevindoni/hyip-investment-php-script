<!-- PAGE-BANNER -->
<style>
    .banner-section {
        background: url(<?php echo e(getFile(config('location.logo.path').'banner.jpg')); ?>);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
</style>

<?php if(!request()->routeIs('home')): ?>


















    <!-- banner section -->
    <section class="banner-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>Know <span class="text-stroke">about us</span></h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">FAQ</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php /**PATH D:\xammp\htdocs\hyip8\project\resources\views/themes/dodgerblue/partials/banner.blade.php ENDPATH**/ ?>